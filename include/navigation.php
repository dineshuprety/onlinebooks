<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/<?php echo $_SESSION['image'];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['name']; ?></p>
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
        <li><a href="notification.php"><i class="fa fa-table"></i> <span>notification</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
