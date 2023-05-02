<?php include ("./views/header.php"); ?>

<!-- Menu usuarios -->
<?php
if ($_SESSION['rol'] == 'Usuario') {
    require_once('./controllers/actosController.php');
?>
<?php 
if (isset($_POST["inscribirBorrar"])) {
    if ($_POST["inscribirBorrar"] == "borrarse") {

            $borrado = deleteInscripcion($_SESSION['persona'], $_POST["id_acto"]);
            if ($borrado == 1) {
                echo "<script>alert('Te has borrado correctamente del acto')</script>";
            }else{
                echo "<script>alert('Ha habido algun fallo al borrarte del acto')</script>";
            }
    }else{

        $insercion = insertInscripcion($_SESSION['persona'], $_POST["id_acto"]);
        if ($insercion == 1) {
            echo "<script>alert('Te has inscrito correctamente en el acto')</script>";
        }else{
            echo "<script>alert('Ha habido algun fallo al inscribirte en el acto acto')</script>";
        }
    }
}

if (isset($_POST["esPonente"])) {
    if ($_POST["esPonente"] == "ponente") {
        
        $borrado = deletePonente($_SESSION['persona'], $_POST["id_acto"]);
        if ($borrado == 1) {
            echo "<script>alert('Te has borrado como ponente correctamente')</script>";
        }else{
            echo "<script>alert('Ha habido algun fallo al borrarte como ponente')</script>";
        }
    }else{
        
        $insercion = insertPonente($_SESSION['persona'], $_POST["id_acto"]);
        if ($insercion == 1) {
            echo "<script>alert('Te has inscrito correctamente como ponente')</script>";
        }else{
            echo "<script>alert('Ha habido algun fallo al inscribirte como ponente')</script>";
        }
    }
}
?>

<?php
    $tipoVistaColorXdia = "btn btn-primary";
    $tipoVistaColorXsemana = "btn btn-primary";
    $tipoVistaColorXmes = "btn btn-primary";
    $_SESSION["tipoVista"] = null;
    if (!isset($_POST["mostrarVista"])) {
        $_SESSION["tipoVista"] == null;
    }else{
        $_SESSION["tipoVista"]= $_POST["mostrarVista"];
    }
    
    $concat = '';
    
    if (!isset($_SESSION["tipoVista"]) or $_SESSION["tipoVista"] == "3") {
        $data = getAllActosXmes();
        $tipoVistaColorXmes = "btn btn-success";
    }else if($_SESSION["tipoVista"] == "2"){
        $data = getAllActosUltimos7dias();
        $tipoVistaColorXsemana = "btn btn-success";
    }else if($_SESSION["tipoVista"] == "1"){
        $data = getAllActosXdia();
        $tipoVistaColorXdia = "btn btn-success";
    }
    
    
?>
<div align="center">
	<form action="index.php" method="post">
      <button type="submit" name="mostrarVista" value="1" class="<?php echo $tipoVistaColorXdia; ?>">Vista por dia</button>
      <button type="submit" name="mostrarVista" value="2" class="<?php echo $tipoVistaColorXsemana; ?>">Vista ultimos siete dias</button>
      <button type="submit" name="mostrarVista" value="3" class="<?php echo $tipoVistaColorXmes; ?>">Vista por mes</button>
    </form>
    <br>
</div>
<div>
	<table class="table">
		<thead class="thead-dark">
    		<tr>
    			<th scope="col">NOMBRE DEL ACTO</th>
    			<th scope="col">FECHA DEL ACTO</th>
    			<th scope="col">HORA DEL ACTO</th>
    			<!-- <th scope="col">ERES PONENTE</th> -->
    			<!-- <th scope="col">PONENTE</th> -->	
    			<th scope="col">INSCRITO</th>
    			<th scope="col">EVENTO</th>
    		</tr>
		</thead>
		<tbody>
        <?php
            
            
            
            foreach ($data as $acto) {
                
                if (!getInscritos($_SESSION['persona'], $acto['Id_acto'])) {
                    $nombreBoton = "inscribirse";
                    $colorBoton = "btn btn-primary";
                    $valueBoton = "incribir";
                }else {
                    $nombreBoton = "borrarse";
                    $colorBoton = "btn btn-warning";
                    $valueBoton = "borrarse";
                }
                
                /* $result = isPonente($_SESSION['persona'], $acto['Id_acto']);

                if (!$result == 0) {
                    $esPonente = 'SI';
                    $valueBotonPonente = "ponente";                  
                    $nombreBotonPonente = "Quitarse como ponente";
                    $colorBotonPonente = "btn btn-warning";
                }else{
                    $esPonente = 'NO';
                    $valueBotonPonente = "noponente";
                    $nombreBotonPonente = "Ponerse como ponente";
                    $colorBotonPonente = "btn btn-primary";
                } */
                
                $concat .= '<tr>';
                $concat .= '<td>' . $acto['Titulo'] .'</td>';
                $concat .= '<td>' . $acto['Fecha'] .'</td>';
                $concat .= '<td>' . $acto['Hora'] .'</td>';
                /* $concat .= '<td>' . $esPonente .'</td>'; */
                /* $concat .= '<td>' . '<form action="index.php" method="POST">
                                    <input name="id_acto" type="hidden" value="'.$acto['Id_acto'].'">
                                    <button type="submit" name="esPonente" value="'. $valueBotonPonente .'"  class="'. $colorBotonPonente . '">' . $nombreBotonPonente .  '</button>
                                    </form>' .'</td>'; */
                $concat .= '<td>' . '<form action="index.php" method="POST">
                                    <input name="id_acto" type="hidden" value="'.$acto['Id_acto'].'">
                                    <button type="submit" name="inscribirBorrar" value="'. $valueBoton .'"  class="'. $colorBoton . '">' . $nombreBoton .  '</button>
                                    </form>' .'</td>';
                $concat .= '<td>' . '<form  action="mostrarEvento.php" method="post">
                                     <input name="id_acto" type="hidden" value="'.$acto['Id_acto'].'">
                                     <button type="submit" class="btn btn-primary">Ver evento</button>
                                     
                                     </form>' . '</td>';
                $concat .= '</tr>';
            }
            
            echo $concat;
            
        ?>
        </tbody>
	</table>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="mostrarEvento"
	data-backdrop="static" data-keyboard="false">
	  <script>

    function enviarActo(numeroActo) {

      var ModalEdit = new bootstrap.Modal(mostrarEvento, {}).show();

      
      document.cookie = "variable = " + numeroActo;

    }

  </script>
	<div class="modal-dialog" style="max-width: 70% !important;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="evento">Evento</h5>
				<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
			</div>
			<div id="copiarPortapapeles" class="modal-body">
				
				<?php 
				//$html = '<span id="variable"></span>';
				/* $html = '';
				$html->loadHTML('<span id="variable"></span>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
				
			    //$b = (String)$a;
			    //$b = '<p>'.$a.'</p>';
			    //echo $b;
			    $doc = new DOMDocument();
			    $doc->loadHTML($html);
			    $nodes = $doc->getElementsByTagName('p');
			    $title = $nodes->item(0)->nodeValue;
			    echo($title); */
			    
				$variable= $_COOKIE['variable'];
				echo $variable;
			    
			    $data = getEvento(1);
    				$concat2 = '';
        			foreach ($data as $acto) {
                        $concat2 .= 'Titulo del acto -> ' . $acto['Titulo'] . "<br>";
                        $concat2 .= 'Fecha del acto -> ' . $acto['Fecha'] . "<br>";
                        $concat2 .= 'Hora del Acto -> ' . $acto['Hora'] . "<br>";
                        $concat2 .= 'Descripcion -> ' . $acto['Descripcion_larga'] . "<br>";
                        $concat2 .= 'Numero de asistentes -> ' . $acto['Num_asistentes'] . "<br>";
                        $concat2 .= 'Nombre ponente -> ' . $acto['nombre'] . ' ' . $acto['apellido1'] . ' ' . $acto['apellido2'];
                    }
                    echo $concat2;
                ?>
			</div>
		</div>
	</div>
</div>

<!-- Menu ponentes -->
<?php
} else if ($_SESSION['rol'] == 'Ponente') {
    require_once('./controllers/actosController.php');
?>
<?php 
if (isset($_POST["inscribirBorrar"])) {
    if ($_POST["inscribirBorrar"] == "borrarse") {

            $borrado = deleteInscripcion($_SESSION['persona'], $_POST["id_acto"]);
            if ($borrado == 1) {
                echo "<script>alert('Te has borrado correctamente del acto')</script>";
            }else{
                echo "<script>alert('Ha habido algun fallo al borrarte del acto')</script>";
            }
    }else{

        $insercion = insertInscripcion($_SESSION['persona'], $_POST["id_acto"]);
        if ($insercion == 1) {
            echo "<script>alert('Te has inscrito correctamente en el acto')</script>";
        }else{
            echo "<script>alert('Ha habido algun fallo al inscribirte en el acto acto')</script>";
        }
    }
}

if (isset($_POST["esPonente"])) {
    if ($_POST["esPonente"] == "ponente") {
        
        $borrado = deletePonente($_SESSION['persona'], $_POST["id_acto"]);
        if ($borrado == 1) {
            echo "<script>alert('Te has borrado como ponente correctamente')</script>";
        }else{
            echo "<script>alert('Ha habido algun fallo al borrarte como ponente')</script>";
        }
    }else{
        
        $insercion = insertPonente($_SESSION['persona'], $_POST["id_acto"]);
        if ($insercion == 1) {
            echo "<script>alert('Te has inscrito correctamente como ponente')</script>";
        }else{
            echo "<script>alert('Ha habido algun fallo al inscribirte como ponente')</script>";
        }
    }
}
?>
<?php
    $tipoVistaColorXdia = "btn btn-primary";
    $tipoVistaColorXsemana = "btn btn-primary";
    $tipoVistaColorXmes = "btn btn-primary";
    $_SESSION["tipoVista"] = null;
    if (!isset($_POST["mostrarVista"])) {
        $_SESSION["tipoVista"] == null;
    }else{
        $_SESSION["tipoVista"]= $_POST["mostrarVista"];
    }
    
    $concat = '';
    
    if (!isset($_SESSION["tipoVista"]) or $_SESSION["tipoVista"] == "3") {
        $data = getAllActosXmes();
        $tipoVistaColorXmes = "btn btn-success";
    }else if($_SESSION["tipoVista"] == "2"){
        $data = getAllActosUltimos7dias();
        $tipoVistaColorXsemana = "btn btn-success";
    }else if($_SESSION["tipoVista"] == "1"){
        $data = getAllActosXdia();
        $tipoVistaColorXdia = "btn btn-success";
    }
    
    
?>
<div align="center">
	<form action="index.php" method="post">
      <button type="submit" name="mostrarVista" value="1" class="<?php echo $tipoVistaColorXdia; ?>">Vista por dia</button>
      <button type="submit" name="mostrarVista" value="2" class="<?php echo $tipoVistaColorXsemana; ?>">Vista ultimos siete dias</button>
      <button type="submit" name="mostrarVista" value="3" class="<?php echo $tipoVistaColorXmes; ?>">Vista por mes</button>
    </form>
    <br>
</div>
<div>
	<table class="table">
		<thead class="thead-dark">
    		<tr>
    			<th scope="col">NOMBRE DEL ACTO</th>
    			<th scope="col">FECHA DEL ACTO</th>
    			<th scope="col">HORA DEL ACTO</th>
    			<th scope="col">ERES PONENTE</th>
    			<th scope="col">PONENTE</th>	
    			<th scope="col">INSCRITO</th>
    			<th scope="col">EVENTO</th>
    		</tr>
		</thead>
		<tbody>
        <?php
            
            
            
            foreach ($data as $acto) {
                
                if (!getInscritos($_SESSION['persona'], $acto['Id_acto'])) {
                    $nombreBoton = "inscribirse";
                    $colorBoton = "btn btn-primary";
                    $valueBoton = "incribir";
                }else {
                    $nombreBoton = "borrarse";
                    $colorBoton = "btn btn-warning";
                    $valueBoton = "borrarse";
                }
                
                $result = isPonente($_SESSION['persona'], $acto['Id_acto']);

                if (!$result == 0) {
                    $esPonente = 'SI';
                    $valueBotonPonente = "ponente";                  
                    $nombreBotonPonente = "Quitarse como ponente";
                    $colorBotonPonente = "btn btn-warning";
                }else{
                    $esPonente = 'NO';
                    $valueBotonPonente = "noponente";
                    $nombreBotonPonente = "Ponerse como ponente";
                    $colorBotonPonente = "btn btn-primary";
                }
                
                $concat .= '<tr>';
                $concat .= '<td>' . $acto['Titulo'] .'</td>';
                $concat .= '<td>' . $acto['Fecha'] .'</td>';
                $concat .= '<td>' . $acto['Hora'] .'</td>';
                $concat .= '<td>' . $esPonente .'</td>';
                $concat .= '<td>' . '<form action="index.php" method="POST">
                                    <input name="id_acto" type="hidden" value="'.$acto['Id_acto'].'">
                                    <button type="submit" name="esPonente" value="'. $valueBotonPonente .'"  class="'. $colorBotonPonente . '">' . $nombreBotonPonente .  '</button>
                                    </form>' .'</td>';
                $concat .= '<td>' . '<form action="index.php" method="POST">
                                    <input name="id_acto" type="hidden" value="'.$acto['Id_acto'].'">
                                    <button type="submit" name="inscribirBorrar" value="'. $valueBoton .'"  class="'. $colorBoton . '">' . $nombreBoton .  '</button>
                                    </form>' .'</td>';
                $concat .= '<td>' . '<form  action="mostrarEvento.php" method="post">
                                     <input name="id_acto" type="hidden" value="'.$acto['Id_acto'].'">
                                     <button type="submit" class="btn btn-primary">Ver evento</button>
                                     
                                     </form>' . '</td>';
                $concat .= '</tr>';
            }
            
            echo $concat;
            
        ?>
        </tbody>
	</table>
</div>
<?php }?>


<!-- Menu menu administrador -->


<?php include ("./views/footer.php") ?>