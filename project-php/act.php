<?php

include "db.php";

if(empty($_SESSION["user-data"]))
{
  header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>


<h1>Acts Data</h1>

<table id="customers">
  <tr>
    <th>Fecha</th>
    <th>Hora</th>
    <th>Titulo</th>
    <th>Descripcion corta</th>
    <th>Descripcion larga</th>
    <th>Num asistentes</th>
    <th>Tipo Acto </th>
    <th>Action</th>
  </tr>
  <?php 

    $id = $_REQUEST["id"] ?? NULL;

    $list = getActs($id);


    foreach($list as $row):
  ?>

  <tr>
    <td><?php echo $row["Fecha"]; ?></td>
    <td><?php echo $row["Hora"]; ?></td>
    <td><?php echo $row["Titulo"]; ?></td>
    <td><?php echo $row["Descripcion_corta"]; ?></td>
    <td><?php echo $row["Descripcion_larga"]; ?></td>
    <td><?php echo $row["Num_asistentes"]; ?></td>
    <td><?php echo $row["Descripcion"]; ?></td>
    <td><input type="checkbox" 

      <?php  

    if(!empty($row['Id_inscripcion']))
      echo "checked";
       ?>

      onclick="add_inscritos(
      <?php echo $row['Id_acto'] ?>,
      <?php echo $_SESSION['user-data']['Id_Persona'];?>)" /> </td>
  </tr>

  <?php endforeach ?>
  
</table>


<script type="text/javascript">
  
  function add_inscritos(act_id,p_id)
  {
    $.ajax({
      method: "POST",
      url: "db.php",
      data: { "p_id": p_id, "act_id": act_id,"action":"insert-inscritos"}
      })
      .done(function( msg ) {
       // location.href  = location.href;
      });
      }

</script>

</body>
</html>


