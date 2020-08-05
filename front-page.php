<?php get_header();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>


<div class = "homepage_body">
    <div class="news-slides">
        <?php include "slides_container.php"; ?>
    </div>
    <div class="news-cards">
        <?php include "cards_container.php"; ?>
    </div>
</div>

<?php get_footer();?>