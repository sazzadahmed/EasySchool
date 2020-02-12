<?php
  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');



  $month = $_POST['month'];
  $year = $_POST['year'];
  $s_id = $_POST['s_id'];
  $amount = $_POST['amount'];
  $submittingMode = $_POST['submittingMode'];
  $status = 1;
  if($_POST['stuff'] != -1){
    if($_POST['type'] == 'teacher')
    {
      $status = 2;
    }
    else
    {
      $status = 3;
    }
   
  }

$seQuery = "SELECT * from `salary` where year = '".$year."' and month = '".$month."' and `status` = '".$status."' and en_id = '".$s_id."'";
$dataResult = $db->query($seQuery);


if ($dataResult->num_rows > 0 && !$submittingMode) {

    $rowquery = "UPDATE `salary` SET `amount`='".$amount."' where year = '".$year."' and month = '".$month."' and `status` = '".$status."' and en_id = '".$s_id."'";
    $db->query($rowquery);
    echo 'Successfully Updated';

}
else{

    $rowquery ="INSERT INTO `salary`( `status`, `month`, `year`,`amount`,`en_id`) VALUES ($status,'".$month."','".$year."','".$amount."', '".$s_id."')";
    $db->query($rowquery);
    echo 'Successfully Inserted';
  
}


