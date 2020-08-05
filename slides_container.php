<?php
$MAX_RECORD =6;
$servername = "192.168.1.49";
$username = "gudaman";
$password = "GudaN3w2";
$name = "gudanews";

$day_minus_1d = date("Y-m-d", strtotime("-1 days"));

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

$sql = "SELECT heading, snippet, hl.url, image.path as image, source.name as source FROM headline hl INNER JOIN image ON hl.image_id = image.id INNER JOIN source ON hl.source_id = source.id WHERE hl.image_id > 0 AND snippet <> 'NULL' AND datetime > '" . $day_minus_1d . "' ORDER BY datetime DESC LIMIT " . $MAX_RECORD;
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
        <div class="slides-arrow">
            <a class="slides-prev" onclick="prevSlide()">❮</a>
        </div>
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
        <div class="slides-arrow">
            <a class="slides-next" onclick="nextSlide()">❯</a>
        </div>
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

var slides = document.getElementsByClassName("slide");
var slide_nav = document.getElementsByClassName("slide-index");
var currentSlide = 0;
var slideInterval = setInterval(nextSlide, 5000);
showSlide(0);

function resetInterval() {
    clearInterval(slideInterval);
    slideInterval = setInterval(nextSlide, 5000);
}

function showSlide(id) {
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        slides[i].className = slides[i].className.replace(" showing", "");
        slide_nav[i].className = slide_nav[i].className.replace(" active", "");
    }
    currentSlide = (slides.length + id) % slides.length;
    slides[currentSlide].style.display = "block";
    slides[currentSlide].className += " showing";
    slide_nav[currentSlide].className += " active";
    resetInterval();
}

function nextSlide() {
    showSlide(currentSlide + 1);
}

function prevSlide() {
    showSlide(currentSlide - 1);
}

</script>
