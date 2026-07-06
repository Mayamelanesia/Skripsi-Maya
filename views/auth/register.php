<!DOCTYPE html>
<html lang="id">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Sistem Pelayanan Surat | Daftar Akun</title>
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
     <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
     <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
     <div class="register-box" style="width: 600px;">
          <div class="register-logo">
               <a href="#"><b>Kelurahan</b> Anotaurei</a>
          </div>

          <div class="card">
               <div class="card-body register-card-body">
                    <p class="login-box-msg">Lengkapi Data Diri & Akun Anda</p>

                    <?php if (isset($error)): ?>
                         <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form action="index.php?route=store_register" method="post">
                         <h5 class="text-muted mb-3">1. Data KTP</h5>
                         <div class="row">
                              <div class="col-md-6 form-group">
                                   <input type="text" name="nik" class="form-control" placeholder="NIK (16 Digit)" required maxlength="16">
                              </div>
                              <div class="col-md-6 form-group">
                                   <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-6 form-group">
                                   <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
                              </div>
                              <div class="col-md-6 form-group">
                                   <input type="date" name="tanggal_lahir" class="form-control" required>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-6 form-group">
                                   <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">-- Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                   </select>
                              </div>
                              <div class="col-md-6 form-group">
                                   <input type="text" name="nomor_hp" class="form-control" placeholder="Nomor HP/WA Aktif" required>
                              </div>
                         </div>
                         <div class="form-group mb-4">
                              <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat Lengkap" required></textarea>
                         </div>

                         <h5 class="text-muted mb-3">2. Data Akun Login</h5>
                         <div class="form-group mb-3">
                              <input type="email" name="email" class="form-control" placeholder="Email Aktif" required>
                         </div>
                         <div class="row">
                              <div class="col-md-6 form-group mb-3">
                                   <input type="password" name="password" class="form-control" placeholder="Password" required minlength="6">
                              </div>
                              <div class="col-md-6 form-group mb-3">
                                   <input type="password" name="konfirmasi_password" class="form-control" placeholder="Ulangi Password" required minlength="6">
                              </div>
                         </div>

                         <div class="row mt-4">
                              <div class="col-12">
                                   <button type="submit" class="btn btn-primary btn-block">Daftar Sekarang</button>
                              </div>
                         </div>
                    </form>

                    <p class="mb-0 mt-3 text-center">
                         <a href="index.php?route=login" class="text-center">Sudah punya akun? Log In di sini</a>
                    </p>
               </div>
          </div>
     </div>

     <script src="assets/plugins/jquery/jquery.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="assets/js/adminlte.min.js"></script>
</body>

</html>