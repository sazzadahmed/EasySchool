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
    $course_code = protect($_POST['course_code']);
    $course_title = protect($_POST['course_title']);
    $description = protect($_POST['description']);
    $course_assign_class = protect($_POST['course_assign_class']);
    $optional_subject = protect($_POST['optional_subject']);

    $check = $db->query("SELECT * FROM course_list WHERE course_code='$course_code'");
    if(empty($course_code) or empty($course_title) or empty($description) ) {
      echo error("All fields are required.");
    } elseif($check->num_rows>1) {
      echo error("Course, <b>$course_title ($course_code) </b> was exists.");
    } else {
      $update = $db->query("UPDATE course_list SET course_code='$course_code', course_title='$course_title', description='$description', course_assign_class='$course_assign_class', optional_subject='$optional_subject' WHERE id='$id'");
      echo success("Course, <b>$course_title ($course_code) </b> was edited successfully.");
    }
  }

  $query = $db->query("SELECT * FROM course_list WHERE id=$id ");
  if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();
  }
?>

<div class="panel-heading">
  <h1 class="page-title">Edit Course</h1>
</div>
<div class="panel-body">
  <form class="form-horizontal" action="" method="post">
  <div class="form-group">
      <label for="course_code" class="col-sm-4 control-label">Course Code</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="course_code" name="course_code" placeholder="Enter Course Code" value="<?php echo $row['course_code']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="course_title" class="col-sm-4 control-label">Course Title</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="course_title" name="course_title" placeholder="Enter Course Title" value="<?php echo $row['course_title']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="col-sm-4 control-label">Description</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Course Description" value="<?php echo $row['description']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="course_assign_class" class="col-sm-4 control-label">Class</label>
      <div class="col-sm-5">
          <select class="form-control" id="course_assign_class" name="course_assign_class">
            <option value="<?php echo $row['course_assign_class']; ?>"><?php echo $row['course_assign_class'];  ?></option>
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
      <label class="col-sm-4 control-label">Optional Subject</label>
      <div class="col-sm-5">
          <select class="form-control"  name="optional_subject">
           <option value="<?php echo $row['optional_subject']; ?>"> <?php echo $row['optional_subject']; ?></option>
           <option value="No"> No</option>
           <option value="Yes"> Yes</option>
        </select>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-5">
        <button type="submit" id="save" name="save" class="btn btn-primary btn-block">Save</button>
      </div>
    </div>
  </form>
</div>

<?php } else if(isset($_GET['action']) and $action == 'delete') { 
  $id = protect($_GET['id']);
  $query = $db->query("SELECT * FROM course_list WHERE id='$id'");
  if($query->num_rows==0) { header("Location: course_list.php"); }
  $row = $query->fetch_assoc();
?>
<h2 class="sub-header">Delete Course</h2>
<?php

  if(isset($_GET['confirm'])) {
    $delete = $db->query("DELETE FROM course_list WHERE id='$row[id]'");
    echo success("Course, <b>$row[course_title] ($row[course_code]) </b> was deleted successfully.");
  } else {
    echo info("Are you sure you want to delete Teacher, <b>$row[course_title] ($row[course_code]) </b>?");
    echo '<a href="./course_list.php?&action=delete&id='.$id.'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
      <a href="./course_list.php" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
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
  if ($type == 'course_code') {
    $check = $db->query("SELECT * FROM `course_list` where course_code='$key' ORDER BY `course_list`.`id` DESC");
  } else if ($type == 'course_title') {
    $check = $db->query("SELECT * FROM `course_list` where course_title LIKE '%$key%' ORDER BY `course_list`.`id` DESC");
  } 
?>
<h2 class="sub-header">All Course List</h2>
<form  method="post" action="?action=search" >
  <div class="row">
    <div class="col-xs-4">
      <select class="form-control" id="type" name="type">
        <option value="course_code" selected>Course Code</option>
        <option value="course_title">Course Title</option>
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
        <th>Course Code</th>
        <th>Course Title</th>
        <th>Class</th>
        <th>Optional</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        
        if($check->num_rows>0) {$i=1;
          while($row = $check->fetch_assoc()) {
            echo '<tr><td>'.$i.'</td><td>'.$row['course_code'].'</td><td>'.$row['course_title'].'</td><td>'.$row['course_assign_class'].'</td><td>'.$row['optional_subject'].'</td><td><a href="course_list.php?action=edit&id='.$row['id'].'">Edit</a> | <a href="course_list.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
        $i++;  }
        } else {
          echo '<tr><td>No Teacher to Display</td></tr>';
        }
      ?>
    </tbody>
  </table>
</div>
<?php
}else { ?>
<h2 class="sub-header">All Course List</h2>
<form  method="post" action="?action=search" >
  <div class="row">
    <div class="col-xs-4">
      <select class="form-control" id="type" name="type">
        <option value="course_code" selected>Course Code</option>
        <option value="course_title">Course Title</option>
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
        <th>Course Code</th>
        <th>Course Title</th>
        <th>Class</th>
        <th>Optional</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = $db->query("SELECT * FROM `course_list` ORDER BY `course_list`.`course_assign_class` DESC");
        if($query->num_rows>0) {$i=1;
          while($row = $query->fetch_assoc()) {
            echo '<tr><td>'.$i.'</td><td>'.$row['course_code'].'</td><td>'.$row['course_title'].'</td><td>'.$row['course_assign_class'].'<td>'.$row['optional_subject'].'</td><td><a href="course_list.php?action=edit&id='.$row['id'].'">Edit</a> | <a href="course_list.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
        $i++;  }
        } else {
          echo '<tr><td>No Teacher to Display</td></tr>';
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