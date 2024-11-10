<?php

session_start();
require_once './config/config.php';

// If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE)
{
	header('Location:index.php');
}

// If user has previously selected "remember me option": 
if (isset($_COOKIE['series_id']) && isset($_COOKIE['remember_token']))
{
	// Get user credentials from cookies.
	$series_id = filter_var($_COOKIE['series_id']);
	$remember_token = filter_var($_COOKIE['remember_token']);
	$db = getDbInstance();
	// Get user By series ID: 
	$db->where('serial_id ', $series_id);
	$row = $db->getOne('users');
	if($row){

		if(password_verify($remember_token,$row['remember_token'])){
			// Verify if expiry time is modified. 
			$expires = strtotime($row['expires']);

			if (strtotime(time()) > $expires)
			{
				// Remember Cookie has expired. 
				clearAuthCookie();
				header('Location:login.php');
				exit;
			}
			$_SESSION['user_logged_in'] = TRUE;
			$_SESSION['admin_type'] = $row['type'];
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['email'] = $row['email'];
			header('Location: index.php');
			exit;






		}else{
			clearAuthCookie();
			header("Location: login.php");
			exit();
		}

	}else{
		clearAuthCookie();
		header("Location: login.php");
		exit();
	}


}










require_once('./includes/header.php')
?>

  <!-- NavBar start -->
<?php
// require_once('./includes/navbar.php')
?>
  <!-- NavBar end -->



  <div class="container my-5">
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3">
	
					<div class="card mt-5">
							<div class="card-header d-flex justify-content-between">
								Please Sign in
								<a href="./" class="btn btn-primary">Home</a>
							</div>
						<div class="card-body">

						<form class="form loginform" method="POST" action="./authenticate.php">
							
								<div class="form-group">
									<label class="control-label">
									<i class="fa-solid fa-envelope"></i>
										Email</label>
									<input type="text" name="email" class="form-control" required="required">
								</div>
								<div class="form-group mt-2">
									<label class="control-label">
									<i class="fa-solid fa-key"></i>
									password</label>
									<input type="password" name="password" class="form-control" required="required">
								</div>
								<div class="checkbox mt-2">
									<label>
										<input name="remember" type="checkbox" value="1">Remember Me
									</label>
								</div>
								<?php if (isset($_SESSION['login_failure'])): ?>
								<div class="alert alert-danger alert-dismissable fade in">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<?php
									echo $_SESSION['login_failure'];
									unset($_SESSION['login_failure']);
									?>
								</div>
								<?php endif; ?>
								<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-success loginField">Login</button>
								</div>
							
						
					</form>
						</div>
						<div class="card-footer d-flex justify-content-between py-2">
							<p>Dont have Account! <a href="./register.php">Register</a></p>
							<p>Forget Password! <a href="">Reset</a></p>
						</div>
					</div>

		</div>
	</div>
  </div>

  <?php
require_once('./includes/footer.php')
?>