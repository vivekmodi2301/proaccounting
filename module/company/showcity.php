<?php
	require "../../config.php";
	require "../../function.php";
	if(isset($_POST['stateid'])){
		$c=mysqli_query($con,"select id,city from city where stateid=$_POST[stateid] order by city asc");
	?>
    	<option><-- Select City --></option>
    <?php	
		while($city=mysqli_fetch_assoc($c)){
		?>
    	<option value="<?php echo $city['id'];?>"><?php echo $city['city'];?></option>
        <?php	
		}
	}
?>