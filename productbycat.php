<?php include_once "inc/header.php"; ?>

<?php
	if(!isset($_GET['catId']) || $_GET['catId'] == NULL){
		echo "<script>window.location = '404.php'; </script>";
	}else{
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['catId']);
	}
?>
	<div class="main">
		<div class="content_top">
			<p>Proizvodi</p>
		</div>
		
			<div class="section">
	
	<?php
		$proByCat = $pr->getProductByCat($id);
		if($proByCat){
			foreach($proByCat as $resProByCat){
	?>
				<div class="product">
					<a href="preview.html"><img src="admin/<?php echo $resProByCat['image']; ?>" alt="" /></a>
					<h4><?php echo $resProByCat['productName']; ?></h4>
					<p>Cena: <?php echo $resProByCat['price']; ?>din.</p>
					<div class="button"><span><a href="details.php?proid=<?php echo $resProByCat['productId']; ?>" class="details">Detalji</a></span></div>
				</div>
	<?php
			}
		}else{
			echo "<p style='color:red;font-size:20px;'>Nema Dostupnih Proizvoda!</p>";
		}
	?>

			</div>
		
		<div class="clear"></div>
	</div>
<?php include_once "inc/footer.php"; ?>