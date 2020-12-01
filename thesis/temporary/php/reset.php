<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="reset.css" type="text/css">
    <link rel="stylesheet" href="msg.css" type="text/css">
</head>
<body>
    <header>
       
        <h1 style="border-top-left-radius: 3pc;margin-left: 136px;margin-right: 136px;text-emphasis-color:blue;text-align:
         center;border-bottom-right-radius: 3pc;background-color: rgba(44, 62, 80, 0.7);">Urban Farming System Server</h1>
    </header>
    <div class="reset">
        <form>
            <h2 align="center" style="color:#fff">Reset Password</h2>
            <input type="password" name="username" placeholder="Old Password"required><br><br>
            <input type="password" name="username" placeholder="New Password"required><br><br>
            <input type="password" name="pass" placeholder="Confirm Password"required><br><br>
            <input type="button" value="Save" onclick="myFunction()"><br><br>
            <a href="login2.php" style="text-decoration: none;">Go Back To Homepage</a>
            <div id="msg">Your Password Is Changed Succssfully!!!</div>
<script>
function myFunction(){
var x=document.getElementById("msg");
x.className="show";
setTimeout(function(){x.className=x.className.replace("show","");},3000);
   
}
</script>
        </form>

    </div>
</body>
</html>