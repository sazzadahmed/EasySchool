<?php
ob_start();
session_start();
include('../includes/connect.php');
include('../includes/function.php');
$cls = $_POST['cls'];
$grp = $_POST['grp'];
$session = $_POST['session'];

switch($grp)
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

$query3 = $db->query("SELECT s_id, s_name FROM `student_profile` WHERE `session` = '".$session."' and `a_program` = '".$program."' and `admission_class` = '".$cls."' and `studentship` = 1 order by s_id asc");


if ($query3->num_rows > 0) {
    while ($row = $query3->fetch_assoc()) {
        print_r($row);
    }
}