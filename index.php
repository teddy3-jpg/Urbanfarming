<?php 
 include_once("php/data.php");

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: php/login.php');
  }else{($username=$_SESSION['username']);}
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: php/login.php");
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
    <!--<meta http-equiv="refresh" content="<?php //echo $sec?>;URL='<?php //echo $page?>'">-->
    <meta name="author" content="Teddy3">
    <title>Iot Based Urban Farming System</title>
    <link rel="shortcut icon" href="img/logo.png" />
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="chart.js-2.9.4/package/dist/Chart.css">
    <link rel="stylesheet" href="chart.js-2.9.4/package/dist/Chart.min.css">
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
        background-image: url('img/back.png');
        background-color: #e5e5e5;
    }

    body {
        background-color: #303847;
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
                <h2 id="i">Display Panel</h2>
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
                            <a class="nav-link" href="php/control-panel.php"><span
                                    class="glyphicon glyphicon-tasks"></span>Control
                                Panel</a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="#"><span class="glyphicon glyphicon-user"></span>
                                <?php echo $username?></a>
                        </li> <?php  if (isset($_SESSION['username'])) : ?>
                        <li class="nav-item">

                            <a class="btn btn-sm btn-outline-secondary" href="index.php?logout='1'">Logout</a></li>
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
                                <h3 class="mb-0">Temperature Sensor</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date1"></div>
                            <p class="card-text mb-auto" id="tempDiary1">The temperature value of this sensor is: </p>

                            <h1 id="temp" class="mb-2 text-primary">25&#x26AC C </h1>


                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/temperature.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative"><canvas id="temp1"
                                style="width: 100%; height: 33vh; background: rgb(61, 61, 63); border: 1px solid #efefef;"></canvas>
                        </div>
                    </div>
                </div>



            </div>

            <div class="row mb-2" style="margin: 10px;">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Humidity Sensor</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date2"></div>
                            <p class="mb-auto">The humidity of the environment is:</p>
                            <h1 id="hum" class="mb-2 text-primary"></h1>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/humidity.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative"><canvas id="hum1"
                                style="width: 100%; height: 33vh; background: rgb(61, 61, 63); border: 1px solid #efefef;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-2" style="margin: 10px;">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Moisture Sensor</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date3"></div>
                            <p class="mb-auto">The Moisture of the environment is:</p>
                            <h1 id="moisture" class="mb-2 text-primary"></h1>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/moisture.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative"><canvas id="moisture1"
                                style="width: 100%; height: 33vh; background: rgb(61, 61, 63); border: 1px solid #efefef;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2" style="margin: 10px;">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Water Level Sensor </h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date4"></div>
                            <p class="mb-auto">Water level value is </p>
                            <h1 id="water" class="mb-2 text-primary"></h1>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/waterl-level.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative"><canvas id="water1"
                                style="width: 100%; height: 33vh; background: rgb(61, 61, 63); border: 1px solid #efefef;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-2" style="margin: 10px;">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Light Sensor</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date5"></div>
                            <p class="mb-auto">Artificial Light is </p>
                            <h1 id="light" class="mb-2 text-primary"></h1>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/light-on.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative"><canvas id="light1"
                                style="width: 100%; height: 33vh; background: rgb(61, 61, 63); border: 1px solid #efefef;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2" style="margin: 10px;">
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-relative">
                            <strong class="d-inline-block mb-2 text-success">
                                <h3 class="mb-0">Alarm System</h3>
                            </strong>
                            <div class="mb-1 text-muted" id="date6"></div>
                            <p class="mb-auto">Alarm light is </p>
                            <h1 id="alarm" class="mb-2 text-primary"></h1>

                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="img/alarm.png" alt="" class="bd-placeholder-img" width="200" height="250">

                        </div>
                    </div>
                </div>

            </div>

            <div class="row mb-2" style="margin: 20px;" id="terz"> The Status of environment is good.</div>

            <div class="row mb-2" style="margin: 20px;" id="terz">
                <canvas id="chart"
                    style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>
            </div>

            <div class="row mb-2" style="margin: 20px;">
                <div class="table-responsive">
                   <!-- <table class="table">
                        <thead style="background: url('img/back.png');">
                            <tr>
                                <th style="background: url('img/back.png');">Time Stamp</th>
                                <th>Temperature</th>
                                <th>Humidity</th>
                                <th>Soil Moisture</th>
                                <th>Water Level</th>
                                <th>Light Intensity</th>
                                <th>Alarm Status</th>

                            </tr>
                        </thead>
                        
                            
                                <tr><?php echo $timestamp;?></tr>
                                <td><?php echo $temp;?></td>
                                <td><?php echo $hum;?></td>
                                <td><?php echo $moisture;?></td>
                                <td><?php echo $water;?></td>
                                <td><?php echo $light;?></td>
                                <td><?php echo $alarm;?></td>


                             
                         
                    </table>-->
                </div>
            </div>
        </div>



        <footer style="background: url('img/back.png'); background-color: #fff;">
            <br>
            <center>&copy; <?php echo date("Y");?> All rights reserved. @Urban Farming System | Developers: Teddy3 &
                Mrkan-Hex</center><br>

        </footer>
    </div>

    <script src="bootstrap/js/jquery-3.5.1.slim.js"></script>
    <!-- Popper.JS -->
    <script src="bootstrap/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/solid.js"></script>
    <script src="bootstrap/js/fontawesome.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="chart.js-2.9.4/package/dist/Chart.bundle.js"></script>
    <script src="chart.js-2.9.4/package/dist/Chart.bundle.min.js"></script>
    <script src="chart.js-2.9.4/package/dist/Chart.js"></script>
    <script src="chart.js-2.9.4/package/dist/Chart.min.js"></script>
    <?php endif ?>
</body>


<script>
var date = new Date();

document.getElementById("date1").innerHTML = date;
document.getElementById("date2").innerHTML = date;
document.getElementById("date3").innerHTML = date;
document.getElementById("date4").innerHTML = date;
document.getElementById("date5").innerHTML = date;
document.getElementById("date6").innerHTML = date;
window.onload = function() {
    loaddata();
};

function loaddata() {
    var url = "http://localhost/Urbanfarmingsystem.com/php/read.php";
    $.getJSON(url, function(data) {
        var val = data;
        var temperature = (data['sensor'][(Object.keys(data['sensor']).length) - 1]['temp']);
        var humidity = (data['sensor'][(Object.keys(data['sensor']).length) - 1]['hum']);
        var moisture = (data['sensor'][(Object.keys(data['sensor']).length) - 1]['moisture']);
        var waterlevel = (data['sensor'][(Object.keys(data['sensor']).length) - 1]['water']);
        var light = (data['sensor'][(Object.keys(data['sensor']).length) - 1]['light']);
        var alarm = (data['sensor'][(Object.keys(data['sensor']).length) - 1]['alarm']);
        document.getElementById("temp").innerHTML = "" + temperature + " &#x26AC C";
        document.getElementById("hum").innerHTML = "" + humidity + " %";
        document.getElementById("moisture").innerHTML = "" + moisture + " %";
        document.getElementById("water").innerHTML = "" + waterlevel + " ml";
        document.getElementById("light").innerHTML = "" + light;
        document.getElementById("alarm").innerHTML = "" + alarm;
        console.log(data['sensor'][(Object.keys(data['sensor']).length) - 1]['temp']);
    });

}
window.setInterval(function() {
    loaddata();
}, 3000);
</script>

<script>
var temp = document.getElementById("temp1").getContext('2d');
var hum = document.getElementById("hum1").getContext('2d');
var moisture = document.getElementById("moisture1").getContext('2d');
var water = document.getElementById("water1").getContext('2d');
var light = document.getElementById("light1").getContext('2d');
var ctx = document.getElementById("chart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo $timestamp;?>],
        datasets: [{
                label: 'Temperature Sensor',
                data: [ <?php echo $temp;?> ],
                backgroundColor: 'transparent',
                borderColor: 'rgba(0, 255, 0)',
                borderWidth: 3
            },

            {
                label: 'Humidity Sensor',
                data: [ <?php echo $hum;?> ],
                backgroundColor: 'transparent',
                borderColor: 'rgba(250, 219, 0)',
                borderWidth: 3
            },

            {
                label: 'Moisture Sensor',
                data: [ <?php echo $moisture;?> ],
                backgroundColor: 'transparent',
                borderColor: 'rgba(250, 0, 25)',
                borderWidth: 3
            },

            {
                label: 'Water Level Sensor',
                data: [ <?php echo $water;?> ],
                backgroundColor: 'transparent',
                borderColor: 'rgba(78,62,255)',
                borderWidth: 3
            },

            {
                label: 'Light Sensor',
                data: [ <?php echo $light;?> ],
                backgroundColor: 'transparent',
                borderColor: 'rgba(241, 244, 235)',
                borderWidth: 3
            }
        ]
    },

    options: {
        scales: {
            scales: {
                yAxes: [{
                    beginAtZero: false,
                    display: true,
                    ticks: {
                        beginAtZero: true,
                        steps: 10,
                        stepValue: 5,
                        min: 0
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Sensor Values'
                    }
                }],
                xAxes: [{
                    autoskip: true,
                    maxTicketsLimit: 20,
                    type: 'time',
                    time: {
                        unit: 'minute',
                        displayFormats: {
                            minute: 'HH:mm'
                        },
                        tooltipFormat: 'HH:mm'
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Timestamp'
                    }
                }]
            }
        },
        tooltips: {
            mode: 'index'
        },
        legend: {
            display: true,
            position: 'top',
            labels: {
                fontColor: 'rgb(255,255,255)',
                fontSize: 16
            }
        }
    }
});

var myChart2 = new Chart(temp, {
    type: 'line',
    data: {
        labels: [<?php echo $timestamp;?>],
        datasets: [{
            label: 'Temperature Sensor Data',
            data: [ <?php echo $temp;?> ],
            backgroundColor: 'transparent',
            borderColor: 'rgba(0, 255, 0)',
            borderWidth: 3
        }]
    },

    options: {
        scales: {
            scales: {
                yAxes: [{
                    beginAtZero: false
                }],
                xAxes: [{
                    autoskip: true,
                    maxTicketsLimit: 20
                }]
            }
        },
        tooltips: {
            mode: 'index'
        },
        legend: {
            display: true,
            position: 'top',
            labels: {
                fontColor: 'rgb(255,255,255)',
                fontSize: 16
            }
        }
    }
});
var myChart3 = new Chart(hum, {
    type: 'line',
    data: {
        labels: [<?php echo $timestamp;?>],
        datasets: [{
            label: 'Humidity Sensor Data',
            data: [ <?php echo $hum;?> ],
            backgroundColor: 'transparent',
            borderColor: 'rgba(250, 219, 0)',
            borderWidth: 3
        }]
    },

    options: {
        scales: {
            scales: {
                yAxes: [{
                    beginAtZero: false
                }],
                xAxes: [{
                    autoskip: true,
                    maxTicketsLimit: 20
                }]
            }
        },
        tooltips: {
            mode: 'index'
        },
        legend: {
            display: true,
            position: 'top',
            labels: {
                fontColor: 'rgb(255,255,255)',
                fontSize: 16
            }
        }
    }
});
var myChart4 = new Chart(moisture, {
    type: 'line',
    data: {
        labels: [<?php echo $timestamp;?>],
        datasets: [{
            label: 'Moisture Sensor Data',
            data: [ <?php echo $moisture;?> ],
            backgroundColor: 'transparent',
            borderColor: 'rgba(250, 0, 25)',
            borderWidth: 3
        }]
    },

    options: {
        scales: {
            scales: {
                yAxes: [{
                    beginAtZero: false
                }],
                xAxes: [{
                    autoskip: true,
                    maxTicketsLimit: 20
                }]
            }
        },
        tooltips: {
            mode: 'index'
        },
        legend: {
            display: true,
            position: 'top',
            labels: {
                fontColor: 'rgb(255,255,255)',
                fontSize: 16
            }
        }
    }
});
var myChart5 = new Chart(water, {
    type: 'line',
    data: {
        labels: [<?php echo $timestamp;?>],
        datasets: [{
            label: 'Water Level Sensor Data',
            data: [ <?php echo $water;?> ],
            backgroundColor: 'transparent',
            borderColor: 'rgba(78,62,255)',
            borderWidth: 3
        }]
    },

    options: {
        scales: {
            scales: {
                yAxes: [{
                    beginAtZero: false
                }],
                xAxes: [{
                    autoskip: true,
                    maxTicketsLimit: 20
                }]
            }
        },
        tooltips: {
            mode: 'index'
        },
        legend: {
            display: true,
            position: 'top',
            labels: {
                fontColor: 'rgb(255,255,255)',
                fontSize: 16
            }
        }
    }
});
var myChart6 = new Chart(light, {
    type: 'line',
    data: {
        labels: [<?php echo $timestamp;?>],
        datasets: [{
            label: 'Light Sensor Data',
            data: [ <?php echo $light;?> ],
            backgroundColor: 'transparent',
            borderColor: 'rgba(241, 244, 235)',
            borderWidth: 3
        }]
    },

    options: {
        scales: {
            scales: {
                yAxes: [{
                    beginAtZero: false
                }],
                xAxes: [{
                    autoskip: true,
                    maxTicketsLimit: 20
                }]
            }
        },
        tooltips: {
            mode: 'index'
        },
        legend: {
            display: true,
            position: 'top',
            labels: {
                fontColor: 'rgb(255,255,255)',
                fontSize: 16
            }
        }
    }
});
</script>

</html>