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

$is_purces = $db->where('course_id',$course_id)->where('user_id',$_SESSION['user_id'])->getOne('user_courses');




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


<div class="container">
    <div class="row my-5">
        <div class="col-md-8 col-12">
            <div class="row">
            <div class="col-8 offset-2 offset-md-0 col-md-4">
            <img src="./admin/_assets/crs_thum/<?php echo $course['img'] ?> "  alt="" class="img-fluid rounded">
        </div>
        <div class="col-12 col-md-8">
            <h3>Course Name : <?php echo $course['name'] ?></h3>
            <p class="text-justify text-justify">
                Description : <?php echo $course['description'] ?>   
            </p>
            
            <div class="d-flex justify-content-between">
                <div>
                    <p>Duration : <?php echo $course['duration'] ?> </p>
                    <p>Price : <del><?php echo $course['price'] ?> </del> <span><?php echo $course['sell_price'] ?> </span><span>&#2547;</span></p>
                </div>
                <div>
                </div>
            </div>
        </div>
            </div>
        </div>
       <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header">
                    Card Detail
                </div>
                <div class="card-body">
                    <p>Name: Asad</p>
                    <p>Email: asad@gmail.com</p>
                    <p>Phone: 01755240250</p>
                    <p>City: Dhaka</p>
                    <p>Address: Tongi,Dhaka</p>
                    <p>Cost : 500</p>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2">
                        <?php if(!$is_purces){ ?>
                            <form action="purchaces.php?crs_id=<?php echo $course['id'] ?>" method="post">
                         <input type="submit" value="Checkout" class="btn btn-primary">
                        </form>

                        <?php }else{ ?>
                                <p class="text-center">You Have purches this course</p>
                        <?php } ?>
                       
                    </div>
                </div>
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