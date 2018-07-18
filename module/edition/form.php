<?php
include "../../config.php";
include "../../function.php";
//error_reporting(0);
if(isset($_POST['name']) && $_POST['name']){
	$id=$_POST['name'];
	$name=mysqli_fetch_assoc(mysqli_query($con,"select id,name,obal,drcr from edition where id=$id"));
	//print_r($name);
}
?>
<form method="post">
	<?php
		if(isset($_POST['name']) && $_POST['name']){
			?>
		<input type="hidden" name="eid" value="<?php echo $name['id'];?>">
        <?php
		}
	?>
	<table border="1px" align="center" width="50%" cellspacing="0">
    	<tr>
        	<td colspan="2" style="background-color:red; font-size:20px;">Add/Edit Form Of Media</td>
        </tr>
    	<tr>
        	<td>Name</td>
            <td><input type="text"  <?php if(isset($_POST['name']) && $_POST['name']){ ?> value="<?php echo $name['name'];}?>" name="medianame"></td>
        </tr>
        <tr>
        	<td>Opening Balance</td>
            <td><input type="text" <?php if(isset($_POST['name']) && $_POST['name']){ ?> value="<?php echo $name['obal'];?>"<?php }?> name="obal" ></td>
        </tr>
        
        <tr>
        	<td>Balance</td>
            <td>
            	<select name="drcr">
                	<option <?php if(isset($_POST['name']) && $_POST['name'] && $name['drcr']=='dr'){echo "selected";}?> value="dr">DR</option>
                    <option <?php if(isset($_POST['name']) && $_POST['name'] && $name['drcr']=='cr'){echo "selected";}?> value="cr">CR</option>
                </select>
            </td>
        </tr>
        <tr>
        	<td colspan="2"><input type="submit" value="Submit"></td>
        </tr>
    </table>
</form>