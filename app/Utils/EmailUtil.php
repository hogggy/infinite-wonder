<?php
/**
 * Created by IntelliJ IDEA.
 * User: williamhogben
 * Date: 10/19/15
 * Time: 3:47 PM
 */

namespace App\Utils;


use App\Models\Cart;
use Mailgun\Mailgun;
use Illuminate\Support\Facades\Log;

class EmailUtil {

    const API_KEY = "key-b3d60d43f2ca682864de11ea7206df84";

    public function sendReceipt(Cart $cart) {
        $mg = new Mailgun(self::API_KEY);
        $domain = "fullprintcamping.com";
        $user = $cart->user()->first();

        $response = $mg->sendMessage($domain, array(
            'from' => 'support@fullprintcamping.com',
            'to' => $user->email,
            'subject' => "Your order at FullPrintCamping.com",
            'text' => "fullprintcamping.com/order-details/" . $cart->id
        ));

        Log::info($response);
    }

}