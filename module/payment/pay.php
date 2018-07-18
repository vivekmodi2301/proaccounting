<?php
	include "../../config.php";
	include "../../function.php";
	if(isset($_POST['eid']) && $_POST['eid']){
		$id=$_POST['eid'];
		$er=mysqli_fetch_assoc(mysqli_query($con,"select payment.id,edition.name,ammount,eid, narration,datee, paymentid, payby , bankname,cheque from payment join edition on payment.eid=edition.id where payment.id=$id"));
	}
?>
<link href="http://localhost/proaccounting/css/jquery-ui.css" rel="stylesheet" type="text/css">
<script  src="http://localhost/proaccounting/js/jquery.js"></script>
<script  src="http://localhost/proaccounting/js/jquery-ui.min.js"></script>

<script>
  $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $("#pdate").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#pdate").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate()+1);
        $("#MyDatepicker1").datepicker( "option", "minDate", minValue );
    });
});
});
  </script>

	<?php
		if(isset($_POST['eid']) && $_POST['eid']){
			?>
            	<input type="hidden" name="id" value="<?php echo $id; ?>">
            <?php	
		}
	?>
	<form method="post" style="background-color:#0cf;"  style="margin-top:10px;">

	<table border="1px" cellspacing="0" align="center" width="80%" height="500px;" >
    	<tr>
        	<th colspan="2">Payment Form</th>
        </tr>
        <tr>
        	<td>Payment No.</td>
            <?php
				$rno=mysqli_query($con,"select id,paymentid from payment order by paymentid desc limit 0,1");	
				if(mysqli_num_rows($rno)){
					$reno=mysqli_fetch_assoc($rno);
						$no=$reno['paymentid'];
						$no++;	
				}
				else{
					$no=1;	
				}
			?>
            <td><input type="text" value="<?php if(isset($er['paymentid']) && $er['paymentid']){echo $er['paymentid'];} else{ echo $no;}?>" name="paymentid"></td>
        </tr>
        <tr>
        	<td>Media Name</td>
        	<td><select name="eid">
            <option value=""><--- Select Media ---></option>
            	<?php
					$p=mysqli_query($con,"select id,name from edition");
					while($pdte=mysqli_fetch_assoc($p)){
				?>	
                	<option <?php if(isset($er['eid']) && $er['eid']==$pdte['id']){echo "selected";}?> value="<?php echo $pdte['id'];?>"><?php echo $pdte['name'];?></option>
                <?php
					}
				?>
                </select>
            </td>
        </tr>
        <tr>
        	<td>Date</td>
           	<td>
            		<input type="text" id="pdate" value="<?php if(isset($er['datee']) && $er['datee']){ echo $er['datee'];}?>" name="datee">
            </td>
        </tr>
        <tr>
        	<td>Payment By</td>
           	<td><input type="radio" <?php if(isset($er['payby']) && $er['payby']=='cash'){echo "checked";}?> name="payby" onClick="cbdte()" select value="cash">Cash
            	<input type="radio" name="payby" <?php if(isset($er['payby']) && $er['payby']=='cheque'){echo "checked";}?> onclick="bankdte()" select value="cheque">Cheque
                <div id="bdte">
                	<?php
						if(isset($er['payby']) && $er['payby']=='cheque'){
					?>
                    Bank Name:	<input type="text" value="<?php echo $er['bankname'];?>" name="bankname" >
					Cheque 	 :	<input type="text" maxlength="6" value="<?php echo $er['cheque'];?>" name="cheque">
                    <?php }?>
                </div>
            </td>
        </tr>
        <tr>
        	<td>Ammount</td>
           	<td><input type="text" value="<?php if(isset($er['ammount']) && $er['ammount']){ echo $er['ammount'];}?>" name="ammount"></td>
        </tr>
        <tr>
        	<td>Narration</td>
            <td><textarea name="narration" style="width:530px;border:1px solid;border-radius:5px;"><?php if(isset($er['narration']) && $er['narration']){ echo $er['narration'];}?></textarea>
            </td>
        </tr>
        <tr>
        	<td colspan="2"><input type="submit" value="Pay"></td>
        </tr>
    </table>
</form>