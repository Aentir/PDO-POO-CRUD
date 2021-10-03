<?php
    require_once "autoloader.php";

    $info = new Select();
    $info->getInfo();
    
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
        <form action="">
            <p><label>DNI Alumno: </label></p>
                <input type="text" name="alum_dni" value="<?= $info["alum_dni"]?>"/>
        </form>
    </body>    
</html>