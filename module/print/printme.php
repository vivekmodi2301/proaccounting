<?php
	session_start();
	include "../../config.php";
	include "../../function.php";
	if(isset($_GET['table']) && $_GET['id']){
		$table=$_GET['table'];
		$id=$_GET['id'];
		$rdata=mysqli_fetch_assoc(mysqli_query($con,"select releaseorder.id,name,rono,datee, edition,size,rate,creditnote,download,publishdate,ammount,addtype,narration from releaseorder join client on cid=client.id where releaseorder.id=$id"));
		if(isset($rdata['size']) && $rdata['size']){
			$pos=strrpos($rdata['size'],'*');
			$h=substr($rdata['size'],0,$pos);
			$w=substr($rdata['size'],$pos+1);
		}
	}
	if(isset($_GET['table']) && isset($_GET['id'])){
		$table=$_GET['table'];
		$eid=$_GET['id'];
		$rd['download']=1;
		$id=$_GET['id'];
		addEdit('releaseorder',$rd,$id);
		//include "../../index.php";
		?>
        	<script>
				relist('<?php $table;?>','<?php $eid;?>');
			</script>
        <?php	
	}
?>
<div style="border:2px solid; padding:0px 15px 15px 5px;">
<?php
$id=$_SESSION['clogin']['id'];
	$clogo=mysqli_fetch_assoc(mysqli_query($con,"select logo,signname from company where id=$id"));
	$signname=$clogo['signname'];
	$clogo=$clogo['logo'];
	
?>
<div
 onClick="printplz('<?php echo $rdata[id];?>')" style="width:100%; text-align:center;"><img src="../../clogo/<?php echo $clogo;?>" height="150px" width="600px"><br><div style="font-size:18px; margin-top:0px;"></div></div>
<div style="border:1px solid; float:left; width:150px; padding-left:15px; font-size:20px;">Release Order</div>
<div style="float:left; margin-left:10px; width:200px;"><?php if($rdata['download']){
			echo"Duplicate";
			} else{
				echo "Orignal";	
			}?>
            </div>

<table width="100%" border="0px" style="margin-top:5px;" cellspacing="0">
	<tr>
    	<td style="width:5%">Client:</td>
   		<td style="width:25%"><?php echo $rdata['name'];?></td>
        <td style="width:5%">R.O.NO:</td>
        <td style="width:15%"><?php echo $rdata['rono'];?></td>

        <td style="width:5%">Date:</td>
       
        <td style="width:25%"><?php echo $rdata['datee'];?></td>
      	    </tr>
    
</table>
<table border="1px" width="100%" cellspacing="0" style=" margin-top:5px">
    <tr valign="top" style=" padding-top:10px;">
    	<td rowspan="2" width="300px;">Edition</td>
    	<td colspan="2" width="150px;">Size</td>
    	<td rowspan="2" width="150px;">Rate</td>
    	<td rowspan="2" width="150px;">Creditnote</td>
    	<td rowspan="2" width="150px;">Publishdate</td>
        <td rowspan="2" width="150px">Add Type</td>
    	<td rowspan="2">Ammount</td>
        
    </tr>
  	<tr>
    	<td width="25px">Height</td>
        <td width="25px">Width</td>
    </tr>
    <tr style="text-align:center;">
    	<td style="max-width:200px;"><?php echo $rdata['edition']?></td>
    	<td><?php echo $h;?></td>
        <td><?php echo $w;?></td>
    	<td><?php echo $rdata['rate'];?></td>
    	<td><?php echo $rdata['creditnote'];?></td>
    	<td><?php echo $rdata['publishdate'];?></td>
        <td><?php echo $rdata['addtype'];?></td>
    	<td><?php echo $rdata['ammount'];?></td>
    </tr>
    <tr valign="top"  style="text-align:left; padding-top:0px; height:50px;">
    	<td colspan="8"><u>Special Instruction: </u><br><div style="margin-left:80px"> <?php echo $rdata['narration'];?></div></td>
    </tr>
    
    <tr valign="top"  style="text-align:left; padding-top:0px; height:50px;">
    	<td colspan="8"><u>Important: </u><br><div style=" font-size:10px;">Inform us immedieatly if material found unsuitable for good reproduction to enable timely replacement
        (1) Forward voucher copies immediately after the inserttion to the client and to us.
        (2) Check above rate and notify us immediately if incorrect. (3) In case unable to comply with above instructions of if release cannot be made, notify immediately. (4) No two products of the same client should appear together in the same issue unless specified. (5) Request Competitive ads be spaced apart.</div></td>
    </tr>
    <tr>
    	<td colspan="4"> Paid By <input type="checkbox">Cash <input type="checkbox">Cheque</td>
    	<td colspan="4" style="height:50px; text-align:right; padding-right:35px;" valign="bottom">For <?php echo $signname;?></td>
    </tr>
</table>
</div>
<script>
	function printplz(id){	
		window.print();
	}
	</script>