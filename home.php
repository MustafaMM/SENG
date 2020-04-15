<?php
// Redirect logged in user according to their registered user-role.

	session_start();
	if($_SESSION['role'] == "Researcher") {				// Used to match and check user role
		header('location: researcher.php');				// If the user registered as a 'researcher', redirect to researcher.php.
	}
	elseif($_SESSION['role'] == "Reviewer") {
		header('location: reviewer.php');				// If the user registered as a 'reviewer', redirect to reviewer.php.
	}
	elseif($_SESSION['role'] == "Editor") {
		header('location: editor.php');					// If the user registered as a 'editor', redirect to researcher.php.
	}
	else {
		header('location: index.php');					// else index(main page)
	}
?>
