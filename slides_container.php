<?php
$MAX_RECORD =6;
$servername = "192.168.1.49";
$username = "gudaman";
$password = "GudaN3w2";
$name = "gudanews";

$day_minus_1d = date('Y-m-d', strtotime('-1 days'));

$heading = array();
$snippet = array();
$image_path = array();
$url = array();
$source = array();
$row_count = 0;

# QUERY RESULT
$conn = new mysqli($servername, $username, $password, $name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT heading, snippet, hl.url, image.path as image, source.name as source FROM headline hl INNER JOIN image ON hl.image_id = image.id INNER JOIN source ON hl.source_id = source.id WHERE hl.image_id > 0 AND snippet <> 'NULL' AND datetime > '" . $day_minus_1d . "' ORDER BY RAND() LIMIT " . $MAX_RECORD;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $image_path[] = $row["image"];
        $heading[] = $row["heading"];
        $snippet[] = $row["snippet"];
        $source[] = $row["source"];
        $url[] = $row["url"];
        $row_count += 1;
    }
}
$conn->close();
?>

<div class="slides-container">
    <div class="slides-indexes" horizontal layout>
<?php
for ($i = 0; $i < $row_count; $i++) {
echo <<<EOL
        <div class="slide-index">
            <a onclick="showSlide($i)">
                <img class="slide-index-icon" src="$image_path[$i]" />
            </a>
        </div>
EOL;
}
?>
    </div>
    <div class="slides-body" horizontal layout>
        <div class="slides-content">
<?php
for ($i = 0; $i < $row_count; $i++) {
echo <<<EOL
            <div class="slide">
                <div>
                    <img class="slide-image" src="$image_path[$i]" />
                </div>
                <div>
                    <p class="slide-heading">
                        $heading[$i]
                    </p>
                </div>
            </div>
EOL;
}
?>
        </div>
    </div>
</div>


<script>


var slides = document.getElementsByClassName('slide');
var slide_nav = document.getElementsByClassName('slide-index');
var currentSlide = 0;
var slideInterval = setInterval(nextSlide, 5000);
showSlide(0);

function showSlide(id) {
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        slides[i].className = slides[i].className.replace(" showing", "");
        slide_nav[i].className = slide_nav[i].className.replace(" active", "");
    }
    currentSlide = id % slides.length;
    slides[currentSlide].style.display = "block";
    slides[currentSlide].className += " showing";
    slide_nav[currentSlide].className += " active";
}

function nextSlide() {
    showSlide(currentSlide + 1);
}

function previousSlide() {
    showSlide(currentSlide - 1);
}

</script>




<!-- <div class = "slideshow_container">
    <div class = "slideshow_arrow_container">
      <div class = "slideshow_left_arrow">

      </div>
      <div class = "slideshow_right_arrow">

      </div>
    </div>
    <div class = home_slideshow_image_container>
      <div class = "image_slideshow_home_small">

        </div>
      </div>
    </div>
  </div>
          <div class = "slideshow_content_container">
            <div class = "slideshow_image_homepage_big">

            </div>
            <div class = "slideshow_heading">

            </div>
            <div class = "slideshow_snippet">

            </div>
            <div class = "slideshow_read_more_button">

            </div>
            <div class = "slideshow_content_sources_container">
              <div class = "slideshow_content_sources">

              </div>
            </div>
          </div> -->
