<?php
session_start();
require_once('./includes/header.php')
?>

  <div class="container my-5">
	<div class="row">
		<?php
			include("./includes/flash_messages.php");
			
		?>

		<div class="col-12 col-md-6 offset-md-3">
	
					<div class="card mt-5">
					<div class="card-header d-flex justify-content-between">
                        Register Yourself
                        <a href="./" class="btn btn-primary">Home</a>
                    </div>
						<div class="card-body">

						<form class="form loginform" method="POST" action="./store.php">
							
								<div class="form-group">
									<label class="control-label">
									<i class="fa-solid fa-user"></i>
										Name</label>
									<input type="text" name="name" class="form-control" required="required">
								</div>
                                <div class="form-group mt-2">
									<label class="control-label">
									<i class="fa-solid fa-envelope"></i>
										Email</label>
									<input type="email" name="email" class="form-control" required="required">
								</div>
								<div class="form-group mt-2">
									<label class="control-label">
									<i class="fa-solid fa-key"></i>
									password</label>
									<input type="password" name="passwdord" class="form-control" required="required">
								</div>
								
								
								<div class="d-flex justify-content-end mt-2">
								<button type="submit" class="btn btn-success loginField">Login</button>
								</div>
							
						
					</form>
						</div>
						<div class="card-footer d-flex justify-content-between py-2">
							<p>You Have Account <a href="./login.php">Login</a></p>
							
						</div>
					</div>

		</div>
	</div>
  </div>

  <?php
require_once('./includes/footer.php')
?>