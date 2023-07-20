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
              <li class="breadcrumb-item active" aria-current="page">Jurnal Umum</li>
            </ol>
          </nav>
          <h2 class="h4">Jurnal Umum</h2>
          <p class="mb-0">Berisi jurnal umum yang bersumber dari transaksi.</p>
        

      </div>
      </div>
      <?php
        include('./auth/koneksi.php');
        // Jika pengguna tidak memiliki role sebagai Developer, maka sidebar tidak akan ditampilkan
        $allowed_roles = ['Developer'];
        if(!in_array($_SESSION['role'], $allowed_roles))
        {
          $release = 'style="display: none;"';
        }else{
          $release = '';
        }
      ?>
        <div>
          <a class="btn btn-gray-800 mt-2 animate-up-2 primary mb-4" href="cetak_jurnalumum" type="submit">Cetak Jurnal Umum</a> 
           <a class="btn btn-gray-800 mt-2 animate-up-2 primary mb-4" href="proses_release" <?php echo $release ?> type="submit">Release</a>        
        </div>
      <div class="card card-body border-3 shadow table-wrapper table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th class="border-gray-200">Tanggal</th>
              <th class="border-gray-200">No Reff</th>
              <th class="border-gray-200">Akun</th>
              <th class="border-gray-200">Debit</th>
              <th class="border-gray-200">Kredit</th>
              <th class="border-gray-200">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
               include "./auth/koneksi.php";
               $no = 1;
               $query       = "SELECT * FROM transaksi 
                              INNER JOIN akun on transaksi.no_akun = akun.no_reff WHERE transaksi.user_id = {$_SESSION['user_id']} ORDER BY tgl_transaksi ASC";
               $jurnal_umum = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
              //  echo "<pre>";
              // var_dump(mysqli_fetch_array($jurnal_umum));
              // echo "</pre>";
              // die();
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
              <td>
                  <a class="btn btn-primary"   href="edit_jurnal.php?id=<?php echo $data['id']; ?>">Edit</a>
                  <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-delete<?php echo $data['id']; ?>">Delete</a>                
              </td>
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
              <td>
                  <a class="btn btn-primary"   href="edit_jurnal.php?id=<?php echo $data['id']; ?>">Edit</a>
                  <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-delete<?php echo $data['id']; ?>">Delete</a>                
              </td>              
            </tr> 
            <?php
              }
            ?>

            <!-- Lakukan Logika Penghapusan Dengan Kredit Dan Debit Dihapus Secara Bersama -->
              <?php
                if($data['jenis'] == "Debit" || $data['jenis'] == "Kredit")
                {
                  $data['id'];
                }
              ?>
            <!-- Delete Button -->

<div class="modal fade" id="modal-delete<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-delete-label">Hapus Data</h5>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin akan menghapus data ini?</p>
      </div>
      <div class="modal-footer">
        <form method="post" action="delete_jurnal">
          <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
          <button type="submit" name="ya" class="btn btn-primary">Ya</button>
        </form>
      </div>
    </div>
  </div>
</div>

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
include('./pages/footer.php'); #Footer
?>
</main>
<?php
include('./pages/script.php'); #Script
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
