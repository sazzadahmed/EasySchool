<?php
  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');

  $year = $_POST['year'];
  $month = $_POST['month'];
  $status = "1";

  $query = $db->query("SELECT en_id,amount FROM `salary` WHERE year = '".$year."' and month = '".$month."' and `status` = '".$status."'");

  if ($query->num_rows > 0) {
    while($row = $query->fetch_assoc()) {
        print_r($row);

    }
  }