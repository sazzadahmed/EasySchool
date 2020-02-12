<?php
	include('header.php');
	if(isset($_GET['action'])) {
		$action = protect($_GET['action']);
	}
?>
<?php if(is_admin_Loggedin()):?>

<?php if(isset($_GET['action']) and $action == 'details') {
	$id = (int)protect($_GET['id']);
  
	$query = $db->query("SELECT * FROM teacher_profile WHERE id=$id ");
  if ($query->num_rows > 0) {
    $row = $query->fetch_assoc();
  
?>

<div class="panel-heading">
  <h1 class="page-title">Details About <?php echo $row['name']; ?></h1>
</div>
<div class="panel-body">
    <div class="form-group">
      <label for="s_id" class="col-sm-4 control-label">Name</label>
      <div class="col-sm-5">
        <p><?php echo $row['name']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label for="s_name" class="col-sm-4 control-label">User Name</label>
      <div class="col-sm-5">
        <p><?php echo $row['username']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label for="s_mobile" class="col-sm-4 control-label">Permanent Addressr</label>
      <div class="col-sm-5">
        <p><?php echo $row['permanent_address']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label for="s_mobile" class="col-sm-4 control-label">Present Address</label>
      <div class="col-sm-5">
        <p><?php echo $row['present_address']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label for="s_email" class="col-sm-4 control-label">Email</label>
      <div class="col-sm-5">
        <p><?php echo $row['email']; ?></p>
      </div>
    </div>

    <div class="form-group">
      <label for="s_email" class="col-sm-4 control-label">Mobile Number</label>
      <div class="col-sm-5">
        <p><?php echo $row['mobile']; ?></p>
      </div>
    </div>
</div>

<?php
 }
 else  {
  ?>
  <h1>Wrong Input<h1>
  <?php
}
 }
else  {
  ?>
  <h1>Wrong Input<h1>
  <?php
}

?>


<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
	include('footer.php');
?>