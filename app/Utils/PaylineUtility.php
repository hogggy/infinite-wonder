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
use Illuminate\Support\Facades\Log;

class PaylineUtility {

    const apiKey = "2F822Rw39fx762MaV7Yy86jXGTC7sCDy";
    const postUrl = "https://secure.paylinedatagateway.com/api/v2/three-step";
    const redirectUrl="http://52.89.38.243/review";

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
        $xml = new \SimpleXMLElement("<sale></sale>");
        $xml->addChild("api-key", self::apiKey);
        $xml->addChild("redirect-url", self::redirectUrl);
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

    public function stepThree($token) {
        $client = new Client();
        $xml = new \SimpleXMLElement("<complete-action></complete-action>");
        $xml->addChild("api-key", self::apiKey);
        $xml->addChild("token-id", $token);
        $request = new Request(
            "POST",
            self::postUrl,
            array('Content-Type' => 'text/xml; charset=UTF8'),
            $xml->asXML()
        );
        $response = $client->send($request);
        $responseXml = simplexml_load_string($response->getBody()->__toString());
        if ($responseXml->result == 1) {
            return null;
        }
        $errorText = $responseXml->{'result-text'};
        Log::error("Error in checkout: " . $errorText);
        $code = $responseXml->{'result-code'};

        return $errorText;
    }

}