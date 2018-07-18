<?php
	if(isset($_POST['name'])){
		if(isset($_FILES['logo']['name']) && $_FILES['logo']['name']){
			$_POST['logo']=time()."_".$_FILES['logo']['name'];
			move_uploaded_file($_FILES['logo']['tmp_name'],'clogo/'.$_POST['logo']);	
		}	
		$_POST['datee']=date("Y-m-d");
		addEdit('company',$_POST);
	}?>		
        
<div style="text-align:left; font-size:20px">
<div style="font-size:36px; font-weight:bolder; text-align:center">Create Company Form</div>
<form method="post" action="#" enctype="multipart/form-data">
<div style="width:800px; margin-left:50px;">
<br />
	<div style="float:left; width:300px">Name:</div> <div><input type="text" name="name" placeholder="Name"></div> 
<br />
	<div style="float:left; width:300px">Email:</div> <div><input type="text" name="email" placeholder="Email"></div>
<br />
	<div style="float:left; width:300px">Password:</div> <div><input type="password" name="password" placeholder="Password"></div> 
<br />
	<div style="float:left; width:300px">Address:</div> <div><textarea name="address"></textarea></div>
<br />
	<div style="float:left; width:300px">State:</div> <div>
    	<select name="stateid" onChange="cityy(this.value)">
    		<option><-- Select State --></option>
            <?php
				$s=mysqli_query($con,"select id,state from state order by state asc");
				while($state=mysqli_fetch_assoc($s)){
				?>
                	<option value="<?php echo $state['id'];?>"><?php echo $state['state'];?>
                <?php	
				}
			?>
        </select>
    </div>
<br />
	<div style="float:left; width:300px">City:</div> <div>
    	<select id="city" name="cityid">
    		<option><-- Select State First --></option>
        </select>
    </div>
<br />
	<div style="float:left; width:300px">PinCode:</div> <div><input type="text" name="pincode" placeholder="pincode"></div>
<br />
	<div style="float:left; width:300px">Financial Year From:</div> <div><input type="date" name="astart" placeholder="01/01/2000"></div>
<br />
	<div style="float:left; width:300px">Company Logo:</div> <div><input type="file" name="logo" placeholder="01/01/2000"></div>
<br />
	<div style="text-align:center"><input type="submit" value="Save Data" /></div>
<br /><br />
</div>
</form>
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