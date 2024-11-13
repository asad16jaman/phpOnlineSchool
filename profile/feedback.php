<?php
session_start();
if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']){
    header("Location: login.php");
    exit();
};
require_once('./../config/Config.php');
$db= getDbInstance();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $course_id = filter_input(INPUT_POST,'course_id',FILTER_VALIDATE_INT);
    $feedback = filter_input(INPUT_POST,'feedback');
    $feedback = clean_input($feedback);

    if($course_id && $feedback !== ""){
        $check = $db->where('user_id',$_SESSION['user_id'])->where('course_id',$course_id)->get('feedbacks');
        if($check){
            //update previous feedback
            $db->where('user_id',$_SESSION['user_id'])->where('course_id',$course_id)->update('feedbacks',['fedbk'=>$feedback]);
            header("Location: /profile/index.php");
            exit();
        }else{
            //create new feedback
            $fedbk = $db->insert('feedbacks',['user_id'=>$_SESSION['user_id'],'course_id'=>$course_id,'fedbk'=>$feedback]);
            header("Location: /profile/index.php");
            exit();
        }

    }else{


    }
}




$crsId = filter_input(INPUT_GET,'crs_id',FILTER_VALIDATE_INT);
if($crsId){
    //all courses
    $course = $db->where('id',$crsId)->getOne('courses');
}else{
    $userId = $_SESSION['user_id'];
    $myallCourses = $db->rawQuery("SELECT  courses.id,courses.name FROM user_courses INNER JOIN courses ON user_courses.course_id = courses.id WHERE user_courses.user_id=$userId");
}





require_once('./template/top.php')
?>


<!-- Navbar -->
<?php
require_once('./template/nav.php')
    ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php
require_once('./template/sidebar.php')
    ?>
<!-- Main Sidebar Container -->

<!-- <button class="btn btn-danger" style="position:fixed;bottom:60px;right:10px"><i class="fa fa-plus" aria-hidden="true"></i></button> -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   

    <!-- Main content -->

    <!-- /.content -->

    <section>
        <div class="container-fluid">
             <!-- /.row -->
        <div class="row px-3 py-3">
            <div class="col-md-6 col-12 offset-md-3">
                <div class="card">
                    <div class="card-body">
                    <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Feedback</label>
                        <textarea name="feedback" class="form-control" placeholder="Type Your important feedback" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Course</label>
                        <?php if($crsId){ ?>
                            <select name="course_id" id="" class="form-control">
                                <option selected value="<?php echo $crsId ?>"><?php echo $course['name'] ?></option>
                            </select>
                        <?php }else{ ?>
                            <select name="course_id" id="" class="form-control">
                                <option value="">Select Course*</option>
                                <?php foreach($myallCourses as $course){
                                    echo "<option value='".$course['id']."'>".$course['name']."</option>";
                                }
                                
                                ?>
                            </select>

                        <?php } ?>
                        
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        
		
        </div>
    </section>

</div>
<!-- /.content-wrapper -->


<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="">Asaduzzaman</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>



<?php
require_once('./template/bottom.php')
    ?>