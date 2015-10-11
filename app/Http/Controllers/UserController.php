<?php
/**
 * Created by IntelliJ IDEA.
 * User: williamhogben
 * Date: 8/13/15
 * Time: 3:37 PM
 */

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Logging\Log;

class UserController extends Controller{

    public function saveBillingInfo(Request $request) {
        $user = $this->getUserFromCookies($request);

        $user->registerCustomer($request->get('stripeToken'));
        $response = $this->success();

        return $response->withCookie(cookie('userId', $user->id, 60));
    }

}