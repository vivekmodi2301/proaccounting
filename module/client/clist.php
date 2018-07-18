<?php
	session_start();
	include "../../config.php";
	include "../../function.php";
	$id=$_SESSION['clogin']['id'];
	$wh="where 1 and coid=$id ";
	if(isset($_POST['wh']) && $_POST['wh']){
		$wh=stripslashes($_POST['wh']);
		//echo $wh;exit;	
		//echo "select id,name,address,obal,drcr from client $wh";exit;
	}
	if(isset($_POST['id']) && $_POST['id']){
		deleteDbRecord('client',$_POST['id']);	
	}
?>
 <form method="post">
<table border="1px" width="100%" cellspacing="0" style="margin-bottom:20px; margin-top:20px;">
	<tr>
    	<td colspan="2" style="background-color:red;">Search Clients</td>
    </tr>
    <tr>
    	<td>Name of Client</td>
    	<td><input type="text" name="keyword"></td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" value="Search"></td>
    </tr>
</table>
</form>




<table border="2px" width="100%" cellspacing="0">
	<tr>
    	<td colspan="5" style="background-color:red;">Clients List</td>
    </tr>
	<tr>
    	<td>S.No.</td>
        <td>Name</td>
        <td>Address</td>
        <td>Opening Balance</td>
        <td>Action</td>
    </tr>
    <tr>
    	<td colspan="5"><a href="#" onClick="cedit('')">Add New</a></td>
    </tr>
    <?php
		$cq=mysqli_query($con,"select id,name,address,obal,drcr from client $wh");
		$i=1;
		while($cdata=mysqli_fetch_assoc($cq)){
	?>
    	<tr>
        	<td><?php echo $i++;?></td>
        	<td><?php echo $cdata['name'];?></td>
            <td><?php echo $cdata['address'];?></td>
            <td><?php echo $cdata['obal'].$cdata['drcr'];?></td>
            <td><a href="#" onClick="cedit('<?php echo $cdata['id'];?>')">Edit</a> ||
             <a href="#" onClick="del('<?php echo $cdata['id'];?>')">Delete</a></td>
        </tr>
    <?php }?>
</table>