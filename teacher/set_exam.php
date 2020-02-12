<?php 

ob_start();
session_start();
include('../includes/connect.php');
include('../includes/function.php');

$cls = $_POST['cls'];
$course_code = $_POST['course_code'];
$program = $_POST['grp'];
$session = $_POST['session'];
$teacherId = $_SESSION['t_id'];
$typeOfExam = $_POST['typeOfExam'];
$mark = empty($_POST['mark'])?0:$_POST['mark'];
$written_mark =  empty($_POST['written_mark'])?0:$_POST['written_mark'];
$mcq_mark =  empty($_POST['mcq_mark'])?0:$_POST['mcq_mark'];



$sql_query = "SELECT `active_semester` FROM `session` WHERE name = '".$session."'";

$query = $db->query($sql_query);
$activeSemester = -1;

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $activeSemester =  $row['active_semester'];
        break;
    }
}




$rawQuery = "INSERT INTO `exam`( `type`, `class`, `session`, `subject`, `major`, `t_id`, `mark`, `mcq`, `written`,`semester`) VALUES ($typeOfExam,'".$cls."','".$session."','".$course_code."',".$program.",'".$teacherId."',$mark,$mcq_mark,$written_mark,$activeSemester)";
$db->query($rawQuery);
echo 'success';

?>