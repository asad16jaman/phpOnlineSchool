<?php
session_start();
require_once('./../config/Config.php');
$crs_id = filter_input(INPUT_GET,'crs');$crs_id = filter_input(INPUT_GET,'crs');
$db = getDbInstance();

if($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['delete_id'])){
    $delete_id=  filter_input(INPUT_POST,'delete_id');
    $deleteData =  $db->where('id',$delete_id)->getOne('lessons');
    try{
        //delete previous file
        if(file_exists('_assets/crs_video/'.$deleteData['video'])){
            unlink('_assets/crs_video/'.$deleteData['video']);
        }
        $succ = $db->where('id',$delete_id)->delete('lessons');
        if($succ){
            
            $_SESSION['success'] = "successfully delete";
            header("Location: lessonlist.php?crs=$crs_id");
            exit();
        }else{
            $_SESSION['failure'] = "there is some problame try latter";
            header("Location: lessonlist.php?crs=$crs_id");
            exit();
        }

    }catch(Exception $e){
        $_SESSION['failure'] = $e->getMessage();
            header("Location: lessonlist.php?crs=$crs_id");
            exit();

    }
}





$course = $db->where('id',$crs_id)->getOne('courses');

$lesson = $db->where('course_id',$crs_id)->get('lessons');


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
<?php if($crs_id && $lesson){ ?>
    <a href="add_lessons.php?crs=<?php echo $crs_id ?> "  class="btn btn-danger" style="position:fixed;bottom:60px;right:10px"><i class="fa fa-plus" aria-hidden="true"></i><a/>
<?php } ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="get">
                <div class="row mb-2">
                    <div class="col-md-6 offset-md-3">
                            <div class="d-flex" style="height:37px">
                                <div class="form-group w-75">
                                    <input type="text" class="form-control py-2" name="crs" id="" placeholder="inter Course ID">
                                </div>
                                <input type="submit" value="Submit" class="btn btn-success">
                            </div>
                    </div>
                </div><!-- /.row -->

            </form>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->
    <?php if($lesson){ ?>
    <section>
    <?php
            require_once('./template/flash_messages.php')
        ?>
        <div class="container-fluid">
             <!-- /.row -->
             <div class="row px-3 py-3">
          <div class="col-12">
            <div class="card">
              
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                     
                      <th>Lesson Id</th>
                      <th>Lesson Name</th>
                      <th>Video</th>
                      <th>Action</th>
                  
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach($lesson as $data) {?>
                      <tr>
                      <td><?php echo $data['id'] ?></td>
                      <td><?php echo $data['name'] ?></td>
                      <td><?php echo $data['video'] ?></td>
                   
                      <td>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?crs=".$crs_id ?>" method="post">
                            <a href="./edit_lesson.php?crs=<?php echo $data['id'] ?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                          <input type="hidden" name="delete_id" value="<?php echo $data['id'] ?>">
                            <button onclick="confirm('Are You sure to delete this user') ? this.parent.submit() : '' " type="submit"  class="btn btn-danger">
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
             
              




            </div>
            <!-- /.card -->
            
          </div>
        </div>
        <!-- /.row -->
        
		
        </div>
    </section>
    <?php }else{
        echo "<p class='text-center'> there is no course for this id </p>";
    }
    
    
    ?>
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