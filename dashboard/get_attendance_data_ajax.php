<?php
	ob_start();
    session_start();
    include('../includes/connect.php');
    include('../includes/function.php');
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];


    $s_id = $_SESSION['s_id'];

    $raw_q = "SELECT machine_id FROM `student_profile` WHERE s_id = '".$s_id."' limit 1";
    $query = $db->query( $raw_q );
    $machine_id = null;

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $machine_id = $row['machine_id'];
        break;
        }
    }
    $rawQuery ='';
    if(isset($day) && $day != ''){
        $rawQuery = "SELECT * FROM `attendance` where `time` like '%".$day."%' and  `machine_id` = '".$machine_id."'";
    } 
    else
    {
        $rawQuery = "SELECT * FROM `attendance` where `time` like '%".$year."-".$month."%' and  `machine_id` = '".$machine_id."'";
    }
    echo $rawQuery;
    $query = $db->query($rawQuery);

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            print_r($row);
        }
    }
    