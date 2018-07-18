<?php
session_start();
	include "../../config.php";
	include "../../function.php";
	if(isset($_GET['table']) && $_GET['id']){
		$table=$_GET['table'];
		$id=$_GET['id'];
		$rdata=mysqli_fetch_assoc(mysqli_query($con,"select invoice.id,name,ronoid, rodatee, invoiceno, invoicedate, publicationcenter, publishdate, dealerpanel, rate , narration, pageprem, colorprem, otherprem, grossamt, discount, boxcharge, size, netamm, totamm from invoice join client on cid=client.id where invoice.id=$id"));
	
		if(isset($rdata['size']) && $rdata['size']){
			$pos=strrpos($rdata['size'],'*');
			$h=substr($rdata['size'],0,$pos);
			$w=substr($rdata['size'],$pos+1);
		}
	
	}
?>
<?php
$id=$_SESSION['clogin']['id'];
	$clogo=mysqli_fetch_assoc(mysqli_query($con,"select logo from company where id=$id"));
	$clogo=$clogo['logo'];
?>

<div style="border:2px solid; padding:10px 10px;">
<div onClick="window.print()" style="width:100%; text-align:center;"><img src="../../clogo/<?php echo $clogo;?>" height="100px" width="600px">
<div style="border:1px solid; width:150px; padding-left:15px; font-size:20px;">Invoice</div>
<table width="77%" border="0px" style="margin:0 auto;margin-top:5px; " cellspacing="10px">
	<tr>
    	<td style="width:10%">Client:</td>
   		<td style="width:20%"><?php echo $rdata['name'];?></td>
        <td style="width:10%">Invoice NO:</td>
        <td style="width:20%"><?php echo $rdata['invoiceno'];?></td>
        <td style="width:10%">Invoice Date:</td>
        <td style="width:30%"><?php echo $rdata['invoicedate'];?></td>
    </tr><tr style="margin-top:5px;">
    	<td style="width:10%">R.O. No.:</td>
   		<td style="width:20%"><?php echo $rdata['ronoid'];?></td>
        <td style="width:10%">R.O. Date:</td>
        <td style="width:20%"><?php echo $rdata['rodatee'];?></td>
        <td rowspan="2">Publish Date</td>
    	<td><?php echo $rdata['publishdate'];?></td>
        </tr>
    </tr>
</table>
<table border="1px" width="77%" cellspacing="0" style=" margin:0 auto; margin-top:5px;">
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td style="width:65%">Publishing Center</td>
    	<td style="text-align:center;"><?php echo $rdata['publicationcenter'];?></td>    
    </tr>
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td>Size Of Add</td>
        <td style="text-align:center;"><?php echo $h."*".$w;?></td>
    </tr>
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td>Dealer Pannel</td>
        <td style="text-align:center;"><?php echo $rdata['dealerpanel'];?></td>
    </tr>
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td>Rate</td>
        <td style="text-align:center;"><?php echo $rdata['rate'];?></td>
    </tr>
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td>Page Prem.</td>
        <td style="text-align:center;"><?php echo $rdata['pageprem'];?></td>
    </tr>
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td>Color Prem.</td>
        <td style="text-align:center;"><?php echo $rdata['colorprem'];?></td>
    </tr>
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td>Other Prem.</td>
        <td style="text-align:center;"><?php echo $rdata['otherprem'];?></td>
    </tr>
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td>Gross Amount</td>
        <td style="text-align:center;"><?php echo $rdata['grossamt'];?></td>
    </tr>
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td>Discount</td>
        <td style="text-align:center;"><?php echo $rdata['discount'];?></td>
    </tr>
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td>Box Charges</td>
        <td style="text-align:center;"><?php echo $rdata['boxcharge'];?></td>
    </tr>
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td>Net Amount</td>
        <td style="text-align:center;"><?php echo $rdata['netamm'];?></td>
    </tr>
    <tr>
    	<td colspan="13" style="padding-left:50%;"><div style="text-align:right; margin-right:100px;">Total Ammount: <?php echo $rdata['totamm'];?></div></td>
    </tr>
    <tr valign="top"  style="text-align:left; padding-top:0px; height:50px;">
    	<td colspan="13"><u>Special Instruction: </u><br><div style="margin-left:80px"> <?php echo $rdata['narration'];?></div></td>
    </tr>
    <tr valign="top"  style="text-align:left; padding-top:0px; height:50px;">
    	<td colspan="13"><u>Notes: </u><br><div style=" font-size:10px;">
        	(1) Any Complaint aboout this invoice must be recived within 15 days from the date of the bill. (2) Please Quote our invoice no. while remitting the ammount. (3) Intrest @18% per annum will be charged on overdue invoices. (4) All disputes subject to Bikaner Jurisdiction.
        </div></td>
    </tr>
</table>
</div>