<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
<?php
  if (isset($_POST['create'])){
    $year = protect($_POST['year']);
    $course_assign_class = protect($_POST['assign_class']);
    $course_code = protect($_POST['course_id']);
    $course_name = protect($_POST['subject_name']);
    $section = protect($_POST['section']);
    $teacher_id = protect($_POST['teacher_id']);
    $time_slot = protect($_POST['time_slot']);
    $time_slot_hour =str_split($time_slot); 
    $time_slot_end =  $time_slot+1;
    $time_slot_end =  $time_slot_end.$time_slot_hour[2].$time_slot_hour[3].$time_slot_hour[4]; 
    $day = protect($_POST['day']);

 $check = $db->query("SELECT * FROM course_offer WHERE  year='$year' and course_code='$course_code' and day='$day' and section='$section' ");
 $check2 = $db->query("SELECT * FROM course_offer WHERE  year='$year' and teacher_id='$teacher_id' and day='$day' and (time_slot <= '$time_slot' and time_slot_end > '$time_slot')");

if(empty($year) or empty($course_name) or empty($teacher_id) or empty($time_slot) or empty($day)) {
      echo error("All fields are required.");
    } elseif($check->num_rows>0) {
      echo error("Course Offer, on <b>$year  ($day), Class: $course_assign_class, Section : $section, Course Code : $course_code  </b> was exists.");
    } elseif($check2->num_rows>0) {
      echo error("Course Offer by <b>".teacher_info($teacher_id,"name")."</b>, on <b>$year ($day),Time Slot '$time_slot' to '$time_slot_end' </b> was Not Avilable.");
    } else {
      $insert = $db->query("INSERT course_offer (year,course_assign_class,course_code,course_name,teacher_id,time_slot,time_slot_end,day,section) VALUES ('$year','$course_assign_class','$course_code','$course_name','$teacher_id','$time_slot','$time_slot_end','$day','$section')");
      echo success("Course Offer, on <b>$year ($day) </b> was added successfully.");
    }
  }
?>

<h1 class="page-header">Create New Course Offering/Advising</h1>
<form class="form-horizontal" action="" method="post">

     <div class="form-group">
      <label  class="col-sm-4 control-label" for="year">Year</label>
      <div class="col-sm-5">
          <select class="form-control" name="year" id="year">
          <?php
            for($y=date("Y")-5; $y<date("Y")+5; $y++){
              if($y == student_info($_SESSION['s_id'],'a_year')) {
                  $selected = "selected";
                } else {
                  $selected = "";
                }
              echo '<option value="'.$y.'"'.$selected.'>'.$y.'</option>';
            }
          ?>
        </select>
      </div>
    </div>
    
     <div class="form-group">
      <label class="col-sm-4 control-label">Assign Class</label>
      <div class="col-sm-5">
          <select class="form-control"  name="assign_class" onchange="courseid()" id="assign_class">
            <option value="">---------</option>
            <?php 
            $query = $db->query("SELECT * FROM classes");
            if($query->num_rows>0) {
              $i = 1;
              while($row = $query->fetch_assoc()) {
                echo '<option value="'.$row['class_name'].'">'.$row['class_name'].'</option>';
                $i++;
              }
            } else {
              echo '<option value="others">Others</option>';
            }?>
            
        </select>
      </div>
    </div>

  <?php $a=$db->query("SELECT * FROM course_list");
  foreach ($a as $key => $value) {
     $bb[$key]=$value;
  }
   $course_info= json_encode($bb);
    ?>

  <div class="form-group">
    <label for="course_id" class="col-sm-4 control-label"  >Course Code</label>
    <div class="col-sm-5">
        <select class="form-control" id="course_id" name="course_id" onchange="Course_Name(this)">
          <option value="">---------</option>
        </select>
    </div>
  </div>

  <div class="form-group">
    <label for="course_name" class="col-sm-4 control-label">Course Name</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" name="subject_name" id="course_name"  placeholder="Course Name" value="" readonly >
    </div>
  </div>

  <div class="form-group">
    <label for="section" class="col-sm-4 control-label" >Section</label>
   <div class="col-sm-5">
        <select class="form-control" id="section" name="section">
          <?php
        $query = $db->query("SELECT * FROM section ORDER BY section_name");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
            echo '<option value="'.$row['section_name'].'">'.$row['section_name'].'</option>';
          }
        } else {
          echo '<option value="null">No Section to Display</option>';
        }
      ?>

        </select>
    </div>
  </div>
  
  <div class="form-group">
  <label for="teacher_id" class="col-sm-4 control-label">Teacher's Name</label>
  <div class="col-sm-5">
      <select class="form-control" id="teacher_id" name="teacher_id">
      <?php
        $query = $db->query("SELECT * FROM teacher_profile ORDER BY id");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
          }
        } else {
          echo '<option value="null">No Teacher to Display</option>';
        }
      ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="time_slot" class="col-sm-4 control-label">Time Slot</label>
    <div class="col-sm-5">
      <input type="time" class="form-control" id="time_slot" name="time_slot" placeholder="Time Slot">
    </div>
  </div>

  <div class="form-group">
    <label for="day" class="col-sm-4 control-label">Day</label>
    <div class="col-sm-5">
        <select class="form-control" id="day"  name="day">
          <?php $days_name=Display_day_name();
           while ($day_name=$days_name->fetch_assoc()) {
            echo '<option value="'.$day_name['day_name'].'">'.$day_name['day_name'].'</option>';
           }
           ?>
        </select>
      </div>
  </div>

  
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-5">
      <button type="submit" id="create" name="create" class="btn btn-primary btn-block">Save</button>
    </div>
  </div>
</form>

<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>

 <script type="text/javascript">
    var course_ids=[];
     course_ids=<?php echo $course_info; ?>;
     function  courseid() {
      var option;
      var value = document.getElementById("assign_class").value;
     var select= document.getElementById('course_id');
     document.getElementById("course_name").value='';
     var len=select.options.length; 
     while (select.options.length > 0) { 
      select.remove(0); 
       }
        var newOption,count=1; 
 // create new options 
 for (var i=0; i<course_ids.length; i++) { 
  if (course_ids[i]['course_assign_class'] == value) {
    if (count) { document.getElementById("course_name").value = course_ids[i]['course_title']; count--;}
 newOption = document.createElement("option"); 
 newOption.value = course_ids[i]['course_code'];  // assumes option string and value are the same 
 newOption.text=course_ids[i]['course_code']; 
  
 // add the new option 
 try { 
 select.add(newOption);  // this will fail in DOM browsers but is needed for IE 
 } 
 catch (e) { 
 select.appendChild(newOption); 
 } 
 } 
    }
     }

  function Course_Name(coursecodevalue){
     var course_code_value=coursecodevalue.value;
    document.getElementById("course_name").value='';
      for (var i=0; i<course_ids.length; i++) { 
  if (course_ids[i]['course_code'] == course_code_value) {
  document.getElementById("course_name").value = course_ids[i]['course_title']; 

 } 
    }
     }
   </script>