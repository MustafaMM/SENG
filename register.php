<?php include('server.php') 
//include the server
?>
<!DOCTYPE html>
<!-- User registration page -->
<html>
<head>
  <title>Register now</title>
  <link rel="stylesheet" type="text/css" href="style.css">				<!-- link to css for styling the page -->
  <script src="passw.js"></script>										<!-- link to javascript file -->
</head>
<body>
  <div class="header">
  </div>
	
  <form method="post" action="register.php" id="registrationForm">
  	<?php include('errors.php'); ?>
  	<div class="input-group">											
  	  <label>Username</label>												<!-- Username -->
  	  <input type="text" name="username" value="<?php echo $username; ?>"
	  placeholder="michaelscott" 
		onfocus="this.placeholder = ''"
		onblur="this.placeholder = 'enter your text'" />
  	</div>
  	<div class="input-group">
  	  <label>Email</label>													<!-- Email -->
  	  <input type="email" name="email" value="<?php echo $email; ?>"
	  placeholder="michaelscott@dunder.mifflin" 
		onfocus="this.placeholder = ''"
		onblur="this.placeholder = 'enter your text'" 
	  />
  	</div>
    <div class="input-group">
      <label>User role</label>												<!-- Select user role -->
	<select name="role" form="registrationForm">	
	<!-- Allow user to choose their role -->
		<option value="Researcher">Researcher</option>
		<option value="Reviewer">Reviewer</option>
		<option value="Editor">Editor</option>
	</select>
    </div>
  	<div class="input-group">
  	  <label>Password</label>												<!-- Password -->
  	  <input type="password" name="password_1"
	  value="FakePSW" id="myInput">
		<!-- An element to toggle between password visibility(linked to external javascript file). -->
		<input type="checkbox" onclick="myFunction()">Show Password 
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>										<!-- Confirm password is same as above -->
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Sign up.
	  <!-- Finish setting up account. -->
	  </button>
  	</div>
  	<p>
  		<a href="login.php">Login
		<!-- If the user already has an account, redirect to the login page. -->
		</a>
  	</p>
  </form>
</body>
</html>
