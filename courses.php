<?php
session_start();
require_once('./config/Config.php');

$page = filter_input(INPUT_GET,'page',FILTER_VALIDATE_INT);
    if(!$page){
      $page = 1;
        }
$db = getDbInstance();
$db->pageLimit = 6;
try{
  $allCourses = $db->arraybuilder()->paginate("courses", $page);
}catch(Exception  $e){
  //
}

require_once('./includes/header.php')
?>

<!-- NavBar start -->
<?php
require_once('./includes/navbar.php')
?>
<!-- NavBar end -->

<!-- NavBar start -->
<?php
require_once('./includes/topBanner.php')
?>
<!-- NavBar end -->

<div class="container">
    <div class="content_header">
        <h1 class="text-center" >All Courses</h1>
    </div>
      <div class="content_body">
        <div class="row">

        <?php  foreach($allCourses as $course){ ?>
            <!-- subject - 1-->
          <div class="col-12 col-md-6 col-lg-4 py-1">
          <div class="card" style="width: 18rem;">
            <img src="./admin/_assets/crs_thum/<?php echo $course['img'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $course['name'] ?></h5>
              <p class="card-text"><?php echo limit_words($course['description'],20)."..." ?></p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center"><span>Price: <del><?php echo $course['price'] ?></del> <?php echo $course['sell_price'] ?></span>
                 <a class="btn btn-primary" href="/course.php?crs_id=<?php echo $course['id'] ?>">View Details</a>
            </li>
            </ul>
          </div>
          </div>
        <?php  }?>
        </div>
      </div>
    <div class="content-footer">
      <div class="row">
      <div class="clearfix d-flex justify-content-center my-3">
                <ul class="pagination pagination-sm m-0 float-right">
                <?php echo paginateController('/courses.php',$db->totalPages,$page) ?>
                </ul>
              </div>
      </div>
    </div>
   
</div>

<?php
require_once('./includes/footer_indecator.php')
?>



<?php
require_once('./includes/footer.php')
?>