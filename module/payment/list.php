<?php
	session_start();	
	include "../../config.php";
	include "../../function.php";
	if(isset($_POST['wh']) && $_POST['wh']){
		$wh=stripslashes($_POST['wh']);
	}
	else{
		$id=$_SESSION['clogin']['id'];	
		$wh=" where 1 and payment.coid=$id";	
	}
	//echo "select payment.id,edition.name,ammount, narration,datee, paymentid, payby , bankname,cheque from payment join edition on payment.eid=edition.id $wh";exit;
	if(isset($_POST['delid']) && $_POST['delid']){
		$id=$_POST['delid'];
		deleteDbRecord('payment',$id);	
	}
?>

<form method="post">
	<table border="1px" width="100%" cellspacing="0" style="margin:20px 0;">
    	<tr style="background-color:red; font-size:20px;">
        	<td colspan="2">Search in Invoice</td>
        </tr>
        <tr>
        	<td>Date</td>
            <td><input type="date" name="from">&nbsp;&nbsp;&nbsp;<input type="date" name="to"></td>
        </tr>
        <tr>
        	<td>Media Name</td>
            <td>
            	<select name="ed">
                	<option value=""><-- Select Media Name --></option>
                    <?php
						$e=mysqli_query($con,"select id,name from edition");
						while($edte=mysqli_fetch_assoc($e)){
						?>
                        	<option value="<?php echo $edte['id'];?>"><?php echo $edte['name'];?></option>
                        <?php	
						}
					?>
                </select>
            </td>
        </tr>
        <tr>
        	<td>Payment No.</td>
            <td><input type="text" name="paymentno"></td>
        </tr>
        <tr>
        	<td>Cheque No.</td>
            <td><input type="text" name="chno"></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="submit" value="Search"></td>
        </tr>
    </table>
</form>
<table border="1px" width="100%" cellspacing="0">
	<tr style="background-color:red; font-size:20px;">
    	<td colspan="9">Recipt List</td>
    </tr>
    <tr>
    	<td>S.No.</td>
    	<td>Date</td>
    	<td>Payment No.</td>
    	<td>Media Name</td>
    	<td>Pay by</td>
    	<td>Bank Name</td>
        <td>Cheque No.</td>
    	<td>Ammount</td>
    	<td>Action</td>
    </tr>
    <tr>
    	<td colspan="9"><a href="#" onClick="pay('')">Add New</a></td>
    </tr>
    	<?php
		$i=1;
		$r=mysqli_query($con,"select payment.id,edition.name,ammount, narration,datee, paymentid, payby , bankname,cheque from payment join edition on payment.eid=edition.id $wh");
			while($reciptdte=mysqli_fetch_assoc($r)){
			?>
            	<tr>
                	<td><?php echo $i++;?></td>
                	<td><?php echo $reciptdte['datee'];?></td>
                	<td><?php echo $reciptdte['paymentid'];?></td>
                	<td><?php echo $reciptdte['name'];?></td>
                	<td><?php echo $reciptdte['payby'];?></td>
                	<td><?php echo $reciptdte['bankname'];?></td>
                	<td><?php echo $reciptdte['cheque'];?></td>
                	<td><?php echo $reciptdte['ammount'];?></td>
                	<td><a href="#" onClick="pay('<?php echo $reciptdte[id];?>')">Edit </a>|| <a href="#" onClick="del5('<?php echo $reciptdte['id'];?>')">Delete</a> || <a href="module/print/paymentprint.php?id=<?php echo $reciptdte['id'];?>">Print</a></td>
                </tr>
            <?php		
			}
		?>
    </tr>
</table>