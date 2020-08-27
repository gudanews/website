<?php

require_once SITE_ROOT.'php/include.php';

# QUERY RESULT
$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = <<<SQL
    SELECT news.id as id, content, views, title, news.url as url, image.path as image FROM news 
    INNER JOIN image ON news.image_id = image.id WHERE news.uuid = '$uuid'
SQL;
if ($lang == 1) {
    $sql = <<<SQL
    SELECT news.id as id, translation.content as content, views, translation.title, news.url as url,
    image.path as image FROM news INNER JOIN image ON news.image_id = image.id INNER JOIN translation
    ON news.translation_id = translation.id WHERE news.uuid = '$uuid'
SQL;
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $image = $row['image'];
        $title = $row['title'];
        $url = $row['url'];
        $views = $row['views'];
        $id = $row['id'];
        $content_raw = file_get_contents($row['content']);
//        $content_raw = file_get_contents("http://192.168.1.49/$row[content]");
	$content = '';
	if (!empty($content_raw)) {
            $content = '<p>' . str_replace('\n', '</p><p>', $content_raw) . '</p>';
	}
    }
}
$conn->close();

echo <<<EOL
<div class='news-card-container'>
    <div class='news-card-title'>
        <p class='news-title'>$title</p>
    </div>
    <div class='news-card-image'>
        <img class='news-image' src='$image'></img>
    </div>
    <div class='news-card-content'>
        <p>$content</p>
    </div>
    <div class='news-card-info'>
        <i class='fas fa-eye fa-1x'>&nbsp;$views&nbsp;</i>
        <button href='javascript:void(0)' onclick=''>Like</button>
    </div>
</div>
EOL;
?>
<?php
# QUERY RESULT
$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = 'SELECT id FROM user';

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $userid = $row['id'];
    }
}
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE news SET views = views + 1 WHERE id = '$id'";
$result = $conn->query($sql);

$conn->close();
?>
<script>
function dolike(nid, uid) {
	$.get('?act=dolike&n_id='+nid+'&u_id='+uid, function(data){
        alert(data);
		// if(data == '0'){
		// 	alert('参数错误');
		// }
		// else if(data == '-1'){
		// 	alert('You have already liked');
		// }
		// else if(parseInt(data)>0){
		// 	$('#rlike_'+rid).html(data);
		// }
	});
}
</script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

