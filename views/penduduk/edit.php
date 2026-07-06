<div class="row">
     <div class="col-md-8 offset-md-2">
          <div class="card card-warning">
               <div class="card-header">
                    <h3 class="card-title">Edit Data Penduduk</h3>
               </div>
               <form action="index.php?route=penduduk_update" method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">

                    <div class="card-body">
                         <div class="form-group">
                              <label>NIK</label>
                              <input type="text" name="nik" class="form-control" value="<?php echo htmlspecialchars($data['nik']); ?>" required maxlength="16">
                         </div>
                         <div class="form-group">
                              <label>Nama Lengkap</label>
                              <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
                         </div>
                         <div class="row">
                              <div class="col-md-6 form-group">
                                   <label>Tempat Lahir</label>
                                   <input type="text" name="tempat_lahir" class="form-control" value="<?php echo htmlspecialchars($data['tempat_lahir']); ?>" required>
                              </div>
                              <div class="col-md-6 form-group">
                                   <label>Tanggal Lahir</label>
                                   <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo htmlspecialchars($data['tanggal_lahir']); ?>" required>
                              </div>
                         </div>
                         <div class="form-group">
                              <label>Jenis Kelamin</label>
                              <select name="jenis_kelamin" class="form-control" required>
                                   <option value="Laki-laki" <?php if ($data['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                   <option value="Perempuan" <?php if ($data['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                              </select>
                         </div>
                         <div class="form-group">
                              <label>Nomor HP</label>
                              <input type="text" name="nomor_hp" class="form-control" value="<?php echo htmlspecialchars($data['nomor_hp']); ?>" required>
                         </div>
                         <div class="form-group">
                              <label>Alamat Lengkap</label>
                              <textarea name="alamat" class="form-control" rows="3" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
                         </div>
                         <div class="form-group">
                              <label>Status Penduduk</label>
                              <select name="status_penduduk" class="form-control" required>
                                   <option value="Aktif" <?php if ($data['status_penduduk'] == 'Aktif') echo 'selected'; ?>>Aktif</option>
                                   <option value="Pindah" <?php if ($data['status_penduduk'] == 'Pindah') echo 'selected'; ?>>Pindah</option>
                                   <option value="Meninggal" <?php if ($data['status_penduduk'] == 'Meninggal') echo 'selected'; ?>>Meninggal</option>
                              </select>
                         </div>
                    </div>
                    <div class="card-footer text-right">
                         <a href="index.php?route=penduduk" class="btn btn-default">Batal</a>
                         <button type="submit" class="btn btn-warning">Update Data</button>
                    </div>
               </form>
          </div>
     </div>
</div>