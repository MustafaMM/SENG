<?php include('server.php'); 
// This file is for when the user wants to change their password. 
//The user will be asked for their username that they registered with and a reset link will be sent to the email associated with that account.
?>

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
  	<h3>Change your password</h3>
  </div>
	 
  <form method="post" action="login.php">

  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Current Password</label>
  		<input type="password" name="currentPassword" >
  	</div>
  	<div class="input-group">
  		<label>New Password</label>
  		<input type="password" name="password1">
  	</div>
	<div class="input-group">
  		<label>Confirm Password</label>
  		<input type="password" name="password2">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="changePassword">Change Password</button>
  	</div>
  	<p> <a href="home.php" style="color: blue;">Home</a> </p>
  </form>
</body>
</html>
