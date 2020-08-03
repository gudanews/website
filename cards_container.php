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
$body = array();
$source = array();
$row_count = 0;

# QUERY RESULT
$conn = new mysqli($servername, $username, $password, $name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, snippet FROM headline WHERE image_id > 0 AND datetime > '" . $day_minus_2d . "' ORDER BY datetime DESC LIMIT " . $MAX_RECORD;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $headline_id = $row["id"];
        #$sql = "SELECT heading, body, news.url as url, image.url as image, source.name as source FROM news INNER JOIN image ON image_id = image.id INNER JOIN source ON source_id = source.id WHERE image.id > 0 LIMIT 3";
        $sql = "SELECT heading, body, news.url as url, image.url as image, source.name as source FROM news INNER JOIN image ON image_id = image.id INNER JOIN source ON source_id = source.id WHERE headline_id = " . $headline_id;
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $image_path[] = array();
            $heading[] = array();
            $snippet[] = array();
            $body[] = array();
            $source[] = array();
            $url[] = array();
            while($r = $res->fetch_assoc()) {
                $image_path[$row_count][] = $r["image"];
                $heading[$row_count][] = $r["heading"];
                $snippet[$row_count][] = $row["snippet"];
                $body[$row_count][] = $r["body"];
                $source[$row_count][] = $r["source"];
                $url[$row_count][] = $r["url"];
            }
            $row_count += 1;
        }
    }
}
$conn->close();
######### END OF DB Connection
?>


<div class="cards_container">
<?php
    for ($i=0; $i < $row_count; $i++) {
      if (!empty($image_path[$i])) {
        require_once "single_card_with_image.php";
        build_single_card_with_image($image_path[$i], $url[$i], $heading[$i], $source[$i]);
      }
      else {
        include "single_card_without_image.php";
      }
    }
?>
