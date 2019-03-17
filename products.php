<?php include_once "inc/header.php"; ?>
	<div class="main">
		<div class="content_top">
			<p>Proizvodi</p>
		</div>
		
			<div class="section">
	
	<?php
		$getPro = $ca->getAllCat();
		if($getPro){
			foreach($getPro as $resProduct){
	?>
				<div class="product">
					<a href="preview.html"><img src="admin/<?php echo $resProduct['catImg']; ?>" alt="" /></a>
					<div class="button"><span><a href="productbycat.php?catId=<?php echo $resProduct['catId']; ?>" class="details"><?php echo $resProduct['catName']; ?></a></span></div>
				</div>
	<?php
			}
		}
	?>

			</div>
		
		<div class="clear"></div>
	</div>
<?php include_once "inc/footer.php"; ?>