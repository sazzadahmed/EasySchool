<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>


<div class="row">
  <div class="col-sm-9"><h1 class="page-header">Student Full Information(CV)</h1></div>
  <div class="col-sm-2">
    <form method="post" action="FPDF/methods_call.php">
      <input type="hidden" name="Student_id" value=" <?php echo student_info($_SESSION['s_id'],'s_id'); ?>">
      <input type="submit" name="Download_cv" class="form-control btn-primary" value="Download CV">
    </form>
  </div>
</div>
  <div class="row" align="center">
      <img src="image/<?php echo student_info($_SESSION['s_id'],'s_id') ?>.jpg" alt="Image is not found" name="image" width="200" height="200" border="2" id="image" />
  </div>
<div class="col-sm-12">
  <h2><b>Personal Information:</b></h2>
  <div class="col-sm-6">
    <div class="row">
      <label for="s_id" class="col-sm-4 control-label">ID</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'s_id'); ?>
      </div>
    </div>
    <div class="row">
      <label for="s_name" class="col-sm-4 control-label">Name</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'s_name'); ?>
      </div>
    </div>
    <div class="row">
      <label for="date_of_birth" class="col-sm-4 control-label">Date of Birth</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'date_of_birth'); ?>
      </div>
    </div>
    <div class="row">
      <label for="nationality" class="col-sm-4 control-label">Nationality</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'nationality'); ?>
      </div>
    </div>
    <div class="row">
      <label for="s_nid" class="col-sm-4 control-label">NID No.</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'s_nid'); ?>
      </div>
    </div>
    <div class="row">
      <label for="gender" class="col-sm-4 control-label">Gender</label>
      <div class="col-sm-8">
          <?php echo student_info($_SESSION['s_id'],'gender'); ?>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="row">
      <label for="present_address" class="col-sm-4 control-label">Present Address</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'present_address'); ?>
      </div>
    </div>

    <div class="row">
      <label for="permanent_address" class="col-sm-4 control-label">Permanent Address</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'permanent_address'); ?>
      </div>
    </div>

     <div class="row">
      <label for="s_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'s_mobile'); ?>
      </div>
    </div>
    <div class="row">
      <label for="s_email" class="col-sm-4 control-label">Email</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'s_email'); ?>
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
        <?php echo student_info($_SESSION['s_id'],'f_name'); ?>
      </div>
    </div>
    <div class="row">
      <label for="f_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'f_mobile'); ?>
      </div>
    </div>
    <div class="row">
      <label for="f_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'f_nid'); ?>
      </div>
    </div>
    <h4 style="color:red;"><b>Guardian's Info:</b></h4>
    <div class="row">
      <label for="g_name" class="col-sm-4 control-label">Guirdian Name</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'g_name'); ?>
      </div>
    </div>

    <div class="row">
      <label for="g_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <?php echo student_info($_SESSION['s_id'],'g_mobile'); ?>
      </div>
    </div>
    
    <div class="row">
      <label for="g_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8 ">
        <?php echo student_info($_SESSION['s_id'],'g_nid'); ?>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
  <h4 style="color:red;"><b>Mother's Info:</b></h4>
    <div class="row">
      <label for="m_name" class="col-sm-4 control-label">Mother's Name</label>
      <div class="col-sm-8 ">
        <?php echo student_info($_SESSION['s_id'],'m_name'); ?>
      </div>
    </div>

    <div class="row">
      <label for="m_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8 ">
        
        <?php echo student_info($_SESSION['s_id'],'m_mobile'); ?>
      </div>
    </div>

    <div class="row">
      <label for="m_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8 ">
        <?php echo student_info($_SESSION['s_id'],'m_nid'); ?>
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
              echo student_info($_SESSION['s_id'],'a_year');
            
          ?>
      </div>
    </div>
    <div class="row">
      <label for="a_sem" class="col-sm-5 control-label">Admission Class</label>
      <div class="col-sm-7">
           <p><?php echo student_info($_SESSION['s_id'],'admission_class' );?></p>
        
      </div>
    </div>
    <div class="row">
      <label for="a_sec" class="col-sm-5 control-label">Admission Section</label>
      <div class="col-sm-7">
        <p> <?php echo student_info($_SESSION['s_id'],'a_sec') ;?></p>
        
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="row">
      <label for="a_program" class="col-sm-5 control-label">Admission Program</label>
      <div class="col-sm-7">
        <p><?php echo student_info($_SESSION['s_id'],'a_program') ?></p>
      </div>
    </div>
    <div class="row">
      <label for="reg_no" class="col-sm-5 control-label">Registration No.</label>
      <div class="col-sm-7">
        <p><?php echo student_info($_SESSION['s_id'],'reg_no'); ?></p>
      </div>
    </div>
   
  </div>
</div>
<!--end Admission-->
<div class="col-sm-12">
<?php
   $id=student_info($_SESSION['s_id'],'s_id');
  $query = $db->query("SELECT * FROM education_info WHERE s_id ='$id'");
  ?>
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
   if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) { 
            echo '<tr><td>'.$row['degree_name'].'</td><td>'.$row['group_name'].'</td><td>'.$row['school_name'].'</td><td>'.$row['gpa'].'</td><td>'.$row['pass_year'].'</td></tr>';
  }
}
 ?>
</table>
</div>
<div class="col-sm-12">
  <h2><b>Academic Transcript:</b></h2>
  <p><a href="upload/<?php echo student_info($_SESSION['s_id'],'s_id') ?>.pdf" >Download Academic Transcript</a></p>
</div>
<!--Educational Information-->
<div class="col-sm-12">
  <h2><b>Job Experience:</b></h2>
  <p><?php echo student_info($_SESSION['s_id'],'experience'); ?></p>
</div>



<?php else:?>
<?php header('Location: signin.php'); ?>
<?php endif?>
<?php
include('footer.php');
?>