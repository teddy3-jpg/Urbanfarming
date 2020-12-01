<?php include('server.php')?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Teddy3">
    <title>Sign Up</title>
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
            <center><img src="img/logo.png" alt="" width="72" height="72"></center>
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <form class="needs-validation" method="POST" action="signup.php" enctype="multipart/form-data"
                oninput='confirmPassword.setCustomValidity(password.value != confirmPassword.value ? "password no match" : "" )'
                novalidate action="signup.php"> <?php include('php/errors.php'); ?>
                <center>
                    <div class="col-md-6 mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>"
                            id="username" placeholder="Username" value="" required>
                        <div class="invalid-feedback">
                            Please enter a valid username!!!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email<span class="text-muted"></span></label>
                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" id="email"
                            placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email!!!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><span class="glyphicon glyphicon-eye-open"></span></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password_1" placeholder=""
                                required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmPassword">Confirm Password </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><span class="glyphicon glyphicon-eye-open"></span></span>
                            </div>
                            <input type="password" class="form-control" id="confirmPassword" name="password_2"
                                placeholder="" required>
                            <div class="invalid-feedback failed">
                                Password Mis-match!!! Confirmation Failed!
                            </div>
                        </div>
                    </div>
                </center>
                <a href="login.php"><button class="btn btn-primary" type="button">Back</button></a><button class="btn btn-success" type="submit" name="submit">Continue </button>
            </form>

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