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
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="table_id">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Email</th>
                  <th>Date</th>
                  <th>Image</th>
                  <th>Delete</th>
                </tr>
</thead>
<tbody>

                <?php
                  $select=$pdo->prepare("select * from user order by id desc");
                  $select->execute();
                  while($row=$select->fetch(PDO::FETCH_OBJ)){

                    echo'<tr>
                    <td>'.$row->id.'</td>
                    <td>'.$row->name.'</td>
                    <td>'.$row->email.'</td>
                    <td><span class="label label-success">'.$row->date.'</span></td>
                    <td><img src="../img/'.$row->img.'" style="width:50px;height:50px" /></td>
                    <td>
                        <form action="registration.php" method="POST">
                          <input  type="hidden" name="val" value="'.$row->id.'    "name="val">
                            <input type="submit" name="delete-id" value="Delete" class="btn btn-link"/>
                          </form>               
                      </td>
                  </tr>';

                  }
                ?>
                
                
</tbody>
              </table>
            </div>
            <?php

                     if(isset($_POST['delete-id'])){
                        $pid=$_POST['val'];
                        $delete="DELETE FROM user WHERE id=:pid";
                        $stmt2=$pdo->prepare($delete);
                        $stmt2->execute([':pid'=>$pid]);
                        header("location: registration.php");
                     }

                ?>
            <!-- /.box-body -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php require_once('./include/footer.php'); ?>