<?php
  $con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
  
function addEdit($table,$data,$id='')
{
	//print_r($data);exit;
  $con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
  $sql="insert into $table set ";
  $wh="";
  if($id)
  {
     $sql="update $table set ";
	 $wh=" where id=$id";
  }
  foreach($data as $cname=>$colvalue)
  {
	  
	 $sql=$sql."$cname='$colvalue', ";
  }
  $sql=substr($sql,0,-2).$wh;
  //echo $sql;exit;
  mysqli_query($con,$sql);
}
function deleteDbRecord($table,$id)
{
   $con=mysqli_connect(LOCALHOST,USERNAME,PASSWORD,DB);
   $sql="delete from $table where id=$id";
   //echo $sql;exit;
   mysqli_query($con,$sql);
}
?>