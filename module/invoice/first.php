<?php
	session_start();
	$id=$_SESSION['clogin']['id'];
	include "../../config.php";
	include "../../function.php"
?>
<link href="http://localhost/proaccounting/css/jquery-ui.css" rel="stylesheet" type="text/css">
<script  src="http://localhost/proaccounting/js/jquery.js"></script>
<script  src="http://localhost/proaccounting/js/jquery-ui.min.js"></script>

<script>
  $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $("#pdate").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#rdate").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate()+1);
        $("#MyDatepicker1").datepicker( "option", "minDate", minValue );
    });
});
});
  </script>
  
<style>
input[type=text]{
	width:143px;
	height:80px;
}
input[type=submit]{
	width:190px;
	height:28px;
}
textarea{
	width:130px;
	border:1px solid;
	border-radius:5px;
}
#nw textarea{
	width:97%;
}
</style>
<?php
	if(isset($_POST['id']) && $_POST['id']){
		$id=$_POST['id'];
		$redata=mysqli_fetch_assoc(mysqli_query($con,"select releaseorder.id,name,rono,datee,edition,size,rate,creditnote,publication,publishdate,ammount,narration from releaseorder join client on cid=client.id where releaseorder.id=$id"));
	}
?>
<form method="post">
<div style="height:120px; margin-bottom:20px">
<?php
	$coid=$_SESSION['clogin']['id'];
	$logo=mysqli_fetch_assoc(mysqli_query($con,"select logo,name,address from company where id=$coid"));
	//echo "select logo,name from company where id=$coid";
		?>
        	<img src="clogo/<?php echo $logo['logo'];?>" height="100px"><br>
            <?php echo $logo['address'];?>
</div>

CLIENT :<input type="text"  name="cid" id="cid" style="height:20px;" value="<?php if($_POST['name']){echo $_POST['name'];} if(isset($redata['name']) && $redata['name']){ echo $redata['name'];}?>" onClick="sclient()"><BR>
	</div>
<div style="width:200px; margin-top:0px; font-size:20px; font-weight:bold; float:left; height:170px">
<?php
	$ros=(mysqli_query($con,"select rono from releaseorder where coid=$id order by id desc limit 0,1"));
	if(mysqli_num_rows($ros)){
		$rono=mysqli_fetch_assoc($ros);
		$pos=strpos("$rono[rono]",'/');
		$no=substr("$rono[rono]",0,$pos);
		$no++;
	}
	else{
		$no=1;	
	}
?>
<?php
	if(isset($_POST['id']) && $_POST['id']){
	?>
    	<input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
    <?php	
	}
?>
R.O. NO :<input type="text" style="font-size:20px;" value="<?php if(isset($redata['rono']) && $redata['rono']){ echo $redata['rono'];} else {echo $no."/".date('Y');}?>" name="rono"> Dated : <input id="rdate" <?php if(isset($redata['datee']) && $redata['datee']){ ?> type="text"<?php }else{?> type="text"<?php }?> name="rodatee"  style="height:auto;" value="<?php if(isset($redata['datee']) && $redata['datee']){ echo $redata['datee'];} else{ echo date('Y-m-d');}?>">
</div>
</div>

<div style="width:100%; height:25px; font-weight:bold; border:1px solid #00F;">
PUB/ADITION : <select name="publication">
	<option><-- Select Publication --></option>
    <?php
		$pub=mysqli_query($con,"select id,name from edition");
		while($pubdata=mysqli_fetch_assoc($pub)){
		?>
        	<option <?php if(isset($redata['publication']) && $redata['publication']==$pubdata['id']){ ?> selected <?php }?> value="<?php echo $pubdata['id'];?>"><?php echo $pubdata['name'];?></option>
        <?php	
		}
	?>
</select>
</div>
<table height="auto" border="1px" width="100%">
<tr>
	<th>EDITION</th>
    <td><textarea name="edition"><?php if(isset($redata['edition']) && $redata['edition']){ echo $redata['edition'];}?></textarea></td>
    </tr>
    <tr>
    <th>SIZE</th>
    <?php
		if(isset($redata['size']) && $redata['size']){
			$pos=strrpos($redata['size'],'*');
			$h=substr($redata['size'],0,$pos);
			$w=substr($redata['size'],$pos+1);
		}
	?>
    <td><input type="text" id="h" name="size[]" value="<?php if(isset($h) && $h){echo $h;}?>" style="height:auto; width:50px"><input type="text" value="<?php if(isset($w) && $w){echo $w;}?>" id="w" style="height:auto; width:50px" name="size[]"></td>
    </tr>
    <tr>
    <th>RATE</th>
    <td><textarea id="r" name="rate"><?php if(isset($redata['rate']) && $redata['rate']){ echo $redata['rate'];}?></textarea></td>
    </tr>
    <tr>
    <th>CREDIT NOTE</th>
    <td><textarea onChange="amm(h.value,w.value,r.value,this.value)" name="creditnote"><?php if(isset($redata['creditnote']) && $redata['creditnote']){ echo $redata['creditnote'];}?></textarea></td>
    </tr>
    <tr>
    <th>PUBLISH DATE</th>
    <td>
    	
        <input type="text" id="pdate" value="<?php if(isset($redata['publishdate']) && $redata['publishdate']){echo $redata['publishdate'];}?>"  name="publishdate">
        
    </td>
    </tr>
    <tr>
    	<th>Add Type</th>
        <td><input type="text" name="addtype"></td>
    </tr>
    <tr>
    <th>AMOUNT</th>
    <td><textarea id="ammount" name="ammount"><?php if(isset($redata['ammount']) && $redata['ammount']){ echo $redata['ammount'];}?></textarea></td>
</tr>
<tr>
	<td colspan="6" height="48px" id="nw"><u>Special instruction</u><br><textarea name="narration"><?php if(isset($redata['narration']) && $redata['narration']){ echo $redata['narration'];}?></textarea></td>
</tr>
<tr>
	<td colspan="6" height="30px"><input type="submit" value="Save" /></td>
</tr>
</table>
</div>
</div>

</form>
<script>
function mymagic(txt)
{
	$('#result').show();
    $.ajax({
	    url:"search.php",
		data:"name="+txt.value,
		type:'GET',
		success:function(ajdt){$('#result').html(ajdt);}
		});
	}
</script>