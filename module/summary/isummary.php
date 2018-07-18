<?php
		@session_start();
		//print_r($_SESSION);
		$coid=$_SESSION['clogin']['id'];
		include_once("../../config.php");
		include_once("../../function.php");
		extract($_POST);
?>
<input type="button" value="Print" onclick="suprintout()">
<table border="1px" cellspacing="0" width="100%">
<tr>
	<td>S.No.</td>
	<td>Invoice No.</td>
	<td>Client Name</td>
	<td>Date</td>
	<td>Taxable Amount</td>
	<td>CGST</td>
	<td>SGST</td>
    <td colspan="2">Net Amount</td>
</tr>
<?php
	print_r($_POST);
	//$cid="";
	$cid=$_POST['client'];
	if($cid){
		$invoice_rs=mysqli_query($con,"select invoiceno,invoice.id,invoicedate,netamm,client.name,cgst,sgst,tax_amm from invoice join client on cid=client.id where invoice.coid=$coid and invoicedate between '$fdatee' and '$tdatee' and cid=$cid order by invoice.id");
	}else{
		$invoice_rs=mysqli_query($con,"select invoiceno,invoice.id,invoicedate,netamm,client.name,cgst,sgst,tax_amm from invoice join client on cid=client.id where invoice.coid=$coid and invoicedate between '$fdatee' and '$tdatee' order by invoice.id");
	}
	//echo "select invoiceno,invoice.id,invoicedate,netamm,client.name from invoice join client on cid=client.id where invoice.coid=$coid and invoicedate between '$fdatee' and '$tdatee'";
	$sno=1;
	while($invoice_data=mysqli_fetch_assoc($invoice_rs)){
		?>
	<tr>
		<td><?php echo $sno++;?></td>
		<td><?php echo $invoice_data['invoiceno'];?></td>
		<td><?php echo $invoice_data['name'];?></td>
		<td><?php echo $invoice_data['invoicedate'];?></td>
		<td><?php echo $invoice_data['tax_amm'];?></td>
		<td><?php echo $invoice_data['cgst'];?></td>
		<td><?php echo $invoice_data['sgst'];?></td>
	    <td colspan="2"><?php echo $invoice_data['netamm'];?></td>
	</tr>				
		<?php
	}
?>
