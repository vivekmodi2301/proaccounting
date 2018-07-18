<?php
		@session_start();
?>
<input type="button" value="Print" onclick="suprintout()">
<table border="1px" cellspacing="0" width="100%">
<tr>
	<td>S.No.</td>
	<td>Invoice/Recipt No.</td>
	<td>Date</td>
    <td colspan="2">Ammount</td>
</tr>
<?php

//echo "hi";
	include "../../config.php";
	include "../../function.php";
	//print_r($_POST);exit;
	$id=$_SESSION['clogin']['id'];
	$wh="";
	if(isset($_POST['client'])){
		$cid=$_POST['client'];
		$fdatee=$_POST['fdatee'];
		$tdatee=$_POST['tdatee'];
			$obal=mysqli_fetch_assoc(mysqli_query($con,"select obal,drcr from client where id=$cid"));
			$tot=0;
		//echo "hi";exit;
		$opbal=$obal['obal'];
		if($obal['drcr']=='dr'){
			$tot+=$obal['obal'];
			//echo $tot;
		}
		else{
			$tot-=$obal['obal'];	
		}
		?>
        	<tr>
            	<td colspan="5" style="text-align:right;">Opening Balance:<?php if($obal['drcr']=='cr'){echo "-";} echo $opbal;?></td>
            </tr>
        <?php
		$re=mysqli_query($con," select id,invoiceno,invoicedate as datee,totamm as ammount, status  from invoice where coid=$id and cid=$cid and  invoicedate BETWEEN '$fdatee' AND '$tdatee' order by invoicedate asc
");

//echo " select id,invoiceno,invoicedate as datee,totamm as ammount, status  from invoice where coid=$id and cid=$cid and  invoicedate BETWEEN '$fdatee' AND '$tdatee' order by invoicedate asc";
		
		$releaseorder=mysqli_fetch_assoc($re);
		$ca=mysqli_query($con,"select id,ammount,datee,reciptid,payby,bankname,cheque from cash where coid=$id and cid=$cid and datee BETWEEN '$fdatee' AND '$tdatee' order by datee asc");
		//echo "select id,ammount,datee,reciptid,payby,bankname,cheque from cash where coid=$id and cid=$cid  and datee BETWEEN '$fdatee' AND '$tdatee' order by datee asc";
		$cash=mysqli_fetch_assoc($ca);
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
                    	<td><?php if(isset($releaseorder['status']) && $releaseorder['status']=='cancel'){ echo "Cancel";} else{ echo $i++;} //echo "1";exit;?></td>
                        <td><?php echo $releaseorder['invoiceno'];?></td>
                        <td><?php echo $releaseorder['datee'];?></td>
                        <td><?php echo $releaseorder['ammount'];?></td>
                        <td>-</td>
                    </tr>        
                <?php
				if(isset($releaseorder['status']) && $releaseorder['status']!='cancel'){
					$tot+=$releaseorder['ammount'];	
				}
				$releaseorder=mysqli_fetch_assoc($re);
				
				//print_r($releaseorder);exit;
			}	
			else if($releaseorder['datee']>$cash['datee']){
				//echo "hi";exit;
			?>
				<tr>
                    	<td><?php echo $i++;?></td>
						<?php if($cash['payby']=='cheque'){?>
                        <td><?php echo $cash['reciptid']."&nbsp;&nbsp;&nbsp; Bank Name:$cash[bankname] &nbsp;&nbsp;&nbsp; Cheque No.:$cash[cheque]";?></td>
                        <?php } else{?>
                        <td><?php echo $cash['reciptid'];?></td>
                        <?php }?>
                        <td><?php echo $cash['datee'];?></td>
                        <td>-</td>
                        <td><?php echo $cash['ammount'];?></td>
                    </tr>   
                    <?php
					$tot-=$cash['ammount'];
					$cash=mysqli_fetch_assoc($ca);
			}
			else{
				?>
        			<tr>
                    	<td><?php if(isset($releaseorder['status']) && $releaseorder['status']=='cancel'){ echo "Cancel";} else{ echo $i++;} //echo "2";exit;?></td>
                        <td><?php echo $releaseorder['invoiceno'];?></td>
                        <td><?php echo $releaseorder['datee'];?></td>
                        <td><?php echo $releaseorder['ammount'];?></td>
                        <td>-</td>
                    </tr>
                    <tr>
                    	<td><?php echo $i++;?></td>
						<?php if($cash['payby']=='cheque'){?>
                        <td><?php echo $cash['reciptid']."&nbsp;&nbsp;&nbsp; Bank Name:$cash[bankname] &nbsp;&nbsp;&nbsp; Cheque No.:$cash[cheque]";?></td>
                        <?php } else{?>
                        <td><?php echo $cash['reciptid'];?></td>
                        <?php }?>
                        <td><?php echo $cash['datee'];?></td>
                        <td>-</td>
                        <td><?php echo $cash['ammount'];?></td>
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
                    	<td><?php if(isset($releaseorder['status']) && $releaseorder['status']=='cancel'){ echo "Cancel";} else{ echo $i++;} echo "3";exit;?></td>
                        <td><?php echo $releaseorder['invoiceno'];?></td>
                        <td><?php echo $releaseorder['datee'];?></td>
                        <td><?php echo $releaseorder['ammount'];?></td>
                        <td>-</td>
                    </tr>
                <?php
				if(isset($releaseorder['status']) && $releaseorder['status']!='cancel'){
					$tot+=$releaseorder['ammount'];	
				}
			}while($releaseorder=mysqli_fetch_assoc($re));
		}
		if($cash!=''){
			do{
				?>
                <tr>
                    	<td><?php echo $i++;?></td>
						<?php if($cash['payby']=='cheque'){?>
                        <td><?php echo $cash['reciptid']."&nbsp;&nbsp;&nbsp; Bank Name:$cash[bankname] &nbsp;&nbsp;&nbsp; Cheque No.:$cash[cheque]";?></td>
                        <?php } else{?>
                        <td><?php echo $cash['reciptid'];?></td>
                        <?php }?>
                        <td><?php echo $cash['datee'];?></td>
                        <td>-</td>
                        <td><?php echo $cash['ammount'];?></td>
                    </tr>
                <?php	
				$tot-=$cash['ammount'];
			}while($cash=mysqli_fetch_assoc($ca));
		}
	}
?>
<tr>
	<td colspan="5" style="text-align:right;">Closing Bal:<?php echo $tot;?></td>
</tr>
</table>
<script>
	function suprintout(){
		window.print();
	}
</script>