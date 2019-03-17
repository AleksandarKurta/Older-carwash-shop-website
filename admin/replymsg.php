<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Contact.php';?>
<?php
	if(!isset($_GET['msgid']) || $_GET['msgid'] == NULL){
		echo "<script>window.location = 'inbox.php'; </script>"; 
	}else{
		$id = $_GET['msgid'];
	}
	
	$co = new Contact();
	$viewemail = $co->viewEmail($id);
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Odgovori na Poruku</h2>
	<?php
		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
			$sendmsg = $co->replyMessage($_POST);
		}
	?>
	<div class="block">
	<?php
		if(isset($sendmsg)){
			echo $sendmsg;
		}
	?>
         <form action="" method="POST" >
	<?php
		if($viewemail){
			foreach($viewemail as $result){
	?>
            <table class="form">
               
                <tr>
                    <td>
                        <label>Primalac</label>
                    </td>
                    <td>
                        <input type="email" name="receiver" value="<?php echo $result['email']; ?>" class="medium" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Posaljioc</label>
                    </td>
                    <td>
                        <input type="email" name="sender" placeholder="Unesite vasu E-Mail adresu..." class="medium" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Naziv Poruke</label>
                    </td>
                    <td>
                        <input type="text" name="subject" placeholder="Unesite naziv poruke..." class="medium" />
                    </td>
                </tr>


				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Poruka</label>
                    </td>
                    <td>
                        <textarea class="tinymce"  name="message"></textarea>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Posalji" />
                    </td>
                </tr>
            </table>
	<?php
			}
		}
	?>
            </form>
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