<?php
session_start();
include "database.php";

<?php
if (isset($_GET['signup'])) {
  echo "<script>alert('Account created successfully! Please login.');</script>";
}                                               
?>
// ================= LOGIN =================


if (isset($_POST['login'])) {

    $email = $_POST['login_email'];
    $password = $_POST['login_pass'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['username'];

            // 🔥 REDIRECT TO DASHBOARD
            header("Location: dashboard.html");
            exit;
        } else {
            echo "<script>alert('Wrong password');window.location='index.php';</script>";
        }

    } else {
        echo "<script>alert('User not found');window.location='index.php';</script>";
    }
}


// ================= SIGNUP =================
if (isset($_POST['signup'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // check kung existing email
    $check = "SELECT * FROM users WHERE email='$email'";
    $checkResult = $conn->query($check);

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Email already exists');window.location='index.php';</script>";
        exit;
    }

    $sql = "INSERT INTO users (username, email, password)
            VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {

        // 🔥 IMPORTANT FIX: NO OUTPUT BEFORE HEADER
        header("Location: index.php?signup=success");
        exit;

    } else {
        echo "Error: " . $conn->error;
    }
}
?>