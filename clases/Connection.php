<?php

    class Connection {

        private $server = "localhost";
        private $user = "root";
        private $password = "";
        private $dbname = "florida";
        
        public function __construct()
        {
            try {
                //Conecto
                $this->db = new PDO("mysql:host=$this->server;dbname=$this->dbname", $this->user, $this->password);
                //Establezco excepción de errores
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //echo "He conectado con éxito" . "<br>";

            } catch (PDOException $e){
                //Si la conexion fallase, lanzaría este mensaje de error especificando el fallo
                echo "Error: " . $e->getMessage();
            }
            return $this->db;
        }
    }
?>