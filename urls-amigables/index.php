<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php 

    $rutas = array();

    if(isset($_GET["pagina"])){

        $rutas = explode("/", $_GET["pagina"]);

        //var_dump($rutas);

        if($rutas[0] == "editar"){

            include "editar.php";

        }

        if($rutas[0] == "usuarios"){

            include "usuarios.php";

        }

    } else {

    include "usuarios.php";

    }

     ?>
</body>
</html>
