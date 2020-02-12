<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>

<?php  if($_GET['type'] == 'studenet'){ ?>
    <form style="border:1px solid #dddd" id="student_salary" onsubmit="return false">
        <div class="row" style="padding: 21px 0px;background: beige;">



        <div class="col-sm-2">
                <select class="form-control" id="year">
                    <option value="" disabled selected>Year</option>
                    <?php
                    
                    for($i = 2016; $i< 2036; $i++) {
                        ?>
                        <option value="<?php echo $i;  ?>"  ><?php echo $i;  ?></option>

                        <?php
                    }
                    
                    
                    ?>
                  
                </select>
            </div>


        <div class="col-sm-2">
                <select class="form-control" id="month">
                    <option value="" disabled selected>Month</option>
                    <option value="1"  >Jan</option>
                    <option value="2" >Feb</option>
                    <option value="3" >Mar</option>
                    <option value="4"  >Apr</option>
                    <option value="5"  >May</option>
                    <option value="6" >Jun</option>
                    <option value="7" >Jul</option>
                    <option value="8" >Aug</option>
                    <option value="9" >Sep</option>
                    <option value="10">Oct</option>
                    <option value="11" >Nov</option>
                    <option value="12">Dec</option>
 

                </select>
            </div>

            <div class="col-xs-2">
                <select required class="form-control" id="exam_class" name="class">
                    <option value="">Select Class</option>
                    <?php
                        $query_sem = $db->query("SELECT DISTINCT course_assign_class FROM `course_offer` WHERE 1");
                        if ($query_sem->num_rows > 0) {
                            while ($row_sem = $query_sem->fetch_assoc()) {
                                if (isset($_POST['class'])) {
                                    echo '<option value="' . $row_sem["course_assign_class"] . '" selected>' . $row_sem["course_assign_class"] . '</option>';
                                } else {
                                    echo '<option value="' . $row_sem["course_assign_class"] . '">' . $row_sem["course_assign_class"] . '</option>';
                                }
                            }
                        }
                        ?>
                </select>
            </div>

            <div class="col-xs-2">
                <select class="form-control" required id="exam_session">
                    <option value="" disabled selected>Session</option>

                    <?php
                        $query = $db->query("SELECT * FROM session WHERE `is_active` = 1");
                        if ($query->num_rows > 0) {
                            $i = 1;
                            while ($row = $query->fetch_assoc()) {
                                echo '<option value="' . $row['name'] . '">' . $row['value'] . '</option>';
                                $i++;
                            }
                        }
                        ?>
                </select>
            </div>

            <div class="col-sm-2">
                <select class="form-control" id="exam_program" name="program">
                    <option value="" disabled selected>Group</option>
                    <?php
                        $query = $db->query("SELECT * FROM program where program_name !='All'");
                        if ($query->num_rows > 0) {
                            $i = 1;
                            while ($row = $query->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['program_name'] . '</option>';
                                $i++;
                            }
                        }
                        ?>

                </select>
            </div>

           
            <button class="btn btn-success" id='students_salary_submit'>submit</button>
        </div>
    </form>



    <div class="table-responsive" id="student_salary">
        <h3 style="float: left;position: relative;margin-right:15px">Studenet Salary</h3>
        <div style="position: relative; top:20px">
        <span>   <span id="gl_update" class="glyphicon" style="color:green">&#xe013;</span><button class="btn btn-success" id = "update_mode">Update Mode</button></span>
    <span>    <span  id="gl_create"class="glyphicon" style="color:green;display:none;">&#xe013;</span><button  class="btn btn-success" id ="create_mode">Create Mode</button><span>
                    </div>
        <table class="table table-striped">
            <thead>
           <tr>
           <th>Studnet Id</th><th>Paid Status</th><th>Amount</th><th>Action</th>
           </tr>
            </thead>
            <tbody id ="student_salary_payment">

            </tbody>
        </table>
           </div>

    <?php } else {?>



        <form style="border:1px solid #dddd" id="stuff_salary" onsubmit="return false">
        <div class="row" style="padding: 21px 0px;background: beige;">

        <div class="col-sm-3">
                <select class="form-control" id="year"  onchange="changeMonthSalary()">
                    <option value="" disabled selected>Year</option>
                    <?php
                    
                    for($i = 2016; $i< 2036; $i++) {
                        ?>
                        <option value="<?php echo $i;  ?>"  ><?php echo $i;  ?></option>

                        <?php
                    }
                    
                    
                    ?>
                  
                </select>
            </div>
            <div class="col-sm-3">
                <select class="form-control" id="month" onchange="changeMonthSalary()">
                    <option value="" disabled selected>Month</option>
                    <option value="1"  >Jan</option>
                    <option value="2" >Feb</option>
                    <option value="3" >Mar</option>
                    <option value="4"  >Apr</option>
                    <option value="5"  >May</option>
                    <option value="6" >Jun</option>
                    <option value="7" >Jul</option>
                    <option value="8" >Aug</option>
                    <option value="9" >Sep</option>
                    <option value="10">Oct</option>
                    <option value="11" >Nov</option>
                    <option value="12">Dec</option>
 

                </select>
            </div>
            <div class="col-xs-3">
                <select class="form-control" required ="required" id="stuff_type" name ="type"  onchange="changeMonthSalary()">
                    <option value="" disabled selected>Select</option>
                    <option value="teacher">Teacher</option>
                    <option value="stuff">Stuff</option>
                </select>
            </div>


        <button class="btn btn-success" id='teacher_salary_submit'>submit</button>
        </div>
    </form>

    <div class="table-responsive" id="teacher_salary">
        <h3  style="float: left;position: relative;margin-right:15px">
        <?php
        if($_GET['type'] == 'stuff'){
?>
Stuff
<?php
        } else
        {
?>
Teacher
<?php
        }
        ?>
    Salary</h3>
    <div style="position: relative;top:20px">
    <span >  <span id="gl_update" class="glyphicon" style="color:green">&#xe013;</span><button class="btn btn-success" id ="update_mode">Update Mode</button></span>
    <span>   <span id="gl_create" class="glyphicon" style="color:green;display:none;">&#xe013;</span><button  class="btn btn-success" id ="create_mode">Create Mode</button><span></div>
        <table class="table table-striped">
            <thead>
           <tr>
           <th>

               Name</th><th>Amount</th><th>Action</th>
           </tr>
            </thead>
            <tbody id ="student_salary_payment">

            </tbody>
        </table>
           </div>


<?php } else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php
  include('footer.php');
?>