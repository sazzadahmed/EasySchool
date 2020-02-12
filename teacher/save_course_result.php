<?php


ob_start();
session_start();
include('../includes/connect.php');

$teacherId = $_SESSION['t_id'];
$course = $_POST['course_id'];
$s_id = $_POST['s_id'];
$session = $_POST['session'];
$result = $_POST['data'];
$sql_query = "SELECT `active_semester` FROM `session` WHERE name = '".$session."'";
$query = $db->query($sql_query);
$activeSemester = -1;

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $activeSemester =  $row['active_semester'];
        break;
    }
}


$cnt = 0;

foreach($result as $data) {


    $rawquery = "SELECT `id` FROM `student_exam_result` WHERE `s_id` = '".$s_id[$cnt]."' and course  = '".$course."' and  session = '".$session."' and samester = $activeSemester";
    $query = $db->query($rawquery);
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $id =  $row['id'];        
        $rowQuery =  "UPDATE `student_exam_result` SET `id`= $id,`course`= '".$course."',`session`='".$session."',`teacher_id`= $teacherId,`result`='".$data."',`samester`=$activeSemester,`s_id`='".$s_id[$cnt]."' WHERE 1";
        $db->query($rowQuery);
    
    }
}
else
{
    $rowQuery =  "INSERT INTO `student_exam_result`( `course`, `session`, `teacher_id`, `result`, `samester`, `s_id`) VALUES ('".$course."','".$session."',$teacherId,'".$data."',$activeSemester,'".$s_id[$cnt]."')";
    $db->query($rowQuery);
}
$cnt = $cnt + 1;

}



