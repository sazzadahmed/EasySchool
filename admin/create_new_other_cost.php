<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()) {?>

<?php

if(isset($_POST) && (isset($_POST['amount']) && isset($_POST['description']))){

    $amount = $_POST['amount'];
    $desc = $_POST['description'];
    $date = new DateTime();
    if($_POST['creation_date'])
    {
        $date = $_POST['creation_date'];
        $query = "INSERT INTO `salary`(`status`, `date_of_payment`, `amount`, `description`) VALUES (4,'".$date."',$amount,'".$desc."')";
    }
    else
    {
        $query = "INSERT INTO `salary`(`status`, `amount`, `description`) VALUES (4,$amount,'".$desc."')";

    }
    $db->query($query);
    $_SESSION['new_cost'] = 'New Cost Inserted';
    header("Location: other_salary.php");

}

?>


<h4>Add New Cost</h4>
    <form style="border:1px solid #dddd" method="post" acion="create_new_other_cost.php">
        <div class="row" style="padding: 21px 0px;background: beige;">



         <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <h4>Date</h4>
            </div>
                <div class="col-sm-12">
                <input type="date" class="form-control" name="creation_date"  style="width: 400px">
                </div>
            </div>
        </div>



        <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <h4>Amount</h4>
            </div>
                <div class="col-sm-12">
                <input type="number" class="form-control" name="amount"  required style="width: 400px"/>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <h4>Description</h4>
            </div>
                <div class="col-sm-12">
                     <textarea name="description"  style="width: 400px; height:100px"></textarea>

            </div>
        </div>

            <button class="btn btn-success" id='other_salary'>submit</button>
        </div>
    </form>


        
                    <?php
                }
                else{ header('Location: signin.php');}?>
<?php
  include('footer.php');
?>