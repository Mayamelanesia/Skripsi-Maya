<?php
// controllers/DashboardController.php
require_once 'config/database.php';
require_once 'models/Dashboard.php';

class DashboardController
{
     // controllers/DashboardController.php
     public function index()
     {
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }

          $database = new Database();
          $db = $database->getConnection();

          // Tampilkan Dashboard sesuai role
          if ($_SESSION['role_id'] == 3) {
               // Logika untuk Masyarakat: Hanya ambil data pribadi
               $stmt = $db->prepare("SELECT * FROM pengajuan_surat WHERE penduduk_id = ? ORDER BY tanggal DESC");
               $stmt->execute([$_SESSION['penduduk_id']]);
               $riwayat_pribadi = $stmt->fetchAll(PDO::FETCH_ASSOC);

               include_once 'views/layouts/header.php';
               include_once 'views/layouts/sidebar.php';
               include_once 'views/dashboard/masyarakat.php'; // View baru
               include_once 'views/layouts/footer.php';
          } else {
               // Logika untuk Admin/Petugas (yang sudah kita buat tadi)
               $dashboard = new Dashboard($db);
               $total_penduduk = $dashboard->getTotalPenduduk();
               $total_pengajuan = $dashboard->getTotalPengajuan();
               $pengajuan_pending = $dashboard->getPengajuanPending();
               $pengajuan_selesai = $dashboard->getPengajuanSelesai();

               include_once 'views/layouts/header.php';
               include_once 'views/layouts/sidebar.php';
               include_once 'views/dashboard/index.php';
               include_once 'views/layouts/footer.php';
          }
     }
}
