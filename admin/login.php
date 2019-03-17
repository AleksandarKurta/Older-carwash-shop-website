<?php include_once '../classes/Adminlogin.php'; ?>
<?php
	$al = new AdminLogin();
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$adminUser = $_POST['username'];
		$adminPass = md5($_POST['password']);
		$loginChk = $al->checkAdminLogin($adminUser, $adminPass);
	}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php
		if(isset($loginChk)){
			echo $loginChk;
		}
	?>
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username"  name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>