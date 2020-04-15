<!DOCTYPE html>
<html> 
      
<head> 
    <title> 
      Paper Submission System
    </title> 
	<link rel="stylesheet" type="text/css" href="style.css">
</head> 
  
<body style="text-align:center;"> 

<?php
	session_start();
	include('database.php');
	if(array_key_exists('assignButton', $_POST)) {
		assignButton();
	}
	$submissions = getAllSubmissions();
	$reviewers = getReviewers();
	for($i = 0;$i < count($submissions);$i++) {
		?>
		<div class="header">
		<p>Submission Id: <?php echo $submissions[$i][0] ?>	Status: <?php echo $submissions[$i][2]?></p>
		</div>
		<?php
		$nominations = getSubmissionNominations($submissions[$i][0]);
		$requests = getSubmissionRequests($submissions[$i][0]);
		?>
		<div class="content">
		<h4>Nominated Reviewers:</h4>
		<?php
		for($j = 0;$j < count($nominations);$j++) {
			?>
			<p><?php echo getUserIdInfo($nominations[$j][1])[1]?></p>
		<?php
		}
		?>
		<h4>Requested Reviewers:</h4>
		<?php
		for($j = 0;$j < count($requests);$j++) {
			?>
			<p><?php echo getUserIdInfo($requests[$j][1])[1]?></p>
		<?php
		}
		
		 ?>
		<form method="post"> <?php
		for($j = 0;$j < count($reviewers);$j++) {
		?>
		
                     <input type="checkbox" name="assigned[]" value="<?php echo $reviewers[$j][0] ?>" /> <?php echo $reviewers[$j][1]?>
                     
                     <?php
                    }
                    ?>
                        
                        <input type="submit" name="assignButton"
                               class="button" value="Assign" /> 
			<input type="hidden" name="subId" value="<?php echo $submissions[$i][0] ?>" />
                        </form>
			</div>
		<?php
		
	}
	function assignButton() {
		if(!empty($_POST['assigned'])) {
			foreach($_POST['assigned'] as $data) {
				addReview($_POST['subId'], $data);
			}
		}
	}

?>
<p> <a href="editor.php" style="color: blue;">Home</a> </p>
</body>

</html>
