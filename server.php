<?php
//https://www.php.net/manual/en/features.commandline.webserver.php
include("database.php");
session_start();

// initializing variables
$username = "";
$email    = "";
$role     = "";
$errors = array();

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = $_POST['username'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($role)) { array_push($errors, "User role is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  
    if (usernameExists($username)) {
      array_push($errors, "Username already exists");
    }

    if (emailExists($email)) {
      array_push($errors, "email already exists");
    }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	addUser($username, $password_1, $role, $email);
  	$_SESSION['username'] = $username;
	$_SESSION['userId'] = getUserInfo($username)[0];
	$_SESSION['role'] = $role;
  	$_SESSION['success'] = "You are now logged in";
	if ($role == "Researcher") {
		header('location: researcher.php');
	}
	elseif ($role == "Reviewer") {
  		header('location: reviewer.php');
	}
	elseif ($role == "Editor") {
  		header('location: editor.php');
	}
  }
}
if (isset($_POST['login_user'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    	if (verifyLogin($username, $password)) {
    	  	$_SESSION['username'] = $username;
		$_SESSION['userId'] = getUserInfo($username)[0];
		$_SESSION['role'] = getUserInfo($username)[3];
      		$_SESSION['success'] = "You are now logged in";
		$role = getUserInfo($username)[3];
		if ($role == "Researcher") {
			header('location: researcher.php');
		}
		elseif ($role == "Reviewer") {
  			header('location: reviewer.php');
		}
		elseif ($role == "Editor") {
  			header('location: editor.php');
		}
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}
if (isset($_POST['changePassword'])) {
	$current = $_POST['currentPassword'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	if(empty($current) || empty($password1) || empty($password2)) {
		array_push($errors, "All fields are required");
	}
	if($password1 != $password2) {
		array_push($errors, "Passwords do not match");
	}
	if(!verifyLogin(getUserIdInfo($_SESSION['userId'])[1], $current)) {
		array_push($errors, "Invalid Password");
	}

	if(count($errors) == 0) {
		changePassword(getUserIdInfo($_SESSION['userId'])[1], $password1);
		header('location: home.php');
	}
}

?>
