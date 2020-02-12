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

function is_studown_Loggedin(){
	//session_start();
	// Check, if email session is NOT set then this page will jump to login page
	if (isset($_SESSION['s_id'])) {
			header('Location: download_amount.php');
		} else {
		//return false;
		//session_destroy();
		header('Location: signin.php');
		exit;
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

function student_registration_semester($value)
{

global $db;
	$query = $db->query("SELECT MAX(id),semester FROM course_offer");
	$row = $query->fetch_assoc();
	return $row[$value];

}


function semester_info($query,$value) {
	global $db;
	$query = $db->query("SELECT * FROM semester WHERE id=($query)");
	$row = $query->fetch_assoc();
	return $row[$value];
}


function teacher_info($t_id,$value) {
	global $db;
	$query = $db->query("SELECT * FROM teacher_profile WHERE id='$t_id'");
	$row = $query->fetch_assoc();
	return $row[$value];
}
function teacher_credit($t_id,$value) {
	global $db;
	$query = $db->query("SELECT course_offer.teacher_id ,course_offer.semester,SUM(course_list.credit) as credit FROM course_list inner join course_offer on course_list.id=course_offer.course_id where  course_offer.teacher_id='$t_id' group by course_offer.teacher_id");
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

function email_register($email,$password,$hash="null") {
	global $db, $settings;
	$eQuery = $db->query("SELECT * FROM student_profile WHERE s_email='$email'");
	if($eQuery->num_rows>0) {
		$e = $eQuery->fetch_assoc();
		$msubject = 'Signup | Verification';
		$mreceiver = $email;
		$message = 'Hello, '.$e["first_name"].' '.$e["last_name"].'
		Thanks for signing up!
		Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
		------------------------
		Username: '.$email.'
		Password: '.$password.'
		------------------------

		If you have any problems please feel free to contact with us on (mail)';
		$headers = 'From: <>' . "\r\n" .
		'Reply-To: '. "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		$mail = mail($mreceiver, $msubject, $message, $headers);
	}
}




function offer_semester_info($query,$value) {
	global $db;
	$query = $db->query("SELECT * FROM course_offer WHERE semester=($query)");
	$row = $query->fetch_assoc();
	return $row[$value];
}


function alert_div_message($message,$class='info'){
print '<div class="alert alert-'.$class.'" role="alert">'.$message.'</div>';

}



function save_pdf($inputname,$dir,$filename){
//for image upload

if ($_FILES[$inputname]["error"] > 0)
    {
    //echo "Return Code: " . $_FILES[$inputname]["error"] . "<br />";
	echo "Return Code: CV was not uploaded.try again. File size may be greater than 2 MB. Please upload less than 2MB<br />";
    }
  else
    {
	$msg = "ERROR: ";
$itemimageload="true";
	
    // echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    // echo "Type: " . $_FILES["file"]["type"] . "<br />";
    // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
	//if ($_FILES[$inputname]['size']>250000000){$msg=$msg."Your uploaded file size is more than 250KB so please reduce the file size and then upload.<BR>";
//$itemimageload="false";}


    if($itemimageload=="true")
{
	 
	 $newname = $dir . $filename .".pdf";
     if( move_uploaded_file($_FILES[$inputname]["tmp_name"],$newname)){
		 print_r($_FILES[$inputname]["tmp_name"]);
		//  print_r($newname);
     print '    <div class="alert alert-success">    Well done! You successfully uploaded File.    </div>'; 
     }else{
      print '    <div class="alert alert-error">    File cant be uploaded. Try again.   </div>'; 
     }
	  //move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
      // echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
 }
else
{
    echo $msg;
} 
 }   

//image closed
}




function image_upload(){
$target_dir = "../dashboard/image/";
$target_file = $target_dir . basename($_FILES["file1"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$rename = $target_dir. $_POST['s_id']. '.'.$imageFileType;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file1"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
//if (file_exists($target_file)) {
//if (file_exists($rename)) {
//    echo "Sorry, file already exists.";
 //   $uploadOk = 0;
//}

// Check file size
//2mb
if ($_FILES["file1"]["size"] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "JPEG"
&& $imageFileType != "gif" ) {
    echo "<div class='alert alert-error'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<div class='alert alert-error'>Sorry, your file was not uploaded.</div>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file1"]["tmp_name"], $rename)) {
        echo "<div class='alert alert-success'>The file ". basename( $_FILES["file1"]["name"]). " has been uploaded.</div>";
    } else {
        echo '<div class="alert alert-error">Sorry, there was an error uploading your file.</div>';
    }
}
}




function syllabus_info1($syllabus,$course_id,$pid,$value){

	global $db;
	$query = $db->query("SELECT * FROM $syllabus WHERE id='$pid'");
	$row = $query->fetch_assoc();
	$vals=explode(",",$row['core_id']);   
 

 //echo $course_id;
	//var_dump($vals);

	 $key= array_search($course_id, $vals); // $key = 2;

	  return $vals[$key];	

		



}



function syllabus_info2($syllabus,$course_id,$pid,$value){

	global $db;
	$query = $db->query("SELECT * FROM $syllabus WHERE id='$pid'");
	$row = $query->fetch_assoc();
	$vals=explode(",",$row['optional_id']);   
    $key= array_search($course_id, $vals); // $key = 2;

	  return $vals[$key];

}


function syllabus_info3($syllabus,$course_id,$pid,$value){

	global $db;
	$query = $db->query("SELECT * FROM $syllabus WHERE id='$pid'");
	$row = $query->fetch_assoc();
	$vals=$row['optional_id'];   
    //$key= array_search($course_id, $vals); // $key = 2;

	  return $vals;

}
function Display_day_name(){
	global $db;
	$query = $db->query("SELECT day_name FROM days ");
	return $query;
}
function get_time_slots($year,$day){
	global $db;
	$query = $db->query("SELECT DISTINCT time_slot,time_slot_end FROM course_offer where year='$year' and day='$day'");
	return $query;
}

function display_course_info_into_routine($year,$day,$course_assign_class,$store_time_slot){
	global $db;
       foreach ($store_time_slot as $time_slot_value) {
          $query2 = $db->query("SELECT * FROM course_offer where year='$year' and day='$day' and course_assign_class='$course_assign_class' and time_slot='$time_slot_value' ");
          echo "<td>";
          while ($row2=$query2->fetch_assoc()) {
          	 echo $row2['course_code'].'('.$row2['section'].')';
          	 echo "<br>";
          }
          echo "</td>";
       }

}




?>