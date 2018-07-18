<?php
session_start();
?>
<div style="text-align:left; margin-top:10px; font-size:20px">
<div style="font-size:36px; font-weight:bolder; text-align:center">Login</div>
<form method="post">
<table border="1px" width="800px" height="100px" style="margin-left:70px">

<?php if(isset($_SESSION['emsg'])){?>
<tr>
	<td colspan="2" style="text-align:center; color:#900;"><?php echo "Please Enter Valid Username and Password";?></td>
</tr>
<?php  unset($_SESSION['emsg']); }?>
<tr>
	<td style="width:50%; text-align:center">UserName :</td>
    <td style="width:50%; text-align:center">
    <input type="text" name="username"/></td>
</tr>
<tr>
	<td style="width:50%; text-align:center">Password :</td>
    <td style="width:50%; text-align:center">
    <input type="text" name="password"/></td>
</tr>
<tr>
	<td colspan="2" style="text-align:center">
    <input type="submit" value="Login"/></td>
</tr>
</table>
</form>

</div>
</div>