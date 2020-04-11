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


    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Report Table</h3>

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
                  <th>By</th>
                  <th>Subject</th>
                  <th>Text</th>
                  <th>Date</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                <?php
              $select=$pdo->prepare("select * from report order by report_id desc");
              $select->execute();
              while($report=$select->fetch(PDO::FETCH_OBJ)){
                echo'<tr>
                <td>'.$report->report_id.'</td>
                <td>'.$report->report_to.'
                </td>
                <td>'.$report->report_subject.'</td>
                <td>'.$report->report_text.'</td>
                <td>'.$report->report_date.'</td>
                <td>
                        <form action="report.php" method="POST">
                          <input  type="hidden" name="val" value="'.$report->report_id.'    "name="val">
                            <input type="submit" name="delete-report" value="Delete" class="btn btn-link"/>
                          </form>               
                      </td>
              </tr>';
              }
        ?>
                
                </tbody>
              </table>

    </section>
    <!-- /.content -->
    <?php

                     if(isset($_POST['delete-report'])){
                        $pid=$_POST['val'];
                        $delete="DELETE FROM report WHERE report_id=:pid";
                        $stmt2=$pdo->prepare($delete);
                        $stmt2->execute([':pid'=>$pid]);
                        header("location: report.php");
                     }

                ?>
  </div>
  <!-- /.content-wrapper -->

 <?php require_once('./include/footer.php'); ?>