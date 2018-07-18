<?php
	//session_start();
	//include "../../config.php";
	//include "../../function.php";
	$id=$_SESSION['clogin']['id'];
	$cominfo=mysqli_fetch_assoc(mysqli_query($con,"select id,name,address,pincode,email,astart,logo,signname,gst from company where id=$id"));
	if(isset($_POST['name'])){
		if(isset($_FILES['logo']['name']) && $_FILES['logo']['name']){
			if(isset($cominfo['logo']) && $cominfo['logo']){
				$oldfile=$cominfo['logo'];
				unlink("clogo/$oldfile");
				$_POST['logo']=time()."_".$_FILES['logo']['name'];	
			}
			else{
				$_POST['logo']=time()."_".$_FILES['logo']['name'];
			}
			move_uploaded_file($_FILES['logo']['tmp_name'],'clogo/'.$_POST['logo']);
		}	
		else{
			if(isset($cominfo['logo']) && $cominfo['logo']){
				$_POST['logo']=$cominfo['logo'];	
			}	
		}
		addEdit('company',$_POST,$id);
	}
?>		
        
<div style="text-align:left; font-size:20px">
<div style="font-size:36px; font-weight:bolder; text-align:center">Edit Company Form</div>
<form method="post" action="#" enctype="multipart/form-data">
<div style="width:800px; margin-left:50px;">
<br />
	<div style="float:left; width:300px">Name:</div> <div><input type="text" value="<?php if(isset($cominfo['name']) && $cominfo['name']){echo $cominfo['name'];}?>" name="name" placeholder="Name"></div> 
<br />
	<div style="float:left; width:300px">Email:</div> <div><input type="text" value="<?php if(isset($cominfo['email']) && $cominfo['email']){echo $cominfo['email'];}?>" name="email" placeholder="Email"></div>
<br />
	<div style="float:left; width:300px">Signature Line:</div> <div><input type="text" value="<?php if(isset($cominfo['signname']) && $cominfo['signname']){echo $cominfo['signname'];}?>" name="signname" placeholder="Signature Name"></div>
<br />
	<div style="float:left; width:300px">PinCode:</div> <div><input value="<?php if(isset($cominfo['pincode']) && $cominfo['pincode']){echo $cominfo['pincode'];}?>" type="text" name="pincode" placeholder="pincode"></div>
<br />
	<div style="float:left; width:300px">Financial Year From:</div> <div><input type="text" name="astart" value="<?php if(isset($cominfo['astart']) && $cominfo['astart']){echo $cominfo['astart'];}?>" placeholder="01/01/2000"></div>
<br />
	<div style="float:left; width:300px">GST No.:</div> <div><input type="text" name="gst" value="<?php if(isset($cominfo['gst']) && $cominfo['gst']){echo $cominfo['gst'];}?>" ></div>
<br />
<div>
	<img src="clogo/<?php echo $cominfo['logo'];?>" height="200px" width="200px;">
</div>
<br>
	<div style="float:left; width:300px">Company Logo:</div> <div><input type="file" name="logo" ></div>
<br />
	<div style="text-align:center"><input type="submit" value="Save Data" /></div>
<br /><br />
</div>
</form>
</div>
</div>
</div>
<script>
	function cityy(stid){
		$.ajax({
			url:"module/company/showcity.php",
			data:"stateid="+stid,
			type:'POST',
			success: function(e){
				$('#city').html(e);	
			}
		})
	}
</script>