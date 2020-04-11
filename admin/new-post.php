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

    <h2 class="pb-3">Add New Post</h2>

<?php
        if(isset($_POST['create-post'])){
            $post_title=$_POST['post-title'];
            $post_cat_id=$_POST['cat-id'];
            $post_status=$_POST['post-status'];
            $post_date= date('j F Y');
            $post_image=$_FILES['post-image']['name'];
            $post_temp_image=$_FILES['post-image']['tmp_name'];
            move_uploaded_file("{$post_temp_image}", "../img/{$post_image}");
            //for pdf
            $post_pdf=$_FILES['post-pdf']['name'];
            $post_temp_pdf=$_FILES['post-pdf']['tmp_name'];
            move_uploaded_file("{$post_temp_pdf}", "../pdf/{$post_pdf}");
            
            if(empty($post_title) || empty($post_cat_id) || empty($post_status) ||empty($post_image)){
                echo "<div class='alert alert-danger'>Field can't be empty!</div>";
            } else {
                $insert = "INSERT INTO post (post_title, post_image,post_pdf, post_date, post_cat_id, post_status) VALUES(:title,:image,:pdf, :date, :catid, :status)";
                $stmt = $pdo->prepare($insert);
                $stmt->execute([
                    ':title'=>$post_title,
                    ':image'=>$post_image,
                    ':pdf'=>$post_pdf,
                    ':date'=>$post_date,
                    ':catid'=>$post_cat_id,
                    ':status'=>$post_status
                ]);
                echo "<div class='alert alert-success'>Post created successfully. <a href='index.php'>Go back</a></div>";
            }
        }
    ?>
     
    <form action="new-post.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post-title">Post Title</label>
        <input name="post-title" type="text" class="form-control" id="post-title" placeholder="Enter post title">
    </div>
    <div class="form-group">
        <label for="category">Select Category</label>
        <select name="cat-id" class="form-control" id="category">
            <?php
                $select = 'SELECT * FROM categories';
                $stmt1 = $pdo->prepare($select);
                $stmt1->execute();
                while($category = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    $cat_id = $category['cat_id'];
                    $cat_title = $category['cat_title']; ?>
                    echo "<option value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>";
                <?php }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="category">Post Status</label>
        <select name="post-status" class="form-control" id="category">
            <option value="Published">Published</option>
            <option value="Draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post-image">Upload post image</label>
        <input name="post-image" type="file" class="form-control-file" id="post-image">
    </div>
    <div class="form-group">
        <label for="post-image">Upload post PDF</label>
        <input name="post-pdf" type="file" class="form-control-file" id="post-image">
    </div>
    <button name="create-post" type="submit" class="btn btn-primary">Submit</button>
</form>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php require_once('./include/footer.php'); ?>