<aside class="main-sidebar sidebar-dark-primary elevation-4">
     <a href="index.php" class="brand-link text-center">
          <span class="brand-text font-weight-light d-block">
               SIPESAT
          </span>
          <span class="brand-text font-weight-light d-block">
               Kelurahan Anotaurei
          </span>
     </a>

     <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="info">
                    <a href="#" class="d-block">
                         <i class="fas fa-user-circle mr-2"></i>
                         <?php echo isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'Pengguna'; ?>
                    </a>
               </div>
          </div>

          <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                         <a href="index.php?route=dashboard" class="nav-link">
                              <i class="nav-icon fas fa-tachometer-alt"></i>
                              <p>Dashboard</p>
                         </a>
                    </li>

                    <?php if (isset($_SESSION['role_id'])): ?>

                         <?php if ($_SESSION['role_id'] == 1): ?>
                              <li class="nav-header">MENU ADMIN</li>
                              <li class="nav-item">
                                   <a href="index.php?route=penduduk" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>Kelola Data Penduduk</p>
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a href="index.php?route=pengajuan" class="nav-link">
                                        <i class="nav-icon fas fa-envelope"></i>
                                        <p>Kelola Pengajuan</p>
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a href="index.php?route=arsip" class="nav-link">
                                        <i class="nav-icon fas fa-folder-open"></i>
                                        <p>Kelola Arsip</p>
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a href="index.php?route=laporan" class="nav-link">
                                        <i class="nav-icon fas fa-chart-pie"></i>
                                        <p>Cetak Laporan</p>
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a href="index.php?route=user" class="nav-link">
                                        <i class="nav-icon fas fa-user-cog"></i>
                                        <p>Kelola User</p>
                                   </a>
                              </li>
                         <?php endif; ?>

                         <?php if ($_SESSION['role_id'] == 2): ?>
                              <li class="nav-header">MENU PETUGAS</li>
                              <li class="nav-item">
                                   <a href="index.php?route=verifikasi" class="nav-link">
                                        <i class="nav-icon fas fa-check-double"></i>
                                        <p>Verifikasi Pengajuan</p>
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a href="index.php?route=arsip" class="nav-link">
                                        <i class="nav-icon fas fa-folder"></i>
                                        <p>Kelola Arsip</p>
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a href="index.php?route=penduduk" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>Lihat Data Penduduk</p>
                                   </a>
                              </li>
                         <?php endif; ?>

                         <?php if ($_SESSION['role_id'] == 3): ?>
                              <li class="nav-header">LAYANAN SURAT</li>
                              <li class="nav-item">
                                   <a href="index.php?route=ajukan_surat" class="nav-link">
                                        <i class="nav-icon fas fa-paper-plane"></i>
                                        <p>Ajukan Surat Baru</p>
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a href="index.php?route=riwayat_pengajuan" class="nav-link">
                                        <i class="nav-icon fas fa-history"></i>
                                        <p>Riwayat Pengajuan</p>
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a href="index.php?route=profil" class="nav-link">
                                        <i class="nav-icon fas fa-user-edit"></i>
                                        <p>Edit Profil</p>
                                   </a>
                              </li>
                         <?php endif; ?>

                    <?php endif; ?>

               </ul>
          </nav>
     </div>
</aside>

<div class="content-wrapper">
     <section class="content pt-4">
          <div class="container-fluid"></div>