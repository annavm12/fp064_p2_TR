<?php

class persona{
    private $nombre;
    private $apellido1;
    private $apellido2;

    function __construct($user, $surname1, $surname2){
        $this->nombre= $user;
        $this->apellido1= $surname1;
        $this->apellido2= $surname2;
    }


    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido1(){
        return $this->apellido1;
    }

    public function getApellido2(){
        return $this->apellido2;
    }

    public function setNombre($arg){
        $this->nombre= $arg;
    }

    public function setApellido1($arg){
        $this->apellido1= $arg;
    }

    public function setApellido2($arg){
        $this->apellido2= $arg;
    }

}

?>