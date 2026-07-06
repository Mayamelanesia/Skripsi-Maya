<?php

class Database
{
     private $host = "localhost";
     private $db_name = "db_pelayanan_surat";
     private $username = "root";
     private $password = '';
     public $conn;

     public function getConnection()
     {
          $this->conn = null;

          try {
               // Menggunakan PDO untuk koneksi yang lebih aman
               $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

               // Set error mode ke exception agar error mudah di-debug
               $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

               // Set default fetch mode ke associative array
               $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
          } catch (PDOException $exception) {
               echo "Connection error: " . $exception->getMessage();
          }

          return $this->conn;
     }
}
