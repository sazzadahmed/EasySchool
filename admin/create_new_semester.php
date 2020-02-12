<?php
  include('header.php');
  if(isset($_GET['action'])) {
  $action = protect($_GET['action']);
}
?>
<?php if(is_admin_Loggedin()):?>
<?php
  if (isset($_POST['create'])){
    $semester = protect($_POST['semester']);
    $year = protect($_POST['year']);    
   
    $semester=$semester.'-'.$year;
     $check = $db->query("SELECT * FROM semester where semester='$semester'");
    if(empty($year)  ) {
      echo error("All fields are required.");
    } 
    else if($check->num_rows>0) {
      echo error(" <b>$semester  </b> was exists.");
    } else {
      $insert = $db->query("INSERT semester (semester) VALUES ('$semester')");
      echo success(" <b>$semester  </b> was added successfully.");
    }
  }
   if (isset($_POST['update'])){
    $semester = protect($_POST['semester']);
    $year = protect($_POST['year']);   
    $id = protect($_POST['id']);  
   
    $semester=$semester.'-'.$year;
     $check = $db->query("SELECT * FROM semester where semester='$semester'");
    if(empty($year)  ) {
      echo error("All fields are required.");
    } 
    else if($check->num_rows>0) {
      echo error(" <b>$semester  </b> was exists.");
    } else {
      $insert = $db->query("update semester set semester='$semester' where id='$id");
      echo success(" <b>$semester  </b> was Update successfully.");
    }
  }
  else if(isset($_GET['action']) and $action == 'delete') { 
  $id = protect($_GET['id']);
  $query = $db->query("delete FROM semester WHERE id='$id'");
?>

<?php }
 if(isset($_GET['action']) and $action == 'edit') {
  echo $id = protect($_GET['id']);

?>
<div class="panel-body">
  <form class="form-horizontal" action="" method="post">
    <input type="text" name="id" value="<?php $id;?>">
    <div class="row">

          <div class="form-group col-sm-6">
            <label for="credit" class=" control-label">Semester</label>
                <select class="form-control" i name="semester">
                  <option value="Fall" >Fall</option>
                  <option value="Spring" >Spring</option>
                  <option value="Summer">Summer</option>
                </select>
          </div>

          <div class="form-group col-sm-6">
            <label for="prerequ_2" class=" control-label">Year</label>
            
                <input type="number"class="form-control" name="year" value=""/>
            
          </div><br>
         
       <input type="submit"  name="update" class="col-sm-2 btn btn-primary " value="Update">
    </div>
  </form>
</div>
<?php
  }
?>
<div class="panel-heading">
  <h1 class="page-title">Create New Semester</h1>
</div>
<div class="panel-body">
  <form class="form-horizontal" action="" method="post">
    <div class="row">

          <div class="form-group col-sm-6">
            <label for="credit" class=" control-label">Semester</label>
                <select class="form-control" i name="semester">
                  <option value="Fall">Fall</option>
                  <option value="Spring" >Spring</option>
                  <option value="Summer">Summer</option>
                </select>
          </div>

          <div class="form-group col-sm-6">
            <label for="prerequ_2" class=" control-label">Year</label>
            
                <input type="number"class="form-control" name="year"/>
            
          </div><br>
         
       <input type="submit"  name="create" class="col-sm-2 btn btn-primary " value="Create">
    </div>
  </form>
</div>

<div>
  <h1>All Semester List</h1>
  <table class="table" align="center">
     <tr>
       <th>Sl</th>
       <th>Semeser</th>
       <th>Action</th>
     </tr>
     <?php
     $i=1;
          $query = $db->query("SELECT * FROM semester ORDER BY `id` DESC");
          if($query->num_rows>0) {
            $msg="Are you sure to delete this id?";
            while($row = $query->fetch_assoc()) {
              echo'<tr><td>'.$i.'</td><td>'.$row['semester'].'</td><td><a onclick="return confirm()" href="create_new_semester.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
            $i++;}
          } else {
            echo '<option value="null>No Semester to Display</option>';
          }
        ?>
  </table>
</div>

<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>