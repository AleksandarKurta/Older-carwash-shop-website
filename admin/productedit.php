<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php
	if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
		echo "<script>window.location = 'productlist.php'; </script>";
	}else{
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['proid']);
	}
	$pr = new Product();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$action = $_POST['action'];
		if(!isset($action) || empty($action)){
			$action = null;
		}
		$editPro = $pr->editProduct($_POST,$_FILES, $id,$action);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">  
		<?php
			if(isset($editPro)){
				echo($editPro);
			}
		?>
		<?php
			$getPro = $pr->getProById($id);
			if($getPro){
				foreach($getPro as $result){
		?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Ime</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result['productName']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Kategorija</label>
                    </td>
                    <td>
				          <select id="select" name="catId" >
                            <option>Izaberi Kategoriju</option>
							<?php
								$cat = new Category();
								$getCat = $cat->getAllCat();
								if($getCat){
									foreach($getCat as $res){
								
							?>
                            <option 
								<?php 
									if($result['catId'] == $res['catId']){ ?>
										selected = "selected"
								<?php	} 	?>
							value="<?php echo $res['catId']; ?>"><?php echo $res['catName']; ?></option>
							<?php 	
									}
								}
							?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Marka</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Izaberi Marku</option>
                           <?php
								$br = new Brand();
								$getBrand = $br->getAllBrand();
								if($getBrand){
									foreach($getBrand as $res){
								
							?>
                            <option 
								<?php
									if($result['brandId'] == $res['brandId']){ ?>
										selected = "selected"
								<?php	} ?>
							value="<?php echo $res['brandId']; ?>"><?php echo $res['brandName']; ?></option>
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
                        <textarea class="tinymce" name="body"><?php echo $result['body']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Cena</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Promeni Sliku</label>
                    </td>
                    <td>
						<img src="<?php echo $result['image'];?>" height="80px" width="120px"/>
						<br/>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Akcija</label>
                    </td>
                    <td>
                        <input type="text" name="action" value="<?php echo $result['action']; ?>" class="medium" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Tip Proizvoda</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Izaberi Tip</option>
                            <?php 
								if($result['type'] == 0){ ?>
									<option selected = "selected" value="0">Istaknut</option>
									<option value="1">Opsti</option>
							<?php }else { ?>
									<option value="0">Istaknut</option>
									<option  selected = "selected" value="1">Opsti</option>
							<?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Azuriraj" />
                    </td>
                </tr>
            </table>
            </form>
			<?php
				}
			}
			?>
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