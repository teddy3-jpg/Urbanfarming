<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }else{($username=$_SESSION['username']);}
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
 // $page = $_SERVER['PHP_SELF'];
  //$sec = "20";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!--<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">-->
    <meta name="author" content="Teddy3">
    <title>Iot Based Urban Farming System</title>
    <link rel="shortcut icon" href="../img/logo.png" />
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
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
    #b {
    background-image: url('../img/back.png'); 
    background-color: #e5e5e5;
    }
    body{
         background-color: #303847;
    }
    </style>
    <!-- Custom styles for this template -->

</head>

<body>

    <div class="container">
        <header class="content" id="header">
            <img class="image-responsive" id="im" src="../img/header.png" alt="">
        </header>
        <?php  if (isset($_SESSION['username'])) : ?>
        <nav class="navbar navbar-expand-lg navbar-light   bg-light" style="background: url('../img/back.png');">

            <div class="container-fluid">
                <h2 id="i">Control Panel</h2>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true"
                    aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">

                    </ul>
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php"><span class="glyphicon glyphicon-home"></span>Display
                                Panel</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="control-panel.php"><span
                                    class="glyphicon glyphicon-tasks"></span>Control
                                Panel</a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="#"><span class="glyphicon glyphicon-user"></span>
                                <?php echo $username?></a>
                        </li> <?php  if (isset($_SESSION['username'])) : ?>
                        <li class="nav-item">

                            <a class="btn btn-sm btn-outline-secondary" href="control-panel.php?logout='1'">Logout</a></li>
                        <?php endif ?>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="border" id="b">
            <br>
            <div class="row mb-2" style="margin: 10px;">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-primary">
                                <h3 class="mb-0">Fan Turn ON | OFF </h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date1"></div>
                            <p class="card-text mb-auto" id="tempDiary1">You can turn the fan or cooler on & off Manualy
                                to
                                ontrol temperature and humidity</p>

                            <form action="" method="get">
                                <button type="button" id="turn-on-fan" class="btn btn-success">Turn ON</button>
                                <button type="button" id="turn-off-fan" class="btn btn-info">Turn OFF</button></form>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="../img/temperature.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>



                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-primary">
                                <h3 class="mb-0">Turn ON | OFF Heater</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date2"></div>
                            <p class="mb-auto">You can turn on or off the heater to control temperature and humidity</p>
                            <form action="" method="get">
                                <button type="button" id="turn-on-heater" class="btn btn-success">Turn ON</button>
                                <button type="button" id="turn-off-heater" class="btn btn-info">Turn OFF</button></form>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="../img/humidity.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>


            </div>
            <div class="row mb-2" style="margin: 10px;">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-primary">
                                <h3 class="mb-0">Turn ON | OFF Light</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date3"></div>
                            <p class="mb-auto">You can Turn Artificial light on and of manually to adjust the light
                                system</p>
                            <form action="" method="get">
                                <button type="button" id="turn-on-light" class="btn btn-success">Turn ON</button>
                                <button type="button" id="turn-off-light" class="btn btn-info">Turn OFF</button></form>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="../img/light-on.png" alt="" class="bd-placeholder-img" width="200" height="250">
                       
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-primary">
                                <h3 class="mb-0">Turn On Pump</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date4"></div>
                            <p class="mb-auto">You Can turn on or off the water pump manually to control moisture level
                                of the soil</p>
                            <form action="" method="get">
                                <button type="button" id="turn-on-pump" class="btn btn-success">Turn ON</button>
                                <button type="button" id="turn-off-pump" class="btn btn-info">Turn OFF</button></form>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="../img/moisture.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>

            </div>


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
    <script src="../js/jquery.min.js">
    
    </script>
    <?php endif ?>
</body>


<script>
document.getElementById('turn-on-fan').addEventListener('click', function() {
    var url = "http://localhost/Urbanfarmingsystem.com/php/update.php?id=1&port=fan on";
    $.getJSON(url, function(data) {
        console.log(data);
    });
});
document.getElementById('turn-off-fan').addEventListener('click', function() {
    var url = "http://localhost/Urbanfarmingsystem.com/php/update.php?id=1&port=fan off";
    $.getJSON(url, function(data) {
        console.log(data);
    });
});
document.getElementById('turn-on-heater').addEventListener('click', function() {
    var url = "http://localhost/Urbanfarmingsystem.com/php/update.php?id=2&port=heater on";
    $.getJSON(url, function(data) {
        console.log(data);
    });
});
document.getElementById('turn-off-heater').addEventListener('click', function() {
    var url = "http://localhost/Urbanfarmingsystem.com/php/update.php?id=2&port=heater off";
    $.getJSON(url, function(data) {
        console.log(data);
    });
});
document.getElementById('turn-on-light').addEventListener('click', function() {
    var url = "http://localhost/Urbanfarmingsystem.com/php/update.php?id=3&port=light on";
    $.getJSON(url, function(data) {
        console.log(data);
    });
});
document.getElementById('turn-off-light').addEventListener('click', function() {
    var url = "http://localhost/Urbanfarmingsystem.com/php/update.php?id=3&port=light off";
    $.getJSON(url, function(data) {
        console.log(data);
    });
});
document.getElementById('turn-on-pump').addEventListener('click', function() {
    var url = "http://localhost/Urbanfarmingsystem.com/php/update.php?id=4&port=pump on";
    $.getJSON(url, function(data) {
        console.log(data);
    });
});
document.getElementById('turn-off-pump').addEventListener('click', function() {
    var url = "http://localhost/Urbanfarmingsystem.com/php/update.php?id=4&port=pump off";
    $.getJSON(url, function(data) {
        console.log(data);
    });
});
/*window.onload = function() {
    loaddata();
};

function loaddata() {
    var url = "http://localhost/Urbanfarmingsystem.com/read.php";
    $.getJSON(url, function(data) {
        var val = data;
        var temper1 = (data['weather'][(Object.keys(data['weather']).length) - 1]['temp1']);
        var temper2 = (data['weather'][(Object.keys(data['weather']).length) - 1]['temp2']);
        var humid1 = (data['weather'][(Object.keys(data['weather']).length) - 1]['hum1']);
        var humid2 = (data['weather'][(Object.keys(data['weather']).length) - 1]['hum2']);
        document.getElementById("temp1").innerHTML = "" + temper1 + " &#x26AC C";
        document.getElementById("temp2").innerHTML = "" + temper2 + " &#x26AC C";
        document.getElementById("hum1").innerHTML = "" + humid1;
        document.getElementById("hum2").innerHTML = "" + humid2;
        console.log(data['weather'][(Object.keys(data['weather']).length) - 1]['temp1']);
    });

}
window.setInterval(function() {
    loaddata();
}, 5000);
*/

var date = new Date();
document.getElementById("date1").innerHTML = date;
document.getElementById("date2").innerHTML = date;
document.getElementById("date3").innerHTML = date;
document.getElementById("date4").innerHTML = date;

</script>

</html>