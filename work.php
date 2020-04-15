<html>
<head>
<title>Paper Submission System</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style="text-align:center;">
<div class="content" style="width: 70%">

<h3>
	Add a File
</h3>
<form method="POST" enctype="multipart/form-data" action="upload.php">
	<input type="file" name="file">
	<input type="submit" value="Upload">
	<input type="hidden" name="subId" value="<?php echo $_POST['subId'] ?>">
</form>


<?php
session_start();

include('database.php');

// creating file to upload
//displaying all uploaded files

if(array_key_exists('nominateButton', $_POST)) {
	nominateButton();
}

$submission = getSubmission($_POST['subId']);
	//displaying links to download
	//making it downloadable
	if($submission) {
	?>
	<h3>
	Submission Details
	</h3>
	<p>
	<div>
	File:
	<a download="<?php echo $submission[1] ?>" href="uploads/<?php echo $submission[1] ?>"><?php echo $submission[1] ?></a>
	</div>
	<div>
	Status:
	<?php echo $submission[2]?>
	</div>
	</p>
	<div>
	Feedback:
	<?php
		$reviews = getSubmissionReviews($_POST['subId']);
		$viewed = false;
		for($i = 0;$i < count($reviews);$i++) {
			if($reviews[$i][4] != "none") {
				$viewed = true;
			}
			if($reviews[$i][5] != "") {
				?>
				<div><?php echo $reviews[$i][5];?></div>
				<?php
			}
		}
		if(!$viewed) {
			?>
			<div>This submission has not yet been viewed</div>
			<?php
		}
	?>
	</div>
	<h3>
	Nominate Reviewers:
	</h3>
	<?php 
	$reviewers = getReviewers();
	for($i = 0;$i < count($reviewers);$i++) {
	?>
		<form method="post">
                     <input type="checkbox" name="nominations[]" value="<?php echo $reviewers[$i][0] ?>" /> <?php echo $reviewers[$i][1]?>
                     
                     <?php
                    }
                    ?>
                        
                        <input type="submit" name="nominateButton"
                               class="button" value="Nominate" /> 
			<input type="hidden" name="subId" value="<?php echo $submission[0] ?>" />
                        </form>
			</div>
	
<?php	}
function nominateButton() {
	if(!empty($_POST['nominations'])) {
		foreach($_POST['nominations'] as $data) {
			addNomination($_POST['subId'], $data);
		}
		?>
		<p>Reviewers have been nominated</p>
		<?php
	}
}
?>
<p> <a href="researcher.php" style="color: blue;">Home</a> </p>
</body>

</html>
