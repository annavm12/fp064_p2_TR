<?php

function connect(){
    $user= "root";
    $pwd= "rocket";
    $dsn="mysql:host=db;dbname=wordpress2;charset=UTF8";
    $options= [];
    try{
        $conn= new PDO($dsn, $user, $pwd, $options);
        return $conn;
    }
    catch(PDOException $e){
        exit("Error: ". $e->getMessage());
    }
}

/*$host = 'uocx-icc02-p8.uoclabs.uoc.es';
$user = 'wordpress2';
$password = 'IUEEPowL7knxVtGF';
$options = [];

$conn = mysqli_connect($host, $user, $password, $options);

if(!$conn) {
    die("La conexión a la base de datos falló " . mysqli_connect_error());
}
echo "Conexión exitosa";*/
?>