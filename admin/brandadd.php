<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php
	$br = new Brand();
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
		$brandName = $_POST['brandName'];
		$addBrand  = $br->addBrand($brandName);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Dodaj Novi Brend</h2>
               <div class="block copyblock"> 
	<?php
		if(isset($addBrand)){
			echo $addBrand;
		}
	?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" placeholder="Unesi Ime Brenda..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Sacuvaj" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>