<?php
class inscritos{
    private $Id_inscripcion;
    private $Id_persona;
    private $id_acto;
    private $Fecha_inscripcion;

    function __construct($idInscripcion, $idPersona, $idActo, $fechaIns){
        $this->Id_inscripcion= $idInscripcion;
        $this->Id_persona= $idPersona;
        $this->Id_acto= $idActo;
        $this->Fecha_inscripcion= $fechIns;
    }

    function getIdInscripcion(){
        return $this->Id_inscripcion;
    }

    function getIdPersona(){
        return $this->Id_persona;
    }

    function getIdActo(){
        return $this->Id_acto;
    }

    function getFechaIns(){
        return $this->Fecha_inscripcion;
    }

    function setIdInscripcion($arg){
        $this->Id_inscripcion= $arg;
    }

    function setIdPersona($arg){
        $this->Id_persona= $arg;
    }

    function setIdActo($arg){
        $this->Id_acto= $arg;
    }

    function setFechaIns($arg){
        $this->Fecha_inscripcion= $arg;
    }
}
?>