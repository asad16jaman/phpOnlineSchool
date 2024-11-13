<?php
session_start();
if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in'] || $_SESSION['admin_type'] != "admin"){
    header("Location: /index.php");
    exit();
};
    require_once('./../config/Config.php');

    if(!isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] != true){
        header("Location: /login.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_id = $_SESSION['user_id'];
        $old_password = filter_input(INPUT_POST,'c_password');
        $password = filter_input(INPUT_POST,'password');
        $confirm_password = filter_input(INPUT_POST,'confirm_password');

        if(strlen($password)<=7){
            $_SESSION['info'] = "password must be gater then 7";
            header("Location:  change_password.php");
            exit();
        }

        $db = getDbInstance();
        $current_user = $db->where("id",$user_id)->getOne('users');
        if(password_verify($old_password,$current_user['password'])){
            if($password === $confirm_password){
                try{
                    $db->where("id",$user_id)->update('users',['password'=>password_hash($password,PASSWORD_DEFAULT)]);
                    $_SESSION['success'] = "successfully created new password";
                    header("Location:  change_password.php");
                    exit();
                }catch(Exception $e){
                    $_SESSION['info'] = $e->getMessage();
                header("Location:  change_password.php");
                exit();
                }

            }else{
                $_SESSION['info'] = "New password and Confirm Password must be same";
                header("Location:  change_password.php");
                exit();

            }

        }else{
            $_SESSION['failure'] = "please provide currect password";
            header("Location:  change_password.php");
            exit();
        }





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
            <div class="col-md-6 col-12 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center"> Change Password</h3>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="mb-3">
                            <label for="">email</label>
                            <input type="email" name="email" readonly value="<?php echo $_SESSION['email'] ?>" id="" class="form-control">
                            <p>this field is not changable</p>
                        </div>
                        <div class="mb-3">
                            <label for="">Current Password</label>
                            <input type="password" name="c_password"   id="" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">New Password</label>
                            <input type="password" name="password"  id="" class="form-control">

                        </div>
                        <div class="mb-3">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirm_password" id="" class="form-control">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Chang</button>
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