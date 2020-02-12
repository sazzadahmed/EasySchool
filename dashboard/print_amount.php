
<?php 
  include('../includes/connect.php');
  include('../includes/function.php');
  include_once'../fpdf181/fpdf.php';
  $pdf=new FPDF();
if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['submit'])){
  
   
   $sid= $_POST['sid'];
   $i= $_POST['i'];
   $bid= $_POST['bid'];
   $totalamount= $_POST['total'];
   $pdf->AddPage();
   $semester="";
    $name="";
     
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
       $pdf->Ln(15);
  
    
    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(45,6,'Name Of The Student:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(35,6,$name,0,0,'L'); 
    $pdf->Ln(8);
    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(25,6,'Student ID:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(65,6,$sid,0,0,'L'); 
    $pdf->Ln(8);
    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(20,6,'Biller ID:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(65,6,$bid,0,0,'L'); 
    $pdf->Ln(8);
    $pdf->Ln(12);
  

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(20,6,'',0,0,'C');
    $pdf->Cell(35,6,'SL',1,0,'C');
    $pdf->Cell(50,6,'Course Code',1,0,'C');
    $pdf->Cell(35,6,'Credit',1,0,'C');
    $pdf->Cell(35,6,'Amount',1,0,'C');
    $pdf->Ln(); 
      for($a=1;$a<$i;$a++){

      $pdf ->SetFont('Times','',12);
      $pdf->Cell(20,6,'',0,0,'C');
      $pdf->Cell(35,6, $a,1,0,'C');
      $pdf->Cell(50,6, $_POST['course_code'.$a],1,0,'C');
      $pdf->Cell(35,6, $_POST['credit'.$a],1,0,'C');
      $pdf->Cell(35,6, $_POST['amount'.$a],1,0,'C');
      $pdf->Ln(); 
    }

    $pdf->Ln();
    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(30,6,'Total Amount:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(40,6,$totalamount,0,0,'L');
    

      $pdf->Ln(20);
      $pdf ->SetFont('Times','',12);
      $pdf->Cell(40,6,'Account Officer',0,0,'C');
      $pdf->Ln();
}
$pdf->output();
?>