<?php include 'inc/header.php'; ?>	
<?php include 'inc/sidebar.php'; ?>	
<?php include '../classes/Contact.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inboks</h2>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<td>Br.</td>
							<td>Ime</td>
							<td>E-Mail</td>
							<td>Datum</td>
							<td>Poruka</td>
							<td>Radnja</td>
						</tr>
					</thead>
					<tbody>
			<?php
				$co = new Contact();
				$getmsg = $co->getMessage();
				if($getmsg){
					$i = 0;
					foreach($getmsg as $result){
					$i++;
			?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td> <?php echo $result['date']; ?></td>
							<td><?php echo $result['body']; ?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">Pregedaj</a> ||
								<a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Odgovori</a> ||
								<a onclick="return confirm('Da li ste sigurni da zelite da premestite u Procitane Poruke?')" href="?seendid=<?php echo $result['id']; ?>">Premesti</a>
							</td>
						</tr>
			<?php
					}
				}
			?>
					</tbody>
				</table>
               </div>
            </div>
			
			
			
			<div class="box round first grid">
                <h2>Procitane Poruke</h2>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<td>Br.</td>
							<td>Ime</td>
							<td>E-Mail</td>
							<td>Datum</td>
							<td>Poruka</td>
							<td>Radnja</td>
						</tr>
					</thead>
					<tbody>
			<?php
				$co = new Contact();
				$getmsg = $co->getMessage();
				if($getmsg){
					$i = 0;
					foreach($getmsg as $result){
					$i++;
			?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td> <?php echo $result['date']; ?></td>
							<td><?php echo $result['body']; ?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">Pregledaj</a> ||
								<a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Obrisi</a> 
							</td>
						</tr>
			<?php
					}
				}
			?>
					</tbody>
				</table>
               </div>
            </div>
			
			
			<div class="box round first grid">
                <h2>Poslate Poruke</h2>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<td>Br.</td>
							<td>Primalac</td>
							<td>Posaljioc</td>
							<td>Naziv Poruke</td>
							<td>Poruka</td>
							<td>Radnja</td>
						</tr>
					</thead>
					<tbody>
			<?php
				$co = new Contact();
				$getmsg = $co->getMessage();
				if($getmsg){
					$i = 0;
					foreach($getmsg as $result){
					$i++;
			?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td> <?php echo $result['date']; ?></td>
							<td><?php echo $result['body']; ?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">Pregledaj</a> ||
								<a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Obrisi</a> 
							</td>
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
<?php include 'inc/footer.php'; ?>	
