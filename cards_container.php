<?php
$MAX_RECORD = 10;
$servername = "192.168.1.49";
$username = "gudaman";
$password = "GudaN3w2";
$name = "gudanews";

$day_minus_2d = date('Y-m-d', strtotime('-2 days'));

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

$sql = "SELECT id, snippet FROM headline WHERE image_id > 0 AND datetime > '" . $day_minus_2d . "' ORDER BY datetime DESC LIMIT " . $MAX_RECORD;
$result_headline = $conn->query($sql);
if ($result_headline->num_rows > 0) {
    while($row_headline = $result_headline->fetch_assoc()) {
        $headline_id = $row_headline["id"];
        $sql = "SELECT heading, snippet, news.url as url, image.url as image, source.name as source FROM news INNER JOIN image ON image_id = image.id INNER JOIN source ON source_id = source.id WHERE image.id > 0 ORDER BY RAND() LIMIT 3";
        #$sql = "SELECT heading, news.url as url, snippet, image.url as image, source.name as source FROM news INNER JOIN image ON image_id = image.id INNER JOIN source ON source_id = source.id WHERE headline_id = " . $headline_id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $image_path[] = array();
            $heading[] = array();
            $snippet[] = array();
            $source[] = array();
            $url[] = array();
            while($row = $result->fetch_assoc()) {
                $image_path[$row_count][] = $row["image"];
                $heading[$row_count][] = $row["heading"];
                $snippet[$row_count][] = $row["snippet"];
                $source[$row_count][] = $row["source"];
                $url[$row_count][] = $row["url"];
            }
            $row_count += 1;
        }
    }
}
$conn->close();
?>



<div class="cards-container">
<?php
    for ($i=0; $i < count($image_path); $i++) {
      if (!empty($image_path[$i])) {
        require_once "single_card_with_image.php";
        build_single_card_with_image($i, $image_path[$i], $heading[$i], $source[$i], $url[$i]);
      }
      else {
        include "single_card_without_image.php";
      }
    }
echo <<<EOL
<script>
    var cardIndex = 0;
    for (x = 0; x < $row_count; x++) {
        showCard(x, 0);
    }

    function currentCard(index, n) {
        showCard(index, n);
    }

    function showCard(index, variant) {
        var image_classname = "card-".concat(index, "-image");
        var heading_classname = "card-".concat(index, "-heading");
        var source_classname = "card-".concat(index, "-source");
        var images = document.getElementsByClassName(image_classname);
        var headings = document.getElementsByClassName(heading_classname);
        var sources = document.getElementsByClassName(source_classname);
        if (variant < Math.min(images.length, headings.length, sources.length)) {
            for (i = 0; i < images.length; i++) {
                images[i].style.display = "none";
            }
            for (i = 0; i < headings.length; i++) {
                headings[i].style.display = "none";
            }
            for (i = 0; i < sources.length; i++) {
                sources[i].className = sources[i].className.replace(" active", "");
            }
            images[variant].style.display = "block";
            headings[variant].style.display = "block";
            sources[variant].className += " active";
        }
    }
</script>
EOL;
?>
