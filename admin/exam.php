<?php
include('header.php');
?>
<?php if(is_admin_Loggedin()):?>

    <br />
    <br />
    <br />
    <h3 class="page-header">Create New Exam</h3>
    <br />
    <form style="border:1px solid #dddd" id="exam_create_form_selected" onsubmit="return false">
        <div class="row" style="padding: 21px 0px;background: beige;">

            <div class="col-xs-2">
                <select required class="form-control" id="exam_class" name="class" onchange="getAllCourseListAdmin(this.value);">
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
                <select class="form-control" id="exam_program" name="program" onchange="getAllCourseByProgramAdmin(this.value)">
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
            <div class="col-xs-2">
                <select class="form-control" required id="select_course_id" name="course">
                    <option value="" disabled selected>Select Course</option>
                </select>
            </div>
            <button class="btn btn-success" id = 'create_exam'>Add Exam</button>
        </div>
    </form>
        <div class="col-sm-12" id='exam_create_container'>
            <h4>Select Exam Type (<span id ="exam_semester"></span>) </h4>
            <div class="row" style="border:1px solid #dddd; border-radius:5px;padding: 21px 0px;background: beige;">

                <div class="col-xs-2">
                    <button class="btn btn-success teacher_active" id='exam_type_quiz'>QUIZ</button>
                </div>
                <div class="col-xs-2">
                    <button class="btn btn-success teacher_active" id='exam_type_ct'>Class Test</button>
                </div>
                <div class="col-xs-2">
                    <button class="btn btn-success teacher_active" id='exam_type_mid_tern'>Mid Term</button>
                </div>
                <div class="col-xs-2">
                    <button class="btn btn-success teacher_active" id='exam_type_final'>Final</button>
                </div>
                <div class="col-xs-2">
                    <button class="btn btn-success teacher_active" id='exam_type_attendance'>Attendance</button>
                </div>
            </div>

            <div class="row" id="quiz_section" style="border:1px solid #dddd;border-radius:5px; background-color:bisque">
                <h4>QUIZ Exam</h4>
                <div class="form-group">
                    <label class="col-sm-1 control-label" for="quiz_mark">Mark</label>
                    <div class="col-sm-5">
                        <input class="form-control" type="number" name="quiz_mark" id="quiz_mark">
                    </div>

                    <div class="col-sm-1"> <button class="btn btn-success ok_create_exam" id = 'quiz_ok'>OK</button></div>
                    <div class="col-sm-1">  <button class="btn btn-success  cansel_create_exam" id = 'quiz_ok'>Cancel</button></div>
                    
                </div>
            </div>

            <div class="row" id="ct_section" style="border:1px solid #dddd;border-radius:5px; background-color:bisque">
                <h4>Class Test</h4>
                <div class="form-group">
                    <label class="col-sm-1 control-label" for="ct_mark">Mark</label>
                    <div class="col-sm-5">
                        <input class="form-control" type="number" name="ct_mark" id="ct_mark">
                    </div>
                    <div class="col-sm-1">  <button class="btn btn-success ok_create_exam" id = 'ct_ok'>OK</button></div>
                    <div class="col-sm-1"><button class="btn btn-success cansel_create_exam" id = 'ct_ok'>Cancel</button></div>
                </div>
            </div>

            <div class="row" id="mid_section" style="border:1px solid #dddd;border-radius:5px; background-color:bisque">
                <h4>Mid Term</h4>
                <div class="form-group">
                    <label class="col-sm-1 control-label" for="mark_mid_term_mcq">MCQ</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="number" name="mark_mid_term_mcq" id="mark_mid_term_mcq">
                    </div>
                    <label class="col-sm-1 control-label" for="mark_mid_term_written">Mark</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="number" name="mark_mid_term_written" id="mark_mid_term_written">
                    </div>
                    <div class="col-sm-1"><button class="btn btn-success ok_create_exam" id = 'mid_ok'>OK</button></div>
                    <div class="col-sm-1"> <button class="btn btn-success cansel_create_exam">Cancel</button></div>
                </div>
            </div>
            <div class="row" id="attendance_section" style="border:1px solid #dddd;border-radius:5px; background-color:bisque">
                <h4>Attendance</h4>
                <div class="form-group">
                    <label class="col-sm-1 control-label" for="mark_mid_term_mcq">Attendance Mark</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="number" name="attendance" id="attendance_mark">
                    </div>
                    <div class="col-sm-1"><button class="btn btn-success ok_create_exam" id = 'attendance_ok'>OK</button></div>
                    <div class="col-sm-1"> <button class="btn btn-success cansel_create_exam">Cancel</button></div>
                </div>
            </div>

            <div class="row" id="final_section" style="border:1px solid #dddd;border-radius:5px; background-color:bisque">
                <h4>Final</h4>
                <div class="form-group">
                    <label class="col-sm-1 control-label" for="mark_final_term_mcq">MCQ Mark</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="number" name="mark_final_term_mcq" id="mark_final_term_mcq">
                    </div>
                    <label class="col-sm-1 control-label" for="mark_final_term_written">Written Mark</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="number" name="mark_final_term_written" id="mark_final_term_written">
                    </div>
                    <label class="col-sm-1 control-label" for="mark_final_term_practical" id ="practical_mark_label" >Practical Mark</label>
                    <div class="col-sm-2" id ="practical_mark">
                        <input class="form-control" type="number" name="mark_final_term_practical"  id="mark_final_term_practical">
                    </div>
                    <div class="col-sm-1"><button class="btn btn-success ok_create_exam" id = 'final_ok'>OK</button></div>
                    <div class="col-sm-1"> <button class="btn btn-success  cansel_create_exam" id = 'final_ok'>CanCel</button></div>
                </div>
            </div>
        </div>
    



<?php else : ?>
    <?php header('Location: signin.php'); ?>
<?php endif ?>
<?php
include('footer.php');
?>