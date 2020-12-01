<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Urban Farming System|Login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="login.css" type="text/css">
    <link rel="stylesheet" href="msg.css" type="text/css">
    <script src="msg.js"></script>
   
</head>
<body>
    <header>
       
        <h1 style="border-top-left-radius: 3pc;margin-left: 136px;margin-right: 136px;text-emphasis-color:blue;text-align:
         center;border-bottom-right-radius: 3pc;background-color: rgba(44, 62, 80, 0.7);">Urban Farming System Server</h1>
    </header>
    <div class="signin">
        <form method="post" action="login2.php"">
            <?php include('errors.php'); ?>
            <h2 style="color: white">Log In</h2>
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit" name="login">Log In</button><br>
            <br>
            <div id="container">
                <a href="reset.php" style="margin-right: 0px; font-size: 13px;font-family:Tahoma,Geneva,sans-serif;">Reset Password</a>
                <a href="forget.php" style="margin-right: 0px; font-size: 13px;font-family:Tahoma,Geneva,sans-serif;">Forget Password</a>
            </div><br><br><br><br> 
            Don't have an account?<a href="signup2.php">&nbsp;Sign Up</a>
        </form>

    </div>
</body>
</html>