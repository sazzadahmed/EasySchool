<?php
  include('header.php');
?>
<?php 

//is_studown_Loggedin();

if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['submit'])){
  
   
   $sid= $_POST['sid'];
   $i= $_POST['i'];
   //$bid= $_POST['bid'];
   $totalamount= $_POST['total'];
   $semester="";
    $name="";
     
         $query = $db->query("SELECT * FROM student_profile where s_id='$sid'");
        if($query->num_rows>0) {
          while($row = $query->fetch_assoc()) {
            $name=$row["s_name"];
            }
         }
?>
<div class="row">
<div class="col-md-12" id="printableArea">
   <div class="col-md-3 well">
      <h5 align="center">DEPARTMENT OF ENGISH</h5>
       <h6 align="center">Jahangirnagar University</h6><br>
     <b>Name:</b><?php echo $name ?><br>
     <b>Student ID:</b><?php echo $sid ?><br>
     <b>Biller ID:</b><?php //echo $bid ?><br>
       <table class="table">
         <tr>
           <th>SL</th>
           <th>Course Code</th>
           <th>Credit</th>
           <th>Amount</th>
         </tr>

         <?php
        // echo $i;
       for($a=1;$a<$i;$a++){
        ?>
        <tr>
          <td><?php echo $a?></td>
          <td><?php echo $_POST['course_code'.$a] ?></td>
          <td><?php echo $_POST['credit'.$a] ?></td>
          <td><?php echo $_POST['amount'.$a] ?></td>
        </tr>
        <?php
       }
       
       ?>
       </table>
       <h3>Total Amount:<?php echo $totalamount?></h3>
       <br><br>
       <h4>Account Officer</h4>
   </div>
   <div class="col-md-3 well">
      <h5 align="center">DEPARTMENT OF ENGISH</h5>
       <h6 align="center">Jahangirnagar University</h6><br>
     <b>Name:</b><?php echo $name?><br>
     <b>Student ID:</b><?php echo $sid?><br>
     <b>Biller ID:</b><?php //echo $bid?><br>
       <table class="table">
         <tr>
           <th>SL</th>
           <th>Course Code</th>
           <th>Credit</th>
           <th>Amount</th>
         </tr>
         <?php
       for($a=1;$a<$i;$a++){
        ?>
        <tr>
          <td><?php echo $a?></td>
          <td><?php echo $_POST['course_code'.$a] ?></td>
          <td><?php echo $_POST['credit'.$a] ?></td>
          <td><?php echo $_POST['amount'.$a] ?></td>
        </tr>
        <?php
       }
       
       ?>
       </table>
       <h3>Total Amount:<?php echo $totalamount?></h3>
       <br><br>
       <h4>Account Officer</h4>
   </div>
   <div class="col-md-3 well">
      <h5 align="center">DEPARTMENT OF ENGISH</h5>
       <h6 align="center">Jahangirnagar University</h6><br>
     <b>Name:</b><?php echo $name?><br>
     <b>Student ID:</b><?php echo $sid?><br>
     <b>Biller ID:</b><?php //echo $bid?><br>
       <table class="table">
         <tr>
           <th>SL</th>
           <th>Course Code</th>
           <th>Credit</th>
           <th>Amount</th>
         </tr>
         <?php
       for($a=1;$a<$i;$a++){
        ?>
        <tr>
          <td><?php echo $a?></td>
          <td><?php echo $_POST['course_code'.$a] ?></td>
          <td><?php echo $_POST['credit'.$a] ?></td>
          <td><?php echo $_POST['amount'.$a] ?></td>
        </tr>
        <?php
       }
       
       ?>
       </table>
       <h3>Total Amount:<?php echo $totalamount?></h3>
       <br><br>
       <h4>Account Officer</h4>
   </div>
   <div class="col-md-3 well">
      <h5 align="center">DEPARTMENT OF ENGISH</h5>
       <h6 align="center">Jahangirnagar University</h6><br>
     <b>Name:</b><?php echo $name?><br>
     <b>Student ID:</b><?php echo $sid ?><br>
     <b>Biller ID:</b><?php //echo $bid ?><br>
       <table class="table">
         <tr>
           <th>SL</th>
           <th>Course Code</th>
           <th>Credit</th>
           <th>Amount</th>
         </tr>
         <?php
       for($a=1;$a<$i;$a++){
        ?>
        <tr>
          <td><?php echo $a?></td>
          <td><?php echo $_POST['course_code'.$a] ?></td>
          <td><?php echo $_POST['credit'.$a] ?></td>
          <td><?php echo $_POST['amount'.$a] ?></td>
        </tr>
        <?php
       }
       
       ?>
       </table>
       <h3>Total Amount:<?php echo $totalamount ?></h3>
       <br><br>
       <h4>Account Officer</h4>
   </div>
</div>
</div>
<?php 

   }


?>
<input type="button" onclick="printDiv('printableArea');" value="print a div!" />

<?php
include('footer.php');


?>


<script>

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>