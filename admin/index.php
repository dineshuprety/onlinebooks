<?php require_once('./include/header.php');?>

<body class="hold-transition skin-blue sidebar-mini">
    

<?php require_once('./include/navigation.php');?>
  <!-- Content Wrapper. Contains page content -->
  <?php

    if(!isset($_COOKIE['_ad_'])){
      header("Location: login.php");
    }

    ?>
  <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content container-fluid">

     <!-- /.row -->
     <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Post Details</h3>

              <div class="box-tools">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="table">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Post Title</th>
                  <th>Post Category</th>
                  <th>Post Status</th>
                  <th>edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                <?php
                  $select="SELECT * FROM post ORDER BY post_id DESC";
                  $stmt=$pdo->prepare($select);
                  $stmt->execute();
                  $count=$stmt->rowCount();
                  if($count==0){
                    echo" No posts found";
                  }else{
                    while($post=$stmt->fetch(PDO::FETCH_ASSOC)){
                      $post_id=$post['post_id'];
                      $post_title=$post['post_title'];
                      $post_cat_id=$post['post_cat_id'];
                      $post_status=$post['post_status'];
                                                       ?>

                          <tr>
                          <td><?php echo $post_id;?></td>
                          <td><?php echo $post_title;?></td>
                          <td>

                          <?php 
                                $select1 = "SELECT * FROM categories WHERE cat_id = :id";
                                $stmt1 = $pdo->prepare($select1);
                                $stmt1->execute([':id'=>$post_cat_id]);
                                while($cat = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                  $cat_title = $cat['cat_title'];
                                }
                                echo $cat_title;
                              ?>

                          </td>
                          <td><?php echo $post_status;?></td>
                          <td>
                          <form action="edit-post.php" method="POST">
                            <input  type="hidden" name="val" value="<?php echo $post_id;?>"/>
                            <input type="submit" name="delete-post" value="Edit" class="btn btn-link"/>
                              
                          </form>
                      </td>
                      <td>
                          <form action="index.php" method="POST">
                          <input  type="hidden" name="val" value="<?php echo $post_id;?>"name="val">
                            <input type="submit" name="delete-post" value="Delete" class="btn btn-link"/>
                          </form>               
                      </td>
                      </tr>

                    <?php }
                  }
              ?>
              <?php

                     if(isset($_POST['delete-post'])){
                        $pid=$_POST['val'];
                        $delete="DELETE FROM post WHERE post_id=:pid";
                        $stmt2=$pdo->prepare($delete);
                        $stmt2->execute([':pid'=>$pid]);
                        header("location: index.php");
                     }

                ?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->


    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
 <?php require_once('./include/footer.php'); ?>