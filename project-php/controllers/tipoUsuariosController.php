<?php
require_once('../config/conexion.php');

function getTipos(){
    $conn= connect();
    $query= $conn.prepare('SELECT * FROM Tipos_usuarios');
    $query->execute();
    return $query->fetchAll();
}

//Ok
function getTipoByName($arg){
    $conn= connect();
    $sql= 'SELECT * FROM Tipos_usuarios where Descripcion= :Descripcion';
    $sql= $conn->prepare($sql);
    $sql->bindParam(':Descripcion',$arg,PDO::PARAM_STR, 100);
    $sql->execute();
    $result= $sql->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//Ok
function getRolById($arg){
    $conn= connect();
    $sql= 'SELECT * FROM Tipos_usuarios where Id_tipo_usuario= :id';
    $sql= $conn->prepare($sql);
    $sql->bindParam(':id',$arg,PDO::PARAM_INT);
    $sql->execute();
    $result= $sql->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function persistTIpo($arg){
    $conn= connect();
    $query= $conn.prepare('INSERT INTO Usuarios (Descripcion) VALUES ($arg->getDescripcion())');
    $query->execute();
}

?>