<?php
session_start();
if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in'] || $_SESSION['admin_type'] != "admin"){
    header("Location: /index.php");
    exit();
};
require_once('./../config/Config.php');

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

<a href="./add_student.php" class="btn btn-danger" style="position:fixed;bottom:30px;right:50px;z-index:789"><i class="fa fa-plus" aria-hidden="true"></i></a>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Students</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php 
    $db = getDbInstance();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = filter_input(INPUT_POST,'delete_id',FILTER_VALIDATE_INT);
      if($id){
        $db->where('id',$id)->delete("users");
      }
    }
    $page = filter_input(INPUT_GET,'page',FILTER_VALIDATE_INT);
    if(!$page){
      $page = 1;
        }
        
    $db->pageLimit = 5;

    $all = $db->orderBy('id','desc')->arraybuilder()->paginate("users", $page);

?>

    <!-- Main content -->

    <!-- /.content -->

    <section>
        <div class="container-fluid">
             <!-- /.row -->
        <div class="row">
            <div class="col-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Students</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th style="width: 40px">Occupation</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  foreach($all as  $st){ ?>
                    <tr>
                      <td><?php  echo $st['id'] ?></td>
                      <td><?php  echo $st['name']  ?></td>
                      <td>
                       <?php  echo $st['email']  ?>
                      </td>
                      <td><?php  echo $st['type'] ?></td>
                      <td>
                      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                            <!-- <a href="#" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> -->
                             <input type="hidden" name="delete_id" value="<?php echo $st['id'] ?>">
                            </a>
                            <button onclick="confirm('Are You sure to delete this user') ? this.parent.submit() : '' " type="submit" class="btn btn-danger">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>

                        </form>

                      </td>
                    </tr>

                    <?php } ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                <?php echo paginateController('/admin/students.php',$db->totalPages,$page) ?>
                </ul>
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