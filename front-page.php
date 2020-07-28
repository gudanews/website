<?php get_header(); ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// header('Location: index.php');
$MAX_RECORD = 60;
$servername = "192.168.1.49";
$username = "gudaman";
$password = "GudaN3w2";
$name = "gudanews";

$day_minus_2d = date('Y-m-d', strtotime('-2 days'));

$heading = array();
$snippet = array();
$image_path = array();
$url = array();
$image_slideshow = array();
$heading_slideshow = array();
$row_count = 0;


// if ($_GET['q'] == 'Search...') {
//     header('Location: index.php');
// }
$q = "";
if ($_GET['q'] !== '') {
    $q = $_GET['q'];
    # QUERY RESULT
    $conn = new mysqli($servername, $username, $password, $name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    # Display records
    if (isset($q)) {
        $sql = "SELECT heading, news_headline.url as url, image.url as image, snippet, source.name as source FROM news_headline, image, source WHERE source.id = news_headline.source_id AND image.id = news_headline.image_id AND news_headline.image_id !=0 AND heading LIKE '%" . $q . "%' OR snippet LIKE '%" . $q . "%' GROUP BY news_headline.url ORDER BY quality, datetime DESC LIMIT " . $MAX_RECORD;
    }
    else {
        $sql = "SELECT heading, news_headline.url as url, image.url as image, snippet FROM news_headline, image, source WHERE source.id = news_headline.source_id AND image.id = news_headline.image_id AND news_headline.image_id !=0 GROUP BY news_headline.url ORDER BY datetime DESC LIMIT " . $MAX_RECORD;
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $row_count = $row_count + 1;
            $heading[] = $row['heading'];
            $snippet[] = $row['snippet'];
            $image_path[] = $row['image'];
            $url[] = $row['url'];
        }
    }
    # Slide show records
    $sql = "SELECT heading, image.url as image FROM news_headline,image WHERE news_headline.image_id = image.id AND image_id != 0 AND datetime > '" . $day_minus_2d . "' GROUP BY news_headline.url ORDER BY datetime, quality LIMIT 6";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $image_slideshow[] = $row["image"];
            $heading_slideshow[] = $row["heading"];
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
        <script type="text/javascript">
            function active(){
                var searchbar = document.getElementById('searchbar');

                if(searchbar.value == 'Search...'){
                    searchbar.value = ''
                    searchbar.placeholder = 'Search...'
                }
            }
            function inactive(){
                var searchbar = document.getElementById('searchbar');

                if(searchbar.value == ''){
                    searchbar.value = 'Search...'
                    searchbar.placeholder = ''
                }
            }
        </script>
        <form action="index.php" method="GET" id="searchForm" />
            <input type="text" name="q" id="searchbar" placeholder="" value="Search..." maxlength="50" autocomplete="off" onMouseDown="active();" onBlur="inacti
ve();"/><input type="submit" id="searchBtn" value="Go!" onclick=""/>
        </form>

<?php
# SLIDE SHOW
for ($i=0; $i < 6; $i++) {
    echo "<div class='caption_text'>" .$heading_slideshow[$i] . "</div>";
}
?>

<div class="row">
    <div class="container_slide">
<?php
for ($i=0; $i < 6; $i++) {
  echo "<div class='mySlides'><div class='numbertext'>"
      . strval($i + 1) . " / 6 </div><img src='"
      . $image_slideshow[$i] . "' style='width:100%;height:100%' /></div>";
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
  echo "<div class='column'><img class='demo cursor' src='"
      . $image_slideshow[$i] ."' style='width:100%;height:100%' onclick='currentSlide("
      . strval($i + 1). ")' alt='' /></div>";
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
      var c_t = document.getElementsByClassName("caption_text");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");


      }
      captionText.innerHTML = c_t[slideIndex-1].textContent;
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      // captionText.innerHTML = dots[slideIndex-1].alt;

    }
</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?php
echo "<table align='center'>";
for ($i=0; $i < $row_count; $i++) {
    echo "<tr><td width=50%'><div class='img_content'>"
    . "<img width='280' height='180' style='max-width: 100%;max-height: 100%;'"
    . " src='" . $image_path[$i] ."' /></div><a class='heading' "
    . "style='color:#000000;font-weight:bolder;' href='" . $url[$i] . "'></div>"
    . $heading[$i]. "</a>\<p><i>" . $snippet[$i]. "</i></td></tr>\n";
}
echo "</table>";
?>




<?php get_footer();?>
