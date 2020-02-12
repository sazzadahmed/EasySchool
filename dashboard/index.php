<?php
  include('header.php');
?>
<?php if(is_student_Loggedin()):?>
<div class="container-fluid">
	<br>
   <div class="row" align="center">
   	 <div class="col-sm-4 col-sm-push-8 " >
   	 	<img src="image/<?php echo student_info($_SESSION['s_id'],'s_id') ?>.jpg" alt="Image is not found" name="image" width="200" height="200" border="2" id="image" />
   	 </div>
   	 <div class="col-sm-6 well col-sm-offset-2 col-sm-pull-4 " >
   	 	<div class="col-sm-offset-1" align="left">
   	 		<h2><label for="date_of_birth" class="control-label">Name : 
		        <?php echo student_info($_SESSION['s_id'],'s_name'); ?>
		      </label><br>
		      <label for="date_of_birth" class="control-label">Email : 
		        <?php echo student_info($_SESSION['s_id'],'s_email'); ?>
		      </label><br>
		      <label for="date_of_birth" class="control-label">Phone : 
		        <?php echo student_info($_SESSION['s_id'],'s_mobile'); ?>
		      </label>
		      </h2>
   	 	</div>
   	 </div>
   </div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h2 > Class Routine :</h2>
		</div>
  
		  <div class="col-sm-3">
		  	<h4>Year :
		  	<?php 
		  	echo date(" Y"); 
		    echo "</h4></div>";
		    echo '<div class="col-sm-6"></div>';
		    echo '<div class="col-sm-2"><form action="FPDF/methods_call.php" method="post"><input type="submit" class="btn btn-lg btn-primary" style="margin-right: 0px"  name="download_routine" value="Download Routine"></form></div>';
           $select_day_name=$db->query("SELECT day_name FROM  days");
           while ($day_name=$select_day_name->fetch_assoc()) { ?> 
           	<div class="col-sm-12" ><h4 style="text-align: center;"><b><?php echo $day_name['day_name']; ?></b></h4>
		  	</div>
		  <?php 
		  $store_time_slot=array();
		  $year=date("Y");
		  $day=$day_name['day_name'];
		  $sat_time_slots=get_time_slots($year,$day);
         ?>
<div class="col-sm-12">
	<table class="table" style="margin-left: -40px;">
	    <tr>
		<th>Class</th>
		<?php
        while($row = $sat_time_slots->fetch_assoc()) {
         	echo "<th> $row[time_slot]-$row[time_slot_end] </th>";
         	$store_time_slot[]=$row['time_slot'];
         }
         echo "</tr>";
         $get_classes = $db->query("SELECT class_name FROM classes");
          while($class = $get_classes->fetch_assoc()) {
            echo "<tr><td>$class[class_name]</td>";
            display_course_info_into_routine($year,$day,$class['class_name'],$store_time_slot);
            echo "</tr>";
          }
		 ?>
		
	</table>
		</div>

 <?php } ?>

 


	</div>
	
</div>
<?php else:?>
<?php header('Location: signin.php'); //echo "Not Loggedin"; ?>
<?php endif?>
<?php
	include('footer.php');
?>