<?php get_header();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>


<div class = "homepage_body">

  <?php include "home_page_slide_show.php"; ?>

  <div class="homepage_cards">
    <?php include "cards_container.php"; ?>
  </div>

</div>

<?php get_footer();?>
