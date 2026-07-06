<div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Data Penduduk</h3>
                    <?php if ($_SESSION['role_id'] == 1): // Hanya Admin yang bisa tambah data 
                    ?>
                         <a href="index.php?route=penduduk_create" class="btn btn-primary btn-sm ml-auto">
                              <i class="fas fa-plus"></i> Tambah Penduduk
                         </a>
                    <?php endif; ?>
               </div>
               <div class="card-body">
                    <table id="tablePenduduk" class="table table-bordered table-striped">
                         <thead>
                              <tr>
                                   <th>No</th>
                                   <th>NIK</th>
                                   <th>Nama</th>
                                   <th>Jenis Kelamin</th>
                                   <th>Nomor HP</th>
                                   <th>Status</th>
                                   <?php if ($_SESSION['role_id'] == 1): ?>
                                        <th>Aksi</th>
                                   <?php endif; ?>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              $no = 1;
                              foreach ($data_penduduk as $row):
                              ?>
                                   <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($row['nik']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nomor_hp']); ?></td>
                                        <td>
                                             <span class="badge <?php echo ($row['status_penduduk'] == 'Aktif') ? 'badge-success' : 'badge-danger'; ?>">
                                                  <?php echo htmlspecialchars($row['status_penduduk']); ?>
                                             </span>
                                        </td>
                                        <?php if ($_SESSION['role_id'] == 1): ?>
                                             <td>
                                                  <a href="index.php?route=penduduk_edit&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                                                       <i class="fas fa-edit"></i>
                                                  </a>
                                                  <a href="index.php?route=penduduk_delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                       <i class="fas fa-trash"></i>
                                                  </a>
                                             </td>
                                        <?php endif; ?>
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
          $('#tablePenduduk').DataTable({
               "responsive": true,
               "autoWidth": false,
               "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                         "first": "Awal",
                         "last": "Akhir",
                         "next": "Selanjutnya",
                         "previous": "Sebelumnya"
                    }
               }
          });
     });
</script>