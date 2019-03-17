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
	$viewmsg = $co->viewMessage($id);
	
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Poruka</h2>
        
<?php
	if($_SERVER['REQUEST_METHOD'] == "POST" ){
		echo "<script>window.location = 'inbox.php'; </script>"; 
	}	
?>
	<div class="block">  
         <form action="" method="POST" >
	<?php
		if($viewmsg){
			foreach($viewmsg as $result){
	?>
            <table class="form">
               
                <tr>
                    <td>
                        <label>Ime</label>
                    </td>
                    <td>
                        <input type="text" name="name" readonly value="<?php echo $result['name']; ?>" class="medium" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>E-Mail</label>
                    </td>
                    <td>
                        <input type="text" name="email" readonly value="<?php echo $result['email']; ?>" class="medium" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Datum</label>
                    </td>
                    <td>
                        <input type="text" name="date" readonly value="<?php echo $fm->formatDate($result['date']); ?>" class="medium" />
                    </td>
                </tr>


				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Poruka</label>
                    </td>
                    <td>
                        <textarea class="tinymce"  name="body"><?php echo $result['body']; ?></textarea>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="OK" />
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