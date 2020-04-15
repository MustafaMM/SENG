<html> 
      
<head> 
    <title> 
      Paper Submission System
    </title> 
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style="text-align:center;">
	<h1 style="color:green;"> 
	       Paper Submission System
    	</h1>

	<h3 class="header">
		Your submissions
	</h3> 

	<?php
	session_start();

	include('database.php');

	//displaying all uploaded files

	$submissions = getUserSubmissions($_SESSION['userId']);
	for($a = 0; $a < count($submissions); $a++)
	{
		//displaying links to download
		//making it downloadable
		?>
		<div class="content">
		<p>
		<div>Id: <?php echo $submissions[$a][0]?></div>
		<div>Status: <?php echo $submissions[$a][2]?></div>
		<form method="post" action="work.php">
			<input type="submit" name="view" 
                                       class="button" value="Edit Submission"/>
			<input type="hidden" name="subId" value="<?php echo $submissions[$a][0] ?>">
		</form>
		</p>
		</div>
		<?php
	}
	$submissions = getAllSubmissions();
?>	
	<form method="post" action="work.php">
		<input type="submit" name="view" 
                	class="button" value="New Submission"/>
		<input type="hidden" name="subId" value="<?php echo (count($submissions)+1) ?>">
	</form>
<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
<p> <a href="rankings.php" style="color: blue;">See Top Reviewers</a> </p>
<p> <a href="changepass.php" style="color: red;">Change Password</a> </p>
</body>

</html>
