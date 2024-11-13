<?php
session_start();
if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in'] || $_SESSION['admin_type'] != "admin"){
    header("Location: /index.php");
    exit();
};
require_once('./../config/Config.php');
require_once('./template/top.php');
$edit = true;

$id = filter_input(INPUT_GET,'crs_id');
if($id){
    $db = getDbInstance();
    $data = $db->where('id',$id)->getOne('courses');
}else{

    exit();
}


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
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Course Update</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->

    <section>
        <div class="container-fluid">
             <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-8 col-12 offset-md-2 offset-lg-3">
                <div class="card py-3">
                    <h3 class="text-center">Course detail</h3>
                    <div class="card-body">
                        <form action="./update_course.php?crs_id=<?php echo $data['id'] ?>" method="post"  enctype="multipart/form-data">
                        <?php require_once('./forms/course.php') ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
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