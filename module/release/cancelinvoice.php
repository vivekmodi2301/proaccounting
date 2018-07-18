<?php
	session_start();
	include "../../config.php";
	include "../../function.php";
	if(isset($_POST['wh']) && $_POST['wh']){
		$wh=stripslashes($_POST['wh']);
	}
	else{
		$id=$_SESSION['clogin']['id'];	
		$wh=" where 1 and invoice.coid=$id";	
	}
	$id=$_SESSION['clogin']['id'];
	//echo "select invoice.id,name,ronoid,rodatee,invoiceno, invoicedate,size,totamm from invoice join client on cid=client.id  $wh";
?>
<table border="1px" width="100%">
	<tr style="background-color:red; font-size:20px;">
    	<td colspan="10">Invoice List</td>
    </tr>
	<tr>
    	<td>S.No.</td>
    	<td>Client Name</td>
    	<td>Release Order No.</td>
        <td>Release Order Date</td>
    	<td>Invoice No.</td>
        <td>Invoice Date</td>
        <td>Size</td>
    	<td>Ammount</td>
    </tr>
   	<?php
	$id=$_SESSION['clogin']['id'];
			$i=1;
			$rs=mysqli_query($con,"select invoice.id,name,ronoid,rodatee,invoiceno, invoicedate,size,totamm from invoice join client on cid=client.id  $wh and status='cancel'");
			while($idata=mysqli_fetch_assoc($rs)){
			?>
            	<tr>
          			<td><?php echo $i++;?></td>
                    <td><?php echo $idata['name'];?></td>
                    <td><?php echo $idata['ronoid'];?></td>
                    <td><?php echo $idata['rodatee'];?></td>
                    <td><?php echo $idata['invoiceno'];?></td>
                    <td><?php echo $idata['invoicedate'];?></td>
                    <td><?php echo $idata['size'];?></td>
                    <td><?php echo $idata['totamm'];?></td>
                </tr>
            <?php	
			}
		?>
</table>