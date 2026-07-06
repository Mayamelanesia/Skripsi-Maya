<section class="content pt-4">
     <div class="container-fluid">
          <div class="alert alert-info">
               <h5><i class="fas fa-info-circle"></i> Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama']); ?>!</h5>
               <p>Anda dapat memantau status pengajuan surat Anda melalui tabel di bawah ini.</p>
          </div>

          <div class="card">
               <div class="card-header">
                    <h3 class="card-title">Riwayat Pengajuan Saya</h3>
               </div>
               <div class="card-body">
                    <table class="table table-bordered">
                         <thead>
                              <tr>
                                   <th>No. Pengajuan</th>
                                   <th>Tanggal</th>
                                   <th>Status</th>
                                   <th>Catatan</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php if (empty($riwayat_pribadi)): ?>
                                   <tr>
                                        <td colspan="4" class="text-center">Belum ada pengajuan.</td>
                                   </tr>
                                   <?php else: foreach ($riwayat_pribadi as $row): ?>
                                        <tr>
                                             <td><?php echo htmlspecialchars($row['nomor_pengajuan']); ?></td>
                                             <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                             <td>
                                                  <span class="badge <?php echo ($row['status'] == 'Selesai') ? 'badge-success' : 'badge-warning'; ?>">
                                                       <?php echo $row['status']; ?>
                                                  </span>
                                             </td>
                                             <td><?php echo htmlspecialchars($row['catatan'] ?? '-'); ?></td>
                                        </tr>
                              <?php endforeach;
                              endif; ?>
                         </tbody>
                    </table>
               </div>
          </div>
     </div>
</section>