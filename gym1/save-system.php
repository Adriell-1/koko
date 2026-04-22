<?php
include "connect.php";

$refresh = $_POST['refresh'];
$sensitivity = $_POST['sensitivity'];
$speed = $_POST['speed'];
$temp = $_POST['temp'];
$load = $_POST['load'];

$sql = "INSERT INTO settings (id, refresh_rate, sensitivity, speed, temp, load_capacity)
VALUES (1, '$refresh', '$sensitivity', '$speed', '$temp', '$load')
ON DUPLICATE KEY UPDATE
refresh_rate='$refresh',
sensitivity='$sensitivity',
speed='$speed',
temp='$temp',
load_capacity='$load'";

if ($conn->query($sql) === TRUE) {
    echo "System saved!";
} else {
    echo "Error: " . $conn->error;
}
?>