<ul>
<?php
$nm=$_GET['name'];
$con=mysqli_connect('localhost','root','','onlineexam');
$rs=mysqli_query($con,"select id,name from signup where name like '$nm%'");
while($data=mysqli_fetch_assoc($rs)){
?>
<li onclick="t1.value='<?php echo $data['name'];?>';
result.style.display='none';">
	<b><?php echo $nm;?></b><span style="color:#0066FF"><?php echo substr($data['name'],strlen($nm));?></span>
</li>
<?php }?>
</ul>