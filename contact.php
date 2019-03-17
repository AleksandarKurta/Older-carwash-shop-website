<?php include_once "inc/header.php"; ?>
	<div class="test">
<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
		$addmsg = $co->contactMessage($_POST);
	}
?>

	<div class="main">
	<div class="content_top">
		<p>Kontakt</p>
	</div>
	
	<div class="contact_form">
<?php
	if(isset($addmsg)){
		echo $addmsg;
	}
?>
		<form action="" method="POST">
		<table>
			<tr>
				<td><input type="text" name="name" placeholder="Ime*" /></td>
			</tr>
			<tr>
				<td><input type="text" name="email" placeholder="E-Mail*" /></td>
			</tr>
			<tr>
				<td><textarea name="body" placeholder="Poruka*" ></textarea></td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="submit" value="Posalji"/>
				</td>
			</tr>
			</table>
		</form>	
	</div>
	
	<div class="info_right">
		<h5>Praonica - Ehrle Stanisic</h5>
		<p>Adresa - <span>Oslobodjenja br. 200</br></br>
		Stanisic, Republika Srbija.</span></p>
		<span style="text-decoration:underline"><strong>Generalni Menadzer:</strong></span>
		<p><span>Stefan Tokic</span></p>
		<p>Telefon: <span>064 200 300</span></p>
		<p>Telefon: <span>063 400 500</span></p>
		<p>E-Mail: <a href="mailto:stefantokic@gmail.com">stefantokic@gmail.com</a></p>
	</div>
	<div class="clear"></div>	
	</div>
	</div>
<?php include_once "inc/footer.php"; ?>	 
