<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
	include_once ($filepath.'/../phpmejl/PHPMailerAutoload.php');
?>
<?php

class Contact extends PHPMailer{
	
	public $db;
	public $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function	contactMessage($data){
		$name = $data['name'];
		$email = $data['email'];
		$body = $data['body'];
	
		if($name == "" || $email == "" || $body == ""){
			$msg = "<span class='error'>Polja Ne Smeju Biti Prazna!</span>";
			return $msg;
		}
		
		if(strlen($name) < 3){
			$msg = "<span class='error'>Ime je suvise kratko</span>";
			return $msg;
		}elseif(preg_match('/[^a-z0-9_-]+/i',$name)){
			$msg = "<span class='error'>Ime mora sadrzati slova,crte ili donje crte</span>";
			return $msg;
		}
		
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$msg = "<span class='error'>E-Mail adresa nije validna</span>";
			return $msg;
		}
		
		
			$sql = "INSERT INTO tbl_contact(name,email,body) VALUES (:name,:email,:body)";
			$query = $this->db->pdo->prepare($sql);
			 $query->bindValue(':name',$name);
			 $query->bindValue(':email',$email);
			 $query->bindValue(':body',$body);
			$result = $query->execute();
			if($result){
				$msg = "<span class='succes'>Poruka Uspesno Poslata</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Poruka Neuspesno Poslata</span>";
				return $msg;
			}
	}
	
	public function getMessage(){
		$sql = "SELECT * FROM tbl_contact ORDER BY id DESC";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function viewMessage($id){
		$sql = "SELECT * FROM tbl_contact WHERE id = :id";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':id',$id);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function viewEmail($id){
		$sql = "SELECT email FROM tbl_contact WHERE id = :id";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':id',$id);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function replyMessage($data){
		$receiver  = $data['receiver'];
		$sender	 = $data['sender'];
		$subject = $data['subject'];
		$message = $data['message'];
		
		if($receiver == "" || $sender == "" || $subject == "" || $message == "" ){
			$msg = "<span class='error'>Polja Ne Smeju Biti Prazna!</span>";
			return $msg;
		}
		
		$this->isSMTP();                            // Set mailer to use SMTP
        $this->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
        $this->SMTPAuth = true;                     // Enable SMTP authentication
        $this->Username = $sender;          // SMTP username
        $this->Password = 'nemampojma12#'; // SMTP password
        $this->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $this->Port = 587;                          // TCP port to connect to

        $this->setFrom($sender, $sender);
        $this->addReplyTo($sender, $sender);
        $this->addAddress($receiver);   // Add a recipient
        $this->addCC('cc@example.com');
        $this->addBCC('bcc@example.com');

        $this->isHTML(true);  // Set email format to HTML

        $this->Subject = $subject;
        $this->Body    = $message;

        if(!$this->send()) {
            $msg = "<span class='succes'>Poruka Uspesno Poslata</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Poruka Neuspesno Poslata</span>";
			return $msg;
		}
	}
	
}

?>