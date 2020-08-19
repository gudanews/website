<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "header.php";

function string_crop($string, $length) {
    $string = strip_tags($string);
    if (strlen($string) > $length) {
        // truncate string
        $stringCut = substr($string, 0, $length);
        $endPoint = strrpos($stringCut, ' ');
        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= ' ...';
    }
    return $string;
}

include "container/container_top.php";

$MAX_HEADING_LENGTH = 88;
$MAX_SNIPPET_LENGTH = 156;
$servername = "192.168.1.49";
$username = "gudababy";
$password = "good";
$dbname = "gudanews";


$uuid = $_GET['uuid'];


# QUERY RESULT
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT news.id as id, views, title, snippet, news.url as url, image.url as image FROM news INNER JOIN image ON news.image_id = image.id WHERE news.uuid = '" . $uuid . "'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        #$sql = "SELECT heading, snippet, news.url as url, image.url as image, source.name as source, bg_color FROM news INNER JOIN image ON image_id = image.id INNER JOIN source ON source_id = source.id ORDER BY RAND() LIMIT 3";
        $image = $row["image"];
        $title = string_crop($row["title"], $MAX_HEADING_LENGTH);
        $snippet = string_crop($row["snippet"], $MAX_SNIPPET_LENGTH);
        $url = $row["url"];
        $views = $row["views"];
        $id = $row["id"];
        ###$userid = $row["userid"];
    }
}
$conn->close();
echo "$views";
echo <<<EOL
    <div class="content-news">
        <div class="heading-news">
        $title
        </div>
        <div class="image-news">
        <img src="$image"></img>
        </div>
        <div class="body-news">
        $snippet
        </div>
    </div>
EOL;

# QUERY RESULT
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id FROM user";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $userid = $row["id"];
    }
}
echo "$userid";
$conn->close();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE news SET views = views + 1 WHERE id = '" . $id . "'";
$result = $conn->query($sql);

$conn->close();
?>
<script>
function dolike(nid, uid) {
	$.get("?act=dolike&n_id="+nid+"&u_id="+uid, function(data){
        alert(data);
		// if(data == '0'){
		// 	alert('参数错误');
		// }
		// else if(data == '-1'){
		// 	alert('You have already liked');
		// }
		// else if(parseInt(data)>0){
		// 	$("#rlike_"+rid).html(data);
		// }
	});
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<button href="javascript:void(0)" onclick="dolike(<?php echo $id;?>, <?php echo $userid; ?>)">Like</button>

<?php
include "footer.php";

?>
