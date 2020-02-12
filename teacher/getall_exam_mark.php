<?php 

ob_start();
session_start();
include('../includes/connect.php');
include('../includes/function.php');

$exam_id = $_POST['examId'];

$query = $db->query("SELECT a.*,b.type `type` FROM `exam_mark_entry` a inner join `exam` b on a.exam = b.id where a.exam =".$exam_id);
   $response = [];

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            print_r($row);
        }
    }

    
