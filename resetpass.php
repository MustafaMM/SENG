<!DOCTYPE html>
<html>
<head>
  <title>
    Reset 
</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <div class="header">
  	<h3>Reset password</h3>
  </div>
	 
  <form method="post" action="resetpass.php">
	<!-- Define form for submitting -->

  	<div class="input-group">
  		<label>Username</label>
  		<input type="test" name="username" >
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="resetPassword">Reset Password</button>
  	</div>
  	<a href="login.php">Sign in instead</a>	
	<div>
	<?php
	session_start();
	include('database.php');
	if(array_key_exists('resetPassword', $_POST)) {
		if(!empty($_POST['username']) && usernameExists($_POST['username'])) {
			$password = substr(sha1(random_int(0, 2147483648)), 0, 16);
			changePassword($_POST['username'], $password);
			// Filling in for an email with the temporary password
			echo "Your temporary password is " .$password;
		}
	}
	?>
	</div>
  </form>

</body>
</html>
