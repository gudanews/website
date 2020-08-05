<?php
$MAX_RECORD = 40;
$MAX_HEADING_LENGTH = 88;
$MAX_SNIPPET_LENGTH = 156;
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
$source_bgcolor = array();
$row_count = 0;

# QUERY RESULT
$conn = new mysqli($servername, $username, $password, $name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id FROM headline WHERE datetime > '" . $day_minus_2d . "' ORDER BY datetime DESC LIMIT " . $MAX_RECORD;
$result_headline = $conn->query($sql);
if ($result_headline->num_rows > 0) {
    while($row_headline = $result_headline->fetch_assoc()) {
        $headline_id = $row_headline["id"];
        #$sql = "SELECT heading, snippet, news.url as url, image.url as image, source.name as source, bg_color FROM news INNER JOIN image ON image_id = image.id INNER JOIN source ON source_id = source.id ORDER BY RAND() LIMIT 3";
        $sql = "SELECT heading, news.url as url, snippet, image.thumbnail as image, source.name as source, bg_color FROM news INNER JOIN image ON image_id = image.id INNER JOIN source ON source_id = source.id WHERE headline_id = " . $headline_id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $image_path[] = array();
            $heading[] = array();
            $snippet[] = array();
            $source[] = array();
            $source_bgcolor[] = array();
            $url[] = array();
            while($row = $result->fetch_assoc()) {
                $image_path[$row_count][] = $row["image"];
                $heading[$row_count][] = string_crop($row["heading"], $MAX_HEADING_LENGTH);
                #$heading[$row_count][] = translate_to_chinese($row["heading"]);
                $snippet[$row_count][] = string_crop($row["snippet"], $MAX_SNIPPET_LENGTH);
                $source[$row_count][] = $row["source"];
                $source_bgcolor[$row_count][] = $row["bg_color"];
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
    for ($i=0; $i < $row_count; $i++) {
        if (!empty($image_path[$i][0])) {
            require_once "single_card_with_image.php";
            build_single_card_with_image($i, $image_path[$i][0], $heading[$i], $source[$i], $source_bgcolor[$i], $url[$i]);
        }
        else {
            require_once "single_card_without_image.php";
            build_single_card_without_image($i, $heading[$i], $snippet[$i], $source[$i], $source_bgcolor[$i], $url[$i]);
        }
    }
echo <<<EOL
<script>
    var initCardIndex = 0;
    for (x = 0; x < $row_count; x++) {
        showCard(x, initCardIndex);
    }

    function showCard(index, current) {
        var image_classname = "card-".concat(index, "-image");
        var heading_classname = "card-".concat(index, "-heading");
        var snippet_classname = "card-".concat(index, "-snippet");
        var source_classname = "card-".concat(index, "-source");
        var images = document.getElementsByClassName(image_classname);
        var headings = document.getElementsByClassName(heading_classname);
        var snippets = document.getElementsByClassName(snippet_classname);
        var sources = document.getElementsByClassName(source_classname);
        for (i = 0; i < images.length; i++) {
            images[i].style.display = "none";
        }
        for (i = 0; i < headings.length; i++) {
            headings[i].style.display = "none";
        }
        for (i = 0; i < snippets.length; i++) {
            snippets[i].style.display = "none";
        }
        for (i = 0; i < sources.length; i++) {
            sources[i].classList.remove("active");
        }
        if (current < images.length) {
            images[current].style.display = "block";
        }
        if (current < headings.length) {
            headings[current].style.display = "block";
        }
        if (current < snippets.length) {
            snippets[current].style.display = "block";
        }
        if (current < sources.length) {
            sources[current].classList.add("active");
        }
    }
</script>
EOL;
?>
