<?php
  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');
  $query = '';
  echo $_POST['type'];
  if($_POST['type'] == 'teacher') {
  $query = $db->query("SELECT id, username, `status` FROM `teacher_profile` WHERE  1");
  }
  else
  {
    $query = $db->query("SELECT id, username, `status` FROM `stuff_profile` WHERE  1");
  }
  if ($query->num_rows > 0) {
  
      while ($row = $query->fetch_assoc()) {
        print_r($row);
         
      }
  }



?>