<?php
 use setasign\Fpdi\Fpdi;
require_once ('fpdf/fpdf.php');
require_once ('fpdi/src/autoload.php');
require('mc_table.php');


class PDF extends FPDF

{
	

	// Page footer

	function Footer()
	{

		// Position at 1.5 cm from bottom

		$this->SetY(-15);

		// Arial italic 8

		$this->SetFont('Arial', 'I', 8);

		// Page number

		$this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
    function Download_cv($row,$row2)
	{
		
		// $object_of_pdf = new FPDF('P','mm',array(100,250));

		$object_of_pdf = new FPDF('P', 'mm', 'A3');
		$object_of_pdf->AddPage();
       $object_of_pdf->SetMargins(20,0,20);

		$object_of_pdf->Ln(4);
		//$object_of_pdf->Cell(110);

        $object_of_pdf->Image('../Image/'.$row['s_id'].'.jpg', 240, 20, 50);
        $object_of_pdf->SetX(120);
        $object_of_pdf->SetFont('Arial', 'B', 20);
        $object_of_pdf->Cell(110,5,'Curriculum vitae',0,1);
        $object_of_pdf->Line(120,20,175,20);
       // $object_of_pdf->SetLineWidth(100);
         
         //Parsonal Information..........
         $object_of_pdf->SetFont('Arial', 'B', 16);
        $object_of_pdf->Ln(10);
         $object_of_pdf->SetX(120);
        $object_of_pdf->Cell(110,5,'Personal Information',0,1);
        
        $object_of_pdf->SetFont('Arial', 'B', 11);
         $object_of_pdf->Ln(10);
          //$object_of_pdf->Cell(100,5,'ID : '.$row['s_id']);
         $object_of_pdf->Cell(100,7,'Name : '.$row['s_name']);
         $object_of_pdf->Cell(100,7,'Present Address : '.$row['present_address'],0,1);
         $object_of_pdf->Cell(100,7,'Date Of Birth : '.$row['date_of_birth']);
         $object_of_pdf->Cell(100,7,'Mobile Number : '.$row['s_mobile'],0,1);
          $object_of_pdf->Cell(100,7,'Nationality : '.$row['nationality']);
         $object_of_pdf->Cell(100,7,'Email : '.$row['s_email'],0,1);
          $object_of_pdf->Cell(100,7,'NID NO : '.$row['s_nid'],0,1);
          $object_of_pdf->Cell(100,7,'Gender : '.$row['gender'],0,1);
          //Parents and Guardians Information..........
           $object_of_pdf->SetFont('Arial', 'B', 16);
        $object_of_pdf->Ln(10);
         $object_of_pdf->SetX(100);
        $object_of_pdf->Cell(110,5,'Parents And Guardians Information',0,1);
        
        $object_of_pdf->SetFont('Arial', 'B', 14);
         $object_of_pdf->Ln(10);
         $object_of_pdf->Cell(100,7,'Father Info : ');
         $object_of_pdf->Cell(100,7,'Mother Info : ');
          $object_of_pdf->Cell(100,7,'Guardian Info : ',0,1);
         $object_of_pdf->SetFont('Arial', 'B', 11);
         $object_of_pdf->Ln(10);
         $object_of_pdf->Cell(100,7,'Father Name : '.$row['f_name']);
         $object_of_pdf->Cell(100,7,'Mother Name : '.$row['m_name']);
         $object_of_pdf->Cell(100,7,'Guardian Name : '.$row['g_name'],0,1);
         $object_of_pdf->Cell(100,7,'Mobile Number : '.$row['f_mobile']);
         $object_of_pdf->Cell(100,7,'Mobile Number : '.$row['m_mobile']);
          $object_of_pdf->Cell(100,7,'Mobile Number : '.$row['g_mobile'],0,1);
          $object_of_pdf->Cell(100,7,'NID NO : '.$row['f_nid']);
          $object_of_pdf->Cell(100,7,'NID NO : '.$row['m_nid']);
           $object_of_pdf->Cell(100,7,'NID NO : '.$row['g_nid'],0,1);
           //Education Info...............
           $object_of_pdf->SetFont('Arial', 'B', 16);
        $object_of_pdf->Ln(10);
         $object_of_pdf->SetX(120);
        $object_of_pdf->Cell(110,5,'Educational Information',0,1);
        $object_of_pdf->SetFont('Arial', 'B', 13);
         $object_of_pdf->Ln(10);
         $object_of_pdf->Cell(80,7,'Degree ',1);
         $object_of_pdf->Cell(60,7,'Group ',1);
         $object_of_pdf->Cell(80,7,'Institution ',1);
         $object_of_pdf->Cell(20,7,'GPA ',1);
         $object_of_pdf->Cell(20,7,'Year ',1,1);
          $object_of_pdf->SetFont('Arial', 'B', 11);
          while($row3 = $row2->fetch_assoc()) { 
          $object_of_pdf->Cell(80,7,$row3['degree_name'],1);
         $object_of_pdf->Cell(60,7,$row3['group_name'],1);
         $object_of_pdf->Cell(80,7,$row3['school_name'],1);
         $object_of_pdf->Cell(20,7,$row3['gpa'],1);
         $object_of_pdf->Cell(20,7,$row3['pass_year'],1,1);
          }
        //Job Experiance................
         $object_of_pdf->SetFont('Arial', 'B', 16);
        $object_of_pdf->Ln(10);
         $object_of_pdf->SetX(120);
        $object_of_pdf->Cell(110,5,'Job Experiance',0,1);
        
        $object_of_pdf->SetFont('Arial', 'B', 11);
         $object_of_pdf->Ln(10);
         $object_of_pdf->MultiCell(100,7,$row['experience']);
		
		     $object_of_pdf->AliasNbPages();
		    $object_of_pdf->Output();
	}

  function Download_routine($select_day_name){

      // $object_of_pdf = new FPDF('P', 'mm', 'A3');
       $object_of_pdf = new PDF_MC_Table('P', 'mm', 'A3');
       $year=date("Y");
       global $db;
       while ($day_name=$select_day_name->fetch_assoc()) {
        $object_of_pdf->AddPage();
        $object_of_pdf->SetMargins(20,10,20);
        $object_of_pdf->Ln(4);
        $object_of_pdf->SetFont('Arial', 'B', 16);
        $object_of_pdf->SetX(130);
        $object_of_pdf->Cell(50,5,$day_name['day_name'],0,1);
        $object_of_pdf->Cell(50,10,'',0,1);
        $store_time_slot=array();$store_time_slot_for_display=array();
        $day=$day_name['day_name'];
        $sat_time_slots = $db->query("SELECT DISTINCT time_slot,time_slot_end FROM course_offer where year='$year' and day='$day'");
           $object_of_pdf->SetFont('Arial', 'B', 12);
           $object_of_pdf->SetWidths(array(30,30,30,40));
         while($row = $sat_time_slots->fetch_assoc()) {
            //$store_time_slot[]=$row['time_slot'];//.'-'.$row['time_slot_end'];
            $store_time_slot[]=$row['time_slot'];
            $store_time_slot_for_display[]=$row['time_slot'].'-'.$row['time_slot_end'];
         }
         $object_of_pdf->Row(array('Class'),$store_time_slot_for_display);
         $get_classes = $db->query("SELECT class_name FROM classes");
         while($class = $get_classes->fetch_assoc()) {
          $p=array();
          foreach ($store_time_slot as $time_slot_value) {
            $query2 = $db->query("SELECT * FROM course_offer where year='$year' and day='$day' and course_assign_class='$class[class_name]' and time_slot='$time_slot_value' ");
            $store_class_code_and_section='';
            while ($row2=$query2->fetch_assoc()) {
              $store_class_code_and_section=$store_class_code_and_section.$row2['course_code']."(".$row2['section'].")\n";

            }
            $p[]=$store_class_code_and_section;
          }
          
          $object_of_pdf->Row(array($class['class_name']),$p);
         }

       }

       $object_of_pdf->AliasNbPages();
        $object_of_pdf->Output('D','Routine.pdf');
  }
}

?>
































