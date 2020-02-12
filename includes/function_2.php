<?php

function protect($string) {
	$protection = htmlspecialchars(trim($string), ENT_QUOTES);
	return $protection;
}
function success($text) {
	return '<div class="alert alert-success"><i class="fa fa-check"></i> '.$text.'</div>';
}

function error($text) {
	return '<div class="alert alert-danger"><i class="fa fa-times"></i> '.$text.'</div>';
}

function info($text) {
	return '<div class="alert alert-info"><i class="fa fa-info-circle"></i> '.$text.'</div>';
}

function is_student_Loggedin(){
	//session_start();
	// Check, if email session is NOT set then this page will jump to login page
	if (isset($_SESSION['s_id'])) {
			return true;
		} else {
		return false;
		/*session_destroy();
		header('Location: signin.php');
		exit;*/
	}
}

function is_teacher_Loggedin(){
	//session_start();
	// Check, if username session is NOT set then this page will jump to login page
	if (isset($_SESSION['t_id'])) {
			return true;
	} else {
		return false;
		/*session_destroy();
		header('Location: teacher/signin.php');
		exit;*/
	}
}

function is_admin_Loggedin(){
	//session_start();
	// Check, if username session is NOT set then this page will jump to login page
	if (isset($_SESSION['admin_id']) and isset($_SESSION['admin_username'])) {
			return true;
	} else {
		return false;
		/*session_destroy();
		header('Location: admin/signin.php');
		exit;*/
	}
}

function randomHash($lenght = 7) {
	$random = substr(md5(rand()),0,$lenght);
	return $random;
}

function isValidURL($url) {
	return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

function isValidUsername($str) {
    return preg_match('/^[a-zA-Z0-9-_.]+$/',$str);
}

function isValidEmail($str) {
	return filter_var($str, FILTER_VALIDATE_EMAIL);
}

function student_info($s_id,$value) {
	global $db;
	$query = $db->query("SELECT * FROM student_profile WHERE s_id='$s_id'");
	$row = $query->fetch_assoc();
	return $row[$value];
}


function semester_info($query,$value) {
	global $db;
	$query = $db->query("SELECT * FROM semester WHERE id=($query)");
	$row = $query->fetch_assoc();
	return $row[$value];
}


function offer_semester_info($query,$value) {
	global $db;
	$query = $db->query("SELECT * FROM course_offer WHERE semester=($query)");
	$row = $query->fetch_assoc();
	return $row[$value];
}

function teacher_info($t_id,$value) {
	global $db;
	$query = $db->query("SELECT * FROM teacher_profile WHERE id='$t_id'");
	$row = $query->fetch_assoc();
	return $row[$value];
}

function get_info($form,$id,$value) {
	global $db;
	$query = $db->query("SELECT * FROM $form WHERE id='$id'");
	$row = $query->fetch_assoc();
	return $row[$value];
}


function day_name($name) {
	switch ($name) {
		case 'sat':
			$day = "Sat";
			break;
		case 'sun':
			$day = "Sun";
			break;
		case 'mon':
			$day = "Mon";
			break;
		case 'tue':
			$day = "Tue";
			break;
		case 'wed':
			$day = "Wed";
			break;
		case 'thu':
			$day = "Thu";
			break;
		default:
			$day = "Something Wrong!";
			break;
	}
	return $day;
}

function gpa($marks,$type="grade"){
	if($marks >= 80 and $marks <= 100) { $gpa = 4.00; $letter = "A+"; }
	else if($marks >= 75 and $marks <= 79) { $gpa = 3.75; $letter = "A"; }
	else if($marks >= 70 and $marks <= 74) { $gpa = 3.50; $letter = "A-"; }
	else if($marks >= 65 and $marks <= 69) { $gpa = 3.25; $letter = "B"; }
	else if($marks >= 60 and $marks <= 64) { $gpa = 3.00; $letter = "C"; }
	else if($marks >= 55 and $marks <= 59) { $gpa = 2.75; $letter = "D"; }
	else if($marks >= 50 and $marks <= 54) { $gpa = 2.50; $letter = "F"; }
	else { $gpa = "Something Wrong!"; $letter = "Something Wrong!"; }

	if($type == "letter") return $letter;
	else if($type == "grade") return $gpa;
}


function get_semester(){
	$month = date('M');
	if($month <= 4 and $month >= 0) return "spring";
	else if ($month <= 8 and $month >= 3) return "summer";
	else if ($month <= 12 and $month >= 7) return "fall";
}





function alert_div_message($message,$class='info'){
print '<div class="alert alert-'.$class.'" role="alert">'.$message.'</div>';

}
?>