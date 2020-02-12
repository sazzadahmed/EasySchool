<?php
	ob_start();
    session_start();
    include('../includes/connect.php');
    include('../includes/function.php');
    $course_code = $_POST['course_code'];
    $rawQuery = "SELECT * FROM `course_list` where `course_code` = '".$course_code."' limit 1";
    $query = $db->query($rawQuery);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            print_r($row);
        }
    }
    