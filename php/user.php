<?php

// Create connection
$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);
// Check connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

$sql = "INSERT INTO user (ip_address, request) VALUES ('$ip', 1) ON DUPLICATE KEY UPDATE request = request + 1";

$result = $conn->query($sql);

$conn->close();
?>
