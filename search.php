<?php require_once('./include/header.php'); ?>
<?php

if(!isset($_COOKIE['_ua_'])){
  header("Location: login.php");
}

?>

<?php

if(isset($_POST['val'])){
  $key=$_POST['val'];
  $url='search.php?key=' . $key;
   header("location: {$url}");
}

//pagenation code

    $post_per_page=6;
    $status="published";
    $select1="SELECT * FROM post WHERE post_title LIKE :p_title AND post_status= :status";
    $stmt2=$pdo->prepare($select1);
    $stmt2->execute([':p_title'=> '%' .$_GET['key']. "%",':status'=>$status]);
    $post_count=$stmt2->rowCount();
          if(isset($_GET['page'])){
            $page=$_GET['page'];
            if($page==1){
              $page_id=0;
            }else{
              $page_id=($post_per_page * $page) - $post_per_page;
            }
          }else{
            $page_id=0;
            $page=1;
          }
          $total_pager=ceil($post_count/$post_per_page);

?>

       

 <!-- Left side column. contains the logo and sidebar -->
 
 <?php require_once('./include/navigation.php'); ?>

     

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Search Result: <?php echo isset($_GET['key'])?$_GET['key']: ''?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i>User</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <?php

          $status="published";
          $select="SELECT * FROM post WHERE post_status = :status AND post_title LIKE :title LIMIT $page_id,$post_per_page";
          $stmt =$pdo->prepare($select);
          $stmt->execute([
          ':status' => $status,
          ':title' => '%'.$_GET['key'].'%'
          ]);
          $count = $stmt->rowCount();

          //echo $count;

          if($count==0){
            echo'<script type="text/javascript">
            jQuery(function validation(){
    
                            swal({
                  title: "Opps!!",
                  text: " Search result not found!!",
                  icon: "error",
                  button:"ok"
                });
    
                });
    
               </script>';
                
          }else{

            while($post=$stmt->fetch(PDO::FETCH_ASSOC)){
              $post_id=$post['post_id'];
              $post_title=substr($post['post_title'],0,30);
              $post_image=$post['post_image'];
              $post_pdf=$post['post_pdf'];
              $post_date=$post['post_date'];
              $post_author=$post['post_author'];
              $post_cat_id=$post['post_cat_id'];
              $post_status=$post['post_status'];
              ?>
            <div class="col-md-4">
									<div class="post">
										<a class="post-img" target="_blank" href="pdf/<?php echo $post_pdf;?>"><img src="img/<?php echo $post_image;?>" height="50%" width="100%" alt=""></a>
										<div class="post-body">
											<div class="post-meta">
												<a class="post-category cat-1" href="categories.php?id=<?php echo $post_cat_id;?>">
												<?php 
                    $sql1 = "SELECT * FROM categories WHERE cat_id = :id";
                    $stmt1 = $pdo->prepare($sql1);
                    $stmt1->execute([':id'=>$post_cat_id]);
                    while($cat = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                      $cat_title = $cat['cat_title'];
                    }
                    echo $cat_title;
                  ?>
												</a>
												<span class="post-date"><?php echo $post_date;?> by <?php echo $post_author;?></span>
											</div>
											<h3 class="post-title"><a download="<?php echo $post_pdf;?>" href="pdf/<?php echo $post_pdf;?>" > <?php echo $post_title;?><i class="fa fa-cloud-download" aria-hidden="true"></i> </a></h3>
										</div>
									</div><br>
								</div>
            
  
            <?php }
          }
     ?>

    </section>
    <!-- /.content -->
<?php require_once('./include/pagenation.php'); ?>
  </div>
  <!-- /.content-wrapper -->

 <?php require_once('./include/footer.php'); ?>
