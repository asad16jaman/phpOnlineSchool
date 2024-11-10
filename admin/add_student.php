<?php
session_start();
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

<button class="btn btn-danger" style="position:fixed;bottom:60px;right:10px"><i class="fa fa-plus" aria-hidden="true"></i></button>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->

    <section>
        <div class="container-fluid">
             <!-- /.row -->
        <div class="row">
            <?php  require_once "./template/flash_messages.php" ?>
            <div class="col-lg-6 col-md-8 col-12 offset-lg-3 offset-md-2">
                <div class="card p-3 mt-3">
                    <h3 class="text-center">Student Detail</h3>
                    <div class="card-body">
                        <form action="./store_student.php" method="post">
                        <div class="form-group">
                                <label for="">Name</label>
                                <input type="name" name="name" class="form-control" id="" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="">Email address</label>
                                <input type="email" name="email" class="form-control" id="" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select name="type" class="form-control">
                                    <option value="student">Student</option>
                                    <option value="instructor">instructor</option>
                                    <option value="admin">admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" name="password" class="form-control"  placeholder="Enter Password">
                            </div>
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