<div class="row">
     <div class="col-md-6">
          <div class="card card-primary">
               <div class="card-header">
                    <h3 class="card-title">Rekap Pengajuan Surat</h3>
               </div>
               <div class="card-body">
                    <table class="table table-bordered">
                         <thead>
                              <tr>
                                   <th>Status</th>
                                   <th>Total Pengajuan</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php foreach ($rekap_status as $row): ?>
                                   <tr>
                                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                                        <td><?php echo htmlspecialchars($row['total']); ?></td>
                                   </tr>
                              <?php endforeach; ?>
                         </tbody>
                    </table>
               </div>
          </div>
     </div>

     <div class="col-md-6">
          <div class="card card-info">
               <div class="card-header">
                    <h3 class="card-title">Grafik Status Pengajuan</h3>
               </div>
               <div class="card-body">
                    <canvas id="rekapChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
               </div>
          </div>
     </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
     document.addEventListener("DOMContentLoaded", function() {
          const ctx = document.getElementById('rekapChart').getContext('2d');

          // Siapkan data dari PHP ke JavaScript
          const labels = [<?php foreach ($rekap_status as $row) {
                                   echo "'" . $row['status'] . "',";
                              } ?>];
          const data = [<?php foreach ($rekap_status as $row) {
                              echo $row['total'] . ",";
                         } ?>];

          new Chart(ctx, {
               type: 'bar',
               data: {
                    labels: labels,
                    datasets: [{
                         label: 'Jumlah Pengajuan',
                         data: data,
                         backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)'
                         ],
                         borderColor: [
                              'rgba(255, 99, 132, 1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)'
                         ],
                         borderWidth: 1
                    }]
               },
               options: {
                    scales: {
                         y: {
                              beginAtZero: true
                         }
                    }
               }
          });
     });
</script>