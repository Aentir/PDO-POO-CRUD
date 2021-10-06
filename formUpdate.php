<?php
    require_once "autoloader.php";

    $info = new Update();
    
    if (count($_POST)) {
        $values = $_POST;
        $info->updateData($values);
        //El header redireccionará a index.php
        //header("location: index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form to Update</title>
</head>
    <body>
        <h1>Formulario de actualizacion del alumno</h1>
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
        </form>
    </body>    
</html>