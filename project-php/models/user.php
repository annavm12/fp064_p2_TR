<?php
//requier_once('../config/conexion.php');

class Usuario{
    private $id;
    private $username;
    private $password;
    private $persona;
    private $tipoUsuario;
    private $idPersona;

    function __construct($user, $pass, $person, $tipoUsuario='usuario'){
        $this->username= $user;
        $this->password= $pass;
        $this->persona= $person;
        $this->tipoUsuario= $tipoUsuario;
    }

    public function getId(){
        return $this->id;
    }

    public function getPersona(){
        return $this->persona;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getTipoUsuario(){
        return $this->tipoUsuario;
    }
    

    public function setId($arg){
        $this->id= $arg;
    }
    
    public function setPersona($arg){
        $this->persona= $arg;
    }

    public function setUsername($arg){
        $this->username= $arg;
    }

    public function setPassword($arg){
        $this->password= $arg;
    }

    public function setTipoUsuario($arg){
        $this->tipoUsuario= $arg;
    }

}

?>