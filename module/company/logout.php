<?php
	if(isset($_SESSION['clogin'])){
		$id=$_SESSION['clogin']['id'];
		session_destroy();
?>
<script>
	if(confirm("Do you want to take backup")){
		location.href="backup.php?id=<?php echo $id;?>";
	}
	else{
		location.href="index.php";
	}
</script>
<?php }?>	