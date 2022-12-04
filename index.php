<?php
session_start();
if ( !(empty($_SESSION['name'])) ) header("Location: http://localhost/social/user/index.php");

// session_destroy();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
 
<div class="container">
  <div class="left">
    <div class="header">
      <h2 class="animation a1">Welcome Back</h2>
      <h4 class="animation a2">Log in to your account using email and password</h4>
    </div>

      <form action="connect.php" method="POST" class="form">
        <input type="email" class="form-field animation a3" placeholder="Email Address" name="mail" required>
        <input type="password" class="form-field animation a4" placeholder="Password" name="pass" required>
        <p class="animation a5"><a href="signup/signup.php">Sign Up</a></p>
        <input type="submit" class="animation a6" value="Login" name="login">
      </form>

  </div>
  <div class="right"></div>
</div>

</body>
</html>