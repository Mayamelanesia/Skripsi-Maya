<?php
// controllers/PengajuanController.php
require_once 'config/database.php';
require_once 'models/Pengajuan.php';

class PengajuanController
{

     public function index()
     {
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }

          $database = new Database();
          $db = $database->getConnection();
          $pengajuan = new Pengajuan($db);

          $stmt = $pengajuan->readAll();
          $data_pengajuan = $stmt->fetchAll(PDO::FETCH_ASSOC);

          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/pengajuan/index.php';
          include_once 'views/layouts/footer.php';
     }

     public function create()
     {
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }

          $database = new Database();
          $db = $database->getConnection();
          $pengajuan = new Pengajuan($db);

          $penduduk = $pengajuan->getPenduduk();
          $jenis_surat = $pengajuan->getJenisSurat();

          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/pengajuan/create.php';
          include_once 'views/layouts/footer.php';
     }

     public function store()
     {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $database = new Database();
               $db = $database->getConnection();
               $pengajuan = new Pengajuan($db);

               $nomor_pengajuan = "REQ-" . time();
               $penduduk_id = $_POST['penduduk_id'];
               $jenis_surat_id = $_POST['jenis_surat_id'];
               $keperluan = $_POST['keperluan'];

               // Simpan data pengajuan utama
               $pengajuan_id = $pengajuan->create($nomor_pengajuan, $penduduk_id, $jenis_surat_id, $keperluan);

               if ($pengajuan_id) {
                    // Proses Upload File Persyaratan jika ada
                    if (isset($_FILES['persyaratan']) && $_FILES['persyaratan']['error'] == 0) {
                         $target_dir = "uploads/";
                         // Pastikan folder ada
                         if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

                         $file_name = time() . "_" . basename($_FILES["persyaratan"]["name"]);
                         $target_file = $target_dir . $file_name;

                         if (move_uploaded_file($_FILES["persyaratan"]["tmp_name"], $target_file)) {
                              $pengajuan->insertLampiran($pengajuan_id, $file_name);
                         }
                    }
                    echo "<script>alert('Pengajuan berhasil ditambahkan!'); window.location.href='index.php?route=pengajuan';</script>";
               } else {
                    echo "<script>alert('Gagal mengajukan surat!'); window.history.back();</script>";
               }
          }
     }

     public function edit()
     {
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }

          $id = $_GET['id'];
          $database = new Database();
          $db = $database->getConnection();
          $pengajuan = new Pengajuan($db);

          $data = $pengajuan->readById($id);

          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/pengajuan/edit.php';
          include_once 'views/layouts/footer.php';
     }

     public function update()
     {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $database = new Database();
               $db = $database->getConnection();
               $pengajuan = new Pengajuan($db);

               $id = $_POST['id'];
               $status = $_POST['status'];
               $catatan = $_POST['catatan'];

               if ($pengajuan->update($id, $status, $catatan)) {
                    echo "<script>alert('Status pengajuan berhasil diperbarui!'); window.location.href='index.php?route=pengajuan';</script>";
               } else {
                    echo "<script>alert('Gagal memperbarui status!'); window.history.back();</script>";
               }
          }
     }

     public function delete()
     {
          if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] == 3) {
               echo "<script>alert('Akses Ditolak!'); window.location.href='index.php?route=pengajuan';</script>";
               exit;
          }

          $id = $_GET['id'];
          $database = new Database();
          $db = $database->getConnection();
          $pengajuan = new Pengajuan($db);

          if ($pengajuan->delete($id)) {
               echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php?route=pengajuan';</script>";
          }
     }

     // Memproses cetak surat ke PDF (Hanya untuk surat yang berstatus Selesai)
     public function cetak()
     {
          if (!isset($_SESSION['user_id'])) {
               header("Location: index.php?route=login");
               exit;
          }

          $id = $_GET['id'];
          $database = new Database();
          $db = $database->getConnection();
          $pengajuan = new Pengajuan($db);

          $data = $pengajuan->readById($id);

          // Validasi: Pastikan surat hanya bisa dicetak jika statusnya sudah Selesai
          if ($data['status'] != 'Selesai') {
               echo "<script>alert('Surat belum selesai diproses, tidak dapat dicetak!'); window.history.back();</script>";
               exit;
          }

          // Panggil library DomPDF dari folder vendor
          require_once 'vendor/autoload.php';

          // Render HTML ke PDF
          $dompdf = new \Dompdf\Dompdf();

          // Membaca isi file cetak.php lalu memasukkannya ke PDF
          ob_start();
          include 'views/pengajuan/cetak.php';
          $html = ob_get_clean();

          $dompdf->loadHtml($html);
          $dompdf->setPaper('A4', 'portrait'); // Atur ukuran kertas
          $dompdf->render();

          // Menampilkan file PDF di browser (Attachment => false) 
          // Ubah true jika ingin langsung terdownload otomatis
          $dompdf->stream("Surat_" . $data['nama_surat'] . "_" . $data['nama_pemohon'] . ".pdf", array("Attachment" => false));
     }

     // Menampilkan riwayat pengajuan khusus untuk Masyarakat
     public function riwayat()
     {
          if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 3) {
               header("Location: index.php?route=login");
               exit;
          }

          $database = new Database();
          $db = $database->getConnection();

          // Ambil data pengajuan HANYA milik penduduk yang sedang login
          $query = "SELECT ps.*, js.nama_surat 
                  FROM pengajuan_surat ps
                  JOIN jenis_surat js ON ps.jenis_surat_id = js.id
                  WHERE ps.penduduk_id = ? 
                  ORDER BY ps.tanggal DESC";
          $stmt = $db->prepare($query);
          $stmt->execute([$_SESSION['penduduk_id']]);
          $riwayat_pengajuan = $stmt->fetchAll(PDO::FETCH_ASSOC);

          include_once 'views/layouts/header.php';
          include_once 'views/layouts/sidebar.php';
          include_once 'views/pengajuan/riwayat.php';
          include_once 'views/layouts/footer.php';
     }
}
