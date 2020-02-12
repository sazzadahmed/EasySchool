<!-- sazzad code  -->

<?php

  ob_start();
  session_start();


  unset($_SESSION['class']); 
  unset($_SESSION['course']); 
  unset($_SESSION['section']);
  // unset($_SESSION['semester']);