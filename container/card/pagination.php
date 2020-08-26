<?php

require_once '/include.php';
$RECORD_PER_PAGE = 20;
$MAX_TITLE_LENGTH = 88;
$MAX_SNIPPET_LENGTH = 156;

$day_minus_2d = date('Y-m-d', strtotime('-2 days'));
$day_minus_2w = date('Y-m-d', strtotime('-14 days'));

$pageno = $_POST['pageno'];
$offset = ($pageno - 1) * $RECORD_PER_PAGE;

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
$sql = <<<SQL
SELECT id, datetime_created, datetime_updated FROM news WHERE datetime_created > '$day_minus_2d'
    ORDER BY datetime_created DESC LIMIT $offset, $RECORD_PER_PAGE, 
SQL;
if (isset($q)) {
    $sql = <<<SQL
SELECT id, datetime_created, datetime_updated FROM news WHERE datetime_created > '$day_minus_2w' AND
    title LIKE '%" . $q . "%' OR snippet LIKE '%" . $q . "%' ORDER BY datetime_created DESC LIMIT $offset, $RECORD_PER_PAGE
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
    $news_id[] = array();
    $image_path[] = array();
    $title[] = array();
    $snippet[] = array();
    $source[] = array();
    $source_color[] = array();
    $url[] = array();
    $datetime_created[] = array();
    while($row_cards = $result_cards->fetch_assoc()) {
        $cards_id = $row_cards["id"];
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
            while($row = $result->fetch_assoc()) {
                $news_id[$row_count][] = $row["uuid"];
                $image_path[$row_count][] = $row["image"];
                $title[$row_count][] = string_crop($row["title"], $MAX_TITLE_LENGTH);
                #$title[$row_count][] = translate_to_chinese($row["heading"]);
                $snippet[$row_count][] = string_crop($row["snippet"], $MAX_SNIPPET_LENGTH);
                $source[$row_count][] = $row["source"];
                $source_color[$row_count][] = $row["color"];
                $url[$row_count][] = $row["url"];
                $datetime_created[$row_count][] = strtoupper(date("D M d, h:i A", strtotime($row["datetime_created"])));
            }
            $row_count += 1;
        }
    }
}
$conn->close();

?>