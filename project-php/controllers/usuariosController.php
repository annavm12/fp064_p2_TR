<?php
require_once('../config/conexion.php');
require_once('../models/user.php');


function getAllUsersNames(){
    $conn= connect();
    $query= $conn.prepare('SELECT Username FROM Usuarios');
    $query->execute();
    return $query->fetchAll();
}

function getAllUsers(){
    $conn= connect();
    $sql= 'SELECT * FROM Usuarios';
    $query= $conn->prepare($sql);
    $query->execute();
    $result= $query->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//Ok
function getUserByName($arg){
    $conn= connect();
    $sql= 'SELECT * FROM Usuarios where Username= :username';
    $sql= $conn->prepare($sql);
    $sql->bindParam(':username',$arg,PDO::PARAM_STR, 100);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_OBJ);
}

//Ok
function persistUser($arg){
    $conn= connect();
    $username= $arg->getUserName();
    $password= $arg->getPassword();
    $persona= $arg->getPersona();
    $tipoUsuario= $arg->getTipoUsuario();
    $sql= 'INSERT INTO Usuarios (Username, Password, Id_Persona, Id_tipo_usuario ) VALUES (:username, :password, :persona, :tipoUsuario)';
    $sql= $conn->prepare($sql);
    $sql->bindParam(':username',$username,PDO::PARAM_STR, 100);
    $sql->bindParam(':password',$password,PDO::PARAM_STR, 100);
    $sql->bindParam(':persona',$persona,PDO::PARAM_INT);
    $sql->bindParam(':tipoUsuario',$tipoUsuario,PDO::PARAM_INT);
    $sql->execute();
}

function getUserById($arg){
    $conn= connect();
    $sql= 'SELECT * FROM Usuarios WHERE Id_usuario= :id';
    $sql= $conn->prepare($sql);
    $sql->bindParam(':id', $arg, PDO::PARAM_INT);
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_OBJ);
}

function updateUser($id, $username, $password, $idTipo){
    $conn= connect();
    $findUser= getUserById($id);
    foreach($findUser as $u){
        $user= new Usuario($u->Username, $u->Password, $u->Id_Persona, $u->Id_tipo_usuario);
    }
    $user->setPassword($password);
    $user->setTipoUsuario($idTipo);
    $user->setUsername($username);
    $sql= 'UPDATE Usuarios SET `Password`= :password, `Id_tipo_usuario`= :idTipo, `Username`= :username WHERE `Id_usuario`= :id';
    $sql= $conn->prepare($sql);
    $pass= $user->getPassword();
    $idUserTipe= $user->getTipoUsuario();
    $uname= $user->getUsername();
    $sql->bindParam(':password', $pass, PDO::PARAM_STR, 100);
    $sql->bindParam(':username', $uname, PDO::PARAM_STR, 100);
    $sql->bindParam(':idTipo', $idUserTipe, PDO::PARAM_INT);
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
}

?>