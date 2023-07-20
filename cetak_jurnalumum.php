<?php 

    @session_start();
    $username=$_SESSION['username'];

    // include "koneksi.php";
    include './auth/koneksi.php'; 

    if (@$_SESSION['username']) {     
 ?>

<?php
include('./pages/header.php'); #Header
?>
<?php
include('./pages/sidebar.php'); #Navbar
?>


    <main class="content">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-3">
        <div class="d-block mb-2 mb-md-0">
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
              <li class="breadcrumb-item active" aria-current="page">Report Bulanan</li>
            </ol>
          </nav>
          <h2 class="h4">Jurnal Umum</h2>
          <p>Berisi jurnal umum yang bersumber dari transaksi.</p><br>
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
      
      <div class="card card-body border-3 shadow table-wrapper">
        <table class="table">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">No Reff</th>
              <th class="border-gray-200">Akun</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Keterangan</th>
            </tr>
          </thead>
          <tbody>
          <?php
                include "./auth/koneksi.php";
                $no = 1;
                $query       = "SELECT * FROM transaksi 
                               INNER JOIN akun on transaksi.no_akun = akun.no_reff WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
                $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
              
               $tmp_date = "";
               while($data  = mysqli_fetch_array($jurnal_umum)){
                if ($data['jenis'] == "Debit") {
             ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] : "";?></td>
              <td><?php echo $data['no_akun'];?></td>
              <td><?php echo $data['nama_akun'];?></td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td>Rp. 0</td>
              <td><?php echo $data['keterangan'];?></td>
             
            </tr>

            <?php
              }elseif (($data['jenis'] == "Kredit")) {
            ?>
            <tr>
              <td><?php echo $tmp_date != $data['tgl_transaksi'] ? $data['tgl_transaksi'] : "";?></td>
              <td><?php echo $data['no_akun'];?></td>
              <td><?php echo $data['nama_akun'];?></td>
              <td>Rp. 0</td>
              <td><?php echo "Rp. " . number_format($data['saldo'], 0, ".", "."); ?></td>
              <td><?php echo $data['keterangan'];?></td>
                    
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
    


<?php
include('./pages/footer.php'); #File Footer
?>
</main>
<?php
include('./pages/script.php'); #File Script Tambahan
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

<script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>