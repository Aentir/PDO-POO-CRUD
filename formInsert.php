<?php
    require_once "autoloader.php";

    $data = new Insert();

    //Si recibe información por POST la guarda en $values y se la pasa al método
    if (count($_POST)) {
        $values = $_POST;
        $data->insertData($values);
        //El header redireccionará a index.php
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva inserción</title>
</head>
    <body>
        <form action="" method="post">
            <p><label>DNI Alumno: </label></p>
                <input type="text" name="alum_dni">
            <p><label>Nombre alumno: </label></p>
                <input type="text" name="alum_nombre">
            <p><label>Primer apellido: </label></p>
                <input type="text" name="alum_apellido1">
            <p><label>Segundo apellido: </label></p>
                <input type="text" name="alum_apellido2">
            <p><label>Nota del alumno: </label></p>
                <input type="text" name="alum_nota"><br>
            <input type="submit" name="envio" value="Enviar">
                <a href="index.php">Volver a la tabla</a>    
        </form>
    </body>
</html>