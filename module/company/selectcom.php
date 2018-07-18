<?php
if(isset($_POST['username'])){
//$un=$_POST['username'];
//echo "un"; exit;
//print_r($_POST); exit;
$lrs=mysqli_query($con,"SELECT id,email,password FROM company WHERE email='$_POST[username]'");
//echo "select id,email,password from company where email='$_POST[username]'"; exit;
$linfo=mysqli_fetch_assoc($lrs);

	if(mysqli_num_rows($lrs)>0 && $linfo['password']==$_POST['password'])
	{
		$_SESSION['clogin']=$linfo;
		?>
		<script>
			location.href="index.php?mod=home&do=current";
		</script>
		<?php
		}
		else
		{
			$_SESSION['emsg']=$linfo['id'];
			
			}
}
?>
<div id="login">
<div class="mn">
<table width="100%" style=" margin-left:0px; font-size:18px; border:2px solid #009">
<tr>
    <th class="lst" colspan="4">List Of Company</th>
</tr>
<tr>
	<th width="250px">S.No</th>
    <th width="250px">Name</th>
    <th width="250px">Bokks Start From</th>
    <th width="250px">Login</th>
</tr>
<?php
$i=1;
$rs=mysqli_query($con,"select id,name,astart from company");
while($data=mysqli_fetch_assoc($rs)){
?>
<tr>
	<td width="250px"><?php echo $i++;?></td>
    <td width="250px"><?php echo $data['name'];?></td>
    <td width="250px"><?php echo $data['astart'];?></td>
    <td><input type="submit" onClick="login('<?php echo $data['id'];?>')" value="Login"></td>
</tr>    
<?php } ?>
</table>
</div>
</div>
</div>
<script>
	function login(id){
		$.ajax({
			url:"module/company/login.php",
			data:"cid="+id,
			type:'POST',
			success: function(e){
				$('#login').html(e);	
			}
		});
	}
</script>

<?php
	if(isset($_SESSION['emsg'])){
	?>
    	<script>
			login('<?php echo $_SESSION['emsg'];?>');
		</script>
    <?php	
	}
?>