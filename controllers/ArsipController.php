<?php
// controllers/ArsipController.php
require_once 'config/database.php';
require_once 'models/Arsip.php';

class ArsipController
{
     public function index()
     {
          // Cek apakah user sudah login
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }

          $database = new Database();
          $db = $database->getConnection();
          $arsip = new Arsip($db);

          // Ambil data arsip surat
          $stmt = $arsip->readAll();
          $data_arsip = $stmt->fetchAll(PDO::FETCH_ASSOC);

          // Tampilkan halaman
          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/arsip/index.php'; // Kita buat view-nya di bawah
          include_once 'views/layouts/footer.php';
     }
}
