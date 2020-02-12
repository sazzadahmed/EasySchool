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
  $query = $db->query("SELECT * FROM hall WHERE id='$id'");
  if($query->num_rows==0) { header("Location: hall.php"); }
  $row = $query->fetch_assoc();
?>
<?php
      if(isset($_GET['confirm'])) {
        $delete = $db->query("DELETE FROM hall WHERE id='$row[id]'");
        echo success("Student, <b>$row[name] ($row[id]) </b> was deleted successfully.");
      } else {
        echo info("Are you sure you want to delete Hall, <b>$row[name] ($row[id])</b>?");
        echo '<a href="./hall.php?&action=delete&id='.$id.'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
          <a href="./hall.php" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
      }
 }
  if(isset($_POST['submit'])){
    $hname=$_POST['hname'];
  if($hname==""){
   echo success("Please input a hall name.");
  }
  else{
     $insert = $db->query("insert into hall(name)values('$hname')");
      echo success(" <b>$hname  </b> was Insert successfully.");
    }
  }
  $query = $db->query("SELECT * FROM hall");
?>
<h1 class="page-header">Manage Hall</h1>
<div class="container-fluid">
   <form action="" method="POST">
      <div class="form-group">
        <label for="mobile" class="col-sm-2 control-label">Hall Name</label>
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
            echo '<tr><td>'.$i.'</td><td>'.$row['name'].'</td> <td><a href="hall.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
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