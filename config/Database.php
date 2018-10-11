<?php
/**
 * Created by PhpStorm.
 * User: sierra.sonich
 * Date: 11.10.2018
 * Time: 09:37
 */

class Database
{
    //db params

    private $host = 'localhost';
    private $db_name = 'myblog';
    private $username = 'root';
    private $password = 'dyb3t321';
    private $conn;

    //db connect


    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host .'; dbname=' . $this->db_name , $this->username , $this->password);
            $this->conn->setAttribute('PDO:::ATTR_ERRMODE, PDO:::ERRMODE_EXCEPTOPN');
        } catch (PDOException $e) {
            echo 'Connetion Error check params:' . $e->getMessage();
        }

        return $this->conn;
    }

}