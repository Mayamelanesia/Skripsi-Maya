<?php
// models/Penduduk.php

class Penduduk
{
     private $conn;
     private $table_name = "penduduk";

     public function __construct($db)
     {
          $this->conn = $db;
     }

     // Mengambil semua data penduduk
     public function readAll()
     {
          $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
          $stmt = $this->conn->prepare($query);
          $stmt->execute();

          return $stmt;
     }

     // Fungsi untuk menambahkan data penduduk baru
     public function create($nik, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $alamat, $nomor_hp, $status_penduduk)
     {
          $query = "INSERT INTO " . $this->table_name . " 
                    (nik, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, nomor_hp, status_penduduk) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

          $stmt = $this->conn->prepare($query);

          // Eksekusi query dengan data yang dikirim untuk disimpan ke database
          if ($stmt->execute([$nik, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $alamat, $nomor_hp, $status_penduduk])) {
               return true;
          }

          return false;
     }

     // Mengambil data penduduk berdasarkan ID untuk form Edit
     public function readById($id)
     {
          $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
          $stmt = $this->conn->prepare($query);
          $stmt->execute([$id]);
          return $stmt->fetch(PDO::FETCH_ASSOC);
     }

     // Memperbarui data penduduk (Update)
     public function update($id, $nik, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $alamat, $nomor_hp, $status_penduduk)
     {
          $query = "UPDATE " . $this->table_name . " 
                    SET nik=?, nama=?, tempat_lahir=?, tanggal_lahir=?, jenis_kelamin=?, alamat=?, nomor_hp=?, status_penduduk=? 
                    WHERE id=?";
          $stmt = $this->conn->prepare($query);
          if ($stmt->execute([$nik, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $alamat, $nomor_hp, $status_penduduk, $id])) {
               return true;
          }
          return false;
     }

     // Menghapus data penduduk (Delete)
     public function delete($id)
     {
          $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
          $stmt = $this->conn->prepare($query);
          if ($stmt->execute([$id])) {
               return true;
          }
          return false;
     }
}
