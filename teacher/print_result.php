<?php
  include('header.php');
?>
<?php if(is_teacher_Loggedin()):?>
<h1 class="page-header">Semester Result</h1>
<div class="container">
  <form  method="post" action="semester_result.php" >
        <div class="row">
        <?php $t_id= $_SESSION['t_id']?>
         

          <div class="col-xs-8">
            <select class="form-control" id="sem_id" name="sem_name" onchange="getCourseList(this.value);">
              <option >Select Semester</option>
              <?php
                $query_sem = $db->query("SELECT semester.semester,semester.id FROM semester inner join `course_offer` on semester.id=course_offer.semester where course_offer.teacher_id='$t_id'group by course_offer.semester ORDER BY course_offer.id DESC ");
                if($query_sem->num_rows>0) {
                  while($row_sem = $query_sem->fetch_assoc()) {
                    echo '<option value="'.$row_sem["id"].'">'.$row_sem["semester"].'</option>';
                  }
                }
              ?>
            </select>
          </div>
         <div class="col-xs-2">
           <input type="submit" class="btn btn-primary" id="sub" name="semester" value="Show"></a>

        </div>
        </div>
</form>
</div>
<br>
<h1 class="page-header">Subject Result</h1>
<div class="container">
  <form  method="POST" action="semester_result.php" >
        <div class="row">
        <?php $t_id= $_SESSION['t_id']?>
         

          <div class="col-xs-4">
            <select class="form-control" id="sem_id" name="sem_id" onchange="getCourseList(this.value);">
              <option >Select Semester</option>
              <?php
                $query_sem = $db->query("SELECT semester.semester,semester.id FROM semester inner join `course_offer` on semester.id=course_offer.semester where course_offer.teacher_id='$t_id'group by course_offer.semester ORDER BY course_offer.id DESC ");
                if($query_sem->num_rows>0) {
                  while($row_sem = $query_sem->fetch_assoc()) {
                    echo '<option value="'.$row_sem["id"].'">'.$row_sem["semester"].'</option>';
                  }
                }
              ?>
            </select>
          </div>
          <div class="col-xs-4">
            <select class="form-control" id="" name="sub_id" >
              <option >Select Subject</option>
              <?php
                $query_sem = $db->query("SELECT * FROM course_list inner join course_offer on course_offer.course_id=course_list.id where course_offer.teacher_id='$t_id'  ");
                if($query_sem->num_rows>0) {
                  while($row_sem = $query_sem->fetch_assoc()) {
                    echo '<option value="'.$row_sem["course_id"].'">'.$row_sem["course_code"].'</option>';
                  }
                }
              ?>
            </select>
          </div>


        <div class="col-xs-2">

          <input type="submit" class="btn btn-primary" id="sub" name="grade_sheet" value="Show">

        </div>
        </div>
</form>
</div><br>
<h1 class="page-header">Student Result</h1>
<div class="container">
  <form  method="POST" action="semester_result.php" >
        <div class="row">
        <?php $t_id= $_SESSION['t_id']?>
         

          <div class="col-xs-4">
            <select class="form-control" id="sem_id" name="sem_name" onchange="getCourseList(this.value);">
              <option >Select Semester</option>
              <?php
                $query_sem = $db->query("SELECT semester.semester,semester.id FROM semester inner join `course_offer` on semester.id=course_offer.semester where course_offer.teacher_id='$t_id'group by course_offer.semester ORDER BY course_offer.id DESC ");
                if($query_sem->num_rows>0) {
                  while($row_sem = $query_sem->fetch_assoc()) {
                    echo '<option value="'.$row_sem["id"].'">'.$row_sem["semester"].'</option>';
                  }
                }
              ?>
            </select>
          </div>
          <div class="col-xs-4">
            
                 <input class="form-control"type="text" name="s_id" placeholder="Student ID">
            
          </div>


        <div class="col-xs-2">
           
          <input type="submit" class="btn btn-primary" id="sub" name="student"  value="Show">

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