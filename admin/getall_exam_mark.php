<?php 

ob_start();
session_start();
include('../includes/connect.php');
include('../includes/function.php');

$exam_id = $_POST['examId'];

$query = $db->query("SELECT * FROM `exam_mark_entry` where `exam` =".$exam_id);

   $response = [];

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            print_r($row);
        }
    }

    
