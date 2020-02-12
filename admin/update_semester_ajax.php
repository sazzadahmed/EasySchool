<?php
  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');
  $session = $_POST['session'];
  $seme = $_POST['newseme'];
  $query = $db->query("UPDATE `session` SET`active_semester`= '".$seme."' WHERE `name` = '".$session."'");

  if($seme == '4')
  {

    $sql = "UPDATE `student_profile` set `admission_class` = 'twelve' where `admission_class` = 'eleven'";
    $db->query($sql);
    echo 'success_year_up';
  }
  else
  {
    echo 'success';
  }
  