<?php


ob_start();
session_start();
include('../includes/connect.php');



$session = $_POST['session'];
$cls = $_POST['cls'];
$grp = $_POST['grp'];
$course_code =  $_POST['course_code'];
$sql_query = "SELECT `active_semester` FROM `session` WHERE name = '".$session."'";

$query = $db->query($sql_query);

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
       echo $row['active_semester'];
    }
}


?>