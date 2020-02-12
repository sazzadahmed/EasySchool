<?php 

ob_start();
session_start();
include('../includes/connect.php');
$exam_id = $_POST['examId'];
$s_id = $_POST['s_id'];
$typeOfExam = $_POST['typeOfExam'];
$mcq = $_POST['mcq'];
$written = $_POST['written'];
$mark = $_POST['mark'];
$totalMark = $mcq + $mark + $written;
$isabsent = 0;
$practical = $_POST['practical'];
if(isset($_POST['isabsent'])){
    $isabsent = $_POST['isabsent'];
    if($isabsent == "true") $isabsent = 1;
    else $isabsent = 0;
}


$queryS_IdUpdate = "select * from `exam_mark_entry` where `exam` = ".$exam_id." and `s_id` = ".$s_id;
$queryExistOrNot = $db->query($queryS_IdUpdate);

if ($queryExistOrNot->num_rows > 0) {


    $query = "UPDATE `exam_mark_entry` SET `exam` =".$exam_id.", `mark` =".$mark.", `written` =".$written.", `mcq` =".$mcq.", `total` =".$totalMark.", `s_id` ='".$s_id."',`isabsent` =".$isabsent.", `practical` =".$practical." where `s_id` = '".$s_id."' and `exam` = ".$exam_id;
    $db->query($query);
    echo 'successfully updated';

}

else {

    $query = "INSERT INTO `exam_mark_entry`( `exam`, `mark`, `written`, `mcq`, `total`, `s_id`,`isabsent`,`practical`) VALUES (".$exam_id.",".$mark.",".$written.",".$mcq.",".$totalMark.",'".$s_id."',".$isabsent.",".$practical.")";

    $db->query($query);
    
    echo 'successfully inserted';
}




