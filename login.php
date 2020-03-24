<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>
    Iteration 2 
</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h3>Hello there! Login below:</h3>
  </div>
	 
  <form method="post" action="login.php">

  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet in academia? <a href="register.php">Well then sign up!</a>
  	</p>
  </form>
</body>
</html>