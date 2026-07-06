<?php
// controllers/AuthController.php
require_once 'config/database.php';
require_once 'models/User.php';

class AuthController
{
     public function login()
     {
          if (isset($_SESSION['user_id'])) {
               header("Location: index.php?route=dashboard");
               exit;
          }

          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $database = new Database();
               $db = $database->getConnection();
               $user = new User($db);

               $email = trim($_POST['email']);
               $password = $_POST['password'];

               $data = $user->login($email);

               if ($data && password_verify($password, $data['password'])) {
                    $_SESSION['user_id'] = $data['id'];
                    $_SESSION['nama']    = $data['nama'];
                    $_SESSION['role_id'] = $data['role_id'];
                    $_SESSION['penduduk_id'] = $data['penduduk_id']; // Tambahan baru

                    header("Location: index.php?route=dashboard");
                    exit;
               } else {
                    $error = "Email atau password salah!";
               }
          }
          require_once 'views/auth/login.php';
     }

     public function logout()
     {
          // Memulai session jika belum dimulai
          if (session_status() == PHP_SESSION_NONE) {
               session_start();
          }

          // Menghapus semua data session
          session_destroy();

          // Mengarahkan kembali ke halaman Welcome Page (Home)
          header('Location: index.php?route=home');
          exit;
     }

     // Menampilkan form register
     public function register()
     {
          // Jika user sudah login, langsung arahkan ke dashboard
          if (isset($_SESSION['user_id'])) {
               header("Location: index.php?route=dashboard");
               exit;
          }
          // Tampilkan halaman register
          require_once 'views/auth/register.php';
     }

     // Memproses data register masyarakat
     public function store_register()
     {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $database = new Database();
               $db = $database->getConnection();

               // Data Akun
               $email = trim($_POST['email']);
               $password = $_POST['password'];
               $konfirmasi_password = $_POST['konfirmasi_password'];
               $role_id = 3;

               // Data KTP
               $nik = $_POST['nik'];
               $nama = trim($_POST['nama']);
               $tempat_lahir = $_POST['tempat_lahir'];
               $tanggal_lahir = $_POST['tanggal_lahir'];
               $jenis_kelamin = $_POST['jenis_kelamin'];
               $nomor_hp = $_POST['nomor_hp'];
               $alamat = $_POST['alamat'];

               if ($password !== $konfirmasi_password) {
                    $error = "Password dan Konfirmasi Password tidak cocok!";
                    require_once 'views/auth/register.php';
                    return;
               }

               // Cek apakah email atau NIK sudah terdaftar
               $check = $db->prepare("SELECT id FROM users WHERE email = ?");
               $check->execute([$email]);
               if ($check->rowCount() > 0) {
                    $error = "Email sudah terdaftar!";
                    require_once 'views/auth/register.php';
                    return;
               }

               $checkNik = $db->prepare("SELECT id FROM penduduk WHERE nik = ?");
               $checkNik->execute([$nik]);
               if ($checkNik->rowCount() > 0) {
                    $error = "NIK sudah terdaftar di sistem!";
                    require_once 'views/auth/register.php';
                    return;
               }

               try {
                    $db->beginTransaction();

                    // 1. Insert ke tabel penduduk
                    $queryPenduduk = "INSERT INTO penduduk (nik, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, nomor_hp, status_penduduk) VALUES (?, ?, ?, ?, ?, ?, ?, 'Aktif')";
                    $stmtPenduduk = $db->prepare($queryPenduduk);
                    $stmtPenduduk->execute([$nik, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $alamat, $nomor_hp]);

                    // Ambil ID penduduk yang baru saja dibuat
                    $penduduk_id = $db->lastInsertId();

                    // 2. Insert ke tabel users
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    $queryUser = "INSERT INTO users (nama, email, password, role_id, penduduk_id) VALUES (?, ?, ?, ?, ?)";
                    $stmtUser = $db->prepare($queryUser);
                    $stmtUser->execute([$nama, $email, $password_hash, $role_id, $penduduk_id]);

                    $db->commit();

                    echo "<script>alert('Registrasi akun berhasil! Silakan login.'); window.location.href='index.php?route=login';</script>";
                    exit;
               } catch (Exception $e) {
                    $db->rollBack();
                    $error = "Terjadi kesalahan sistem: " . $e->getMessage();
                    require_once 'views/auth/register.php';
               }
          }
     }
}