<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>
<h1 class="page-header">Result</h1>

  <table class="table">
     <tr>
       <th>Course Code</th>
       <th>Course Title</th>
       <th>Credit</th>
       <th>Grate</th>
       <th>Grate Point</th>
     </tr>
    <?php
    $sgpa=0;
    $totalcredit=0;
    $totalsgpa=0;
    $sid=student_info($_SESSION['s_id'],'s_id');
     $query = $db->query("SELECT * FROM `course_list` inner join result on result.course_offer_id=course_list.id where result.s_id='$sid'");
                if($query->num_rows>0) {
              while($row = $query->fetch_assoc()) {
              echo '<tr><td>'.$row['course_code'].'</td><td><a href="result_details.php?id='.$row['id'].'">'.$row['course_title'].'</a></td><td>'.$row['credit'].'</td><td>'.$row["lg"].'</td>
              <td>'.$row["gp"].'</td><tr>';
              $totalcredit=$totalcredit+$row['credit'];
              $credit=$row['credit'];
              $sgpa=$row["gp"]*$credit;
              $totalsgpa=$totalsgpa+$sgpa;
              }
        
        $cgpa=$totalsgpa/$totalcredit;
        $sgpa=round($cgpa,2);
           }
           ?>

  </table>
  <table class="table">
   <tr>
        <th>Total Credit Taken: <?php echo $totalcredit?></th>
        <th>CGPA: <?php echo $sgpa?></th>
      </tr>
    </table>
<br />
<br />


<?php else:?>
<?php header('Location: signin.php'); //echo "Not Loggedin"; ?>
<?php endif?>
<?php
	include('footer.php');
?>