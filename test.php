<?php

$day_minus_2d = date('Y-m-d', strtotime('-20 days'));

$date_today = date('Y-m-d');


$servername = "192.168.1.49";
$username = "gudaman";
$password = "GudaN3w2";
$name = "gudanews";

$conn = new mysqli($servername, $username, $password, $name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT heading,snippet FROM news_headline WHERE datetime BETWEEN '". $day_minus_2d . "' AND '". $date_today ."' ORDER BY quality, datetime LIMIT 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
    echo "Title: " . $row["heading"]. "\n";
    echo "Snippet: " . $row["snippet"]. "\n\n";
  }
} else {
  echo "No Results";
}
$conn->close();
?>
