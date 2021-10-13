<?php
    include('../class/rutas.php');
    include('../class/conexion.php');

    $res = $mbd->query("SELECT id, nombre, descripcion FROM temas ORDER BY nombre");
    $temas = $res->fetchall();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <?php include('../partials/menu.php'); ?>
    </header>
    <div class="container-fluid">
        <h1>Lista de Temas</h1>
        <table class="table table-hover">
            <tr>
                <th>Id</th>
                <th>Tema</th>
                <th>Descripción</th>
            </tr>
            <?php foreach($temas as $tema): ?>
                <tr>
                    <td><?php echo $tema['id'] ?></td>
                    <td><?php echo $tema['nombre'] ?></td>
                    <td><?php echo $tema['descripcion'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <a href="<?php echo TEMAS . 'add.php'; ?>" class="btn btn-outline-success">Agregar Tema</a>
    </div>

</body>
</html>