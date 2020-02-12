<?php
	include('header.php');
?>
<?php if(is_admin_Loggedin()):?>

<?php 
 if(isset($_GET['action'])) {
  $action = protect($_GET['action']);
}
if(isset($_GET['action']) && $action == 'delete') { 
   $id = protect($_GET['id']);
  $query = $db->query("SELECT * FROM program WHERE id='$id'");
  if($query->num_rows==0) { header("Location: hall.php"); }
  $row = $query->fetch_assoc();
?>
<?php
      if(isset($_GET['confirm'])) {
        $delete = $db->query("DELETE FROM program WHERE id='$row[id]'");
        echo success("Student, <b>$row[program_name] ($row[id]) </b> was deleted successfully.");
      } else {
        echo info("Are you sure you want to delete program, <b>$row[program_name] ($row[id])</b>?");
        echo '<a href="./program.php?&action=delete&id='.$id.'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
          <a href="./program.php" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
      }
 }
  if(isset($_POST['submit'])){
    $hname=$_POST['hname'];
    if($hname==""){
       echo success(" <b> Please input a program.  </b>.");
    }
    else{
     $insert = $db->query("insert into program(program_name)values('$hname')");
      echo success(" <b>$hname  </b> was Insert successfully.");
    }
  }
  $query = $db->query("SELECT * FROM program");
?>
<h1 class="page-header">Manage Program</h1>
<div class="container-fluid">
   <form action="" method="POST">
      <div class="form-group">
        <label for="mobile" class="col-sm-2 control-label">Program Name</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="mobile" name="hname" placeholder="Hall Name" >
        </div>
        <div class="col-sm-2">
          <input type="submit" class="form-control btn btn-primary" name="submit"  value="Create">
        </div><br><br><br>
      </div>
  </form>
   
   <table class="table">
      <tr>
        <th>Sl</th>
        <th>Hall Name</th>
        <th>Action</th>
      </tr>
   
   <?php
        if($query->num_rows>0) {
          $i = 1;
          while($row = $query->fetch_assoc()) {
            echo '<tr><td>'.$i.'</td><td>'.$row['program_name'].'</td> <td><a href="program.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
            $i++;
          }
        } else {
          echo '<tr><td>No Data to Display</td></tr>';
        }
      ?></table>
</div>

<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
	include('footer.php');
?>