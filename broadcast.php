<?php

function addBot($token) {

    $url = "https://tricksxtech.in/broadcast/api/?v1=addbot";

    $postData = [
        "token" => $token
    ];

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => http_build_query($postData),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => false
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return [
            "success" => false,
            "error"   => $error
        ];
    }

    curl_close($ch);

    return [
        "success"  => true,
        "response" => $response
    ];
}
