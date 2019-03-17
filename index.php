<?php include_once "inc/header.php"; ?>
<?php include_once "inc/slider.php"; ?>

	
		
		<div class="main">
	
			<div class="content_top">
			<p>Izdvajamo</p>
			</div>
			<div class="clear"></div>
			<div class="section">
	<?php
		$getFpro = $pr->getFeaturedProduct();
		if($getFpro){
			foreach($getFpro as $res){
	?>
				<div class="product" data-aos="flip-left" data-aos-duration="2000" >
					<a href="preview.html"><img src="admin/<?php echo $res['image']; ?>" alt="" /></a>
					<h4><?php echo $res['productName']; ?></h4>
					<p>Cena: <?php echo $res['price']; ?>din.</p>
					<div class="button"><span><a href="details.php?proid=<?php echo $res['productId']; ?>" class="details">Detalji</a></span></div>
				</div>
	<?php
			}
		}
	?>
				
				<div class="clear"></div>
			</div>
			
			<div class="clear"></div>
						<div class="content_top">
			<p>Akcija</p>
			</div>
			<div class="clear"></div>
			<div class="section">
	<?php
		$getApro = $pr->getProductOnAction();
		if($getApro){
			foreach($getApro as $resAct){
	?>
				<div class="product">
					<a href="preview.html"><img src="admin/<?php echo $resAct['image']; ?>" alt="" /></a>
					<h4><?php echo $resAct['productName']; ?></h4>
					<p><span>Stara cena <?php echo $resAct['price']; ?>din.</span></p>
					<p><strong>Akcija <?php echo $resAct['action']; ?>din.</strong></p>
					<div class="button"><span><a href="details.php?proid=<?php echo $res['productId']; ?>" class="details">Detalji</a></span></div>
				</div>
	<?php
			}
		}else{
			echo "Nema Proizvoda Na Akciji";
		}
	?>
				
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			
			
		
		</div>
<?php include_once "inc/footer.php"; ?>
