<?php
session_start();
if (isset($_SESSION['admin_id']) && 
	isset($_SESSION['role'])) {

	if ($_SESSION['role'] == 'Admin'){


if (isset($_POST['lrn']) &&
	isset($_POST['fname']) &&
	isset($_POST['lname']) &&
	isset($_POST['username']) &&
	isset($_POST['student_id']) &&
	isset($_POST['grades'])) {

	include "../../DB_connection.php";
	include "../data/teacher.php";
	include "../data/student.php";

	$lrn = $_POST['lrn'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['username'];

	$student_id = $_POST['student_id'];
	$grades = "";
	foreach ($_POST['grades'] as $grade) {
		$grades .=$grade;

	}

	$data = 'student_id='.$student_id;

	if (empty($lrn)) {
		$em = "LRN is required";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
	}else if (!lrnIsUnique($lrn, $conn, $student_id)) {
		$em = "LRN is taken! try another";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
	}else if (empty($fname)) {
		$em = "First Name is required";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em = "Last Name is required";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em = "Username is required";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn, $student_id)) {
		$em = "Username is taken! try another";
		header("Location: ../student-edit.php?error=$em&$data");
		exit;
	}else {
		$sql = "UPDATE students SET 
		username = ?, lrn = ?, fname=?, lname=?, grade=?
		WHERE student_id=?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$uname, $lrn, $fname, $lname, $grade, $student_id]);
		$sm = "Successfully Updated!";
		header("Location: ../student-edit.php?success=$sm&$data");
	}

	}else{
		$em = "An Error Occured";
	header("Location: ../student-edit.php?error=$em");
	exit;
}
	}else {
	header("Location: ../../logout.php");
	exit;
} 
	}else {
	header("Location: ../../logout.php");
	exit;
} 