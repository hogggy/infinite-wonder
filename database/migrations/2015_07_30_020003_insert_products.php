<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use \App\Models\Product;

class InsertProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $product = new Product(array(
            'name' => 'Color Backpack',
            'desc' => 'Colored Backpack sold on site.',
            'price' => 11.95
        ));
        $product->save();
        $product2 = new Product(array(
            'name' => 'Black Backpack',
            'desc' => 'Colored Backpack sold on site.',
            'price' => 13.01
        ));
        $product2->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $product = Product::where("name", "=", 'Color Backpack')->first();
        $product->forceDelete();
    }
}
