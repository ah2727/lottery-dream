<?php
require_once 'db_connect.php';


class Cheak
{
    function CheakPay($TRACK_ID)
    {
        $url = 'https://api.oxapay.com/merchants/inquiry';

        $data = array(
            'merchant' => 'Z20EPV-XEC2LL-MNN56M-H0TSHF',
            'trackId' => $TRACK_ID
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