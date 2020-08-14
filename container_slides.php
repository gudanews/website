<?php
$MAX_RECORD = 6;
$MAX_TITLE_LENGTH = 128;
$MAX_SNIPPET_LENGTH = 178;
$servername = "192.168.1.49";
$username = "gudababy";
$password = "good";
$name = "gudanews";

$day_minus_1d = date("Y-m-d", strtotime("-1 days"));

$title = array();
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

$sql = "SELECT title, snippet, news.url, image.path as image, source.short_name as source FROM news INNER JOIN image ON news.image_id = image.id INNER JOIN source ON news.source_id = source.id WHERE news.image_id > 0 AND snippet <> 'NULL' AND datetime_created > '" . $day_minus_1d . "' ORDER BY datetime_created DESC LIMIT " . $MAX_RECORD;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $image_path[] = $row["image"];
        $title[] = string_crop($row["title"], $MAX_TITLE_LENGTH);
        $snippet[] = string_crop($row["snippet"], $MAX_SNIPPET_LENGTH);
        $source[] = $row["source"];
        $url[] = $row["url"];
        $row_count += 1;
    }
}
$conn->close();
?>

<div class="slide-container">
    <div class="slide-navigation" horizontal layout>
        <div class="slide-arrow">
            <a class="slide-prev" onclick="prevSlide()">❮</a>
        </div>
<?php
for ($i = 0; $i < $row_count; $i++) {
echo <<<EOL
        <div class="slide-index">
            <a onclick="showSlide($i)">
                <img class="index-icon" src="$image_path[$i]" />
            </a>
        </div>
EOL;
}
?>
        <div class="slide-arrow">
            <a class="slide-next" onclick="nextSlide()">❯</a>
        </div>
    </div>
    <div class="slide-body" horizontal layout>
        <div class="slide-content">
<?php
for ($i = 0; $i < $row_count; $i++) {
echo <<<EOL
            <div class="slide">
                <div class="slide-image">
                    <img class="slide-image-body" src="$image_path[$i]" />
                </div>
                <div class="slide-info">
                    <div class="slide-heading">
                        <p class="slide-heading-text">
                            $title[$i]
                        </p>
                    </div class="slide-snippet">
                    <div>
                        <p class="slide-snippet-text">
                            $snippet[$i]
                        </p>
                    </div>
                </div>
            </div>
EOL;
}
?>
        </div>
    </div>
</div>


<script>

var slide = document.getElementsByClassName("slide");
var slide_index = document.getElementsByClassName("slide-index");
var currentSlide = 0;
var slideInterval = setInterval(nextSlide, 6000);
showSlide(0);

function resetInterval() {
    clearInterval(slideInterval);
    slideInterval = setInterval(nextSlide, 6000);
}

function showSlide(id) {
    for (i = 0; i < slide.length; i++) {
        slide[i].style.display = "none";
        slide[i].classList.remove("showing");
        slide_index[i].classList.remove("active");
    }
    currentSlide = (slide.length + id) % slide.length;
    slide[currentSlide].style.display = "block";
    slide[currentSlide].classList.add("showing");
    slide_index[currentSlide].classList.add("active");
    resetInterval();
}

function nextSlide() {
    showSlide(currentSlide + 1);
}

function prevSlide() {
    showSlide(currentSlide - 1);
}

</script>
