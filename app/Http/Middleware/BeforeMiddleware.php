<?php

namespace App\Http\Middleware;

use App\Models\CartItem;
use Closure;
use App\Models\Cart;
use App\Models\User;

class BeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // add cart contents to view
        $userId = $request->cookie("userId");
        $cartItems = 0;
        $price = 0;
        if (!is_null($userId)) {
            $user = User::find($userId);
            $cart = $user->carts()->where('closed', false)->first();
            foreach ($cart->items()->get() as $item) {
                $product = $item->product()->first();
                $price += $product->price * $item->quantity;
                $cartItems += $item->quantity;
            }
        }
        view()->share('cartItemCount', $cartItems);
        view()->share('cartTotalPrice', $price);

        return $next($request);
    }
}
