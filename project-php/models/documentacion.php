<?php
class documentacion{
    private $Id_presentacion;
    private $Id_acto;
    private $Localizacion_documentacion;
    private $Orden;
    private $Id_persona;
    private  $Titulo_documento;

    function __construct($idPresentacion, $idActo, $localizacionDoc, $orden, $idPresona, $tituloDoc){
        $this->Id_presentacion= $idPresentacion;
        $this->Id_acto= $idActo;
        $this->Localizacion_documentacion= $localizacionDoc;
        $this->Orden= $orden;
        $this->Id_persona= $idPersona;
        $this->Titulo_documento= $tituloDoc;
    }

    function getIdPresentacion(){
        return $this->Id_presentacion;
    }

    function getIdActo(){
        return $this->Id_acto;
    }

    function getLocalizacionDoc(){
        return $this->Localizacion_documentacion;
    }

    function getOrden(){
        return $this->Orden;
    }

    function getIdPersona(){
        return $this->Id_persona;
    }

    function getTituloDoc(){
        return $this->Titulo_documento;
    }

    function setIdPresentacion($arg){
        $this->Id_presentacion= $arg;
    }

    function setIdActo($arg){
        $this->Id_acto= $arg;
    }

    function setLocalizacionDoc($arg){
        $this->Localizacion_documentacion= $arg;
    }

    function setOrden($arg){
        $this->Orden= $arg;
    }

    function setIdPersona($arg){
        $this->Id_persona= $arg;
    }

    function setTituloDoc($arg){
        $this->Titulo_documento= $arg;
    }

}

?>