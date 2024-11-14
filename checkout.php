<?php
session_start();
if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']){
    header("Location: login.php");
    exit();
};
require_once('./config/Config.php');



$course_id = filter_input(INPUT_GET,'crs_id');

if(!$course_id){
  header("Location: /");
  exit();
}

$db = getDbInstance();
$course = $db->where('id',$course_id)->getOne('courses');
$auth_user = $db->where('id',$_SESSION['user_id'])->getOne('users');
$profile = $db->where('user_id',$_SESSION['user_id'])->getOne('profiles');
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
                    <p>Name: <?php echo $auth_user['name'] ?></p>
                    <p>Email: <?php echo $auth_user['email'] ?></p>
                    <p>Phone: <?php echo ($profile['phone']) ? $profile['phone'] : "Not Set Yet" ?></p>
                    <p>City: <?php echo ($profile['city']) ? $profile['city'] : "Not Set Yet" ?></p>
                    <p>Address: <?php echo ($profile['address']) ? $profile['address'] : "Not Set Yet" ?></p>
                    <p>Course Name: <?php echo $course['name'] ?></p>
                    <p>Cost : <?php echo $course['sell_price'] ?></p>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2">
                        <?php if(!$is_purces){ ?>
                            <form action="purchaces.php?crs_id=<?php echo $course['id'] ?>" method="post">
                                <input type="text" hidden name="amount"  value="<?php echo $course['sell_price']  ?>" id="">
                                <input type="text" hidden name="course_name" value="<?php echo $course['name']  ?>" id="">
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