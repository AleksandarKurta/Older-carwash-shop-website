<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php';?>
<?php
	if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
		echo "<script>window.location = 'catlist.php';</script>";
	}else{
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['catid']);
	}
?>
<?php
	$cat = new Category();
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
		$catName = $_POST['catName'];
		$editCat  = $cat->editCategory($catName,$_FILES,$id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Izmeni Kategoriju</h2>
               <div class="block copyblock"> 
<?php
	if(isset($editCat)){
		echo $editCat;
	}
?>
		<?php
		$getCat = $cat->getCatById($id);
			if($getCat){
				foreach($getCat as $result){
		?>
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr>
							<td><label>Promeni Sliku</label>
								<img src="<?php echo $result['catImg'];?>" height="80px" width="120px"/>
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
		<?php
				}
			}
		?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>