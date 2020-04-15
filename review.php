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
		include("database.php");
		if(array_key_exists('button1', $_POST)) {
        	    button1($_POST["reviewId"], $_POST["feedback"]);
        	}
        	else if(array_key_exists('button2', $_POST)) {
        	    	button2($_POST["reviewId"], $_POST["feedback"]);
        	}
        	else if(array_key_exists('button3', $_POST)) {
        	    button3($_POST["reviewId"], $_POST["feedback"]);
        	}
        	else if(array_key_exists('button4', $_POST)) {
        	    	button4($_POST["reviewId"], $_POST["feedback"]);
        	}
		$submission = getReview($_POST['reviewId']);
		markAsViewed($_POST['reviewId']);
			
                        //displaying links to download
                        //making it downloadable
                        ?>
			<div class="content">
                        <p>
                        <a download="<?php echo getSubmission($submission[1])[1] ?>" href="uploads/<?php echo getSubmission($submission[1])[1]?>"><?php echo getSubmission($submission[1])[1] ?></a>
			    <div><?php echo getSubmission($submission[1])[2]?></div>
                                <form method="post" style="width: 85%" name="recommendation" id="recommendation"> 
				<textarea name="feedback" rows="5" cols="60" form="recommendation"></textarea>
                                <input type="submit" name="button1" 
                                       class="button" value= "Minor Revision Needed"/>
				<input type="submit" name="button2" 
                                       class="button" value= "Major Revision Needed"/>
				<input type="submit" name="button3" 
                                       class="button" value= "Accept"/>
                                <input type="submit" name="button4" 
                                       class="button" value= "Reject"/>
				<input type="hidden" name="reviewId" value="<?php echo $submission[0] ?>">
                                </form> 
                        </p>
			</div>
                        <?php



		function button1($reviewId, $feedback){
	    		updateReviewStatus($reviewId, "Minor Revision Needed", $feedback);
	    
			header('location: reviewer.php');
        	}
        	function button2($reviewId, $feedback){
	    		updateReviewStatus($reviewId, "Major Revision Needed", $feedback);

			header('location: reviewer.php');
        	}
		function button3($reviewId, $feedback){
	    		updateReviewStatus($reviewId, "Accepted", $feedback);
	    
            		echo '<span style="color:#12EB2B;text-align:center;">You have accepted the submission!</span>';
			header('location: reviewer.php');
        	}
        	function button4($reviewId, $feedback){
	    		updateReviewStatus($reviewId, "Rejected", $feedback);
            		echo '<span style="color:#F10719;text-align:center;">You have rejected the submission.</span>';
			header('location: reviewer.php');
        	}
?>
<p> <a href="reviewer.php" style="color: blue;">Home</a> </p>
</body>

</html>
