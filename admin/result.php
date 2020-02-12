<?php
  include('header.php');
?>
<?php if(is_admin_Loggedin()):?>
  <br />
<h1 class="page-header">Result</h1>
<br />
<style type="text/css">
  .res_inp {
    width: 70px;
  }
</style>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>ID</th>
        <th colspan="2">Name</th>
        <th>Attend</th>
        <th>CT</th>
        <th>Quiz</th>
        <th>Assign</th>
        <th>Present</th>
        <th>Final</th>
        <th>Total</th>
        <th>GPA</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr id="1">
        <td>1</td>
        <td><input type="text" id="s_id" class="form-control" name="s_id"  value="161-15-1013" disabled></td>
        <td colspan="2"><input type="text" id="s_name" class="form-control" name="s_name" value="Al-Amin Firdows" disabled></td>
        <td><input type="text" id="attend" class="form-control res_inp" name="attend" value="" onchange="get_total();"></td>
        <td><input type="text" id="ct" class="form-control res_inp" name="ct" value="" onchange="get_total();"></td>
        <td><input type="text" id="quiz" class="form-control res_inp" name="quiz" value="" onchange="get_total();"></td>
        <td><input type="text" id="assignment" class="form-control res_inp" name="assignment" value="" onchange="get_total();"></td>
        <td><input type="text" id="presentation" class="form-control res_inp" name="presentation" value="" onchange="get_total();"></td>
        <td><input type="text" id="final_exam" class="form-control res_inp" name="final_exam" value="" onchange="get_total();"></td>
        <td><input type="text" id="total" class="form-control res_inp" name="total"  value="" disabled></td>
        <td><input type="text" id="gpa" class="form-control res_inp" name="gpa" value=""  disabled></td>
        <td><button class="btn btn-primary">Save</button> </td>
      </tr>
      <tr id="1">
        <td>1</td>
        <td><input type="text" id="s_id" class="form-control" name="s_id"  value="161-15-1013" disabled></td>
        <td colspan="2"><input type="text" id="s_name" class="form-control" name="s_name" value="Al-Amin Firdows" disabled></td>
        <td><input type="text" id="attend" class="form-control res_inp" name="attend" value="" onchange="get_total();"></td>
        <td><input type="text" id="ct" class="form-control res_inp" name="ct" value="" onchange="get_total();"></td>
        <td><input type="text" id="quiz" class="form-control res_inp" name="quiz" value="" onchange="get_total();"></td>
        <td><input type="text" id="assignment" class="form-control res_inp" name="assignment" value="" onchange="get_total();"></td>
        <td><input type="text" id="presentation" class="form-control res_inp" name="presentation" value="" onchange="get_total();"></td>
        <td><input type="text" id="final_exam" class="form-control res_inp" name="final_exam" value="" onchange="get_total();"></td>
        <td><input type="text" id="total" class="form-control res_inp" name="total"  value="" disabled></td>
        <td><input type="text" id="gpa" class="form-control res_inp" name="gpa" value=""  disabled></td>
        <td><button class="btn btn-primary">Save</button> </td>
      </tr>
    </tbody>
  </table>
</div>
<script type="text/javascript">
	$('.btnAddToCart').click(function(){
    var thisTR = $(this).closest('tr');
    thisTR.addClass('clicked'); //optional - use CSS to color row
    var trid = thisTR.attr('id'); //tr_17
    trid = trid.split('_')[1]; //17
    $('#tempcart').val( $('#tempcart').val() +'|'+ trid);
};
$('#btnCheckout').click(function(){
    $('#tcform').submit();
});
</script>




<?php else:?>
<?php header('Location: signin.php'); ?>
<?php endif?>
<?php
	include('footer.php');
?>