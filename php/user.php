<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
// Create connection
$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT IGNORE INTO user SET ip_address = '" . $ip . "'";
$result = $conn->query($sql);

$sql = "UPDATE user SET request = request + 1 WHERE ip_address = '" . $ip . "'";
$result = $conn->query($sql);

$conn->close();
?>