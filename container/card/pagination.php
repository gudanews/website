<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once '../../php/include.php';

$RECORD_PER_PAGE = 10;
$MAX_TITLE_LENGTH = 88;
$MAX_SNIPPET_LENGTH = 156;

$day_minus_2d = date('Y-m-d', strtotime('-2 days'));
$day_minus_2w = date('Y-m-d', strtotime('-14 days'));

$pageno = $_POST['pageno'] ?? 1;
$lang = $_POST['lang'] ?? 0;
$q = $_POST['q'] ?? '';
$offset = ($pageno - 1) * $RECORD_PER_PAGE;

$card_count = $offset;

# QUERY RESULT
$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (empty($q)) {
    $sql = <<<SQL
    SELECT id, datetime_created, datetime_updated FROM news WHERE datetime_created > '$day_minus_2d'
    AND is_indexed ORDER BY datetime_created DESC LIMIT $offset, $RECORD_PER_PAGE
    SQL;
}
else {
    $sql = <<<SQL
    SELECT id, datetime_created, datetime_updated FROM news WHERE datetime_created > '$day_minus_2w' AND
    is_indexed AND title LIKE '%$q%' OR snippet LIKE '%$q%' ORDER BY datetime_created DESC LIMIT $offset, $RECORD_PER_PAGE
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
        if ($lang == 1) {
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
                $current_datetime[] = strtoupper(date('D m/d, H:i', strtotime($row['datetime_created']))).' EST';
            }
            $current_image = $image[0];
            if (!empty($current_image)) {
                include 'card_with_image.php';
            }
            else {
                include 'card_without_image.php';
            }
            $card_count += 1;
        }
    }
}
$conn->close();

?>
