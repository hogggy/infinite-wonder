<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Cart;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $cookies = array();

    protected function success($additionalInfo = array()) {
        $responseArray = array_merge($additionalInfo, array("success" => true));
        return new JsonResponse($responseArray);
    }

    protected function getUserFromCookies(Request $request) {
        $user = null;
        if (!is_null($request->cookie('userId'))) {
            $user = User::find($request->cookie('userId'));
        }
        if(!$user) {
            $user = new User();
        }

        return $user;
    }

    protected function getCartOrNewCart(User $user) {
        $cart = $user->carts()->where('closed', false)->first();
        if (is_null($cart)) {
            $cart = new Cart();
            $user->save();
            $user->carts()->save($cart);
        }

        return $cart;
    }
}
