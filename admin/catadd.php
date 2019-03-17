<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';?>
<?php
	$cat = new Category();
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
		$catName = $_POST['catName'];
		$addCat  = $cat->addCategory($catName,$_FILES);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Dodaj Novu Kategoriju</h2>
               <div class="block copyblock"> 
<?php
	if(isset($addCat)){
		echo $addCat;
	}
?>
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Unesi Ime Kategorije..." class="medium" />
                            </td>
                        </tr>
						<tr>
							<td><label>Slika</label>
								<input type="file" name="catImg"/>
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