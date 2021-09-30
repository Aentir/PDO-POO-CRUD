<?php

class Select extends Connection
{

  public function __construct()
  {
    parent::__construct();
  }

  public function getInfo($value = null)
  {

    //Si getInfo() recibe algún parametro (GET/POST) se lo pasará al IF, sino, entrará en el ELSE
    if ($value) {
      //Creo la query que quiero lanzar
      $sql = "SELECT alum_dni, alum_nombre, alum_apellido1, alum_apellido2, alum_nota FROM t_alumnos WHERE alum_nombre = ?";

      //prepare() lo que hace es preparar una sentencia para su ejecución y devuelve un obj
      $result = $this->db->prepare($sql);

      //execute() ejecuta la sentencia preparada con los valores que le hayamos pasado
      $result->execute(array($value));

      //Como lo que se devuelve es un objeto con forma de array
      //lo recorro con un foreach ENTERO
      $output = "";
      foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
        /*echo $row["alum_nombre"] . " " . $row["alum_apellido1"] . " " .
          $row["alum_apellido2"] . " " . $row["alum_dni"] . "<br>";*/

          $output .= "<td>" . $row["alum_nombre"] . "</td>";
          $output .= "<td>" . $row["alum_dni"] . "</td>";
          $output .= "<td>" . $row["alum_apellido1"] . "</td>";
          $output .= "<td>" . $row["alum_apellido2"] . "</td>";

          //Este if comprueba que si la posición del array que recorremos (consulta) contiene la condición, se le aplicarán los cambios
          //Lo mismo en el ELSE
          if($row["alum_nota"] < 4) {
            $output .= "<td style='background-color:salmon'>" . $row["alum_nota"] . "</td>";
          } else {
            $output .= "<td>" . $row["alum_nota"] . "</td>";
          }
          $output .= "</tr>";
      }
    
    } else {
      $query = "SELECT alum_dni, alum_nombre, alum_apellido1, alum_apellido2, alum_nota FROM t_alumnos";
      $result = $this->db->prepare($query);
      $result->execute(array());
      $output = "";
      foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
        /*echo $row["alum_nombre"] . " " . $row["alum_apellido1"] . " " .
          $row["alum_apellido2"] . " " . $row["alum_dni"] . "<br>";*/

          $output .= "<tr>";
          $output .= "<td>" . $row["alum_nombre"] . "</td>";
          $output .= "<td>" . $row["alum_dni"] . "</td>";
          $output .= "<td>" . $row["alum_apellido1"] . "</td>";
          $output .= "<td>" . $row["alum_apellido2"] . "</td>";
          if($row["alum_nota"] < 4) {
            $output .= "<td style='background-color:salmon'>" . $row["alum_nota"] . "</td>";
          } else {
            $output .= "<td>" . $row["alum_nota"] . "</td>";
          }
          $output .= "</tr>";
      }
      
    }
    return $output;
  }
}
?>