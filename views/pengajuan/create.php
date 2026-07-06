<div class="row mt-4">
     <div class="col-md-8 offset-md-2">

          <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3): ?>
               <div class="alert alert-info alert-dismissible">
                    <h5><i class="icon fas fa-info"></i> Informasi Otomatis!</h5>
                    Data identitas Anda (Nama, NIK, Tempat/Tanggal Lahir, Alamat, dll) <strong>sudah otomatis terhubung</strong> dengan sistem. Anda tidak perlu mengetiknya ulang. Silakan pilih jenis surat dan isi detail tambahannya saja.
               </div>
          <?php endif; ?>

          <div class="card card-primary">
               <div class="card-header">
                    <h3 class="card-title">Formulir Pengajuan Surat</h3>
               </div>

               <form action="index.php?route=pengajuan_store" method="POST" enctype="multipart/form-data">
                    <div class="card-body">

                         <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3): ?>
                              <div class="form-group">
                                   <label>Pemohon (Otomatis dari Akun)</label>
                                   <input type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['nama'] ?? ''); ?>" readonly>
                                   <input type="hidden" name="penduduk_id" value="<?php echo htmlspecialchars($_SESSION['penduduk_id'] ?? ''); ?>">
                              </div>
                         <?php else: ?>
                              <div class="form-group">
                                   <label>Pilih Pemohon (Penduduk) <span class="text-danger">*</span></label>
                                   <select name="penduduk_id" class="form-control" required>
                                        <option value="">-- Pilih Penduduk --</option>
                                        <?php foreach ($penduduk as $p): ?>
                                             <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['nama']); ?> - NIK: <?php echo htmlspecialchars($p['nik']); ?></option>
                                        <?php endforeach; ?>
                                   </select>
                              </div>
                         <?php endif; ?>

                         <div class="form-group">
                              <label>Pilih Jenis Surat <span class="text-danger">*</span></label>
                              <select name="jenis_surat_id" id="jenis_surat_id" class="form-control" required>
                                   <option value="">-- Pilih Surat --</option>
                                   <?php foreach ($jenis_surat as $js): ?>
                                        <option value="<?php echo $js['id']; ?>"><?php echo htmlspecialchars($js['nama_surat']); ?></option>
                                   <?php endforeach; ?>
                              </select>
                         </div>

                         <div class="form-group" id="form-keperluan-container" style="display: none;">
                              <label id="label-keperluan">Detail Keperluan <span class="text-danger">*</span></label>
                              <textarea name="keperluan" id="input-keperluan" class="form-control" rows="3"></textarea>
                              <small class="text-muted" id="help-keperluan"></small>
                         </div>

                         <div class="form-group">
                              <label>Upload Persyaratan (KTP / KK / Surat Pengantar RT) <span class="text-danger">*</span></label>
                              <input type="file" name="file_lampiran" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" required>
                              <small class="text-muted">Format: JPG/PNG/PDF. Maksimal 2MB.</small>
                         </div>

                    </div>

                    <div class="card-footer text-right">
                         <a href="index.php?route=pengajuan" class="btn btn-default mr-2">Batal</a>
                         <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"></i> Ajukan Sekarang</button>
                    </div>
               </form>
          </div>
     </div>
</div>

<script>
     document.addEventListener('DOMContentLoaded', function() {
          const dropdownSurat = document.getElementById('jenis_surat_id');
          const containerKeperluan = document.getElementById('form-keperluan-container');
          const labelKeperluan = document.getElementById('label-keperluan');
          const inputKeperluan = document.getElementById('input-keperluan');
          const helpKeperluan = document.getElementById('help-keperluan');

          dropdownSurat.addEventListener('change', function() {
               let selectedText = this.options[this.selectedIndex].text.toLowerCase();

               if (this.value !== "") {
                    containerKeperluan.style.display = 'block';
                    inputKeperluan.required = true;
               } else {
                    containerKeperluan.style.display = 'none';
                    inputKeperluan.required = false;
               }

               if (selectedText.includes('usaha')) {
                    labelKeperluan.innerHTML = 'Nama / Bidang Usaha <span class="text-danger">*</span>';
                    inputKeperluan.placeholder = 'Contoh: Jualan Sembako / Bengkel Motor / Ternak Ayam';
                    helpKeperluan.innerText = 'Sebutkan jenis atau bidang usaha yang sedang Anda jalankan saat ini.';
               } else if (selectedText.includes('skck')) {
                    labelKeperluan.innerHTML = 'Tujuan Pembuatan SKCK <span class="text-danger">*</span>';
                    inputKeperluan.placeholder = 'Contoh: Melamar Pekerjaan di PT. XYZ / Syarat Pendaftaran CPNS';
                    helpKeperluan.innerText = 'Sebutkan secara spesifik untuk apa Anda membuat surat pengantar SKCK ini.';
               } else if (selectedText.includes('pindah')) {
                    labelKeperluan.innerHTML = 'Alamat Tujuan Pindah & Alasan <span class="text-danger">*</span>';
                    inputKeperluan.placeholder = 'Contoh: Pindah ke Jl. Merdeka No. 10, Jakarta karena pekerjaan.';
                    helpKeperluan.innerText = 'Tuliskan alamat lengkap tujuan kepindahan Anda beserta alasannya.';
               } else if (selectedText.includes('tidak mampu')) {
                    labelKeperluan.innerHTML = 'Tujuan Penggunaan Surat <span class="text-danger">*</span>';
                    inputKeperluan.placeholder = 'Contoh: Persyaratan pengajuan Beasiswa Bidik Misi untuk anak an. Budi';
                    helpKeperluan.innerText = 'Sebutkan secara detail tujuan surat ini (misal: syarat beasiswa, bantuan biaya rumah sakit, dll).';
               } else if (selectedText.includes('domisili')) {
                    labelKeperluan.innerHTML = 'Keterangan Tambahan (Opsional)';
                    inputKeperluan.placeholder = 'Contoh: Untuk persyaratan pembuatan rekening bank';
                    inputKeperluan.required = false;
                    helpKeperluan.innerText = 'Boleh dikosongkan jika tidak ada keperluan spesifik.';
               } else {
                    labelKeperluan.innerHTML = 'Detail Keperluan <span class="text-danger">*</span>';
                    inputKeperluan.placeholder = 'Jelaskan keperluan pembuatan surat ini';
                    helpKeperluan.innerText = 'Silakan isi detail keperluan Anda secara jelas.';
               }
          });
     });
</script>