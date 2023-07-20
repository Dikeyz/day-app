<?php 
session_start();
$username=$_SESSION['username'];
?>

<?php 

    @session_start();

    // include "koneksi.php";
    include './auth/koneksi.php'; 

    if (@$_SESSION['username']) {     
 ?>

<?php
include('./pages/header.php'); #File Header
?>

<?php
include('./pages/sidebar.php'); #File Sidebar
?>

    <main class="content">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-3">
        <div class="d-block mb-4 mb-md-0">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
              <li class="breadcrumb-item">
                <a href="#">
                  <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                    ></path>
                  </svg>
                </a>
              </li>
              <li class="breadcrumb-item"><a href="#">Day Dream App</a></li>
              <li class="breadcrumb-item active" aria-current="page">Buku Besar</li>
            </ol>
          </nav>
          <h2 class="h4">Buku Besar</h2>
          <p>Berisi buku besar yang bersumber dari transaksi.</p><br>
        </div>
            <?php
              $sql = mysqli_query($koneksi, "SELECT * FROM user2 where user_id =  {$_SESSION['user_id']}");
              while ($data10=mysqli_fetch_array($sql)) {
            ?>
          <table>
            <tr>
              <td>Nama Usaha</td>
              <td></td>
              <td>:</td>
              <td><?php echo $data10['umkm'];?></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td></td>
              <td>:</td>
              <td><?php echo $data10['nama'];?></td>
            </tr>            
             <tr>
              <td>Mata Uang</td>
              <td></td>
              <td>:</td>
              <td>Rp (Rupiah)</td>
            </tr>           
          </table>
          <?php
          }
          ?>        
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">KAS DI BANK</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '105-KAS DI BANK' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                $jumlah_saldo1 = $jumlah_saldo1 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo1, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
              $jumlah_saldo1 = $jumlah_saldo1 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo1, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">KAS DI TANGAN</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '101-KAS DI TANGAN' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo2 = $jumlah_saldo2 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo2, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo2 = $jumlah_saldo2 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo2, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">PERSEDIAAN</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '126-PERSEDIAAN' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo3 = $jumlah_saldo3 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo3, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo3 = $jumlah_saldo3 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo3, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">BEBAN SEWA</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '729-BEBAN SEWA' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                $jumlah_saldo = $jumlah_saldo + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
              $jumlah_saldo = $jumlah_saldo - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">MODAL</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '311-MODAL' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                $jumlah_saldo22 = $jumlah_saldo22 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo22, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
              $jumlah_saldo22 = $jumlah_saldo22 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo22, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div> 

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">PENDAPATAN DITERIMA DI MUKA</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '209-PENDAPATAN DITERIMA DI MUKA' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">SEWA BAYAR DIMUKA</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '129-SEWA BAYAR DI MUKA' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo4 = $jumlah_saldo1 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo1 = $jumlah_saldo1 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">ASURANSI BAYAR DIMUKA</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '130-ASURANSI BAYAR DIMUKA' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                if ($data['jenis'] == "Debit" ) {
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">PERLENGKAPAN/PERALATAN</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '153-PERLENGKAPAN/ PERALATAN' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo6 = $jumlah_saldo6 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo6, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo6 = $jumlah_saldo6 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo6, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">PENYUSUTAN PERALATAN</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '154-PENYUSUTAN PERALATAN' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo7 = $jumlah_saldo7 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo7, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo7 = $jumlah_saldo7 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo7, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">HUTANG WESEL</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '200-HUTANG WESEL' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo8 = $jumlah_saldo8 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo8, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo8 = $jumlah_saldo8 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo8, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">HUTANG</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '201-HUTANG' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo9 = $jumlah_saldo9 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo9, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo9 = $jumlah_saldo9 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo9, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">PENDAPATAN JASA</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '400-PENDAPATAN JASA' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo10 = $jumlah_saldo10 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo10, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo10 = $jumlah_saldo10 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo10, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">PENJUALAN</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '401-PENJUALAN' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo10 = $jumlah_saldo10 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo10, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo10 = $jumlah_saldo10 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo10, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">HUTANG GAJI</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '212-HUTANG GAJI' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo11 = $jumlah_saldo11 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo11, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo11 = $jumlah_saldo11 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo11, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">HUTANG GAJI</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '212-HUTANG GAJI' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo11 = $jumlah_saldo11 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo11, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo11 = $jumlah_saldo11 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo11, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">DIVIDEN</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '332-DIVIDEN' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo23 = $jumlah_saldo23 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo23, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo23 = $jumlah_saldo23 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo23, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">BEBAN IKLAN</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '610-BEBAN IKLAN' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                if ($data['jenis'] == "Debit" ) {
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">BEBAN PENYUSUTAN PERALATAN</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '621-BEBAN PENYUSUTAN PERALATAN' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                if ($data['jenis'] == "Debit" ) {
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">BEBAN PERSEDIAAN</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '631-BEBAN PERSEDIAAN' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo15 = $jumlah_saldo15 - $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo15, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo15 = $jumlah_saldo15 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo15, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">BEBAN GAJI</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '726-BEBAN GAJI' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo16 = $jumlah_saldo16 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo16, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo16 = $jumlah_saldo16 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo16, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">BEBAN ASURANSI</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '730-BEBAN ASURANSI' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo17 = $jumlah_saldo17 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo17, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo17 = $jumlah_saldo17 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo17, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">BIAYA UTILITAS</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '731-BIAYA UTILITAS' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo18 = $jumlah_saldo18 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo18 = $jumlah_saldo18 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">BEBAN BIAYA PERAWATAN DAN PERBAIKAN</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '735-BEBAN BIAYA PERAWATAN DAN PERBAIKAN' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo19 = $jumlah_saldo19 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo19, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo19 = $jumlah_saldo19 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo19, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)">BEBAN BENSIN</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '740-BIAYA BENSIN' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo20 = $jumlah_saldo20 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo20, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo20 = $jumlah_saldo20 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo20, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>

      <div class="card card-body border-0 shadow table-wrapper table-responsive mb-4">
        <h5 style="color: rgb(42, 76, 177)"> BEBAN BUNGA</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">Keterangan</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Saldo</th>
              <th class="border-gray-200">D/K</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '741-BEBAN BUNGA' WHERE transaksi.umkm ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo21 = $jumlah_saldo21 + $jumlah;
             ?>          
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo21, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
                $jumlah_saldo21 = $jumlah_saldo21 - $jumlah;
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] :"";?></td>
              <td><?php echo $data['keterangan'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo "Rp. " . number_format($jumlah_saldo21, 0, ".", "."); ?></td>
              <td><?php echo $data['jenis'];?></td>          
            </tr> 
            <?php
              }
            ?>

            <?php
            $tmp_date = $data['tgl_transaksi'];
              }
            ?>        
          </tbody>
        </table>
      </div>            

        </div>
      </div>

    <?php
    include('./pages/footer.php');
    ?>
    </main>
    <?php
    include('./pages/script.php');
    ?>

<?php 
}else{
  ?>
          <script language="JavaScript">
          alert('Silahkan Login Terlebih Dahulu');
          document.location='auth/logindaydream';
          </script>
  <?php
}
?>