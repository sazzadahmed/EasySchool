<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
<h1 class="page-header">Result</h1>
<div class="row">
<form action="" method="post" class="">
  <div class="col-sm-3">
    <input type="text" name="s_id" id="s_id" class="form-control" placeholder="Exam Roll">
  </div>
  <div class="col-sm-3">
    <select class="form-control" id="semester"  name="semester">
          <option value="spring">Spring</option>
          <option value="summer">Summer</option>
          <option value="fall">Fall</option>
        </select>
  </div>
  <div class="col-sm-3">
    <select class="form-control" id="year"  name="year">
          <option value="2017">2017</option>
          <option value="2018">2018</option>
          <option value="2019">2019</option>
        </select>
  </div>
  <div class="col-sm-3">
    <button type="submit" id="show_result" name="show_result" class="btn btn-primary">Show Result</button>
  </div>
</form>
</div>
<br />
<br />
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>ID</th>
        <th>Course</th>
        <th>Incourse</th>
        <th>Exam</th>
        <th>Total</th>
        <th>GPA</th>
        <th>Print</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = $db->query("SELECT * FROM result ORDER BY year");
        if($query->num_rows>0) {
          while($result = $query->fetch_assoc()) {
            echo '<tr><td>'.$result['id'].'</td><td>'.student_info($result['s_id'],'s_name').'</td><td>'.student_info($result['s_id'],'s_id').'</td><td>'.$result['course_offer_id'].'</td><td>'.$result['incourse'].'</td><td>'.$result['exam'].'</td><td>'.$result['total'].'</td><td>'.gpa($result['total']).'</td><td><a href="#" class="">Print</a></td></tr>';
          }
        } else {
          echo '<option value="null>No Result to Display</option>';
        }
      ?>
    </tbody>
  </table>
</div>

<?php else:?>
<?php header('Location: signin.php'); ?>
<?php endif?>
<?php
	include('footer.php');
?>