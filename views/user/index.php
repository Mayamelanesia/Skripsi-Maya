<div class="row">
     <div class="col-12">
          <div class="card card-primary">
               <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i> Kelola Data User</h3>
               </div>
               <div class="card-body">
                    <table id="tableUser" class="table table-bordered table-striped">
                         <thead>
                              <tr>
                                   <th>No</th>
                                   <th>Nama Lengkap</th>
                                   <th>Email</th>
                                   <th>Hak Akses (Role)</th>
                                   <th>Aksi</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              $no = 1;
                              foreach ($users as $row):
                                   $badge_color = 'badge-secondary';
                                   if ($row['role_id'] == 1) $badge_color = 'badge-danger'; // Admin
                                   if ($row['role_id'] == 2) $badge_color = 'badge-primary'; // Petugas
                                   if ($row['role_id'] == 3) $badge_color = 'badge-success'; // Masyarakat
                              ?>
                                   <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td>
                                             <span class="badge <?php echo $badge_color; ?>">
                                                  <?php echo htmlspecialchars($row['nama_role']); ?>
                                             </span>
                                        </td>
                                        <td>
                                             <?php if ($_SESSION['user_id'] != $row['id']): ?>
                                                  <a href="index.php?route=user_delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini? Semua data terkait mungkin akan terpengaruh.')" title="Hapus User">
                                                       <i class="fas fa-trash"></i> Hapus
                                                  </a>
                                             <?php else: ?>
                                                  <button class="btn btn-secondary btn-sm" disabled><i class="fas fa-user"></i> Anda</button>
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
          $('#tableUser').DataTable({
               "responsive": true,
               "autoWidth": false,
               "language": {
                    "search": "Cari User:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "zeroRecords": "Data user tidak ditemukan",
                    "info": "Menampilkan _PAGE_ dari _PAGES_ halaman"
               }
          });
     });
</script>