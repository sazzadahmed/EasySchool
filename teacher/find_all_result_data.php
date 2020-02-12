
<?php

  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');

  $semester = $_POST['semester'];
  $course = $_POST['course'];

  if(empty($course)){
      $course = $_SESSION['course'];
  }
  $s_id = $_POST['s_id'];

  $dbGetSemesterId = $db->query("select id from semester where semester = '".$semester."'");
  foreach($dbGetSemesterId as $singleSeme){
    $semester = $singleSeme['id'];
  break;
  }


echo("SELECT * FROM `result` WHERE s_id = '".$s_id."' and semester = ".$semester." and course_offer_id = '".$course."' limit 1");

 $query = $db->query("SELECT * FROM `result` WHERE s_id = '".$s_id."' and semester = ".$semester." and course_offer_id = '".$course."' limit 1");
foreach($query as $row) {
     print_r(json_encode($row));
break;
}
