<?php
  ob_start();
  session_start();
  include('../includes/connect.php');
  include('../includes/function.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Al-Amin Firdows">
    <meta name="author_uri" content="http://alamin.me/">
    <link rel="icon" href="favicon.ico">

    <title>Department of English, Ju</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/students_panel.js"></script>
    <script src="../assets/js/src/teacher/main.js"></script>


    <link href="../assets/css/carousel.css" rel="stylesheet">
    <link href="../assets/css/signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">College of Finance and Management</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav"><?php if(is_student_Loggedin()):?>
            <li class=""><a href="index.php"><?php echo student_info($_SESSION['s_id'],'s_name'); ?></a></li>
            <li class=""><a href="index.php"><?php echo student_info($_SESSION['s_id'],'a_program'); ?></a></li>
            <?php if(is_student_Loggedin()):?>
            <?php endif?>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo student_info($_SESSION['s_id'],'s_name'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class=""><a href="logout.php">Logout <span class="sr-only">(current)</span></a></li>
                <li></li>
              </ul>
            </li>
            <?php else:?>
            <li class=""><a href="signin.php">Login<span class="sr-only">(current)</span></a></li>
            <?php endif?>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="index.php">Home</a></li>
            <?php if(is_student_Loggedin()):?>
            <li><a href="update_profile.php">Profile</a></li>
            <li><a href="cv.php">Full CV</a></li>
            <li><a href="course_offered.php">Offered Course</a></li>
            <?php endif?>
            <li><a href="result.php">Result</a></li>
            <li><a href="individual_result.php">Check Result</a></li>  
             <li><a href="change_password.php">Change Password</a></li>
             <li><a href="show_attendance.php">Attendance</a></li>
            <?php if(is_student_Loggedin()):?>
            <li><a href="logout.php">Logout</a></li>
            <?php else:?>
            <li><a href="signin.php">Login</a></li>
            <?php endif?>
          </ul>
          <!-- <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>-->
        </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">