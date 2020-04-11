<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>O</b>LB</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Online</b>Admin</span>
    </a>

    <?php
                    if(isset($_SESSION['personid'])){
                      $personid=$_SESSION['personid'];
                      $select1=$pdo->prepare("select * from admin where admin_id=:personid");
                      $select1->execute([':personid'=>$personid]);
                      while($row=$select1->fetch(PDO::FETCH_ASSOC)){
                      $name=$row['admin_name'];
                      $email=$row['admin_email'];
                      $date=$row['admin_date'];
                      $image=$row['admin_img']; ?>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
        
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="../img/<?php echo $image;?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="../img/<?php echo $image;?>" class="img-circle" alt="User Image">

                <p>
                <?php echo $email;?>
                  <small>Member since <?php echo $date;?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="categories.php" class="btn btn-default btn-flat">Category</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->  
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../img/<?php echo $image;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $name;?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Post Detals</span></a></li>
        <li><a href="new-post.php"><i class="fa fa-plus-square"></i> <span>New-Post</span></a></li>
        <li><a href="categories.php"><i class="fa fa-list"></i> <span>Categories</span></a></li>
        <li><a href="notification.php"><i class="fa fa-table"></i> <span>Notification</span></a></li>
        <li><a href="report.php"><i class="fa fa-font"></i> <span class="badge bg-yellow"> Report  <?php echo $_SESSION['count'];?></span></a></li>
        <li><a href="registration.php"><i class="fa fa-edit"></i> <span class="badge bg-yellow"> Registration Details <?php echo $_SESSION['users'];?></span></a></li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

                      <?php }
                    }
                    ?>
<?php

$select=$pdo->prepare("select report_id from report");
$select->execute();
$_SESSION['count']=$select->rowCount();

?>

<?php
                  $select2=$pdo->prepare("select id from user");
                  $select2->execute();
                  $_SESSION['users']=$select2->rowCount();


?>