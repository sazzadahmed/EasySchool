<?php
	ob_start();
    session_start();
    include('../includes/connect.php');
    include('../includes/function.php');
    $rawQuery = "Select * from student_exam_result where `s_id` = '".$_SESSION['s_id']."'";
    $query = $db->query($rawQuery);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            print_r($row);
        }
    }
    