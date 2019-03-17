<?php
	include_once 'lib/Session.php';
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';
	
	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});
	
	$pr = new Product();
	$ca = new Category();
	$br = new Brand();
	$co = new Contact();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Toktrade Export</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<link rel="stylesheet" href="css/aos.css">
</head>
<body>
	<div class="header">
		<div class="top">
		</div>
		<div class="headerbott">
			<div class="headerbottin">
				<div class="logo">
					<a href="index.php"><img src="images/logo.jpg" alt="" /></a>
					<h1>AC Tokic</h1>
				</div>
				<div class="socials">
					<a href="https:www.facebook.com"><img src="images/fb.png" alt="" /></a>
					<a href="https:www.twitter.com"><img src="images/tw.png" alt="" /></a>
				</div>
			</div>
			<div class="clear"></div> 
		</div>
		<div class="clear"></div> 
		<div class="menu">
			<ul class="navbar">
				<li><a href="index.php">Pocetna</a></li>
				<li><a href="">O Nama</a></li>
				<li><a href="products.php">Proizvodi</a></li>
				<li><a href="vulkanizer.php">Vulkanizer</a></li>
				<li><a href="carwash.php">Praonica</a></li>
				<li><a href="contact.php">Kontakt</a></li>
			</ul>
		</div>
		 <div class="clear"></div> 
	</div>
			 <div class="clear"></div> 