<?php

function usercast($userid){
  file_get_contents("/?user=$userid");
}

function broadcastMessage($message,$mode){
  //here
}

function broadcastPhoto($photoURL,$message,$mode){
  //here
}

function broadcastVideo($videoURL,$message,$mode){
  //here
}

function broadcastDocs($docsURL,$message,$mode){
  //here
}

function loader($userid){
  //here
}

function custom_charset() {
    return 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
}

function generate_shuffle($key) {
    $base = custom_charset();
    $chars = str_split($base);

    $hash = hash('sha256', $key, true);
    $seed = unpack('N', substr($hash, 0, 4))[1];

    mt_srand($seed);
    shuffle($chars);
    mt_srand(); // reset randomness

    return implode('', $chars);
}

function inc_encode($input, $key) {
    $base = custom_charset();
    $shuffle = generate_shuffle($key);

    $map = array_combine(str_split($base), str_split($shuffle));

    $out = '';
    foreach (str_split($input) as $ch) {
        if (!isset($map[$ch])) {
            throw new Exception("Invalid character detected");
        }
        $out .= $map[$ch];
    }

    return $out;
}

function inc_decode($encoded, $key) {
    $base = custom_charset();
    $shuffle = generate_shuffle($key);

    $map = array_combine(str_split($shuffle), str_split($base));

    $out = '';
    foreach (str_split($encoded) as $ch) {
        if (!isset($map[$ch])) {
            throw new Exception("Invalid character detected");
        }
        $out .= $map[$ch];
    }

    return $out;
}

function inc_encodeV2($input, $key="KeyX") {
    $base = custom_charset();
    $shuffle = generate_shuffle($key);

    $map = array_combine(str_split($base), str_split($shuffle));

    $out = '';
    foreach (str_split($input) as $ch) {
        if (!isset($map[$ch])) {
            throw new Exception("Invalid character detected");
        }
        $out .= $map[$ch];
    }

    return $out;
}

function inc_decodeV2($encoded, $key="KeyX") {
    $base = custom_charset();
    $shuffle = generate_shuffle($key);

    $map = array_combine(str_split($shuffle), str_split($base));

    $out = '';
    foreach (str_split($encoded) as $ch) {
        if (!isset($map[$ch])) {
            throw new Exception("Invalid character detected");
        }
        $out .= $map[$ch];
    }

    return $out;
}
?>
