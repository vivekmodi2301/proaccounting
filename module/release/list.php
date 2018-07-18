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
        	<td>Client Name</td>
            <td>
            	<input type="text"  name="cid" id="cid" style="height:20px;"  onClick="sclient()">
            </td>
        </tr>
        <tr>
        	<td>Invoice No.</td>
            <td><input type="text" name="ino"></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="submit" value="Search"></td>
        </tr>
    </table>
</form>

<table border="1px" width="100%">
	<tr style="background-color:red; font-size:20px;">
    	<td colspan="13">Invoice List</td>
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
        <td>Orignal Old Print</td>
        <td>Duplicate Old Print</td>
        <td>Orignal New Print</td>
	    <td>Duplicate New Print</td>
        <td>Action</td>
    </tr>
    <tr>
    	<td colspan="13">Add New</td>
    </tr>
    	<?php
	$id=$_SESSION['clogin']['id'];
			$i=1;
			$rs=mysqli_query($con,"select invoice.id,name,ronoid,rodatee,invoiceno, invoicedate,size,totamm from invoice join client on cid=client.id  $wh and status!='cancel'");
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
                    <td><a href="#" onClick="iprint('invoice','<?php echo $idata['id'];?>')">Print</a></td>
                    <td><a href="#" onClick="duiprint('invoice','<?php echo $idata['id'];?>')">Print</a></td>
                    <td><a href="#" onClick="niprint('invoice','<?php echo $idata['id'];?>')">Print</a></td>
                    <td><a href="#" onClick="duniprint('invoice','<?php echo $idata['id'];?>')">Print</a></td>
                    <td><a href="#" onClick="release('','<?php echo $idata['id'];?>','')">Edit</a> || <a href="#" onClick="del2('<?php echo $idata[id];?>')">Cancel</a></td>
                </tr>
            <?php
			}
		?>
</table>
