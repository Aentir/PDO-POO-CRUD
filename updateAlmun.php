<?php
    require_once "autoloader.php";
    $actualizado = new Update();
    $actualizado->updateData();
    header("location: index.php");

?>