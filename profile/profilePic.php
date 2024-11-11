<?php
session_start();
require_once('./../config/Config.php');
$db= getDbInstance();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])){
    $profileImg = $_FILES['image'];

    if($profileImg['name'] !== ""){

        
       try{


        $myusr = $db->where('id',$_SESSION['user_id'])->getOne('users');
        if($myusr['image']){
            //frist remove old picture
            if(file_exists("picture/".$myusr['image'])){
                echo "akane astace..";
                unlink("picture/".$myusr['image']);
            }
        }

        $ext = pathinfo($profileImg['name'])['extension'];
        $newName = time().".".$ext;
        move_uploaded_file($profileImg['tmp_name'],'picture/'.$newName);
        $db->where('id',$_SESSION['user_id'])->update('users',['image'=>$newName]);
        $_SESSION['success'] = "successfully updated picture";
        header("Location: index.php");
        exit();

       }catch(Exception  $e){

        $_SESSION['failure'] = "try again later";
        header("Location: profilePic.php");
        exit();

       }
        



    }else{
        $_SESSION['info'] = "first choose an image than submit";
        header("Location: profilePic.php");
        exit();
    }
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Change Profile picture</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->

    <section>
        <?php 
            require_once("template/flash_messages.php")
        ?>
        <div class="container-fluid">
             <!-- /.row -->
        <div class="row px-3 py-3">
            <div class="col-md-6 col-12 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Choose Profile Picture</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="">Profile Image</label>
                        <input type="file" name="image" id="" class="form-control">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-success">
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