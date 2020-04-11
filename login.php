<?php 
ob_start();
session_start();
require_once ('./include/db.php');?>
<script src="js/sweetalert.js"></script>
<script src="js/jquery.min.js"></script>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css'>
    <style>
        .p {
  text-indent: 50px;
  text-align: justify;
  letter-spacing: 3px;
}

.a {
  text-decoration: none;
  color: #008CBA;
}
    </style>
    
</head>
<body>
        <div class="total">
        <p class="p"> welcome to our website to read and downlaod the books We have 
        <a href="#" onclick="swal('Login or Register','Please register to get  Service on onlinebooks','error');" class="a">"Total <?php 
    $select3=$pdo->prepare("select post_id from post");
    $select3->execute();
    $totalbooks=$select3->rowCount();
    echo $totalbooks;
?> Books "</a> Thank You.</p>
        </div>
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
        <form action="login.php" method="POST">
        <h1>Sign in</h1>
        <div class="social-container">
            <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
            <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <span>or use your account</span>
        <input type="email" placeholder="Email" id="email" name="email" />
        <input type="password" placeholder="Password" id="password" name="password" />
        <a href="#" onclick="swal('To Get Password','Please Contact to Admin OR Service Provider','error');" >Forgot your password?</a>
        <button type="submit" name="btn_signin">Sign In</button>
    </form> 
    </div>
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
	</div>
    <?php
            //login code 

            if(isset($_POST['btn_signin'])){
                $email=$_POST['email'];
                $password=$_POST['password'];
                $select="select * from user where email=:emailid and password=:pass";
                $stmt=$pdo->prepare($select);
                $stmt->execute([':emailid'=>$email,':pass'=>$password]);
                $check=$stmt->rowCount();
                
                if($check>0){
                    $row=$stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['id']=$row['id'];
                    $_SESSION['username']=$row['name'];
                    $verification_status=$row['verification_status'];
                    if($verification_status==0){
                                    echo'<script type="text/javascript">
                                    jQuery(function validation(){
                            
                                                swal({
                                        title: "Oops",
                                        text: "Your Account is not verified check your gmail",
                                        icon: "error",
                                        button:"ok"
                                        });
                            
                                        
                                        });
                            
                                    </script>';
                    }else{
                        echo'<script type="text/javascript">
                        jQuery(function validation(){
                
                                        swal({
                              title: "Good job!'.$_SESSION['username'].'",
                              text: "You have successfully login!",
                              icon: "success",
                              button:"Loading....."
                            });
                
                            });
                
                           </script>';

                        setcookie('_ua_',md5(1),time() + 86400 * 30,'','','',true);
                        header('refresh:2;index.php');
                    }
                }else{
                    echo'<script type="text/javascript">
                            jQuery(function validation(){

                                        swal({
                                title: "Oops",
                                text: "Something went wrong!",
                                text: "Please Check Your Email Id or Password!",
                                icon: "error",
                                button:"ok"
                                });

                                
                                });

                            </script>';
                }
            }
            ?>
</body>
<footer>
    <script src="js/script.js"></script>
    <script src="js/jquery.min.js"></script>
</footer>
</html>