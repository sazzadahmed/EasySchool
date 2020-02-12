

<?php

  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');


$teacherId = $_SESSION['t_id'];
$classId = $_POST['classId'];
$course = $_POST['course'];
 
if(is_null($course)){
 
}

if(empty($course))
{
  echo ($course = $_SESSION['course']);
  
}



echo("SELECT `section` FROM `course_offer` WHERE teacher_id = ".$teacherId." and course_assign_class = '".$classId."' and course_code = '".$course."'");

 $query = $db->query("SELECT `section` FROM `course_offer` WHERE teacher_id = ".$teacherId." and course_assign_class = '".$classId."' and course_code = '".$course."'");
 $outputOwner= '<option value="" disable>Select Section</option>';
 foreach($query as $row){

  if($_SESSION['section'] == $row['section'])
  {
    $outputOwner.= "<option value = '".$row['section']."' selected>".$row['section']."</option>";
  }
  else{
    $outputOwner.= "<option value = '".$row['section']."'>".$row['section']."</option>";
  }

  
    
 }
echo $outputOwner;