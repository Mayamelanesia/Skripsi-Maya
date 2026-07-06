<?php
// models/Laporan.php

class Laporan
{
     private $conn;

     public function __construct($db)
     {
          $this->conn = $db;
     }

     // Mengambil rekap jumlah pengajuan berdasarkan status
     public function getRekapStatus()
     {
          $query = "SELECT status, COUNT(*) as total FROM pengajuan_surat GROUP BY status";
          $stmt = $this->conn->prepare($query);
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
}
