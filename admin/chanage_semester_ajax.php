<?php
  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');
  $session = $_POST['session'];

  $query = $db->query("SELECT * FROM `session` WHERE `name` = '".$session."'");
 
  if ($query->num_rows > 0) {
  
      while ($row = $query->fetch_assoc()) {
        print_r($row);   
      }
}



?>