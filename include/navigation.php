<body class="hold-transition skin-blue sidebar-mini">
                    <?php
                    if(isset($_SESSION['id'])){
                      $iid=$_SESSION['id'];
                      $select1=$pdo->prepare("select * from user where id=:iid");
                      $select1->execute([':iid'=>$iid]);
                     while($row=$select1->fetch(PDO::FETCH_ASSOC)){
                      $_SESSION['name']=$name=$row['name'];
                      $email=$row['email'];
                      $date=$row['date'];
                      $image=$row['img']; 
                      $_SESSION['image']=$row['img'];?> 
        <div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>O</b>LB</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Online</b>Books</span>
    </a>
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
              <img src="img/<?php echo $image;?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->   
              <span class="hidden-xs"><?php echo $name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="img/<?php echo $image;?>" class="img-circle" alt="User Image">

                <p>
                    <?php echo $email; ?>
                  <small>Member since <?php echo $date; ?></small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
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
        
      <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/<?php echo $image?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $name; ?></p>
          <!-- Status -->
          <a href="index.php"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
  

      <!-- search form (Optional) -->
      <form action="search.php" method="POST" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="val" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
          <a href="#"><i class="fa fa-list"></i> <span>Category</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <?php 

                  $select = "SELECT * FROM categories";
                  $stmt = $pdo->prepare($select);
                  $stmt->execute();
                  while($cat = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $cat_id = $cat['cat_id'];
                      $cat_title = $cat['cat_title']; ?>

                            
                            <li><a href="categories.php?id=<?php echo $cat_id;?>"><?php echo $cat_title;?></a></li>
                           

                  <?php }
                           
                      ?>
          </ul>
        </li>
        <li><a href="profile.php"><i class="fa fa-folder"></i> <span>Profile</span></a></li>
        <li><a href="pwchange.php"><i class="fa fa-laptop"></i> <span>change Password</span></a></li>
        <li><a href="report.php"><i class="fa fa-font"></i> <span>report</span></a></li>
        <li><a href="notification.php"><i class="fa fa-bullhorn"></i><span class="badge bg-yellow"> Notification <?php
                $select2=$pdo->prepare("select * from notification");
                $select2->execute();
               echo $count=$select2->rowCount();
              ?> </span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <?php } 
                    }
  ?>