<?php

$MAX_HEADING_LENGTH = 88;
$MAX_SNIPPET_LENGTH = 156;
$servername = "192.168.1.49";
$username = "gudababy";
$password = "good";
$name = "gudanews";

# QUERY RESULT
$conn = new mysqli($servername, $username, $password, $name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT heading, snippet, news.url as url, image.url as image FROM news INNER JOIN image ON news.image_id = image.id WHERE news.uuid = '" . $uuid . "'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        #$sql = "SELECT heading, snippet, news.url as url, image.url as image, source.name as source, bg_color FROM news INNER JOIN image ON image_id = image.id INNER JOIN source ON source_id = source.id ORDER BY RAND() LIMIT 3";
        $image = $row["image"];
        $heading = string_crop($row["heading"], $MAX_HEADING_LENGTH);
        $snippet = string_crop($row["snippet"], $MAX_SNIPPET_LENGTH);
        $url[$row_count][] = $row["url"];
    }
}
$conn->close();

echo <<<EOL
    <div class="heading-news">
    $heading
    </div>
    <div class="image-news">
    <img src="$image"></img>
    </div>
    <div class="body-news">
    $snippet
    </div>
EOL;

?>
