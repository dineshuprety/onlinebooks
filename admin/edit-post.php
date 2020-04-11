<?php require_once('./include/header.php');?>

<body class="hold-transition skin-blue sidebar-mini">

<?php require_once('./include/navigation.php');?>

<?php

if(!isset($_COOKIE['_ad_'])){
  header("Location: login.php");
}

?>

<?php
    if($_SERVER['REQUEST_METHOD'] != 'POST') {
        header("Location: index.php");
    }

    if(isset($_POST['val'])) {
        $pid = $_POST['val'];
        $select = "SELECT * FROM post WHERE post_id = :pid";
        $stmt = $pdo->prepare($select);
        $stmt->execute([
            ':pid'=>$pid
        ]);
        while($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post_id = $post['post_id'];
            $post_title = $post['post_title'];
            $post_cat_id = $post['post_cat_id'];
            $post_status = $post['post_status'];
            $post_image = $post['post_image'];
            $post_pdf = $post['post_pdf'];
        }
    }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content container-fluid">

    <?php
                if(isset($_POST['update-post'])) {
                    $post_title = $_POST['post-title'];
                    $post_cat_id = $_POST['cat-id'];
                    $post_status = $_POST['post-status'];
                    $postid = $_POST['edit-post-id'];
                    $post_date = date('j F Y');
                    $post_author = "Dinesh";

                    $post_image = $_FILES['post-image']['name'];
                    $post_temp_image = $_FILES['post-image']['tmp_name'];
                    move_uploaded_file("{$post_temp_image}", "../img/{$post_image}");

                    $post_pdf = $_FILES['post-pdf']['name'];
                    $post_temp_pdf = $_FILES['post-pdf']['tmp_name'];
                    move_uploaded_file("{$post_temp_pdf}", "../pdf/{$post_pdf}");
                    if(empty($post_image)||empty($post_pdf)) {
                        $select2 = "SELECT * FROM post WHERE post_id = :id";
                        $stmt3 = $pdo->prepare($select2);
                        $stmt3->execute([
                            ':id' => $postid
                        ]);
                        while($p = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                            $post_image = $p['post_image'];
                            $post_pdf = $p['post_pdf'];
                        };
                    }
                    
                   
                    if(empty($post_title) || empty($post_cat_id) || empty($post_status)){
                        echo "<div class='alert alert-danger'>Field can't be empty!</div>";
                    } else {
                        //echo "try !";
                        $update = "UPDATE post SET post_title = :title,  post_image = :image,post_pdf= :pdf, post_date = :date, post_author = :author, post_cat_id = :catid, post_status = :status WHERE post_id = :postid";
                        $stmt = $pdo->prepare($update);
                        $stmt->execute([
                            ':title'=>$post_title,
                            ':image'=>$post_image,
                            ':pdf'=>$post_pdf,
                            ':date'=>$post_date,
                            ':author'=>$post_author,
                            ':catid'=>$post_cat_id,
                            ':status'=>$post_status,
                            ':postid'=>$postid
                        ]);
                        header("Location: index.php");
                    }
                }
            ?>
            <form method="POST" action="edit-post.php" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" value="<?php echo $post_id; ?>" name="edit-post-id" />
                    <label for="post-title">Post Title</label>
                    <input name="post-title" value="<?php echo $post_title; ?>" type="text" class="form-control" id="post-title" placeholder="Enter post title">
                </div>
                <div class="form-group">
                    <label for="category">Select Category</label>
                    <select name="cat-id" class="form-control" id="category">
                    <?php
                            $sql1 = 'SELECT * FROM categories';
                            $stmt1 = $pdo->prepare($sql1);
                            $stmt1->execute();
                            while($category = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                $cat_id = $category['cat_id'];
                                $cat_title = $category['cat_title']; ?>
                                echo "<option value="<?php echo $cat_id; ?>" <?php echo $cat_id == $post_cat_id?'selected':'' ?>><?php echo $cat_title; ?></option>";
                            <?php }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Post Status</label>
                    <select name="post-status" class="form-control" id="category">
                        <option <?php echo $post_status == 'published'?'selected':'' ?>>Published</option>
                        <option <?php echo $post_status == 'draft'?'selected':'' ?>>Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <img src="../img/<?php echo $post_image; ?>" style="width:50px;height:50px" />
                    <label for="post-image">Upload post image</label>
                    <input name="post-image" type="file" class="form-control-file" id="post-image">
                </div>
                <div class="form-group">
                    <img src="../img/<?php echo $post_image; ?>" style="width:50px;height:50px" />
                    <label for="post-image">Upload post PDF</label>
                    <input name="post-pdf" type="file" class="form-control-file" id="post-pdf">
                </div>
                <input name="update-post" type="submit" class="btn btn-primary" value="Update post">
            </form>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php require_once('./include/footer.php'); ?>