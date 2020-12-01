<?php include('server2.php')?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Urban Farming System|Sign UP</title>
    <link rel="stylesheet" href="signup.css" type="text/css">
    <link rel="stylesheet" href="msg.css" type="text/css">
    <script src="msg.js"></script>
</head>
<body>
    <header>
       
        <h1 style="border-top-left-radius: 3pc;margin-left: 136px;margin-right: 136px;text-emphasis-color:blue;text-align:
         center;border-bottom-right-radius: 3pc;background-color: rgba(44, 62, 80, 0.7);">Urban Farming System Server</h1>
    </header>
    <div class="signup">
        <form method="post" action="signup.php">
            <?php include('errors.php'); ?>
            <h2 style="color:#fff">Sign Up</h2>
            <input type="text" name="name1" placeholder="First Name" value="<?php echo $name1; ?>" ><br><br>
            <input type="text" name="name2" placeholder="Last Name" value="<?php echo $name2; ?>"><br><br>
            <input type="password" name="pass" placeholder="Password"><br><br>
            <input type="password" name="pass" placeholder="Confirm Password"><br><br>
            <input type="text" name="email" placeholder="Email Address" value="<?php echo $email; ?>"><br><br> 
            <button type="submit" class="btn" name="submit">Sign Up</button><br><br>
            <div id="msg">Congradulations You Sign Up Succssfully!!!</div>
Already have an account? <a href="login.html" style="text-decoration: none;font-family: 'play',sans-serif;color: yellow;">&nbsp;Log In</a>
        </form>

    </div>
</body>
</html>