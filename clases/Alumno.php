<?php

class Alumno extends Connection
{

  public function __construct()
  {
    parent::__construct();
  }

  public function getInfo($value = null)
  {
    /* array que devolverá el método */
    $getArray = [];
    /* consulta a la base de datos */
    $query = "SELECT alum_dni, alum_nombre, alum_apellido1, alum_apellido2, alum_nota FROM t_alumnos ";
    /* Prepara la consulta */

    /* Sí existe un value se concatena a la consulta */
    if ($value) {
      $query .= "WHERE alum_dni = ?;";
    } else {
      $query .= ";";
    }

    /* Prepara y ejecuta la consulta  */
    $result = $this->db->prepare($query);
    $result->execute(array($value));

    /* Guarda en array el resultado de la consulta */
    foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
      array_push($getArray, $row);
    }

    return $getArray;
  } // getInfo()

  public function showInfo($value = null)
  {
    $output = "";
    /* Recibe el resultado de la consulta getInfo */
    $alumnos = $this->getInfo($value);

    /* Por cada registro recibido crea una fila */
    /* sirve para múltiples registros, un registro */
    /* en vista debe tratarse el caso 0 registros */
    foreach ($alumnos as $alumno) {
      /* inicia row */
      $output .= "<tr>";

      $output .= "<td>" . $alumno["alum_dni"] . "</td>";
      $output .= "<td>" . $alumno["alum_nombre"] . "</td>";
      $output .= "<td>" . $alumno["alum_apellido1"] . "</td>";
      $output .= "<td>" . $alumno["alum_apellido2"] . "</td>";

      if ($alumno["alum_nota"] < 4) {
        $output .= "<td style='background-color:salmon'>" . $alumno["alum_nota"] . "</td>";
      } else {
        $output .= "<td>" . $alumno["alum_nota"] . "</td>";
      }

      $output .= "<td><a href='deleteAlumn.php?id=" . $alumno["alum_dni"] . "'>Borrar alumno</a></td>";
      $output .= "<td><a href='formUpdate.php?alum_dni=" . $alumno["alum_dni"] . "&name=" . $alumno["alum_nombre"] . "&firstname=" . $alumno["alum_apellido1"] . "&firstname=" . $alumno["alum_apellido2"] . "&nota=" . $alumno["alum_nota"] . "'>Actualizar alumno</a></td>";

      /* cierra row */
      $output .= "</tr>";
    }

    return $output;
  } // showInfo()

  public function update($values)
  {
    /* Sin values la aplicación muere */
    if (!$values) die("Sin value la aplicación muere...");

    /* ojo a la query user where */
    $query = "UPDATE t_alumnos SET alum_nombre = :alum_nombre, alum_apellido1 = :alum_apellido1, alum_apellido2 = :alum_apellido2, alum_nota = :alum_nota WHERE alum_dni = :alum_dni";

    /* Prepara query */
    $result = $this->db->prepare($query);

    $result->bindParam(":alum_nombre",    $values["alum_nombre"], PDO::PARAM_STR, 25);
    $result->bindParam(":alum_apellido1", $values["alum_apellido1"], PDO::PARAM_STR, 25);
    $result->bindParam(":alum_apellido2", $values["alum_apellido2"], PDO::PARAM_STR, 25);
    $result->bindParam(":alum_nota",      $values["alum_nota"], PDO::PARAM_STR, 2);
    $result->bindParam(":alum_dni",       $values["alum_dni"], PDO::PARAM_STR, 9);

    try {
      /* Ejecuta en un try catch para resolver errores */
      $result->execute();

      return true;
    } catch (\Throwable $th) {
      /* cuidado los errores no son muy descriptivos */
      echo "error: $th";

      return false;
    }
  } // update()
}
