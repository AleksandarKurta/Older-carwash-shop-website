<?php include_once "inc/header.php"; ?>

<?php
	if(isset($_GET['proid'])){
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['proid']);
	}
?>
	<div class="main">
		<div class="content_top">
			<p>Proizvodi</p>
		</div>
		
			<div class="section">
	
	<?php
		$getPd = $pr->getSingleProduct($id);
		if($getPd){
			foreach($getPd as $productRes){
	?>
			<img class="imgdetail" src="admin/<?php echo $productRes['image']; ?>" alt="" />
			<div class="detailright">
				<h2><?php echo $productRes['productName']; ?></h2>
				<p>Kategorija: <span><?php echo $productRes['catName']; ?></span></p>
				<p>Brend: <span><?php echo $productRes['brandName']; ?></span></p>
				<p>Cena: <span><?php echo $productRes['price']; ?></span> din.</p>
			</div>
			<div class="clear"></div>
			<div class="opis">
				<h3>Opis: </h3>
				<p><?php echo $productRes['body']; ?></p>
			</div>
	<?php
			}
		}
	?>

			</div>
			
		
		<div class="clear"></div>
	</div>
<?php include_once "inc/footer.php"; ?>