<?php
	session_start();
	include "../../config.php";
	include "../../function.php";
	if(isset($_POST['id']) && $_POST['id']){
		$cdte=mysqli_fetch_assoc(mysqli_query($con,"select id,name,address,obal,gst,drcr from client where id=$_POST[id]"));
	}
?>
<form method="post"><br><br>
	<?php
		if(isset($_POST['id']) && $_POST['id']){
	?>
    <input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
    <?php }?>
	Name:<input type="text" value="<?php if(isset($cdte['name']) && $cdte['name']){ echo $cdte['name'];}?>" name="name"><br><br>
    Address:<textarea style="color:#000;" name="address"><?php if(isset($cdte['address']) && $cdte['address']){ echo $cdte['address'];}?></textarea><br><br>
    Opening Balance:<input type="text" name="obal" value="<?php if(isset($cdte['obal']) && $cdte['obal']){ echo $cdte['obal'];}?>">
    <select name="drcr" style="width:50px; color:#000;">
    	<option <?php if(isset($cdte['drcr']) && $cdte['drcr']=='dr'){ echo "selected";}?> value="dr">DR</option>
    	<option <?php if(isset($cdte['drcr']) && $cdte['drcr']=='cr'){ echo "selected";}?> value="cr">CR</option>
    </select><br><br>
    GST No.(If Applicable):<input type="text" value="<?php if(isset($cdte['gst']) && $cdte['gst']){ echo $cdte['gst'];}?>" name="gst"><br><br>
    <input type="submit" value="Submit">
</form>