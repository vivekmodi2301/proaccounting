<?php
session_start();
include "config.php";
include "function.php";
include "header.php";
$mod="home";
$do="middle";
if(isset($_GET['mod'])){
	$mod=$_GET['mod'];
	$do=$_GET['do'];
}
include "module/$mod/$do.php";
if(isset($_SESSION['clogin'])){
include "right.php";
}
?>
