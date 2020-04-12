<?php
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
  
  if ($user) { // if user exists
    if (usernameExists($username)) {
      array_push($errors, "Username already exists");
    }

    if (emailExists($email)) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	addUser($username, $password_1, $role, $email);
  	$_SESSION['username'] = $username;
	$_SESSION['userId'] = getUserInfo($username)[0];
  	$_SESSION['success'] = "You are now logged in";
	if ($role == "Researcher") {
		header('location: work.php');
	}
	elseif ($role == "Reviewer") {
  		header('location: main.php');
	}
	elseif ($role == "Editor") {
  		header('location: main.php');
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
      		$_SESSION['success'] = "You are now logged in";
		$role = getUserInfo($username)[3];
		if ($role == "Researcher") {
			header('location: work.php');
		}
		elseif ($role == "Reviewer") {
  			header('location: main.php');
		}
		elseif ($role == "Editor") {
  			header('location: main.php');
		}
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>
