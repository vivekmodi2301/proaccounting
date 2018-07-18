<?php
	$tot=0;
	$opbal=0;
?>
<input type="button" value="Print" onclick="suprintout()">
<table border="1px" cellspacing="0" width="100%">
<tr>
	<td>S.No.</td>
	<td>Releaseorder/Payment No.</td>
	<td>Publish Date</td>
	<td>Client Name</td>
	<td>Date</td>
    <td colspan="2">ammount</td>
</tr>
<?php
	@session_start();
//echo "hi";
	include "../../config.php";
	include "../../function.php";
	//print_r($_POST);exit;
	$id=$_SESSION['clogin']['id'];
	if(isset($_POST['client'])){
		$cid=$_POST['client'];
		$wh=" where 1 ";
		if($cid){
			$wh=" and cid=$cid ";
		}
		$fdatee=$_POST['fdatee'];
		$tdatee=$_POST['tdatee'];
		if($cid){
			$obal=mysqli_fetch_assoc(mysqli_query($con,"select obal,drcr from edition $wh "));

			$tot=0;
		//echo "hi";exit;
		$opbal=$obal['obal'];
		if($obal['drcr']=='cr'){
			$tot+=$obal['obal'];
			//echo $tot;
		}
		else{
			$tot-=$obal['obal'];
		}
	}
		?>
        	<tr>
            	<td colspan="7" style="text-align:right;">Opening Balance:<?php if(isset($obal)  && $obal['drcr']=='dr'){echo "-";} echo $opbal;?></td>
            </tr>
        <?php
				if($cid){
		$re=mysqli_query($con,"select releaseorder.id,releaseorder.rono,releaseorder.datee,releaseorder.ammount,status,publishdate,client.name from releaseorder join client on releaseorder.cid=client.id  where releaseorder.coid=$id and publication=$cid and datee BETWEEN '$fdatee' AND '$tdatee'  order by datee asc");}else{
			$re=mysqli_query($con,"select releaseorder.id,releaseorder.rono,releaseorder.datee,releaseorder.ammount,status,publishdate,client.name from releaseorder join client on releaseorder.cid=client.id  where releaseorder.coid=$id and datee BETWEEN '$fdatee' AND '$tdatee'  order by datee asc");
		}
		//echo "select releaseorder.id,releaseorder.rono,releaseorder.datee,releaseorder.ammount,status,publishdate,client.name from releaseorder join client on releaseorder.cid=client.id  where releaseorder.coid=$id and publication=$cid and datee BETWEEN '$fdatee' AND '$tdatee'  order by datee asc";
		$releaseorder=mysqli_fetch_assoc($re);
		if($cid){
		$ca=mysqli_query($con,"select id,ammount,datee,paymentid,payby,bankname,cheque from payment where coid=$id and eid=$cid and datee BETWEEN '$fdatee' AND '$tdatee' order by datee asc");
	}else{
		$ca=mysqli_query($con,"select id,ammount,datee,paymentid,payby,bankname,cheque from payment where coid=$id and datee BETWEEN '$fdatee' AND '$tdatee' order by datee asc");
	}
		//echo "select id,ammount,datee,paymentid,payby,bankname,cheque from payment where coid=$id and eid=$cid and datee BETWEEN #$fdatee# AND #$tdatee# order by datee asc";
		//echo "select id,ammount,datee,paymentid,payby,bankname,cheque from payment where coid=$id and eid=$cid order by datee asc";
		$cash=mysqli_fetch_assoc($ca);
		//print_r($cash);
		$i=1;
		$a=1;
		//echo "<tr><td>hi</td></tr>";exit;
		while($a>=1){
			//echo "hi";exit;
			if($releaseorder=='' || $cash==''){
				break;
			}
			if($releaseorder['datee']<$cash['datee']){
			//echo "hi";exit;
				?>
        			<tr>
                    	<td><?php if(isset($releaseorder['status']) && $releaseorder['status']=='cancel'){echo "cancel";}else{ echo $i++;} ?></td>
                        <td><?php echo $releaseorder['rono'];?></td>
                        <td><?php echo $releaseorder['publishdate'];?></td>
                        <td><?php echo $releaseorder['name'];?></td>
                        <td><?php echo $releaseorder['datee'];?></td>
                        <td>-</td>
                        <td><?php echo $releaseorder['ammount'];?></td>
                    </tr>
                <?php
				if(isset($releaseorder['status']) && $releaseorder['status']!='cancel'){
					$tot+=$releaseorder['ammount'];
				}
				//echo $tot;exit;
				$releaseorder=mysqli_fetch_assoc($re);
				//print_r($releaseorder);exit;
			}
			else if($releaseorder['datee']>$cash['datee']){?>
				<tr>
                    	<td><?php echo $i++;?></td>
                        <?php if($cash['payby']=='cheque'){?>
                        <td><?php echo $cash['paymentid']."&nbsp;&nbsp;&nbsp; Bank Name:$cash[bankname] &nbsp;&nbsp;&nbsp; Cheque No.:$cash[cheque]";?></td>
                        <?php } else{?>
                        <td><?php echo $cash['paymentid'];?></td>
                        <?php }?>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo $cash['datee'];?></td>
                        <td><?php echo $cash['ammount'];?></td>
                        <td>-</td>
                    </tr>
                    <?php
					$tot-=$cash['ammount'];
					$cash=mysqli_fetch_assoc($ca);
			}
			else{
				?>
        			<tr>
                    	<td><?php if(isset($releaseorder['status']) && $releaseorder['status']=='cancel'){echo "cancel";}else{ echo $i++;} ?></td>
                        <td><?php echo $releaseorder['rono'];?></td>
                        <td><?php echo $releaseorder['publishdate'];?></td>
                        <td><?php echo $releaseorder['name'];?></td>
                        <td><?php echo $releaseorder['datee'];?></td>
                        <td>-</td>
                        <td><?php echo $releaseorder['ammount'];?></td>
                    </tr>
                    <tr>
                    	<td><?php echo $i++;?></td>
                        <?php if($cash['payby']=='cheque'){?>
                        <td><?php echo $cash['paymentid']."&nbsp;&nbsp;&nbsp; Bank Name:$cash[bankname] &nbsp;&nbsp;&nbsp; Cheque No.:$cash[cheque]";?></td>
                        <?php } else{?>
                        <td><?php echo $cash['paymentid'];?></td>
                        <?php }?>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo $cash['datee'];?></td>
                        <td><?php echo $cash['ammount'];?></td>
                        <td>-</td>
                    </tr>
                    <?php
					if(isset($releaseorder['status']) && $releaseorder['status']!='cancel'){
						$tot+=$releaseorder['ammount'];
					}
					$tot-=$cash['ammount'];
					$releaseorder=mysqli_fetch_assoc($re);
					$cash=mysqli_fetch_assoc($ca);
			}
		}
		if($releaseorder!=''){
			do{
				?>
                <tr>
                    	<td><?php if(isset($releaseorder['status']) && $releaseorder['status']=='cancel'){echo "cancel";}else{ echo $i++;} ?></td>
                        <td><?php echo $releaseorder['rono'];?></td>
                        <td><?php echo $releaseorder['publishdate'];?></td>
                        <td><?php echo $releaseorder['name'];?></td>
                        <td><?php echo $releaseorder['datee'];?></td>
                        <td>-</td>
                        <td><?php echo $releaseorder['ammount'];?></td>
                    </tr>
                <?php
				if(isset($releaseorder['status']) && $releaseorder['status']!='cancel'){
			@	$tot+=$releaseorder['ammount'];
				}
			}while($releaseorder=mysqli_fetch_assoc($re));
		}
		if($cash!=''){
			do{
				?>
                <tr>
                    	<td><?php echo $i++;?></td>
                        <?php if($cash['payby']=='cheque'){?>
                        <td><?php echo $cash['paymentid']."&nbsp;&nbsp;&nbsp; Bank Name:$cash[bankname] &nbsp;&nbsp;&nbsp; Cheque No.:$cash[cheque]";?></td>
                        <?php } else{?>
                        <td><?php echo $cash['paymentid'];?></td>
                        <?php }?>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo $cash['datee'];?>
                        </td><td><?php echo $cash['ammount'];?></td>
                        <td>-</td>

                    </tr>
                <?php
				$tot-=$cash['ammount'];
			}while($cash=mysqli_fetch_assoc($ca));
		}
	}
?>
<tr>
	<td colspan="7" style="text-align:right;">Closing Bal:<?php echo $tot;?></td>
</tr>
</table>
<script>
	function suprintout(){
		window.print();
	}
</script>
