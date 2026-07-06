<div class="row">
     <div class="col-12">
          <div class="card card-success">
               <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-folder-open"></i> Arsip Surat Kelurahan</h3>
               </div>
               <div class="card-body">
                    <table id="tableArsip" class="table table-bordered table-striped">
                         <thead>
                              <tr>
                                   <th>No</th>
                                   <th>No. Surat / Pengajuan</th>
                                   <th>Nama Pemohon</th>
                                   <th>Jenis Surat</th>
                                   <th>Tanggal Selesai</th>
                                   <th>Aksi</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              $no = 1;
                              foreach ($data_arsip as $row):
                              ?>
                                   <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($row['nomor_pengajuan']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nama_pemohon']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nama_surat']); ?></td>
                                        <td><?php echo date('d-m-Y H:i', strtotime($row['tanggal'])); ?></td>
                                        <td>
                                             <a href="index.php?route=pengajuan_cetak&id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-success btn-sm" title="Cetak/Download PDF">
                                                  <i class="fas fa-file-pdf"></i> Download PDF
                                             </a>
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
          $('#tableArsip').DataTable({
               "responsive": true,
               "autoWidth": false,
               "language": {
                    "search": "Cari Arsip:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Arsip tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data arsip tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)"
               }
          });
     });
</script>