<?php
session_start();
if (isset($_SESSION['admin_id']) && 
	isset($_SESSION['role'])) {

	if ($_SESSION['role'] == 'Admin'){


if (isset($_POST['lrn']) &&
	isset($_POST['fname']) &&
	isset($_POST['lname']) &&
	isset($_POST['mname']) &&
	isset($_POST['username']) &&
	isset($_POST['pass']) &&
	isset($_POST['address']) &&
	isset($_POST['gender']) &&
	isset($_POST['email_address']) &&
	isset($_POST['date_of_birth']) &&
	isset($_POST['parent_fname']) &&
	isset($_POST['parent_lname']) &&
	isset($_POST['parent_mname']) &&
	isset($_POST['parent_phone_number']) &&
	isset($_POST['section']) &&
	isset($_POST['grade'])) {


	include '../../DB_connection.php';
	include "../data/teacher.php";
	include "../data/student.php";

	$lrn = $_POST['lrn'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mname = $_POST['mname'];
	$uname = $_POST['username'];
	$pass = $_POST['pass'];
	$address = $_POST['address'];
	$gender = $_POST['gender'];
	$email_address = $_POST['email_address'];
	$date_of_birth = $_POST['date_of_birth'];
	$parent_fname = $_POST['parent_fname'];
	$parent_lname = $_POST['parent_lname'];
	$parent_mname = $_POST['parent_mname'];
	$parent_phone_number = $_POST['parent_phone_number'];

	$grade = $_POST['grade'];
	$section = $_POST['section'];


	
	$data = 'uname='.$uname.'&lrn='.$lrn.'&fname='.$fname.'&lname='.$lname.'&mname='.$mname.'&address='.$address.'&gender='.$gender.'&email_address='.$email_address.'&parent_fname='.$parent_fname.'&parent_lname='.$parent_lname.'&parent_mname='.$parent_mname.'&parent_phone_number='.$parent_phone_number.'&section='.$section;
	
	if (empty($lrn)) {
		$em = "LRN is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (!lrnIsUnique($lrn, $conn)) {
		$em = "LRN is taken! try another";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($fname)) {
		$em = "First Name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em = "Last Name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($mname)) {
		$em = "Middle Name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em = "Username is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn)) {
		$em = "Username is taken! try another";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($pass)) {
		$em = "Password is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($address)) {
		$em = "Address is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
		}else if (empty($gender)) {
		$em = "Gender is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
		}else if (empty($email_address)) {
		$em = "Email Address is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
		}else if (empty($parent_fname)) {
		$em = "Parent First Name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
		}else if (empty($parent_lname)) {
		$em = "Parent Last Name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
		}else if (empty($parent_mname)) {
		$em = "Parent Middle Name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
		}else if (empty($parent_phone_number)) {
		$em = "Parent Phone Number is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
		}else if (empty($section)) {
		$em = "Section is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
		}else if (empty($pass)) {
		$em = "Password is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else {
		// hashing the password
		$pass = password_hash($pass, PASSWORD_DEFAULT);

		$sql = "INSERT INTO
				students(username, lrn, password, fname, lname, mname, grade, section, address, gender, email_address, date_of_birth, parent_fname, parent_lname, parent_mname, parent_phone_number)
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$uname, $lrn, $pass, $fname, $lname, $mname, $grade, $section, $address, $gender, $email_address, $date_of_birth, $parent_fname, $parent_lname, $parent_mname, $parent_phone_number]);
		$sm = "New Student Registered Successfully";
		header("Location: ../student-add.php?success=$sm");
		exit;
	}

	}else{
		$em = "An Error Occured";
	header("Location: ../student-add.php?error=$em");
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