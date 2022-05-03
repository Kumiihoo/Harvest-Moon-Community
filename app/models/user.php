<?php

class User
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;
    private $avatar;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    function getId()
    {
        return $this->id;
    }
    function getUsername()
    {
        return $this->username;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }
    function getRole()
    {
        return $this->role;
    }
    function getAvatar()
    {
        return $this->avatar;
    }

    function setId($id)
    {
        $this->id = $id;
    }
    function setUsername($username)
    {
        $this->username = $this->db->real_escape_string($username);
    }
    function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }
    function setPassword($password)
    {
        $this->password = $password;
    }

    function setRole($role)
    {
        $this->role = $role;
    }
    function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function save()
    {
        $sql = "INSERT INTO users VALUES(NULL, '{$this->getUsername()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null);";
        $save = $this->db->query($sql);

        $result = false;
		if($save){
			$result = true;
		}
		return $result;
    }

    public function login(){
		$result = false;
		$email = $this->email;
		$password = $this->password;
		
		// Comprobar si existe el usuario
		$sql = "SELECT * FROM users WHERE email = '$email'";
		$login = $this->db->query($sql);
		
		
		if($login && $login->num_rows == 1){
			$user = $login->fetch_object();
			
			// Verificar la contraseña
			$verify = password_verify($password, $user->password);
			
			if($verify){
				$result = $user;
			}
		}
		
		return $result;
	}

    public function getUserById($uid) {
        $sql = "SELECT * FROM users WHERE id = {$uid}";
        // error_log("{$sql}");
        $result = $this->db->query($sql);
        return $result->fetch_array();
    }

    public function update() {
        $sql = "UPDATE users SET username = '{$this->getUsername()}', email = '{$this->getEmail()}' WHERE id = {$this->getId()}";
        error_log("{$sql}");
        $result = $this->db->query($sql);
        return $result;
    }
}
