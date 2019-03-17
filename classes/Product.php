<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

class Product{
	
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function addProduct($data,$file,$action){
		$productName = $data['productName'];
		$catId = $data['catId'];
		$brandId = $data['brandId'];
		$body = $data['body'];
		$price = $data['price'];
		$type = $data['type'];
		
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];
	
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;
		
		
		if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $file_name== "" || $type == "" ){
			$msg = "<span class='error'>Polja Ne Smeju Biti Prazna!</span>";
			return $msg;
		
		}elseif ($file_size >1048567) {
		echo "<span class='error'>Image Size should be less then 1MB!
		</span>";
		} elseif (in_array($file_ext, $permited) === false) {
		echo "<span class='error'>Mozete Uneti Samo:-"
		.implode(', ', $permited)."</span>";
		
		}else{
			move_uploaded_file($file_temp, $uploaded_image);
			$sql = "INSERT INTO tbl_product(productName,catId,brandId,body,price,image,action,type) VALUES (:productName,:catId,:brandId,:body,:price,:uploaded_image,:action,:type)";
			$query = $this->db->pdo->prepare($sql);
			 $query->bindValue(':productName',$productName);
			 $query->bindValue(':catId',$catId);
			 $query->bindValue(':brandId',$brandId);
			 $query->bindValue(':body',$body);
			 $query->bindValue(':price',$price);
			 $query->bindValue(':uploaded_image',$uploaded_image);
			 $query->bindValue(':action',$action);
			 $query->bindValue(':type',$type);
			$result = $query->execute();
			if($result){
				$msg = "<span class='succes'>Proizvod Uspesno Dodat</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Dodavanje Proizvoda Neuspesno</span>";
				return $msg;
			}
		}
	}
	
	public function getAllProduct(){
		$sql = "SELECT tbl_product.*,tbl_category.catName,
				tbl_brand.brandName
				FROM tbl_product
				INNER JOIN tbl_category
				ON tbl_product.catId = tbl_category.catId
				INNER JOIN tbl_brand
				ON tbl_product.brandId = tbl_brand.brandId
				ORDER BY tbl_product.productId DESC";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function getProById($id){
		$sql = "SELECT * FROM tbl_product WHERE productId = :id";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':id',$id);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function editProduct($data,$file,$id,$action){
		$productName = $data['productName'];
		$catId = $data['catId'];
		$brandId = $data['brandId'];
		$body = $data['body'];
		$price = $data['price'];
		$type = $data['type'];
		
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];
	
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;
		
		if($productName == "" || $catId == "" || $brandId == ""  || $body == "" || $price == "" || $type == "" ){
			$msg = "<span class='error'>Polja ne smeju biti prazna !</span>";
			return $msg;
		}else{
			if(!empty($file_name)){
			
		if ($file_size >1048567) {
		echo "<span class='error'>Image Size should be less then 1MB!
		</span>";
		} elseif (in_array($file_ext, $permited) === false) {
		echo "<span class='error'>You can upload only:-"
		.implode(', ', $permited)."</span>";
		
		}else{
			move_uploaded_file($file_temp, $uploaded_image);
			$sql = "UPDATE tbl_product SET 
			productName = :productName,
			catId = :catId,
			brandId = :brandId,
			body = :body,
			price = :price,
			image = :uploaded_image,
			action = :action,
			type= :type
			WHERE productId = :id ";
			$query = $this->db->pdo->prepare($sql);
			 $query->bindValue(':productName',$productName);
			 $query->bindValue(':catId',$catId);
			 $query->bindValue(':brandId',$brandId);
			 $query->bindValue(':body',$body);
			 $query->bindValue(':price',$price);
			 $query->bindValue(':uploaded_image',$uploaded_image);
			 $query->bindValue(':action',$action);
			 $query->bindValue(':type',$type);
			 $query->bindValue(':id',$id);
			$result = $query->execute();
			if($result){
				$msg = "<span class='succes'>Izmena Proizvoda Uspesna</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Izmena Proizvoda Neuspesna</span>";
				return $msg;
			}
		}
	  }else{
		 $sql = "UPDATE tbl_product SET 
			productName = :productName,
			catId = :catId,
			brandId = :brandId,
			body = :body,
			price = :price,
			action = :action,
			type= :type
			WHERE productId = :id ";
			$query = $this->db->pdo->prepare($sql);
			 $query->bindValue(':productName',$productName);
			 $query->bindValue(':catId',$catId);
			 $query->bindValue(':brandId',$brandId);
			 $query->bindValue(':body',$body);
			 $query->bindValue(':price',$price);
			 $query->bindValue(':action',$action);
			 $query->bindValue(':type',$type);
			 $query->bindValue(':id',$id);
			$result = $query->execute();
			if($result){
				$msg = "<span class='succes'>Izmena Proizvoda Uspesna</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Izmena Proizvoda Neuspesna</span>";
				return $msg;
			}
		}
	  }
	}
	
	public function deleteProduct($id){
		$sql = "SELECT * FROM tbl_product WHERE productId = :id";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':id',$id);
		$query->execute();
		 if($query->rowCount() > 0){
			$img = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach($img as $imagelink){
				$delLink = $imagelink['image'];
				unlink($delLink);
			}
		}
		
		$delsql = "DELETE FROM tbl_product WHERE productId = :id";
		$delquery = $this->db->pdo->prepare($delsql);
		$delquery->bindvalue(':id',$id);
		$delresult = $delquery->execute();
		if($delresult){
			$msg = "<span class='succes'>Proizvod Uspesno Obrisan</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Brisanje Proizvoda Neuspesno</span>";
			return $msg;
		}
	}
	
	public function getFeaturedProduct(){
		$sql = "SELECT * FROM tbl_product WHERE type = '1' ORDER BY productId DESC LIMIT 6";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function getProductOnAction(){
		$sql = "SELECT * FROM tbl_product WHERE action != '0' ORDER BY productId DESC LIMIT 6";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function deleteAction($action, $offid){
		$sql = "UPDATE tbl_product SET
				action = :null
				WHERE productId = :offid";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':offid',$offid);
		$query->bindValue(':null',$action);
		$result = $query->execute();
			if($result){
				$msg = "<span class='succes'>Proizvod Uspesno Skinut Sa Akcije</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Skidanje Akcije Neuspesno</span>";
				return $msg; 
			}
	}
	
	public function getProductByCat($id){
		$sql = "SELECT * FROM tbl_product WHERE catId = :id ";
		$query = $this->db->pdo->prepare($sql);
		$query->bindvalue(':id',$id);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function getSingleProduct($id){
		$sql = "SELECT p.*, c.catName, b.brandName
				FROM tbl_product as p, tbl_category as c, tbl_brand as b
				WHERE p.catId = c.catId and p.brandId = b.brandId and productId = :id ";
		$query = $this->db->pdo->prepare($sql);
		$query->bindvalue(':id',$id);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
}