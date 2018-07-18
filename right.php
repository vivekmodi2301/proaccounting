<?php
	$id="";
	if(isset($_POST['name']) && $_POST['name']){
		if(isset($_POST['id']) && $_POST['id']){
			$id=$_POST['id'];
			unset($_POST['id']);
		}else{
			$_POST['coid']=$_SESSION['clogin']['id'];
		}
		addEdit('client',$_POST,$id);
	}
	if(isset($_POST['keyword'])){
			//echo "hi";exit;
		$id=$_SESSION['clogin']['id'];
		$wh="where 1 and coid=$id ";
		if($_POST['keyword']){
			$wh.="and name like'%$_POST[keyword]%' ";
		}
		//$wh=addslashes($wh);
	}
	if(isset($_POST['reno'])){ //echo "hi";exit;
		$id=$_SESSION['clogin']['id'];
		$wh="where 1 and releaseorder.coid=$id ";
		if($_POST['from'] && $_POST['to']){
			$wh.=" and datee >='$_POST[from]' and datee<='$_POST[to]' ";
		}
		if($_POST['cid']){
			$cid=mysqli_fetch_assoc(mysqli_query($con,"select id from client where name='$_POST[cid]'"));
			$cid=$cid['id'];
			$wh.=" and cid=$cid ";
		}
		if($_POST['reno']){
			$wh.=" and rono='$_POST[reno]'";
		}
	}
	if(isset($_POST['ino'])){ //echo "hi";exit;
		$id=$_SESSION['clogin']['id'];
		$wh="where 1 and invoice.coid=$id ";
		if($_POST['from'] && $_POST['to']){
			$wh.=" and invoicedate >='$_POST[from]' and invoicedate<='$_POST[to]' ";
		}
		if($_POST['cid']){
			$cid=mysqli_fetch_assoc(mysqli_query($con,"select id from client where name='$_POST[cid]'"));
			$cid=$cid['id'];
			$wh.=" and cid=$cid ";
		}
		if($_POST['ino']){
			$wh.=" and invoiceno='$_POST[ino]'";
		}
	}
	if(isset($_POST['reciptno'])){ //echo "hi";exit;
		$id=$_SESSION['clogin']['id'];
		$wh="where 1 and cash.coid=$id ";
		if($_POST['from'] && $_POST['to']){
			$wh.=" and datee >='$_POST[from]' and datee<='$_POST[to]' ";
		}
		if($_POST['cid']){
			$cid=mysqli_fetch_assoc(mysqli_query($con,"select id from client where name='$_POST[cid]'"));
			$cid=$cid['id'];
			$wh.=" and cid=$cid ";
		}
		if($_POST['reciptno']){
			$wh.=" and reciptid='$_POST[reciptno]'";
		}
		if($_POST['chno']){
			$wh.=" and cheque=$_POST[chno]";
		}
	}
	if(isset($_POST['paymentno'])){ //echo "hi";exit;
		$id=$_SESSION['clogin']['id'];
		$wh="where 1 and payment.coid=$id ";
		if($_POST['from'] && $_POST['to']){
			$wh.=" and datee >='$_POST[from]' and datee<='$_POST[to]' ";
		}
		if($_POST['ed']){
			$wh.=" and eid='$_POST[ed]' ";
		}
		if($_POST['paymentno']){
			$wh.=" and paymentid='$_POST[paymentno]'";
		}
		if($_POST['chno']){
			$wh.=" and cheque=$_POST[chno]";
		}
		//echo $wh;exit;
	}
	if(isset($_POST['creditnote'])){
		$id="";
		if(is_array($_POST['size'])){
			$_POST['size']=implode('*',$_POST['size']);
		}
		$cid=mysqli_fetch_assoc(mysqli_query($con,"select id from client where name='$_POST[cid]'"));
		$_POST['cid']=$cid['id'];
		//echo $_POST['cid'];exit;
		if(isset($_POST['id']) && $_POST['id']){
			$id=$_POST['id'];
			unset($_POST['id']);
		}
		else{
			$_POST['coid']=$_SESSION['clogin']['id'];
		}
		$_POST['datee']=date('Y-m-d');
		addEdit('releaseorder',$_POST,$id);
		?>
        	<script>
				$.ajax({
			url:"module/invoice/list.php",
			success: function(e){
				$('#result').html(e);
			}
		});
			</script>
        <?php
	}
	if(isset($_POST['invoiceno'])){
		$id="";
		if(isset($_POST['id']) && $_POST['id']){
			$id=$_POST['id'];
			unset($_POST['id']);
		}
		else{
			$_POST['coid']=$_SESSION['clogin']['id'];
		}
		if(is_array($_POST['size'])){
			$_POST['size']=implode('*',$_POST['size']);
		}
		$cid=mysqli_fetch_assoc(mysqli_query($con,"select id from client where name='$_POST[cid]'"));
		$_POST['cid']=$cid['id'];
		$_POST['date']=date('Y-m-d');
		addEdit('invoice',$_POST,$id);
		?>
        <script>
				$.ajax({
			url:"module/release/list.php",
			success: function(e){
				$('#result').html(e);
			}
		});
			</script>
        <?php
	}
	if(isset($_POST['reciptid'])){
		$id="";
		if(isset($_POST['id']) && $_POST['id']){
			$id=$_POST['id'];
			unset($_POST['id']);
		}
		else{
			$_POST['coid']=$_SESSION['clogin']['id'];
		}
		$cid=mysqli_fetch_assoc(mysqli_query($con,"select id from client where name='$_POST[cid]'"));
		$_POST['cid']=$cid['id'];
		addEdit('cash',$_POST,$id);
	}
	if(isset($_POST['paymentid'])){
		$id="";
		if(isset($_POST['id']) && $_POST['id']){
			$id=$_POST['id'];
			unset($_POST['id']);
		}
		else{
			$_POST['coid']=$_SESSION['clogin']['id'];
		}
		addEdit('payment',$_POST,$id);
	}
	if(isset($_FILES['restorefile']['name'])){
		$id=$_SESSION['clogin']['id'];
		global $id;
		$tables = 'cash,client,edition,invoice,payment,releaseorder';
		$tables = is_array($tables) ? $tables : explode(',',$tables);

	foreach($tables as $table)
	{
		//echo "hi";
		mysqli_query($con,'delete  FROM '.$table.' WHERE coid = '.$id);
	}
	function check_input($value)
	{
			//echo $value;exit;
	  		$value = mysql_real_escape_string(trim($value));
		return $value;
	}


	@header('Content-type: text/html; charset=utf-8');
	$link = mysql_connect('localhost','root') or die('Cannot connect to the DB');// Database connection
	mysql_select_db('proaccounting',$link) or die('Cannot select the DB');
	mysql_query("SET NAMES 'utf8'");
	$cname=mysqli_fetch_assoc(mysqli_query($con,"select name from company where id=$id"));
	$cname=$cname['name'];
// Name of the file
$filename ="data/$cname/".$_FILES['restorefile']['name'];
// MySQL host
$mysql_host = HOSTNAME;
// MySQL username
$mysql_username = USERNAME;
// MySQL password
$mysql_password = PASSWORD;
// Database name
$mysql_database = DB;

// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 echo "Tables imported successfully";
	}
	if(isset($_POST['medianame'])){
		$eid="";
		//echo "hi";exit;
		if(isset($_POST['eid']) && $_POST['eid']){
			$eid=$_POST['eid'];
		}
		$media['obal']=$_POST['obal'];
		$media['drcr']=$_POST['drcr'];
		$media['coid']=$_SESSION['clogin']['id'];
		$media['name']=$_POST['medianame'];
		addEdit('edition',$media,$eid);
	}
?>
		<div class="mnu" style="min-height:">
        <?php if(isset($_SESSION['clogin'])){ ?>
        <input type="button" value="Logout" onclick="login()" />
        <?php } ?>
        <input type="button" value="Clients" onClick="client('','')" />
        <input type="button" value="Media"  onClick="media()" />
        <input type="button" value="Release" onClick="invoice('')" />
        <input type="button" value="Releaseorder List" onClick="relist('','')" />
        <input type="button" value="Canceled Releaseorder List" onClick="cancelreor()">
        <input type="button" value="Invoice"  onClick="release('','','')"/>
        <input type="button" value="Invoice List"  onClick="ilist('')"/>
        <input type="button" value="Canceled Invoice List" onClick="cancelinvoice()">
        <input type="button" value="Recipt"  onClick="recipt('')"/>
        <input type="button" value="Recipt List"  onClick="reciptl('')"/>
        <input type="button" value="Payment"  onClick="pay('')"/>
        <input type="button" value="Payment List"  onClick="payl('')"/>
        <input type="button" value="Summary" onClick="summary()">
        <input type="button" value="Restore Data" onClick="restore()">
        <input type="button" value="Edit Company Info" onClick="editcomp()">
        <div id="client"  style="overflow:scroll; max-height:200px;"></div>
        </div>
<script>
	function login(){
		location.href="index.php?mod=company&do=logout";
	}
	function client(wh,id){
		$.ajax({
			url:"module/client/clist.php",
			data:"wh="+wh+"&id="+id,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
		$('#client').html('');
	}
	function cedit(id){
		$.ajax({
			url:"module/client/client.php",
			data:"id="+id,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
		$('#client').html('');
	}
	function del(id){
		if(confirm("Do you really want to delete")){
			client('',id);
		}
	}
	function release(rid,iid,delid){
		$.ajax({
			url:"module/release/second.php",
			data:"rid="+rid+"&iid="+iid+"&delid="+delid,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
		$('#client').html('');
	}
	function invoice(id){
		$.ajax({
			url:"module/invoice/first.php",
			data:"id="+id,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
	}
	function sclient(){
		$.ajax({
			url:"module/client/show.php",
			success: function(e){
				$('#client').html(e);
			}
		});
	}
	function seclient(name){

		$.ajax({
			url:"module/invoice/selectc.php",
			data:"name="+name,
			type:'POST',
			success: function(e){

				$('#cid').val(e)
			},
			error:function(){
				alert("galat hai")
			}
		});
	}
	function relist(id,wh){
		$.ajax({
			url:"module/invoice/list.php",
			data:"delid="+id+"&wh="+wh,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
	}
	function del1(id){
		if(confirm("Do you really want to cancel")){
			relist(id,'');
		}
	}
	function ilist(wh){
		$.ajax({
			url:"module/release/list.php",
			data:"wh="+wh,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
	}
	function del2(id){
		if(confirm("do you really want to cancel")){
		release('','',id);
		}
	}
	function printme(table,id){
		location.href="module/print/printme.php?table="+table+"&id="+id;
	}
	function iprint(table,id){
		location.href="module/print/iprintme.php?table="+table+"&id="+id+"&du=no";
	}
	function duiprint(table,id){
		location.href="module/print/iprintme.php?table="+table+"&id="+id+"&du=yes";
	}
	function niprint(table,id){
		location.href="module/print/newiprint.php?table="+table+"&id="+id+"&du=no";
	}

	function duniprint(table,id){
		location.href="module/print/newiprint.php?table="+table+"&id="+id+"&du=yes";
	}
	function amm(he,wi,ra,dis){
		am=he*wi*ra;
		ammount=am*(dis/100);
		am=am-ammount;
		$('#ammount').html(am);
	}
	function ga(h,w,r,p,c,o,dis){
		//alert(r);
		var amm=h*w*r;
		p=amm*(p/100);
		//alert(p);
		c=amm*(c/100);
		//alert(c);
		o=amm*(o/100);
		//alert(o);
		tot=amm + p + c + o;
		discount=tot*(dis/100);
		gra=tot-discount;
		document.getElementById('gram').value=gra;
	}
	function ftot(gaa,td){
		//alert("hi");
		tradedis=gaa*(td/100);
		nam=+gaa -tradedis;
		document.getElementById('tax_am').value=nam;
		cgst=nam*(2.5/100);
		sgst=nam*(2.5/100);
		cgst=Number((cgst).toFixed(2));
		sgst=Number((sgst).toFixed(2));
		fnam=nam+cgst+sgst;
		fnam=Number((fnam).toFixed(2));
		document.getElementById('netam').value=fnam;
		document.getElementById('totam').value=fnam;
		document.getElementById('cgst').value=cgst;
		document.getElementById('sgst').value=sgst;
	}
	function recipt(id){
		$.ajax({
			url:"module/recipt/recipt.php",
			data:"eid="+id,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
	}
	function bankdte(){
		$.ajax({
			url:"module/recipt/bdetail.php",
			success: function(e){
				$('#bdte').html(e);
			}
		});
	}
	function cbdte(){
		$('#bdte').empty();
	}
	function pay(id){
		$.ajax({
			url:"module/payment/pay.php",
			data:"eid="+id,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
	}
	function reciptl(wh){
		$.ajax({
			url:"module/recipt/list.php",
			data:"wh="+wh,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
	}
	function del4(id){
		if(confirm("Do you really want to delete")){
			$.ajax({
			url:"module/recipt/list.php",
			data:"delid="+id,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
		}
	}
	function payl(wh){
		$.ajax({
			url:"module/payment/list.php",
			data:"wh="+wh,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
	}
	function del5(id){
		if(confirm("Do you really want to delete")){
			$.ajax({
			url:"module/payment/list.php",
			data:"delid="+id,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
		}
	}
	function summary(){
		$.ajax({
			url:"module/summary/form.php",
			success: function(e){
				$('#result').html(e);
			}
		});
	}
	function restore(){
		$.ajax({
			url:"restore.php",
			success: function(e){
				$('#result').html(e);
			}
		});
	}
	function cancelreor(){
		$.ajax({
			url:"module/invoice/cancellist.php",
			success: function(e){
				$('#result').html(e);
			}
		});
	}
	function editcomp(){
		location.href="index.php?mod=company&do=editcomp";
	}
	function media(){
		$.ajax({
			url:"module/edition/list.php",
			success: function(e){
				$('#result').html(e);
			}
		});
	}
	function showform(name){
		$.ajax({
			url:"module/edition/form.php",
			data:"name="+name,
			type:'POST',
			success: function(e){
				$('#form').html(e);
			}
		});
	}
	function deletemedia(id){
		if(confirm("Do you really want to delelte")){
			$.ajax({
			url:"module/edition/list.php",
			data:"did="+id,
			type:'POST',
			success: function(e){
				$('#result').html(e);
			}
		});
		}
	}
	function cancelinvoice(){
		$.ajax({
			url:"module/release/cancelinvoice.php",
			success: function(e){
				$('#result').html(e);
			}
		});
	}
</script>
<?php if(isset($_POST['name'])){
	?>
    	<script>
			client('','');
		</script>
    <?php
}

	if(isset($_POST['keyword'])){
?>
	<script>
		client("<?php echo $wh;?>",'');
	</script>
<?php } ?>
<?php
	if(isset($_POST['reciptid'])){
		?>
		<script>
			recipt();
		</script>
        <?php
	}
?>
<?php
	if(isset($_POST['reciptid'])){
		?>
        	<script>
				reciptl('');
			</script>
        <?php
	}
?>
<?php
	if(isset($_POST['reno'])){
		?>
        	<script>
				relist('',"<?php echo $wh;?>")
			</script>
        <?php
	}
?>
<?php
	if(isset($_POST['ino'])){
		?>
        	<script>
				ilist("<?php echo $wh;?>");
			</script>
        <?php
	}
?>
<?php
	if(isset($_POST['reciptno'])){
	?>
    	<script>
			reciptl("<?php echo $wh;?>");
		</script>
    <?php
	}
?>
<?php
	if(isset($_POST['paymentid'])){
		?>
    	<script>
			payl('');
		</script>
    <?php
	}
?>
<?php
	if(isset($_POST['paymentno'])){
	?>
    	<script>
			payl("<?php echo $wh;?>");
		</script>
    <?php
	}
?>
<?php
	if(isset($_POST['medianame'])){
		?>
        <script>
		showform();
		</script>
		<?php
	}
?>
