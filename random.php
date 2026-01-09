<?php

function randomInt($min = 0, $max = 100) {
    return random_int($min, $max);
}

function randomFloat($min = 0, $max = 1, $precision = 2) {
    $num = $min + mt_rand() / mt_getrandmax() * ($max - $min);
    return round($num, $precision);
}

function randomDouble($min = 0, $max = 1, $precision = 6) {
    return randomFloat($min, $max, $precision);
}

function randomFloor($min = 0, $max = 100) {
    return floor(randomFloat($min, $max, 6));
}

function randomCeil($min = 0, $max = 100) {
    return ceil(randomFloat($min, $max, 6));
}

function randomStep($min, $max, $step = 5) {
    $values = range($min, $max, $step);
    return $values[array_rand($values)];
}

function randomString($length = 10) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($chars), 0, $length);
}

function randomAlphaNum($length = 12) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle($chars), 0, $length);
}

function randomNumberString($length = 6) {
    $digits = '0123456789';
    return substr(str_shuffle($digits), 0, $length);
}

function randomHex($length = 8) {
    return substr(bin2hex(random_bytes($length)), 0, $length);
}

function randomBool() {
    return (bool) random_int(0, 1);
}

function randomUUID() {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        random_int(0, 0xffff),
        random_int(0, 0xffff),
        random_int(0, 0xffff),
        random_int(0, 0x0fff) | 0x4000,
        random_int(0, 0x3fff) | 0x8000,
        random_int(0, 0xffff),
        random_int(0, 0xffff),
        random_int(0, 0xffff)
    );
}

function randomAny() {
    $types = ['int', 'float', 'string', 'bool'];
    $pick = $types[array_rand($types)];

    switch ($pick) {
        case 'int':
            return randomInt(1, 1000);
        case 'float':
            return randomFloat(1, 100, 2);
        case 'string':
            return randomAlphaNum(10);
        case 'bool':
            return randomBool();
    }
}

function randomWeighted(array $items) {
    $sum = array_sum($items);
    $rand = random_int(1, $sum);
    foreach ($items as $item => $weight) {
        $rand -= $weight;
        if ($rand <= 0) return $item;
    }
}

function randomPercent($precision = 2) {
    return round(mt_rand() / mt_getrandmax() * 100, $precision);
}

function randomIp() {
    return join('.', [
        random_int(1, 255),
        random_int(0, 255),
        random_int(0, 255),
        random_int(1, 255)
    ]);
}

function randomColorHex() {
    return '#' . substr(bin2hex(random_bytes(3)), 0, 6);
}

function randomUsername($length = 8) {
    return strtolower(randomString($length)) . random_int(10, 99);
}

function randomSlug($words = 3) {
    $dict = ['fast','bot','cloud','node','secure','auto','smart','data','flow','core'];
    shuffle($dict);
    return implode('-', array_slice($dict, 0, $words));
}

function randomDate($start, $end, $format = 'Y-m-d') {
    return date($format, random_int(strtotime($start), strtotime($end)));
}

function randomPublicId($len = 12) {
    return rtrim(strtr(base64_encode(random_bytes($len)), '+/', '-_'), '=');
}

function randomChance($percent) {
    return random_int(1, 100) <= $percent;
}
?>
