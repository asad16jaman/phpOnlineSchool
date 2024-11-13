<?php
    session_start();
    if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']){
        header("Location: index.php");
        exit();
    };
    require_once('./../config/Config.php');
    $db = getDbInstance();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        $id = filter_input(INPUT_POST,'delete_id',FILTER_VALIDATE_INT);     
        if($id){
          try{
          $db->where('id',$id)->delete("feedbacks");
  
          }catch(Exception $e){
              //hae to handle
          }
        }
        
      }



    $page = filter_input(INPUT_GET,'page',FILTER_VALIDATE_INT);
    if(!$page){
      $page = 1;
        }
        
    $db->pageLimit = 5;

    $all = $db->arraybuilder()->paginate("feedbacks", $page);




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
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Feedbacks</h1>
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
        <div class="row px-3 py-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Feedbacks</h3>
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
                      <th>Id</th>
                      <th>Content</th>
                      <th>Course Id</th>
                      <th>Student Id</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($all as $data) {?>
                      <tr>
                      <td><?php echo $data['id'] ?></td>
                      <td><?php echo $data['fedbk'] ?></td>
                      <td><?php echo $data['course_id'] ?></td>                  
                      <td><?php echo $data['user_id'] ?></td>                  
                      <td>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                           
                          <input type="hidden" name="delete_id" value="<?php echo $data['id'] ?>">
                            <button onclick="confirm('Are You sure to delete this user') ? this.parent.submit() : '' " type="submit" class="btn btn-danger">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
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
                <?php echo paginateController('/admin/feedbackList.php',$db->totalPages,$page) ?>
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