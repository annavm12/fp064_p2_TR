<?php include ("./views/header.php"); ?>
<div align="center">
<table class="table">
<?php 
                require_once('controllers/actosController.php');
                $data = getEvento($_POST["id_acto"]);
    				$concat2 = '';
        			foreach ($data as $acto) {
                        $concat2 .= '<tr><td>Titulo del acto -> ' . $acto['Titulo'] . '</td></tr> <br>';
                        $concat2 .= '<tr><td>Fecha del acto -> ' . $acto['Fecha'] . '</td></tr> <br>';
                        $concat2 .= '<tr><td>Hora del Acto -> ' . $acto['Hora'] . '</td></tr> <br>';
                        $concat2 .= '<tr><td>Descripcion -> ' . $acto['Descripcion_larga'] . '</td></tr> <br>';
                        $concat2 .= '<tr><td>Numero de asistentes -> ' . $acto['Num_asistentes'] . '</td></tr> <br>';
                        $concat2 .= '<tr><td>Nombre ponente -> ' . $acto['nombre'] . ' ' . $acto['apellido1'] . ' ' . $acto['apellido2'] . '</td></tr><br>';
                        $concat2 .= '<tr><td><form action="index.php" method="post"> 
                                     <button type="submit" name="mostrarEvento"  class="btn btn-primary">Volver a eventos</button>
                                     </form></td></tr>';
                    }
                    echo $concat2;
?>
</table>
</div>
<?php include ("./views/footer.php") ?>