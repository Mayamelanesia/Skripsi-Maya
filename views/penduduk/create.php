<div class="row">
     <div class="col-md-8 offset-md-2">
          <div class="card card-primary">
               <div class="card-header">
                    <h3 class="card-title">Tambah Data Penduduk</h3>
               </div>
               <form action="index.php?route=penduduk_store" method="POST">
                    <div class="card-body">
                         <div class="form-group">
                              <label>NIK</label>
                              <input type="text" name="nik" class="form-control" placeholder="Masukkan 16 digit NIK" required maxlength="16">
                         </div>
                         <div class="form-group">
                              <label>Nama Lengkap</label>
                              <input type="text" name="nama" class="form-control" placeholder="Nama sesuai KTP" required>
                         </div>
                         <div class="row">
                              <div class="col-md-6 form-group">
                                   <label>Tempat Lahir</label>
                                   <input type="text" name="tempat_lahir" class="form-control" required>
                              </div>
                              <div class="col-md-6 form-group">
                                   <label>Tanggal Lahir</label>
                                   <input type="date" name="tanggal_lahir" class="form-control" required>
                              </div>
                         </div>
                         <div class="form-group">
                              <label>Jenis Kelamin</label>
                              <select name="jenis_kelamin" class="form-control" required>
                                   <option value="">-- Pilih --</option>
                                   <option value="Laki-laki">Laki-laki</option>
                                   <option value="Perempuan">Perempuan</option>
                              </select>
                         </div>
                         <div class="form-group">
                              <label>Nomor HP</label>
                              <input type="text" name="nomor_hp" class="form-control" placeholder="Contoh: 08123456789" required>
                         </div>
                         <div class="form-group">
                              <label>Alamat Lengkap</label>
                              <textarea name="alamat" class="form-control" rows="3" required></textarea>
                         </div>
                         <div class="form-group">
                              <label>Status Penduduk</label>
                              <select name="status_penduduk" class="form-control" required>
                                   <option value="Aktif">Aktif</option>
                                   <option value="Pindah">Pindah</option>
                                   <option value="Meninggal">Meninggal</option>
                              </select>
                         </div>
                    </div>
                    <div class="card-footer text-right">
                         <a href="index.php?route=penduduk" class="btn btn-default">Batal</a>
                         <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
               </form>
          </div>
     </div>
</div>