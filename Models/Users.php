<?php 
Class Users extends Model{

	private $userInfo;
	private $permissions;


	public function isLogged(){
		if(isset($_SESSION[CONF_SESSION_NAME]) && !empty($_SESSION[CONF_SESSION_NAME])){
			return true;
		}else{
			return false;
		}
	}

	public function setLoggedUser(){
		if(isset($_SESSION[CONF_SESSION_NAME]) && !empty($_SESSION[CONF_SESSION_NAME])){

			$id = $_SESSION[CONF_SESSION_NAME];

			$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->execute();

			if($sql->rowCount() > 0){
				$this->userInfo = $sql->fetch();
				
				$this->permissions = new Permissions();
				$this->permissions->setGroup($this->userInfo['id_group']);
			}
		}
	}

	public function verifyEmail($email){
		$sql = $this->db->prepare("SELECT id FROM users WHERE email = :email AND situation = '1'");
		$sql->bindValue(":email", $email);
		$sql->execute();

		if($sql->rowCount() > 0 ){
			return true;
		} else {
			return false;
		}
	}

	public function getList(){
		$data = array();
		$sql = $this->db->prepare("SELECT users.id, users.name, users.email, users.id_group, users.type, users.situation, permission_groups.name AS name_group FROM users INNER JOIN permission_groups ON permission_groups.id = users.id_group");
		$sql->execute();

		if($sql->rowCount()>0){
			$data = $sql->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	}

	public function doLogin($email, $password){
		$sql = $this->db->prepare("SELECT id, password FROM users WHERE email = :email");
		$sql->bindValue(":email", $email);
		$sql->execute();

		if($sql->rowCount() > 0){
			$row = $sql->fetch();

			if(password_verify($password, $row["password"])){
				$_SESSION[CONF_SESSION_NAME] = $row["id"];
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function hasPermission($name){
		return $this->permissions->hasPermission($name);
	}

	public function logout(){
		unset($_SESSION[CONF_SESSION_NAME]);
	}

	public function getName(){
		return $this->userInfo["name"];
	}
	public function getTypeUser(){
		return $this->userInfo["type"];
	}

	public function getId(){
		return $this->userInfo["id"];
	}

	public function getById($id){
		$array = array();

		$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetch(PDO::FETCH_ASSOC);
		}
		return $array;

	}

	public function addUser($name, $email, $type_user, $id_group){
		$sql = $this->db->prepare("INSERT INTO users SET name = :name, email = :email, type = :type_user, id_group = :id_group, situation = '1'");
		$sql->bindValue(":name", $name);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":type_user", $type_user);
		$sql->bindValue(":id_group", $id_group);
		$sql->execute();

		return $this->db->lastInsertId();
	}

	public function createPass($pass, $id_user){
		$sql = $this->db->prepare("UPDATE users SET password = :pass WHERE id = :id_user");
		$sql->bindValue(':pass', $pass);
		$sql->bindValue(':id_user', $id_user);	
		$sql->execute();
	}
	
	public function editUser($id, $name, $email){
		$sql = $this->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":email", $email);
		$sql->execute();

	}
	
	public function changeSituation($id, $situation){
		$sql = $this->db->prepare("UPDATE users SET situation = :situation WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":situation", $situation);
		$sql->execute();
	}

	public function editGroup($group, $id){
		$sql = $this->db->prepare("UPDATE users SET id_group = :group WHERE id = :id");
		$sql->bindValue(':group', $group);
		$sql->bindValue(':id', $id);

		if($sql->execute()){
			return true;
		}else{
			return false;
		}
	}



	public function getInfoByEmail($email){
		$result = array();
		$sql = $this->db->prepare("SELECT * FROM users WHERE email = :email");
		$sql->bindValue(':email', $email);
		$sql->execute();

		if($sql->rowCount() > 0){
			$result = $sql->fetch(PDO::FETCH_ASSOC);
		}
		return $result;
	}

	public function findUsersInGroup($id){
		$sql = $this->db->prepare("SELECT count(*) as c FROM users WHERE id_group = :id_group");
		$sql->bindValue(':id_group', $id);
		$sql->execute();

		$row = $sql->fetch();
		
		if($row['c'] == '0'){
			return false;
		}else{
			return true; 
		}
	}

	public function havePasswordRegistrer($id_user){
		$sql = $this->db->prepare("SELECT password FROM users WHERE id = :id_user");
		$sql->bindValue(':id_user', $id_user);
		$sql->execute();

		if($sql->rowCount() > 0){
			$row = $sql->fetch(PDO::FETCH_ASSOC);

			if(!empty($row['password'])){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}	
	
	public function editNameUser($name, $id_user){
		$sql = $this->db->prepare("UPDATE users SET name = :name WHERE id = :id_user");
		$sql->bindValue(':name', $name);
		$sql->bindValue(':id_user', $id_user);
		$sql->execute();
	}	

	public function editTypeUser($type, $id_user){
		$sql = $this->db->prepare("UPDATE users SET type = :type WHERE id = :id_user");
		$sql->bindValue(':type', $type);
		$sql->bindValue(':id_user', $id_user);
		$sql->execute();
	}	
	public function editGroupUser($id_group, $id_user){
		$sql = $this->db->prepare("UPDATE users SET id_group = :id_group WHERE id = :id_user");
		$sql->bindValue(':id_group', $id_group);
		$sql->bindValue(':id_user', $id_user);
		$sql->execute();
	}	

	public function editEmailUser($email, $id_user){
		$sql = $this->db->prepare("UPDATE users SET email = :email WHERE id = :id_user");
		$sql->bindValue(':email', $email);
		$sql->bindValue(':id_user', $id_user);
		$sql->execute();
	}	

	public function editSituationUser($situation, $id_user){
		$sql = $this->db->prepare("UPDATE users SET situation = :situation WHERE id = :id_user");
		$sql->bindValue(':situation', $situation);
		$sql->bindValue(':id_user', $id_user);
		$sql->execute();
	}	
}