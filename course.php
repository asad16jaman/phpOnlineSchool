<?php
session_start();
require_once('./config/Config.php');
$course_id = filter_input(INPUT_GET,'crs_id');
if(!$course_id){
  header("Location: /");
  exit();
}

$db = getDbInstance();
$course = $db->where('id',$course_id)->getOne('courses');
if(!$course){
  header("Location: /");
  exit();
}

$lessons = $db->where('course_id',$course['id'])->get('lessons');




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
    <div class="row pt-5 mb-3">
        <div class="col-8 offset-2 offset-md-0 col-md-4">
            <img src="./admin/_assets/crs_thum/<?php echo $course['img'] ?> "  alt="" class="img-fluid rounded">
        </div>
        <div class="col-12 col-md-8">
            <h3>Course Name : <?php echo $course['name'] ?></h3>
            <p class="text-justify">
                Description : <?php echo $course['description'] ?>   
            </p>
            
            <div class="d-flex justify-content-between">
                <div>
                    <p>Duration : <?php echo $course['duration'] ?> </p>
                    <p>Price : <del><?php echo $course['price'] ?> </del> <span><?php echo $course['sell_price'] ?> </span><span>&#2547;</span></p>
                </div>
                <div>
                <a href="/checkout.php?crs_id=<?php echo $course['id'] ?>" class="btn btn-primary">Enroll Me</a>
                </div>
            </div>
        </div>
    </div>
    <?php if($lessons){ ?>
    <div class="row mb-5">

        <div class="col-12">
        <div class="card">
            <div class="card-body">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>Lesson No</th>
                    <th>Lesson Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        foreach($lessons as $key=>$lesson){ ?>
                    <tr>
                    <td><?php echo $key+1 ?></td>
                    <td><?php echo $lesson['name'] ?></td>
                </tr>
                <?php } ?>
                
                
            </tbody>
        </table>
            </div>
        </div>
        </div>
    </div>

    <?php } ?>
</div>







<?php
require_once('./includes/footer_indecator.php')
?>



<?php
require_once('./includes/footer.php')
?>