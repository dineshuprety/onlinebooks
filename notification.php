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

          <!-- Contant -->
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