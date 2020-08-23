<?php

$MAX_RECORD = 40;
$MAX_TITLE_LENGTH = 88;
$MAX_SNIPPET_LENGTH = 156;

$day_minus_2d = date('Y-m-d', strtotime('-2 days'));
$day_minus_2w = date('Y-m-d', strtotime('-14 days'));

$title = array();
$snippet = array();
$image_path = array();
$url = array();
$source = array();
$source_color = array();
$news_id = array();
$row_count = 0;
$datetime_created = array();

# QUERY RESULT
$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id FROM news WHERE datetime_created > '" . $day_minus_2d . "' ORDER BY datetime_created DESC LIMIT " . $MAX_RECORD;
if (isset($q)) {
    $sql = "SELECT id FROM news WHERE datetime_created > '" . $day_minus_2w . "' AND title LIKE '%" . $q . "%' OR snippet LIKE '%" . $q . "%' ORDER BY datetime_created DESC LIMIT " . $MAX_RECORD;
}
elseif (isset($lang)) {
    $sql = "SELECT id FROM news WHERE datetime_created > '" . $day_minus_2d . "' AND translation_id > 0 ORDER BY datetime_created DESC LIMIT " . $MAX_RECORD;
}
$result_cards = $conn->query($sql);

if ($result_cards->num_rows > 0) {
    while($row_cards = $result_cards->fetch_assoc()) {
        $cards_id = $row_cards["id"];
        $sql = "SELECT title, uuid, news.datetime_created as datetime_created, news.url as url, snippet, image.url as image, source.short_name as source, color FROM news INNER JOIN image ON image_id = image.id INNER JOIN source ON source_id = source.id WHERE news.id = " . $cards_id;
        if (isset($lang)) {
            $sql = "SELECT translation.title as title, uuid, news.datetime_created as datetime_created, news.url as url, translation.snippet as snippet, image.url as image, source.short_name as source, color FROM news INNER JOIN image ON image_id = image.id INNER JOIN source ON source_id = source.id INNER JOIN translation ON translation_id = translation.id WHERE news.id = " . $cards_id;
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $news_id[] = array();
            $image_path[] = array();
            $title[] = array();
            $snippet[] = array();
            $source[] = array();
            $source_color[] = array();
            $url[] = array();
            $datetime_created[] = array();
            while($row = $result->fetch_assoc()) {
                $news_id[$row_count][] = $row["uuid"];
                $image_path[$row_count][] = $row["image"];
                $title[$row_count][] = string_crop($row["title"], $MAX_TITLE_LENGTH);
                #$title[$row_count][] = translate_to_chinese($row["heading"]);
                $snippet[$row_count][] = string_crop($row["snippet"], $MAX_SNIPPET_LENGTH);
                $source[$row_count][] = $row["source"];
                $source_color[$row_count][] = $row["color"];
                $url[$row_count][] = $row["url"];
                $datetime_created[$row_count][] = $row["datetime_created"];
            }
            $row_count += 1;
        }
    }
}
$conn->close();

$url_lang = "";
if (isset($lang)) {
    $url_lang = "&lang=1";
}

for ($card=0; $card < $row_count; $card++) {
    echo "<div class=\"cards-container\">";
    $current_id = $card;
    $current_image =$image_path[$card][0];
    $current_title = $title[$card];
    $current_snippet = $snippet[$card];
    $current_source = $source[$card];
    $current_source_color = $source_color[$card];
    $current_url = $url[$card];
    $current_news_id = $news_id[$card];
    $current_datetime = $datetime_created[$card];
    if (!empty($current_image)) {
        include "card/card_with_image.php";
    }
    else {
        include "card/card_without_image.php";
    }
    echo "</div>";
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
