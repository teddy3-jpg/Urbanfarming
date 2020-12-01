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
    <link rel="shortcut icon" href="img/logo.png" />
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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

</head>

<body>

    <div class="container">
        <header class="content" id="header">
            <img class="image-responsive" id="im" src="img/header.png" alt="">
        </header>
        <?php  if (isset($_SESSION['username'])) : ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: url('img/back.png');">

            <div class="container-fluid">
                <h1 id="i">Urban Farming System</h1>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true"
                    aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">

                    </ul>
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php"><span class="glyphicon glyphicon-home"></span>Display
                                Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="control-panel.php"><span
                                    class="glyphicon glyphicon-tasks"></span>Control
                                Panel</a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="#"><span class="glyphicon glyphicon-user"></span>
                                <?php echo $username?></a>
                        </li> <?php  if (isset($_SESSION['username'])) : ?>
                        <li class="nav-iten">

                            <a class="btn btn-sm btn-outline-secondary" href="index.php?logout='1'">Logout</a></li>
                        <?php endif ?>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="main" id="terz1">
            <br>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-primary">
                                <h3 class="mb-0">Temperature Sensor 1</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 12</div>
                            <p class="card-text mb-auto" id="tempDiary1">The temperature value of this sensor is at
                                normal
                                state. </p>

                            <h1 id="temp1">25&#x26AC C </h1>

                            <!-- C to F   F=(9/5)*Tc+32=1.8Tc+32
                         F to C   C=(Tf-32)*5/9=0.5556(Tf-32) -->

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/temperature.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-primary">
                                <h3 class="mb-0">Temperature Sensor 2</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 12</div>
                            <p class="card-text mb-auto" id="tempDiary1">The temperature value of this sensor is at
                                normal
                                state. </p>

                            <h1 id="temp2">28&#x26AC C </h1>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/temperature.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row mb-2">


                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Humidity Sensor 1</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 11</div>
                            <p class="mb-auto">The humidity of the environment is normal</p>
                          <h1 id="hum1"></h1>
                            
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/humidity.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">

                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Humidity Sensor 2</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 11</div>
                            <p class="mb-auto">The humidity of the environment is normal</p>
                            <h1  id="hum2"></h1>
                           
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/humidity.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>

            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Moisture Sensor 1</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 11</div>
                            <p class="mb-auto">The Moisture of the environment is normal</p>
                            <h1 id="moisture1">400</h1>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/moisture.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Moisture Sensor 2</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 11</div>
                            <p class="mb-auto">The Moisture of the environment is normal</p>
                            <h1 id="moisture2">400</h1>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/moisture.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Light Sensor 1</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 11</div>
                            <p class="mb-auto">Light is </p>
                            <h1 id="light1">on</h1>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/light-on.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Light Sensor 2</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 11</div>
                            <p class="mb-auto">Light is </p>
                            <h1 id="light2" name>off</h1>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/light-off.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Water Level Sensor 1</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 11</div>
                            <p class="mb-auto">Water level value is </p>
                            <h1 id="water2">400ml</h1>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/waterl-level.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Water Level Sensor 2</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 11</div>
                            <p class="mb-auto">Water level vaulue is </p>
                            <h1 id="water2">600ml</h1>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/waterl-level.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Alarm Light</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 11</div>
                            <p class="mb-auto">Water level value is </p>
                            <h1 id="alarm1">Off</h1>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/waterl-level.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Alarm Sound</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date">Nov 11</div>
                            <p class="mb-auto">Water level vaulue is </p>
                            <h1 id="alarm2">Off</h1>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/waterl-level.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
            </div>
            <div id="terz"> The Status of environment is good.</div>
            <div class="table-responsive">
                <table class="table">
                    <thead style="background: url('img/back.png');">
                        <tr>
                            <th style="background: url('img/back.png');">Time Stamp</th>
                            <th>Temp1</th>
                            <th>Temp2</th>
                            <th>Hum1</th>
                            <th>Hum2</th>
                            <th>Ligh1</th>
                            <th>Ligh2</th>
                            <th>Water1</th>
                            <th>Water2</th>
                            <th>GasSe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>7:26</td>
                            <td>25</td>
                            <td>28</td>
                            <td>85</td>
                            <td>90</td>
                            <td>on</td>
                            <td>off</td>
                            <td>400</td>
                            <td>400</td>
                            <td>Detected</td>

                        </tr>
                        <tr>
                            <td>7:26</td>
                            <td>25</td>
                            <td>28</td>
                            <td>85</td>
                            <td>90</td>
                            <td>on</td>
                            <td>off</td>
                            <td>400</td>
                            <td>400</td>
                            <td>Detected</td>
                        </tr>
                        <tr>
                            <td>7:26</td>
                            <td>25</td>
                            <td>28</td>
                            <td>85</td>
                            <td>90</td>
                            <td>on</td>
                            <td>off</td>
                            <td>400</td>
                            <td>400</td>
                            <td>not Detected</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <footer style="background: url('img/back.png');">
            <br>
            <center>&copy;2020 All rights reserved. @Urban Farming Systems | Developer: Teddy3</center><br>

        </footer>
    </div>

    <script src="bootstrap/js/jquery-3.5.1.slim.js"></script>
    <!-- Popper.JS -->
    <script src="bootstrap/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/solid.js"></script>
    <script src="bootstrap/js/fontawesome.js"></script>
    <script src="js/jquery.min.js">s</script>
    <?php endif ?>
</body>


<script>
window.onload = function() {
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
        document.getElementById("temp1").innerHTML =""+ temper1 +" &#x26AC C";
        document.getElementById("temp2").innerHTML =""+  temper2 + " &#x26AC C";
        document.getElementById("hum1").innerHTML =""+  humid1;
        document.getElementById("hum2").innerHTML =""+  humid2;
        console.log(data['weather'][(Object.keys(data['weather']).length) - 1]['temp1']); 
    });

}
window.setInterval(function() {
    loaddata();
}, 5000);
</script>

</html>