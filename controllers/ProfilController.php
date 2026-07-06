<?php
// controllers/ProfilController.php
require_once 'config/database.php';

class ProfilController
{
     public function index()
     {
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }

          $database = new Database();
          $db = $database->getConnection();
          $user_id = $_SESSION['user_id'];

          // Ambil data user (Jika masyarakat, gabungkan dengan data penduduk)
          if ($_SESSION['role_id'] == 3) {
               $query = "SELECT u.email, p.* FROM users u JOIN penduduk p ON u.penduduk_id = p.id WHERE u.id = ?";
          } else {
               $query = "SELECT email, nama FROM users WHERE id = ?";
          }

          $stmt = $db->prepare($query);
          $stmt->execute([$user_id]);
          $profil = $stmt->fetch(PDO::FETCH_ASSOC);

          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/profil/index.php';
          include_once 'views/layouts/footer.php';
     }

     public function update()
     {
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }

          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $database = new Database();
               $db = $database->getConnection();
               $user_id = $_SESSION['user_id'];

               $email = trim($_POST['email']);
               $password = $_POST['password'];

               try {
                    $db->beginTransaction();

                    // 1. Update data akun login (Tabel users)
                    if (!empty($password)) {
                         // Jika password diisi, update beserta password
                         $password_hash = password_hash($password, PASSWORD_DEFAULT);
                         $queryUser = "UPDATE users SET email = ?, password = ? WHERE id = ?";
                         $stmtUser = $db->prepare($queryUser);
                         $stmtUser->execute([$email, $password_hash, $user_id]);
                    } else {
                         // Jika password dikosongkan, update email saja
                         $queryUser = "UPDATE users SET email = ? WHERE id = ?";
                         $stmtUser = $db->prepare($queryUser);
                         $stmtUser->execute([$email, $user_id]);
                    }

                    // 2. Update data KTP jika yang login adalah Masyarakat (Tabel penduduk)
                    if ($_SESSION['role_id'] == 3 && isset($_POST['nomor_hp'])) {
                         $nomor_hp = $_POST['nomor_hp'];
                         $alamat = $_POST['alamat'];
                         $penduduk_id = $_SESSION['penduduk_id'];

                         $queryPenduduk = "UPDATE penduduk SET nomor_hp = ?, alamat = ? WHERE id = ?";
                         $stmtPenduduk = $db->prepare($queryPenduduk);
                         $stmtPenduduk->execute([$nomor_hp, $alamat, $penduduk_id]);
                    }

                    $db->commit();
                    echo "<script>alert('Profil berhasil diperbarui!'); window.location.href='index.php?route=profil';</script>";
               } catch (Exception $e) {
                    $db->rollBack();
                    echo "<script>alert('Gagal memperbarui profil: " . $e->getMessage() . "'); window.history.back();</script>";
               }
          }
     }
}
