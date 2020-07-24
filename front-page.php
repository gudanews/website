<?php get_header();?>

<?php
$day_minus_2d = date('Y-m-d', strtotime('-3 days'));

$date_today = date('Y-m-d', strtotime('+1 days'));

$servername = "192.168.1.49";
$username = "gudaman";
$password = "GudaN3w2";
$name = "gudanews";

$conn = new mysqli($servername, $username, $password, $name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT path FROM news_headline,image WHERE news_headline.image_id = image.id AND datetime BETWEEN '"
    . $day_minus_2d . "' AND '". $date_today ."' ORDER BY quality LIMIT 6";
$result = $conn->query($sql);
$image_slideshow = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  //array_push($image_slideshow, $row["path"]);
  $image_slideshow[] = $row["path"];
  }
} else {
    echo "";
}
$conn->close();

?>

<div class="row">
    <div class="container_slide">
<?php
        for ($i=0; $i < 6; $i++) {
          echo "\t\t<div class='mySlides'>\n\t\t\t<div class='numbertext'>"
              . strval($i + 1) . " / 6 </div>\n\t\t\t<img src='"
              . $image_slideshow[$i] . "' style='width:100%;height:100%' />\n\t\t</div>\n";
        }
        ?>

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
        <div class="caption-container">
            <p id="caption" />
        </div>
        <div class="row">
<?php
            for ($i=0; $i < 6; $i++) {
              echo "\t\t\t<div class='column'>\n\t\t\t\t<img class='demo cursor' src='"
                  . $image_slideshow[$i] ."' style='width:100%;height:100%' onclick='currentSlide("
                  . strval($i + 1). ")' alt='' />\n\t\t\t</div>\n";
            }
            ?>
        </div>
    </div>
</div>
<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      var captionText = document.getElementById("caption");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      captionText.innerHTML = dots[slideIndex-1].alt;
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="topnav">
    <div class="search-container">
        <form action="/action_page.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>
</div>
<?php

$day_minus_2d = date('Y-m-d', strtotime('-3 days'));

$date_today = date('Y-m-d', strtotime('+1 days'));


$servername = "192.168.1.49";
$username = "gudaman";
$password = "GudaN3w2";
$name = "gudanews";

$conn = new mysqli($servername, $username, $password, $name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT heading,snippet,path,news_headline.url FROM news_headline, image WHERE image.id=news_headline.image_id AND datetime BETWEEN '"
    . $day_minus_2d . "' AND '". $date_today ."' ORDER BY datetime,quality LIMIT 100";
$result = $conn->query($sql);
echo "<table align='center'>\n";
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "\t<tr>\n\t\t<td width=50%'>\n\t\t\t<div class='image_content_container'>\n\t\t\t\t<div class='img_content'>\n";
    echo "\t\t\t\t\t<img width='280' height='180' style='max-width: 100%;max-height: 100%;' src='"
        . $row["path"] ."' />\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t<a style='color:#000000;font-weight:bolder;' href='"
    . $row["url"] ."'>" . $row["heading"]. "</a>\n\t\t\t<p>\n\t\t\t<i>" . $row["snippet"]. "</i>\n\t\t</td>\n";
    echo "\t</tr>\n";
  }
} else {
    echo "";
}
echo "</table>\n";
$conn->close();
?>

<?php get_footer();?>
