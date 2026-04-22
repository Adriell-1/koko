<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "gym_ems";

// create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>