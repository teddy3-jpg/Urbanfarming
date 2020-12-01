<?php

include_once('db_login.php');
if(null==session_id())session_start(); 
$db=mysqli_connect($db_host, $db_username, $db_password, $db_database);
if(mysqli_connect_errno($db))
{ echo "failed";
exit();}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=mysqli_real_escape_string($db, $_POST["username"]);
    $password=mysqli_real_escape_string($db, $_POST["password"]);

    // $sql="SELECT * FROM subscriber WHERE phone = $phone and password = \"$password\" and isActive = \"Active\" ";
    $sql="SELECT * FROM agents WHERE phone = \"$username\" and pass = \"$password\"  ";
    
    $result= mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    // $active=$row['active'];
    $count = mysqli_num_rows($result);

    if($count==1){
        if(null==session_id())session_start();
        $_SESSION['reg']=$username;

        header("location: index.php");
    }
    else{
        if(null==session_id())session_start();
        $_SESSION['error']="true";
        echo "<script> window.alert(\"Password or Phone not correct\"); window.location=\"../page/addMember.php\";</script>";
        
    }
}


mysqli_close($db);
mysqli_close($mysqli);
?>