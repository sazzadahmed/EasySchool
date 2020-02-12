<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
<?php
  if (isset($_POST['create'])){
    $course_code = protect($_POST['course_code']);
    $course_title = protect($_POST['course_title']);
    $description = protect($_POST['description']);
    $course_assign_class = protect($_POST['course_assign_class']);
    $optional_subject = protect($_POST['optional_subject']);
    $course_program = protect($_POST['course_program']);
   
    
    $check = $db->query("SELECT * FROM course_list WHERE course_code='$course_code'");

    if(empty($course_code) or empty($course_title) or empty($description) ) {
      echo error("All fields are required.");
    } elseif($check->num_rows>0) {
      echo error("Course, <b>$course_title ($course_code) </b> was exists.");
    } else {
      $insert = $db->query("INSERT course_list (course_code,course_title,description,course_assign_class,optional_subject,course_specificaton) VALUES ('$course_code','$course_title','$description','$course_assign_class','$optional_subject','$course_program')");
      echo success("Course, <b>$course_title ( $course_code) </b> was added successfully.");
    }
  }
?>
<div class="panel-heading">
  <h1 class="page-title">Create New Course</h1>
</div>
<div class="panel-body">
  <form class="form-horizontal" action="" method="post">
  <div class="form-group">
      <label for="course_code" class="col-sm-4 control-label">Course Code</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="course_code" name="course_code" placeholder="Enter Course Code">
      </div>
    </div>

    <div class="form-group">
      <label for="course_title" class="col-sm-4 control-label">Course Title</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="course_title" name="course_title" placeholder="Enter Course Title">
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="col-sm-4 control-label">Description</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Course Description">
      </div>
    </div>

  <div class="form-group">
      <label class="col-sm-4 control-label">Class</label>
      <div class="col-sm-5">
          <select class="form-control"  name="course_assign_class">
            <?php 
            $query = $db->query("SELECT * FROM classes");
            if($query->num_rows>0) {
              $i = 1;
              while($class_row = $query->fetch_assoc()) {
                echo '<option value="'.$class_row['class_name'].'">'.$class_row['class_name'].'</option>';
                $i++;
              }
            } else {
              echo '<option value="others">Others</option>';
            }?>
            
        </select>
      </div>
    </div>



    <div class="form-group">
      <label class="col-sm-4 control-label">Group</label>
      <div class="col-sm-5">
          <select class="form-control"  name="course_program">
        
            <?php 
            $query = $db->query("SELECT * FROM program");
            if($query->num_rows>0) {
              $i = 1;
              while($class_row = $query->fetch_assoc()) {
                echo '<option value="'.$class_row['id'].'">'.$class_row['program_name'].'</option>';
                $i++;
              }
            } else {
              echo '<option value="others">Others</option>';
            }?>
            
        </select>
      </div>
    </div>




    <div class="form-group">
      <label class="col-sm-4 control-label">Optional Subject</label>
      <div class="col-sm-5">
          <select class="form-control"  name="optional_subject">
           <option value="No"> No</option>
           <option value="Yes"> Yes</option>
        </select>
      </div>
    </div>
   
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-5">
        <button type="submit" id="create" name="create" class="btn btn-primary btn-block">Create</button>
      </div>
    </div>
  </form>
</div>

<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>