<?php
/**
 * Created by IntelliJ IDEA.
 * User: williamhogben
 * Date: 9/26/15
 * Time: 6:19 PM
 */

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Product;
use App\Utils\EmailUtil;
use App\Utils\PaylineUtility;
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
        $shippingAddress = $cart->shippingAddress();
        $billingAddress = $cart->billingAddress();
        if ($cart->same_as_shipping) {
            $billingAddress = $shippingAddress;
        }

        return response()->view('cart', array(
            'cart' => $cart,
            'items' => $items,
            'billing' => $billingAddress,
            'shipping' => $shippingAddress,
            'email' => $user->email,
            'section' => $request->input('section', 'cart')
        ));
    }

    public function shop(Request $request) {
        $products = Product::paginate(12);
        return response()->view('shop', array('products' => $products));
    }

    public function thankYou(Request $request) {
        $cartId = $request->input('cartId');
        $cart = Cart::find($cartId);
        $token = $request->input('token-id');
        if (!$cartId || !$cart || !$token) {
            Log::error("Thank you page accessed with no token-id or invalid cart");

            return redirect('/');
        }
        $util = new PaylineUtility();
        $errors = $util->stepThree($token);
        Log::error($errors);

        $cart->status = Cart::STATUS_CLOSED;
        $cart->save();

        $mailer = new EmailUtil();
        $mailer->sendReceipt($cart);

        return response()->view('thankYou', array('cartId' => $cartId));
    }

    public function review(Request $request) {
        $user = $this->getUserFromCookies($request);
        $cart = $this->getCartOrNewCart($user);
        if ($cart->status !== Cart::STATUS_CHECKOUT || !$request->input('token-id')) {
            Log::error($cart->status);
            return redirect('/');
        }

        $items = $cart->items()->get();
        foreach ($items as $item) {
            $item->product = $item->product()->first();
        }
        $shippingAddress = $cart->shippingAddress();
        $billingAddress = $cart->billingAddress();
        if ($cart->same_as_shipping) {
            $billingAddress = $shippingAddress;
        }
        $shippingAmount = 0;
        if ($shippingAddress->country !== "US") {
            $shippingAmount = 10;
        }

        return response()->view('review', array(
            'cart' => $cart,
            'billing' => $billingAddress,
            'shipping' => $shippingAddress,
            'items' => $items,
            'shippingCost' => $shippingAmount,
            'token' => $request->input('token-id')
        ));
    }
}