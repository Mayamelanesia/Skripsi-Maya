<!DOCTYPE html>
<html lang="id">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Sistem Pelayanan Surat | Log in</title>

     <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
     <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
     <div class="login-box">
          <div class="login-logo">
               <a href="#"><b>Kelurahan</b> Anotaurei</a>
          </div>
          <div class="card">
               <div class="card-body login-card-body">
                    <p class="login-box-msg">Silakan login untuk masuk ke sistem</p>

                    <?php if (isset($error)): ?>
                         <div class="alert alert-danger text-center">
                              <?php echo $error; ?>
                         </div>
                    <?php endif; ?>

                    <form action="index.php?route=login" method="post">
                         <div class="input-group mb-3">
                              <input type="email" name="email" class="form-control" placeholder="Email" required>
                              <div class="input-group-append">
                                   <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                   </div>
                              </div>
                         </div>
                         <div class="input-group mb-3">
                              <input type="password" name="password" class="form-control" placeholder="Password" required>
                              <div class="input-group-append">
                                   <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-12">
                                   <button type="submit" class="btn btn-primary btn-block">Log In</button>
                              </div>
                         </div>
                    </form>

                    <p class="mb-0 mt-3 text-center">
                         <a href="index.php?route=register" class="text-center">Belum punya akun? Daftar Akun Masyarakat</a>
                    </p>
               </div>
          </div>
     </div>

     <script src="assets/plugins/jquery/jquery.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="assets/js/adminlte.min.js"></script>
</body>

</html>