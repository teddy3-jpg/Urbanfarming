<?php include('server.php') ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Teddy3">
  <title>Sign In</title>
  <link rel="shortcut icon" href="img/logo.png" />
  <link rel="canonical" href="">

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="text-center">
  <div class="container">

    <header><img src="img/header.png" id="im" alt=""></header>
    <div class="container" style="background-image: url('img/back.png');">
      <form class="form-signin" method="post" action="login.php">
      <?php include('php/errors.php'); ?>
        <center><img src="img/logo.png" alt="" width="72" height="72">
          <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
          <div class="col-md-6 mb-3"> <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
          </div>
          <br>
          <div class="col-md-6 mb-3"> <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required></div>
            <a href="forgote.html">Forgote Password?</a>
            <div class="checkbox mb-3">
            
              <input type="checkbox" value="remember-me"> Remember me

          </div>
          <button class="btn btn-success" type="submit" name="login">Sign in</button>
          
        </center>
      </form>Not have an account?
      <center> <a href="signup.php"><button class="btn btn-primary" type=" "> Sign up</button></a></center>
 

    </div>
    <footer style="background: url('img/back.png');">
      <br>
      <hr>
      <center>&copy;2020 All rights reserved. @Urban Farming Systems | Developer: Teddy3</center>
      <br>
    </footer>
  </div>
  <script src="bootstrap/js/jquery-3.5.1.slim.js"></script>
    <!-- Popper.JS -->
    <script src="bootstrap/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/solid.js"></script>
    <script src="bootstrap/js/fontawesome.js"></script>
</body>

</html>