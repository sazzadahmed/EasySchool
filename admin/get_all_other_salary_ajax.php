<?php
  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');
  $toDate = $_POST['fromDate'];
  $fromDate = $_POST['toDate'];
 $query = $db->query("SELECT * FROM `salary` WHERE `status` = 4 and date_of_payment > '".$toDate."' and date_of_payment < '".$fromDate."' order by date_of_payment asc");

  if ($query->num_rows > 0) {
  
      while ($row = $query->fetch_assoc()) {
        print_r($row);
         
      }
  }



?>