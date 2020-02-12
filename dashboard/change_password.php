<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>
	<?php
	  if(isset($_POST['submit'])){
         $old_pass=protect(md5($_POST['old_pass']));
         $new_pass=protect(md5($_POST['new_pass']));
         $re_pass=protect(md5($_POST['re_pass']));
         $sid=student_info($_SESSION['s_id'],'s_id');
         $query = $db->query("SELECT * FROM student_profile where s_id='$sid' ");
           if($query->num_rows>0) {
		         while($row = $query->fetch_assoc()) {
                   $password=$row['password'];
		         }
		     }
		 if( $old_pass=="d41d8cd98f00b204e9800998ecf8427e"||$new_pass=="d41d8cd98f00b204e9800998ecf8427e"||$re_pass=="d41d8cd98f00b204e9800998ecf8427e"){
		 	echo'<h2 class="well "style="color:red">Please enter all input</h2>';
		 }
		 else if( $password!=$old_pass){
		 	echo'<h2 class="well "style="color:red">Password not match</h2>';
		 }
         else if($new_pass!=$re_pass){
            echo'<h2 class="well "style="color:red">Please check new password</h2>';
         }
         else {
         	$insert = $db->query("INSERT into student_profile (password) VALUES ('$new_pass') ");
          
          if($insert){
          	echo'<h2 class="well "style="color:green">You change your password successfully</h2>';
          }
      }
	  }
	?>
<div class="container-fluid">
   <h2>Change Password</h2>
   <form action="" method="POST">
   	  <div class="col-md-6 col-md-offset-3">
   	  	<div class="form-group row">
	      <label for="s_id" class="col-sm-4 control-label">Old Password</label>
	      <div class="col-sm-8">
	        <input type="password" class="form-control"  name="old_pass">
	      </div>
        </div><br>
        <div class="form-group row">
	      <label for="s_id" class="col-sm-4 control-label">New Password</label>
	      <div class="col-sm-8">
	        <input type="password" class="form-control"  name="new_pass">
	      </div>
        </div><br>
        <div class="form-group row">
	      <label for="s_id" class="col-sm-4 control-label">Confirm</label>
	      <div class="col-sm-8">
	        <input type="password" class="form-control"  name="re_pass">
	      </div>
        </div><br>
        <input type="submit" class="btn btn-primary" name="submit" value="Change Now"/>
   	  </div>

   </form>
</div>
<?php else:?>
<?php header('Location: signin.php'); //echo "Not Loggedin"; ?>
<?php endif?>
<?php
	include('footer.php');
?>