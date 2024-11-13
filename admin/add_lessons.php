<?php
session_start();
if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in'] || $_SESSION['admin_type'] != "admin"){
    header("Location: /index.php");
    exit();
};
require_once('./../config/Config.php');
    $edit = false;

    //get course Id
    $crs_id = filter_input(INPUT_GET,'crs');
    if(!$crs_id){
        //if there is no course id it will go courselist page 
        header("Location: courselist.php");
        exit();
    }

    $db = getDbInstance();
    $data = $db->where('id',$crs_id)->getOne('courses');
    if(!$data){
        //it there is course id but if  there is no course for this id  also  redirect in  courselist page
        header("Location: courselist.php");
        exit();
    }
    





require_once('./template/top.php');

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
    
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->

    <section>
        <?php
            require_once('./template/flash_messages.php')
        ?>
        <div class="container-fluid">
             <!-- /.row -->
            <div class="row">
                <div class="col-md-6 col-12 offset-md-3">
                <div class="card my-3">
                    <div class="card-body">
                        <h3 class="text-center">Lesson Detail </h3>
                        <form action="./store_lesson.php?crs=<?php echo $crs_id ?>" method="post" enctype="multipart/form-data">
                            <?php require_once('./forms/lesson.php') ?>
                            <div class="d-flex justify-content-end">
                                <input type="submit" name="end" value="Add More" class="btn btn-success">
                                <input type="submit" value="Add" class="btn btn-success mx-3">
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
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>



<?php
require_once('./template/bottom.php')
    ?>