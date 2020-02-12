<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
<?php
  if (isset($_POST['create_sem'])){
    $sem_name = protect($_POST['sem_name']);
    $sem_year = protect($_POST['sem_year']);
    
    $check = $db->query("SELECT * FROM semester WHERE semester='$sem_name' and  year='$sem_year'");

    if(empty($sem_name) or empty($sem_year)) {
      echo error("All fields are required.");
    } elseif($check->num_rows>0) {
      echo error("Semester, <b>$sem_name - $sem_year</b> was exists.");
    } else {
      $insert = $db->query("INSERT semester (semester,year) VALUES ('$sem_name','$sem_year')");
      echo success("Semester, <b>$sem_name - $sem_year</b> was added successfully.");
    }
  }
?>
<div class="panel-heading">
  <h1 class="page-title">Create New Semester</h1>
</div>
<div class="panel-body">
  <form class="form-horizontal" action="" method="post">
  	<div class="form-group">
     	<label for="sem_name" class="col-sm-4 control-label">Credit</label>
      <div class="col-sm-5">
        <select class="form-control" id="sem_name" name="sem_name">
          <option value="Spring">Spring</option>
          <option value="Summer">Summer</option>
          <option value="Fall">Fall</option>
        </select>
      </div>
    </div>
  	<div class="form-group">
     	<label for="sem_year" class="col-sm-4 control-label">Credit</label>
      <div class="col-sm-5">
        <select class="form-control" id="sem_year" name="sem_year">
          <?php
            for($y=date("Y")-5; $y<date("Y")+5; $y++){
              if($y == date("Y")) {
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
      <div class="col-sm-offset-4 col-sm-5">
        <button type="submit" id="create_sem" name="create_sem" class="btn btn-primary btn-block">Create</button>
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