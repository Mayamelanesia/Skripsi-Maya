<?php
// controllers/LaporanController.php
require_once 'config/database.php';
require_once 'models/Laporan.php';

class LaporanController
{
     public function index()
     {
          // Cek apakah user sudah login dan pastikan hanya Admin yang bisa akses
          if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
               echo "<script>alert('Anda tidak memiliki akses ke halaman ini!'); window.location.href='index.php?route=dashboard';</script>";
               exit;
          }

          $database = new Database();
          $db = $database->getConnection();
          $laporan = new Laporan($db);

          $rekap_status = $laporan->getRekapStatus();

          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/laporan/index.php'; // View Laporan
          include_once 'views/layouts/footer.php';
     }
}
