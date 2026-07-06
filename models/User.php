<?php
// models/User.php

class User
{
     private $conn;
     private $table_name = "users";

     public function __construct($db)
     {
          $this->conn = $db;
     }

     // Fungsi untuk mengambil data user berdasarkan email
     // Mengambil data user berdasarkan email
     public function login($email)
     {
          // PERHATIKAN: Ditambahkan kolom penduduk_id
          $query = "SELECT id, nama, email, password, role_id, penduduk_id FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";
          $stmt = $this->conn->prepare($query);

          $stmt->bindParam(1, $email);
          $stmt->execute();

          return $stmt->fetch(PDO::FETCH_ASSOC);
     }

     // Mengambil semua data user beserta nama role-nya
     public function readAll()
     {
          $query = "SELECT u.*, r.role as nama_role FROM " . $this->table_name . " u 
                  JOIN roles r ON u.role_id = r.id 
                  ORDER BY u.id DESC";
          $stmt = $this->conn->prepare($query);
          $stmt->execute();
          return $stmt;
     }

     // Mengambil data user berdasarkan ID
     public function readById($id)
     {
          $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
          $stmt = $this->conn->prepare($query);
          $stmt->execute([$id]);
          return $stmt->fetch(PDO::FETCH_ASSOC);
     }

     // Menghapus user
     public function delete($id)
     {
          $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
          $stmt = $this->conn->prepare($query);
          return $stmt->execute([$id]);
     }
}
