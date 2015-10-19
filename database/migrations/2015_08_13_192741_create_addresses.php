<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->char('type', 10);
            $table->string('address1');
            $table->string('address2');
            $table->string('state');
            $table->string('city');
            $table->integer('postal');
            $table->string('country');
            $table->char('cart_id');
            $table->foreign('cart_id')->references('id')->on('cart');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('address');
    }
}
