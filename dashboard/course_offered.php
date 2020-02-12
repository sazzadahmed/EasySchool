<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>
<h1 class="page-header">Course Offering/Advising</h1>
<div class="table-responsive">
<?php


  $s_id = student_info($_SESSION['s_id'],'s_id');
  
  $semester_id = offer_semester_info("SELECT MAX(semester) FROM course_offer",'semester');

  //var_dump($semester_id);

  //$year = student_info($_SESSION['s_id'],'cur_year');


//that's why student profile will be update for every semester
//track for student we should read current year current semester

  $check = $db->query("SELECT * FROM registration WHERE semester='$semester_id' and s_id='$s_id'");
?>
<?php if($check->num_rows>0) { ?>
  <p> You've already submitted your course offer for this semester! </p>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Subject (Code)</th>
        <th>Teacher</th>
        <th>Time - Day</th>
        <th>Semester - Year</th>
        <th>Prereq 1</th>
        <th>Prereq 2</th>
        <th>Core</th>
        <th>Optional</th>
       
      </tr>
    </thead>
    <tbody>
    <?php
      while($row = $check->fetch_assoc()) {
        
          $course_offer_id = $row['cid'];
          $query = $db->query("SELECT * FROM course_offer WHERE course_id='$course_offer_id'");
          $course = $query->fetch_assoc();

          echo '<tr>
          <td>'.get_info("course_list",$course['course_id'],"course_code").'</td>
          <td>'.get_info("teacher_profile",$course['teacher_id'],"name").'</td>
          <td>'.$course['time_slot'].' - '.ucwords($course['day']).'</td>
          <td>'.ucwords($course['semester']).'</td>
          <td>'.get_info("course_list",get_info("course_list",$course['course_id'],"prerequ_1"),"course_code").'</td>
          <td>'.get_info("course_list",get_info("course_list",$course['course_id'],"prerequ_2"),"course_code").'</td>
           <td>'.get_info("course_list",syllabus_info1("syllabus",$row['course_id'],1,"core_id"),"course_code").'</td>
      <td>'.get_info("course_list",syllabus_info2("syllabus",$row['course_id'],1,"optional_id"),"course_code").'</td>
           </tr>';
        }
      
    ?>
    </tbody>
  </table>


<?php } else { ?>


<?php

  if (isset($_POST['submit'])) {
?>
<p >Your registration was successfully done</p>
<form action="download_amount.php" method="post">
<table class="table">
       <tr>
         <th>SL</th>
         <th>Course Code</th>
         <th>Credit</th>
         <th>Amount</th>
       </tr>
<?php
if(count($_POST['course_offer_id'])!=0){
  $i=1;
  $total=0;
  $course_code="course_code";
  $credit="credit";
  $amount="amount";
  $bid=md5(uniqid(rand(), true));
reset($_POST['course_offer_id']);

while (list($key, $val) = each($_POST['course_offer_id'])){

    if (isset($_POST['course_offer_id'])) {
      $course_offer_id = protect($val);

      //echo $course_offer_id;
    }
    
    if (isset($_POST['s_id'])) {
      $s_id = protect($_POST['s_id']);
    }
   
    if (isset($_POST['semester'])) {
      $semester = protect($_POST['semester']);
    }
    //cost table 
    ?>
    
       <?php
       $query = $db->query("SELECT * FROM `course_offer`,`course_list`,`amount` where amount.credit=course_list.credit and course_offer.course_id='$course_offer_id' and course_offer.course_id= course_list.id ");
         if($query->num_rows>0) {
          
         while($row = $query->fetch_assoc()) {

    
          ?>
       <tr>
         <td><?php echo$i;?></td>
         <td ><?php echo $row['course_code']?><input type="hidden" name="<?php echo $course_code.$i?>" value="<?php echo $row['course_code']?>"/></td>
         <td ><?php echo $row['credit']?><input type="hidden" name="<?php echo $credit.$i?>" value="<?php echo $row['credit']?>"/></td>
         <td ><?php echo $row['amount']?><input type="hidden" name="<?php echo $amount.$i?>" value="<?php echo $row['amount']?>"/></td>
       </tr>
       <?php 
       $total=$total+$row['amount'];


     
} }?>
   
  <?php
    //cost table end 
    if(empty($s_id)  or empty($semester) or empty($course_offer_id)) {
      echo error("All fields are required.");
    }
     else if($check->num_rows>0) {
      echo error("Course Offer, on <b>$semester</b> was submitted.");
    }
     else {
$insert = $db->query("INSERT into registration (s_id,cid,semester,biller_number) VALUES ('$s_id','$course_offer_id','$semester','$bid') ");
      
    }

$i++;
  }//while
 
} echo'</table>';
  echo'<input type="hidden" name="sid" value="'.$s_id.'">';
  echo'<input type="hidden" name="total" value="'.$total.'">';
  echo'<input type="hidden" name="i" value="'.$i.'">';
  //echo $i;
  echo'<input type="hidden" name="bid" value="'.$bid.'">';
  echo'<h2>Total Amount '.$total.'</h2>';
  echo'<button type="submit" name="submit" id="submit" class="btn btn-primary">Print</button>';
  echo'</form>';
} else{
?>

<form class="" id="" action="" method="post">

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Select</th>
        <th>Subject (Code)</th>
        <th>Teacher</th>
        <th>Time - Day</th>
        <th>Semester
        <th>Prereq 1</th>
        <th>Prereq 2</th>
        <th>Core</th>
        <th>Optional</th>
       
      </tr>
    </thead>
    <tbody>
    <?php

/*
      $cp = $db->query("SELECT * FROM result WHERE s_id='$s_id' ORDER BY id");
      $cp_row = $cp->fetch_assoc();
      echo $cp_row['course_offer_id'];
      $cp2 = $db->query("SELECT * FROM course_offer WHERE id='$cp_row["course_offer_id"]' ORDER BY id");
      $cp_row2 = $cp2->fetch_assoc();
      echo $cp_row2['course_id'];
      $cp3 = $db->query("SELECT * FROM course_list WHERE id='$cp_row2["course_id"]' ORDER BY id");
      $cp_row3 = $cp3->fetch_assoc();
      ----------------------------------------------

      //get course_offer_id from result table by row_id
      $course_offer_id = get_info("result",'row_id',"course_offer_id");
      // get course_id from course_offer table by $course_offer_id
      $course_id = get_info("course_offer",$course_offer_id,"course_id");

      // get prerequ_1 from course_list table by course_id
      $prerequ_1 = get_info("course_list",'course_id',"prerequ_1");
      // get prerequ_2 from course_list table by course_id
      $prerequ_2 = get_info("course_list",'course_id',"prerequ_2");

      $passed = array( 1, 2, 3, 4, 5);
      

*/
      //$year = date("Y");

      //$s_id = student_info($_SESSION['s_id'],'s_id');
      $semester = student_info($_SESSION['s_id'],'cur_sem');
      $year = student_info($_SESSION['s_id'],'cur_year');
      $query = $db->query("SELECT * FROM course_offer WHERE semester='$semester_id' ORDER BY id");
      



       if($query->num_rows>0) {

        $i=0;
        $ind=1;
         while($row = $query->fetch_assoc()) {
          //$code = get_info("course_list",$row['course_id'],"course_code");
         // var_dump($row['course_id']);
         $query_pre= $db->query("SELECT * FROM result WHERE s_id= '".$_SESSION['s_id']."' and (course_offer_id= ".get_info("course_list",$row['course_id'],"prerequ_1")." or course_offer_id=".get_info("course_list",$row['course_id'],"prerequ_2").")  ");

         $course_pre= $query_pre->fetch_assoc();

         //var_dump($course_pre);
         $marks= $course_pre['total'];
         //$id=  $course_pre['course_offer_id'];
        // var_dump($marks); 

         $course_code_offer = $course_pre['course_offer_id'];
         //var_dump($course_code_offer);

         $query_course= $db->query("SELECT * FROM course_list WHERE prerequ_1= ".get_info("course_list",$row['course_id'],"prerequ_1")." or prerequ_2=".get_info("course_list",$row['course_id'],"prerequ_2")." ");

         $course_registration= $query_course->fetch_assoc();

        //var_dump($course_registration['prerequ_1']);


        

         if($marks < 40 && ($course_code_offer = $course_registration['prerequ_1'] || $course_code_offer = $course_registration['prerequ_2'] ) ) {
          echo '<tr>
          <td><input type="checkbox" id="course_offer_id" name="course_offer_id[]" value="'.$row['course_id'].'" disabled></td>';
          
           echo '<td>'.get_info("course_list",$row['course_id'],"course_code").'</td>
          <td>'.get_info("teacher_profile",$row['teacher_id'],"name").'</td>
          <td>'.$row['time_slot'].' - '.ucwords($row['day']).'</td>
          <td>'.ucwords($row['semester']).'</td>
          <td>'.get_info("course_list",get_info("course_list",$row['course_id'],"prerequ_1"),"course_code").'</td>
          <td>'.get_info("course_list",get_info("course_list",$row['course_id'],"prerequ_2"),"course_code").'</td>
          <td>'.get_info("course_list",syllabus_info1("syllabus",$row['course_id'],1,"core_id"),"course_code").'</td>
      <td>'.get_info("course_list",syllabus_info2("syllabus",$row['course_id'],1,"optional_id"),"course_code").'</td>
           </tr>';

           }

           else {

          echo '<tr>
          <td><input type="checkbox" id="course_offer_id" class="course_offer_id'.$ind.'" name="course_offer_id[]" value="'.$row['course_id'].'" onclick="take_course('.$ind.');" ></td>';
          
echo '<td>'.get_info("course_list",$row['course_id'],"course_code").'</td>
          <td>'.get_info("teacher_profile",$row['teacher_id'],"name").'</td>
          <td>'.$row['time_slot'].' - '.ucwords($row['day']).'</td>
          <td>'.ucwords($row['semester']).'</td>
          <td>'.get_info("course_list",get_info("course_list",$row['course_id'],"prerequ_1"),"course_code").'</td>
          <td>'.get_info("course_list",get_info("course_list",$row['course_id'],"prerequ_2"),"course_code").'</td>
          <td>'.get_info("course_list",syllabus_info1("syllabus",$row['course_id'],1,"core_id"),"course_code").'</td>
      <td>'.get_info("course_list",syllabus_info2("syllabus",$row['course_id'],1,"optional_id"),"course_code").'</td>
          </tr>';


           }

          
          
        
        
$i++;
          $ind++;


          
         

        }
      } else {
        echo '<option value="null>No Course to Display</option>';
      }
    ?>
    </tbody>
  </table>
  <input type="hidden" name="s_id" id="s_id" value="<?php echo student_info($_SESSION['s_id'],'s_id'); ?>">
  <input type="hidden" name="semester" id="semester" value="<?php echo offer_semester_info("SELECT MAX(semester) FROM course_offer",'semester'); ?>">

  <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
</form>
<?php } ?>
</div>

<?php }else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>