<?php
	include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
<?php
 if(isset($_POST['submit'])) {
  $id=$_POST['id'];
  $query = $db->query(" SELECT * FROM registration WHERE biller_number='$id'");
  if(!$id){
      echo '<div class="well"> <b>Input Biller Id</b></div>';
  
  }
  
  else if($query->num_rows==0){
    echo '<div class="well"> <b>'.$id.'  </b> Not found.</div>';
  }
  else{
      $insert = $db->query("update registration set status='1' where biller_number='$id'");
      echo success(" <b>$id  </b>  Clear.");
  }
 }
?>
<div class="container">
   <h2><b>Update Student Status</b></h2>
    <form action="" method="POST">
      <div class="form-group">
        <label for="mobile" class="col-sm-2 control-label">Biller ID</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="id" placeholder="Biller ID" >
        </div>
        <div class="col-sm-2">
          <input type="submit" class="form-control btn btn-primary" name="submit"  value="Clear">
        </div><br><br><br>
      </div>
  </form>
</div>

<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
	include('footer.php');
?>