<div class="row">
     <div class="col-12">
          <div class="card card-info">
               <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-history"></i> Riwayat Pengajuan Surat Saya</h3>
               </div>
               <div class="card-body">
                    <table id="tableRiwayat" class="table table-bordered table-striped">
                         <thead>
                              <tr>
                                   <th>No</th>
                                   <th>No. Pengajuan</th>
                                   <th>Jenis Surat</th>
                                   <th>Tanggal Pengajuan</th>
                                   <th>Status</th>
                                   <th>Catatan Petugas</th>
                                   <th>Aksi</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              $no = 1;
                              foreach ($riwayat_pengajuan as $row):
                                   // Menentukan warna badge berdasarkan status
                                   $badge_color = 'badge-secondary';
                                   if ($row['status'] == 'Pending') $badge_color = 'badge-warning';
                                   if ($row['status'] == 'Diverifikasi') $badge_color = 'badge-info';
                                   if ($row['status'] == 'Diproses') $badge_color = 'badge-primary';
                                   if ($row['status'] == 'Selesai') $badge_color = 'badge-success';
                                   if ($row['status'] == 'Ditolak') $badge_color = 'badge-danger';
                              ?>
                                   <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($row['nomor_pengajuan']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nama_surat']); ?></td>
                                        <td><?php echo date('d-m-Y H:i', strtotime($row['tanggal'])); ?></td>
                                        <td>
                                             <span class="badge <?php echo $badge_color; ?>">
                                                  <?php echo htmlspecialchars($row['status']); ?>
                                             </span>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['catatan'] ?? '-'); ?></td>
                                        <td>
                                             <?php if ($row['status'] == 'Selesai'): ?>
                                                  <a href="index.php?route=pengajuan_cetak&id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-success btn-sm" title="Download PDF">
                                                       <i class="fas fa-download"></i> Download
                                                  </a>
                                             <?php else: ?>
                                                  <button class="btn btn-secondary btn-sm" disabled title="Surat belum selesai">
                                                       <i class="fas fa-hourglass-half"></i> Menunggu
                                                  </button>
                                             <?php endif; ?>
                                        </td>
                                   </tr>
                              <?php endforeach; ?>
                         </tbody>
                    </table>
               </div>
          </div>
     </div>
</div>

<script>
     document.addEventListener("DOMContentLoaded", function() {
          $('#tableRiwayat').DataTable({
               "responsive": true,
               "autoWidth": false,
               "language": {
                    "search": "Cari Surat:",
                    "lengthMenu": "Tampilkan _MENU_ baris",
                    "zeroRecords": "Anda belum memiliki riwayat pengajuan surat.",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(difilter dari _MAX_ total data)"
               }
          });
     });
</script>