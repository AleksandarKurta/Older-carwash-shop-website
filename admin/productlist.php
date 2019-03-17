<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';?>
<?php
	$pr = new Product();
	if(isset($_GET['delpro'])){
		$id = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['delpro']);
		$delPro = $pr->deleteProduct($id);
	}
	
	if(isset($_GET['actoff'])){
		$offid = $_GET['actoff'];
		$action = null;
		$delAct = $pr->deleteAction($action, $offid);
	}
	
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
		<?php
			if(isset($delPro)){
				echo $delPro;
			}
			if(isset($delAct)){
				echo $delAct;
			}
		?>
        <div class="block">
		<form action="" method="GET">
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Br.</th>
					<th>Ime Prozivoda</th>
					<th>Kategorija</th>
					<th>Brend</th>
					<th>Opis</th>
					<th>Cena</th>
					<th>Slika</th>
					<th>Tip</th>
					<th>Akcija</th>
					<th>Radnja</th>
				</tr>
			</thead>
			<tbody>
		<?php
			$getPro = $pr->getAllProduct();
			$i = 0;
			if($getPro){
				foreach($getPro as $result){
					$i++;
		?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td><?php echo $result['catName']; ?></td>
					<td><?php echo $result['brandName']; ?></td>
					<td><?php echo $result['body']; ?></td>
					<td><?php echo $result['price']; ?>din.</td>
					<td><img src="<?php echo $result['image']; ?>"  width="60px"></td>
					<td><?php echo $result['type']; ?></td>
					<td>
					<?php	if($result['action'] != NULL ){ ?>
						<?php echo $result['action'];?>din. <a onclick="return confirm('Da li ste sigurni da zelite da Uklonite Akciju?')"
					href="?actoff=<?php echo $result['productId'] ?>">Ukloni</a>
					<?php }else{ 
						echo "Nije Na Akciji";
					}
					?></td>
					<td><a href="productedit.php?proid=<?php echo $result['productId']; ?>">Izmeni</a> || <a onclick="return confirm('Da li ste sigurni da zelite da Obrisete?')" href="?delpro=<?php echo $result['productId']; ?>">Obrisi</a></td>
				</tr>
		<?php
				}
			}
		?>
			</tbody>
		</table>
		</form>
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
