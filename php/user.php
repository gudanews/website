<?php

// Create connection
$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
// Check connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT id FROM user WHERE ip_address = '$ip'";

$id = 0;
if ($result = $conn->query($sql)) {
    $id = $result->fetch_row()[0];
}
if ($id > 0) {
    $sql = "UPDATE user SET request = request + 1 WHERE id = $id";
}
else {
    $sql = "INSERT INTO user (ip_address, request) VALUES ('$ip', 1)";
}
$result = $conn->query($sql);

$conn->close();
?>
