

<?php

  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');
$rm = $_POST['rm_name'];

 $query = $db->query("SELECT * FROM `room` WHERE `room_name` = '".$rm."' limit 1");
 $outputOwner= '<option value="" disable>Select Section</option>';
 foreach($query as $row){
print_r($row);
 }
