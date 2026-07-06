<?php
// setup_admin.php
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

// Data akun Admin dummy
$nama = "Administrator";
$email = "admin@kelurahan.com";
$password_plain = "admin123";
$password_hash = password_hash($password_plain, PASSWORD_DEFAULT);
$role_id = 1; // Sesuai dengan urutan insert di tabel roles (1 = Admin)

try {
     // Cek apakah email sudah ada agar tidak duplikat
     $check = $db->prepare("SELECT id FROM users WHERE email = ?");
     $check->execute([$email]);

     if ($check->rowCount() > 0) {
          echo "<h3>Akun admin sudah ada di database!</h3>";
     } else {
          // Insert data ke tabel users
          $query = "INSERT INTO users (nama, email, password, role_id) VALUES (?, ?, ?, ?)";
          $stmt = $db->prepare($query);

          if ($stmt->execute([$nama, $email, $password_hash, $role_id])) {
               echo "<h3>Akun Admin berhasil dibuat! 🎉</h3>";
               echo "<b>Email:</b> " . $email . "<br>";
               echo "<b>Password:</b> " . $password_plain . "<br><br>";
               echo "<a href='index.php?route=login'>Klik di sini untuk menuju halaman Login</a>";
          }
     }
} catch (PDOException $e) {
     echo "Terjadi kesalahan: " . $e->getMessage();
}
