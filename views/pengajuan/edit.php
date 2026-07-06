<div class="row">
     <div class="col-md-8 offset-md-2">
          <div class="card card-warning">
               <div class="card-header">
                    <h3 class="card-title">Verifikasi & Edit Status Pengajuan</h3>
               </div>
               <form action="index.php?route=pengajuan_update" method="POST">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                    <div class="card-body">
                         <div class="form-group">
                              <label>Nama Pemohon</label>
                              <input type="text" class="form-control" value="<?php echo htmlspecialchars($data['nama_pemohon'] ?? ''); ?>" readonly>
                         </div>
                         <div class="form-group">
                              <label>Jenis Surat</label>
                              <input type="text" class="form-control" value="<?php echo htmlspecialchars($data['nama_surat'] ?? ''); ?>" readonly>
                         </div>
                         <div class="form-group">
                              <label>Keperluan</label>
                              <textarea class="form-control" rows="2" readonly><?php echo htmlspecialchars($data['keperluan'] ?? ''); ?></textarea>
                         </div>

                         <hr>

                         <div class="form-group">
                              <label>Ubah Status</label>
                              <select name="status" class="form-control" required>
                                   <option value="Pending" <?php if ($data['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                   <option value="Diverifikasi" <?php if ($data['status'] == 'Diverifikasi') echo 'selected'; ?>>Diverifikasi</option>
                                   <option value="Diproses" <?php if ($data['status'] == 'Diproses') echo 'selected'; ?>>Diproses</option>
                                   <option value="Selesai" <?php if ($data['status'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                                   <option value="Ditolak" <?php if ($data['status'] == 'Ditolak') echo 'selected'; ?>>Ditolak</option>
                              </select>
                         </div>
                         <div class="form-group">
                              <label>Catatan Revisi / Penolakan (Opsional)</label>
                              <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan jika ada yang kurang/salah..."><?php echo htmlspecialchars($data['catatan'] ?? ''); ?></textarea>
                         </div>
                    </div>
                    <div class="card-footer text-right">
                         <a href="index.php?route=pengajuan" class="btn btn-default">Kembali</a>
                         <button type="submit" class="btn btn-warning">Update Status</button>
                    </div>
               </form>
          </div>
     </div>
</div>