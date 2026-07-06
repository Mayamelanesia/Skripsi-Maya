<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Daftar Pengajuan Surat</h3>
                    <?php if ($_SESSION['role_id'] == 3): // Jika login sebagai masyarakat, muncul tombol tambah 
                    ?>
                         <a href="index.php?route=ajukan_surat" class="btn btn-primary btn-sm ml-auto">
                              <i class="fas fa-paper-plane"></i> Ajukan Surat Baru
                         </a>
                    <?php endif; ?>
               </div>
               <div class="card-body">
                    <table id="tablePengajuan" class="table table-bordered table-striped">
                         <thead>
                              <tr>
                                   <th>No</th>
                                   <th>No. Pengajuan</th>
                                   <th>Nama Pemohon</th>
                                   <th>Jenis Surat</th>
                                   <th>Tanggal</th>
                                   <th>Status</th>
                                   <th>Aksi</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              $no = 1;
                              foreach ($data_pengajuan as $row):
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
                                        <td><?php echo htmlspecialchars($row['nama_pemohon']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nama_surat']); ?></td>
                                        <td><?php echo date('d-m-Y H:i', strtotime($row['tanggal'])); ?></td>
                                        <td>
                                             <span class="badge <?php echo $badge_color; ?>">
                                                  <?php echo htmlspecialchars($row['status']); ?>
                                             </span>
                                        </td>
                                        <td>
                                             <a href="index.php?route=pengajuan_edit&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm" title="Verifikasi">
                                                  <i class="fas fa-edit"></i>
                                             </a>

                                             <?php if ($row['status'] == 'Selesai'): ?>
                                                  <a href="index.php?route=pengajuan_cetak&id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-success btn-sm" title="Cetak Surat">
                                                       <i class="fas fa-print"></i>
                                                  </a>
                                             <?php endif; ?>

                                             <?php if ($_SESSION['role_id'] == 1): ?>
                                                  <a href="index.php?route=pengajuan_delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengajuan ini?')" title="Hapus">
                                                       <i class="fas fa-trash"></i>
                                                  </a>
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
          $('#tablePengajuan').DataTable({
               "responsive": true,
               "autoWidth": false,
               "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)"
               }
          });
     });
</script>