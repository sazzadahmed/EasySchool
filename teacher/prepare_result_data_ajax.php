<?php


ob_start();
session_start();
include('../includes/connect.php');



$session = $_POST['session'];
$cls = $_POST['cls'];
$grp = $_POST['grp'];
$course_code =  $_POST['course_code'];
$t_id = $_SESSION['t_id'];
$sql_query = "select a.id exam_id, a.type exam_type,a.class,a.session,a.subject,a.major,a.t_id,a.mark exam_max_mark,a.mcq exam_max_mcq, a.written exam_written_mark,b.mark getting_mark,b.written getting_written_mark, b.mcq getting_mcq_mark,b.total total_mark,b.s_id s_id,b.isabsent isabsent ,practical prac from exam a inner join exam_mark_entry b on a.id = b.exam where a.class = '".$cls."' and a.session = '".$session."' and a.major = ".$grp." and a.subject = '".$course_code."' and t_id =".$t_id;

$query = $db->query($sql_query);

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        print_r($row);
    }
}


?>