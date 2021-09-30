<?php
    //Gracias al autoloader nos evitamos tener que hacer uso de los includes y requires en cada uno
    //de los archivos donde necesitemos hacer uso de estos, ya que si tuviesemos muchos, habría demasiado
    //código repetido
    
    //Si encuentra la carpeta y fichero que requerimos lo incluye y sino, mata el script lanzando el error
    function autoloader($clase)
    {
        $dir = ["clases"];
        $fileExist = false;

        foreach ($dir as $directorio) {
        $fichero = "$directorio/{$clase}.php";
            if (file_exists($fichero)) {
                require_once $fichero;
                $fileExist = true;
            }  
        }
        if (!$fileExist) {
            die("El fichero de clase {$clase}.php no existe");
        }
    }
    spl_autoload_register("autoloader");
?>