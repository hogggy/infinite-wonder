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
            'name' => 'Space',
            'desc' => <<<HTML
<p>
    This pack is printed with details from the artwork "Space" by Samuel Farrand.
</p>
<p>
    Made with lightweight, durable, ripstop material.
</p>
<p>
    Three large storage pockets with the option of using the water reservoir from the front zipper pocket or back velcro pocket.
</p>
<p>
    Small hidden pocket for cash and coins.
</p>
<p>
    Easy-click lock to prevent mouthpiece leaks.
</p>
<p>
    Hydration Capacity: 2 L (67.6 fl oz)<br/>
    Dry Weight: 0.33kg (11.6 oz) <br/>
    Dimensions: 40 x 21 x 10 cm (15.7 x 8.2 x 3.6 in)
</p>
HTML
,
            'price' => 80.00
        ));
        $product->save();
        $product2 = new Product(array(
            'name' => 'Phantasmagoria',
            'desc' => <<<HTML
<p>
    This pack is printed with the artwork "Phantasmagoria" by Samuel Farrand.
</p>
<p>
    Made with lightweight, durable, ripstop material.
</p>
<p>
    Three large storage pockets with the option of using the water reservoir from the front zipper pocket or back velcro pocket.
</p>
<p>
    Small hidden pocket for cash and coins.
</p>
<p>
    Easy-click lock to prevent mouthpiece leaks.
</p>
<p>
    Hydration Capacity: 2 L (67.6 fl oz)<br/>
    Dry Weight: 0.33kg (11.6 oz) <br/>
    Dimensions: 40 x 21 x 10 cm (15.7 x 8.2 x 3.6 in)
</p>
HTML
        ,
            'price' => 80.00
        ));
        $product2->save();
        $product3 = new Product(array(
            'name' => 'Melchizedek',
            'desc' => <<<HTML
<p>
    This pack is printed with details from the artwork "Melchizedek" by Samuel Farrand.
</p>
<p>
    Made with lightweight, durable, ripstop material.
</p>
<p>
    Three large storage pockets with the option of using the water reservoir from the front zipper pocket or back velcro pocket.
</p>
<p>
    Small hidden pocket for cash and coins.
</p>
<p>
    Easy-click lock to prevent mouthpiece leaks.
</p>
<p>
    Hydration Capacity: 2 L (67.6 fl oz)<br/>
    Dry Weight: 0.33kg (11.6 oz) <br/>
    Dimensions: 40 x 21 x 10 cm (15.7 x 8.2 x 3.6 in)
</p>
HTML
        ,
            'price' => 80.00
        ));
        $product3->save();
        $product4 = new Product(array(
            'name' => 'Primordial Presence',
            'desc' => <<<HTML
<p>
    This pack is printed with the artwork "Primordial Presence" by Hakan Hısım.
</p>
<p>
    Made with lightweight, durable, ripstop material.
</p>
<p>
    Three large storage pockets with the option of using the water reservoir from the front zipper pocket or back velcro pocket.
</p>
<p>
    Small hidden pocket for cash and coins.
</p>
<p>
    Easy-click lock to prevent mouthpiece leaks.
</p>
<p>
    Hydration Capacity: 2 L (67.6 fl oz)<br/>
    Dry Weight: 0.33kg (11.6 oz) <br/>
    Dimensions: 40 x 21 x 10 cm (15.7 x 8.2 x 3.6 in)
</p>
HTML
        ,
            'price' => 80.00
        ));
        $product4->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $products = Product::where("name", "=", '*')->get();
        foreach ($products as $product) {
            $product->forceDelete();
        }
    }
}
