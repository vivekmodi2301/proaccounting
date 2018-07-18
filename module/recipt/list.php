<?php
	session_start();
	include "../../config.php";
	include "../../function.php";
	if(isset($_POST['wh']) && $_POST['wh']){
		$wh=stripslashes($_POST['wh']);
	}
	else{
		$id=$_SESSION['clogin']['id'];	
		$wh=" where 1 and cash.coid=$id";	
	}
	//echo "select cash.id,client.name,ammount, narration,datee, reciptid, payby , bankname,cheque from cash join client on cash.cid=client.id $wh";exit;
	$id=$_SESSION['clogin']['id'];
	if(isset($_POST['delid']) && $_POST['delid']){
		$id=$_POST['delid'];
		deleteDbRecord('cash',$id);	
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
        	<td>Client Name</td>
            <td>
            	<input type="text"  name="cid" id="cid" style="height:20px;"  onClick="sclient()">
            </td>
        </tr>
        <tr>
        	<td>Recipt No.</td>
            <td><input type="text" name="reciptno"></td>
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
    	<td>Recipt No.</td>
    	<td>Client Name</td>
    	<td>Pay by</td>
    	<td>Bank Name</td>
        <td>Cheque No.</td>
    	<td>Ammount</td>
    	<td>Action</td>
    </tr>
    <tr>
    	<td colspan="9"><a href="#" onClick="recipt('')">Add New</a></td>
    </tr>
    	<?php
		$id=$_SESSION['clogin']['id'];
		$i=1;
			$r=mysqli_query($con,"select cash.id,client.name,ammount, narration,datee, reciptid, payby , bankname,cheque from cash join client on cash.cid=client.id $wh");
			while($reciptdte=mysqli_fetch_assoc($r)){
			?>
            	<tr>
                	<td><?php echo $i++;?></td>
                	<td><?php echo $reciptdte['datee'];?></td>
                	<td><?php echo $reciptdte['reciptid'];?></td>
                	<td><?php echo $reciptdte['name'];?></td>
                	<td><?php echo $reciptdte['payby'];?></td>
                	<td><?php echo $reciptdte['bankname'];?></td>
                	<td><?php echo $reciptdte['cheque'];?></td>
                	<td><?php echo $reciptdte['ammount'];?></td>
                	<td><a href="#" onClick="recipt('<?php echo $reciptdte[id];?>')">Edit </a>|| <a href="#" onClick="del4('<?php echo $reciptdte['id'];?>')">Delete </a>|| <a href="module/print/reciptprint.php?id=<?php echo $reciptdte['id'];?>" >Print </a></td>
                </tr>
            <?php		
			}
		?>
    </tr>
</table>