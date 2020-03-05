<?php

//creating directory to store files
//designing user interface

?>

<form method="POST" enctype="multipart/form-data" action="upload.php">
	<input type="file" name="file">
	<input type="submit" value="Upload">
</form>

<?php

// creating file to upload
//displaying all uploaded files

$files = scandir("uploads"); 
//print_r($files);
for($a = 2; $a < count($files); $a++)
	{
		//displaying links to download
		//making it downloadable
		?>
		<p>
		<a download="<?php echo $files[$a] ?>" href="uploads/<?php echo $files[$a] ?>"><?php echo $files[$a] ?></a>
		</p>
		<?php
	}

	//if you want the file to not be downloaded, but just opened in the web browser, then remove the donload part (until href) in line 26.