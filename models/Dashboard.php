<?php
// models/Dashboard.php

class Dashboard
{
     private $conn;

     public function __construct($db)
     {
          $this->conn = $db;
     }

     public function getTotalPenduduk()
     {
          $stmt = $this->conn->query("SELECT COUNT(*) as total FROM penduduk");
          return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
     }

     public function getTotalPengajuan()
     {
          $stmt = $this->conn->query("SELECT COUNT(*) as total FROM pengajuan_surat");
          return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
     }

     public function getPengajuanPending()
     {
          $stmt = $this->conn->query("SELECT COUNT(*) as total FROM pengajuan_surat WHERE status = 'Pending'");
          return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
     }

     public function getPengajuanSelesai()
     {
          $stmt = $this->conn->query("SELECT COUNT(*) as total FROM pengajuan_surat WHERE status = 'Selesai'");
          return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
     }
}
