<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()) {?>

<?php

if(isset($_POST) && (isset($_POST['amount']) && isset($_POST['description']))){

    $amount = $_POST['amount'];
    $desc = $_POST['description'];
    $id = $_GET['id'];

    $query = "update `salary` set `amount`=".$amount.", `description`= '".$desc."' where id = ".$id;
    $db->query($query);
    $_SESSION['new_cost'] = 'Edit Cost Successfully';
     header("Location: other_salary.php");

}

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $amount = null;
    $desc = null;  
    $query =    $db->query("SELECT * FROM `salary` WHERE id = ".$id);
    if ($query->num_rows > 0) {
  
        while ($row = $query->fetch_assoc()) {

          $amount = $row['amount'];
          $desc = $row['description']; 
        break;         
        }
    }

?>


<h4>Edit Other Cost</h4>
    <form style="border:1px solid #dddd" method="post" acion="<?php echo $_SERVER['PHP_SELF'];?>">
        <div class="row" style="padding: 21px 0px;background: beige;">

        <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <h4>Amount</h4>
            </div>
                <div class="col-sm-12">
                <input type="number" class="form-control" name="amount"  required style="width: 400px" value="<?php echo $amount ?>"/>
                </div>
            </div>
        </div>
<input type="hidden" name= "id" value= <?php echo $id ?>/>
        <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <h4>Description</h4>
            </div>
                <div class="col-sm-12">
                     <textarea name="description"   style="width: 400px; height:100px">
                     <?php echo $desc ?>
                    </textarea>

            </div>
        </div>

            <button class="btn btn-success" id='other_salary'>submit</button>
        </div>
    </form>


        
                    <?php
                    }
                }
                else{ header('Location: signin.php');}?>
<?php
  include('footer.php');
?>