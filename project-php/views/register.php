<?php
if(isset($_SESSION['login'])){
    header("location:../index.php");
}

if($_POST){
    if(!empty($_POST['apellido']) && !empty($_POST['nombre'] && !empty($_POST['apellido2']) && !empty($_POST['password']))){
        require_once('../models/user.php');
        require_once('../models/persona.php');
        require_once('../controllers/usuariosController.php');
        require_once('../controllers/personaController.php');
        require_once('../controllers/tipoUsuariosController.php');
        //comprobar si ya existe
        $presonasList= getAllPersona();
        foreach ($presonasList as $persona){
            if ($persona-> Nombre == $_POST['nombre']){
                if($persona->Apellido1 == $_POST['apellido']){
                    if($persona->Apellido2 == $_POST['apellido2']){
                        header("location:../views/userexists.php");
                    }
                }
            }
        }
        //si no existe la creamos
        $newPersona= new persona($_POST['nombre'], $_POST['apellido'], $_POST['apellido2']);
        persistPersona($newPersona);

        //estando persistida recuperamos el id
        $searchidNewPersona= getPersonaByName($newPersona->getNombre());
        foreach ($searchidNewPersona as $id){
            $newPersonaId= $id->Id_persona;
        }

        //formamos el username
        $newUsername= $_POST['nombre'].$_POST['apellido'].$_POST['apellido2'];
        
        //y comprobamos si existe, en el caso de existir le añadiremos un numero al final que se ira incrementando
        $userList= getAllUsers();
        foreach ($userList as $user){
            if($user->Username == $_POST['nombre'].$_POST['apellido'].$_POST['apellido2']){
                $contador= 1;
                $newUsername= $newUsername.$contador;
                while($user->Username == $newUsername){
                    $contador++;
                    $newUsername= $newUsername.$contador;
                }
                return;
            }  
        }
    
        //buscamos el id del role
        $rolSearch= getTipoByName($_POST['role']);
        foreach ($rolSearch as $role){
            $rolId= $role->Id_tipo_usuario;
        }

        //creamos el nuevo usuario
        $newUser= new Usuario($newUsername, $_POST['password'], $newPersonaId, $rolId);
        
        //lo persistimos
        persistUser($newUser);

        //finalmente redirigimos al usuario a la confirmacion de que ha sido creado
        header("Location:confirmcreated.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <div class="bd-example m-5">
        <div class= "d-flex justify-content-center bd-highlight mb-3">
            <div class="card p-5">
                <form action="register.php" method="post">
                    <label for="nombre" >Nombre:</label>
                    <input class="form-control" type='text' value="<?php echo (!empty($_POST['nombre'])) ? $_POST['nombre']: ''?>" name='nombre' id='nombre'>
                    <?php if(empty($_POST['nombre'])){ echo "<span> No puede estar vacio</span>";}?>
                    </br>
                    <label for="apellido">Apellido:</label>
                    <input class="form-control" type='text' value="<?php echo (!empty($_POST['apellido'])) ? $_POST['apellido']: ''?>" name='apellido' id='apellido'>
                    <?php if(empty($_POST['apellido'])){ echo "<span> No puede estar vacio</span>";}?>
                    </br>
                    <label for="apellido2">Apellido2:</label>
                    <input class="form-control" type='text' value="<?php echo (!empty($_POST['apellido2'])) ? $_POST['apellido2']: ''?>" name='apellido2' id='apellido2'>
                    <?php if(empty($_POST['apellido2'])){ echo "<span> No puede estar vacio</span>";}?>
                    </br>
                    <label for="passoword">Password:</label>
                    <input class="form-control" type='password' name='password' id='password'>
                    <?php if(empty($_POST[''])){ echo "<span> No puede estar vacio</span>";}?>
                    </br>
                    <label for="rol">Rol:</label>
                    <select class="form-control" name="role" slected="<?php echo (!empty($_POST['role'])) ? $_POST['role']: 'Usuario'?>">
                        <option value="Usuario">Usuario</option>
                        <option value="Ponente">Ponente</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                    </br>
                    <p><input class="btn btn-primary col-md-6 offset-md-3" type="submit" value="Registrarse"></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>