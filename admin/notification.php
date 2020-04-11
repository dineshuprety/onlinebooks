<?php require_once('./include/header.php');?>

<body class="hold-transition skin-blue sidebar-mini">

<?php require_once('./include/navigation.php');?>
<?php

    if(!isset($_COOKIE['_ad_'])){
      header("Location: login.php");
    }

    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content container-fluid">

    <?php
            if(isset($_POST['notification'])){
                $name="Admin";
                $date=date('j F Y');
                $status="Approved";
                $message=$_POST['message'];

                $insert=$pdo->prepare("insert into notification (n_user,n_date,n_status,n_text) values(:name,:date,:status,:message)");
                $insert->execute([
                  ':name'=>$name,
                  ':date'=>$date,
                  ':status'=>$status,
                  ':message'=>$message
                ]);

                echo'<script type="text/javascript">
                  jQuery(function validation(){

                                  swal({
                        title: "Good Job!",
                        text: " Sumbited",
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
              <form action="notification.php" method="POST">
              <div class="box-body">
                <textarea name="message" class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>

                          <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary" name="notification" ><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
              </form>
            </div>

            <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Notification Table</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <div class="input-group-btn">
  
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="table_id">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Reason</th>
                </tr>
</thead>
<tbody>

                <?php
                  $select=$pdo->prepare("select * from notification order by n_id desc");
                  $select->execute();
                  while($row=$select->fetch(PDO::FETCH_OBJ)){

                    echo'<tr>
                    <td>'.$row->n_id.'</td>
                    <td>'.$row->n_user.'</td>
                    <td>'.$row->n_date.'</td>
                    <td><span class="label label-success">'.$row->n_status.'</span></td>
                    <td>'.$row->n_text.'.</td>
                  </tr>';

                  }
                ?>
                
                
</tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php require_once('./include/footer.php'); ?>