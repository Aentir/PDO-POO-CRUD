<?php
require_once "autoloader.php";

/* Para llegar hasta este formulario es necesario haber seleccionado un id */
/* el id puede llegar desde get o post (habiendo pulsado enviar) */
/* depende de action de form el post lo recibirá index.php o en este caso*/
/* se recibe en esta misma página */
if (isset($_GET["alum_dni"])) {
  $id = $_GET["alum_dni"];
} elseif (isset($_POST["envio"])) {
  $id = $_POST["alum_dni"];

  $values = [
    "alum_dni" => $_POST["alum_dni"],
    "alum_nombre" => $_POST["alum_nombre"],
    "alum_apellido1" => $_POST["alum_apellido1"],
    "alum_apellido2" => $_POST["alum_apellido2"],
    "alum_nota" => $_POST["alum_nota"]
  ];
} else { /* si no lo tengo muere*/
  die("Error, no id to update.");
}


$alumno = new Alumno();
$result = $alumno->getInfo($id);

/* Si llegado ha este punto existe values actualizamos el registro */
if ($values) {
  $updated = $alumno->update($values);

  /* Si la actualización ha sido correcta vuelve a index */
  /* de lo contrario muestra error y link hacia index */
  if ($updated) {
    header("location: index.php");
  } else {
    echo '<br><a style="font-size: 2rem; margin-top: 2rem;" href="index.php">🔙</a><br>';
    die("Algún problema con la base de datos");
  }
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

  <a style="font-size: 2rem;" href="index.php">🔙</a>

  <h1>Formulario de actualización del alumno</h1>

  <form action="formUpdate.php" method="post">
    <p><label>DNI Alumno: </label></p>
    <input type="text" name="alum_dni" disabled=true value='<?= $result[0]["alum_dni"] ?>' />
    <input type="hidden" name="alum_dni" value='<?= $result[0]["alum_dni"] ?>' />

    <p><label>Nombre alumno: </label></p>
    <input type="text" name="alum_nombre" value='<?= $result[0]["alum_nombre"] ?>' />

    <p><label>Primer apellido: </label></p>
    <input type="text" name="alum_apellido1" value='<?= $result[0]["alum_apellido1"] ?>' />

    <p><label>Segundo apellido: </label></p>
    <input type="text" name="alum_apellido2" value='<?= $result[0]["alum_apellido2"] ?>' />

    <p><label>Nota del alumno: </label></p>
    <input type="text" name="alum_nota" value='<?= $result[0]["alum_nota"] ?>' />

    <br>
    <input style="margin-top: 2rem;" type="submit" name="envio" value="Enviar" />
  </form>

</body>

</html>
