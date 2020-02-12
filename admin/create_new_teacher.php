<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
<?php
  if (isset($_POST['create'])){
    $username = protect($_POST['username']);
    $name = protect($_POST['name']);
    $mobile = protect($_POST['mobile']);
    $email = protect($_POST['email']);
    $password = protect($_POST['password']);
    $status = protect($_POST['status']);
    $check ='';
    if($_GET['type']=='teacher'){
    $check = $db->query("SELECT * FROM teacher_profile WHERE username='$username' or email='$email'");
    }
    else{
        $check = $db->query("SELECT * FROM stuff_profile WHERE username='$username' or email='$email'");
 
    }
    if(empty($username) or empty($name) or empty($mobile) or empty($email) or empty($password)) {
      echo error("All fields are required.");
    } elseif($check->num_rows>0) {
      echo error("Teacher, <b>$name ($username) </b> was exists.");
    } else {
      $pass = md5($password);
      if($_GET['type']=='teacher'){
      $insert = $db->query("INSERT teacher_profile (username,name,mobile,email,password,status) VALUES ('$username','$name','$mobile','$email','$pass','status')");
     
      echo success("Teacher, <b>$name ($username) </b> was added successfully.");
      }
      else
      {
        $insert = $db->query("INSERT stuff_profile (username,name,mobile,email,password,status) VALUES ('$username','$name','$mobile','$email','$pass','status')");
     
        echo success("stuff, <b>$name ($username) </b> was added successfully.");
     
      }
    }
  }
?>

<div class="panel-heading">
<h1 class="page-title">Create 
<?php
        if($_GET['type'] == 'teacher') {
        ?>    
     Teacher
      <?php
        } else {
          ?>
          Stuff
          <?php
        }
      ?>
   Profile</h1>
</div>
<div class="panel-body">
  <form action="" method="post" class="form-horizontal">
    <div class="form-group">
      <label for="name" class="col-sm-4 control-label">Name</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-sm-4 control-label">Email</label>
      <div class="col-sm-5">
        <input type="email" class="form-control" id="email" name="email" placeholder=" Email">
      </div>
    </div>
    <div class="form-group">
      <label for="mobile" class="col-sm-4 control-label">Mobile</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="mobile" name="mobile" placeholder=" Mobile Number">
      </div>
    </div>
    <div class="form-group">
      <label for="username" class="col-sm-4 control-label">Username</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="col-sm-4 control-label">Password</label>
      <div class="col-sm-5">
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
      </div>
    </div>
    <div class="form-group">
      <label for="status" class="col-sm-4 control-label">
        <?php
        if($_GET['type'] == 'teacher') {
        ?>    
      Teachership
      <?php
        } else {
          ?>
          Stuff Ship
          <?php
        }
      ?>
    </label>
      <div class="col-sm-5">
          <select class="form-control" id="status" name="status">
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-5">
        <button type="submit" id="create" name="create" class="btn btn-primary btn-block">Save</button>
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