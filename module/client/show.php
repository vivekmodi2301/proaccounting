<?php
	session_start();
	$id=$_SESSION['clogin']['id'];
	include "../../config.php";
	include "../../function.php";
?>
<table>
<?php
	$rs=mysqli_query($con,"select id,name from client where coid=$id");
	while($cdata=mysqli_fetch_assoc($rs)){
	?>
    	<tr><td onClick="seclient('<?php echo $cdata['name'];?>')" ><?php echo $cdata['name'];?></td></tr>
    <?php
	}
?>
</table>
