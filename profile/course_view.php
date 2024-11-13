<?php
    session_start();
    if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']){
        header("Location: index.php");
        exit();
    };
    require_once('./../config/Config.php');
    $crs_id = filter_input(INPUT_GET,'crs_id',FILTER_VALIDATE_INT);
    $lessn_id = filter_input(INPUT_GET,'lessn_id',FILTER_VALIDATE_INT);

    if(!$crs_id){
        header("Location: /profile/index.php");
        exit();
    }
    $db = getDbInstance();
    $course = $db->where('id',$crs_id)->getOne('courses');
    $all_lessons = $db->where('course_id',$course['id'])->orderBy('id','asc')->get('lessons');

    if(!$lessn_id){
        $lesson = $all_lessons[0];
    }else{
        $lesson = $db->where('id',$lessn_id)->getOne('lessons');
       
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


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    

    <!-- Main content -->

    <!-- /.content -->

    <section>
    <?php
            require_once('./template/flash_messages.php')
        ?>
        <div class="container-fluid">
             <!-- /.row -->
        <div class="row px-3 py-3">
            <div class="col-md-8 col-12">
                    <div class="card">
                        <div class="card-body">
                            <video width="100%" height="100%" controls>
                                <source src="/admin/_assets/crs_video/<?php echo $lesson['video'] ?>">
                            </video>
                        </div>
                    </div>

                    <!-- //description card -->
                    <div class="card my-3">
                        <div class="card-header text-center">
                            <h4>Lesson Description</h4>
                        </div>
                        <div class="card-body">
                            <?php echo $lesson['description'] ?>
                        </div>
                    </div>
                     <!-- //description card -->
            </div>
            <div class="col-md-4 col-12">
                
                <div class="card">
                    <div class="card-header">
                       <h3> <?php echo $course['name'] ?></h3>
                       <p>lesson:</p>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php 
                                if($all_lessons){
                                    foreach($all_lessons as $key=>$s_lesson){
                                       
                                        if($s_lesson['id'] == $lessn_id || (!$lessn_id && $key ==0)){
                                            echo "<li class='list-group-item active' ><a style='color:#ffffff' href='/profile/course_view.php?crs_id=".$course['id']."&lessn_id=".$s_lesson['id']."'>".$s_lesson['name']."</a></li>";
                                        }else{
                                            echo "<li class='list-group-item'><a href='/profile/course_view.php?crs_id=".$course['id']."&lessn_id=".$s_lesson['id']."'>".$s_lesson['name']."</a></li>";
                                        }
                                        
                                    }
                                }
                            
                            ?>
                        </ul>
                    </div>
                </div>

                
            </div>


            <?php

                
            ?>

        </div>
        <div class="row">
            <div class="col-12 ">
               
            </div>
        </div>
        </div>
    </section>

</div>
<!-- /.content-wrapper -->


<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>



<?php
require_once('./template/bottom.php')
    ?>