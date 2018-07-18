<?php
	session_start();
	include "../../config.php";
	include "../../function.php";
?>
<form method="post">
	<select name="cid">
    	<option value=""><-- Select Client Name --></option>
    	<?php
			$cq=mysqli_query($con,"select id,name,address from client");
			while($cdte=mysqli_fetch_assoc($cq)){
		?>
        	<option value="<?php echo $cdte['id'];?>"><?php echo $cdte['name'];?></option>
        <?php
			}
		?>
    </select>
</form>
