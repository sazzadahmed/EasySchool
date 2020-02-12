<?php 
 ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');
  include_once'../fpdf181/fpdf.php';
  $pdf=new FPDF();
    $totalcredit=0; 
    $totalsgpa=0; 
    $sgpa=0;
    $cgpa=0;
  if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['semester'])){
  
 
    $sem= $_POST['sem_name'];
   $semester="";
 $pdf->AddPage();
         $query = $db->query("SELECT * FROM semester where id='$sem'");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
          	$semester=$row["semester"];
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
       $pdf->Ln(10);
 	
  	
       
 	
 		$pdf ->SetFont('Times','B',12);
 		$pdf->Cell(15,6,'Sl No',1,0,'C');
 		$pdf->Cell(30,6,'ID No',1,0,'C');
 		$pdf->Cell(50,6,'Attached Hall',1,0,'C');
 		$pdf->Cell(50,6,'Name Of the Student',1,0,'C');
 		$pdf->Cell(45,6,'Obtained CGPA',1,0,'C');
 		$pdf->Ln();
      
    $query = $db->query("SELECT * FROM result inner join student_profile on result.s_id=student_profile.s_id where result.semester='$sem' group by result.s_id");
        if($query->num_rows>0) {
          $i=1;
          while($row1 = $query->fetch_assoc()) {
          $sid=$row1['s_id'];
           $query2 = $db->query("SELECT * FROM `course_list` inner join result on result.course_offer_id=course_list.id where result.semester='$sem' and result.s_id='$sid'");
              if($query2->num_rows>0) {
              while($row = $query2->fetch_assoc()) {

              $totalcredit=$totalcredit+$row['credit'];
              $credit=$row['credit'];

              $sgpa=$row["gp"]*$credit;
              $totalsgpa=$totalsgpa+$sgpa;
              }
              $cgpa=$totalsgpa/$totalcredit;
              $sgpa=round($cgpa,2);
           }
              $totalsgpa=0;
              $totalcredit=0;
              $pdf ->SetFont('Times','',12);
           		$pdf->Cell(15,6,$i,1,0,'C');
           		$pdf->Cell(30,6,$row1['s_id'],1,0,'C');
           		$pdf->Cell(50,6,$row1["hall"],1,0,'L');
           		$pdf->Cell(50,6,$row1["s_name"],1,0,'L');
           		$pdf->Cell(45,6,$sgpa,1,0,'C');
           		$pdf->Ln();
           	  $i++;
              $sgpa=0;
          }
        }


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
if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['grade_sheet'])){
   $sem= $_POST['sem_id'];
   $sub= $_POST['sub_id'];
   $course_title="";
   $course_code="";
   $semester="";
   $teacher="";
   $sec=Null;
   $teacher=teacher_info($_SESSION['t_id'],'name');
   $pdf->AddPage('L','A4','0');
   $query = $db->query("SELECT * FROM semester where id='$sem' limit 1");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
          	$semester=$row["semester"];
            }
         } 
   $query = $db->query("SELECT * FROM course_list where id='$sub' limit 1");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
            $course_title=$row["course_title"];
            $course_code=$row["course_code"];
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
    $pdf->Cell(100,6,$course_code,0,0,'L');

    $pdf->Ln(6);

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(18,6,'Section:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(80,6,$sec,0,0,'L');

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(28,6,'Course CTitle:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(100,6,$course_title,0,0,'L');

    $pdf->Ln(6);

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(20,6,'Trimester:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(78,6,$semester,0,0,'L');

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(31,6,'Course Teacher:',0,0,'L');
    $pdf ->SetFont('Times','',12);
    $pdf->Cell(100,6,$teacher,0,0,'L');

    $pdf->Ln(12);

    $pdf ->SetFont('Times','B',12);
    $pdf->Cell(10,6,'Sl',1,0,'C');
    $pdf->Cell(30,6,'Exam ID',1,0,'C');
    //$pdf->Cell(45,6,'Student Name',1,0,'C');
    $pdf->Cell(20,6,'Atte(10)',1,0,'C');
    $pdf->Cell(35,6,'Class Test(15)',1,0,'C');
    $pdf->Cell(20,6,'Quize(10)',1,0,'C');
    $pdf->Cell(20,6,'Assi(10)',1,0,'C');
    $pdf->Cell(20,6,'Pre(15)',1,0,'C');
    $pdf->Cell(35,6,'Final Exam(40)',1,0,'C');
    $pdf->Cell(25,6,'Total(100)',1,0,'C');
    $pdf->Cell(30,6,'Letter Grade',1,0,'C');
    $pdf->Cell(25,6,'Grade Point',1,0,'C');
    $pdf->Ln();

    $query = $db->query("SELECT * from result inner join course_offer on result.course_offer_id=course_offer.course_id where result.semester='$sem' and course_offer.course_id='$sub'");
        if($query->num_rows>0) {
          $i=1;
          while($row = $query->fetch_assoc()) {
            $pdf ->SetFont('Times','',12);
            $pdf->Cell(10,6,$i,1,0,'C');
            $pdf->Cell(30,6,$row['s_id'],1,0,'C');
            //$pdf->Cell(45,6,$row['st_name'],1,0,'L');
            $pdf->Cell(20,6,$row['attend'],1,0,'C');
            $pdf->Cell(35,6,$row['ct'],1,0,'C');
            $pdf->Cell(20,6,$row['quize'],1,0,'C');
            $pdf->Cell(20,6,$row['assignment'],1,0,'C');
            $pdf->Cell(20,6,$row['presentation'],1,0,'C');
            $pdf->Cell(35,6,$row['final_exam'],1,0,'C');
            $pdf->Cell(25,6,$row['total'],1,0,'C');
            $pdf->Cell(30,6,$row['lg'],1,0,'C');
            $pdf->Cell(25,6,$row['gp'],1,0,'C');
            $pdf->Ln();  
        $i++;
          }
        }

    $pdf ->SetFont('Times','',12);  
}

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