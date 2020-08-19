<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include "header.php";
include "user.php";


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
$q = $_GET['q'];

include "container/container_top.php";

# Display records
if (!isset($q)) {
    include "container/container_slides.php";
}
include "container/container_cards.php";

echo "</div>";

include "footer.php";
?>
