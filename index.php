<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

define(SITE_ROOT, './');

require_once 'php/include.php';

include_once 'header.php';

include_once 'php/user.php';

include_once 'container/top.php'; # Adding top sticky

if (!isset($q) && !isset($p)) {
    include_once 'container/slides.php';
}
elseif (isset($p) && ($p == 'news')) {
    include_once 'container/news.php';
}
include_once 'container/cards.php';
include_once 'container/bottom.php';
include_once 'footer.php';

#include_once 'container/contact_us.html';

#include_once 'container/contact_form_handler.php'
?>
