<?php include('server.php'); ?>
<!DOCTYPE html>
<!-- User login webpage -->
<html>
<head>
  <title>
    Paper Submission System
</title>
  <link rel="stylesheet" type="text/css" href="style.css">				<!-- link to css for style -->
  <script src="passw.js"></script>										<!-- link to javascript file -->
</head>
<body>
  <div class="header">
  	<h3>Hello. Login below:</h3>
  </div>
	 
  <form method="post" action="login.php">
<!-- Define the form for submitting input -->
  	<?php include('errors.php'); 
		// for any errors, show the error.
		?>
  	<div class="input-group">									<!-- Username, with placeholder -->
  		<label>Username</label>
  		<input type="text" name="username"placeholder="michaelscott" 
		onfocus="this.placeholder = ''"
		onblur="this.placeholder = 'enter your text'" />
  	</div>
  	<div class="input-group">									<!-- Password -->
  		<label>Password</label>
  		<input type="password" name="password" value="FakePSW" id="myInput">
		<!-- An element to toggle between password visibility(linked to external javascript file). -->
		<input type="checkbox" onclick="myFunction()">Show Password 
  	</div>
  	<div class="input-group">
		<!-- Submit button -->
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Don't have an account?<a href="register.php">Register now.</a>
  	</p>
	<p>
		<a href="resetpass.php">Forgot password?</a>	
	</p>
  </form>
</body>
<!-- https://stackoverflow.com/questions/9707021/how-do-i-auto-hide-placeholder-text-upon-focus-using-css-or-jquery
https://www.w3schools.com/howto/howto_js_toggle_password.asp
are the references used -->
</html>
