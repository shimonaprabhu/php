<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/E-Commerce/core/init.php';
	if(!is_logged_in()){
		login_error_redirect();
	}
	include 'includes/head.php';
	//$password='password';
	//$hashed=password_hash($password,PASSWORD_DEFAULT);
	//echo $hashed ;
	$hashed=$user_data['password'];
	$old_password=((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
	$old_password=trim($old_password);
	$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
	$password=trim($password);
	$confirm=((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
	$confirm=trim($confirm);
	$new_hashed=password_hash($password,PASSWORD_DEFAULT);
	$user_id=$user_data['id'];
	$errors=array();
	?>
	
<div id="login-form">
	<div>
		
	<?php
	if ($_POST) {
		//form validation
		if (empty($_POST['old_password'])||empty($_POST['password'])||empty($_POST['confirm'])) {
			$errors[]='You must fill all details';
		}

		

		//password is more than 6 characters
		if (strlen($password)<6) {
			$errors[]='Password must be atleast 6 characters';
		}

		//check if new password matches confirm
		if($password!=$confirm){
			$errors[]='The new password and confirm new password do not match';
		}

		if(!password_verify($old_password,$hashed)){
			$errors[]='Your old password does not match our records';
		}

		//check for errors
		if (!empty($errors)) {
			echo display_errors($errors);
		}else{

			//change password
			$db->query("UPDATE users SET password='$new_hashed' WHERE id='$user_id'");
			$_SESSION['success_flash']='Your password has been updated';
			header('Location:index.php');

		}
	}

	?>

	</div>
	<h2 class="text-center">Change password</h2>
	<form action="change_password.php" method="post">
		<div class="form-group">
			<label for="password">Old password</label>
			<input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
		</div>
		<div class="form-group">
			<label for="password">New password</label>
			<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
		</div>
		<div class="form-group">
			<label for="confirm">Confirm new password</label>
			<input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
		</div>
		<div class="form-group">
			<a href="index.php" class="btn btn-default">Cancel</a>
			<input type="submit" value="Login" class="btn btn-primary">
		</div>
	</form>
	<p class="text-right">
		<a href="/E-Commerce/project.php alt="home" >Visit Site</a>
	</p>
	</p>
</div>

<?php include 'includes/footer.php';?>
