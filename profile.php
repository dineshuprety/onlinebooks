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
    

    <!-- Main content -->
    <section class="content container-fluid">
        <?php 
            if(isset($_POST['btn-update'])){
            $id=$_SESSION['id'];
            $post_image=$_FILES['post-image']['name'];
            // echo $post_image;
            $post_temp_image=$_FILES['post-image']['tmp_name'];
            move_uploaded_file("{$post_temp_image}", "img/{$post_image}");
            if(empty($post_image)){
              echo'<script type="text/javascript">
                      jQuery(function validation(){

                                      swal({
                            title: "Warning!!",
                            text: "Your image from is empty!!",
                            icon: "error",
                            button:"ok"
                          });

                          });

                        </script>';
            }else{
                    $update=$pdo->prepare(" update user set img= :post_image where id=$id");
                    $update->execute([':post_image'=>$post_image]);
                    echo'<script type="text/javascript">
                    jQuery(function validation(){
            
                                    swal({
                          title: "Good Job!",
                          text: "Your image  is Update Successfull",
                          icon: "success",
                          button:"ok"
                        });
            
                        });
            
                       </script>';
            }
                //header('location:profile.php');

            }
          ?>
           <form role="form" action="profile.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" name="post-image" id="exampleInputFile">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              <img src="img/<?php echo $_SESSION['image']; ?>" style="width:10%" style="display: block;margin-left: auto;margin-right: auto;">
                <button type="submit" name="btn-update" class="btn btn-primary">Update</button>
              </div>
             </form>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php require_once('./include/footer.php'); ?>