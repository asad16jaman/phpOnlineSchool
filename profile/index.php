<?php
session_start();
if(!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']){
  header("Location: index.php");
  exit();
};
require_once('./../config/Config.php');
$db= getDbInstance();



$userId = $_SESSION['user_id'];
$current_user = $db->where("id",$_SESSION['user_id'])->getOne("users");
$current_profile = $db->where("user_id",$_SESSION['user_id'])->getOne("profiles");

if($_SESSION['admin_type'] != 'admin'){
  //all courses
$myallCourses = $db->rawQuery("SELECT user_courses.created_at as purces_time,courses.* FROM user_courses INNER JOIN courses ON user_courses.course_id = courses.id WHERE user_courses.user_id=$userId");

//all feedback
$myallfeedback = $db->rawQuery("SELECT feedbacks.*,courses.id as crsId,courses.img,courses.name FROM feedbacks INNER JOIN courses ON feedbacks.course_id = courses.id where feedbacks.user_id=$userId");

}



if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['name'])){
  $name = clean_input(filter_input(INPUT_POST,'name'));
  $occupation = clean_input(filter_input(INPUT_POST,'occupation'));
  $city = clean_input(filter_input(INPUT_POST,'city'));
  $phone = clean_input(filter_input(INPUT_POST,'phone'));
  $address = clean_input(filter_input(INPUT_POST,'address'));

  $pro = Array(
    "city" => $city,
    "phone" => $phone,
    "address" => $address
  );

  $usr = Array(
      "name" => $name,
      "occupation" => $occupation
  );

  try{
    $profile = $db->where('user_id',$_SESSION['user_id'])->update('profiles',$pro);
    $user = $db->where('id',$_SESSION['user_id'])->update('users',$usr);
    $_SESSION['success'] = "Profile Successfully updated";
    header("Location: ./");
    exit();
    
  }catch(Exception $e){
    $_SESSION['success'] = $e->getMessage();
    header("Location: ./");
    exit();

  }


}


require_once('./template/top.php')
?>

<?php
require_once('./template/nav.php')

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->
  
  

    <section class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php if(!$current_user['image']){  ?>
                  <img class="profile-user-img img-fluid img-circle" src="/profile/picture/avatar.png" alt="some ">
                  <?php }else{ ?>
                    <img class="profile-user-img img-fluid img-circle" src="/profile/picture/<?php echo $current_user['image'] ?>" alt="User profile picture">
                    <?php } ?>
                </div>

                <h3 class="profile-username text-center"><?php echo $current_user['name'] ?></h3>

                <p class="text-muted text-center"><?php echo ($current_user['occupation']) ? $current_user['occupation'] : "Not Set Yet" ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Phone</b> 
                    <a class="float-right">
                    <?php echo ($current_profile['phone']) ? $current_profile['phone'] : "Not Set Yet" ?>
                    </a>
                  </li>
                  <li class="list-group-item">
                    <b>City</b> 
                    <a class="float-right">
                    <?php echo ($current_profile['city']) ? $current_profile['city'] : "Not Set Yet" ?>
                    </a>
                  </li>
                </ul>

                <a href="/profile/profilePic.php" class="btn btn-primary btn-block"><b>Update Profile Pic</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <?php if($_SESSION['admin_type'] != 'admin'){ ?>
          <!-- /.col -->
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">My Course</a></li>
                      <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">My Feedback</a></li>
                      <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Profile</a></li>
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content">
                      
                      <!-- /.tab-pane -->
                      <div class="tab-pane active" id="activity">
                        <!-- Second  Tab contend  will be hare... -->
                        <?php if(count($myallCourses)<1){
                          echo "<p>You do not purches any  course </p>";
                        }else{ 
                          foreach($myallCourses as $card){
                          ?>
                        <!-- course card -->
                        
                        <div class="card mb-3">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-4 col-12">
                                <img src="/admin/_assets/crs_thum/<?php echo $card['img'] ?>" class="img-fluid" alt="">
                              </div>
                              <div class="col-md-8 col-12">
                                    <div class="d-flex justify-content-between">
                                        <h3><?php echo $card['name'] ?></h3>
                                        <span><?php echo date("d-m-Y",strtotime($card['purces_time'])) ?></span>
                                    </div>
                                    <p>
                                    <?php echo limit_words($card['description'],40) ?>.....
                                    </p>
                                    <div class="d-flex justify-content-end">
                                      
                                      <a href="/profile/feedback.php?crs_id=<?php echo $card['id'] ?>" class="btn btn-primary">Give Feedback</a>
                                    
                                      <a href="/profile/course_view.php?crs_id=<?php echo $card['id'] ?>" class="btn btn-secondary mx-3">View</a>
                                    </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }; } ?>

                        <!-- course card end -->
                      </div>

                      <div class="tab-pane " id="timeline">
                        <?php if(count($myallfeedback)<1){
                          echo  "<p class='lead'>there is no feedback...</p>";
                        }else{ 
                          foreach($myallfeedback as $feedback){
                          
                          ?>
                        <!-- Post -->
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="/admin/_assets/crs_thum/<?php echo $feedback['img'] ?>" alt="user image">
                            <span class="username">
                              <a href="#"><?php echo $feedback['name'] ?></a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Time - <?php echo date('d/m/Y h:i:sa', strtotime($feedback['created_at'])) ?></span>
                          </div>
                          <!-- /.user-block -->
                          <p>
                            <?php
                                echo $feedback['fedbk']
                            ?>
                          </p>

                        </div>
                        <!-- /.post -->

                        <?php } } ?>

                        






                      </div>
                      <!-- /.tab-pane -->

                      <div class="tab-pane" id="settings">
                        <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="name" name="name" value="<?php echo $current_user['name'] ?>" class="form-control" id="inputName" placeholder="Name">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" readonly name="email" value="<?php echo $current_user['email'] ?>" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Occupation</label>
                            <div class="col-sm-10">
                              <input type="text" name="occupation" value="<?php echo $current_user['occupation'] ?>" class="form-control" id="" placeholder="What You Doing Now">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputExperience" class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                              <input type="text"  name="city" value="<?php echo $current_profile['city'] ?>"  class="form-control" placeholder="Your city" id="">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                              <input type="text"  name="phone" value="<?php echo $current_profile['phone'] ?>" class="form-control" id="inputSkills" placeholder="Skills">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputSkills"  class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                              <textarea name="address" class="form-control" id="" cols="30" rows="5"><?php echo $current_profile['address'] ?></textarea>
                              
                              
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
          <!-- /.col -->
          <?php }else{ ?>
            <div class="col-md-9 py-3">
              <!-- <button class="b">Admin</button> -->
               <!-- <a href="/admin/index.php" class="btn btn-success">Admin</a> -->
                <div class="card">
                  <div class="card-body">
                  <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="name" name="name" value="<?php echo $current_user['name'] ?>" class="form-control" id="inputName" placeholder="Name">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" readonly name="email" value="<?php echo $current_user['email'] ?>" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Occupation</label>
                            <div class="col-sm-10">
                              <input type="text" name="occupation" value="<?php echo $current_user['occupation'] ?>" class="form-control" id="" placeholder="What You Doing Now">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputExperience" class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                              <input type="text"  name="city" value="<?php echo $current_profile['city'] ?>"  class="form-control" placeholder="Your city" id="">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                              <input type="text"  name="phone" value="<?php echo $current_profile['phone'] ?>" class="form-control" id="inputSkills" placeholder="Skills">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputSkills"  class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                              <textarea name="address" class="form-control" id="" cols="30" rows="5"><?php echo $current_profile['address'] ?></textarea>
                              
                              
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                          </div>
                        </form>
                  </div>
                </div>
            </div>
          <?php } ?>
                      
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
require_once('./template/sidebar.php')
?>



















<?php
require_once('./template/bottom.php')
?>