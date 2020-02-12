<?php
include('header.php');
?>
<?php if(is_admin_Loggedin()):?>

    <br />
    <br />
    <br />
    <h3 class="page-header">View Students Salary</h3>
    <br />
    <form style="border:1px solid #dddd" id="exam_create_form_selected" onsubmit="return false">
        <div class="row" style="padding: 21px 0px;background: beige;">

            <div class="col-xs-2">
                <select required class="form-control" id="exam_class" name="class" >
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
                <select class="form-control" required id="exam_session" >
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
                <input type="text" id="s_id" class="form-control" placeholder="Student Id"/>
            </div>



            <button class="btn btn-success" id = 'view_salary'>View Salary</button>
        </div>
    </form>
     
    

    <div class="table-responsive" style ="display:none;" id="salary_paid_panel">
        <table class="table table-striped">
            <thead>
                <tr id="salary_list_header">
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Auct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                </tr>
            </thead>

            <tbody id="exam_list_body">
                    <td id= "jan"><button class="btn btn-primary">-</button></td>
                    <td id= "feb"><button class="btn btn-primary">-</button></td>
                    <td id= "mar"><button class="btn btn-primary">-</button></td>
                    <td id= "apr"><button class="btn btn-primary">-</button></td>
                    <td id= "may"><button class="btn btn-primary">-</button></td>
                    <td id= "jun"><button class="btn btn-primary">-</button></td>
                    <td id= "jul"><button class="btn btn-primary">-</button></td>
                    <td id= "aug"><button class="btn btn-primary">-</button></td>
                    <td id= "sep"><button class="btn btn-primary">-</button></td>
                    <td id= "auc"><button class="btn btn-primary">-</button></td>
                    <td id= "nov"><button class="btn btn-primary">-</button></td>
                    <td id= "dec"><button class="btn btn-primary">-</button></td>
                    

            </tbody>
        </table>
    </div>

    <div class="table-responsive" id="salary_detail_panel" style="display: none;">
    <h3 id="salaray_detail_title">Salary Detail</h3>
        <table class="table table-bordered" style="max-width: 60%">
            <thead>
                <tr id="salary_list_detail">
                   <th>Date Time</th>
                   <th>Amount</th>
                </tr>
            </thead>

            <tbody id="salary_detail">
                 
                    

            </tbody>
        </table>
    </div>


<?php else : ?>
    <?php header('Location: signin.php'); ?>
<?php endif ?>
<?php
include('footer.php');
?>