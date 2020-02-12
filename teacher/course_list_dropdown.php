<?php

  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');



$semester=$_POST['sem_id'];
//$year=explode("-",$str);

$query = $db->query("SELECT cl.id, cl.course_title FROM `course_offer` as co,`course_list` as cl where co.course_id=cl.id and co.teacher_id='".$_SESSION['t_id']."' and co.semester = '".$semester."' ");

$outputOwner= '<option value="">Select Course</option>';
foreach($query as $row){

    $outputOwner.= "<option value = '".$row['id']."'>".$row['course_title']."</option>";

    
}
echo $outputOwner;


 