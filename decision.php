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

		if(array_key_exists('button1', $_POST)) {
        	    button1($_POST["subId"]);
        	}
        	else if(array_key_exists('button2', $_POST)) {
        	    	button2($_POST["subId"]);
        	}
		else if(array_key_exists('button3', $_POST)) {
        	    button3($_POST["subId"]);
        	}
        	else if(array_key_exists('button4', $_POST)) {
        	    	button4($_POST["subId"]);
        	}
		$submissions = getAllSubmissions();

                for($a = 0; $a < count($submissions); $a++)
                    {
			
                        //displaying links to download
                        //making it downloadable
                        ?>
                        <p>
			<div class="header">
                        <a download="<?php echo $submissions[$a][1] ?>" href="uploads/<?php echo $submissions[$a][1] ?>"><?php echo $submissions[$a][1] ?></a>
			    <div><?php echo $submissions[$a][2]?></div>
			</div>
			<div class="content">
			<div>Recommendations:</div>
			<?php
				$reviews = getSubmissionReviews($submissions[$a][0]);
				for($j = 0;$j < count($reviews);$j++) {
					?>
						<div><?php echo getUserIdInfo($reviews[$j][2])[1] ?></div>
					<?php	if($reviews[$j][4] == "none") {
							?>
							<div>Submission has not been viewed</div>
							<?php
						}
						else {
					
					?>
						<div><?php echo $reviews[$j][3] ?></div>
						<div>Comments:</div>
						<div><?php echo $reviews[$j][5]?></div>
					<?php	}
				}
			?>
                                <form method="post"> 
				<p>Please enter deadline for revisions</p>
				<input type="date" name="deadline" value="yyyy-mm-dd" />
				<input type="submit" name="button1" 
                                       class="button" value= "Minor Revision Needed"/>
				<input type="submit" name="button2" 
                                       class="button" value= "Major Revision Needed"/>
                                <input type="submit" name="button3" 
                                       class="button" value= "Accept"/>
                                <input type="submit" name="button4" 
                                       class="button" value= "Reject"/>
				<input type="hidden" name="subId" value="<?php echo $submissions[$a][0] ?>">
                                </form> 
				</div>
                        </p>
                        <?php
                    } 
		function button1($subId){
			if(isset($_POST['deadline'])) {
	    			updateSubmissionStatus($subId, "Minor Revision Needed");
				updateSubmissionDeadline($subId, date("Y-n-j",strtotime($_POST['deadline'])));

				$email = "The status of your submission " .getSubmission($subId)[1] ." has been changed to Minor Revision Needed.";
	    			// Send email to getUserIdInfo(getSubmission($subId)[3])[4] here

				header('location: decision.php');
			}
        	}
        	function button2($subId){
			if(isset($_POST['deadline'])) {
	    			updateSubmissionStatus($subId, "Major Revision Needed");
				updateSubmissionDeadline($subId, date("Y-n-j",strtotime($_POST['deadline'])));

				$email = "The status of your submission " .getSubmission($subId)[1] ." has been changed to Major Revision Needed.";
				// Send email to getUserIdInfo(getSubmission($subId)[3])[4] here

				header('location: decision.php');
			}
        	}
		function button3($subId){
	    		updateSubmissionStatus($subId, "Accepted");

			$email = "The status of your submission " .getSubmission($subId)[1] ." has been changed to Accepted.";
			// Send email to getUserIdInfo(getSubmission($subId)[3])[4] here
	    
            		echo '<span style="color:#12EB2B;text-align:center;">You have accepted the submission!</span>';
			header('location: decision.php');
        	}
        	function button4($subId){
	    		updateSubmissionStatus($subId, "Rejected");

			$email = "The status of your submission " .getSubmission($subId)[1] ." has been changed to Rejected.";
			// Send email to getUserIdInfo(getSubmission($subId)[3])[4] here

            		echo '<span style="color:#F10719;text-align:center;">You have rejected the submission.</span>';
			header('location: decision.php');
        	}
?>
<p> <a href="editor.php" style="color: blue;">Home</a> </p>
</body>

</html>
