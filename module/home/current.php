<?php
	if(isset($_SESSION['clogin'])){
		//echo "hi";
		//print_r($_SESSION['clogin']);	
		$id=$_SESSION['clogin']['id'];
		$cinfo=mysqli_fetch_assoc(mysqli_query($con,"SELECT name,logo FROM `company` WHERE id=$id"));
		?>
        	<img src="clogo/<?php echo $cinfo['logo'];?>">
        	<h1><?php echo "Welcome ".strtoupper($cinfo['name']);?></h1>
        <?php
	}
?>
</div>
</div>