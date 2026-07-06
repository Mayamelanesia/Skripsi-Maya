<div class="row">
     <div class="col-md-8 offset-md-2">
          <div class="card card-primary">
               <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-edit"></i> Edit Profil Saya</h3>
               </div>
               <form action="index.php?route=profil_update" method="POST">
                    <div class="card-body">

                         <?php if ($_SESSION['role_id'] == 3): ?>
                              <h5 class="text-muted mb-3">Data Pribadi (Sesuai KTP)</h5>
                              <div class="form-group row">
                                   <label class="col-sm-3 col-form-label">NIK</label>
                                   <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($profil['nik']); ?>" readonly>
                                        <small class="text-danger">*NIK tidak dapat diubah. Hubungi petugas jika ada kesalahan.</small>
                                   </div>
                              </div>
                              <div class="form-group row">
                                   <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                   <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($profil['nama']); ?>" readonly>
                                   </div>
                              </div>
                              <div class="form-group row">
                                   <label class="col-sm-3 col-form-label">Nomor HP/WA</label>
                                   <div class="col-sm-9">
                                        <input type="text" name="nomor_hp" class="form-control" value="<?php echo htmlspecialchars($profil['nomor_hp']); ?>" required>
                                   </div>
                              </div>
                              <div class="form-group row">
                                   <label class="col-sm-3 col-form-label">Alamat Lengkap</label>
                                   <div class="col-sm-9">
                                        <textarea name="alamat" class="form-control" rows="2" required><?php echo htmlspecialchars($profil['alamat']); ?></textarea>
                                   </div>
                              </div>
                              <hr>
                         <?php endif; ?>

                         <h5 class="text-muted mb-3">Data Akun Login</h5>
                         <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Email</label>
                              <div class="col-sm-9">
                                   <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($profil['email']); ?>" required>
                              </div>
                         </div>
                         <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Password Baru</label>
                              <div class="col-sm-9">
                                   <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password" minlength="6">
                              </div>
                         </div>

                    </div>
                    <div class="card-footer text-right">
                         <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
               </form>
          </div>
     </div>
</div>