<?php get_header();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
?>


<div class="body">
    <!-- <div class="top-bar">
        <?php include "top_container.php"; ?>
    </div> -->
    <div class="news-slides">
        <?php include "slides_container.php"; ?>
    </div>
    <div class="news-cards">
        <?php include "cards_container.php"; ?>
    </div>
</div>

<?php get_footer();?>
