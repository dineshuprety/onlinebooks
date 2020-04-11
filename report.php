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
            if(isset($_POST['report'])){
                $id=$_SESSION['id'];
                $name=$_POST['by'];
                $subject=$_POST['subject'];
                $text=$_POST['text'];
                $date=date('j F Y');

                $insert=$pdo->prepare("insert into report (report_to,report_subject,report_text,report_date) values(:to,:subject,:text,:date)");
                $insert->execute([
                  ':to'=>$name,
                  ':subject'=>$subject,
                  ':text'=>$text,
                  ':date'=>$date
                ]);

                echo'<script type="text/javascript">
                  jQuery(function validation(){

                                  swal({
                        title: "Good Job!",
                        text: "Your Report is Successfuly Sumbited",
                        icon: "success",
                        button:"ok"
                      });

                      });

           </script>';

            }


    ?>
    

    <!-- Main content -->
    <section class="content container-fluid">

          <!-- Contant -->

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body pad">
              <form action="report.php" method="POST">
              <div class="box-body">
              <div class="form-group">
                <input class="form-control" name="by" value="<?php echo $_SESSION['name'];?>" placeholder="By:" required>
              </div>
              <div class="form-group">
                <input class="form-control" name="subject" placeholder="Subject:" required>
              </div>
                <textarea name="text" class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>

                          <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary" name="report" ><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
              </form>
            </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php require_once('./include/footer.php'); ?>