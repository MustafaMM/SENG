<?php
session_start();

include('database.php');

//getting user upload file

$file = $_FILES["file"];

$subId = count(getAllSubmissions());

newSubmission(strval($subId) ."_" .$file["name"], $_SESSION['userId']);

//saving file in uploads folder

move_uploaded_file($file["tmp_name"], "uploads/" .$subId ."_" .$file["name"]);

//redirecting back to home

header("Location: work.php");
