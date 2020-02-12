<?php
  include('header.php');
?>
<?php if(is_teacher_Loggedin()):?>
  <br />
<h1 class="page-header">Result</h1>
<br />
<style type="text/css">
  .res_inp {
    width: 70px;
  }
</style>



<?php


if (isset($_POST['sub'])) {

        $sem= $_POST['sem_name'];
        $course_id= $_POST['course_name'];
        // only registered student come

        //echo $sem;
 
        $query = $db->query("SELECT sp.s_id, sp.s_name FROM student_profile as sp, registration as r where r.s_id=sp.s_id  and r.semester = '".$sem."' and r.cid='".$course_id."' ORDER BY sp.s_id");
        
        if($query->num_rows>0) {
          $ind=1;
          while($row = $query->fetch_assoc()) {

              $query2 = $db->query("INSERT INTO `result` (`id`, `s_id`, `semester`, `course_offer_id`) values(null,'".$row['s_id']."', '".$sem."', '".$course_id."') ");
                
             $ind++;
             echo $query2;
              }

              echo "Marks Set Up, <b>$course_id</b> was added successfully.";
            

            }
            else
            {

              echo "problm";
            }

          }



?>




<form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<div class="row">

 <div class="col-xs-4">
    <select class="form-control" id="sem_id" name="sem_name" onchange="getCourseList(this.value);">
      <option >Select Semester</option>
      <?php
        $query_sem = $db->query("SELECT * from semester");
        if($query_sem->num_rows>0) {
          while($row_sem = $query_sem->fetch_assoc()) {
            echo '<option value="'.$row_sem["id"].'">'.$row_sem["semester"].'</option>';
          }
        }
      ?>
    </select>
  </div>

  <div class="col-xs-4">
    <select class="form-control" id="course_id" name="course_name">
      <option value="" disabled selected>Select Course</option>
    </select>
  </div>


<div class="col-xs-2">

  <input type="submit" class="btn btn-primary" id="sub" name="sub" value="Submit">

</div>
</div>
</form>















<?php else:?>
<?php header('Location: signin.php'); ?>
<?php endif?>
<?php
  include('footer.php');
?>