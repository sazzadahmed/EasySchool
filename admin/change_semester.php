<?php
include('header.php');
?>
<?php if(is_admin_Loggedin()):?>


    <form style="border:1px solid #dddd" id="student_salary" onsubmit="return false">
        <div class="row" style="padding: 21px 0px;background: beige;">



        <div class="col-sm-4">
                <select class="form-control" id="session_semester_ch" required>
                    <option value="" disabled selected>Year</option>
                   
                    <?php
                        $query_sem = $db->query("SELECT * FROM `session` WHERE active_semester >= 1 AND active_semester <= 6");
                        if ($query_sem->num_rows > 0) {
                            while ($row_sem = $query_sem->fetch_assoc()) {
                                if (isset($_POST['class'])) {
                                    echo '<option value="' . $row_sem["name"] . '" selected>' . $row_sem["value"] . '</option>';
                                } else {
                                    echo '<option value="' . $row_sem["name"] . '">' . $row_sem["value"] . '</option>';
                                }
                            }
                        }
                                   
                    ?>
                  
                </select>
            </div>

        <div class="col-sm-4">
                <select class="form-control" id="actuve_semester" required>
                </select>
            </div>

            <button class="btn btn-success" id='change_semseter_submit'>submit</button>
        </div>
    </form>


    <?php else : ?>
    <?php header('Location: signin.php'); ?>
<?php endif ?>
<?php
include('footer.php');
?>