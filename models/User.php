<?php

class User{

    public $id;
    public $username;
    public $name;
    public $password;
    public $email;
    public $role;

    public function __construct($name, $username, $email, $role){
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
    }

    public function setId($id){$this->id = $id;}
    public function setUsername($username){$this->username = $username;}
    public function setName($name){$this->name = $name;}
    public function setPassword($password){$this->password = $password;}
    public function setEmail($email){$this->email = $email;}
    public function setRole($role){$this->role = $role;}
    
    public function getId(){return $this->id;}
    public function getUsername(){return $this->username;}
    public function getName(){return $this->name;}
    public function getPassword(){return $this->password;}
    public function getEmail(){return $this->email;}
    public function getRole(){return $this->role;}
}

?>