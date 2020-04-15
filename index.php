
<?php 
// This is the skeleton of our website.

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  session_start(); 
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>	
																		<!-- Start describing the layout of the website using HTML -->
<head>
	<title>Home</title>														<!-- Title of the page -->
	<link rel="stylesheet" type="text/css" href="style.css">				<!-- Link to the external css file for styling the site -->
</head>
<body>

<div class="header">														<!-- Head of the page(at the top to describe the current page) -->
	<h2>Home Page</h2>
</div>

<div class="content">
  	<!-- Show a notification message. -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- The logged in user information -->
    <?php  if (isset($_SESSION['username'])) {
			// REDIRECT BASED ON USER ROLE!
	if($_SESSION['role'] == "Researcher") {
		header("location: researcher.php");								// If user registered as a researcher.
	}
	elseif($_SESSION['role'] == "Reviewer") {
		header("location: reviewer.php");								// If user registered as a reviewer.
	}
	elseif($_SESSION['role'] == "Editor") {
		header("location: editor.php");									// If user registered as a editor.
	}
	?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>	<!--Welcome message to the logged in user -->
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>	<!-- Logout button and link at the end. -->
    <?php } ?>
</div>
		
</body>
</html>
