<?php
session_start();
require_once('./config/Config.php');

$db = getDbInstance();
$db->pageLimit = 6;
$popular_course = $db->arraybuilder()->paginate("courses", 1);

require_once('./includes/header.php')
?>

  <!-- NavBar start -->
<?php
require_once('./includes/navbar.php')
?>
  <!-- NavBar end -->
  <!-- Banner section Sttart -->
  <div class="container-fluid g-0" id="home">
    <div class="banner-video">
    <video autoplay loop muted >
      <source src="./assets/video/banner.mp4"  type="video/mp4">
    </video>
    </div>
    <div class="banner-overlay">
    </div>
    <div class="banner-messages">
          <h3>Wellcome to ITSD</h3>
          <p>Learn and Implemented</p>
          <button class="btn btn-danger">Get started</button>
      </div>
  </div>
  <!-- Banner section end -->
  <!-- Banner heighliger start -->
  <div class="heighliter">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-sm-6 col-12 mt-md-2  text-center">
        <p>1000+ Online Course</p>
      </div>
      <div class="col-lg-3 col-sm-6 col-12 mt-md-2 text-center">
        <p>Expart Instructor</p>
      </div>
      <div class="col-lg-3 col-sm-6 col-12 mt-md-2 text-center">
        <p>Life Time Access</p>
      </div>
      <div class="col-lg-3 col-sm-6 col-12 mt-md-2 text-center">
        <p>Money Back Guarantee</p>
      </div>
    </div>
  </div>
  </div>
    <!-- Banner  heighliger end -->
    <!--Course Section Start -->
    <div class="container">
      <div class="content_header">
        <h1 class="text-center" >Popular Course</h1>
      </div>
      <div class="content_body">
        <div class="row">
          <!-- subject - 1-->
          <?php foreach($popular_course as $course){ ?>
            <div class="col-12 col-md-6 col-lg-4 py-1">
          <div class="card" style="width: 18rem;">
            <img src="./admin/_assets/crs_thum/<?php echo $course['img'] ?>" class="card-img-top" style="height:160px" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo strtoupper($course['name'])?></h5>
              <p class="card-text">
                <?php
                    echo limit_words($course['description'],20)."..."
                ?>
              </p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center"><span>Price: <del><?php echo $course['price'] ?></del> <?php echo $course['sell_price'] ?></span>
                <!-- <button class="btn btn-primary">Enroll</button> -->
                 <a href="/course.php?crs_id=<?php echo $course['id'] ?>" class="btn btn-primary">View</a>
            </li>
            </ul>
          </div>
          </div>

          <?php } ?>
        </div>
      </div>
    </div>
    <!-- Course Section end -->
<!--  Contact Section Start -->
  <?php
  require_once('./includes/contact.php')
  ?>
<!--  Contact Section end -->
    <!-- Feedback Start -->
    <div class="conatiner-fluid bg-primary py-5 px-3" id="feedbackSection">
      <div class="content_header">
        <h1 class="text-center" >Student Feedback</h1>
      </div>

      <div class="owl-carousel">

          <div class="">
              <div class="card">
                <div class="card-body">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime mollitia, dolores quos quasi tenetur autem aspernatur deleniti id voluptates sequi?
                </div>
              </div>
          </div>
          <div class="">
              <div class="card">
                <div class="card-body">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime mollitia, dolores quos quasi tenetur autem aspernatur deleniti id voluptates sequi?
                </div>
              </div>
          </div>
          <div class="">
              <div class="card">
                <div class="card-body">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime mollitia, dolores quos quasi tenetur autem aspernatur deleniti id voluptates sequi?
                </div>
              </div>
          </div>
          <div class="">
              <div class="card">
                <div class="card-body">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime mollitia, dolores quos quasi tenetur autem aspernatur deleniti id voluptates sequi?
                </div>
              </div>
          </div>
          <div class="">
              <div class="card">
                <div class="card-body">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime mollitia, dolores quos quasi tenetur autem aspernatur deleniti id voluptates sequi?
                </div>
              </div>
          </div>
          <div class="">
              <div class="card">
                <div class="card-body">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime mollitia, dolores quos quasi tenetur autem aspernatur deleniti id voluptates sequi?
                </div>
              </div>
          </div>
          <div class="">
              <div class="card">
                <div class="card-body">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime mollitia, dolores quos quasi tenetur autem aspernatur deleniti id voluptates sequi?
                </div>
              </div>
          </div>
          <div class="">
              <div class="card">
                <div class="card-body">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime mollitia, dolores quos quasi tenetur autem aspernatur deleniti id voluptates sequi?
                </div>
              </div>
          </div>

      </div>

      


    </div>
    <!-- carousel end -->
<?php
require_once('./includes/footer_indecator.php')
?>

    
<?php
require_once('./includes/footer.php')
?>

  