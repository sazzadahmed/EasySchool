<?php
  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');

  $year = $_POST['year'];
  $t_id = $_POST['t_id'];
  $status =$_POST['status'];
  echo "SELECT `month` FROM `salary` WHERE year = '".$year."' and en_id = '".$t_id."' and `status` = '".$status."'";
  $query = $db->query("SELECT `month` FROM `salary` WHERE year = '".$year."' and en_id = '".$t_id."' and `status` = '".$status."'");

  if ($query->num_rows > 0) {
    while($row = $query->fetch_assoc()) {
        print_r($row);

    }
  }