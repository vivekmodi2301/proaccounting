<?php
session_start();
ob_start();
error_reporting(false);
include "config.php";
include "function.php";
include "header.php";
$mod="home";
$do="middle";
if(isset($_SESSION['clogin'])){
	if(isset($_GET['mod']) && $_GET['do']!='middle' && $_GET['do']!='selectcom' && $_GET['do']!='createfrm' ){
		$mod=$_GET['mod'];
		$do=$_GET['do'];
	}
	else{
		$mod="home";
		$do="current";
	}
}
else{
	if(isset($_GET['mod']) && $_GET['do']=='selectcom' || $_GET['do']=='createfrm' || $_GET['do']=='middle' || $_GET['do']=='companybackup'){
		$mod=$_GET['mod'];
		$do=$_GET['do'];
	}
}
include "module/$mod/$do.php";
if(isset($_SESSION['clogin'])){
include "right.php";
}
?>
