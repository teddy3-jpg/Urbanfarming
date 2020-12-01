<?php

include_once('session.php');
include('db_connect.php');
$username=$_POST['username']; 
$phone=$_POST['phone'];
$email=$_POST['email']; 
$pass=$_POST['password'];  

$mysqli->query("INSERT INTO users VALUES (\"$username\", \"$pass\", $phone, \"$email\") ")or die(mysqli_error(($mysqli)));
        $isLogged=true;
        $_SESSION['username']=$username;
        $_SESSION['email']=$email;
        $_SESSION['phone']=$phone;
        $mysqli->close();
        echo '<script> window.alert("you have successfully registered!!!"); window.location="../../login.php"; </script>';


?>