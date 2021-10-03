<?php
    require_once "autoloader.php";
    $borrado = new Delete();
    $borrado->deleteData();
    
    //Una vez ejecutado el script vuelvo a index.php automáticamente
    header("location: index.php");
?>