<nav class="navbar navbar-expand-md fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Korani</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 navContent">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./courses.php">Courses</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="./payment.php">Payment</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./#feedbackSection">Feedback</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./#contactPage">Contact</a>
          </li>
        </ul>
        <div class="d-flex justify-contend-end">
          <div class="btn-group toggleMain ">
            <div class="drop-btn">
              <a href="#"><img src="./assets/img/default-avatar.png" alt="" class="profileImage"></a>
            </div>
            <button type="button" class="btn drop dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
              aria-expanded="false">
              <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu manu-margin">
              <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']==true){ ?>
              <li><a class="dropdown-item" href="./profile">Profile</a></li>
              <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
              <?php }else{ ?>
              <li><a class="dropdown-item" href="./login.php">Login</a></li>
              <li><a class="dropdown-item" href="./register.php">Register</a></li>
              <?php } ?>
              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>