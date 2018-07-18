<?php
session_start();
	include "../../config.php";
	include "../../function.php";
    $coid=$_SESSION['clogin']['id'];
    $sign=mysqli_fetch_assoc(mysqli_query($con,"select signname from company where id=$coid"));
    //print_r($sign);
	if(isset($_GET['table']) && $_GET['id']){
        $du=$_GET['du'];
		$table=$_GET['table'];
		$id=$_GET['id'];
		$rdata=mysqli_fetch_assoc(mysqli_query($con,"select invoice.id,name,ronoid, rodatee, invoiceno, invoicedate, publicationcenter, publishdate, dealerpanel, rate , narration, pageprem, colorprem, otherprem, grossamt,download, discount, boxcharge, size, netamm,caption, totamm,cgst,sgst,word_amm,publish,adfor,total_publish,tax_amm,gst from invoice join client on cid=client.id where invoice.id=$id"));
	
			$rd['download']=1;
			$id=$_GET['id'];
			addEdit('invoice',$rd,$id);
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
<table width="100%" border="0px" style="margin:0 auto;margin-top:5px; " cellspacing="10px">
	<tr>
    	<td style="width:10%">Invoice No.</td>
        <td style="width:50%"><?php echo $rdata['invoiceno'];?></td>
        <td style="width:10%">Clinet Name</td>
        <td style="width:30%">
            <?php echo $rdata['name'];?>(
            <?php echo $rdata['gst'];?>
            )</td>
    </tr>
    <tr>
        <td>Date of Invoice</td>
        <td><?php echo $rdata['invoicedate'];?></td>
        <td>AD for</td>
        <td><?php echo $rdata['adfor'];?></td>
    </tr>
</table>
    <table width="100%" border="0px" style="margin:0 auto;margin-top:5px; " cellspacing="10px">
    <tr style="margin-top:5px;">
    	<td style="width:10%">R.O. No.:</td>
   		<td style="width:20%"><?php echo $rdata['ronoid'];?></td>
        <td style="width:10%">R.O. Date:</td>
        <td style="width:19.3%"><?php echo $rdata['rodatee'];?></td>
        <td width="10%">Caption</td>
    	<td><?php echo $rdata['caption'];?></td>
        </tr>
    </tr>
</table>
<table border="1px" width="100%" cellspacing="0" style="margin:0 auto;margin-top:5px">
    <tr valign="top" style="height:50px; padding-top:10px;">
    	<td >Publishing Center</td>
        <td >Publish Date</td>
        <td >Qty.(Ad size in CM)</td>
        <td >Rate Per Item</td>
        <td >Premium</td>
        <td >Discount</td>
        <td >Gross Amount</td> 
        <td >Trade Discount</td>
        <td >Taxable Amount</td>
        <td>CGST</td>
        <td>SGST</td>
    </tr>
    <tr style="text-align:center;">
        <td><?php echo $rdata['publicationcenter'];?></td>
    	<td><?php $dates=explode(',',$rdata['total_publish']);
            foreach($dates as $dates){
            echo $dates."<br>";
        }?>
        </td>
        <td><?php echo $h."*".$w;?></td>
    	<td><?php echo $rdata['rate'];?></td>
    	<td><?php echo $rdata['otherprem'];?></td>
    	<td><?php echo $rdata['discount'];?></td>
    	<td><?php echo $rdata['grossamt'];?></td>
    	<td><?php echo $rdata['boxcharge'];?></td>
    	<td><?php echo $rdata['tax_amm'];?></td>
    	<td><?php echo $rdata['cgst'];?></td>
    	<td><?php echo $rdata['sgst'];?></td>	
    </tr>
    <tr>
        <td colspan="3" >Total Invoice Value(In Figure)<br>
            Total Invoice Value(In Words)
        </td>
        <td  colspan="8">INR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rdata['netamm'];?><br>
        Ruppes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $rdata['word_amm'];?>
        </td>
    </tr>

    <tr >
        <td colspan="3" >
        </td>
        <td  colspan="8">
            <div style="float:right; padding:100px 50px 0 50px; ">
                <?php echo $sign['signname']; ?>
            </div>
        </td>
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