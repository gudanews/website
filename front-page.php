<?php get_header();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

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
    passthru("wp-content/themes/gudanews/translate.py '" . $text . "'");
    return ob_get_clean();
}
$q = $_GET['q'];
$uuid = $_GET['uuid'];
$cwd = get_template_directory_uri();

echo "<div class=\"body\">";

include "container_top.php";

if (!isset($uuid)) {
    # Display records
    if (!isset($q)) {
        include "container_slides.php";
    }
    include "container_cards.php";
} else {
    include "news.php";
}

echo "</div>";

get_footer();

?>
