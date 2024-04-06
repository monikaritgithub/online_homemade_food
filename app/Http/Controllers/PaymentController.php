<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function verifyPayment(Request $request)
    {
        $token = $request->token;
        $amount = $request->amount;

        $args = http_build_query(array(
            'token' => $token,
            'amount'  => $amount
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $secret_key = 'test_secret_key_941a2fa7a7ef4ae697f42fcf79db87c8';

        $headers = ["Authorization: Key $secret_key"];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
    }

    public function storePayment(Request $request)
    {
        // $response = $request->response;
        // store the data to database here
        return response()->noContent();
    }
}