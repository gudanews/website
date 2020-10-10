<?php

# QUERY RESULT
$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = <<<SQL
    SELECT news.id as id, author, category.name as category, content, views, title, news.url as url, image.path as image,
    source.full_name as source, source.image_path as source_image, news.datetime_created as datetime FROM news
    INNER JOIN image ON news.image_id = image.id INNER JOIN category ON category.id = news.category_id
    INNER JOIN source ON source.id = news.source_id WHERE news.uuid = '$uuid'
SQL;
if ($lang == 1) {
    $sql = <<<SQL
    SELECT news.id as id, author, category.name as category, translation.content as content, views, translation.title, news.url as url,
    image.path as image, source.full_name as source, source.image_path as source_image,
    news.datetime_created as datetime FROM news
    INNER JOIN image ON news.image_id = image.id INNER JOIN translation ON news.translation_id = translation.id
    INNER JOIN category ON category.id = news.category_id INNER JOIN source ON source.id = news.source_id
    WHERE news.uuid = '$uuid'
SQL;
}
$result = $conn->query($sql);
if ($row = $result->fetch_assoc()) {
    $image = $row['image'];
    $title = $row['title'];
    $author = $row['author'];
    $category = ucfirst($row['category']);
    $source = $row['source'];
    $source_image = $row['source_image'];
    $datetime = strtoupper(date('D m/d, H:i', strtotime($row['datetime']))).' EST';
    $url = $row['url'];
    $views = $row['views'];
    $id = $row['id'];
    $content_raw = file_get_contents($row['content']);
//    $content_raw = file_get_contents("http://192.168.1.49/$row[content]");
    $content = '';
    if (!empty($content_raw)) {
        $content = '<p>' . str_replace("\n", '</p><p>', $content_raw) . '</p>';
    }
}
$last_access = $_COOKIE['last_access'] ?? time();
$cookie_duration = time() + (86400 * 30);
setcookie('last_access', time(), $cookie_duration, "/"); // 86400 = 1 day
if ((time() - $last_access) > 2) { // Adding 1 view per 2 seconds
    $sql = "UPDATE news SET views = views + 1 WHERE id = '$id'";
    $result = $conn->query($sql);
}
$conn->close();

include_once SITE_ROOT.'php/like.php';

$icon = ($like) ? 'fas' : 'far';

if(empty($author)){
    $author = "Unknown";
}
echo <<<EOL
<title>Gudanews - $title</title>
<div class='news-card-container'>
    <div class='news-card-title'>
        <p class='news-title'>$title</p>
    </div>
    <div class='news-card-metadata' horizontal layout>
        <div>
            <p class='news-source'>$source</p>
        </div>
        <div>
            <p class='news-datetime'>$datetime</p>
        </div>
    </div>
    <div class='news-card-image'>
        <img class='news-image' src='$image'></img>
        <figcaption>Image by $author via $source.</figcaption>
        <div class='news-card-author'>
        <strong>$category - $author</strong>
        </div>
    </div>
    <div class='news-card-content'>
        <p>$content</p>
    </div>
    <div class='news-card-info'>
        <div class='card-read-more'>
            <form action="$url" target="_blank">
        <input class="read-more-button" id="read-more-button1" type="submit" value="Read From Source" />
        </form>
        </div>
        <i class='fas fa-eye fa-1x'>&nbsp;&nbsp;$views&nbsp;&nbsp;
        </i>
        <a href='javascript:void(0)' onclick='dolike("$uuid")'>
            <i id='likes_icon' class='$icon fa-heart'>&nbsp;&nbsp;$count
            </i>
        </a>
    </div>
</div>
EOL;
?>

<script>
function dolike(uuid) {
	$.get('php/like.php?action=update&uuid=' + uuid, function(data){
            $('#likes_icon').html('&nbsp;&nbsp;' + data);
            $('#likes_icon').toggleClass('far fas')
	});
}
</script>
