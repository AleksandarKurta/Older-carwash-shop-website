<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';?>
<?php include '../classes/Category.php';?>
<?php include '../classes/Brand.php';?>
<?php
	$pr = new Product();
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
		$action = $_POST['action'];
		if(!isset($action) || empty($action)){
			$action = null;
		}
		$addPro  = $pr->addProduct($_POST, $_FILES, $action);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Dodaj Novi Proizvod</h2>
        <div class="block">  
		<?php
			if(isset($addPro)){
				echo $addPro;
			}
		?>
         <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Ime</label>
                    </td>
                    <td>
                        <input type="text" name="productName" placeholder="Unesi Ime Prozivoda..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Kategorija</label>
                    </td>
                    <td>
							<select id="select" name="catId">
                            <option>Izaberi Kategoriju</option>
							<?php
								$cat = new Category();
								$getCat = $cat->getAllCat();
								if($getCat){
									foreach($getCat as $result){
								
							?>
                            <option value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
							<?php 	
									}
								}
							?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brend</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Izaberi Brend</option>
				<?php
					$br = new Brand();
					$getBrand = $br->getAllBrand();
					if($getBrand){
						foreach($getBrand as $result){
				?>
                            <option value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></option>
				<?php
						}
					}
				?>
						 </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Opis</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Cena</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Unesi Cenu..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Izaberi Sliku</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Akcija</label>
                    </td>
                    <td>
                        <input type="text" name="action" placeholder="Unesi Cenu Proizvoda Na Akciji..." class="medium" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Tip Proizvoda</label>
                    </td>
                    <td>
                        <select id="select"  name="type">
                            <option>Izaberi Tip</option>
                            <option value="1">Istaknut</option>
                            <option value="0">Ne-Istaknut</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Sacuvaj" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


