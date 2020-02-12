<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()) {?>

<?php
    if(isset($_SESSION['new_cost']))
    {
        echo '<h4>'.$_SESSION['new_cost'].'</h4>';
        unset($_SESSION['new_cost']);
    }
?>
    <form style="border:1px solid #dddd"  onsubmit="return false">
        <div class="row" style="padding: 21px 0px;background: beige;">



         <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-2">
                <h4>From</h4>
            </div>
                <div class="col-sm-10">
                <input type="date" class="form-control" name="from_date" id="from_date">
                </div>
            </div>
        </div>



        <div class="col-sm-4">
        <div class="row">
            <div class="col-sm-2">
                <h4>To</h4>
            </div>
                <div class="col-sm-10">
                <input type="date" class="form-control" name="to_date" id="to_date">
                </div>
            </div>
        </div>

           
           
            <button class="btn btn-success" id='other_salary'>submit</button>
        </div>
    </form>



    <div class="table-responsive" id="other_salary_list">
        <h3 style="float: left;position: relative;margin-right:15px">Other Cost</h3>
        <div style="position: relative; top:20px">
    <span>    <span  id="gl_create"class="glyphicon" style="color:green;display:none;">&#xe013;</span><a  class="btn btn-success" href="create_new_other_cost.php">Create New</a><span>
                    </div>
        <table class="table table-striped">
            <thead>
           <tr>
               <th></th>
           <th>Purpose</th><th>Amount</th><th>Action</th>
           </tr>
            </thead>
            <tbody id ="other_salary_payment">

            </tbody>
        </table>
    </div>



           </div>

        
                    <?php
                }
                else{ header('Location: signin.php');}?>
<?php
  include('footer.php');
?>