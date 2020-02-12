

<?php 
  include('../includes/connect.php');
  include('../includes/function.php');
  include_once'../fpdf181/fpdf.php';
  $pdf=new FPDF();
 
$totalcredit=0; 
    $totalsgpa=0; 
    $sgpa=0;
    $cgpa=0;
if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['student'])){
  
   $sem= $_POST['sem_name'];
   $sid= $_POST['s_id'];
   $pdf->AddPage();
   $semester="";
    $name="";
        $query = $db->query("SELECT * FROM semester where id='$sem'");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
            $semester=$row["semester"];
            }
         } 
         $query = $db->query("SELECT * FROM student_profile where s_id='$sid'");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
            $name=$row["s_name"];
            }
         } 
           
    $pdf ->SetFont('Times','',12);
       $pdf->Image('../img/julogo.PNG',40,9);
       $pdf ->SetFont('Arial','B',16);
       $pdf->Cell(200,5,'DEPARTMENT OF ENGISH',0,0,'C');
       $pdf->Ln(7);
       $pdf ->SetFont('Arial','B',12);
       $pdf->Cell(200,5,'Jahangirnagar University',0,0,'C');
       $pdf->Ln(15);
       $pdf ->SetFont('Arial','',12);
       $pdf->Cell(200,5,'Result of MA in ELT',0,0,'C');
       $pdf->Ln(5);
       $pdf ->SetFont('Arial','',12);
       $pdf->Cell(200,5,'Under MAPW',0,0,'C');
       $pdf->Ln(5);
       $pdf ->SetFont('Arial','',12);
       $pdf->Cell(200,5,'Trimester:'.$semester,0,0,'C');
       $pdf->Ln(15);
  
    
    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(45,6,'Name Of The Student:',0,0,'C');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(35,6,$name,0,0,'L'); 
    $pdf->Ln(8);
    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(25,6,'Student ID:',0,0,'C');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(65,6,$sid,0,0,'L'); 
    $pdf->Ln(8);
    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(22,6,'Semester:',0,0,'C');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(77,6,$semester,0,0,'L'); 
    $pdf->Ln(12);
  

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(35,6,'Course Code',1,0,'C');
    $pdf->Cell(50,6,'Course Title',1,0,'C');
    $pdf->Cell(35,6,'Credit',1,0,'C');
    $pdf->Cell(35,6,'Grade',1,0,'C');
    $pdf->Cell(35,6,'Grade Point',1,0,'C');
    $pdf->Ln();
    $pdf ->SetFont('Times','',12);  

    $totalcredit=0;
        
            
            
            $query2 = $db->query("SELECT * FROM `course_list` inner join result on result.course_offer_id=course_list.id where result.semester='$sem' and result.s_id='$sid'");
                if($query2->num_rows>0) {
              while($row = $query2->fetch_assoc()) {
              $pdf->Cell(35,6,$row['course_code'],1,0,'C');
              $pdf->Cell(50,6,$row['course_title'],1,0,'L');
              $pdf->Cell(35,6,$row['credit'],1,0,'C');
              $totalcredit=$totalcredit+$row['credit'];
              $credit=$row['credit'];
              $pdf->Cell(35,6,$row["lg"],1,0,'C');
              $pdf->Cell(35,6,$row["gp"],1,0,'C');
              $pdf->Ln();
              $sgpa=$row["gp"]*$credit;
              $totalsgpa=$totalsgpa+$sgpa;
              }
              
              
          
        
        $cgpa=$totalsgpa/$totalcredit;
        $sgpa=round($cgpa,2);
           }
    $pdf->Ln();
    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(40,6,'Total Credit Taken:',0,0,'C');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(10,6,$totalcredit,0,0,'C');
    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(95,6,'SGPA:',0,0,'C');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(-70,6, $sgpa,0,0,'C'); 


      $pdf->Ln(20);
      $pdf ->SetFont('Times','',12);
      $pdf->Cell(150,6,'Members',0,0,'C');
      $pdf->Cell(40,6,'Coordinator',0,0,'C');
      $pdf->Ln();
      $pdf ->SetFont('Times','',12);
      $pdf->Cell(150,6,'Coordination Committee',0,0,'C');
      $pdf->Cell(40,6,'Coordination Committee',0,0,'C');
      $pdf->Ln();
      $pdf ->SetFont('Times','',12);
      $pdf->Cell(40,6,'Pro-Vice Chancellor',0,0,'C');
      $pdf->Ln();
}
$pdf->output();
?>