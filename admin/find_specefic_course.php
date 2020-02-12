<!-- sazzad code  -->

<?php

  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');


$classId = $_POST['classId'];
$group =  $_POST['group'];

$query = '';

if(empty($group)){
  $query = $db->query("SELECT `course_code`, `course_name` FROM `course_offer` WHERE  course_assign_class = '".$classId."'");
}
elseif(empty($classId))
{
  $query = $db->query("select * from course_list a INNER join course_offer b on a.course_code = b.course_code WHERE a.course_specificaton = $group");

}

else{

  $query = $db->query("select * from course_list a INNER join course_offer b on a.course_code = b.course_code WHERE  b.course_assign_class = '".$classId."'  and a.course_specificaton = $group");
 
}

 $outputOwner= '<option value="">Select Course</option>';
 foreach($query as $row){

    if($_SESSION['course'] == $row['course_code'])
    {
      $outputOwner.= "<option value = '".$row['course_code']."' selected>".$row['course_name']."</option>";
    }
    else{
      $outputOwner.= "<option value = '".$row['course_code']."'>".$row['course_name']."</option>";
    }

    

    
 }
 echo $outputOwner;