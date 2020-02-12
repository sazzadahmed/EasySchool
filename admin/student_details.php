<?php
	include('header.php');
	if(isset($_GET['action'])) {
		$action = protect($_GET['action']);
	}
?>
<?php if(is_admin_Loggedin()):?>

<?php if(isset($_GET['action']) and $action == 'details') {
	$id = (int)protect($_GET['id']);
  
	$query = $db->query("SELECT * FROM student_profile WHERE id=$id ");
  if ($query->num_rows > 0) {
    $row = $query->fetch_assoc(); 
?>
<div class="row" align="center">
      <img src="../dashboard/image/<?php echo $row['s_id'] ?>.jpg" alt="Image is not found" name="image" width="200" height="200" border="2" id="image" />
  </div>
<div class="col-sm-12">
  <h2><b>Personal Information:</b></h2>
  <div class="col-sm-6">
    <div class="row">
      <label for="s_id" class="col-sm-4 control-label">ID</label>
      <div class="col-sm-8">
        <b>:</b><?php echo $sid=$row['s_id']; ?>
      </div>
    </div>
    <div class="row">
      <label for="s_name" class="col-sm-4 control-label">Name</label>
      <div class="col-sm-8">
        <?php echo $row['s_name']; ?>
      </div>
    </div>
    <div class="row">
      <label for="date_of_birth" class="col-sm-4 control-label">Date of Birth</label>
      <div class="col-sm-8">
        <?php echo $row['date_of_birth']; ?>
      </div>
    </div>
    <div class="row">
      <label for="nationality" class="col-sm-4 control-label">Nationality</label>
      <div class="col-sm-8">
        <?php echo $row['nationality']; ?>
      </div>
    </div>
    <div class="row">
      <label for="s_nid" class="col-sm-4 control-label">NID No.</label>
      <div class="col-sm-8">
        <?php echo $row['s_nid']; ?>
      </div>
    </div>
    <div class="row">
      <label for="gender" class="col-sm-4 control-label">Gender</label>
      <div class="col-sm-8">
          <?php echo $row['gender']; ?>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="row">
      <label for="present_address" class="col-sm-4 control-label">Present Address</label>
      <div class="col-sm-8">
        <?php echo $row['present_address']; ?>
      </div>
    </div>

    <div class="row">
      <label for="permanent_address" class="col-sm-4 control-label">Permanent Address</label>
      <div class="col-sm-8">
        <?php echo $row['permanent_address']; ?>
      </div>
    </div>

     <div class="row">
      <label for="s_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <?php echo $row['s_mobile']; ?>
      </div>
    </div>
    <div class="row">
      <label for="s_email" class="col-sm-4 control-label">Email</label>
      <div class="col-sm-8">
        <?php echo $row['s_email']; ?>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-12">
  <h2><b>Parents and Guardians Information:</b></h2>
  <div class="col-sm-6">
    <h4 style="color:red;"><b>Father's Info:</b></h4>
     <div class="row">
      <label for="f_name" class="col-sm-4 control-label">Father's Name</label>
      <div class="col-sm-8">
        <?php echo $row['f_name']; ?>
      </div>
    </div>
    <div class="row">
      <label for="f_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <?php echo $row['f_mobile']; ?>
      </div>
    </div>
    <div class="row">
      <label for="f_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8">
        <?php echo $row['f_nid']; ?>
      </div>
    </div>
    <h4 style="color:red;"><b>Guardian's Info:</b></h4>
    <div class="row">
      <label for="g_name" class="col-sm-4 control-label">Guirdian Name</label>
      <div class="col-sm-8">
        <?php echo $row['g_name']; ?>
      </div>
    </div>

    <div class="row">
      <label for="g_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <?php echo $row['g_mobile']; ?>
      </div>
    </div>
    
    <div class="row">
      <label for="g_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8 ">
        <?php echo $row['g_nid']; ?>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
  <h4 style="color:red;"><b>Mother's Info:</b></h4>
    <div class="row">
      <label for="m_name" class="col-sm-4 control-label">Mother's Name</label>
      <div class="col-sm-8 ">
        <?php echo $row['m_name']; ?>
      </div>
    </div>

    <div class="row">
      <label for="m_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8 ">
        
        <?php echo $row['m_mobile']; ?>
      </div>
    </div>

    <div class="row">
      <label for="m_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8 ">
        <?php echo $row['m_nid']; ?>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-12">
  <h2><b>Admission Details:</b></h2>
  <div class="col-sm-6">
    <div class="row">
      <label for="a_year" class="col-sm-5 control-label">Admission Year</label>
      <div class="col-sm-7">
          <?php  
              echo $row['a_year'];
            
          ?>
      </div>
    </div>

    <div class="row">
      <label for="a_sec" class="col-sm-5 control-label">Admission Section</label>
      <div class="col-sm-7">
        <p> <?php echo  $row['a_sec'] ;?></p>
        
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="row">
      <label for="a_program" class="col-sm-5 control-label">Admission Program</label>
      <div class="col-sm-7">
        <p><?php echo  $row['a_program'] ?></p>
      </div>
    </div>
    <div class="row">
      <label for="reg_no" class="col-sm-5 control-label">Registration No.</label>
      <div class="col-sm-7">
        <p><?php echo  $row['reg_no']; ?></p>
      </div>
    </div>
   
  </div>
</div>

<!--end Admission-->
<div class="col-sm-12">
  <h2><b>Job Experience:</b></h2>
  <p><?php echo $row['experience']; ?></p>
</div>

<div class="col-sm-12">
  <h2><b>Educational Information:</b></h2>
  <table class="table">
    <tr>
      <th>Degree</th>
      <th>Group</th>
      <th>Institution</th>
      <th>Gpa</th>
      <th>Year</th>
    </tr>
  <?php
   $query = $db->query("SELECT * FROM education_info WHERE s_id ='$sid'") or die();
   if($query->num_rows > 0) {
          while($row = $query->fetch_assoc()) { 
            echo '<tr><td>'.$row['degree_name'].'</td><td>'.$row['group_name'].'</td><td>'.$row['school_name'].'</td><td>'.$row['gpa'].'</td><td>'.$row['pass_year'].'</td></tr>';
  }
}
 ?>
</table>
</div>

<?php
 }
 else  {
  ?>
  <h1>Wrong Input<h1>
  <?php
}
 }
else  {
  ?>
  <h1>Wrong Input<h1>
  <?php
}

?>


<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
	include('footer.php');
?>