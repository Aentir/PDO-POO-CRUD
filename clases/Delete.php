<?php

    class Delete extends Connection
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function deleteData()
        {
            $sql = "DELETE FROM t_alumnos WHERE alum_dni = ?";
            $result = $this->db->prepare($sql);
            $result->execute(array($_GET["alum_dni"]));
        }
    }
?>