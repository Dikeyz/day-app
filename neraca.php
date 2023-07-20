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
          <h2 class="h4">Neraca Saldo</h2>
          <p>Berisi Neraca saldo yang bersumber dari transaksi.</p><br>
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

            <?php
               include "./auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '105-KAS DI BANK' WHERE transaksi.user_id = {$_SESSION['user_id']}";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

              while($data  = mysqli_fetch_array($jurnal_umum)){
                    $jumlah  = $data['saldo'];
                    if ($data['jenis'] == "Debit" ) {
                    $jumlah_saldo1 = $jumlah_saldo1 + $jumlah;
                    
                    }elseif (($data['jenis'] == "Kredit")) {
                      $jumlah_saldo1 = $jumlah_saldo1 - $jumlah;
                    }
                   ?>
              <?php
                }
              ?>      

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '101-KAS DI TANGAN' WHERE transaksi.user_id = {$_SESSION['user_id']}";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

              while($data  = mysqli_fetch_array($jurnal_umum)){
                    $jumlah  = $data['saldo'];
                    if ($data['jenis'] == "Debit" ) {
                    $jumlah_saldo2 = $jumlah_saldo2 + $jumlah;
                    
                    }elseif (($data['jenis'] == "Kredit")) {
                      $jumlah_saldo2 =   $jumlah - $jumlah_saldo2;
                    }
                   ?>
              <?php
                }
              ?>

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '126-PERSEDIAAN' WHERE transaksi.user_id = {$_SESSION['user_id']}";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

              while($data  = mysqli_fetch_array($jurnal_umum)){
                    $jumlah  = $data['saldo'];
                    if ($data['jenis'] == "Debit" ) {
                    $jumlah_saldo3 = $jumlah_saldo3 + $jumlah;
                    
                    }elseif (($data['jenis'] == "Kredit")) {
                      $jumlah_saldo3 = $jumlah_saldo3 - $jumlah ;
                    }
                   ?>
              <?php
                }
              ?>

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '129-SEWA BAYAR DI MUKA' WHERE transaksi.user_id = {$_SESSION['user_id']}";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

              while($data  = mysqli_fetch_array($jurnal_umum)){
                    $jumlah  = $data['saldo'];
                    if ($data['jenis'] == "Debit" ) {
                    $jumlah_saldo4 = $jumlah_saldo4 + $jumlah;
                    
                    }elseif (($data['jenis'] == "Kredit")) {
                      $jumlah_saldo4 = $jumlah_saldo4 - $jumlah;
                    }
                   ?>
              <?php
                }
              ?>            

              <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '130-ASURANSI BAYAR DIMUKA' WHERE transaksi.user_id = {$_SESSION['user_id']}";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

              while($data  = mysqli_fetch_array($jurnal_umum)){
                    $jumlah  = $data['saldo'];
                    if ($data['jenis'] == "Debit" ) {
                    $jumlah_saldo5 = $jumlah_saldo5 + $jumlah;
                    
                    }elseif (($data['jenis'] == "Kredit")) {
                      $jumlah_saldo5 = $jumlah_saldo5 - $jumlah;
                    }
                   ?>
              <?php
                }
              ?>               

              <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '153-PERLENGKAPAN' WHERE transaksi.user_id = {$_SESSION['user_id']}";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

              while($data  = mysqli_fetch_array($jurnal_umum)){
                    $jumlah  = $data['saldo'];
                    if ($data['jenis'] == "Debit" ) {
                    $jumlah_saldo6 = $jumlah_saldo6 + $jumlah;
                    
                    }elseif (($data['jenis'] == "Kredit")) {
                      $jumlah_saldo6 = $jumlah_saldo6 - $jumlah;
                    }
                   ?>
              <?php
                }
              ?>               

              <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '154-PENYUSUTAN PERALATAN' WHERE transaksi.user_id = {$_SESSION['user_id']}";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

              while($data  = mysqli_fetch_array($jurnal_umum)){
                    $jumlah  = $data['saldo'];
                    if ($data['jenis'] == "Debit" ) {
                    $jumlah_saldo7 = $jumlah_saldo7 + $jumlah;
                    
                    }elseif (($data['jenis'] == "Kredit")) {
                      $jumlah_saldo7 = $jumlah_saldo7 - $jumlah;
                    }
                   ?>
              <?php
                }
              ?>               

              <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '200-HUTANG WESEL' WHERE transaksi.user_id = {$_SESSION['user_id']}";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

              while($data  = mysqli_fetch_array($jurnal_umum)){
                    $jumlah  = $data['saldo'];
                    if ($data['jenis'] == "Debit" ) {
                    $jumlah_saldo8 = $jumlah_saldo8 + $jumlah;
                    
                    }elseif (($data['jenis'] == "Kredit")) {
                      $jumlah_saldo8 = $jumlah_saldo8 - $jumlah;
                    }
                   ?>
              <?php
                }
              ?>

              <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '201-HUTANG' WHERE transaksi.user_id = {$_SESSION['user_id']}";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

              while($data  = mysqli_fetch_array($jurnal_umum)){
                    $jumlah  = $data['saldo'];
                    if ($data['jenis'] == "Debit" ) {
                    $jumlah_saldo9 = $jumlah_saldo9 + $jumlah;
                    
                    }elseif (($data['jenis'] == "Kredit")) {
                      $jumlah_saldo9 = $jumlah_saldo9 - $jumlah;
                    }
                   ?>
              <?php
                }
              ?> 
              
              <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '209-PENDAPATAN DITERIMA DI MUKA' WHERE transaksi.user_id = {$_SESSION['user_id']}";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

              while($data  = mysqli_fetch_array($jurnal_umum)){
                    $jumlah  = $data['saldo'];
                    if ($data['jenis'] == "Debit" ) {
                      $jumlah_saldo10 = $jumlah_saldo10 + $jumlah;
                    
                    }elseif (($data['jenis'] == "Kredit")) {
                      $jumlah_saldo10 = $jumlah_saldo10 - $jumlah;
                    }
                   ?>
              <?php
                }
              ?>                  

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '212-HUTANG GAJI' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo11 = $jumlah_saldo11 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo11 = $jumlah_saldo11 - $jumlah;
              }
            ?>

            <?php
              }
            ?> 

            <?php
               include "./auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '741-BEBAN BUNGA' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo12 = $jumlah_saldo12 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo12 = $jumlah_saldo12 - $jumlah;
              }
            ?>

            <?php
              }
            ?>                                                        

            <?php
            $total_asset = $jumlah_saldo1 + $jumlah_saldo2 + $jumlah_saldo3 + $jumlah_saldo4 + $jumlah_saldo5 + $jumlah_saldo6 + 
                           $jumlah_saldo7;

            $total_hutang = $jumlah_saldo8 + $jumlah_saldo9 + $jumlah_saldo10 + $jumlah_saldo11 + $jumlah_saldo12;               
            ?> 
                    <div class="card card-body border-3 shadow table-wrapper table-responsive">
                     <table class="table table-condesed">
                      <thead>
                        <th>Asset</th>
                        <th style="text-align:right;">Jumlah</th>
                        <th></th>
                        <th>Hutang</th>
                        <th style="text-align:right;">Jumlah</th>
                      </thead>
                        <tbody>
                        <tr>
                          <td>Kas Di Bank</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo1),0,',','.'); ?></td>
                          <td></td>
                          <td>Hutang Wesel</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo8),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Kas Di Tangan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo2),0,',','.'); ?></td>
                          <td></td>
                          <td>Hutang</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo9),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Persediaan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo3),0,',','.'); ?></td>
                          <td></td>
                          <td>Pendapatan Diterima Dimuka</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo10),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Sewa Bayar Dimuka</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo4),0,',','.'); ?></td>
                          <td></td>
                          <td>Hutang Gaji</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo11),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Asuransi Bayar Dimuka</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo5),0,',','.'); ?></td>
                          <td></td>
                          <td>Hutang Bunga</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo12),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Perlengkapan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo6),0,',','.'); ?></td>
                          <td></td>
                          <td><b>Total Hutang</b></td>
                          <td align="right"><b>Rp. <?php echo number_format(abs($total_hutang),0,',','.'); ?></b></td>
                        </tr>
                        <tr>
                          <td>Penyusutan Peralatan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo7),0,',','.'); ?></td>
                          <td></td>
                          <td></td>
                          <td align="right"><b></td>
                        </tr>
                         <tr>
                          <td><b>Total Asset</b></td>
                          <td align="right"><b>Rp. <?php echo number_format(abs($total_asset),0,',','.'); ?></b></td>
                          <td></td>
                          <td></td>
                          <td align="right"></b></td>
                        </tr>                        
                        </tbody>  
                    </table>
                  </div><br><br>

              <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query        = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '610-BEBAN IKLAN ' WHERE transaksi.user_id = {$_SESSION['user_id']}";                
               $jurnal_umum  = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

              while($data  = mysqli_fetch_array($jurnal_umum)){
                    $jumlah  = $data['saldo'];
                    if ($data['jenis'] == "Debit" ) {
                      $jumlah_saldo13 = $jumlah_saldo13 + $jumlah;
                    
                    }elseif (($data['jenis'] == "Kredit")) {
                      $jumlah_saldo13 = $jumlah_saldo13 - $jumlah;
                    }
                   ?>
              <?php
                }
              ?>


            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '621-BEBAN PENYUSUTAN PERALATAN' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo14 = $jumlah_saldo14 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo14 = $jumlah_saldo14 - $jumlah;
              }
            ?>

            <?php
              }
            ?>

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '631-BEBAN PERSEDIAAN' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo15 = $jumlah_saldo15 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo15 = $jumlah_saldo15 - $jumlah;
              }
            ?>

            <?php
              }
            ?>

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '726-BEBAN GAJI  ' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo16 = $jumlah_saldo16 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo16 = $jumlah_saldo16 - $jumlah;
              }
            ?>

            <?php
              }
            ?>

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '729-BEBAN SEWA  ' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo = $jumlah_saldo + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo = $jumlah_saldo - $jumlah;
              }
            ?>

            <?php
              }
            ?>               

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '730-BEBAN ASURANSI' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo17 = $jumlah_saldo17 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo17 = $jumlah_saldo17 - $jumlah;
              }
            ?>

            <?php
              }
            ?>

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '731-BIAYA UTILITAS' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo18 = $jumlah_saldo18 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo18 = $jumlah_saldo18 - $jumlah;
              }
            ?>

            <?php
              }
            ?>

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '735-BEBAN BIAYA PERAWATAN DAN PERBAIKAN ' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo19 = $jumlah_saldo19 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo19 = $jumlah_saldo19 - $jumlah;
              }
            ?>

            <?php
              }
            ?> 

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '740-BIAYA BENSIN ' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo20 = $jumlah_saldo20 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo20 = $jumlah_saldo20 - $jumlah;
              }
            ?>

            <?php
              }
            ?>  

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '741-BEBAN BUNGA' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo21 = $jumlah_saldo21 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo21 = $jumlah_saldo21 - $jumlah;
              }
            ?>

            <?php
              }
            ?>

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '311-MODAL' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo22 = $jumlah_saldo22 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo22 = $jumlah_saldo22 - $jumlah;
              }
            ?>

            <?php
              }
            ?>

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '332-DIVIDEN' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo23 = $jumlah_saldo23 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo23 = $jumlah_saldo23 - $jumlah;
              }
            ?>

            <?php
              }
            ?>

            <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '400-PENDAPATAN JASA  ' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo24 = $jumlah_saldo24 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo24 = $jumlah_saldo24 - $jumlah;
              }
            ?>

            <?php
              }
            ?>         

              <?php
               include "../pages/auth/koneksi.php";
               error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff AND akun.nama_akun = '401-PENJUALAN  ' WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

              $tmp_date = "";

               while($data  = mysqli_fetch_array($jurnal_umum)){
                $jumlah  = $data['saldo'];
                if ($data['jenis'] == "Debit" ) {
                  $jumlah_saldo25 = $jumlah_saldo25 + $jumlah;

                }elseif (($data['jenis'] == "Kredit")) {
                  $jumlah_saldo25 = $jumlah_saldo25 - $jumlah;
              }
            ?>

            <?php
              }
            ?>

            <?php
            $total_beban = $jumlah_saldo + $jumlah_saldo13  + $jumlah_saldo14 + $jumlah_saldo15 + $jumlah_saldo16 + 
                           $jumlah_saldo17 + $jumlah_saldo18 + $jumlah_saldo19 + $jumlah_saldo20 + $jumlah_saldo21;

            $total_modal = $jumlah_saldo22 + $jumlah_saldo23; 

            $total_pendapatan = $jumlah_saldo24 + $jumlah_saldo25;        
            ?> 
                    <div class="card card-body border-3 shadow table-wrapper table-responsive">
                     <table class="table table-condesed">
                      <thead>
                        <th>Beban Biaya</th>
                        <th style="text-align:right;">Jumlah</th>
                        <th></th>
                        <th>Modal & Pendapatan</th>
                        <th style="text-align:right;">Jumlah</th>
                      </thead>
                        <tbody>
                        <tr>
                          <td>Beban Iklan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo13),0,',','.'); ?></td>
                          <td></td>
                          <td>Modal</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo22),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Beban Biaya Peralatan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo14),0,',','.'); ?></td>
                          <td></td>
                          <td>Dividen</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo23),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Beban Persediaan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo15),0,',','.'); ?></td>
                          <td></td>
                          <td><b>Total Modal</b></td>
                          <td align="right"><b>Rp. <?php echo number_format(abs($total_modal),0,',','.'); ?></b></td>
                        </tr>
                        <tr>
                          <td>Beban Gaji</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo16),0,',','.'); ?></td>
                          <td></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td>Beban Sewa</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo),0,',','.'); ?></td>
                          <td></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td>Beban Asuransi</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo17),0,',','.'); ?></td>
                          <td></td>
                          <td>Pendapatan Jasa</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo24),0,',','.'); ?></td>
                        </tr>
                        <tr>
                          <td>Biaya Utilitas</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo18),0,',','.'); ?></td>
                          <td></td>
                          <td>Penjualan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo25),0,',','.'); ?></td>
                        </tr>
                         <tr>
                          <td>Beban Biaya Perawatan Dan Perbaikan</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo19),0,',','.'); ?></td>
                          <td></td>
                          <td><b>Total Pendapatan</b></td>
                          <td align="right"><b>Rp. <?php echo number_format(abs($total_pendapatan),0,',','.'); ?></b></td>
                        </tr>                        
                        <tr>
                          <td>Beban Bensin</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo20),0,',','.'); ?></td>
                          <td></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td>Beban Bunga</td>
                          <td align="right">Rp. <?php echo number_format(abs($jumlah_saldo21),0,',','.'); ?></td>
                          <td></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>
                        <tr>
                          <td><b>Total Beban Biaya</b></td>
                          <td align="right"><b>Rp. <?php echo number_format(abs($total_beban),0,',','.'); ?></b></td>
                          <td></td>
                          <td></td>
                          <td align="right"></td>
                        </tr>                                                
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
        header("location:index.html");
        
}
?>