<?php
class Acto{
    private $Id_acto;
    private $Fecha;
    private $Hora;
    private $Titulo;
    private $Descripcion_corta;
    private $Descripcion_larga;
    private $Num_asistentes;
    private $Id_tipo_acto; 

    function __construct($id, $fecha, $hora, $titulo, $descorta, $deslarga, $numasis, $idtipo){
        $this->Id_acto= $id;
        $this->Fecha= $fecha;
        $this->Hora= $hora;
        $this->Titulo= $titulo;
        $this->Descripcion_corta= $descorta;
        $this->Descripcion_larga= $deslarga;
        $this->Num_asistentes= $numasis;
        $this->Id_tipo_acto= $idtipo;      
    }

    function getId(){
        return $this->Id_acto;
    }

    function getFecha(){
        return $this->Fecha;
    }

    function getHora(){
        return $this->Hora;
    }

    function getTitulo(){
        return $this->Titulo;
    }

    function getDescripcionCorta(){
        return $this->Descripcion_corta;
    }

    function getDescripcionLarga(){
        return $this->Descripcion_larga;
    }

    function getNumAsistentes(){
        return $this->Num_asistentes;
    }

    function getIdTipoActo(){
        return $this->Id_tipo_acto;
    }

    function setId($arg){
        $this->Id_acto= $arg;
    }

    function setFecha($arg){
        $this->Fecha= $arg; 
    }

    function setHora($arg){
        $this->Hora= $arg;
    }

    function setTitulo($arg){
        $this->Titulo= $arg;
    }

    function setDescripcionCorta($arg){
        $this->Descripcion_corta= $arg;
    }

    function setDescripcionLarga($arg){
        $this->Descripcion_larga= $arg;
    }

    function setNumAsistentes($arg){
        $this->Num_asistentes= $arg;
    }

    function setIdTipoActo($arg){
        $this->Id_tipo_acto= $arg;
    }


}
?>