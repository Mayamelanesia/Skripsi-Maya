<?php
// models/Pengajuan.php

class Pengajuan
{
     private $conn;
     private $table_name = "pengajuan_surat";

     public function __construct($db)
     {
          $this->conn = $db;
     }

     // Mengambil semua data pengajuan beserta nama pemohon dan jenis surat
     public function readAll()
     {
          $query = "SELECT ps.*, p.nik, p.nama AS nama_pemohon, js.nama_surat 
                  FROM " . $this->table_name . " ps
                  JOIN penduduk p ON ps.penduduk_id = p.id
                  JOIN jenis_surat js ON ps.jenis_surat_id = js.id
                  ORDER BY ps.tanggal DESC";
          $stmt = $this->conn->prepare($query);
          $stmt->execute();
          return $stmt;
     }

     // Mengambil data untuk dropdown
     public function getPenduduk()
     {
          $stmt = $this->conn->prepare("SELECT id, nik, nama FROM penduduk ORDER BY nama ASC");
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }

     public function getJenisSurat()
     {
          $stmt = $this->conn->prepare("SELECT id, nama_surat FROM jenis_surat ORDER BY nama_surat ASC");
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }

     // Simpan data pengajuan baru
     public function create($nomor, $penduduk_id, $jenis_id, $keperluan)
     {
          $query = "INSERT INTO " . $this->table_name . " (nomor_pengajuan, penduduk_id, jenis_surat_id, keperluan) VALUES (?, ?, ?, ?)";
          $stmt = $this->conn->prepare($query);
          if ($stmt->execute([$nomor, $penduduk_id, $jenis_id, $keperluan])) {
               return $this->conn->lastInsertId(); // Kembalikan ID pengajuan untuk proses upload lampiran
          }
          return false;
     }

     // Simpan lampiran file
     public function insertLampiran($pengajuan_id, $file_name)
     {
          $query = "INSERT INTO lampiran_surat (pengajuan_id, file) VALUES (?, ?)";
          $stmt = $this->conn->prepare($query);
          return $stmt->execute([$pengajuan_id, $file_name]);
     }

     // Ambil data pengajuan berdasarkan ID untuk Edit
     // Ambil data pengajuan berdasarkan ID untuk Edit dan Cetak
     public function readById($id)
     {
          // Menambahkan p.tempat_lahir, p.tanggal_lahir, p.jenis_kelamin, p.alamat pada SELECT
          $query = "SELECT ps.*, 
                         p.nama as nama_pemohon, 
                         p.nik, 
                         p.tempat_lahir, 
                         p.tanggal_lahir, 
                         p.jenis_kelamin, 
                         p.alamat, 
                         js.nama_surat 
                  FROM " . $this->table_name . " ps 
                  JOIN penduduk p ON ps.penduduk_id = p.id 
                  JOIN jenis_surat js ON ps.jenis_surat_id = js.id 
                  WHERE ps.id = ?";

          $stmt = $this->conn->prepare($query);
          $stmt->bindParam(1, $id);
          $stmt->execute();

          return $stmt->fetch(PDO::FETCH_ASSOC);
     }

     // Update status dan catatan (Admin/Petugas)
     public function update($id, $status, $catatan)
     {
          $query = "UPDATE " . $this->table_name . " SET status = ?, catatan = ? WHERE id = ?";
          $stmt = $this->conn->prepare($query);
          return $stmt->execute([$status, $catatan, $id]);
     }

     // Hapus pengajuan
     public function delete($id)
     {
          $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
          $stmt = $this->conn->prepare($query);
          return $stmt->execute([$id]);
     }
}