<?php
class lista_ponentes{
    private $id_ponente;
    private $Id_persona;
    private $Id_acto;
    private $Orden;

    function __construct($idPonente, $idPersona, $idActo, $orden){
        $this->id_ponente= $idPonente;
        $this->Id_persona= $idPersona;
        $this->Id_acto= $idActo;
        $this->Orden= $orden;
    }

    function getIdponente(){
        return $this->id_ponente;
    }

    function getIdPersona(){
        return $this->Id_persona;
    }

    function getIdActo(){
        return $this->Id_acto;
    }

    function getOrden(){
        return $this->Orden;
    }

    function setIdponente($arg){
        $this->id_ponente= $arg;
    }

    function setIdPersona($arg){
        $this->Id_persona= $arg;
    }

    function setIdActo($arg){
        $this->Id_acto= $arg;
    }

    function setOrden($arg){
        $this->Orden= $arg;
    }
}
?>