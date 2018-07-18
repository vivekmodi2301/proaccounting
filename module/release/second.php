<?php
	session_start();
	include "../../config.php";
	include "../../function.php";
	$cid=$_SESSION['clogin']['id'];
?>

<link href="http://localhost/proaccounting/css/jquery-ui.css" rel="stylesheet" type="text/css">
<script  src="http://localhost/proaccounting/js/jquery.js"></script>
<script  src="http://localhost/proaccounting/js/jquery-ui.min.js"></script>

<script>
  $(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $("#idate").datepicker({ dateFormat: 'yy-mm-dd' });
    $("#rdate").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate()+1);
        $("#MyDatepicker1").datepicker( "option", "minDate", minValue );
    });
});
});
  </script>

<?php
	if(isset($_POST['rid']) && $_POST['rid']){
		$id=$_POST['rid'];
		$rdata=mysqli_fetch_assoc(mysqli_query($con,"select releaseorder.id,name,edition,rono,rate,creditnote, ammount,rodatee,publishdate,size from releaseorder join client on cid=client.id where releaseorder.id=$id and releaseorder.coid=$cid"));
		//echo "select releaseorder.id,name,rono,rate,creditnote, ammount,rodatee,publishdate,size from releaseorder join client on cid=client.id where releaseorder.id=$id and coid=$cid";//exit;
	}
	if(isset($_POST['iid']) && $_POST['iid']){
		$id=$_POST['iid'];
		$idata=mysqli_fetch_assoc(mysqli_query($con,"select invoice.id,client.name,rodatee, ronoid, invoiceno, invoicedate,adfor,word_amm, total_publish, publicationcenter,dealerpanel,tax_amm, rate, pageprem, colorprem, otherprem, grossamt, publishdate,cgst,sgst, discount, boxcharge, netamm, totamm, narration, date, size,caption from invoice join client on cid=client.id where invoice.id=$id and invoice.coid=$cid"));

		//print_r($idata);
		//echo "select invoice.id,client.name,rodatee, ronoid, invoiceno, invoicedate, publicationcenter,dealerpanel, rate, pageprem, colorprem, otherprem, grossamt, publishdate, discount, boxcharge, netamm, totamm, narration, date, size from invoice join client on cid=client.id where invoice.id=$id and invoice.coid=$cid";//exit;

	}
	if(isset($_POST['delid']) && $_POST['delid']){
		$id=$_POST['delid'];
		$me['status']='cancel';
		addEdit('invoice',$me,$id);
		?>
        	<script>
				release('','','');
			</script>
        <?php
	}
?>
<form method="post">
<?php if(isset($_POST['iid']) && $_POST['iid']){
?>
	<input type="hidden" value="<?php echo $idata['id'];?>" name="id">
<?php
}
?>
<div style="margin:0 auto; height:650px; width:100%; overflow:scroll; background-color:#0CF">
<div style="height:120px;">

<?php
	$coid=$_SESSION['clogin']['id'];
	$logo=mysqli_fetch_assoc(mysqli_query($con,"select logo,name,address from company where id=$coid"));
	//echo "select logo,name from company where id=$coid";
		?>
        	<img src="clogo/<?php echo $logo['logo'];?>" height="100px"><br>
            <?php echo $logo['address'];?>
</div>

<div style="height:30px; text-align:center; width:100%; border:1px solid; font-size:24px; font-weight:bold">
INVOICE
</div>

<div style="height:170px; font-weight:bold; float:left; width:50%; margin-left:0px; margin-top:10px">
<table>
<?php
	$rs=mysqli_query($con,"select invoiceno from invoice where coid=$cid order by id desc limit 0,1");
	//echo "select invoiceno from invoice where coid=$cid order by invoiceno desc limit 0,1";
	if(mysqli_num_rows($rs)){
		$no=mysqli_fetch_assoc($rs);
		$no=$no['invoiceno'];
		$no++;
	}
	else{
		$no=1;
	}
?>
<tr><td>INVOICE NO</td><td><input type="text" name="invoiceno" value="<?php if(isset($idata['invoiceno']) && $idata['invoiceno']){ echo $idata['invoiceno'];} else{ echo $no;}?>" style="color:#000;"></td></tr>
<tr><td>R.O. NO </td><td><input type="text" name="ronoid" value="<?php if(isset($rdata['rono']) && $rdata['rono']){ echo $rdata['rono'];}if(isset($idata['ronoid']) && $idata['ronoid']){ echo $idata['ronoid'];}?>" style="color:#000;"></td></tr>
<tr><td>CLIENT NAME </td><td><input type="text" id="cid" name="cid" onClick="sclient()" value="<?php
	if(isset($rdata['name']) && $rdata['name'])
	{ echo $rdata['name'];
} if(isset($idata['name']) && $idata['name']){ echo $idata['name'];
}?>" style="color:#000;"></td></tr>
</table>
</div>

<div style="height:70px; float:left; font-weight:bold; width:50%; margin-left:0px; margin-top:10px;">
<table>
<tr><td>INVOICE DATE</td><td><input type="text" id="idate" name="invoicedate" value="<?php if(isset($idata['invoicedate']) && $idata['invoicedate']){ echo $idata['invoicedate'];} else{ echo date('Y-m-d');}?>" style="color:#000;"></td></tr>
<tr><td>R.O.DATE</td><td><input type="text" id="rdate" name="rodatee" value="<?php if(isset($rdata['rodatee']) && $rdata['rodatee'])
{
	echo $rdata['rodatee'];
}
if(isset($idata['rodatee']) && $idata['rodatee'])
{
	 echo $idata['rodatee'];
 }?>" style="color:#000;"></td></tr>
 <tr><td>Add For</td><td><input type="text"  name="adfor" value="<?php if(isset($idata['adfor']) && $idata['adfor']){ echo $idata['adfor'];} ?>" style="color:#000;"></td></tr>
</table>
</div>
<table border="1px" height="200px" width="100%"  style="overflow:auto;">
<tr>
	<th >Caption</th>
	<td><input type="text" name="caption" style="color:#000; width:100%; margin-right:5px; margin-left:5px;" value="<?php if(isset($rdata['caption']) && $rdata['caption']){echo $rdata['caption'];
	} if(isset($idata['caption']) && $idata['caption']){
		echo $idata['caption'];
	}?>"></td>
    </tr>
<tr height="30px">
	<th >Publishing Centers</th>
	<td><textarea style="color:#000; margin-right:5px; margin-left:5px;" name="publicationcenter"><?php if(isset($rdata['edition']) && $rdata['edition']){ echo $rdata['edition'];} if(isset($idata['publicationcenter']) && $idata['publicationcenter']){ echo $idata['publicationcenter'];}?></textarea></td>
    </tr>
    <tr>
	<th >Publishing Date</th>
	<td><input type="text" name="publishdate" style="color:#000; width:100%; margin-right:5px; margin-left:5px;" value="<?php if(isset($idata['publishdate']) && $idata['publishdate']){
		echo $idata['publishdate'];
	}?>"></td>
    </tr>
    <tr>
	<th>Ad Size<br>(Sq. Cm.)</th>
    <?php
		if(isset($rdata['size']) && $rdata['size']){
			$pos=strrpos($rdata['size'],'*');
			$h=substr($rdata['size'],0,$pos);
			$w=substr($rdata['size'],$pos+1);
		}
		if(isset($idata['size']) && $idata['size']){
			$pos=strrpos($idata['size'],'*');
			$h=substr($idata['size'],0,$pos);
			$w=substr($idata['size'],$pos+1);
		}
	?>
	<td><input type="text" id="h" style="color:#000; width:50px; margin-right:5px; margin-left:5px;" value="<?php if(isset($h) && $h){echo $h;}?>" name="size[]">
    <input type="text" id="w" style="color:#000; width:50px; margin-right:5px; margin-left:5px;" value="<?php if(isset($w) && $w){echo $w;}?>" name="size[]"></td>
    </tr>
    <tr>
	<th >Dealer<br>Panel</th>
	<td><input type="text" style="color:#000; width:200px; margin-right:5px; margin-left:5px;" name="dealerpanel" value="<?php if(isset($idata['dealerpanel']) && $idata['dealerpanel']){echo $idata['dealerpanel'];}?>"></td>
    </tr>
    <tr>
	<th colspan="2">Pricing(Rs)</th>
    </tr>

<tr>
	<th>Rate</th>
	<td><input type="hide" id="r" value="<?php if(isset($idata['rate']) && $idata['rate']){echo $idata['rate'];}?>" style="color:#000; width:200px; margin-right:5px; margin-left:5px;" name="rate"></td>
    </tr>

	<input type="hidden" id="p" value="0" style="color:#000; width:200px; margin-right:5px; margin-left:5px;" name="pageprem">

	<input type="hidden" id="c" value="0" style="color:#000; width:200px; margin-right:5px; margin-left:5px;" name="colorprem">
    <tr>
	<th>Premium</th>
	<td><input type="text" id="premium"   value="<?php if(isset($idata['otherprem'])){echo $idata['otherprem'];}?>" style="color:#000; width:200px; margin-right:5px; margin-left:5px;" name="otherprem"></td>
    </tr>
    <tr>
</tr>
    <tr>
	<th>Disc<br>(%)</th>
	<td><input id="dis" onChange="ga(h.value,w.value,r.value,p.value,c.value,premium.value,this.value)"  value="<?php if(isset($idata['discount']) && $idata['discount']){echo $idata['discount'];}?>" type="text" style="color:#000; width:200px; margin-right:5px; margin-left:5px;" name="discount"></td>
    </tr>
    <tr>
	<th>Gross Amount</th>
	<td><input type="text" id="gram" value="<?php if(isset($idata['grossamt']) && $idata['grossamt']){echo $idata['grossamt'];}?>" style="color:#000; width:200px; margin-right:5px; margin-left:5px;" name="grossamt"></td>
    </tr>
    <tr>
	<th>Trade Discount</th>
	<td><input onChange="ftot(gram.value,this.value)" value="<?php if(isset($idata['boxcharge'])){echo $idata['boxcharge'];}?>" type="text" style="color:#000; width:200px; margin-right:5px; margin-left:5px;" name="boxcharge"></td>
    </tr>
    <tr>
	<th>Taxable Amount</th>
	<td><input  value="<?php if(isset($idata['tax_amm'])){echo $idata['tax_amm'];}?>" type="text" style="color:#000; width:200px; margin-right:5px; margin-left:5px;" id="tax_am" name="tax_amm"></td>
    </tr>
    <tr>
	<th>CGST</th>
	<td><input id="cgst"  value="<?php if(isset($idata['cgst'])){echo $idata['cgst'];}?>" type="text" style="color:#000; width:200px; margin-right:5px; margin-left:5px;"  name="cgst"></td>
    </tr>
    <tr>
	<th>SGST</th>
	<td><input  value="<?php if(isset($idata['sgst'])){echo $idata['sgst'];}?>" type="text" style="color:#000; width:200px; margin-right:5px; margin-left:5px;" id="sgst" name="sgst"></td>
    </tr>
    <tr>
	<th>Net Amount</th>
	<td><input id="netam" value="<?php if(isset($idata['netamm']) && $idata['netamm']){echo $idata['netamm'];}?>" type="text" style="color:#000; width:200px; margin-right:5px; margin-left:5px;" name="netamm"></td>
    </tr>
</tr>
<tr>
 	<td height="20px"><div style="text-align:center">Total Amount</div></td>
    <td><input id="totam" type="text" value="<?php if(isset($idata['totamm']) && $idata['totamm']){echo $idata['totamm'];}?>" name="totamm"></td>
</tr>
<tr>
 	<td height="20px"><div style="text-align:center">Amount In Words</div></td>
    <td><input  type="text" value="<?php if(isset($idata['word_amm']) && $idata['word_amm']){echo $idata['word_amm'];}?>" name="word_amm"></td>
</tr>
<tr>
 	<td height="20px"><div style="text-align:center">Publish Dates</div></td>
    <td><input  type="text" value="<?php if(isset($idata['total_publish']) && $idata['total_publish']){echo $idata['total_publish'];}?>" style="width:70%" name="total_publish"></td>
</tr>
</table>
<div style="height:200px; border:1px solid;">
	<textarea style="height:150px; width:800px; margin-top:10px;" name="narration"><?php if(isset($idata['narration']) && $idata['narration']){echo $idata['narration'];}?></textarea>
</div>

<div style="height:50px; border:1px solid;">
	<input type="submit" value="Save" style="margin-top:5px;">
</div>

</div>
</form>
