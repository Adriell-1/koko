<?php
if (isset($_GET['signup'])) {
  echo "<script>alert('Account created successfully! Please login.');</script>";
}
?>

<?php
session_start();
include "database.php";


// ================= SIGNUP =================
if (isset($_POST['signup'])) {

  $email = $_POST['signup_email'];
  $pass = password_hash($_POST['signup_pass'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (email, password) VALUES ('$email', '$pass')";
  if ($conn->query($sql) === TRUE) {
    header("Location: auth.php?signup=success");
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// ================= LOGIN =================
if (isset($_POST['login'])) {

  $email = $_POST['login_email'];
  $pass = $_POST['login_pass'];

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    if (password_verify($pass, $user['password'])) {

      session_start();
      $_SESSION['user'] = $user['username'];

      // 🔥 REDIRECT TO HTML DASHBOARD
      header("Location: dashboard.html");
      exit;

    } else {
      echo "Wrong password";
    }

  } else {
    echo "User not found";
  }
}


// ================= LOGIN =================
if (isset($_POST['login'])) {

  $email = $_POST['login_email'];
  $pass = $_POST['login_pass'];

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    if (password_verify($pass, $user['password'])) {

      session_start();
      $_SESSION['user'] = $user['username'];

      // 🔥 REDIRECT TO HTML DASHBOARD
      header("Location: dashboard.html");
      exit;

    } else {
      echo "Wrong password";
    }

  } else {
    echo "User not found";
  }
}
?>