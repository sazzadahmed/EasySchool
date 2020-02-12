<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>
<h1 class="page-header">Course Offering/Advising</h1>
<div class="table-responsive">
<?php

   $s_id = student_info($_SESSION['s_id'],'s_id');
  $semester_id = semester_info("SELECT MAX(semester) FROM course_offer",'id');
  //print $semester_id;
  //$year = student_info($_SESSION['s_id'],'cur_year');
  //that's why student profile will be update for every semester
  //track for student we should read current year current semester

  $check = $db->query("SELECT * FROM registration WHERE semester='$semester_id' and s_id='$s_id'");

  if($check->num_rows>0) { ?>
  <p> You've already submitted your course offer for this semester! </p>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Subject (Code)</th>
        <th>Teacher</th>
        <th>Time - Day</th>
        <th>Semester</th>
        <th>Prereq 1</th>
        <th>Prereq 2</th>
        
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
           </tr>';
        }
      
    ?>
    </tbody>
  </table>

<?php } else { ?>

<?php

  if (isset($_POST['submit'])) {

  if(count($_POST['course_offer_id'])!=0){
    reset($_POST['course_offer_id']);
  while (list($key, $val) = each($_POST['course_offer_id'])){

    if (isset($_POST['course_offer_id'])) {
       $course_offer_id = protect($val);
    }
    
    if (isset($_POST['s_id'])) {
       $s_id = protect($_POST['s_id']);
    }
   
    if (isset($_POST['semester'])) {
       $semester = protect($_POST['semester']);
    }
   

    if(empty($s_id) or empty($semester) or empty($course_offer_id)) {
      echo error("All fields are required.");
    } else if($check->num_rows>0) {
      echo error("Course Offer, on <b>$semester</b> was submitted.");
    } else {
      $insert = $db->query("INSERT into registration (s_id,cid,semester) VALUES ('$s_id','$course_offer_id','$semester_id')");
      if ($insert) {
        echo success("You have submitted your offer successfully.");
      }
    }
  }

}
}
?>

<form class="" id="" action="" method="post">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Select</th>
        <th>Subject (Code)</th>
        <th>Teacher</th>
        <th>Time - Day</th>
        <th>Semester - Year</th>
        <th>Prereq 1</th>
        <th>Prereq 2</th>
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
      //$semester = student_registration_semester();
    
      $query = $db->query("SELECT * FROM course_offer WHERE semester='$semester_id' ORDER BY id");
      



       if($query->num_rows>0) {

        $i=0;
         while($row = $query->fetch_assoc()) {
          //$code = get_info("course_list",$row['course_id'],"course_code");
          
         $query_pre= $db->query("SELECT * FROM result WHERE course_offer_id= ".get_info("course_list",$row['course_id'],"prerequ_1")." or course_offer_id=".get_info("course_list",$row['course_id'],"prerequ_2")." and s_id= '".$_SESSION['s_id']."'");

         $course_pre= $query_pre->fetch_assoc();

         //var_dump($course_pre);
         $marks= $course_pre['total'];
         //$id=  $course_pre['course_offer_id'];
         //var_dump($marks); 

         //$course_code_offer = $row['course_id'];

         $course_code_offer= $course_pre['course_offer_id'];

         $query_course= $db->query("SELECT * FROM course_list WHERE prerequ_1= ".get_info("course_list",$row['course_id'],"prerequ_1")." or prerequ_2=".get_info("course_list",$row['course_id'],"prerequ_2")." ");

         $course_list_id= $query_course->fetch_assoc();

         //dump_var($course_registration['id']);




         if($marks < 40 && $course_code_offer = $course_list_id['id']) {

        
          echo '<tr>
          <td><input type="checkbox" id="course_offer_id" name="course_offer_id[]" value="'.$row['course_id'].'" disabled></td>
          
           <td>'.get_info("course_list",$row['course_id'],"course_code").'</td>
          <td>'.get_info("teacher_profile",$row['teacher_id'],"name").'</td>
          <td>'.$row['time_slot'].' - '.ucwords($row['day']).'</td>
          <td>'.ucwords($row['semester']).'</td>
          <td>'.get_info("course_list",get_info("course_list",$row['course_id'],"prerequ_1"),"course_code").'</td>
          <td>'.get_info("course_list",get_info("course_list",$row['course_id'],"prerequ_2"),"course_code").'</td>
          </tr>
          ';

           }

           else {

          echo '<tr>
          <td><input type="checkbox" id="course_offer_id" name="course_offer_id[]" value="'.$row['course_id'].'" ></td>
          
          <td>'.get_info("course_list",$row['course_id'],"course_code").'</td>
          <td>'.get_info("teacher_profile",$row['teacher_id'],"name").'</td>
          <td>'.$row['time_slot'].' - '.ucwords($row['day']).'</td>
          <td>'.ucwords($row['semester']).'</td>
          <td>'.get_info("course_list",get_info("course_list",$row['course_id'],"prerequ_1"),"course_code").'</td>
          <td>'.get_info("course_list",get_info("course_list",$row['course_id'],"prerequ_2"),"course_code").'</td>
          ';


           }

          
          
        
        
$i++;

          
         

        }
      } else {
        echo '<option value="null>No Course to Display</option>';
      }
    ?>
    </tbody>
  </table>
  <input type="hidden" name="s_id" id="s_id" value="<?php echo student_info($_SESSION['s_id'],'s_id'); ?>">
  <input type="hidden" name="semester" id="semester" value="<?php echo student_registration_semester('semester'); ?>">
  <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
</form>
<?php } ?>
</div>

<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>