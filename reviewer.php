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
		else if(array_key_exists('submitButton', $_POST)) {
            		submitButton();
        	}
		?>
		<h3 class="header">Your assigned topics</h3>
		<?php
		$submissions = getReviewerReviews($_SESSION['userId']);

                for($a = 0; $a < count($submissions); $a++)
                    {
			
                        //displaying links to download
                        //making it downloadable
                        ?>
			<div class="content">
                        <p>
                        <a download="<?php echo getSubmission($submissions[$a][1])[1] ?>" href="uploads/<?php echo getSubmission($submissions[$a][1])[1]?>"><?php echo getSubmission($submissions[$a][1])[1] ?></a>
			    <div><?php echo $submissions[$a][3]?></div>
                                <form method="post" action="review.php" style="width: 85%"> 
                                <input type="submit" name="review" 
                                       class="button" value= "Review"/>
				<input type="hidden" name="reviewId" value="<?php echo $submissions[$a][0] ?>">
                                </form> 
                        </p>
			</div>
                        <?php
                    } 
		$submissions = getAllSubmissions();
                    
		?>
		<h3 class="header">Request Submissions to Review</h3>
		<?php
			//checkbox code
                    for($a = 0; $a < count($submissions); $a++)
                    {
                    ?>
		
                    <form method="post">
                     <input type="checkbox" name="data[]" value="<?php echo $submissions[$a][0] ?>" /> <a download="<?php echo $submissions[$a][1] ?>" href="uploads/<?php echo $submissions[$a][1]?>"><?php echo $submissions[$a][1] ?></a>
                     
                     <?php
                    }
                    ?>
                        
                        <input type="submit" name="submitButton"
                               class="button" value="Submit" /> 
                        </form> 
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
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
		function submitButton()
        	{
            		if(!empty($_POST["data"]))
            		{
                		echo '<h3>Your review requests have been saved</h3>';
                		foreach($_POST["data"] as $data)
                		{
                    			addRequest($data, $_SESSION['userId']);
                		}
            		}
            		else
            		{
                		echo 'please select at least one';
            		}
        }
	?>
<p> <a href="rankings.php" style="color: blue;">See Top Reviewers</a> </p>
<p> <a href="changepass.php" style="color: red;">Change Password</a> </p>
</body>

</html>
