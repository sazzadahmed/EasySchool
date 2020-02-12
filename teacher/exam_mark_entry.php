<?php
include('header.php');
?>
<?php if (is_teacher_Loggedin()) : ?>



<?php
$sql_query = null;
if(isset($_GET['id']))
{
    ?>
    <p style="display:none"  id = "exam_id_mark_entry">
        <?php echo $_GET['id'];
        $sql_query = "SELECT * FROM `exam` WHERE id = '".$_GET['id']."'";
        ?>
    </p>
    <?php
}
else{
    ?>
    <p style="display:none"  id = "exam_id_mark_entry">
    <?php echo $_POST['id'];
    $sql_query = "SELECT * FROM `exam` WHERE id = '".$_POST['id']."'";
    ?>
    </p>
    <?php
}
  $query = $db->query($sql_query);
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        ?>
        <p style="display: none" id ="max_exam_mark"><?php  if(isset($row['mark'])) echo $row['mark']; ?></p>
        <?php
      break;
    }
}



$query = $db->query($sql_query);


?>




<p id='typesOfExam' style="display:none;"></p>
<p id='exam_semester' style="display:none;"></p>
<h3>Mark Entry Talbe</h3>
<div class="table-responsive">
    <table class="table table-striped">
      <thead id = "mark_entry_table">
        <tr>
        <th>S_ID</th>
        <th>Mark</th>
        <th>MCQ Mark</th>
        <th>Written Mark</th>
        <th>Action</th>
        </tr>
      </thead>
      <tbody id = "mark_entry_table_body">

      </tbody>
    </table>
</div>




    <?php else : ?>
    <?php header('Location: signin.php'); ?>
<?php endif ?>
<?php
include('footer.php');
?>