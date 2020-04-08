<?php require_once('./include/header.php'); ?>

<?php

  if(!isset($_COOKIE['_ua_'])){
    header("Location: login.php");
  }

?>

 <!-- Left side column. contains the logo and sidebar -->

 <?php require_once('./include/navigation.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <?php

    if(isset($_POST['btnupdate'])){
        $oldpassword_txt=$_POST['currentPassword'];
        $newpassword_txt=$_POST['newPassword'];
        $confpassword_txt=$_POST['confirmpassword'];

        //using of select query we get out datebase record according to useremail

        $id= $_SESSION['id'];

        $select=$pdo->prepare("select * from user where id=:id");

        $select->execute([':id'=>$id]);
        $row=$select->fetch(PDO::FETCH_ASSOC);
        
        $username_db = $row['id'];
        $password_db = $row['password'];
        //we compare user input and database value

        if($oldpassword_txt==$password_db){
            if($newpassword_txt==$confpassword_txt){


                    //query for update password
                //if value matched then we run update query
                $update=$pdo->prepare("update user set password=:pass where id=:id");

                $update->bindParam(':pass',$confpassword_txt);
                $update->bindParam(':id',$id);

                if($update->execute()){

                    echo'<script type="text/javascript">
        jQuery(function validation(){

                        swal({
              title: "Good Job!",
              text: "Your Password is Updated Successfull",
              icon: "success",
              button:"ok"
            });

            });

           </script>';
                }
                    
            }
            else{


                echo'<script type="text/javascript">
        jQuery(function validation(){

                        swal({
              title: "Opps!!",
              text: "Your Password And Confirm Not Matched",
              icon: "error",
              button:"ok"
            });

            });

           </script>';
            }



            }

        else{
            echo'<script type="text/javascript">
        jQuery(function validation(){

                        swal({
              title: "Warning!!",
              text: "Your Password is Wrong Please Fill Right Password!",
              icon: "error",
              button:"ok"
            });

            });

           </script>';
        }



    }

    ?>

    <!-- Main content -->
    <section class="content container-fluid">

    <form role="form" action="" method="POST" >
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">old password</label>
                  <input type="password" class="form-control" id="exampleInputEmail1" name="currentPassword" placeholder="old password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">new password</label>
                  <input type="password" class="form-control" name="newPassword" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">confirm password</label>
                  <input type="password" class="form-control" name="confirmpassword" id="exampleInputPassword1" placeholder="Password">
                </div>
              </div>
              <!-- /.box-body -->

              <div>
                <button type="submit" class="btn btn-primary" name="btnupdate">Submit</button>
              </div>
            </form>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php require_once('./include/footer.php'); ?>