<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

define('SITE_ROOT', './');

include 'header.php';

include_once 'php/user.php';

$p = $_GET['p']; # Page
$q = $_GET['q']; # Query
$lang = $_GET['lang']; # Language
$uuid = $_GET['uuid']; # uuid

include 'container/top.php'; # Adding top sticky

if (!isset($q) && !isset($p)) {
    include 'container/slides.php';
}
elseif (isset($p) && ($p == 'news')) {
    include 'container/news.php';
}
include 'container/cards.php';
include 'container/bottom.php';
include 'footer.php';
?>
