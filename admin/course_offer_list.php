<?php
  include('header.php');
  if(isset($_GET['action'])) {
    $action = protect($_GET['action']);
  }
?>
<?php if(is_admin_Loggedin()):?>

<?php if(isset($_GET['action']) and $action == 'edit') {
  $id = protect($_GET['id']);
  $course_id='';
  if (isset($_POST['save'])){
    $year = protect($_POST['year']);
    $course_id = protect($_POST['course_id']);
    $teacher_id = protect($_POST['teacher_id']);
    $time_slot = protect($_POST['time_slot']);
    $day = protect($_POST['day']);
    $assign_class = protect($_POST['assign_class']);
    $section = protect($_POST['section']);
    $course_name = protect($_POST['course_name']);


    $check = $db->query("SELECT * FROM course_offer WHERE year='$year' and course_code='$course_id' and teacher_id='$teacher_id' and time_slot='$time_slot' and day='$day' and course_assign_class='$assign_class' and section='$section'");
    $check2 = $db->query("SELECT * FROM course_offer WHERE   year='$year' and teacher_id='$teacher_id' and time_slot='$time_slot' and day='$day'");

    if( empty($year) or empty($course_name) or empty($teacher_id) or empty($time_slot) or empty($day) or empty($section)) {
      echo error("All fields are required.");
    } elseif($check->num_rows>0) {
      echo error("Course Offer, on <b>$year ($day) </b> was exists.");
    } elseif($check2->num_rows>0) {
      echo error("Course Offer by <b>".teacher_info($teacher_id,"name")."</b>, on <b>$year  ($day) </b> Is Not Available .");
    } else {
      $update = $db->query("UPDATE course_offer SET year='$year', course_code='$course_id', teacher_id='$teacher_id', time_slot='$time_slot', day='$day',course_assign_class='$assign_class',section='$section',course_name='$course_name' WHERE id='$id'");
      if ($update) {
       echo success("Course Offer by <b>".teacher_info($teacher_id,"name")."</b>, on <b>$year  ($day) </b> was edited successfully.");
      }
      else{echo error("Course Offer by <b>".teacher_info($teacher_id,"name")."</b>, on <b>$year  ($day) </b> was not Update..Pleaze Try Again !!.");}
      
    }
  }

  $query = $db->query("SELECT * FROM course_offer WHERE id=$id ");
  if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();
  }
?>

<div class="panel-heading">
  <h1 class="page-title">Edit Course Offering/Advising</h1>
</div>
<div class="panel-body">
  <form class="form-horizontal" action="" method="post">

     <div class="form-group">
      <label  class="col-sm-4 control-label" for="year">Year</label>
      <div class="col-sm-5">
          <select class="form-control" name="year" id="year">
            <option  value="<?php echo $row['year']; ?>"><?php echo $row['year']; ?></option>
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
            <option value="<?php echo $row['course_assign_class']; ?>"><?php echo $row['course_assign_class']; ?></option>
            <?php 
            $ClassInfo = $db->query("SELECT * FROM classes");
            if($ClassInfo->num_rows>0) {
              $i = 1;
              while($ClassInfoRow = $ClassInfo->fetch_assoc()) {
                echo '<option value="'.$ClassInfoRow['class_name'].'">'.$ClassInfoRow['class_name'].'</option>';
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
          <option value="<?php echo $row['course_code']; ?>"><?php echo $row['course_code']; ?></option>
        </select>
    </div>
  </div>

  <div class="form-group">
    <label for="course_name" class="col-sm-4 control-label">Course Name</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" name="course_name" id="course_name"  placeholder="Course Name" value="<?php echo $row['course_name']; ?>" readonly >
    </div>
  </div>

  <div class="form-group">
    <label for="section" class="col-sm-4 control-label" >Section</label>
   <div class="col-sm-5">
        <select class="form-control" id="section" name="section">
          <option value="<?php echo $row['section']; ?>"><?php echo $row['section']; ?></option>
          <?php
        $SectionInfo = $db->query("SELECT * FROM section ORDER BY section_name");
        if($SectionInfo->num_rows>0) {
          while($SectionInfoRow = $SectionInfo->fetch_assoc()) {
            echo '<option value="'.$SectionInfoRow['section_name'].'">'.$SectionInfoRow['section_name'].'</option>';
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
        <option value="<?php echo $row['teacher_id'] ?>"><?php echo teacher_info($row['teacher_id'],'name'); ?></option>
      <?php
        $TeacherInfo = $db->query("SELECT * FROM teacher_profile ORDER BY id");
        if($TeacherInfo->num_rows>0) {
          while($TeacherInfoRow = $TeacherInfo->fetch_assoc()) {
            echo '<option value="'.$TeacherInfoRow['id'].'">'.$TeacherInfoRow['name'].'</option>';
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
      <input type="time" class="form-control" id="time_slot" name="time_slot" placeholder="Time Slot" value="<?php echo $row['time_slot']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="day" class="col-sm-4 control-label">Day</label>
    <div class="col-sm-5">
        <select class="form-control" id="day"  name="day">
          <option value="<?php echo $row['day'] ;?>"><?php echo $row['day'] ;?></option>
          <option value="sat">Sat</option>
          <option value="sun">Sun</option>
          <option value="mon">Mon</option>
          <option value="tue">Tue</option>
          <option value="wed">Wed</option>
          <option value="thu">Thu</option>
        </select>
      </div>
  </div>

  
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-5">
      <button type="submit" id="create" name="save" class="btn btn-primary btn-block">Update</button>
    </div>
  </div>
</form>
</div>

<?php } else if(isset($_GET['action']) and $action == 'delete') { 
  $id = protect($_GET['id']);
  $query = $db->query("SELECT * FROM course_offer WHERE id='$id'");
  if($query->num_rows==0) { header("Location: course_offer_list.php"); }
  $row = $query->fetch_assoc();
?>
<h2 class="sub-header">Delete Course Offering/Advising</h2>
<?php

  if(isset($_GET['confirm'])) {
    $delete = $db->query("DELETE FROM course_offer WHERE id='$row[id]'");
    echo success("Course Offer by <b>".teacher_info($row['teacher_id'],"name")."</b>, on <b> $row[year] (".day_name($row['day']).") </b> was deleted successfully.");
  } else {
    echo info("Are you sure you want to delete Course Offer by <b>".teacher_info($row['teacher_id'],"name")."</b>, on <b> (".day_name($row['day']).") </b>?");
    echo '<a href="./course_offer_list.php?&action=delete&id='.$id.'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
      <a href="./course_offer_list.php" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
  }
?>
<?php } 
else if(isset($_GET['action']) and $action == 'search') {
  if (isset($_POST['type'])) {
    $type = protect($_POST['type']);
  }
  if (isset($_POST['key'])) {
    $key = protect($_POST['key']);
  }
  if ($type == 'year') {
    $check = $db->query("SELECT * FROM course_offer WHERE year ='$key' ORDER BY `course_offer`.`year` DESC");
  } else if ($type == 'teacher_id') {
    $check = $db->query("SELECT * FROM course_offer INNER JOIN teacher_profile on course_offer.teacher_id=teacher_profile.id WHERE teacher_profile.name LIKE '%$key%' ORDER BY `course_offer`.`year` DESC");
  } 
?>
<h2 class="sub-header">Result of: <?php echo $key; ?></h2>
<form  method="post" action="?action=search" >
  <div class="row">
    <div class="col-xs-4">
      <select class="form-control" id="type" name="type">
        <option value="year">Year</option>
        <option value="teacher_id">Teacher</option>
      </select>
    </div>

    <div class="col-xs-4">
      <input type="text" class="form-control" id="key" name="key">
    </div>

    <div class="col-xs-2">

      <input type="submit" class="btn btn-primary" id="search" name="search" value="Search">
    </div>
  </div>
</form>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
       <th>#Sl</th>
        <th>Year</th>
        <th>Course Name</th>
        <th>Assign Class</th>
        <th>Teacher</th>
        <th>Time</th>
        <th>Day</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($check->num_rows>0) {
          $i = 1;
          while($row = $check->fetch_assoc()) {
           echo '<tr><td>'.$i.'</td><td>'.$row['year'].'</td><td>'.$row['course_name'].'</td><td>'.$row['course_assign_class'].'</td><td>'.teacher_info($row['teacher_id'],"name").'</td><td>'.$row['time_slot'].'</td><td>'.$row['day'].'</td><td><a href="course_offer_list.php?action=edit&id='.$row['id'].'">Edit</a> | <a href="course_offer_list.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
          $i++;
          }
        } else {
          echo '<tr><td>No Student to Display</td></tr>';
        }
      ?>
    </tbody>
  </table>
</div>
<?php }//search result end
else { ?>
<h2 class="sub-header">All Course Offering/Advising</h2>

<form  method="post" action="?action=search" >
  <div class="row">
    <div class="col-xs-4">
      <select class="form-control" id="type" name="type">
        <option value="year">Year</option>
        <option value="teacher_id">Teacher</option>
      </select>
    </div>

    <div class="col-xs-4">
      <input type="text" class="form-control" id="key" name="key">
    </div>

    <div class="col-xs-2">

      <input type="submit" class="btn btn-primary" id="search" name="search" value="Search">
    </div>
  </div>
</form>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
       <th>#Sl</th>
        <th>Year</th>
        <th>Course Name</th>
        <th>Assign Class</th>
        <th>Teacher</th>
        <th>Time</th>
        <th>Day</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = $db->query("SELECT * FROM `course_offer` ORDER BY `course_offer`.`year` DESC");
        if($query->num_rows>0) {$i=1;
          while($row = $query->fetch_assoc()) {
            echo '<tr><td>'.$i.'</td><td>'.$row['year'].'</td><td>'.$row['course_name'].'</td><td>'.$row['course_assign_class'].'</td><td>'.teacher_info($row['teacher_id'],"name").'</td><td>'.$row['time_slot'].'</td><td>'.$row['day'].'</td><td><a href="course_offer_list.php?action=edit&id='.$row['id'].'">Edit</a> | <a href="course_offer_list.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
          $i++;}
        } else {
          echo '<tr><td>No Course offer to Display</td></tr>';
        }
      ?>
    </tbody>
  </table>
</div>
<?php } ?>

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