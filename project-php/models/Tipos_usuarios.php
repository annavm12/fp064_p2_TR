<?php
requier_once('../config/conexion.php');

class Usuario{
    private $id;
    private $descripcion;
 
    function __construct($arg){
        $this->descripcion= $arg;
    }

    public function getId(){
        return $this->id;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setId($arg){
        $this->id= $id;
    }

    public function setDescripcion($arg){
        $this->descripcion= $arg;
    }
}

?>