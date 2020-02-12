<?php
  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');


  $month = $_POST['month'];
  $year = $_POST['year'];
  $e_id = $_POST['e_id'];
  $status = $_POST['status'];
  $session = null;
  $raw_q = null;
  if($status == '1')
  {
    $session  = $_POST['session'];
    
    $raw_q = "SELECT * FROM `salary` WHERE `month`= '".$month."' and `year` = '".$year."' and `status` = '".$status."' and `session` = '".$session."' and `en_id` = '".$e_id."'";

  }
  else
  {
    $raw_q = "SELECT * FROM `salary` WHERE `month`= '".$month."' and `year` = '".$year."' and `status` = '".$status."' and `en_id` = '".$e_id."'";
  }
  $query = $db->query($raw_q);
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        print_r($row);
    }
}
