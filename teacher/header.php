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
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Department of English, Ju </title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <link href="../assets/css/src/teacher/main.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>
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
          <a class="navbar-brand" href="index.php">Department of English, JU</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class=""><a href="index.php">Home</a></li>
            <?php if(is_teacher_Loggedin()):?>
            <li><a href="course_offered.php">Course List</a></li>
            <!-- <li><a href="result.php">Marks Entry</a></li> -->
            <!-- <li><a href="print_result.php">Result</a></li> -->
            <li><a href="exam.php">Create Exam </a></li>
            <li><a href="exam_list.php">view Exam </a></li>
            <li><a href="prepare_result.php">Prepare Result</a></li>
            <li><a href="seat_plan.php">SeatPlan</a></li>
            <?php endif?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if(is_teacher_Loggedin()):?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo teacher_info($_SESSION['t_id'],'name'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class=""><a href="logout.php">Logout <span class="sr-only">(current)</span></a></li>
                <li></li>
              </ul>
            </li>
            <?php else:?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="signin.php">Teacher login</a></li>
                <li><a href="../signin.php">Student Login</a></li>
                <li><a href="../signin.php">Admin Login</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
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

            <!-- <li><a href="../notice.php">Notice Board</a></li>
            <li><a href="../events.php">Events</a></li> -->
            <!-- <li><a href="../about.php">About</a></li>
            <li><a href="../contact.php">Contact</a></li> -->
            <?php if(is_teacher_Loggedin()):?>
              <li><a href="course_offered.php">Course Offered</a></li>
            <li class=""><a href="logout.php">Logout<span class="sr-only">(current)</span></a></li>
            <?php else:?>
            <li><a href="signin.php">Teacher login</a></li>
            <li><a href="../signin.php">Student Login</a></li>
            <?php endif?>
          </ul>
          <!-- <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>-->
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">