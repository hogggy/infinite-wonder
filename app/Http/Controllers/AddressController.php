<?php
/**
 * Created by IntelliJ IDEA.
 * User: williamhogben
 * Date: 9/26/15
 * Time: 5:22 PM
 */

namespace App\Http\Controllers;

use App\Utils\PaylineUtility;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller{

    public function address(Request $request) {
        $user = $this->getUserFromCookies($request);
        $cart = $this->getCartOrNewCart($user);
        $user->email = $request->get('email');
        $user->save();
        $address = new Address($request->all());
        $cart->addresses()->save($address);
        $address->save();

        if ( $address->type == Address::TYPE_SHIPPING ) {
            $price = $cart->getTotalPrice();
            $util = new PaylineUtility();
            $response = $util->stepOne($address, $price);
            $xml = simplexml_load_string($response->getBody()->__toString());
            Log::Info($xml->{"form-url"});

            return $this->success(array("url" => $xml->{"form-url"}->__toString()));
        }

        return $this->success();
    }
}