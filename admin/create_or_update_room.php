<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>


<?php else:?>
<?php header('Location: signin.php');?>
<?php endif?>
<?php

if(isset($_POST['hide_id']))
{
  $check = $db->query("SELECT * FROM room WHERE room_name='".$_POST['rm_name']."'");
  if($check->num_rows>1){
?>
<h4>Room already exist</h4>
<?php
  }else
  {
    
    $insert = $db->query(" UPDATE `room` SET `room_name`='".$_POST['rm_name']."',`capacity`='".$_POST['rm_capasityMain']."' WHERE `id` = ".$_POST['hide_id']);  
    ?>
    <h4></h4>
    <?php
      $_SESSION['message'] = 'Room is updated successfully';
    header('Location: create_or_update_room.php');
  }
}


if(!isset($_GET['id']) &&(isset($_POST['rm_name'])) &&(isset($_POST['rm_capasityMain'])))
{
  $check = $db->query("SELECT * FROM room WHERE room_name='".$_POST['rm_name']."'");
  if($check->num_rows>0){
?>
<h4>Room already exist</h4>
<?php
  }else
  {
    
    $insert = $db->query("INSERT INTO `room`( `room_name`, `capacity`) VALUES ('".$_POST['rm_name']."','".$_POST['rm_capasityMain']."')");
    ?>
    <?php
    $_SESSION['message'] = 'New Room is created successfully';
     header('Location: create_or_update_room.php');
  }
   

}

?>


<div class="panel-heading"  style="background: bisque;
    color: brown;">
  <h1>Create New Or Update Room</h1>
  <?php
  ?>
    <h3><?php

    if(isset( $_SESSION['message'])) {
     echo $_SESSION['message'];
     unset( $_SESSION['message']);
    }?>
     </h3>
</div>
<div class="panel-body" style="background: aliceblue;">
    <h3>Create New Room</h3>
  <form action="create_or_update_room.php" method="POST" style="border: 1px solid royalblue;
    min-height: 58px;
    padding: 11px;
    background: wheat;
    padding-bottom: 11px;">

  <?php if(isset($_GET['id'])) {?>
  
  <input type="hidden" value="<?php echo $_GET['id']?>" name="hide_id">
  
    <?php }  ?>

    <div class="form-group">
      <label for="rm_name" class="col-sm-2">Room No/Name</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="rm_name" name="rm_name"  placeholder="304"    <?php if(isset($_GET['id'])) {?>
          value="<?php echo $_GET['rm_name']?>"
        <?php }  ?> >
      </div>
      <label for="rm_capasity" class="col-sm-1">Capacity</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="rm_capasityMain" name="rm_capasityMain" placeholder="50"
        <?php if(isset($_GET['id'])) {?>
          value="<?php echo $_GET['rm_capasityMain']?>"
        <?php }  ?>
        
        >
      </div>
      <div class="col-sm-2">
          <?php if(!isset($_GET['id'])) {?>
        <button type="submit" id="create" name="create" class="btn btn-primary btn-block">Create</button>
        <?php
        } else {
            ?>
             <button type="submit" id="update" name="update" class="btn btn-primary btn-block">Update</button>

            <?php
        }
         ?>
      </div>
    </div>

  </form>
  <div class="row">
        <div class="col-sm-12">
            <h3>Room List</h3>
        </div>

        
            <table class="table table-striped" style="border: 1px solid">
                <thead>
                <tr>
                    <th><span style="float:left">Room Name/No</span><input type="text" id="rm_search"  class="form-control" style="max-width: 200px"></th>
                    <th><span style="float:left">Capasity</span> <input type="text" id="rm_capasity"  class="form-control "style="max-width: 200px"></th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $query = $db->query("SELECT * FROM `room` ORDER BY `room_name`");
                    if($query->num_rows>0) {
                    while($row = $query->fetch_assoc()) {
                        echo '<tr id="rm_row'.$row['id'].'"><td id="rm_name_'.$row['id'].'">'.$row['room_name'].'</td><td  id="rm_capasity_'.$row['id'].'">'.$row['capacity'].'</td><td><a href="create_or_update_room.php?id='.$row['id'].'&&rm_name='.$row['room_name'].'&&rm_capasityMain='.$row['capacity'].'" id="btn-edit-'.$row['id'].'">Edit</a></td></tr>';
                    }
                    } else {
                    echo '<tr><td>No Teacher to Display</td></tr>';
                    }
                ?>
                </tbody>
            </table>
        

  </div>
</div>




<?php
  include('footer.php');
?>