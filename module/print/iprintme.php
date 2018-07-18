<?php
	//echo "hi";exit;
session_start();
	include "../../config.php";
	include "../../function.php";
	if(isset($_GET['table']) && $_GET['id']){
        $du=$_GET['du'];
        unset($_GET['du']);
		$table=$_GET['table'];
		$id=$_GET['id'];
		$rdata=mysqli_fetch_assoc(mysqli_query($con,"select invoice.id,name,ronoid, rodatee, invoiceno, invoicedate, publicationcenter, publishdate, dealerpanel, rate , narration, pageprem, colorprem, otherprem, grossamt,download, discount, boxcharge, size, netamm, totamm from invoice join client on cid=client.id where invoice.id=$id"));
	
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

<div style="border:2px solid; padding:0px  10px 5px 10px; margin:0 auto; " >
<div onClick="window.print()" style="width:100%; text-align:center;"><img src="../../clogo/<?php echo $clogo;?>" height="231px" width="793px"><br><br>
<div style="border:1px solid; width:150px; padding-left:15px; float:left; font-size:20px;">Invoice</div>
<div style="float:left; margin-left:10px; float:left; width:200px;"><?php if($du=='yes'){
			echo"Duplicate";
			} else{
				echo "Orignal";	
			}?>
            </div>
<table width="120%" border="0px" style="margin:0 auto;margin-top:5px; " cellspacing="10px">
	<tr>
    	<td style="width:10%">Client:</td>
   		<td style="width:25%"><?php echo $rdata['name'];?></td>
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
<table border="1px" width="100%" cellspacing="0" style="margin:0 auto;margin-top:5px">
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td rowspan="2">Publishing Center</td>
        <td colspan="2">Size Of Add</td>
        <td rowspan="2">Dealer Pannel</td>
        <td colspan="4">Pricing</td>
        <td rowspan="2">Gross Amount</td>
        <td rowspan="2">Discount</td>
        <td rowspan="2">Trade Discount</td>
        <td rowspan="2">Net Amount</td>
    </tr>
    <tr>
    	<td>Height</td>
        <td>Width</td>
    	<td>Rate</td>
        <td>Page Prem.</td>
        <td>Color Prem.</td>
        <td>Other Prem.</td>
    </tr>
    <tr style="text-align:center;">
        <td><?php echo $rdata['publicationcenter'];?></td>
    	<td><?php echo $h;?></td>
        <td><?php echo $w;?></td>
    	<td><?php echo $rdata['dealerpanel'];?></td>
    	<td><?php echo $rdata['rate'];?></td>
    	<td><?php echo $rdata['pageprem'];?></td>
    	<td><?php echo $rdata['colorprem'];?></td>
    	<td><?php echo $rdata['otherprem'];?></td>
    	<td><?php echo $rdata['grossamt'];?></td>
    	<td><?php echo $rdata['discount'];?></td>
    	<td><?php echo $rdata['boxcharge'];?></td>
    	<td><?php echo $rdata['netamm'];?></td>	
    </tr>
    <tr>
    	<td colspan="13" style="padding-left:50%;"><div style="text-align:right; margin-right:100px;">Total Amount: <?php echo $rdata['totamm'];?></div></td>
    </tr>
    <tr valign="top"  style="text-align:left; padding-top:0px; height:50px;">
    	<td colspan="13"><u>Special Instruction: </u><br><div style="margin-left:80px"> <?php echo $rdata['narration'];?></div></td>
    </tr>
    <tr valign="top"  style="text-align:left; padding-top:0px; height:50px;">
    	<td colspan="13"><u>Notes: </u><br><div style=" font-size:10px;">
        	(1) Any Complaint aboout this invoice must be recived within 15 days from the date of the bill. (2) Please Quote our invoice no. while remitting the amount. (3) Intrest @18% per annum will be charged on overdue invoices. (4) All disputes subject to Bikaner Jurisdiction.
        </div></td>
    </tr>
</table>
</div>