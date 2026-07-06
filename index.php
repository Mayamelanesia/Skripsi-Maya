<?php
session_start();

// Panggil Controller
require_once 'controllers/AuthController.php';
require_once 'controllers/PendudukController.php';
require_once 'controllers/PengajuanController.php';
require_once 'controllers/ArsipController.php';
require_once 'controllers/LaporanController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ProfilController.php';
require_once 'controllers/HomeController.php';

// Cek parameter route di URL, jika kosong arahkan ke dashboard
$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Logic Routing
switch ($route) {
     // ==========================================
     // ROUTE AUTHENTICATION (LOGIN, LOGOUT, REGISTER)
     // ==========================================

     case 'home':
          $controller = new HomeController();
          $controller->index();
          break;

     case 'profil_kelurahan':
          $controller = new HomeController();
          $controller->profil();
          break;

     case 'panduan_layanan':
          $controller = new HomeController();
          $controller->panduan();
          break;
          
     case 'hubungi_kami':
          $controller = new HomeController();
          $controller->kontak();
          break;

     case 'login':
          $auth = new AuthController();
          $auth->login();
          break;

     case 'logout':
          $auth = new AuthController();
          $auth->logout();
          break;

     case 'register':
          $auth = new AuthController();
          $auth->register();
          break;

     case 'store_register':
          $auth = new AuthController();
          $auth->store_register();
          break;

     // ==========================================
     // ROUTE DASHBOARD
     // ==========================================
     case 'dashboard':
          $dashboard = new DashboardController();
          $dashboard->index();
          break;

          // Halaman yang butuh layout utama di-include di sini
          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/dashboard/index.php';
          include_once 'views/layouts/footer.php';
          break;

     // ==========================================
     // ROUTE PENDUDUK
     // ==========================================
     case 'penduduk':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $penduduk = new PendudukController();
          $penduduk->index();
          break;

     case 'penduduk_create':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $penduduk = new PendudukController();
          $penduduk->create();
          break;

     case 'penduduk_store':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $penduduk = new PendudukController();
          $penduduk->store();
          break;

     case 'penduduk_edit':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $penduduk = new PendudukController();
          $penduduk->edit();
          break;

     case 'penduduk_update':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $penduduk = new PendudukController();
          $penduduk->update();
          break;

     case 'penduduk_delete':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $penduduk = new PendudukController();
          $penduduk->delete();
          break;

     // ==========================================
     // ROUTE PENGAJUAN SURAT
     // ==========================================
     case 'pengajuan':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $pengajuan = new PengajuanController();
          $pengajuan->index();
          break;

     case 'pengajuan_cetak':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $pengajuan = new PengajuanController();
          $pengajuan->cetak();
          break;

     case 'pengajuan_create':
     case 'ajukan_surat': // Bisa dipanggil oleh menu masyarakat juga
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $pengajuan = new PengajuanController();
          $pengajuan->create();
          break;

     case 'pengajuan_store':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $pengajuan = new PengajuanController();
          $pengajuan->store();
          break;

     case 'pengajuan_edit':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $pengajuan = new PengajuanController();
          $pengajuan->edit();
          break;

     case 'pengajuan_update':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $pengajuan = new PengajuanController();
          $pengajuan->update();
          break;

     case 'pengajuan_delete':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $pengajuan = new PengajuanController();
          $pengajuan->delete();
          break;

     case 'riwayat_pengajuan':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $pengajuan = new PengajuanController();
          $pengajuan->riwayat();
          break;

     // ==========================================
     // ROUTE ARSIP
     // ==========================================
     case 'arsip':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $arsip = new ArsipController();
          $arsip->index();
          break;

     // ==========================================
     // ROUTE LAPORAN
     // ==========================================
     case 'laporan':
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }
          $laporan = new LaporanController();
          $laporan->index();
          break;

     // ==========================================
     // ROUTE KELOLA USER (ADMIN)
     // ==========================================
     case 'user':
          $user = new UserController();
          $user->index();
          break;

     case 'user_delete':
          $user = new UserController();
          $user->delete();
          break;

     // ==========================================
     // ROUTE PROFIL
     // ==========================================
     case 'profil':
          $profil = new ProfilController();
          $profil->index();
          break;

     case 'profil_update':
          $profil = new ProfilController();
          $profil->update();
          break;

     // ==========================================
     // DEFAULT (404 NOT FOUND)
     // ==========================================
     default:
          echo "<h3>Halaman tidak ditemukan (404)</h3>";
          break;
}