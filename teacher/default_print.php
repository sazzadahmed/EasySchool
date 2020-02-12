<?php 
 ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');
 include_once'../fpdf181/fpdf.php';
 
    $sem= 1;
    $sid=1096020;
    $pdf=new FPDF();
    $pdf->AddPage('L','A4','0');
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
       $pdf->Image('../img/julogo.PNG',80,9);
       $pdf->Image('../img/cgpa.PNG',230,9);
       $pdf ->SetFont('Arial','B',16);
       $pdf->Cell(276,5,'DEPARTMENT OF ENGISH',0,0,'C');
       $pdf->Ln(7);
       $pdf ->SetFont('Arial','B',12);
       $pdf->Cell(276,5,'Jahangirnagar University',0,0,'C');
       $pdf->Ln(10);
       $pdf ->SetFont('Arial','',12);
       $pdf->Cell(276,5,'DETAIL MARKS & GRADE SHEET',0,0,'C');
       $pdf->Ln(15);
 	
  	
    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(18,6,'In Take:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(80,6,'1-7',0,0,'L');

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(26,6,'Course Code:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(100,6,'CC003',0,0,'L');

    $pdf->Ln(6);

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(18,6,'Section:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(80,6,'1',0,0,'L');

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(28,6,'Course CTitle:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(100,6,'Algorithms',0,0,'L');

    $pdf->Ln(6);

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(20,6,'Trimester:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(78,6,'Summer-2016',0,0,'L');

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(31,6,'Course Teacher:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(100,6,'CC003',0,0,'L');

    $pdf->Ln(12);
 	

 		$pdf ->SetFont('Times','B',12);
 		$pdf->Cell(10,6,'Sl',1,0,'C');
 		$pdf->Cell(25,6,'Exam ID',1,0,'C');
 		$pdf->Cell(45,6,'Student Name',1,0,'C');
 		$pdf->Cell(17,6,'Atte(10)',1,0,'C');
 		$pdf->Cell(29,6,'Class Test(15)',1,0,'C');
    $pdf->Cell(17,6,'Quiz(10)',1,0,'C');
    $pdf->Cell(17,6,'Assi(10)',1,0,'C');
    $pdf->Cell(17,6,'Pre(15)',1,0,'C');
    $pdf->Cell(30,6,'Final Exam(40)',1,0,'C');
    $pdf->Cell(20,6,'Total(100)',1,0,'C');
    $pdf->Cell(25,6,'Letter Grade',1,0,'C');
    $pdf->Cell(25,6,'Grade Point',1,0,'C');
 		$pdf->Ln();
    $pdf ->SetFont('Times','',12);  

    $pdf->Cell(10,6,'1',1,0,'C');
    $pdf->Cell(25,6,'1111',1,0,'C');
    $pdf->Cell(45,6,'Rubayet Hasan',1,0,'L');
    $pdf->Cell(17,6,'8',1,0,'C');
    $pdf->Cell(29,6,'12',1,0,'C');
    $pdf->Cell(17,6,'Q8',1,0,'C');
    $pdf->Cell(17,6,'8',1,0,'C');
    $pdf->Cell(17,6,'Pre(15)',1,0,'C');
    $pdf->Cell(30,6,'32',1,0,'C');
    $pdf->Cell(20,6,'80',1,0,'C');
    $pdf->Cell(25,6,'A+',1,0,'C');
    $pdf->Cell(25,6,'4',1,0,'C');
    $pdf->Ln(); 


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
 	


 
 $pdf->output();


?>