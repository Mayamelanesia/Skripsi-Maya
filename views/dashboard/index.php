<div class="content-header">
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Pelayanan</h1>
               </div>
          </div>
     </div>
</div>

<section class="content">
     <div class="container-fluid">
          <div class="row">

               <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                         <div class="inner">
                              <h3><?php echo $total_penduduk; ?></h3>
                              <p>Total Penduduk</p>
                         </div>
                         <div class="icon">
                              <i class="fas fa-users"></i>
                         </div>
                         <a href="index.php?route=penduduk" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
               </div>

               <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                         <div class="inner">
                              <h3><?php echo $total_pengajuan; ?></h3>
                              <p>Total Pengajuan Surat</p>
                         </div>
                         <div class="icon">
                              <i class="fas fa-envelope"></i>
                         </div>
                         <a href="index.php?route=pengajuan" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
               </div>

               <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                         <div class="inner">
                              <h3><?php echo $pengajuan_pending; ?></h3>
                              <p>Menunggu Verifikasi</p>
                         </div>
                         <div class="icon">
                              <i class="fas fa-clock"></i>
                         </div>
                         <a href="index.php?route=pengajuan" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
               </div>

               <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                         <div class="inner">
                              <h3><?php echo $pengajuan_selesai; ?></h3>
                              <p>Surat Selesai / Arsip</p>
                         </div>
                         <div class="icon">
                              <i class="fas fa-check-circle"></i>
                         </div>
                         <a href="index.php?route=arsip" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
               </div>

          </div>

          <div class="row mt-4">
               <div class="col-12">
                    <div class="alert alert-light text-center">
                         <h5>Selamat Datang di Sistem Informasi Pelayanan Surat Menyurat (SIPESAT)</h5>
                         <p>Anda login sebagai <b><?php echo htmlspecialchars($_SESSION['nama']); ?></b></p>
                    </div>
               </div>
          </div>

     </div>
</section>