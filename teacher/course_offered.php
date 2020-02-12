<?php
  include('header.php');
?>
<?php if(is_teacher_Loggedin()):?>
<h1 class="page-header">Course Offering/Advising</h1>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Subject (Code)</th>
        <th>Time - Day</th>
        <th>Semester</th>
      </tr>
    </thead>
    <tbody>
    <?php
      //$year = date("Y");
      //$semester = get_semester();
      //year='$year' and semester='$semester' and
      $teacher_id = teacher_info($_SESSION['t_id'],'id');
      $query = $db->query("SELECT * FROM course_offer WHERE teacher_id='$teacher_id' ORDER BY id DESC");
      if($query->num_rows>0) {
        $i = 1;
        while($row = $query->fetch_assoc()) {
          print_r($row);
          //$code = get_info("course_list",$row['course_id'],"course_code");
          echo '<tr>
          <td>'.get_info("course_list",$row['course_id'],"course_code").'</td>
          <td>'.$row['time_slot'].' - '.ucwords($row['day']).'</td>
          <td>'.ucwords($row['semester']).'</td> </tr>';
          $i++;
        }
      } else {
        echo '<option value="null>No Course to Display</option>';
      }
    ?>
    </tbody>
  </table>
</div>

<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>