
<form method="POST" enctype="multipart/form-data" action="upload.php">
	<input type="file" name="file">
	<input type="submit" value="Upload">
</form>


<?php
session_start();

include('database.php');

// creating file to upload
//displaying all uploaded files

$submissions = getUserSubmissions($_SESSION['userId']);
//print_r($files);
for($a = 0; $a < count($submissions); $a++)
	{
		//displaying links to download
		//making it downloadable
		?>
		<p>
		<a download="<?php echo $submissions[$a][1] ?>" href="uploads/<?php echo $submissions[$a][1] ?>"><?php echo $submissions[$a][1] ?></a>
		<div><?php echo $submissions[$a][2]?></div>
		</p>
		<?php
	}

	//if you want the file to not be downloaded, but just opened in the web browser, then remove the donload part (until href) in line 26.
