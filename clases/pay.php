<?php

namespace dbconnect;
class pay
{


    function oxPay($amount, $email, $ORDid, $description)
    {
        $url = 'https://api.oxapay.com/merchants/request';
        $data = array(
            'merchant' => 'Z20EPV-XEC2LL-MNN56M-H0TSHF',
            'amount' => $amount,
            'currency' => 'USD',
            'lifeTime' => 30,
            'feePaidByPayer' => 1,
            'underPaidCover' => 2.5,
            'callbackUrl' => 'https://lottery.re/callBack.php',
            'returnUrl' => 'https://lottery.re/sucsess.php',
            'description' => $description,
            'orderId' => $ORDid,
            'email' => $email
        );

        $options = array(
            'http' => array(
                'header' => 'Content-Type: application/json',
                'method' => 'POST',
                'content' => json_encode($data),
            ),
        );

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $result = json_decode($response);
        return $result;
    }


}