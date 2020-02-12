<?php
  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');

$session = $_POST['session'];
$pgrm = $_POST['pgrm'];
$cls = $_POST['cls'];

$program = '';
switch($pgrm)
{
    case '1':
        $program = 'Science';
    break;
    case '2':
        $program = 'Commerce';
    break;
    case '3':
        $program = 'Arts';
    break;
    default:
    $program = 'All';
    break;
}




$query = $db->query("SELECT s_id FROM `student_profile` WHERE admission_class = '".$cls."' AND a_program = '".$program."' AND session ='".$session."'");

$cnt = 0;
$data = array();
if ($query->num_rows > 0) {
  while($row = $query->fetch_assoc()) {
    $data[$cnt] = $row['s_id'];
    $cnt = $cnt + 1;
  }
}
print_r($data);


?>