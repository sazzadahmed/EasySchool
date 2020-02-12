<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>
<?php
  if(isset($_POST['update'])) {
    $id = student_info($_SESSION['s_id'],'s_id');
    //Student's info
    if(isset($_POST['s_id'])) {
     $s_id = protect($_POST['s_id']);
    }
    if(isset($_POST['s_name'])) {
      $s_name = protect($_POST['s_name']);
    }
    if(isset($_POST['nationality'])) {
    $nationality = protect($_POST['nationality']);
    }
    if(isset($_POST['s_nid'])) {
    $s_nid = protect($_POST['s_nid']);
    }
    if(isset($_POST['gender'])) {
     $gender = protect($_POST['gender']);
    }
    if(isset($_POST['present_address'])) {
    $present_address = protect($_POST['present_address']);
    }
    if(isset($_POST['permanent_address'])) {
    $permanent_address = protect($_POST['permanent_address']);
    }
    if(isset($_POST['s_mobile'])) {
    $s_mobile = protect($_POST['s_mobile']);
    }
    if(isset($_POST['s_email'])) {
    $s_email = protect($_POST['s_email']);
    }

    //father's info
    if(isset($_POST['f_name'])) {
      $f_name = protect($_POST['f_name']);
    }
    if(isset($_POST['f_mobile'])) {
      $f_mobile = protect($_POST['f_mobile']);
    }
    if(isset($_POST['f_nid'])) {
      $f_nid = protect($_POST['f_nid']);
    }

    //mother's info
    if(isset($_POST['m_name'])) {
      $m_name = protect($_POST['m_name']);
    }
    if(isset($_POST['m_mobile'])) {
      $m_mobile = protect($_POST['m_mobile']);
    }
    if(isset($_POST['m_nid'])) {
      $m_nid = protect($_POST['m_nid']);
    }

    //Guardian's info
    if(isset($_POST['g_name'])) {
      $g_name = protect($_POST['g_name']);
    }
    if(isset($_POST['g_mobile'])) {
      $g_mobile = protect($_POST['g_mobile']);
    }
    if(isset($_POST['g_nid'])) {
      $g_nid = protect($_POST['g_nid']);
    }
 
    //Educational  info
    $education_info_row_count = $_POST['education_info_row_count'];
    if(isset($_POST['job_exp'])) {
      $job_exp = protect($_POST['job_exp']);
    }
    if(isset($_POST['id'])) {
      $rows_id= $_POST['id'];
    }

$dname= $_POST['dname'];
$gname= $_POST['gname'];
$iname= $_POST['iname'];
$gpa= $_POST['gpa'];
$pyear= $_POST['pyear'];


foreach ($dname as $key => $dnames) {
$student_id = student_info($_SESSION['s_id'],'s_id');
$student_dname = $dname[$key];
$student_gname=$gname[$key];
$student_iname= $iname[$key];
$student_gpa= $gpa[$key];
$student_pyear= $pyear[$key];
if ($education_info_row_count >0) {
   echo $education_row_id= $rows_id[$key];
  if (empty($student_dname) && empty($student_gname) && empty($student_iname) && empty($student_gpa) && empty($student_pyear)) {
    $db->query("delete from education_info where id ='$education_row_id'");
  }
  else{
    $db->query("update education_info set degree_name='$student_dname',group_name='$student_gname',school_name='$student_iname',gpa='$student_gpa',pass_year='$student_pyear' where id='$education_row_id'");
  }
}
elseif (!empty($student_dname) || !empty($student_gname) || !empty($student_iname) || !empty($student_gpa) || !empty($student_pyear)) {
 $ins=$db->query("INSERT education_info(s_id,degree_name,group_name,school_name,gpa,pass_year) VALUES ('$id','$student_dname','$student_gname','$student_iname','$student_gpa','$student_pyear')");
}
$education_info_row_count--;
   }

save_pdf("file","upload/",$id);

    $update = $db->query("UPDATE student_profile SET f_name='$f_name', m_name='$m_name', g_name='$g_name', permanent_address='$permanent_address', present_address='$present_address', gender='$gender', s_nid='$s_nid', f_nid='$f_nid', m_nid='$m_nid', g_nid='$g_nid', f_mobile='$f_mobile', m_mobile='$m_mobile', g_mobile='$g_mobile',  experience='', nationality='$nationality',experience='$job_exp', form_submitted='1' WHERE s_id='$id'");
    if($update) echo success("Information Update successfully !!!.");
    else echo error("Information Is Not Update successfully...Pleaze Try Again !!!.");
  }
?>

<h1 class="page-header">Update Student Profile</h1>
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
<div class="col-sm-12">
  <h2><b>Personal Information:</b></h2>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="s_id" class="col-sm-4 control-label">ID</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="s_id" name="s_id" value="<?php echo student_info($_SESSION['s_id'],'s_id'); ?>" disabled>
      </div>
    </div>

    <div class="form-group">
      <label for="s_name" class="col-sm-4 control-label">Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="s_name" name="s_name" value="<?php echo student_info($_SESSION['s_id'],'s_name'); ?>" disabled>
      </div>
    </div>

    
    <div class="form-group">
      <label for="nationality" class="col-sm-4 control-label">Nationality</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nationality" value="<?php echo student_info($_SESSION['s_id'],'nationality'); ?>">
      </div>
    </div> 

     <div class="form-group">
      <label for="s_nid" class="col-sm-4 control-label">NID No.</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="s_nid" name="s_nid" placeholder="Student NID No." value="<?php echo student_info($_SESSION['s_id'],'s_nid'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="gender" class="col-sm-4 control-label">Gender</label>
      <div class="col-sm-8">
          <select class="form-control" id="gender" name="gender">
            <option value="male" <?php if(student_info($_SESSION['s_id'],'gender') == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if(student_info($_SESSION['s_id'],'gender') == 'female') echo 'selected'; ?>>Female</option>
          </select>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label for="present_address" class="col-sm-4 control-label">Present Address</label>
      <div class="col-sm-8">
        <textarea id="present_address" name="present_address" class="form-control" rows="3" placeholder="Present Address" value="<?php echo student_info($_SESSION['s_id'],'present_address'); ?>"><?php echo student_info($_SESSION['s_id'],'present_address'); ?></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="permanent_address" class="col-sm-4 control-label">Permanent Address</label>
      <div class="col-sm-8">
        <textarea id="permanent_address" name="permanent_address" class="form-control" rows="3" placeholder="Permanent Address" value="<?php echo student_info($_SESSION['s_id'],'permanent_address'); ?>"><?php echo student_info($_SESSION['s_id'],'permanent_address'); ?></textarea>
      </div>
    </div>

     <div class="form-group">
      <label for="s_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="s_mobile" name="s_mobile" placeholder="Student Mobile Number" value="<?php echo student_info($_SESSION['s_id'],'s_mobile'); ?>" disabled>
      </div>
    </div>
    <div class="form-group">
      <label for="s_email" class="col-sm-4 control-label">Email</label>
      <div class="col-sm-8">
        <input type="email" class="form-control" id="s_email" name="s_email" value="<?php echo student_info($_SESSION['s_id'],'s_email'); ?>" disabled>
      </div>
    </div>
  </div>
</div>

<div class="col-sm-12">
  <h2><b>Parents and Guardians Information:</b></h2>
  <div class="col-sm-6">
    <h4 style="color:red;"><b>Father's Info:</b></h4>
    <div class="form-group">
      <label for="f_name" class="col-sm-4 control-label">Father's Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Student Father Name" value="<?php echo student_info($_SESSION['s_id'],'f_name'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="f_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="f_mobile" name="f_mobile" placeholder="Student Father Mobile Number" value="<?php echo student_info($_SESSION['s_id'],'f_mobile'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="f_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="f_nid" name="f_nid" placeholder="Student Father's NID" value="<?php echo student_info($_SESSION['s_id'],'f_nid'); ?>">
      </div>
    </div>

    <h4 style="color:red;"><b>Guardian's Info:</b></h4>
    <div class="form-group">
      <label for="g_name" class="col-sm-4 control-label">Guirdian Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="g_name" name="g_name" placeholder="Student Guirdian Name" value="<?php echo student_info($_SESSION['s_id'],'g_name'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="g_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="g_mobile" name="g_mobile" placeholder="Student Guirdian Mobile Number" value="<?php echo student_info($_SESSION['s_id'],'g_mobile'); ?>">
      </div>
    </div>
    
    <div class="form-group">
      <label for="g_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="g_nid" name="g_nid" placeholder="Student Guirdian's NID" value="<?php echo student_info($_SESSION['s_id'],'g_nid'); ?>">
      </div>
    </div>
  </div>

  <div class="col-sm-6">
  <h4 style="color:red;"><b>Mother's Info:</b></h4>
    <div class="form-group">
      <label for="m_name" class="col-sm-4 control-label">Mother's Name</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="m_name" name="m_name" placeholder="Student Mother Name" value="<?php echo student_info($_SESSION['s_id'],'m_name'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="m_mobile" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="m_mobile" name="m_mobile" placeholder="Student Mother Mobile Number" value="<?php echo student_info($_SESSION['s_id'],'m_mobile'); ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="m_nid" class="col-sm-4 control-label">NID</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="m_nid" name="m_nid" placeholder="Student Mother's NID" value="<?php echo student_info($_SESSION['s_id'],'m_nid'); ?>">
      </div>
    </div>
  </div>
</div>


<div class="col-sm-12">
<h3> <b>Educational Information:</b></h3>
  <table id="dataTable">

<script type="text/javascript"> var count_row=0;</script>
<?php $Education_Infos=$db->query("select * from education_info where s_id='$_SESSION[s_id]'");
if($Education_Infos->num_rows>0) {

          while($Education_Infos_Row = $Education_Infos->fetch_assoc()) { ?>
            <script type="text/javascript">  count_row++;</script>
            <input type="hidden" name="id[]" value="<?php echo $Education_Infos_Row['id']; ?>">
           <TR>
    <div class="col-sm-2">
      <TD>
      <div class="form-group">
      <div class="col-sm-12"> 
      <input type="text" class="form-control" id="dname" name="dname[]" placeholder="Enter Degree Name" value="<?php echo $Education_Infos_Row['degree_name']; ?>">
      </div>
      </div>
      </TD>
    </div>


<div class="col-sm-2">
      <TD> 
      <div class="form-group">
       <div class="col-sm-12">
      <input type="text" class="form-control" id="gname" name="gname[]"  placeholder="Enter Group Name" value="<?php echo $Education_Infos_Row['group_name']; ?>">
      </div>
      </div>
      </TD>
   </div>


 <div class="col-sm-6">
      <TD> 
      <div class="form-group">
       <div class="col-sm-12">
        <input type="text" class="form-control" id="iname" name="iname[]" placeholder="Institution Name" value="<?php echo $Education_Infos_Row['school_name']; ?>">
      </div>
      </div>
      </TD>
 </div>


 <div class="col-sm-1">
      <TD> 
      <div class="form-group">
       <div class="col-sm-12">
      <input type="text" class="form-control" id="gpa" name="gpa[]"placeholder="Enter Gpa/ Division" value="<?php echo $Education_Infos_Row['gpa']; ?>">
      </div>
      </div>  
      </TD>
  </div>



<div class="col-sm-1">
      <TD> 
      <div class="form-group">
      <div class="col-sm-12">
      <input type="text" class="form-control" id="pyear" name="pyear[]" placeholder="Enter Passing Year" value="<?php echo $Education_Infos_Row['pass_year']; ?>">
      </div>
      </div>
      </TD>
   </div>



    </TR>
       <?php   }
        } 
 ?>

<input type="hidden" name="education_info_row_count" value="<?php echo $Education_Infos->num_rows; ?>">


    <TR>
    <div class="col-sm-2">
      <TD>
      <div class="form-group">
      <div class="col-sm-12"> 
      <input type="text" class="form-control" id="dname" name="dname[]" placeholder="Enter Degree Name">
      </div>
      </div>
      </TD>
    </div>


<div class="col-sm-2">
      <TD> 
      <div class="form-group">
       <div class="col-sm-12">
      <input type="text" class="form-control" id="gname" name="gname[]"  placeholder="Enter Group Name">
      </div>
      </div>
      </TD>
   </div>


 <div class="col-sm-6">
      <TD> 
      <div class="form-group">
       <div class="col-sm-12">
        <input type="text" class="form-control" id="iname" name="iname[]" placeholder="Institution Name">
      </div>
      </div>
      </TD>
 </div>


 <div class="col-sm-1">
      <TD> 
      <div class="form-group">
       <div class="col-sm-12">
      <input type="text" class="form-control" id="gpa" name="gpa[]"placeholder="Enter Gpa/ Division">
      </div>
      </div>  
      </TD>
  </div>



<div class="col-sm-1">
      <TD> 
      <div class="form-group">
      <div class="col-sm-12">
      <input type="text" class="form-control" id="pyear" name="pyear[]" placeholder="Enter Passing Year">
      </div>
      </div>
      </TD>
   </div>



    </TR>

  </table>
  <input type="button" value="Add New Row" onclick="addRow('dataTable')"/>


 </div>



<h2><b>Others Information:</b></h2>
  



<div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Job Experience Description</label>
    <div class="col-sm-5">
      <textarea class="form-control" rows="3" name="job_exp" placeholder="Job Experience Description"><?php echo student_info($_SESSION['s_id'],'experience'); ?></textarea>
    </div>
  </div>


 <div class="form-group">
    <label for="exampleInputFile" class="col-sm-4 control-label">Upload Your Academic Transcript</label>
     <div class="col-sm-5">
    <input type="file" id="exampleInputFile"  name="file">
    <p class="help-block">Only PDF file is allowed</p>
    </div>
  </div>



<div class="form-group">
    <div class="col-sm-offset-4 col-sm-5"><br/>
<br/>
      <button type="submit" name="update" id="update" class="btn btn-primary form-control">Update</button>
    </div>
  </div>
</form>



<SCRIPT language="javascript"> 
    function addRow(tableID) {
    var table = document.getElementById(tableID);
    var row = table.insertRow(count_row+1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    cell1.innerHTML = ' <div class="form-group"> <div class="col-sm-12"> <input type="text" class="form-control"  name="dname[]" placeholder="Enter Degree Name"> </div> </div> ';
    cell2.innerHTML = ' <div class="form-group"> <div class="col-sm-12"> <input type="text" class="form-control"  name="gname[]" placeholder="Enter Group Name"> </div> </div>';
    cell3.innerHTML = ' <div class="form-group"> <div class="col-sm-12"> <input type="text" class="form-control"  name="iname[]" placeholder="Institution Name"> </div> </div> ';
    cell4.innerHTML = ' <div class="form-group"> <div class="col-sm-12"> <input type="text" class="form-control" name="gpa[]"placeholder="Enter Gpa/ Division"> </div> </div>';
    cell5.innerHTML = ' <div class="form-group"> <div class="col-sm-12"> <input type="text" class="form-control" name="pyear[]" placeholder="Enter Passing Year"> </div> </div> ';
    
  /*var table = document.getElementById(tableID);

      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);

      var colCount = table.rows[0].cells.length;

      for(var i=0; i<colCount; i++) {
     
        var newcell = row.insertCell(i);

        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        //alert(newcell.childNodes);
        switch(newcell.childNodes[0].type) {
          case "text":
              newcell.childNodes[0].value = "";
              break;
          case "checkbox":
              newcell.childNodes[0].checked = false;
              break;
          case "select-one":
              newcell.childNodes[0].selectedIndex = 0;
              break;
        }
      }*/
    }

    function deleteRow(tableID) {
      try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;

      for(var i=0; i<rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if(null != chkbox && true == chkbox.checked) {
          if(rowCount <= 1) {
            alert("Cannot delete all the rows.");
            break;
          }
          table.deleteRow(i);
          rowCount--;
          i--;
        }


      }
      }catch(e) {
        alert(e);
      }
    }

  </SCRIPT>




<?php else:?>
<?php header('Location: signin.php'); ?>
<?php endif?>
<?php
include('footer.php');
?>