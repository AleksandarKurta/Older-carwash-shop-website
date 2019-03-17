	<div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Informacije</h4>
						<ul>
						<li><a href="#">O Nama</a></li>
						<li><a href="#">Pretraga</a></li>
						<li><a href="#">Kontakt</a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>AC Tokic</h4>
						<ul>
							<li><a href="vulkanizer.php">Vulkanizer</a></li>
							<li><a href="carwash.php">Praonica</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Proizvodi</h4>
					<ul>
		<?php
			$getPro = $ca->getAllCat();
			if($getPro){
				foreach($getPro as $resProduct){
		?>
						
							<li><a href="productbycat.php?catId=<?php echo $resProduct['catId']; ?>" ><?php echo $resProduct['catName']; ?></a></li>
						
		<?php
				}
			}
		?>
					</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Kontakt</h4>
						<ul>
							<li><span>064 400 500</span></li>
							<li><span>063 200 300</span></li>
						</ul>
						<div class="social-icons">
							<h4>Pratite Nas</h4>
					   		  <ul>
							      <a href="https:www.facebook.com"><img src="images/fb.png" alt="" /></a>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
     </div>
    </div>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
	 <script type="text/javascript" src="js/aos.js"></script>
<script type="text/javascript">
	AOS.init();
</script>
</body>
</html>