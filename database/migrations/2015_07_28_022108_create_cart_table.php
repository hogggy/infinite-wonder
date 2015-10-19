<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->char('id', 36);
            $table->primary('id');
            $table->char('user_id', 36);
            $table->foreign('user_id')->references('id')->on('user');
            $table->integer('last_four');
            $table->integer('exp_month');
            $table->integer('exp_year');
            $table->boolean('same_as_shipping')->default(true);
            $table->integer('status')->default(0);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cart');
    }
}
