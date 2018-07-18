<?php
	session_start();
	?>

<link href="http://localhost/proaccounting/css/jquery-ui.css" rel="stylesheet" type="text/css">
<script  src="http://localhost/proaccounting/js/jquery.js"></script>
<script  src="http://localhost/proaccounting/js/jquery-ui.min.js"></script>

<script>
  $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $("#MyDatepicker").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#MyDatepicker1").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate()+1);
        $("#MyDatepicker1").datepicker( "option", "minDate", minValue );
    });
});
});
  </script>

<script>
  $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $("#MyDatepicker2").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#MyDatepicker3").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate()+1);
        $("#MyDatepicker1").datepicker( "option", "minDate", minValue );
    });
});
});
  </script>

<script>
  $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $("#MyDatepicker4").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#MyDatepicker5").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate()+1);
        $("#MyDatepicker1").datepicker( "option", "minDate", minValue );
    });
});
});
  </script>


<script>
  $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $("#MyDatepicker6").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#MyDatepicker7").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate()+1);
        $("#MyDatepicker1").datepicker( "option", "minDate", minValue );
    });
});
});
  </script>
  <?php
	include "../../config.php";
	include "../../function.php";
	$id=$_SESSION['clogin']['id'];
	//echo "select id,name from client where coid=$id";
?>
<!--
<form method="post" action="module/summary/summary.php">
	<table border="1px" width="100%" cellspacing="0">
    <tr>
    	<td colspan="2" style="background-color:red; font-size:20px;">Releaseorders Summary</td>
    </tr>
    <tr>
    <td>Select Media Name</td>
    <td height="100px">
	<select name="client"  required>
    	<option value="" ><-- Select Media Name --> <!--</option>
        <?php
		/*	$m=mysqli_query($con,"select id,name from edition where coid=$id");
			while($mediadte=mysqli_fetch_assoc($m)){
			?>
            <option value="<?php echo $mediadte['id'];?>"><?php echo $mediadte['name'];?></option>
            <?php
			}*/
		?>
    </select>
    </td>
    </tr>
    <tr>

    <tr>
    <td>Select Duration</td>
    <td>
		<input type="text" name="fdatee" id="MyDatepicker">
		<input type="text" name="tdatee" id="MyDatepicker1">
    </td>
    </tr>
    <tr>


    	<td colspan="2"><input type="submit" value="Submit"></td>
    </tr>
    </table>
</form>
-->
<form method="post" action="module/summary/isummary.php">
	<table border="1px" width="100%" cellspacing="0" style="margin-top:30px;">
    <tr>
    	<td colspan="2" style="background-color:red; font-size:20px;">Invoice Summary</td>
    </tr>
    <tr>
    <td>Select Client Name</td>
    <td>
	<select  name="client" style="height:auto"  >
    	<option value=""><-- Select Client Name --></option>
        <?php
			$m=mysqli_query($con,"select id,name from client where coid=$id");
			while($clientdte=mysqli_fetch_assoc($m)){
			?>
            <option value="<?php echo $clientdte['id'];?>"><?php echo $clientdte['name'];?></option>
            <?php
			}
		?>
    </select>
    </td>
    </tr>
    <tr>
    <td>Select Duration</td>
    <td>
		<input type="text" name="fdatee" id="MyDatepicker2">
		<input type="text" name="tdatee" id="MyDatepicker3">
    </td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" value="Submit"></td>
    </tr>
    </table>
</form>


<form method="post" action="module/summary/recipt.php">
	<table border="1px" width="100%" cellspacing="0" style="margin-top:30px;">
    <tr>
    	<td colspan="2" style="background-color:red; font-size:20px;">Recipt Summary</td>
    </tr>
    <tr>
    <td>Select Duration</td>
    <td>
		<input type="text" name="fdatee" id="MyDatepicker4">
		<input type="text" name="tdatee" id="MyDatepicker5">
    </td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" value="Submit"></td>
    </tr>
    </table>
</form>

<form method="post" action="module/summary/payment.php">
	<table border="1px" width="100%" cellspacing="0" style="margin-top:30px;">
    <tr>
    	<td colspan="2" style="background-color:red; font-size:20px;">Payment Summary</td>
    </tr>
    <tr>
    <td>Select Duration</td>
    <td>
		<input type="text" name="fdatee" id="MyDatepicker6">
		<input type="text" name="tdatee" id="MyDatepicker7">
    </td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" value="Submit"></td>
    </tr>
    </table>
</form>
