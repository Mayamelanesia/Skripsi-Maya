<?php
// controllers/PendudukController.php
require_once 'config/database.php';
require_once 'models/Penduduk.php';

class PendudukController
{
     public function index()
     {
          // Keamanan: Hanya Admin (1) dan Petugas (2) yang bisa akses
          if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] == 3) {
               echo "<script>alert('Anda tidak memiliki akses ke halaman ini!'); window.location.href='index.php?route=dashboard';</script>";
               exit;
          }

          // Koneksi ke database dan inisialisasi model
          $database = new Database();
          $db = $database->getConnection();
          $penduduk = new Penduduk($db);

          // Ambil data
          $stmt = $penduduk->readAll();
          $data_penduduk = $stmt->fetchAll(PDO::FETCH_ASSOC);

          // Tampilkan halaman
          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/penduduk/index.php';
          include_once 'views/layouts/footer.php';
     }

     // Menampilkan form tambah data
     public function create()
     {
          // Hanya Admin (1) yang boleh menambah data
          if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
               echo "<script>alert('Akses Ditolak!'); window.location.href='index.php?route=penduduk';</script>";
               exit;
          }

          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/penduduk/create.php';
          include_once 'views/layouts/footer.php';
     }

     // Memproses data dari form
     public function store()
     {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $database = new Database();
               $db = $database->getConnection();
               $penduduk = new Penduduk($db);

               // Ambil data dari form
               $nik = $_POST['nik'];
               $nama = $_POST['nama'];
               $tempat_lahir = $_POST['tempat_lahir'];
               $tanggal_lahir = $_POST['tanggal_lahir'];
               $jenis_kelamin = $_POST['jenis_kelamin'];
               $alamat = $_POST['alamat'];
               $nomor_hp = $_POST['nomor_hp'];
               $status_penduduk = $_POST['status_penduduk'];

               // Simpan ke database
               if ($penduduk->create($nik, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $alamat, $nomor_hp, $status_penduduk)) {
                    // Jika sukses, kembali ke halaman daftar penduduk
                    echo "<script>alert('Data penduduk berhasil ditambahkan!'); window.location.href='index.php?route=penduduk';</script>";
               } else {
                    echo "<script>alert('Gagal menambahkan data!'); window.history.back();</script>";
               }
          }
     }

     // Menampilkan form edit data
     public function edit()
     {
          if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
               echo "<script>alert('Akses Ditolak!'); window.location.href='index.php?route=penduduk';</script>";
               exit;
          }

          $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');

          $database = new Database();
          $db = $database->getConnection();
          $penduduk = new Penduduk($db);
          $data = $penduduk->readById($id);

          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/penduduk/edit.php';
          include_once 'views/layouts/footer.php';
     }

     // Memproses update data
     public function update()
     {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $database = new Database();
               $db = $database->getConnection();
               $penduduk = new Penduduk($db);

               $id = $_POST['id'];
               $nik = $_POST['nik'];
               $nama = $_POST['nama'];
               $tempat_lahir = $_POST['tempat_lahir'];
               $tanggal_lahir = $_POST['tanggal_lahir'];
               $jenis_kelamin = $_POST['jenis_kelamin'];
               $alamat = $_POST['alamat'];
               $nomor_hp = $_POST['nomor_hp'];
               $status_penduduk = $_POST['status_penduduk'];

               if ($penduduk->update($id, $nik, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $alamat, $nomor_hp, $status_penduduk)) {
                    echo "<script>alert('Data penduduk berhasil diperbarui!'); window.location.href='index.php?route=penduduk';</script>";
               } else {
                    echo "<script>alert('Gagal memperbarui data!'); window.history.back();</script>";
               }
          }
     }

     // Memproses hapus data
     public function delete()
     {
          if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
               echo "<script>alert('Akses Ditolak!'); window.location.href='index.php?route=penduduk';</script>";
               exit;
          }

          $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');

          $database = new Database();
          $db = $database->getConnection();
          $penduduk = new Penduduk($db);

          if ($penduduk->delete($id)) {
               echo "<script>alert('Data penduduk berhasil dihapus!'); window.location.href='index.php?route=penduduk';</script>";
          } else {
               echo "<script>alert('Gagal menghapus data!'); window.location.href='index.php?route=penduduk';</script>";
          }
     }
}
