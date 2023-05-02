<?php
require_once('../config/conexion.php');


//Ok
function getAllPersona(){
    $conn= connect();
    $sql= 'SELECT * FROM Personas';
    $query= $conn->prepare($sql);
    $query->execute();
    $result= $query->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//Ok
function getPersonaByName($arg){
    $conn= connect();
    $sql= 'SELECT * FROM Personas where Nombre= :name';
    $query= $conn->prepare($sql);
    $query->bindParam(':name', $arg, PDO::PARAM_STR, 50);
    $query->execute();
    $result= $query->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//Ok
function persistPersona($arg){
    $conn= connect();
    //obtenemos los datos
    $name= $arg->getNombre();
    $apellido= $arg->getApellido1();
    $apellido2= $arg->getApellido2();
    //preparamos sql
    $sql='INSERT INTO Personas (Nombre, Apellido1, Apellido2) VALUES (:name,:apellido,:apellido2)';
    //preparamos la consulta
    $sql= $conn->prepare($sql);
    //inicializamos los parametros de sql
    $sql->bindParam(':name',$name,PDO::PARAM_STR, 50);
    $sql->bindParam(':apellido', $apellido, PDO::PARAM_STR, 50);
    $sql->bindParam(':apellido2', $apellido2, PDO::PARAM_STR, 50);
    //ejecutamos la insercion
    $sql->execute();
}

?>