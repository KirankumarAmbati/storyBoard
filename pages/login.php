<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.css">

  </head>
  <body>
    <form action="../index.php" method="post" enctype="multipart/form-data">
      username : <input type="text" name="email" id="email">
      password : <input type="password" name="pwd" id="pwd">
      <button class="btn btn-success" type="submit" name="loginButton">Login</button>
      Don't have an account ? Create one <a href="register.php">here</a>
    </form>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
