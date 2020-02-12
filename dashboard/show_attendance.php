<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>

<div class="col-sm-12">
    <div class="row">
    <span class="glyphicon" id ="daily_check_icon" style="display: none;color:green">&#xe013;</span>
        <button class="btn btn-success" id="daily_atten" onclick="attenValueChange(1)">Daily</button>
        <span class="glyphicon" id ="daily_month_icon" style="color:green">&#xe013;</span>
        <button class="btn btn-success" id="monthly_atten" onclick="attenValueChange(2)">Monthly</button>
    </div>
    <div class="row">
    <form style="border:1px solid #dddd" id="exam_create_form_selected" onsubmit="return false">
        <div class="row" style="padding: 21px 0px;background: beige;">

            <div class="col-sm-3">
                <select class="form-control" id="year_attn">
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
                <select class="form-control" id="month_att">
                    <option value="" disabled selected>Month</option>
                    <?php
                    
                    for($i = 1; $i<= 12; $i++) {
                        ?>
                        <option value="<?php if($i < 10) echo '0'.$i; else echo $i;  ?>"  ><?php if($i < 10) echo '0'.$i; else echo $i;  ?></option>

                        <?php
                    }
                    
  
                    ?>
                  
                </select>
            </div>
            <div class="col-sm-3"  id="date_atte_allo" style="display: none;">
               <input type="date" class="form-control" id="date" name="date_atten" placeholder="Date"  />
            </div>
            <button class="btn btn-success"  onclick="submit_attedance()">Show Attendance</button>
        </div>
    </form>


<div class="col-sm=12" id="daily_panel">
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Date</th>
            <th>Login</th>
            <th>Logout</th>
            
        </tr>
        </thead>
        <tbody id="single_date_att">
        
        </tbody>
    </table>
    </div>
</div>
<div class="col-sm=12" id="daily_panel">

</div>

    </div>


</div>

<?php else:?>
<?php header('Location: signin.php'); //echo "Not Loggedin"; ?>
<?php endif?>
<?php
	include('footer.php');
?>