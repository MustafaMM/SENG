<!-- This file implements the database functionality for the paper submission system.
Last Modified: April 13 2020

Database Tables:
users (usrId INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT, password TEXT, role TEXT, email TEXT)
submissions (subId INTEGER PRIMARY KEY AUTOINCREMENT, file TEXT, status TEXT, resUsrId INTEGER, subTerm TEXT, subDeadline TEXT, subDate TEXT)
nominated (subId INTEGER, revUsrId INTEGER)
requested (subId INTEGER, revUsrId INTEGER)
reviews (reviewId INTEGER PRIMARY KEY AUTOINCREMENT, subId INTEGER, revUsrId INTEGER, status TEXT, viewDate TEXT, feedback TEXT)
-->

<?php
/** 
 * Checks for a user with the given username
 * @return true if the username exists and false if not
 */
function usernameExists($username) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM users WHERE username=?");
	$q->bindValue(1, $username);
	$result = $q->execute();
	$row = $result->fetchArray();
	$db->close();
	if(! $row) {
		return false;
	}
	else {
		return true;
	}
}

/** 
 * Checks for a user with the given email
 * @return true if the email exists and false if not
 */
function emailExists($email) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM users WHERE email=?");
	$q->bindValue(1, $email);
	$result = $q->execute();
	$row = $result->fetchArray();
	$db->close();
	if(!$row) {
		return false;
	}
	else {
		return true;
	}
}

/**
 * Add a new user
 *
 * @param username The username to add
 * @param password The user's password
 * @param role The user's role (Reviewer, Researcher, or Editor)
 * @param email The user's email
 *
 * @return true if the username does not exist and the user was successfully added, false otherwise
 */
function addUser($username, $password, $role, $email) {
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	if(! usernameExists($username)) {
		$db = new SQLite3("submission_system.db");
		$q = $db->prepare("INSERT INTO users (username, password, role, email) VALUES(?,?,?,?)");
		$q->bindValue(1, $username);
		$q->bindValue(2, $hashed_password);
		$q->bindValue(3, $role);
		$q->bindValue(4, $email);
		$q->execute();
		$db->close();
		return true;
	}
	else {
		return false;
	}
}

/**
 * Checks if a username and password exist
 *
 * @param username The username to check
 * @param password The password to check
 *
 * @return true if the given username and password are correct, and false otherwise
 */
function verifyLogin($username, $password) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM users WHERE username=?");
	$q->bindValue(1, $username);
	$result = $q->execute();
	$row = $result->fetchArray();
	$db->close();
	if(count($row) > 0 && password_verify($password, $row[2])) {
		return true;
	}
	else {
		return false;
	}
}

/**
 * Checks if an email address and password exist
 *
 * @param email The email address to check
 * @param password The password to check
 *
 * @return true if the given email address and password are correct, and false otherwise
 */
function verifyEmailLogin($email, $password) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM users WHERE email=?");
	$q->bindValue(1, $email);
	$result = $q->execute();
	$row = $result->fetchArray();
	$db->close();
	if(count($row) > 0 && password_verify($password, $row[2])) {
		return true;
	}
	else {
		return false;
	}
}

/**
 * Changes the given user's password
 *
 * @param username The username to change the password for
 *
 * @param password The new password
 */
function changePassword($username, $password) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("UPDATE users SET password=? WHERE username=?");
	$q->bindValue(1, password_hash($password, PASSWORD_DEFAULT));
	$q->bindValue(2, $username);
	$q->execute();
	$db->close();
}

/**
 * Returns the info for a given user
 *
 * @param username The username to retrieve
 *
 * @return An array of the form [usrId, username, password, role, email]
 */
function getUserInfo($username) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM users WHERE username=?");
	$q->bindValue(1, $username);
	$result = $q->execute();
	$row = $result->fetchArray();
	$db->close();
	return $row;
}

/**
 * Returns the info for a given user
 *
 * @param usrId The usrId to retrieve
 *
 * @return An array of the form [usrId, username, password, role, email]
 */
function getUserIdInfo($usrId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM users WHERE usrId=?");
	$q->bindValue(1, $usrId);
	$result = $q->execute();
	$row = $result->fetchArray();
	$db->close();
	return $row;
}

/**
 * Returns the info for a given user
 *
 * @param email The email address to retrieve
 *
 * @return An array of the form [usrId, username, password, role, email]
 */
function getEmailInfo($email) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM users WHERE email=?");
	$q->bindValue(1, $email);
	$result = $q->execute();
	$row = $result->fetchArray();
	$db->close();
	return $row;
}

/**
 * Returns the info for all reviewers in the system
 *
 * @return A 2D array where each row is of the form [usrId, username, password, role, email]
 */
function getReviewers() {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM users WHERE role='Reviewer';");
	$result = $q->execute();
	$rows = [];
	$row = $result->fetchArray();
	while($row) {
		$rows[count($rows)] = $row;
		$row = $result->fetchArray();
	}
	$db->close();
	return $rows;
}

/**
 * Adds a new submission
 *
 * @param filename The filepath of the file
 * @param resUsrId The user id number of the submitting researcher
 */
function newSubmission($filename, $resUsrId) {
	$subDate = date("Y-n-j");
	$month = (int)date("n");
	if($month % 3 == 1) {
		$month = $month + 2;
	}
	else if($month % 3 == 2) {
		$month = $month + 1;
	}
	$day = 30;
	if($month == 3 || $month == 12) {
		$day = 31;
	}
	$deadline = date("Y-") .strval($month) ."-" .strval($day);
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("INSERT INTO submissions (file, status, resUsrId, subTerm, subDeadline, subDate) VALUES(?, 'Not yet reviewed', ?, ?, ?, ?)");
	$q->bindValue(1, $filename, SQLITE3_TEXT);
	$q->bindValue(2, $resUsrId, SQLITE3_INTEGER);
	$q->bindValue(3, $deadline, SQLITE3_TEXT);
	$q->bindValue(4, $deadline, SQLITE3_TEXT);
	$q->bindValue(5, $subDate, SQLITE3_TEXT);
	$q->execute();
	$db->close();
}

/**
 * Returns the submissions of a given researcher
 *
 * @param resUsrId The user id number of the researcher
 *
 * @return A 2D array, where each row is of the form [subId, file, status, resUsrId, subTerm, subDeadline, subDate]
 */
function getUserSubmissions($resUsrId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM submissions WHERE resUsrId=?");
	$q->bindValue(1, $resUsrId);
	$result = $q->execute();
	$rows = [];
	$row = $result->fetchArray();
	while($row) {
		$rows[count($rows)] = $row;
		$row = $result->fetchArray();
	}
	$db->close();
	return $rows;
}

/**
 * Returns the information for a given submission
 *
 * @param subId The id number of the submission
 *
 * @return An array of the form [subId, file, status, resUsrId, subTerm, subDeadline, subDate]
 */
function getSubmission($subId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM submissions WHERE subId=?");
	$q->bindValue(1, $subId);
	$result = $q->execute();
	$row = $result->fetchArray();
	$db->close();
	return $row;
}

/**
 * Returns the information for all submissions
 *
 * @return A 2D array where each row is of the form of the form [subId, file, status, resUsrId, subTerm, subDeadline, subDate]
 */
function getAllSubmissions() {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM submissions");
	$result = $q->execute();
	$rows = [];
	$row = $result->fetchArray();
	while($row) {
		$rows[count($rows)] = $row;
		$row = $result->fetchArray();
	}
	$db->close();
	return $rows;
}

/**
 * Changes the file associated with a submission
 *
 * @param subId The id number of the submissions
 * @param filename The filepath of the new file
 *
 * @return true if the current date is before the set deadline and the file is changed, and false otherwise
 */
function updateSubmissionFile($subId, $filename) {
	
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM submissions WHERE subId=?");
	$q->bindValue(1, $subId);
	$result = $q->execute();
	$row = $result->fetchArray();
	
	$deadline = strtotime($row[5]);
	$currentDate = strtotime(date("Y-n-j"));
	if($currentDate <= $deadline) {
		$q = $db->prepare("UPDATE submissions SET file=?, status='Resubmission not yet reviewed', subDate=? WHERE subId=?");
		$q->bindValue(1, $filename);
		$q->bindValue(2, date("Y-n-j"));
		$q->bindValue(3, $subId);
		$q->execute();
		$db->close();
		resetSubmissionReviews($subId);
		return true;
	}
	else {
		$db->close();
		return false;
	}
}

/**
 * Changes the status associated with a submission
 *
 * @param subId The id number of the submissions
 * @param status The updated status of the submission
 */
function updateSubmissionStatus($subId, $status) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("UPDATE submissions SET status=? WHERE subId=?");
	$q->bindValue(1, $status);
	$q->bindValue(2, $subId);
	$q->execute();
	$db->close();
}

/**
 * Changes the dealine associated with a submission
 *
 * @param subId The id number of the submissions
 * @param deadline The updated deadline for the submission
 */
function updateSubmissionDeadline($subId, $deadline) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("UPDATE submissions SET subDeadline=? WHERE subId=?");
	$q->bindValue(1, $deadline);
	$q->bindValue(2, $subId);
	$q->execute();
	$db->close();
}

/**
 * Adds a nomination for a reviewer for a submission
 *
 * @param subId The id number of the submission
 * @param revUsrId The user id number of the reviewer
 */
function addNomination($subId, $revUsrId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("INSERT INTO nominated (subId, revUsrId) VALUES(?, ?)");
	$q->bindValue(1, $subId);
	$q->bindValue(2, $revUsrId);
	$q->execute();
	$db->close();
}

/**
 * Returns the nominated reviewer for a submission
 *
 * @param subId The id number of the submission
 *
 * @return A 2D array where each row is of the form [subId, revUsrId]
 */
function getSubmissionNominations($subId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM nominated WHERE subId=?");
	$q->bindValue(1, $subId);
	$result = $q->execute();
	$rows = [];
	$row = $result->fetchArray();
	while($row) {
		$rows[count($rows)] = $row;
		$row = $result->fetchArray();
	}
	$db->close();
	return $rows;
}

/**
 * Returns the submissions a reviewer has been nominated for
 *
 * @param revUsrId The user id number of the reviewer
 *
 * @return A 2D array where each row is of the form [subId, revUsrId]
 */
function getReviewerNominations($revUsrId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM nominated WHERE revUsrId=?");
	$q->bindValue(1, $revUsrId);
	$result = $q->execute();
	$rows = [];
	$row = $result->fetchArray();
	while($row) {
		$rows[count($rows)] = $row;
		$row = $result->fetchArray();
	}
	$db->close();
	return $rows;
}

/**
 * Adds a request to review a submission
 *
 * @param subId The id number of the submission
 * @param revUsrId The user id number of the reviewer
 */
function addRequest($subId, $revUsrId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("INSERT INTO requested (subId, revUsrId) VALUES(?, ?)");
	$q->bindValue(1, $subId);
	$q->bindValue(2, $revUsrId);
	$q->execute();
	$db->close();
}

/**
 * Returns the reviewers who have requested to review a submission
 *
 * @param subId The id number of the submission
 *
 * @return A 2D array where each row is of the form [subId, revUsrId]
 */
function getSubmissionRequests($subId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM requested WHERE subId=?");
	$q->bindValue(1, $subId);
	$result = $q->execute();
	$rows = [];
	$row = $result->fetchArray();
	while($row) {
		$rows[count($rows)] = $row;
		$row = $result->fetchArray();
	}
	$db->close();
	return $rows;
}

/**
 * Returns the submissions a reviewer has requested to review
 *
 * @param revUsrId The user id number of the reviewer
 *
 * @return A 2D array where each row is of the form [subId, revUsrId]
 */
function getReviewerRequests($revUsrId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM requested WHERE revUsrId=?");
	$q->bindValue(1, $revUsrId);
	$result = $q->execute();
	$$rows = [];
	$row = $result->fetchArray();
	while($row) {
		$rows[count($rows)] = $row;
		$row = $result->fetchArray();
	}
	$db->close();
	return $rows;
}

/**
 * Assigns a reviewer to review a submission
 *
 * @param subId The id number of the submission
 * @param revUsrId The id number of the reviwer
 */
function addReview($subId, $revUsrId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("INSERT INTO reviews (subId, revUsrId, status, viewDate, feedback) VALUES(?, ?, 'Not yet reviewed', 'none', '')");
	$q->bindValue(1, $subId);
	$q->bindValue(2, $revUsrId);
	$q->execute();
	$db->close();
}

/**
 * Updates the status of a review
 *
 * @param reviewId The id numbe rof the review
 * @param status The status of the review
 * @param feedback Additional comments given by the reviewer
 */
function updateReviewStatus($reviewId, $status, $feedback) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("UPDATE reviews SET status=?, feedback=? WHERE reviewId=?");
	$q->bindValue(1, $status);
	$q->bindValue(2, $feedback);
	$q->bindValue(3, $reviewId);
	$q->execute();
	$db->close();
}

/**
 * Marks that the reviewer viewed a submission on the current date
 *
 * @param reviewId The id number of the review 
 */
function markAsViewed($reviewId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("UPDATE reviews SET viewDate=? WHERE reviewId=?");
	$q->bindValue(1, date("Y-n-j"));
	$q->bindValue(2, $reviewId);
	$q->execute();
	$db->close();
}

/**
 * Resets the reviews for a submission after a resubmission
 *
 * @param subId The id number of the submission
 */
function resetSubmissionReviews($subId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("UPDATE reviews SET status='Resubmission not yet reviewed', viewDate='none', feedback='' WHERE subId=?");
	$q->bindValue(1, $subId);
	$q->execute();
	$db->close();
}

/**
 * Returns the assigned reviewers and review details for a given submission
 *
 * @param subId The id number of the submission
 *
 * @return A 2D array where each row is of the form [reviewId, subId, revUsrId, status, viewDate, feedback]
 */
function getSubmissionReviews($subId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM reviews WHERE subId=?");
	$q->bindValue(1, $subId);
	$result = $q->execute();
	$rows = [];
	$row = $result->fetchArray();
	while($row) {
		$rows[count($rows)] = $row;
		$row = $result->fetchArray();
	}
	$db->close();
	return $rows;
}

/**
 * Returns the submissions assigned to a given reviewer and the review details
 *
 * @param revUsrId The user id number of the reviewer
 *
 * @return A 2D array where each row is of the form [reviewId, subId, revUsrId, status, viewDate, feedback]
 */
function getReviewerReviews($revUsrId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM reviews WHERE revUsrId=?");
	$q->bindValue(1, $revUsrId);
	$result = $q->execute();
	$rows = [];
	$row = $result->fetchArray();
	while($row) {
		$rows[count($rows)] = $row;
		$row = $result->fetchArray();
	}
	$db->close();
	return $rows;
}

/**
 * Returns the details of a review
 *
 * @param reviewId The id number of the review
 *
 * @return An array of the form [reviewId, subId, revUsrId, status, viewDate, feedback]
 */
function getReview($reviewId) {
	$db = new SQLite3("submission_system.db");
	$q = $db->prepare("SELECT * FROM reviews WHERE reviewId=?");
	$q->bindValue(1, $reviewId);
	$result = $q->execute();
	$row = $result->fetchArray();
	return $row;
}
