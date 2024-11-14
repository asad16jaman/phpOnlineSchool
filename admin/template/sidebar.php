
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="/assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ITSD</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php if($_SESSION['image']){ ?>
             <img src="/profile/picture/<?php echo $_SESSION['image'] ?>" class="img-circle elevation-2" alt="User Image">
          <?php }else{ ?>
            <img src="/profile/prcture/avater.png" class="img-circle elevation-2" alt="User Image">
            <?php } ?>
        </div>
        <div class="info">
          <a href="/profile/index.php" style="text-decoration:underline" class="d-block"><?php echo $_SESSION['email']."( profile)" ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
               <li class="nav-item">
                <a href="./" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./courselist.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                  <p>Courses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./lessonlist.php" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                  <p>Lessons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./students.php" class="nav-link">
                <i class="fa fa-users" aria-hidden="true"></i>
                  <p>Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/sell_report.php" class="nav-link">
                <i class="fa-solid fa-receipt"></i> 
                  <p>Sell Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/feedbackList.php" class="nav-link">
                <i class="fa-solid fa-message"></i> 
                  <p>Feedback</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./change_password.php" class="nav-link">
                <i class="fa-solid fa-key"></i>
                  <p>Change Password</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="/logout.php" class="nav-link">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                  <p>Logout</p>
                </a>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
