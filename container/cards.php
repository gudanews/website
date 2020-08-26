<?php

require_once SITE_ROOT.'php/include.php';

$url_lang = '';
if (isset($lang)) {
    $url_lang = '&lang=1';
}

$RECORD_PER_PAGE = 40;
$MAX_TITLE_LENGTH = 88;
$MAX_SNIPPET_LENGTH = 156;

$day_minus_2d = date('Y-m-d', strtotime('-2 days'));
$day_minus_2w = date('Y-m-d', strtotime('-14 days'));

$pageno = $_POST['pageno'] ?? 1 ;
$offset = ($pageno - 1) * $RECORD_PER_PAGE;

$card_count = 0;

# QUERY RESULT
$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = <<<SQL
    SELECT id, datetime_created, datetime_updated FROM news WHERE datetime_created > '$day_minus_2d'
    AND is_indexed ORDER BY datetime_created DESC LIMIT $offset, $RECORD_PER_PAGE
SQL;
if (isset($q)) {
    $sql = <<<SQL
    SELECT id, datetime_created, datetime_updated FROM news WHERE datetime_created > '$day_minus_2w' AND
    title LIKE '%$q%' OR snippet LIKE '%$q%' ORDER BY datetime_created DESC LIMIT $offset, $RECORD_PER_PAGE
SQL;
}
elseif (isset($lang)) {
    $sql = <<<SQL
    SELECT id, datetime_created, datetime_updated FROM news WHERE datetime_created > '$day_minus_2d' AND
    translation_id > 0 ORDER BY datetime_created DESC LIMIT $offset, $RECORD_PER_PAGE
SQL;
}
$result_cards = $conn->query($sql);

if ($result_cards->num_rows > 0) {
    while($row_cards = $result_cards->fetch_assoc()) {
        $cards_id = $row_cards['id'];
        $sql = <<<SQL
    SELECT title, uuid, news.datetime_created as datetime_created, news.url as url, snippet, image.thumbnail as image,
    source.short_name as source, color FROM news INNER JOIN image ON image_id = image.id INNER JOIN source 
    ON source_id = source.id WHERE news.id = $cards_id
SQL;
        if (isset($lang)) {
            $sql = <<<SQL
    SELECT translation.title as title, uuid, news.datetime_created as datetime_created, news.url as url,
    translation.snippet as snippet, image.thumbnail as image, source.short_name as source, color 
    FROM news INNER JOIN image ON image_id = image.id INNER JOIN source ON source_id = source.id
    INNER JOIN translation ON translation_id = translation.id WHERE news.id = $cards_id
SQL;
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $current_id = $card_count;
            $image = array();
            $current_title = array();
            $current_snippet = array();
            $current_source = array();
            $current_source_color = array();
            $current_url = array();
            $current_news_id = array();
            $current_datetime = array();
            while($row = $result->fetch_assoc()) {
                $image[] = $row['image'];
                $current_news_id[] = $row['uuid'];
                $current_title[] = string_crop($row['title'], $MAX_TITLE_LENGTH);
                $current_snippet[] = string_crop($row['snippet'], $MAX_SNIPPET_LENGTH);
                $current_source[] = $row['source'];
                $current_source_color[] = $row['color'];
                $current_url[] = $row['url'];
                $current_datetime[] = strtoupper(date('D M d, h:i A', strtotime($row['datetime_created'])));
            }
            $current_image = $image[0];
            if (!empty($current_image)) {
                include 'card/card_with_image.php';
            }
            else {
                include 'card/card_without_image.php';
            }
            $card_count += 1;
        }
    }
}
$conn->close();

echo <<<EOL
<script>
    function isImageCard(index) {
        var cards = document.querySelectorAll('div.cards-container > div');
        var card_type = cards[index].className;
        return card_type == 'image-card';
    }
    function showImageCard(index, current) {
        var image_classname = 'card-'.concat(index, '-image');
        var heading_classname = 'card-'.concat(index, '-heading');
        var date_classname = 'card-'.concat(index, '-date');
        var source_classname = 'card-'.concat(index, '-source');
        var images = document.getElementsByClassName(image_classname);
        var headings = document.getElementsByClassName(heading_classname);
        var dates = document.getElementsByClassName(date_classname);
        var sources = document.getElementsByClassName(source_classname);
        for (i = 0; i < headings.length; i++ ) {
            images[i].style.display = 'none';
            headings[i].style.display = 'none';
            dates[i].style.display = 'none';
            sources[i].classList.remove('active');
            if (current == i) {
                images[current].style.display = 'block';
                headings[current].style.display = 'block';
                dates[current].style.display = 'block';
                sources[current].classList.add('active');
            }
        }
    }
    function showTextCard(index, current) {
        var heading_classname = 'card-'.concat(index, '-heading');
        var snippet_classname = 'card-'.concat(index, '-snippet');
        var date_classname = 'card-'.concat(index, '-date');
        var source_classname = 'card-'.concat(index, '-source');
        var headings = document.getElementsByClassName(heading_classname);
        var snippets = document.getElementsByClassName(snippet_classname);
        var dates = document.getElementsByClassName(date_classname);
        var sources = document.getElementsByClassName(source_classname);
        for (i = 0; i < headings.length; i++ ) {
            headings[i].style.display = 'none';
            snippets[i].style.display = 'none';
            dates[i].style.display = 'none';
            sources[i].classList.remove('active');
            if (current == i) {
                headings[current].style.display = 'block';
                snippets[current].style.display = 'block';
                dates[current].style.display = 'block';
                sources[current].classList.add('active');
            }
        }
    }
    var initCardIndex = 0;
    for (x = 0; x < $card_count; x++) {
        if (isImageCard(x)) {
            showImageCard(x, initCardIndex);
        }
        else {
            showTextCard(x, initCardIndex);
        }
    }

</script>
EOL;
?>
