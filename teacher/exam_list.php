<?php
include('header.php');
?>
<?php if (is_teacher_Loggedin()) : ?>

    <br />
    <br />
    <br />
    <h3 class="page-header">All Exam</h3>
    <br />
    <form style="border:1px solid #dddd" id="exam_create_form_selected" onsubmit="return false">
        <div class="row" style="padding: 21px 0px;background: beige;">

            <div class="col-xs-2">
                <select required class="form-control" id="exam_class" name="class" onchange="getAllCourseList(this.value);">
                    <option value="">Select Class</option>
                    <?php
                        $query_sem = $db->query("SELECT DISTINCT course_assign_class FROM `course_offer` WHERE teacher_id = " . $_SESSION[t_id]);
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
                <select class="form-control" id="exam_program" name="program" onchange="getAllCourseByProgram(this.value)">
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
                <select class="form-control" id="select_course_id" name="course" onchange="getSectionList(this.value);">
                    <option value="" disabled selected>Select Course</option>
                </select>
            </div>

            <div class="col-xs-2">
                <select class="form-control" id="select_exam_type" name="select_exam_type" onchange="">
                    <option value="" disabled selected>Selcect Type</option>
                    <option value="1">Quiz</option>
                    <option value="2">Class Test</option>
                    <option value="3">Mid</option>
                    <option value="4">Final</option>
                    <option value="5">Attendance</option>
                </select>
            </div>
            <button class="btn btn-success" id='view_exam_list'>view Exam</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr id="exam_list_header">
                    <th>Exam Name</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="exam_list_body">

            </tbody>
        </table>
    </div>


<?php else : ?>
    <?php header('Location: signin.php'); ?>
<?php endif ?>
<?php
include('footer.php');
?>