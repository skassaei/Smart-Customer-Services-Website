<?php
    class Dbc {
        private $servername ;
        private $username ;
        private $password ;
        private $db;

        function connect(){
            $this->servername="localhost";
            $this->username="root";
            $this->password="";
            $this->db="smart_customer_services";
        
            $conn = new mysqli($this->servername,$this->username,$this->password,$this->db);
            return $conn;
        
        }

    
    }
?>