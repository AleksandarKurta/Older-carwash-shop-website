<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php
	$cat = new Category();
	if(isset($_GET['delcat'])){
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['delcat']);
		$delCat = $cat->deleteCategory($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Lista Kategorija</h2>
                <div class="block">   
		<?php 
			if(isset($delCat)){
				echo $delCat;
			}
		?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serijski Br.</th>
							<th>Ime Kategorije</th>
							<th>Slika</th>
							<th>Radnja</th>
						</tr>
					</thead>
				<tbody>
		<?php
			$getCat = $cat->getAllCat();
			$i = 0;
			if($getCat){
				foreach($getCat as $result){
					$i++;
		?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName'] ; ?></td>
							<td><img src="<?php echo $result['catImg'] ; ?>" width="60px" ></td>
							<td><a href="catedit.php?catid=<?php echo $result['catId'] ; ?>">Izmeni</a> || <a onclick="return confirm('Da li ste sigurni da zelite da obrisete?')" href="?delcat=<?php echo $result['catId'] ; ?>">Obrisi</a></td>
						</tr>
		<?php
				}
			}
		?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

