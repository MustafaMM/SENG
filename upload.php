<?php

//getting user upload file

$file = $_FILES["file"];

$db = new SQLite3('submitted_works.db');
$q = $db->prepare("REPLACE INTO submissions (name, status) VALUES(?,'Not yet reviewed')");
$q->bindValue(1, $file["name"]);
$q->execute();
$db->close();

//saving file in uploads folder

move_uploaded_file($file["tmp_name"], "uploads/" .$file["name"]);

//redirecting back to home

header("Location: index.php");
