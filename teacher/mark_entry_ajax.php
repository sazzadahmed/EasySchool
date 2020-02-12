<?php 

ob_start();
session_start();
include('../includes/connect.php');
include('../includes/function.php');

$id = $_POST['id'];
$cls ='';
$program = '';
$session = '';


$queryResult = $db->query("select * from exam where id = $id");

while ($row = $queryResult->fetch_assoc()) {

    if(isset($_POST['flag'])) print_r($row);

$cls = $row['class'];
$program = $row['major'];
$session = $row['session'];
break;

}

$query2 = $db->query("select * from program where id = $program");

while ($row = $query2->fetch_assoc()) {
    $program = $row['program_name'];
break;
    }

$query3 = $db->query("SELECT * FROM `student_profile` WHERE `session` = '".$session."' and `a_program` = '".$program."' and `admission_class` = '".$cls."' and `studentship` = 1");


if ($query3->num_rows > 0) {
    while ($row = $query3->fetch_assoc()) {
        if(!isset($_POST['flag'])) print_r($row);
    }
}



?>