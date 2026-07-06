<?php
// models/Arsip.php

class Arsip
{
     private $conn;

     public function __construct($db)
     {
          $this->conn = $db;
     }

     // Mengambil semua data pengajuan yang HANYA berstatus 'Selesai'
     public function readAll()
     {
          $query = "SELECT ps.*, p.nik, p.nama AS nama_pemohon, js.nama_surat 
                  FROM pengajuan_surat ps
                  JOIN penduduk p ON ps.penduduk_id = p.id
                  JOIN jenis_surat js ON ps.jenis_surat_id = js.id
                  WHERE ps.status = 'Selesai'
                  ORDER BY ps.tanggal DESC";

          $stmt = $this->conn->prepare($query);
          $stmt->execute();

          return $stmt;
     }
}
