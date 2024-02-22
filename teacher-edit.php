<?php
session_start();
if (isset($_SESSION['admin_id']) && 
	isset($_SESSION['role'])) {

	if ($_SESSION['role'] == 'Admin'){


if (isset($_POST['fname']) &&
	isset($_POST['lname']) &&
	isset($_POST['username']) &&
	isset($_POST['teacher_id']) &&
	isset($_POST['address']) &&
	isset($_POST['employee_number']) &&
	isset($_POST['date_of_birth']) &&
	isset($_POST['gender']) &&
	isset($_POST['phone_number']) &&
	isset($_POST['qualification']) &&
	isset($_POST['email_address']) &&
	isset($_POST['date_of_joined']) &&
	isset($_POST['section']) &&
	isset($_POST['subjects']) &&
	isset($_POST['grades'])) {

	include '../../DB_connection.php';
	include "../data/teacher.php";

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['username'];

	$teacher_id = $_POST['teacher_id'];
	$address = $_POST['address'];
	$employee_number = $_POST['employee_number'];
	$date_of_birth = $_POST['date_of_birth'];
	$gender = $_POST['gender'];
	$phone_number = $_POST['phone_number'];
	$qualification = $_POST['qualification'];
	$email_address = $_POST['email_address'];
	$date_of_joined = $_POST['date_of_joined'];
	$section = $_POST['section'];

	$subjects = "";
	foreach ($_POST['subjects'] as $subject) {
		$subjects .=$subject;
	}
	$grades = "";
	foreach ($_POST['grades'] as $grade) {
		$grades .=$grade;

	}	
	$data = 'teacher_id='.$teacher_id;

		if (empty($fname)) {
		$em = "First Name is required";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em = "Last Name is required";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em = "Username is required";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn, $teacher_id)) {
		$em = "Username is taken! try another";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($address)) {
		$em = "Address is required";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($employee_number)) {
		$em = "Employee Number is required";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($date_of_birth)) {
		$em = "Date of Birth is required";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($gender)) {
		$em = "Gender is required";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($phone_number)) {
		$em = "Phone Number is required";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($qualification)) {
		$em = "Qualification is required";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($email_address)) {
		$em = "Email Address is required";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($date_of_joined)) {
		$em = "Date of Joined is required";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else {
		$sql = "UPDATE teachers SET 
		username = ?, fname=?, lname=?, subjects=?, grades=?, address=?, employee_number=?, date_of_birth=?, gender=?, phone_number=?, qualification=?, email_address=?,   date_of_joined=?, section=?
		WHERE teacher_id=?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$uname, $fname, $lname, $subjects, $grades, $address, $employee_number, $date_of_birth, $gender, $phone_number, $qualification, $email_address, $date_of_joined,   $section, $teacher_id]);
		$sm = "Successfully Updated!";
		header("Location: ../teacher-edit.php?success=$sm&$data");
	}

	}else{
		$em = "An Error Occured";
	header("Location: ../teachers.php?error=$em");
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