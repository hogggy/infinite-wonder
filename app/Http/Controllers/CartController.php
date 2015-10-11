<?php
/**
 * Created by IntelliJ IDEA.
 * User: williamhogben
 * Date: 7/25/15
 * Time: 11:02 PM
 */

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class CartController extends Controller{

    const CART_ID = 'userId';

    public function addToCart(Request $request)
    {
        // verify parameters
        if (!$request->has("itemId")) {
            return new Response("Request must contain itemId", Response::HTTP_BAD_REQUEST);
        }
        $itemId = $request->input("itemId");
        $quantity = $request->input("quantity", 1);
        $user = $this->getUserFromCookies($request);
        $cart = $this->getCartOrNewCart($user);

        $oldItem = $cart->items()->where('product_id', intval($itemId))->first();
        if ($oldItem) {
            $oldItem->quantity = $oldItem->quantity + $quantity;
            $oldItem->save();
        } else {
            $attributes = array(
                'product_id'    => $itemId,
                'quantity'      => $quantity
            );
            $item = new CartItem($attributes);
            $cart->items()->save($item);
        }

        $request->session()->set(self::CART_ID, $cart->id);
        $response = $this->success(array('cart' => $cart->toArray(), 'user_id' => $user->id));

        return $response->withCookie(cookie('userId', $user->id, 60));
    }

    public function removeFromCart(Request $request, $itemId) {
        if ($request->session()->has(self::CART_ID)) {
            $cart = Cart::find($request->session()->get(self::CART_ID));
            $item = $cart->items()->where('id', $itemId)->first();
            $item->delete();
        }

        return $this->success();
    }

    public function changeQuantity(Request $request) {
        // verify parameters
        if (!$request->has("itemId") || !$request->has("quantity")) {
            return new Response("Request must contain itemId and quantity", Response::HTTP_BAD_REQUEST);
        }
        $itemId = $request->input("itemId");
        $quantity = $request->input("quantity");

        // verify valid itemId
        $cartItem = CartItem::find($itemId);
        if (is_null($cartItem)) {
            return new Response("Item id is invalid: " . $itemId, Response::HTTP_NOT_FOUND);
        }

        $cartItem->quantity = $quantity;
        $cartItem->save();

        return $this->success(array('itemId' => $itemId, 'quantity' => $quantity));
    }

    public function getCart(Request $request) {
        $user = $this->getUserFromCookies($request);
        $cart = $user->carts()->where('closed', '=', false)->first();
        if (!$cart) {
            return $this->success();
        }
        return $this->success(array('cart' => $cart->toArray()));
    }
}