<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include "php/include.php";

include "header.php";

include "php/user.php";

$p = $_GET["p"]; # Page
$q = $_GET["q"]; # Query
$lang = $_GET["lang"]; # Language
$uuid = $_GET['uuid']; # uuid

include "container/top.php"; # Adding top sticky

if (isset($p)) {
    if ($p == "news") {
        include "container/news.php";
    }
}
elseif (!isset($q)) {
    include "container/slides.php";
}
include "container/cards.php";

include "footer.php";
?>
