<?php
	include('header.php');
	if(isset($_GET['action'])) {
		$action = protect($_GET['action']);
	}
?>
<?php if(is_admin_Loggedin()):?>

<?php if(isset($_GET['action']) and $action == 'edit') {
	$id = protect($_GET['id']);
	if (isset($_POST['save'])){
    $s_id = protect($_POST['s_id']);
    $s_name = protect($_POST['s_name']);
    $s_mobile = protect($_POST['s_mobile']);
    $studentship = protect($_POST['studentship']);
    $s_email = protect($_POST['s_email']);
    $date_of_birth = protect($_POST['date_of_birth']);
    $admission_class = protect($_POST['admission_class']);
    $a_sec = protect($_POST['a_sec']);
    $a_program = protect($_POST['a_program']);
    $reg_no = protect($_POST['reg_no']);
    $a_year = protect($_POST['a_year']);
    $board_exam_roll = protect($_POST['board_exam_roll']);

    $check = $db->query("SELECT * FROM student_profile WHERE s_id='$s_id'");
    if(empty($s_id) or empty($studentship) or empty($s_name) or empty($s_mobile) or empty($s_email) or empty($date_of_birth) or empty($reg_no)) {
	    	echo error("All fields are required.");
	  } elseif($check->num_rows>1) {
	  	echo error("Student, <b>$s_name ($s_id) </b> was exists.");
	  } else {
      $update = $db->query("UPDATE student_profile SET s_id='$s_id', s_name='$s_name', s_mobile='$s_mobile', studentship='$studentship', s_email='$s_email', date_of_birth='$date_of_birth',admission_class='$admission_class' ,a_sec='$a_sec',a_program='$a_program', reg_no='$reg_no',a_year='$a_year',board_exam_roll='$board_exam_roll' WHERE id='$id'");
      echo success("Student, <b>$s_name ($s_id) </b> was edited successfully.");
    }
  }

	$query = $db->query("SELECT * FROM student_profile WHERE id=$id ");
  if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();
  }
?>

<div class="panel-heading">
  <h1 class="page-title">Edit Student</h1>
</div>
<div class="panel-body">
  <form action="" method="POST" class="form-horizontal">
    <div class="form-group">
      <label for="s_id" class="col-sm-4 control-label">Student ID</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="s_id" name="s_id" placeholder="" value="<?php echo $row['s_id']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="s_name" class="col-sm-4 control-label">Student Name</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="s_name" name="s_name" placeholder="Student Name" value="<?php echo $row['s_name']; ?>">
      </div>
    </div>

     <div class="form-group">
      <label for="DOB" class="col-sm-4 control-label">Date Of Birth</label>
      <div class="col-sm-5">
        <input type="date" class="form-control" id="DOB" name="date_of_birth" placeholder="" value="<?php echo $row['date_of_birth']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="s_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="s_mobile" name="s_mobile" placeholder="Student Mobile Number" value="<?php echo $row['s_mobile']; ?>">
      </div>
    </div>
    
    
    <div class="form-group">
      <label for="s_email" class="col-sm-4 control-label">Email</label>
      <div class="col-sm-5">
        <input type="email" class="form-control" id="s_email" name="s_email" placeholder="Email" value="<?php echo $row['s_email']; ?>">
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-sm-4 control-label">Admission Class</label>
      <div class="col-sm-5">
          <select class="form-control"  name="admission_class">
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
      <label for="studentsihp" class="col-sm-4 control-label">Studentship</label>
      <div class="col-sm-5">
          <select class="form-control" id="studentship" name="studentship">
            <option value="1" <?php if($row['studentship'] == "1") { echo 'selected'; } ?>>Yes</option>
            <option value="0" <?php if($row['studentship'] == "0") { echo 'selected'; } ?>>No</option>
          </select>
      </div>
    </div>

     <div class="form-group">
      <label  class="col-sm-4 control-label">Admission Year</label>
      <div class="col-sm-5">
          <select class="form-control" name="a_year" id="a_year">
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
      <label for="admission_section" class="col-sm-4 control-label">Admission Section</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="admission_section" name="a_sec" placeholder="Admission Section" value="<?php echo $row['a_sec']; ?>">
      </div>
    </div>

      <div class="form-group">
      <label class="col-sm-4 control-label">Admission Program</label>
      <div class="col-sm-5">
          <select class="form-control" id="a_program" name="a_program">
            <?php 
            $query = $db->query("SELECT * FROM program");
            if($query->num_rows>0) {
              $i = 1;
              while($program_row = $query->fetch_assoc()) {
                echo '<option value="'.$program_row['program_name'].'">'.$program_row['program_name'].'</option>';
                $i++;
              }
            } else {
              echo '<option value="others">Others</option>';
            }?>
            
        </select>
      </div>
    </div>


    <div class="form-group">
      <label for="registration_number" class="col-sm-4 control-label">Registration Number</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="registration_number" name="reg_no" placeholder="Registration Number" value="<?php echo $row['reg_no']; ?>">
      </div>
    </div>
    
    <div class="form-group">
      <label  class="col-sm-4 control-label" for="board_exam_roll">Board Exam Roll</label>
      <div class="col-sm-5">
          <input class="form-control" type="number" name="board_exam_roll"  id="board_exam_roll" placeholder="Board Exam Roll" value="<?php echo $row['board_exam_roll']; ?>">
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-5">
        <button type="submit" id="save" name="save" class="btn btn-primary btn-block">Update</button>
      </div>
    </div>
  </form>
</div>

<?php }  //end edit student info

else if(isset($_GET['action']) and $action == 'search') {
  if (isset($_POST['type'])) {
    $type = protect($_POST['type']);
  }
  if (isset($_POST['key'])) {
    $key = protect($_POST['key']);
  }
  if ($type == 's_id') {
    $check = $db->query("SELECT * FROM student_profile WHERE s_id ='$key'");
  } else if ($type == 's_name') {
    $check = $db->query("SELECT * FROM student_profile WHERE s_name LIKE '%$key%'");
  } else if ($type == 's_mobile') {
    $check = $db->query("SELECT * FROM student_profile WHERE s_mobile ='$key'");
  } else {
    $check = $db->query("SELECT * FROM student_profile WHERE s_id ='$key'");
  }
?>
<h2 class="sub-header">Result of: <?php echo $key; ?></h2>
<form  method="post" action="?action=search" >
  <div class="row">
    <div class="col-xs-4">
      <select class="form-control" id="type" name="type">
        <option value="s_id" selected>ID</option>
        <option value="s_name">Name</option>
        <option value="s_mobile">Mobile</option>
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
        <th>#</th>
        <th>Exam Roll</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($check->num_rows>0) {
          $i = 1;
          while($row = $check->fetch_assoc()) {
            echo '<tr><td>'.$i.'</td><td>'.$row['s_id'].'</td><td>'.$row['s_name'].'</td><td>'.$row['s_email'].'</td><td><a href="student_list.php?action=edit&id='.$row['id'].'">Edit</a> | <a href="student_details.php?action=details&id='.$row['id'].'">Details</a></td></tr>';
            $i++;
          }
        } else {
          echo '<tr><td>No Student to Display</td></tr>';
        }
      ?>
    </tbody>
  </table>
</div>
<?php }//end search student info

 else { ?>
<h2 class="sub-header">All Student List</h2>


<form  method="post" action="?action=search" >
  <div class="row">
    <div class="col-xs-4">
      <select class="form-control" id="type" name="type">
        <option value="s_id" selected>ID</option>
        <option value="s_name">Name</option>
        <option value="s_mobile">Mobile</option>
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
        <th>#</th>
        <th>Exam Roll</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = $db->query("SELECT * FROM `student_profile` ORDER BY `student_profile`.`id` DESC");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
            echo '<tr><td>'.$row['id'].'</td><td>'.$row['s_id'].'</td><td>'.$row['s_name'].'</td><td>'.$row['s_email'].'</td><td><a href="student_list.php?action=edit&id='.$row['id'].'">Edit</a> | <a href="student_details.php?action=details&id='.$row['id'].'">Details</a></td></tr>';
          }
        } else {
          echo '<tr><td>No Student to Display</td></tr>';
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