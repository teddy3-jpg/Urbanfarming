<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'urban');

// register when submit is done
if (isset($_POST['submit'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  //validate the input
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // check the database
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login2.php');
  }
}
// LOGIN USER
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index2.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
  
  //SAVE INPUTS

  if (isset($_POST['save'])) {

    $id = mysqli_real_escape_string($db, $_POST['id']);
    $light = mysqli_real_escape_string($db, $_POST['light']);
    $humidity = mysqli_real_escape_string($db, $_POST['humidity']);
    $moisture = mysqli_real_escape_string($db, $_POST['moisture']);
    $gassensor = mysqli_real_escape_string($db, $_POST['gassensor']);
    $temp = mysqli_real_escape_string($db, $_POST['temp']);
    $waterlevel = mysqli_real_escape_string($db, $_POST['waterlevel']);

    $query = "INSERT INTO input (light, humidity, moisture,gassensor) 
    VALUES('$light', '$humidity', '$moisture','$gassensor','$temp','$waterlevel')";
mysqli_query($db, $query);
if (!$query) {
  echo "Couldn't enter data";
} else {
  echo "Data entered";
}



  }

//Auto save the input data
if(isset($_POST["lightRange"]) ||isset($_POST['value'])|| isset($_POST["Humidity"]) || isset($_POST["Moisture"]) || isset($_POST["waterLevel"])|| isset($_POST["Temp"]))
 {
  $lightrange = mysqli_real_escape_string($db, $_POST["lightRange"]);
  $humidity= mysqli_real_escape_string($db, $_POST["Humidity"]);
  $moisture= mysqli_real_escape_string($db, $_POST["Moisture"]);
  $waterlevel = mysqli_real_escape_string($db, $_POST["waterLevel"]);
  $temp = mysqli_real_escape_string($db, $_POST["Temp"]);
  $gassensor = mysqli_real_escape_string($db, $_POST["value"]);
  if($_POST["postId"] != '')  
  {  
    //update post  
    $sql = "UPDATE input SET light='".$lightrange."' humidity='".$humidity."' gassensor='".$gassensor."' moisture='".$moisture."' waterlevel = '".$waterlevel."' temp = '".$temp."'  WHERE id = '".$_POST["postId"]."'";  
    mysqli_query($db, $sql);  
  }  
  else  
  {  
    //insert post  
    $sql = "INSERT INTO input(light,humidity,moisture,gassensor,temp,waterlevel) VALUES ('".$lightrange."','".$humidity."','".$moisture."','".$gassensor."','".$temp."', '".$waterlevel."')";  
    mysqli_query($db, $sql);  
    echo mysqli_insert_id($db);  
  }
 }
















  ?>