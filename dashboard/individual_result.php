<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>
<h1 class="page-header">Result</h1>
<div class="row">
<div class="col-md-3">
      <button class="btn btn-success" onclick="showFirstYearResult()">First Year</button>
      <button class="btn btn-success" onclick="showSecondYearResult()">2nd Year</button>
</div>
</div>
<div class="table-responsive" id="1stYearResult">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th rowspan="3" colspan="1"  style="text-align: center;vertical-align: baseline;">Course name</th>
        <th colspan="5"  style="text-align: center;vertical-align: baseline;">First Semester</th>
        <th colspan="6"  style="text-align: center;vertical-align: baseline;">Second Semester</th>
        <th colspan="6"  style="text-align: center;vertical-align: baseline;">1st year Final</th>
      </tr>
      <tr>
        <th rowspan="2" style="text-align: center;vertical-align: baseline;">M-1</th>
        <th colspan="2"  style="text-align: center;vertical-align: baseline;">S-1</th>
        <th rowspan="2"  style="text-align: center;vertical-align: baseline;">S1-Total</th>
        <th rowspan="2"  style="text-align: center;vertical-align: baseline;">GPA</th>
        <th  rowspan="2"style="text-align: center;vertical-align: baseline;">M-2</th>
        <th colspan="2">S-2</th>
        <th rowspan="2" style="text-align: center;vertical-align: baseline;">S2-Total</th>
        <th  rowspan="2" style="text-align: center;vertical-align: baseline;">GPA</th>

        <th colspan="2"></th>
        <th colspan="2"></th>
        <th rowspan="2" style="text-align: center;vertical-align: baseline;"></th>
        <th rowspan="2"  style="text-align: center;vertical-align: baseline;">Final-Total</th>
        <th rowspan="2"  style="text-align: center;vertical-align: baseline;">GPA</th>
      </tr>
      <tr>
        
        <th>Theory</th>
        <th>MCQ</th>

        <th>Theory</th>
        <th>MCQ</th>

        <th>Theory</th>
        <th>MCQ</th>
        <th>Practical</th>

      </tr>
      
    </thead>
    <tbody id = "individual_student">

    </tbody>
    <tfoot>
    <tr>
        <th>Grand Total</th>
       <th colspan="5"  style="text-align: center;vertical-align: baseline;">M1 + S1 + Attendance</th>
        <th colspan="6"  style="text-align: center;vertical-align: baseline;">M2 + S2 + Attendance</th>
      </tr>
    </tfoot>
  </table>
</div>


<div class="table-responsive"  id="2ndYearResult" style="display: none"> 
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th rowspan="3" colspan="1"  style="text-align: center;vertical-align: baseline;">Course name</th>
        <th colspan="5"  style="text-align: center;vertical-align: baseline;">4th Semester</th>
        <th colspan="6"  style="text-align: center;vertical-align: baseline;">5th Semester</th>
        <th colspan="6"  style="text-align: center;vertical-align: baseline;">2nd year Final</th>
      </tr>
      <tr>
        <th rowspan="2" style="text-align: center;vertical-align: baseline;">M-4</th>
        <th colspan="2"  style="text-align: center;vertical-align: baseline;">S-4</th>
        <th rowspan="2"  style="text-align: center;vertical-align: baseline;">S4-Total</th>
        <th rowspan="2"  style="text-align: center;vertical-align: baseline;">GPA</th>
        <th  rowspan="2"style="text-align: center;vertical-align: baseline;">M-5</th>
        <th colspan="2">S-5</th>
        <th rowspan="2" style="text-align: center;vertical-align: baseline;">S5-Total</th>
        <th  rowspan="2" style="text-align: center;vertical-align: baseline;">GPA</th>

        <th colspan="2"></th>
        <th colspan="2"></th>
        <th rowspan="2" style="text-align: center;vertical-align: baseline;"></th>
        <th rowspan="2"  style="text-align: center;vertical-align: baseline;">Final-Total</th>
        <th rowspan="2"  style="text-align: center;vertical-align: baseline;">GPA</th>
      </tr>
      <tr>
        
        <th>Theory</th>
        <th>MCQ</th>

        <th>Theory</th>
        <th>MCQ</th>

        <th>Theory</th>
        <th>MCQ</th>
        <th>Practical</th>

      </tr>
      
    </thead>
    <tbody id = "individual_student_2">

    </tbody>
    <tfoot>
    <tr>
        <th>Grand Total</th>
       <th colspan="5"  style="text-align: center;vertical-align: baseline;">M4 + S4 + Attendance</th>
        <th colspan="6"  style="text-align: center;vertical-align: baseline;">M5 + S5 + Attendance</th>
      </tr>
    </tfoot>
  </table>
</div>
  

<?php else:?>
<?php header('Location: signin.php'); //echo "Not Loggedin"; ?>
<?php endif?>
<?php
	include('footer.php');
?>