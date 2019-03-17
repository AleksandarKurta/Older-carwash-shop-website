<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class AdminLogin{
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function checkAdminLogin($adminUser, $adminPass){
		$adminUser = $this->fm->validation($adminUser);
		$adminPass = $this->fm->validation($adminPass);
		
		if(empty($adminUser) || empty($adminPass)){
			$msg = "<div class='error'>Polja Ne Smeju Biti Prazna</div>";
			return $msg;
		}else{
			$sql = "SELECT * FROM tbl_admin WHERE adminUser = :adminUser AND adminPass = :adminPass";
			$query = $this->db->pdo->prepare($sql);
			$query->bindvalue(':adminUser',$adminUser);
			$query->bindvalue(':adminPass',$adminPass);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			if($result){
				Session::init();
				Session::set("login", true);
				Session::set("adminUser", $result->adminUser);
				Session::set("adminName", $result->adminName);
				header("Location:index.php");
			}else{
				$msg = "<div class='error'><strong>Error ! 	</strong>Data not found!</div>";
				return $msg;
			}
		}
	}
	
}
?>