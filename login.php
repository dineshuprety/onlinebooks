<?php 
session_start();
require_once ('./include/db.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css'>
</head>
<body>
	<div class="container" id="container">
    <div class="form-container sign-up-container">

        <form action="register.php" method="post">
        <h1>Create Account</h1>
        <div class="social-container">
            <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
            <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <span>or use your email for registration</span>
        <input type="text" placeholder="Name" name="txtname" required="" />
        <input type="email" placeholder="Email" name="txtemail" required="" />
        <input type="password" placeholder="Password" name="txtpassword" required />
        <button name="btn_signup">Sign Up</button>
    </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="index.php" method="POST">
        <h1>Sign in</h1>
        <div class="social-container">
            <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
            <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <span>or use your account</span>
        <input type="email" placeholder="Email" id="email" name="email" />
        <input type="password" placeholder="Password" id="password" name="password" />
        <a href="#">Forgot your password?</a>
        <button type="submit" onclick="login_now()" name="btn_signin">Sign In</button>
        <div class="message"></div>
    </form> 
    </div>
    <script>
        function login_now(){
            var email=jQuery('#email').val();
            var password=jQuery('#password').val(); 
            jQuery.ajax({
                url:'login_check.php',
                type:'post',
                data:'email='+email+'&password='+password,
                success:function(result){
                    if(result=='done'){
                       window.location.href='index.php';
                       
                    }
                   jQuery('.message').html(result);
                }
            });
}
</script>
    <div class="overlay-container">
        <div class="overlay">
        <div class="overlay-panel overlay-left">
            <h1>Welcome Back!</h1>
            <p>
                To keep connected with us please login with your personal info
            </p>
            <button class="ghost" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
            <h1>Hello, Friend!</h1>
            <p>Enter your personal details and start journey with us</p>
            <button class="ghost" id="signUp">Sign Up</button>
        </div>

    </div>
</div>  
</body>
<footer>
    <script src="js/script.js"></script>
    <script src="js/jquery.min.js"></script>
</footer>
</html>