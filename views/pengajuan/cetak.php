<!DOCTYPE html>
<html lang="id">

<head>
     <meta charset="utf-8">
     <title>Cetak Surat</title>
     <style>
          body {
               font-family: 'Times New Roman', Times, serif;
               font-size: 12pt;
               line-height: 1.5;
               padding: 20px;
          }

          .kop-surat {
               width: 100%;
               border-bottom: 3px solid black;
               padding-bottom: 10px;
               margin-bottom: 30px;
          }

          .kop-surat h2,
          .kop-surat h3,
          .kop-surat p {
               margin: 0;
               padding: 0;
               text-align: center;
          }

          .isi-surat {
               text-align: justify;
               margin-bottom: 40px;
          }

          .tabel-identitas {
               margin-left: 30px;
               width: 100%;
               margin-bottom: 15px;
          }

          .tabel-identitas td {
               vertical-align: top;
          }

          .tanda-tangan {
               float: right;
               width: 250px;
               text-align: center;
          }

          .clear {
               clear: both;
          }
     </style>
</head>

<body>

     <?php
     // TRIK ANTI GAGAL DOMPDF: Convert gambar ke Base64
     $path_logo = 'assets/img/Logo.png';
     $type_logo = pathinfo($path_logo, PATHINFO_EXTENSION);
     $data_logo = file_get_contents($path_logo);
     $base64_logo = 'data:image/' . $type_logo . ';base64,' . base64_encode($data_logo);
     ?>

     <table class="kop-surat">
          <tr>
               <td width="15%" style="text-align: center; vertical-align: middle;">
                    <img src="<?php echo $base64_logo; ?>" width="90" alt="Logo Kabupaten">
               </td>
               <td width="85%">
                    <h3>PEMERINTAH KABUPATEN KEPULAUAN YAPEN</h3>
                    <h3>DISTRIK ANOTAUREI</h3>
                    <h3>KELURAHAN ANOTAUREI</h3>
                    <p>Jl. Moh. Toha, Serui, Kode Pos : 98214</p>
               </td>
          </tr>
     </table>

     <div class="isi-surat">
          <div style="text-align: center; margin-bottom: 20px;">
               <span style="font-weight: bold; text-decoration: underline; text-transform: uppercase;">
                    <?php echo htmlspecialchars($data['nama_surat']); ?>
               </span><br>
               <span>Nomor : 474 / <?php echo htmlspecialchars($data['nomor_pengajuan']); ?> / KA - IV / <?php echo date('Y'); ?></span>
          </div>

          <p>Yang bertanda tangan dibawah ini Kepala Kelurahan Anotaurei, Distrik Anotaurei Kabupaten Kepulauan Yapen, dengan ini menerangkan bahwa :</p>

          <table class="tabel-identitas">
               <tr>
                    <td width="180">Nama</td>
                    <td width="10">:</td>
                    <td><?php echo htmlspecialchars($data['nama_pemohon']); ?></td>
               </tr>
               <tr>
                    <td>Tempat / Tanggal Lahir</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($data['tempat_lahir'] ?? '-') . ', ' . htmlspecialchars($data['tanggal_lahir'] ?? '-'); ?></td>
               </tr>
               <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($data['jenis_kelamin'] ?? '-'); ?></td>
               </tr>
               <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($data['alamat'] ?? '-'); ?></td>
               </tr>
               <tr>
                    <td>No. KTP / NIK</td>
                    <td>:</td>
                    <td><?php echo htmlspecialchars($data['nik']); ?></td>
               </tr>
          </table>

          <?php
          $jenis = strtolower(trim($data['nama_surat']));
          ?>

          <?php if (strpos($jenis, 'domisili') !== false): ?>
               <p>Bahwa benar-benar yang bersangkutan adalah penduduk Kelurahan Anotaurei dan berdomisili di Kelurahan Anotaurei.</p>
               <p>Demikian Surat Keterangan ini dibuat dengan sebenar-benarnya, dan dapat dipergunakan sebagaimana mestinya.</p>

          <?php elseif (strpos($jenis, 'usaha') !== false): ?>
               <p>Menerangkan bahwa nama tersebut di atas adalah benar-benar masyarakat Kelurahan Anotaurei dan memiliki usaha di bidang / keperluan: <strong><?php echo htmlspecialchars($data['keperluan']); ?></strong>, dan usaha tersebut telah dilakukan sampai sekarang.</p>
               <p>Demikian surat keterangan ini kami buat dengan sesungguhnya untuk digunakan sebagaimana mestinya.</p>

          <?php elseif (strpos($jenis, 'skck') !== false): ?>
               <p>Orang tersebut diatas benar-benar warga kelurahan kami dan menurut sepengatahuan kami benar-benar berkelakuan baik tidak pernah tersangkut perkara tindak kriminal atau perkara pidana, dan tidak pernah ikut perkumpulan atau organisasi yang dilarang pemerintah.</p>
               <p>Surat pengantar ini diberikan untuk keperluan pengurusan SKCK: <strong><?php echo htmlspecialchars($data['keperluan']); ?></strong>.</p>
               <p>Demikian surat pengantar ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

          <?php elseif (strpos($jenis, 'pindah') !== false): ?>
               <p>Adalah benar Penduduk Kelurahan Anotaurei karena atas permintaan sendiri kepadanya diberikan Surat Keterangan Pindah dengan tujuan / alasan: <strong><?php echo htmlspecialchars($data['keperluan']); ?></strong>.</p>
               <p>Demikian Surat Keterangan Pindah ini dibuat dan diberikan kepada yang bersangkutan untuk dipergunakan seperlunya.</p>

          <?php elseif (strpos($jenis, 'tidak mampu') !== false): ?>
               <p>Sesuai pengamatan kami keluarga tersebut tidak dapat menanggulangi kehidupan sehari-hari karena ekonomi lemah.</p>
               <p>Atas dasar tersebut maka kami menilai bahwa yang bersangkutan tidak mampu untuk membiayai ongkos yang diperlukan dalam rangka: <strong><?php echo htmlspecialchars($data['keperluan']); ?></strong>, oleh karena itu yang bersangkutan berhak mengusulkan bantuan / beasiswa sesuai dengan ketentuan yang berlaku.</p>
               <p>Demikian Surat Keterangan ini dibuat dan diberikan kepada yang bersangkutan untuk digunakan dimana perlunya.</p>

          <?php else: ?>
               <p>Orang tersebut di atas adalah benar-benar warga Kelurahan Anotaurei dan surat ini diterbitkan berdasarkan permohonan yang bersangkutan untuk keperluan: <strong><?php echo htmlspecialchars($data['keperluan']); ?></strong>.</p>
               <p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
          <?php endif; ?>
     </div>

     <div class="tanda-tangan">
          <p>Anotaurei, <?php echo date('d F Y'); ?></p>
          <p>Kepala Kelurahan Anotaurei</p>
          <br><br><br>
          <p style="font-weight: bold; text-decoration: underline;">Azer Glen Aninam</p>
          <p>NIP. 198612292011041002</p>
     </div>

     <div class="clear"></div>
</body>

</html>