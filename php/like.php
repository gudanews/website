<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once 'include.php';

//$user = $_GET['user'] ?? $user;
$uuid = $_GET['uuid'] ?? $uuid;
$action = $_GET['action'] ?? 'view';

# QUERY RESULT
$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($action == 'update') {
    $sql = <<<SQL
        INSERT INTO news_likes (news_id, user_id) SELECT news.id, user.id 
        FROM news, user WHERE user.ip_address = '$ip' AND news.uuid = '$uuid'
        ON DUPLICATE KEY UPDATE news_likes.news_id = 0
    SQL;
    $result = $conn->query($sql);
    $sql = 'DELETE FROM news_likes WHERE news_id = 0';
    $result = $conn->query($sql);
}
else { // $action = 'view'
    $sql = <<<SQL
        SELECT COUNT(*) as count FROM news_likes INNER JOIN news ON
        news.id = news_likes.news_id INNER JOIN user ON user.id = news_likes.user_id
        WHERE news.uuid = '$uuid' AND user.ip_address = '$ip';
    SQL;
    if ($result = $conn->query($sql)) {
        $like = $result->fetch_row()[0];
        echo $like . ',';
    }
}
$sql = <<<SQL
    SELECT COUNT(*) as count FROM news_likes INNER JOIN news ON
    news.id = news_likes.news_id WHERE news.uuid = '$uuid';
SQL;
if ($result = $conn->query($sql)) {
    $count = $result->fetch_row()[0];
}

$conn->close();

echo $count;

?>