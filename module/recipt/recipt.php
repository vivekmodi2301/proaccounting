<?php
	include "../../config.php";
	include "../../function.php";
	if(isset($_POST['eid']) && $_POST['eid']){
		$id=$_POST['eid'];
		$er=mysqli_fetch_assoc(mysqli_query($con,"select cash.id,client.name,ammount, narration,datee, reciptid, payby , bankname,cheque from cash join client on cash.cid=client.id where cash.id=$id"));
	}
?>

<link href="http://localhost/proaccounting/css/jquery-ui.css" rel="stylesheet" type="text/css">
<script  src="http://localhost/proaccounting/js/jquery.js"></script>
<script  src="http://localhost/proaccounting/js/jquery-ui.min.js"></script>

<script>
  $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $("#rdate").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#rdate").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate()+1);
        $("#MyDatepicker1").datepicker( "option", "minDate", minValue );
    });
});
});
  </script>

<form method="post" style="background-color:#0cf;margin-top:10px;">
	<?php
		if(isset($_POST['eid']) && $_POST['eid']){
		?>
        	<input type="hidden" name="id" value="<?php echo $_POST['eid'];?>">
        <?php	
		}
	?>
	<table border="1px" cellspacing="0" align="center" width="80%" height="500px;" >
    	<tr>
        	<th colspan="2">Recipt</th>
        </tr>
        <tr>
        	<td>Recipt No.</td>
            <?php
				$rno=mysqli_query($con,"select id,reciptid from cash order by reciptid desc limit 0,1");	
				if(mysqli_num_rows($rno)){
					$reno=mysqli_fetch_assoc($rno);
						$no=$reno['reciptid'];
						$no++;	
				}
				else{
					$no=1;	
				}
			?>
            <td><input type="text" value="<?php if(isset($er['reciptid']) && $er['reciptid']){echo $er['reciptid'];} else{ echo $no;}?>" name="reciptid"></td>
        </tr>
        <tr>
    
        	<td>Client Name</td>
            <?php
				if(isset($er['name']) && $er['name']){
					$id=$er['name'];
					$cname=mysqli_fetch_assoc(mysqli_query($con,"select id,name from client where name='$id'"));	
				}
			?>	
        	<td><input type="text" name="cid" value="<?php if(isset($er['name']) && $er['name']){echo $cname['name'];}?>" onClick="sclient()" id="cid"></td>
        </tr>
        <tr>
        	<td>Date</td>
           	<td><input id="rdate"  type="text" value="<?php if(isset($er['datee']) && $er['datee']){ echo $er['datee']; }?>"   name="datee"></td>
	        </tr>
        <tr>
        	<td>Payment By</td>
           	<td><input type="radio" value="cash" onClick="cbdte()" <?php if(isset($er['payby']) && $er['payby']=='cash'){ echo "checked";}?> name="payby">Cash
        <input type="radio" <?php if(isset($er['payby']) && $er['payby']=='cheque'){ echo "checked";}?> name="payby" onclick="bankdte()" maxlength="6" select value="cheque">Cheque
                <div id="bdte">
                	<?php
						if(isset($er['payby']) && $er['payby']=='cheque'){
							?>
                            	Bank Name:	<input type="text" value="<?php if(isset($er['bankname']) && $er['bankname']){echo $er['bankname'];}?>" name="bankname" >
								Cheque 	 :	<input type="text" value="<?php if(isset($er['cheque']) && $er['cheque']){echo $er['cheque'];}?>" name="cheque">
                            <?php	
						}
					?>
                </div>
            </td>
        </tr>
        <tr>
        	<td>Ammount</td>
           	<td><input type="text" value="<?php if(isset($er['ammount']) && $er['ammount']){echo $er['ammount'];}?>" name="ammount"></td>
        </tr>
        <tr>
        	<td>Narration</td>
            <td><textarea name="narration" style="width:530px;border:1px solid;border-radius:5px;"><?php if(isset($er['narration']) && $er['narration']){echo $er['narration'];}?>
            </textarea></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="submit" value="Recipt"></td>
        </tr>
    </table>
</form>