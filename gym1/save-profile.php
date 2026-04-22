<?php
include "database.php";

$name = $_POST['name'];
$email = $_POST['email'];
$role = $_POST['role'];

$sql = "INSERT INTO profile (id, name, email, role)
VALUES (1, '$name', '$email', '$role')
ON DUPLICATE KEY UPDATE
name='$name', email='$email', role='$role'";

if ($conn->query($sql) === TRUE) {
    echo "Profile saved!";
} else {
    echo "Error: " . $conn->error;
}
?>