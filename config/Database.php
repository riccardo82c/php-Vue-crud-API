<?php

/* require_once './env.php'; */

class Database {

    // Database parameters
    /* use env trait to include db connection var*/
    /* use Env; */

    private $host = 'localhost';
    private $db_name = 'todo_list';
    private $pwd = 'root';
    private $user = 'root';
    private $conn;

    //  Method to connect
    public function connect() {

        $this->conn = null;
        try {

            /* par for connection */
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->user, $this->pwd);
            /* set throw exception in case of error */
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;

        } catch (PDOException $e) {

            echo 'Connection Error: ' . $e->getMessage();

        }

    }

};
