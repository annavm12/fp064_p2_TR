<?php
require_once('./config/conexion.php');


function getAllActosXdia(){
    $conn= connect();
    $query= $conn->prepare("SELECT * FROM `Actos` WHERE fecha = DATE_FORMAT(sysdate(),'%Y/%m/%d')");
    $query->execute();
    return $query->fetchAll();
}

function getAllActosUltimos7dias(){
    $conn= connect();
    $query= $conn->prepare("SELECT * FROM `Actos` WHERE FECHA BETWEEN DATE_FORMAT(SYSDATE(), '%Y-%m-%d') AND DATE_FORMAT(DATE_ADD(SYSDATE(), INTERVAL 7 DAY), '%Y-%m-%d'); ");
    $query->execute();
    return $query->fetchAll();
}

function getAllActosXmes(){
    $conn= connect();
    $query= $conn->prepare("SELECT * FROM `Actos` WHERE MONTHNAME(FECHA) = MONTHNAME(SYSDATE())");
    $query->execute();
    return $query->fetchAll();
}

function getInscritos($IdPersona, $IdActo){
    $conn= connect();
    $query= $conn->prepare("SELECT * FROM `Inscritos` WHERE Id_persona = $IdPersona and id_acto = $IdActo; ");
    $query->execute();
    return $query->fetchAll();
}

function deleteInscripcion($IdPersona, $IdActo){
    $conn= connect();
    $query= $conn->prepare("DELETE FROM `Inscritos` WHERE Id_persona = $IdPersona and id_acto = $IdActo; ");
    $result= $query->execute();
    if ($result == 1) {
        $query= $conn->prepare("UPDATE `Actos` SET `Num_asistentes`= `Num_asistentes` - 1 WHERE id_acto = $IdActo; ");
        $query->execute();
    }
    return $result;
}

function insertInscripcion($IdPersona, $IdActo){
    $conn= connect();
    $query= $conn->prepare("INSERT INTO `Inscritos`(`Id_persona`, `id_acto`, `Fecha_inscripcion`) VALUES ($IdPersona,$IdActo,sysdate()); ");
    $result= $query->execute();
    if ($result == 1) {
        $query= $conn->prepare("UPDATE `Actos` SET `Num_asistentes`= `Num_asistentes` + 1 WHERE id_acto = $IdActo; ");
        $query->execute();
    }
    return $result;
}

function getEvento($IdActo){
    $conn= connect();
    $query= $conn->prepare("SELECT `Fecha`, `Hora`, `Titulo`, `Descripcion_corta`, `Descripcion_larga`, `Num_asistentes`, `nombre`, `apellido1`, `apellido2`
                            FROM `Actos` a 
                            left join `Lista_Ponentes` lp
                            	on a.Id_acto = lp.Id_acto
                            left join `Personas` u
                                on lp.Id_persona = u.Id_persona
                            WHERE a.Id_acto = $IdActo; ");
    $query->execute();
    return $query->fetchAll();
}

function isPonente($IdPersona, $IdActo){
    $conn= connect();
    $query= $conn->prepare("SELECT count(*) FROM Lista_Ponentes WHERE Id_persona = $IdPersona AND Id_acto = $IdActo; ");
    $query->execute();
    return $query->fetchColumn();
     
}

function deletePonente($IdPersona, $IdActo){
    $conn= connect();
    $query= $conn->prepare("DELETE FROM Lista_Ponentes WHERE Id_persona = $IdPersona and id_acto = $IdActo; ");
    $result= $query->execute();
    return $result;
}

function insertPonente($IdPersona, $IdActo){
    $conn= connect();
    $query= $conn->prepare("INSERT INTO Lista_Ponentes(`Id_persona`, `Id_acto`, `Orden`) VALUES ($IdPersona,$IdActo,1); ");
    $result= $query->execute();
    return $result;
}

?>