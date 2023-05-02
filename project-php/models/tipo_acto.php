<?php
class tipo_acto{
    private $Id_tipo_acto;
    private $Descripcion;

    function __construct($id, $descripcion){
        $this->Id_tipo_acto= $id;
        $this->Descripcion= $descripcion;
    }

    function getId(){
        return $this->Id_tipo_acto;
    }

    function getDescripcion(){
        return $this->Descripcion;
    }

    function setId($id){
        $this->Id_tipo_acto= $id;
    }

    function setDescripcion($descripcion){
        $this->Descripcion= $descripcion;
    }

}
?>