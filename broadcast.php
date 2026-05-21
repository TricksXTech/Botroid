<?php

/*
|--------------------------------------------------------------------------
| BroadcastX PHP SDK
|--------------------------------------------------------------------------
|
| Compatible With Secure API Endpoints
|
| Functions:
| - addBot($token)
| - addUser($botkey,$apikey,$userid)
| - checkUser($botkey,$apikey,$userid)
| - totalUsers($botkey,$apikey)
|
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| CONFIG
|--------------------------------------------------------------------------
*/

define("BROADCASTX_API","https://tricksxtech.in/broadcast/api/?v1=");



/*
|--------------------------------------------------------------------------
| REQUEST FUNCTION
|--------------------------------------------------------------------------
*/

function broadcastxRequest($endpoint,$postData=[]){

    $url = BROADCASTX_API . $endpoint;

    $ch = curl_init($url);

    curl_setopt_array($ch,[

        CURLOPT_POST => true,

        CURLOPT_POSTFIELDS => http_build_query($postData),

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_SSL_VERIFYPEER => true,

        CURLOPT_SSL_VERIFYHOST => 2,

        CURLOPT_HTTPHEADER => [
            "Accept: application/json"
        ]

    ]);

    $response = curl_exec($ch);

    if(curl_errno($ch)){

        $error = curl_error($ch);

        curl_close($ch);

        return [

            "success" => false,

            "message" => $error

        ];

    }

    $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);

    curl_close($ch);

    $decoded = json_decode($response,true);

    if(!$decoded){

        return [

            "success" => false,

            "message" => "Invalid API Response"

        ];

    }

    $decoded['http_code'] = $httpcode;

    return $decoded;
}



/*
|--------------------------------------------------------------------------
| ADD BOT
|--------------------------------------------------------------------------
|
| Example:
|
| $bot = addBot("BOT_TOKEN");
|
|--------------------------------------------------------------------------
*/

function addBot($token){

    if(empty($token)){

        return [

            "success" => false,

            "message" => "Token Missing"

        ];

    }

    return broadcastxRequest("addbot",[

        "token" => $token

    ]);

}



/*
|--------------------------------------------------------------------------
| ADD USER
|--------------------------------------------------------------------------
|
| Example:
|
| addUser(
|     "bot_A8K29X",
|     "API_KEY",
|     123456789
| );
|
|--------------------------------------------------------------------------
*/

function addUser($botkey,$apikey,$userid){

    if(empty($botkey) || empty($apikey) || empty($userid)){

        return [

            "success" => false,

            "message" => "Missing Parameters"

        ];

    }

    return broadcastxRequest("adduser",[

        "bot_key" => $botkey,

        "api_key" => $apikey,

        "userid" => $userid

    ]);

}



/*
|--------------------------------------------------------------------------
| CHECK USER
|--------------------------------------------------------------------------
|
| Example:
|
| checkUser(
|     "bot_A8K29X",
|     "API_KEY",
|     123456789
| );
|
|--------------------------------------------------------------------------
*/

function checkUser($botkey,$apikey,$userid){

    if(empty($botkey) || empty($apikey) || empty($userid)){

        return [

            "success" => false,

            "message" => "Missing Parameters"

        ];

    }

    return broadcastxRequest("checkuser",[

        "bot_key" => $botkey,

        "api_key" => $apikey,

        "userid" => $userid

    ]);

}



/*
|--------------------------------------------------------------------------
| TOTAL USERS
|--------------------------------------------------------------------------
|
| Example:
|
| totalUsers(
|     "bot_A8K29X",
|     "API_KEY"
| );
|
|--------------------------------------------------------------------------
*/

function totalUsers($botkey,$apikey){

    if(empty($botkey) || empty($apikey)){

        return [

            "success" => false,

            "message" => "Missing Parameters"

        ];

    }

    return broadcastxRequest("totalusers",[

        "bot_key" => $botkey,

        "api_key" => $apikey

    ]);

}
