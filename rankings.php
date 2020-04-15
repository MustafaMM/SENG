<!DOCTYPE html>
<html> 
      
<head> 
    <title> 
      Paper Submission System
    </title> 
	<link rel="stylesheet" type="text/css" href="style.css">
</head> 


<body style="text-align:center;">
<h3 class="header">Top Reviewers</h3> 
<div class="content">
<?php
	ini_set('display_errors', 1); 
	ini_set('display_startup_errors', 1); 
	error_reporting(E_ALL);
	session_start();
	function sortByTime($a, $b) {
    		return $a[0] - $b[0];
	}
	
	include('database.php');
	$reviewers = getReviewers();
	$reviewerRankings = array();
	for($i = 0;$i < count($reviewers);$i++) {
		$total = 0;
		$reviewed = 0;
		$reviews = getReviewerReviews($reviewers[$i][0]);
		for($j = 0;$j < count($reviews);$j++) {
			if($reviews[$j][4] != "none") {
				$total = $total + intval(date_diff(date_create($reviews[$j][4]), date_create(getSubmission($reviews[$j][1])[6]), TRUE)->format('d'));
				$reviewed++;
			}
		}
		if($reviewed > 0) {
			array_push($reviewerRankings, array($total / $reviewed, $reviewers[$i][1]));
		}
		else {
			array_push($reviewerRankings, array(2147483648, $reviewers[$i][1]));
		}
	}
	usort($reviewerRankings, 'sortByTime');
	for($i = 0;$i < count($reviewerRankings);$i++) {
		?> 
			<div><?php echo strval($i+1) .": " .$reviewerRankings[$i][1]; ?></div>
		<?php
	}
	

?>
</div>
<p> <a href="home.php" style="color: blue;">Home</a> </p>
</body>

</html>
