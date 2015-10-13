<?php
/**
 * Created by IntelliJ IDEA.
 * User: williamhogben
 * Date: 9/26/15
 * Time: 3:35 PM
 */

namespace App\Utils;

use GuzzleHttp\Client, App\Models\Address;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class PaylineUtility {

    const apiKey = "2F822Rw39fx762MaV7Yy86jXGTC7sCDy";
    const postUrl = "https://secure.paylinedatagateway.com/api/v2/three-step";

    private $shippingFields = ['address1', 'address2', 'state', 'city', 'postal', 'country'];

    public function stepOne(Address $address, $price) {
        $client = new Client();
        $xml = $this->stepOneXml($address, $price);
        $request = new Request(
            "POST",
            self::postUrl,
            array('Content-Type' => 'text/xml; charset=UTF8'),
            $xml
        );
        $response = $client->send($request);

        return $response;
    }

    private function stepOneXml(Address $address, $amount) {
        $redirectUrl = $_SERVER['HTTP_HOST'] . "/shop";
        $xml = new \SimpleXMLElement("<sale></sale>");
        $xml->addChild("api-key", self::apiKey);
        $xml->addChild("redirect-url", $redirectUrl);
        $xml->addChild("amount", $amount);
        $xml->addChild("currency", "USD");
        $addressXml = $xml->addChild("shipping");
        foreach ($this->shippingFields as $fieldName) {
            $addressXml->addChild($fieldName, $address->$fieldName);
        }
        $names = explode(' ', $address->name, 2);
        if (count($names) > 1) {
            $addressXml->addChild('last-name', $names[1]);
        }
        $addressXml->addChild('first-name', $names[0]);

        return $xml->asXML();
    }

}