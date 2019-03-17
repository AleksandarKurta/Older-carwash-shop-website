<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php
	$br = new Brand();
	if(isset($_GET['delbrand'])){
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['delbrand']);
		$delBrand = $br->deleteBrand($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Lista Brendova</h2>
                <div class="block">   
		<?php 
			if(isset($delBrand)){
				echo $delBrand;
			}
		?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serijski Br.</th>
							<th>Ime Kategorije</th>
							<th>Radnja</th>
						</tr>
					</thead>
				<tbody>
		<?php
			$getBrand = $br->getAllBrand();
			$i = 0;
			if($getBrand){
				foreach($getBrand as $result){
					$i++;
		?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName'] ; ?></td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brandId'] ; ?>">Izmeni</a> || <a onclick="return confirm('Da li ste sigurni da zelite da obrisete?')" href="?delbrand=<?php echo $result['brandId'] ; ?>">Obrisi</a></td>
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