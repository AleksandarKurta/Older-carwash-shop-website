<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Category{
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function addCategory($catName,$file){
		$catName = $this->fm->validation($catName);

		$catNameChk = $this->CatNameCheck($catName);
		
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['catImg']['name'];
		$file_size = $file['catImg']['size'];
		$file_temp = $file['catImg']['tmp_name'];
	
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;
		
		if(empty($catName) || empty($file_name)){
			$msg = "<span class='error'>Polja Ne Smeju Biti Prazna</span>";
			return $msg;

			if($catNameChk == true){
				$msg = "<span class='error'>Kategorija vec Postoji";
				return $msg;
			}
			
		}elseif ($file_size >1048567) {
		echo "<span class='error'>Image Size should be less then 1MB!
		</span>";
		} elseif (in_array($file_ext, $permited) === false) {
		echo "<span class='error'>Mozete Uneti Samo:-"
		.implode(', ', $permited)."</span>";
		
		}else{
			move_uploaded_file($file_temp, $uploaded_image);
			
			$sql = "INSERT INTO tbl_category(catName,catImg) VALUES (:catName,:uploaded_image)";
			$query = $this->db->pdo->prepare($sql);
			$query->bindvalue(':catName',$catName);
			$query->bindvalue(':uploaded_image',$uploaded_image);
			$result = $query->execute();
			if($result){
				$msg = "<span class='succes'>Kategorija Uspesno Dodata</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Dodavanje Kategorije Neuspesno</span>";
				return $msg;
			}
		}
	}
	
	
	public function CatNameCheck($catName){
		$sql = "SELECT catName FROM tbl_category WHERE catName = :catName";
		$query = $this->db->pdo->prepare($sql);
		$query->bindvalue(':catName',$catName);
		$query->execute();
		if($query->rowCount() > 0){
			return true;
		}else{
			return false;
		}	
	}
	
	public function getAllCat(){
		$sql = "SELECT * FROM tbl_category ORDER BY catId DESC";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function getCatById($id){
		$sql = "SELECT * FROM tbl_category WHERE catId = :pera";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':pera',$id);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function editCategory($catName,$file,$id){
		$catName = $this->fm->validation($catName);

		$catNameChk = $this->CatNameCheck($catName);
		
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['catImg']['name'];
		$file_size = $file['catImg']['size'];
		$file_temp = $file['catImg']['tmp_name'];
	
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;
		
		if(empty($catName) || empty($file_name)){
			$msg = "<span class='error'>Polja Ne Smeju Biti Prazna</span>";
			return $msg;

			if($catNameChk == true){
				$msg = "<span class='error'>Kategorija vec Postoji";
				return $msg;
			}
			
		}elseif ($file_size >1048567) {
		echo "<span class='error'>Image Size should be less then 1MB!
		</span>";
		} elseif (in_array($file_ext, $permited) === false) {
		echo "<span class='error'>Mozete Uneti Samo:-"
		.implode(', ', $permited)."</span>";
		
		}else{
			move_uploaded_file($file_temp, $uploaded_image);
		
			$sql = "UPDATE tbl_category SET
					catName = :catName,
					catImg = :uploaded_image
					WHERE catId = :id ";
			$query = $this->db->pdo->prepare($sql);
			$query->bindvalue(':catName',$catName);
			$query->bindvalue(':uploaded_image',$uploaded_image);
			$query->bindvalue(':id',$id);
			$result = $query->execute();
			if($result){
				$msg = "<span class='succes'>Promena Kategorije Uspesna</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Promena Kategorije Neuspesna</span>";
				return $msg;
			}
		}
	}
	
	
	public function deleteCategory($id){
		$sql = "DELETE FROM tbl_category WHERE catId = :id";
		$query = $this->db->pdo->prepare($sql);
		$query->bindvalue(':id',$id);
		$result = $query->execute();
		if($result){
			$msg = "<span class='succes'>Kategorija Uspesno Obrisana</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Brisanje Kategorije Neuspesno</span>";
			return $msg;
		}
	}
	
}
?>