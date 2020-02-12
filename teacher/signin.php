<?php
  include('header.php');
  if(!isset($_SESSION['t_id'])){
    if (isset($_POST['login'])) {
      $username = protect($_POST['email']);
      $password = protect($_POST['password']);
      $pass = md5($password);
      $query = $db->query("SELECT * FROM teacher_profile WHERE ( email = '$username' and password = '$pass' and status = 1)");
      if ($query->num_rows > 0) {
        while($row = $query->fetch_assoc()) {
          //session_start();
          $_SESSION['t_id'] = $row['id'];
          header('Location: index.php');
          exit;
        }
      } else {
        alert_div_message('Your Username or password is incorrect or Your Account is not activated.','danger');
      }
    }
  } else {
    header('Location: index.php');
  }
?>

<h1 class="page-header">Sign In</h1>
<hr>
<form class="form-signin" action="" method="post">
  <h2 class="form-signin-heading">Please sign in</h2>
  <label for="email" class="sr-only">Email address</label>
  <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
  <label for="password" class="sr-only">Password</label>
  <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
  <div class="checkbox">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" id="login">Sign in</button>
</form>

<?php
  include('footer.php');
?>