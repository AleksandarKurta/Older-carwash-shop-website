<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Brand{
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function addBrand($brandName){
		$brandName = $this->fm->validation($brandName);
		
		if(empty($brandName)){
			$msg = "<span class='error'>Polja Ne Smeju Biti Prazna</span>";
			return $msg;
		}else{
			$sql = "INSERT INTO tbl_brand(brandName) VALUES(:brandName)";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':brandName',$brandName);
			$result = $query->execute();
			if($result){
				$msg = "<span class='succes'>Brend Uspesno Dodat</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Dodavanje Brenda Neuspesno</span>";
				return $msg;
			}
		}
	}
	
	public function getAllBrand(){
		$sql = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function getBrandById($id){
		$sql = "SELECT * FROM tbl_brand WHERE brandId = :id";
		$query = $this->db->pdo->prepare($sql);
		$query->bindvalue(':id',$id);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function editBrand($brandName,$id){
		$brandName = $this->fm->validation($brandName);
		
		if(empty($brandName)){
			$msg = "<span class='error'>Polja Ne Smeju Biti Prazna</span>";
			return $msg;
		}else{
			$sql = "UPDATE tbl_brand SET
					brandName = :brandName
					WHERE brandId = :id ";
			$query = $this->db->pdo->prepare($sql);
			$query->bindvalue(':brandName',$brandName);
			$query->bindvalue(':id',$id);
			$result = $query->execute();
			if($result){
				$msg = "<span class='succes'>Promena Brenda Uspesna</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Promena Brenda Neuspesna</span>";
				return $msg;
			}
		}
	}
	
	public function deleteBrand($id){
		$sql = "DELETE FROM tbl_brand WHERE brandId = :id";
		$query = $this->db->pdo->prepare($sql);
		$query->bindvalue(':id',$id);
		$result = $query->execute();
		if($result){
			$msg = "<span class='succes'>Brend Uspesno Obrisan</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Brisanje Brenda Neuspesno</span>";
			return $msg;
		}
	}
	
}