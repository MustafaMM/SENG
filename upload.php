<?php
// For storing and managing the users submissions(uploads).
session_start();											// Start new or resume existing session.
	
include('database.php');

//getting user upload file

$file = $_FILES["file"];

if(!getSubmission($_POST['subId'])) {
	newSubmission(strval($_POST['subId']) ."_" .$file["name"], $_SESSION['userId']);
}
else {
	updateSubmissionFile($_POST['subId'], strval($_POST['subId']) ."_" .$file["name"]);
}
//Save the uploaded file in 'uploads' folder
move_uploaded_file($file["tmp_name"], "uploads/" .strval($_POST['subId']) ."_" .$file["name"]);

//Redirect back to 'home'
header("Location: researcher.php");


//References used: https://www.php.net/manual/en/function.session-start.php
//https://www.tutorialspoint.com/php/php_file_uploading.htm
//https://code.tutsplus.com/tutorials/how-to-upload-a-file-in-php-with-example--cms-31763
?>