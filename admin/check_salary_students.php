<?php
  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');

  $year = $_POST['year'];
  $s_id = $_POST['s_id'];
  $status = "1";

  $query = $db->query("SELECT `month` FROM `salary` WHERE year = '".$year."' and en_id = '".$s_id."' and `status` = '".$status."'");

  if ($query->num_rows > 0) {
    while($row = $query->fetch_assoc()) {
        print_r($row);

    }
  }