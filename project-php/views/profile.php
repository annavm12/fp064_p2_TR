<?php
session_start();
if($_POST){
    require_once('../controllers/usuariosController.php');
    require_once('../controllers/tipoUsuariosController.php');
    require_once('../models/user.php');
    $userfind= getUserById($_SESSION['idUsuario']);
    if(!empty($userfind)){
        foreach ($userfind as $u){
            $user= new Usuario($u->Username, $u->Password, $u->Id_Persona, $u->Id_tipo_usuario);
            $userId= $u->Id_usuario;
        }
        if(!empty($_POST['password'])){
            $user->setPassword($_POST['password']);
        }
        if(!empty($_POST['username'])){
            $user->setUsername($_POST['username']);
        }
        if($_POST['role']){
            $rol= getTipoByName($_POST['role']);
        }
        if(!empty($rol)){
            foreach ($rol as $r){
                $rolId= $r->Id_tipo_usuario;
            }
        }
        $user->setTipoUsuario($rolId);
        updateUser($userId, $user->getUsername(), $user->getPassword(), $user->getTipoUsuario());
        header("Location:../views/actualizado.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Eventos</title>
</head>
<body>
<div class="bd-example m-5">
    <div class= "d-flex justify-content-center bd-highlight mb-3">
        <div class="card p-5">
            <form action="profile.php" method="post">
                    <label for="username">Username:</label>
                    <input class="form-control" type='text' name='username' id='username'>
                    <br>
                    <label for="passoword">Password:</label>
                    <input class="form-control" type='password' name='password' id='password'>
                    </br>
                    <label for="rol">Rol:</label>
                    <select class="form-control" name="role" slected="<?php echo (!empty($_POST['role'])) ? $_POST['role']: 'Usuario'?>">
                        <option value="Usuario">Usuario</option>
                        <option value="Ponente">Ponente</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                    </br>
                    <p><input class="btn btn-primary col-md-6 offset-md-3" type="submit" value="Actualizar"></p>
            </form>
        </div>
    </div>
</div>
<?php include ("../views/footer.php") ?>

