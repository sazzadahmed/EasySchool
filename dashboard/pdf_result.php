<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>
<h1 class="page-header">Result</h1>
<div class="container">
  <form  method="POST" action="print_result.php" >
        <div class="row">
         

          <div class="col-xs-4">
            <select class="form-control" id="sem_id" name="sem_name" ">
              <option >Select Semester</option>
              <?php
                $query_sem = $db->query("SELECT * FROM `semester` ORDER BY `id` DESC");
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
<br />
<br />


<?php else:?>
<?php header('Location: signin.php'); //echo "Not Loggedin"; ?>
<?php endif?>
<?php
	include('footer.php');
?>