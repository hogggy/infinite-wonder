<?php
/**
 * Created by IntelliJ IDEA.
 * User: williamhogben
 * Date: 9/26/15
 * Time: 6:19 PM
 */

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function myCart(Request $request) {
        $user = $this->getUserFromCookies($request);
        $cart = $this->getCartOrNewCart($user);
        $items = $cart->items()->get();
        foreach ($items as $item) {
            $item->product = $item->product()->first();
        }

        return response()->view('cart', array(
            'cart' => $cart,
            'items' => $items
        ));
    }

    public function shop(Request $request) {
        $products = Product::paginate(12);
        return response()->view('shop', array('products' => $products));
    }
}