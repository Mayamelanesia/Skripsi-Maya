<?php
// controllers/UserController.php
require_once 'config/database.php';
require_once 'models/User.php';

class UserController
{
     public function index()
     {
          // Keamanan: Hanya Admin (role_id = 1) yang boleh akses
          if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
               echo "<script>alert('Akses Ditolak! Anda bukan Admin.'); window.location.href='index.php?route=dashboard';</script>";
               exit;
          }

          $database = new Database();
          $db = $database->getConnection();
          $userModel = new User($db);

          $stmt = $userModel->readAll();
          $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/user/index.php';
          include_once 'views/layouts/footer.php';
     }

     public function delete()
     {
          if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
               header("Location: index.php?route=login");
               exit;
          }

          $id = $_GET['id'];
          $database = new Database();
          $db = $database->getConnection();
          $userModel = new User($db);

          if ($userModel->delete($id)) {
               echo "<script>alert('Data user berhasil dihapus!'); window.location.href='index.php?route=user';</script>";
          } else {
               echo "<script>alert('Gagal menghapus data user!'); window.location.href='index.php?route=user';</script>";
          }
     }
}
