<?php
		@session_start();
		$id=$_SESSION['clogin']['id'];
		include "../../config.php";
		include "../../function.php";
		if(isset($_POST['fdatee'])){
			$fdatee=$_POST['fdatee'];
			$tdatee=$_POST['tdatee'];
		}
?>
<input type="button" value="Print" onclick="suprintout()">
<table border="1px" cellspacing="0" width="100%">
<tr>
	<td>S.No.</td>
	<td>Recipt No.</td>
	<td>Bank Name</td>
	<td>Cheque No.</td>
	<td>Client Name</td>
	<td>Date</td>
    <td colspan="2">Ammount</td>
</tr>
<?php
	$i=1;
	$crs=mysqli_query($con," select cash.id,cid,ammount,reciptid,datee,payby,bankname,cheque from cash where coid=$id and  datee BETWEEN '$fdatee' AND '$tdatee' order by datee ");
	//echo " select cash.id,cid,ammount,reciptid,datee,payby,bankname,cheque from cash where coid=$id and  datee BETWEEN '$fdatee' AND '$tdatee' order by datee ";
	//echo "select cash.id,client.name,ammount,reciptid,payby,bankname,cheque from cash join client on cid=cash.id";
	//print_r($crs);
	while($cdata=mysqli_fetch_assoc($crs)){
?>
<tr>
	<td><?php echo $i++;?></td>
	<td><?php echo $cdata['reciptid'];?></td>
	<td><?php if($cdata['bankname']){ echo $cdata['bankname'];} else{ echo "-";}?></td>
	<td><?php if($cdata['cheque']){ echo $cdata['cheque']; } else{ echo "-";}?> </td>
	<td><?php $cname=mysqli_fetch_assoc(mysqli_query($con,"select name from client where id=$cdata[cid]"));
	echo $cname['name']; ?></td>
	<td><?php echo $cdata['datee'];?></td>
	<td><?php echo $cdata['ammount'];?></td>
</tr>
	<?php }?>
</table>
<script>
	function suprintout(){
		window.print();
	}
</script>