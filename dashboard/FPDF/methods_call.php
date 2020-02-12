<?php require_once('file_with_five_methods.php'); 
$pdf = new PDF();
  ob_start();
  session_start();
  include('../../includes/connect.php');
  include('../../includes/function.php');

if(isset($_POST['Download_cv'])){
    $Student_id=$_POST['Student_id'];
     $query = $db->query("SELECT * FROM student_profile WHERE s_id =$Student_id");
     $row2 = $db->query("SELECT * FROM education_info WHERE s_id =$Student_id");

       if($query->num_rows>0) {
          $row = $query->fetch_assoc();
           $pdf->Download_cv($row,$row2);
}
   
}

elseif(isset($_POST['download_routine'])){
  $select_day_name=$db->query("SELECT day_name FROM  days");
  if($select_day_name->num_rows>0) {
           $pdf->Download_routine($select_day_name);
}
  /*  $Student_id=$_POST['Student_id'];
     $query = $db->query("SELECT * FROM student_profile WHERE s_id =$Student_id");
     $row2 = $db->query("SELECT * FROM education_info WHERE s_id =$Student_id");

       if($query->num_rows>0) {
          $row = $query->fetch_assoc();
           $pdf->Download_cv($row,$row2);
}*/
   
}
else{
    echo 'Opps !!! You Can Not Access This Page Directly !!!';
}
?>
