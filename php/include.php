<?php
$SERVERNAME = '192.168.1.49';
$USERNAME = 'gudababy';
$PASSWORD = 'good';
$DBNAME = 'gudanews';

$ip = '';
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

function string_crop($string, $length) {
    $string = strip_tags($string);
    if (strlen($string) > $length) {
        // truncate string
        $stringCut = substr($string, 0, $length);
        $endPoint = strrpos($stringCut, ' ');
        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= ' ...';
    }
    return $string;
}

function translate_to_chinese($text) {
    ob_start();
    passthru("script/translate.py '$text'");
    return ob_get_clean();
}
?>
