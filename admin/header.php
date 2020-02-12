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

    <title>College of Finance and Management</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">

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
          <a class="navbar-brand" href="index.php">College of Finance and Management</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
           <li class=""><a href="index.php">Home</a></li>
           <?php if(is_admin_Loggedin()):?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Student management<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="create_new_student.php">Create New Student</a></li>
                <li><a href="student_list.php">All Student List</a></li>
                
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Teacher management<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="create_new_teacher.php?type=teacher">Create New Teacher</a></li>
                <li><a href="teacher_list.php?type=teacher">All Teacher List</a></li>
                <li><a href="create_new_teacher.php?type=stuff">Create New Stuff</a></li>
                <li><a href="teacher_list.php?type=stuff">All Stuff List</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Course management<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="create_new_course.php">Create New Course</a></li>
                <li><a href="course_list.php">All Course List</a></li>
                <li><a href="create_course_offer.php">Assign Course To Teacher</a></li>
                <li><a href="course_offer_list.php">All Course Assign List</a></li>
              </ul>
            </li>


            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage<span class="caret"></span></a>
              <ul class="dropdown-menu">
                    
                <li><a href="create_new_semester.php"> Semester</a></li>
                <li><a href="manage_amount.php"> Amount</a></li>
                <li><a href="manage_salary.php?type=studenet">Student Salary</a></li>
                <li><a href="check_salary_status.php">Check Student Salary</a></li>
                <li><a href="manage_salary.php?type=stuff">Stuff Salary</a></li>
                <li><a href="other_salary.php">Other Cost</a></li>
                <li><a href="check_stuff_salary_status.php?type=teacher">Check Teacher Salary</a></li>
                <li><a href="check_stuff_salary_status.php?type=stuff">Check Stuff Salary</a></li>
                <li><a href="exam.php">Create Exam</a></li>
                <li><a href="exam_list.php">View Exam</a></li>
                <li><a href="change_semester.php">Change Active Semester</a></li>
                <li><a href="create_or_update_room.php">Create Room</a></li>
                <li><a href="view_room.php">View Room</a></li>
              </ul>
            </li>
            <?php else:?>
            <!-- <li><a href="../about.php">About</a></li>
            <li><a href="../contact.php">Contact</a></li> -->
            <?php endif?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if(is_admin_Loggedin()):?>
              <li class=""><a href="logout.php">Logout<span class="sr-only">(current)</span></a></li>
            <?php else:?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="signin.php">Admin Login</a></li>
                <li><a href="../teacher/signin.php">Teacher login</a></li>
                <li><a href="../signin.php">Student Login</a></li>
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
            <?php if(is_admin_Loggedin()):?>
            <li><a href="create_new_student.php">Create New Student</a></li>
            <li><a href="student_list.php">All Student List</a></li>
            <li><a href="create_new_teacher.php">Create New Teacher</a></li>
            <li><a href="teacher_list.php">All Teacher List</a></li>
            <li><a href="create_new_course.php">Create New Course</a></li>
            <li><a href="course_list.php">All Course List</a></li>
             <li><a href="create_course_offer.php">Assign Course To Teacher</a></li>
             <li><a href="course_offer_list.php">All Course Assign List</a></li>
            <li><a href="status.php">Update Status</a></li>
            <li><a href="hall.php">Manage Hall</a></li>
            <li><a href="program.php">Manage Program</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php else:?>
            <!-- <li><a href="../about.php">About</a></li>
            <li><a href="../contact.php">Contact</a></li> -->
            <li><a href="../signin.php">Student Login</a></li>
            <li><a href="../teacher/signin.php">Teacher login</a></li>
            <li><a href="signin.php">Admin Login</a></li>
            <?php endif?>
          </ul>
          <!-- <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>-->
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">	
  
   