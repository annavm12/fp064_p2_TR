<?php

session_start();


$conn = mysqli_connect("localhost","root","","eventos");


if($conn->connect_error)
{
  die("Error on conecting with DB");
}


function getActs($id_value=NULL)
{
	global $conn;
	$list = [];

	$id = $_SESSION['user-data']['Id_Persona'];

	$query = "SELECT * FROM actos ac
	          inner join tipo_acto ta on ac.Id_tipo_acto=ta.Id_tipo_acto
	          LEFT JOIN inscritos ins on ins.id_acto = ac.Id_acto AND ins.Id_persona = $id";

	if(!empty($id_value))
	{
		$query .= " WHERE ac.Id_acto =$id_value";
	}

	$result = $conn->query($query);
	if ($result->num_rows > 0) {
	  
	  while($row = $result->fetch_assoc()) {
	    $list[]= $row;
	  }
	}

	return $list;
}

function getList($table,$where)
{
	global $conn;
	$list = [];

	$query = "SELECT * FROM $table";

	if(!empty($where))
	{
		$query = "SELECT * FROM $table WHERE $where";
	}

	$result = $conn->query($query);
	if ($result->num_rows > 0) {
	  
	  while($row = $result->fetch_assoc()) {
	    $list[]= $row;
	  }
	}

	return $list;
}
function updateData($id, $inset_arr,$table)
{
	global $conn;

	$query = "UPDATE $table SET $inset_arr WHERE Id_usuario  = $id";
	$result = $conn->query($query);
	header("Location:user.php?isTrue=1");
}
function insertData($table,$colums,$values)
{
	global $conn;

	$query = "INSERT INTO $table($colums)VALUES($values)";
	$result = $conn->query($query);
}

function deleteData($table,$where)
{
	global $conn;
	$result = $conn->query("DELETE FROM $table WHERE $where");
}

$action = $_REQUEST['action'] ?? NULL;

if($action == "login")
{

	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	$where = "Username='$username' AND password='$password'";
	$data = getList("usuarios",$where);



	if(!empty($data))
	{
		$_SESSION["user-data"] = current($data);
		header("Location:home.php");
	}
	else
	{
		header("Location:login.php?isTrue=0");
	}
}
if($action == "logout")
{
	unset($_SESSION["user-data"]);
	header("Location:login.php");
}
if($action == "user-update")
{
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	$email = $_REQUEST["email"];
	$where = "Username='$username' AND password='$password'";

	$updateData = "Username='$username',password='$password',email='$email'";
	updateData($_REQUEST["id"],$updateData,"usuarios");
}
if($action == "insert-inscritos")
{
	$p_id = $_REQUEST["p_id"];
	$act_id = $_REQUEST["act_id"];
	$columns = "Id_persona,id_acto,Fecha_inscripcion";
	$date = date('Y-m-d H:i:s');
	$values = "$p_id,$act_id,'$date'";


	$data = getList("inscritos","Id_persona=$p_id AND id_acto=$act_id");

	if(!empty($data))
	{
		$id = $data[0]['Id_inscripcion'];
		deleteData("inscritos","Id_inscripcion=$id");
	}
	else
	{
		insertData("inscritos",$columns,$values);
	}
	

	header("Location:act.php");
}

?>