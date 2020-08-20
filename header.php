<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="images/misc/favicon.ico">
    <link rel="dns-prefetch" href="//s.w.org">
    <link rel="stylesheet" id="bootstrap-css" href="css/bootstrap/bootstrap.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="style_cards-css" href="css/style_cards.css" type="text/css" media="all">
    <link rel="stylesheet" id="style_slides-css" href="css/style_slides.css" type="text/css" media="all">
    <link rel="stylesheet" id="style_top-css" href="css/style_top.css" type="text/css" media="all">
    <link rel="stylesheet" id="style_base-css" href="css/style.css" type="text/css" media="all">
    <link rel="shortcut icon" href="images/misc/favicon.ico">
    <script type="text/javascript" src="js/scripts.js"></script>
</head>

<?php
$SERVERNAME = "192.168.1.49";
$USERNAME = "gudababy";
$PASSWORD = "good";
$DBNAME = "gudanews";


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
    passthru("script/translate.py '" . $text . "'");
    return ob_get_clean();
}
?>
