<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php
	if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
		echo "<script>window.location = 'brandlist.php';</script>";
	}else{
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['brandid']);
	}
?>
<?php
	$br = new Brand();
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
		$brandName = $_POST['brandName'];
		$editBrand  = $br->editBrand($brandName,$id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Izmeni Brend</h2>
               <div class="block copyblock"> 
<?php
	if(isset($editBrand)){
		echo $editBrand;
	}
?>
		<?php
		$getBrand = $br->getBrandById($id);
			if($getBrand){
				foreach($getBrand as $result){
		?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Sacuvaj" />
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
<?php include 'inc/footer.php';?>