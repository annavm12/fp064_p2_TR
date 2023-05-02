<?php
require_once('../models/tipo_acto.php');

function getActoById(){
    $conn= connect();
    $sql= 'SELECT * FROM Tipo_acto where Id_tipo_acto= :id';
    $sql= $conn->prepare($sql);
    $sql->bindParam(':id',$arg,PDO::PARAM_INT);
    $sql->execute();
    $result= $sql->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getByDescripcion($arg){
    $conn= connect();
    $sql= 'SELECT * FROM Tipo_acto where Descripcion= :Descripcion';
    $sql= $conn->prepare($sql);
    $sql->bindParam(':Descripcion',$arg,PDO::PARAM_STR, 100);
    $sql->execute();
    $result= $sql->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

?>