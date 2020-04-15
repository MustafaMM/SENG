<!DOCTYPE html>
<html>
<head>
  <title>
    Reset 
</title>
	<link rel="stylesheet" type="text/css" href="style.css">				<!-- link to css for style -->
	<script src="passw.js"></script>										<!-- link to javascript file -->
</head>
<body>

  <div class="header">
  </div>
	 
  <form method="post" action="resetpass.php">
	<!-- Define form for submitting -->

  	<div class="input-group">
  		<label>Existing username:</label>
  		<input type="test" name="username" placeholder="cmonBruh" 
		onfocus="this.placeholder = ''"
		onblur="this.placeholder = 'enter your text'" />
  	</div>
  	<div class="input-group">
	<!-- Submit button. -->
  		<button type="submit" class="btn" name="resetPassword">Reset password</button>
  	</div>
  	<a href="login.php">Sign in.</a>	<!-- Login redirect instead.-->
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
