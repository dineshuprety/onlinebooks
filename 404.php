<?php require_once('./include/header.php'); ?>

<!-- Left side column. contains the logo and sidebar -->

<?php require_once('./include/navigation.php'); ?>

   <?php

   if(!isset($_COOKIE['_ua_'])){
     header("Location: login.php");
   }

   ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        404 Error Page
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">404 error</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="index.php">return to dashboard</a> or try using the search form.
          </p>

          <form class="search-form" action="search.php" method="POST" >
            <div class="input-group">
              <input type="text" name="val" class="form-control" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit"class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
  <?php require_once('./include/footer.php');?>
 