<?php
    include('../class/rutas.php');
    include('../class/conexion.php');

    if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {
       $nombre = trim(strip_tags($_POST['nombre']));
       $descripcion = trim(strip_tags($_POST['descripcion']));

       if (!$nombre) {
          $msg = 'Ingresa el nombre';
       }elseif (!$descripcion) {
           $msg = 'Ingresa la descripcion';
       }else{
           #verificar que el tema no esta registrado
           $res = $mbd->prepare("SELECT id FROM temas WHERE nombre = ?");
           $res->bindParam(1, $nombre);
           $res->execute();
           $tema = $res->fetch();

           if ($tema) {
               $msg = 'El tema ingresado ya existe... intente con otro';
           }else{
               #ingresar el tema
                $res = $mbd->prepare("INSERT INTO temas(nombre, descripcion) VALUES(?, ?)");
                $res->bindParam(1, $nombre);
                $res->bindParam(2, $descripcion);
                $res->execute();

                $row = $res->rowCount();

                if ($row) {
                    header('Location: ' . TEMAS);
                }
           }
       }

       //print_r($nombre);
    }
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
        <div class="col-md-6 offset-md-3">

            <?php if(isset($msg)):?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $msg; ?>
                </div>
            <?php endif; ?>

            <h1>Nuevo Tema</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input type="text" name="nombre" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Ingresa el nombre del tema.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Descripcion</label>
                    <textarea name="descripcion" id="" class="form-control" rows="4">
                        <?php if(isset($_POST['descripcion'])) echo $_POST['descripcion']; ?>
                    </textarea>
                </div>
                <input type="hidden" name="confirm" value="1">
                <button type="submit" class="btn btn-outline-success">Guardar</button>
            </form>
        </div>

    </div>

</body>
</html>