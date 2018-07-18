<?php
	session_start();
	include "../../config.php";
	include "../../function.php";
	
	$id=$_SESSION['clogin']['id'];
	if(isset($_POST['did'])){
		$id=$_POST['did'];
		deleteDbRecord('edition',$id);
		?>
        <script>
        	media();
		</script>
        <?php	
	}	
?>
<table border="1px" width="100%" cellspacing="0">
	<tr>
    	<td colspan="4" style="background-color:red; font-size:20px;">Media List</td>
    </tr>
	<tr>
    	<td>S.No.</td>
        <td>Name</td>
        <td>Opening Balnace</td>
        <td>Action</td>
    </tr>
    <tr>
    	<td colspan="4"><a href="#" onClick="showform('')">Add New</a></td>
    </tr>
    <?php
		$edition=mysqli_query($con,"select id,name,obal,drcr from edition where coid=$id");
		//echo "select id,name,obal,drcr from edition where coid=$id";
		$i=1;
		while($editiondte=mysqli_fetch_assoc($edition)){
			extract($editiondte);
			if(!$obal){
				$obal=0;	
			}
	?>
    <tr>
    	<td><?php echo $i++;?></td>
        <td><?php echo $name;?></td>
        <td><?php echo $obal." ".$drcr;?></td>
        <td><a href="#" onClick="showform('<?php echo $id;?>')">Edit</a>|| <a href="#" onClick="deletemedia('<?php echo $id;?>')">Delete</a></td>
    </tr>
    <?php
		}
	?>
</table>
<div id="form" style="margin-top:20px"></div>