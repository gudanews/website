<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include "php/user.php";

include "header.php";


$q = $_GET['q'];
$lang = $_GET['lang'];

include "container/container_top.php";
# Display records
if (!isset($q)) {
    include "container/container_slides.php";
}
include "container/container_cards.php";

echo "</div>";

include "footer.php";
?>
