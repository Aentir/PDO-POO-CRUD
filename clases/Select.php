<?php

class Select extends Connection
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
}

