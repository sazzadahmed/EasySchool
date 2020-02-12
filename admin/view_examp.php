<?php 

ob_start();
session_start();
include('../includes/connect.php');


$cls = $_POST['cls'];
$course_code = $_POST['course_code'];
$program = $_POST['grp'];
$session = $_POST['session'];
$teacherId = $_SESSION['t_id'];
$typeOfExam = $_POST['typeOfExam'];


$teacherId = $_SESSION['t_id'];
$raw_query = "select * from exam where `type` = $typeOfExam and  `class` = '".$cls."' and `session` = '".$session."' and subject = '".$course_code."' and `major` = '".$program."'";

$query = $db->query($raw_query);
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        print_r($row);
    }
}


