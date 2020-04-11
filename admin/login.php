<?php require_once('./include/header.php'); ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="login.php"><b>Admin</b>Dashboard</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your Admin Dashboard</p>

    <?php

if(isset($_POST['submit'])){
    $user_email=trim($_POST['user-email']);
    $user_password=trim($_POST['user-password']);
    if(empty($user_email)||empty($user_password)){
        echo '<div class="alert alert-danger"> Field cant be empty </div>';
    }else{
        $select ="SELECT * FROM admin";
        $stmt=$pdo->prepare($select);
        $stmt->execute();
        while($user=$stmt->fetch(PDO::FETCH_ASSOC)){
          $_SESSION['personid']=$user['admin_id'];
            $_SESSION['name']=$user['admin_name'];
            $email=$user['admin_email'];
            $password=$user['admin_password'];
            if($user_email==$email && $user_password==$password){
                
              echo'<script type="text/javascript">
              jQuery(function validation(){
      
                              swal({
                    title: "Good job!'.$_SESSION['name'].'",
                    text: "You have successfully login!",
                    icon: "success",
                    button:"Loading....."
                  });
      
                  });
      
                 </script>';

                setcookie('_ad_',md5(1),time() + 86400 * 30,'','','',true);

                header('refresh:2;index.php');
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
    }
}

?>

    <form action=" " method="POST">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="user-email" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="user-password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
</html>