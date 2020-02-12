<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>
<?php
 if(isset($_GET['id'])){
    $id=$_GET['id'];
 }
?>
<h1 class="page-header">Result Details</h1>

  <table class="table" >
     <tr >
       <th>Atte(10)</th>
       <th>Class Test(15)</th>
       <th>Quize(10)</th>
       <th>Assi(10)</th>
       <th>Pre(15)</th>
       <th>Final Exam(40)</th>
       <th>Total(100)</th>
     </tr>
    <?php
    $totalcredit=0;
    $totalsgpa=0;
    $sid=student_info($_SESSION['s_id'],'s_id');
     $query = $db->query("SELECT * FROM  result where id='$id'");
                if($query->num_rows>0) {
              while($row = $query->fetch_assoc()) {
              echo '<tr ><td>'.$row['attend'].'</td><td>'.$row['ct'].'</td><td>'.$row['quize'].'<td>'.$row['assignment'].'</td><td>'.$row["presentation"].'</td><td>'.$row["final_exam"].'</td><td>'.$row["total"].'</td><tr>';
             
           ?>

  </table>
  <table class="table">
   <tr>
        <th><h2>Grade: <?php echo $row['lg']?></h2></th>
        <th><h2>CGPA: <?php echo $row['gp']?></h2></th>
      </tr>
    </table>
    <?php }}?>
<br />
<br />


<?php else:?>
<?php header('Location: signin.php'); //echo "Not Loggedin"; ?>
<?php endif?>
<?php
	include('footer.php');
?>