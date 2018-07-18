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
	if(isset($_POST['delid'])){
		$id=$_POST['delid'];
		//echo $id;exit;
		$cancel['status']="cancel";
		addEdit('releaseorder',$cancel,$id);
	}
	$id=$_SESSION['clogin']['id'];
	//echo "select releaseorder.id,name,rono,rodatee,ammount,publishdate,status from releaseorder join client on cid=client.id $wh and status!='cancel'";
?>
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
    </tr>
    <?php
	$i=1;
	$rrs=mysqli_query($con,"select releaseorder.id,name,rono,rodatee,ammount,publishdate,status from releaseorder join client on cid=client.id $wh and status='cancel' ");
	while($rdata=mysqli_fetch_assoc($rrs)){
		
?>
	<tr>
    	<td><?php echo $i++;?></td>
        <td><?php echo $rdata['rodatee'];?></td>
        <td><?php echo $rdata['rono'];?></td>
    	<td><?php echo $rdata['name'];?></td>
        <td><?php echo $rdata['publishdate'];?></td>
        <td><?php echo $rdata['ammount'];?></td>
    </tr>
<?php }?>
</table>