<?php
  include('header.php');
  if(isset($_GET['action'])) {
  $action = protect($_GET['action']);
}
?>
<?php if(is_admin_Loggedin()):?>
<?php
  if (isset($_POST['create'])){
    $amount = protect($_POST['amount']);
    $credit = protect($_POST['credit']);    
   
    
     $check = $db->query("SELECT * FROM amount where credit='$credit' ");
    if(empty($amount)  ) {
      echo error("All fields are required.");
    } 
    else if($check->num_rows>0) {
      echo error(" <b>This Credit </b> was exists.");
    } else {
      $insert = $db->query("INSERT amount (credit,amount) VALUES ('$credit','$amount')");
      echo success(" <b>$credit And $amount  </b> was added successfully.");
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
  $query = $db->query("delete FROM amount WHERE id='$id'");
 }
 if(isset($_GET['action']) and $action == 'edit') {
  echo $id = protect($_GET['id']);

?>
<div class="panel-body">
  <form class="form-horizontal" action="" method="post">
    
  </form>
</div>
<?php
  }
?>
<div class="panel-heading">
  <h1 class="page-title">Create New Amount</h1>
</div>
<div class="panel-body">
  <form class="form-horizontal" action="" method="post">
    <div class="row">

          <div class="form-group col-sm-6">
            <label for="credit" class=" control-label">Credit</label>
                <select class="form-control" i name="credit">
                  <option value="1">1</option>
                  <option value="1.5" >1.5</option>
                  <option value="3">3</option>
                  <option value="6">6</option>
                  <option value="9">9</option>
                </select>
          </div>

          <div class="form-group col-sm-6">
            <label for="prerequ_2" class=" control-label">Amount</label>
            
                <input type="number"class="form-control" name="amount"/>
            
          </div><br>
         
       <input type="submit"  name="create" class="col-sm-2 btn btn-primary " value="Create">
    </div>
  </form>
</div>

<div>
  <h1>All Amount List</h1>
  <table class="table" align="center">
     <tr>
       <th>Sl</th>
       <th>Credit</th>
       <th>Amount</th>
       <th>Action</th>
     </tr>
     <?php
     $i=1;
          $query = $db->query("SELECT * FROM amount ORDER BY `id` DESC");
          if($query->num_rows>0) {
            $msg="Are you sure to delete this id?";
            while($row = $query->fetch_assoc()) {
              echo'<tr><td>'.$i.'</td><td>'.$row['credit'].'</td><td>'.$row['amount'].'</td><td><a onclick="return confirm()" href="manage_amount.php?action=delete&id='.$row['id'].'">Delete</a></td></tr>';
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