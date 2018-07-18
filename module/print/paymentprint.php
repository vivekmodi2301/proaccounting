<?php
session_start();
	include "../../config.php";
	include "../../function.php";
	if(isset($_GET['id']) && $_GET['id']){
		//echo "hi";exit;
		$id=$_GET['id'];
		$reciptdata=mysqli_fetch_assoc(mysqli_query($con,"select payment.id,name,ammount,datee,  paymentid,payby,bankname,cheque,narration from payment join edition on eid=edition.id where      payment.id=$id"));
	}
	//print_r($reciptdata);exit;
	$id=$_SESSION['clogin']['id'];
	$clogo=mysqli_fetch_assoc(mysqli_query($con,"select logo from company where id=$id"));
	$clogo=$clogo['logo'];
?>

<div style="border:2px solid; padding:10px 10px;">
<div onClick="window.print()" style="width:100%; text-align:center;"><img src="../../clogo/<?php echo $clogo;?>" height="100px" width="600px">
<div style="border:1px solid; width:150px; padding-left:15px; font-size:20px;">Payment</div>
<table border="1px" width="100%" cellspacing="0" style=" margin-top:5px">
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td >Recipt No.</td>
        <td >Date</td>
    	<td >Client Name</td>
        <td >Cash/Cheque</td>
        <td >Ammount</td>
    </tr>
    <tr style="text-align:center;">
    	<td><?php echo $reciptdata['paymentid'];?></td>
    	<td><?php echo $reciptdata['datee'];?></td>
    	<td><?php echo $reciptdata['name'];?></td>
        <td><?php if($reciptdata['payby']=='cash'){echo "Cash";} else{ echo  $reciptdata['payby']."<br>Bank Name- ".$reciptdata['bankname']."<br> Cheque No.-".$reciptdata['cheque'];}?></td>
    	<td><?php echo $reciptdata['ammount'];?></td>
    </tr>
    <tr>
    	<td colspan="13" style="padding-left:50%;"><div style="text-align:right; margin-right:100px;">Total Ammount: <?php echo $reciptdata['ammount'];?></div></td>
    </tr>
    <tr valign="top"  style="text-align:left; padding-top:0px; height:50px;">
    	<td colspan="13"><u>Special Instruction: </u><br><div style="margin-left:80px"> <?php echo $reciptdata['narration'];?></div></td>
    </tr>
</table>
</div>