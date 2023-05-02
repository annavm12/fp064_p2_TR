<?php session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid'] == 0)) {
    header('location:logout.php');
} else {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Acto | Registration and Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include_once('includes/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <?php
    $Id_acto = $_GET['Id_acto'];
    $query = mysqli_query($con, "select * from actos where id='Id_acto'");
    while ($result = mysqli_fetch_array($query)) { ?>
                    <h1 class="mt-4">
                        <?php echo $result['$titulo']; ?>'actos'
                    </h1>
                    <div class="card mb-4">

                        <div class="card-body">
                            <a href="edit-acto.php?uid=<?php echo $result['$Id_acto']; ?>">Edit</a>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Titulo</th>
                                    <td>
                                        <?php echo $result['$titulo']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Idtipo</th>
                                    <td>
                                        <?php echo $result['$idtipo']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>IdPonentes</th>
                                    <td colspan="3">
                                        <?php echo $result['$id_ponentes']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Descripcion Corta</th>
                                    <td colspan="3">
                                        <?php echo $result['$descorta']; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Fecha</th>
                                    <td colspan="3">
                                        <?php echo $result['$fecha']; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </main>
            <?php include('../includes/footer.php'); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>
<?php } ?>