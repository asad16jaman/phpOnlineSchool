<?php
session_start();
if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in'] || $_SESSION['admin_type'] != "admin"){
    header("Location: /index.php");
    exit();
};
$page = filter_input(INPUT_GET,'page',FILTER_VALIDATE_INT);
if(!$page){
  $page = 1;
    }
require_once('./../config/Config.php');
$db = getDbInstance();

//delete  order
if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    $id = filter_input(INPUT_POST,'delete_id',FILTER_VALIDATE_INT);     
    $user_id = filter_input(INPUT_POST,'user_id',FILTER_VALIDATE_INT);     
    $course_id = filter_input(INPUT_POST,'course_id',FILTER_VALIDATE_INT);     
    if($id){
      try{
      $db->where('id',$id)->delete("orders");
      $db->where('user_id',$user_id)->where('course_id',$course_id)->delete("user_courses");
      }catch(Exception $e){
          //hae to handle
      }
    }
    
  }


$db->pageLimit = 5;

$all = $db->arraybuilder()->paginate("orders", $page);
   





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
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->

    <section>
        <div class="container-fluid">
             <!-- /.row -->
        <div class="row px-2 py-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ordered Courses</h3>

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
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                  
                    <tr>
                      <th>#</th>
                      <th>Order Id</th>
                      <th>Course Id</th>
                      <th>Student Email</th>
                      <th>Order Date</th>
                      <th>Amount</th>
                      <th>Action</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                  <?php foreach($all as $key=>$data) {?>
                    <tr>
                      <td><?php echo $key+1 ?></td>
                      <td><?php echo $data['unique_id'] ?></td>
                      <td><?php echo $data['course_id'] ?></td>
                      <td><?php 
                           echo $db->where('id',$data['user_id'])->getOne('users')['email']
                      ?></td>
                      <td><?php echo $data['created_at'] ?></td>
                      <td><?php echo $data['amount'] ?></td>
                      <td>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                            
                          <input type="hidden" name="delete_id" value="<?php echo $data['id'] ?>">
                          <input type="hidden" name="user_id" value="<?php echo $data['user_id'] ?>">
                          <input type="hidden" name="course_id" value="<?php echo $data['course_id'] ?>">
                            <button onclick="confirm('Are You sure to delete this user') ? this.parent.submit() : '' " type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                      </td>
                    </tr>
                    <?php }?>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                <?php echo paginateController('/admin/index.php',$db->totalPages,$page) ?>
                </ul>
              </div>
            </div>
            <!-- /.card -->
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