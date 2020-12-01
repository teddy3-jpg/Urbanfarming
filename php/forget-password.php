<?php include('server.php') ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Teddy3">
  <title>Sign In</title>
  <link rel="shortcut icon" href="../img/logo.png" />
  <link rel="canonical" href="">

  <!-- Bootstrap core CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
   
  <link href="../css/style.css" rel="stylesheet">
</head>

<body style="background-color: #303847;" class="text-center">
  <div class="container">

    <header><img src="../img/header.png" id="im" alt=""></header>
    <div class="container" style="background-image: url('../img/back.png'); background-color: #e5e5e5;">
      <form class="form-signin" method="post" action="login.php">
      <?php include('errors.php'); ?>
      <br><br>
        <center><img src="..//img/logo.png" alt="" width="72" height="72">
          <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
          <div class="col-md-6 mb-3"> <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
          </div>
          <br>
          <div class="col-md-6 mb-3"> <label for="inputPassword" class="sr-only">New Password</label>
            <input type="password" id="inputPassword" name="newpassword" class="form-control" placeholder="New Password" required autofocus></div>
           <!-- <a href="forgote.html">Forgote Password?</a>-->
           <div class="col-md-6 mb-3"> <label for="inputPassword" class="sr-only">Confirm Password</label>
            <input type="password" id="inputPassword" name="confirmpassword" class="form-control" placeholder="Confirm password" required autofocus></div>
           <!-- <a href="forgote.html">Forgote Password?</a>-->
            <div class="checkbox mb-3">
            
              <input type="checkbox" value="remember-me"> Remember me

          </div>
          <button class="btn btn-success" type="submit" value="reset" name="reset">Reset</button>
          
        </center>
      </form>Not have an account?
      <center> <a href="login.php"><button class="btn btn-primary" type=" ">Cancel</button></a></center>
 <br>

    </div>
    <footer style="background: url('../img/back.png'); background-color: #fff;">
            <br>
            <center>&copy;2020 All rights reserved. @Urban Farming System | Developers: Teddy3 | Mrkan-Hex</center><br>

        </footer>
  </div>
  <script src="../bootstrap/js/jquery-3.5.1.slim.js"></script>
    <!-- Popper.JS -->
    <script src="../bootstrap/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../bootstrap/js/solid.js"></script>
    <script src="../bootstrap/js/fontawesome.js"></script>
</body>

</html>