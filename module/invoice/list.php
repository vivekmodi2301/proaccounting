<?php
	session_start();
	include "../../config.php";
	include "../../function.php";
	if(isset($_POST['wh']) && $_POST['wh']){
		$wh=stripslashes($_POST['wh']);
	}
	else{
		$id=$_SESSION['clogin']['id'];	
		$wh=" where 1 and releaseorder.coid=$id";	
	}
	//echo "select releaseorder.id,name,rono,rodatee,ammount,publishdate from releaseorder join client on cid=client.id $wh";exit;
	if(isset($_POST['delid']) && $_POST['delid']){
		$id=$_POST['delid'];
		//echo $id;exit;
		$cancel['status']="cancel";
		addEdit('releaseorder',$cancel,$id);
	}
	$id=$_SESSION['clogin']['id'];
	//echo "select releaseorder.id,name,rono,rodatee,ammount,publishdate,status from releaseorder join client on cid=client.id $wh and status!='cancel'";
?>
<form method="post">
	<table border="1px" width="100%" cellspacing="0" style="margin:20px 0;">
    	<tr style="background-color:red;">
        	<td colspan="2">Search in Release Orders</td>
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
        	<td>Recipt No.</td>
            <td><input type="text" name="reno"></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="submit" value="Search"></td>
        </tr>
    </table>
</form>
<table border="1px" width="100%" cellspacing="0">
	<tr style="background-color:red;">
    	<td colspan="8">List of Releaseorders</td>
    </tr>
	<tr>
    	<td>S.No.</td>
        <td>Date</td>
        <td>Release Order No.</td>
    	<td>Client Name</td>
        <td>Publish Date</td>
        <td>Ammount</td>
        <td>Make Invoice</td>
        <td>Action</td>
    </tr>
    <tr>
    	<td colspan="8"><a href="#" style="text-align:right;" onClick="invoice('')">Add New</a></td>
    </tr>
    <?php
	$i=1;
	$rrs=mysqli_query($con,"select releaseorder.id,name,rono,rodatee,ammount,publishdate,status from releaseorder join client on cid=client.id $wh and status!='cancel' ");
	while($rdata=mysqli_fetch_assoc($rrs)){
		
?>
	<tr>
    	<td><?php echo $i++;?></td>
        <td><?php echo $rdata['rodatee'];?></td>
        <td><?php echo $rdata['rono'];?></td>
    	<td><?php echo $rdata['name'];?></td>
        <td><?php echo $rdata['publishdate'];?></td>
        <td><?php echo $rdata['ammount'];?></td>
        <?php
			if(!mysqli_num_rows(mysqli_query($con,"select ronoid from invoice where ronoid='$rdata[rono]' and coid=$id"))){
		?>
        <td><a href="#" onClick="release('<?php echo $rdata['id'];?>','','')">Make Invoice</a></td>
        <?php } else{ echo "<td>-</td>";}?>
        <td><a href="#" style="text-align:right;" onClick="invoice('<?php echo $rdata[id];?>')">Edit</a> || 
        <a href="#" onClick="del1('<?php echo $rdata[id];?>','')">Cancel</a> || <a href="#" onClick="printme('releaseorder','<?php echo $rdata[id];?>')">Print Releaseorder</a> 
        </td>
    </tr>
<?php }?>
</table>