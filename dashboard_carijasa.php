<?php
session_start();
if(!isset($_SESSION['email']) || (isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'pencari_jasa')){
  header("location:index.php");
}
include_once("database/db_connection.php");
$email = $_SESSION['email'];
 
$query = "SELECT * FROM pencari_jasa WHERE pcr_email='$email'";
$pcrdata = mysqli_fetch_assoc(mysqli_query($conn, $query));
$id = $pcrdata['pcr_id'];

if(isset($_GET['pid']) && isset($_GET['action']) && $_GET['action'] == 'selesai'){
  $pid = $_GET['pid'];
  $query = "UPDATE pemesanan_jasa SET pmsn_status = 'Selesai' WHERE pmsn_id = '$pid'";
  mysqli_query($conn, $query);
}
if(isset($_GET['pid']) && isset($_GET['action']) && $_GET['action'] == 'bayar'){
  $pid = $_GET['pid'];
  $query = "UPDATE pemesanan_jasa SET pmsn_status = 'Dibayar' WHERE pmsn_id = '$pid'";
  mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard Cari Jasa</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="sticky-top d-flex align-items-center bg-black">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="dashboard_carijasa.php">Viufinder</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href=index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="dashboard_carijasa.php">Dashboard</a></li>
          <li>
            <div class="dropdown">
              <!-- <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown button
              </button> -->
              <a class="getstarted scrollto dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['email']; ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="profil_carijasa.php">Profil</a>
                <a class="dropdown-item" href="logout.php">Keluar</a>
              </ul>
            </div>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Daftar Pesanan ======= -->
    <section id="pesanan" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Selamat Datang, <?php echo $pcrdata['pcr_nama'] ?>!</h2>
          <h3>Urus pesananmu atau <a href="#carijasa">cari jasa lainnya</a>!</h3>
        </div>
        <div class="rounded">
          <div class="table-responsive table-borderless">
              <table class="table">
                  <thead class="table-dark">
                      <tr>
                          <th><h4><b>Penyedia Jasa</b></h4></th>
                          <th><h4><b>Pesanan</b></h4></th>
                          <th><h4><b>Status</b></h4></th>
                          <th><h4><b>Jadwal</b></h4></th>
                          <th><h4><b>Aksi</b></h4></th>
                      </tr>
                  </thead>
                  <tbody class="table-body">
                      <tr class="table-light">
                          <td colspan="5">
                              <b>Pesanan Dipesan</b>
                          </td>
                      </tr>
                      <?php
                          $query = "SELECT pj.pjasa_nama, pm.* FROM pemesanan_jasa pm
                                      INNER JOIN penyedia_jasa pj ON pj.pjasa_id = pm.pjasa_id
                                      WHERE pm.pcr_id = '$id' AND pm.pmsn_status = 'Dipesan'";
                          $result = mysqli_query($conn, $query);
                          if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                  echo "<tr>
                                          <td>".$row['pjasa_nama']."</td>
                                          <td>".$row['pmsn_jenis']."</td>
                                          <td>".$row['pmsn_status']."</td>
                                          <td>".$row['pmsn_tanggal']."<br>".$row['pmsn_waktu_mulai']." - ".$row['pmsn_waktu_selesai']."</td>
                                          <td>
                                          </td>
                                      </tr>";
                              }
                          } else {
                              echo "<tr><td colspan="."5".">Tidak ada pesanan.</td></tr>";
                          }
                      ?>
                      <tr class="table-secondary">
                          <td colspan="5">
                              <b>Pesanan Dikonfirmasi</b>
                          </td>
                      </tr>
                      <?php
                          $query = "SELECT pj.pjasa_nama, pm.* FROM pemesanan_jasa pm
                                      INNER JOIN penyedia_jasa pj ON pj.pjasa_id = pm.pjasa_id
                                      WHERE pm.pcr_id = '$id' AND pm.pmsn_status = 'Dikonfirmasi'";
                          $result = mysqli_query($conn, $query);
                          if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                  $mtdid = $row['mtd_id'];
                                  $mtdq = mysqli_query($conn, "SELECT * FROM metode_bayar WHERE mtd_id = '$mtdid'");
                                  $mtddata = mysqli_fetch_assoc($mtdq);
                                  echo "<tr>
                                          <td>".$row['pjasa_nama']."</td>
                                          <td>".$row['pmsn_jenis']."</td>
                                          <td>".$row['pmsn_status']."</td>
                                          <td>".$row['pmsn_tanggal']."<br>".$row['pmsn_waktu_mulai']." - ".$row['pmsn_waktu_selesai']."</td>
                                          <td>
                                            <button id='modalInput' type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#bayarModal' 
                                            data-bs-mtdnama='".$mtddata['mtd_nama']."' data-bs-mtdnotf='".$mtddata['mtd_nomertf']."' data-bs-pid='".$row['pmsn_id']."'>
                                              Bayar
                                            </button>
                                          </td>
                                      </tr>";
                              }
                          } else {
                              echo "<tr><td colspan="."5".">Tidak ada pesanan.</td></tr>";
                          }
                      ?>
                      <tr class="table-primary">
                          <td colspan="5">
                              <b>Pesanan Dibayar</b>
                          </td>
                      </tr>
                      <?php
                          $query = "SELECT pj.pjasa_nama, pm.* FROM pemesanan_jasa pm
                                      INNER JOIN penyedia_jasa pj ON pj.pjasa_id = pm.pjasa_id
                                      WHERE pm.pcr_id = '$id' AND pm.pmsn_status = 'Dibayar'";
                          $result = mysqli_query($conn, $query);
                          
                          if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                  echo "<tr>
                                          <td>".$row['pjasa_nama']."</td>
                                          <td>".$row['pmsn_jenis']."</td>
                                          <td>".$row['pmsn_status']."</td>
                                          <td>".$row['pmsn_tanggal']."<br>".$row['pmsn_waktu_mulai']." - ".$row['pmsn_waktu_selesai']."</td>
                                          <td>
                                          </td>
                                      </tr>";
                              }
                          } else {
                              echo "<tr><td colspan="."5".">Tidak ada pesanan.</td></tr>";
                          }
                      ?>
                      <tr class="table-info">
                          <td colspan="5">
                              <b>Pesanan Dikerjakan</b>
                          </td>
                      </tr>
                      <?php
                          $query = "SELECT pj.pjasa_nama, pm.* FROM pemesanan_jasa pm
                                      INNER JOIN penyedia_jasa pj ON pj.pjasa_id = pm.pjasa_id
                                      WHERE pm.pcr_id = '$id' AND pm.pmsn_status = 'Dikerjakan'";
                          $result = mysqli_query($conn, $query);
                          
                          if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                  echo "<tr>
                                          <td>".$row['pjasa_nama']."</td>
                                          <td>".$row['pmsn_jenis']."</td>
                                          <td>".$row['pmsn_status']."</td>
                                          <td>".$row['pmsn_tanggal']."<br>".$row['pmsn_waktu_mulai']." - ".$row['pmsn_waktu_selesai']."</td>
                                          <td>
                                          <a href='dashboard_carijasa.php?pid=".$row['pmsn_id']."&action=selesai' class='btn btn-success btn-sm'>Selesai</a>
                                          </td>
                                      </tr>";
                              }
                          } else {
                              echo "<tr><td colspan="."5".">Tidak ada pesanan.</td></tr>";
                          }
                      ?>
                      <tr class="table-success">
                          <td colspan="5">
                              <b>Pesanan Selesai</b>
                          </td>
                      </tr>
                      <?php
                          $query = "SELECT pj.pjasa_nama, pm.* FROM pemesanan_jasa pm
                                      INNER JOIN penyedia_jasa pj ON pj.pjasa_id = pm.pjasa_id
                                      WHERE pm.pcr_id = '$id' AND pm.pmsn_status = 'Selesai'";
                          $result = mysqli_query($conn, $query);
                          
                          if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                  echo "<tr>
                                          <td>".$row['pjasa_nama']."</td>
                                          <td>".$row['pmsn_jenis']."</td>
                                          <td>".$row['pmsn_status']."</td>
                                          <td>".$row['pmsn_tanggal']."<br>".$row['pmsn_waktu_mulai']." - ".$row['pmsn_waktu_selesai']."</td>
                                          <td>
                                          </td>
                                      </tr>";
                              }
                          } else {
                              echo "<tr><td colspan="."5".">Tidak ada pesanan.</td></tr>";
                          }
                      ?>
                      <tr class="table-warning">
                          <td colspan="5">
                              <b>Pesanan Dibatalkan</b>
                          </td>
                      </tr>
                      <?php
                          $query = "SELECT pj.pjasa_nama, pm.* FROM pemesanan_jasa pm
                                      INNER JOIN penyedia_jasa pj ON pj.pjasa_id = pm.pjasa_id
                                      WHERE pm.pcr_id = '$id' AND pm.pmsn_status = 'Dibatalkan'";
                          $result = mysqli_query($conn, $query);
                          
                          if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                  echo "<tr>
                                          <td>".$row['pjasa_nama']."</td>
                                          <td>".$row['pmsn_jenis']."</td>
                                          <td>".$row['pmsn_status']."</td>
                                          <td>".$row['pmsn_tanggal']."<br>".$row['pmsn_waktu_mulai']." - ".$row['pmsn_waktu_selesai']."</td>
                                          <td>
                                          </td>
                                      </tr>";
                              }
                          } else {
                              echo "<tr><td colspan="."5".">Tidak ada pesanan.</td></tr>";
                          }
                      ?>
                      <tr class="table-danger">
                          <td colspan="5">
                              <b>Pesanan Ditolak</b>
                          </td>
                      </tr>
                      <?php
                          $query = "SELECT pj.pjasa_nama, pm.* FROM pemesanan_jasa pm
                                      INNER JOIN penyedia_jasa pj ON pj.pjasa_id = pm.pjasa_id
                                      WHERE pm.pcr_id = '$id' AND pm.pmsn_status = 'Ditolak'";
                          $result = mysqli_query($conn, $query);
                          
                          if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                  echo "<tr>
                                          <td>".$row['pjasa_nama']."</td>
                                          <td>".$row['pmsn_jenis']."</td>
                                          <td>".$row['pmsn_status']."</td>
                                          <td>".$row['pmsn_tanggal']."<br>".$row['pmsn_waktu_mulai']." - ".$row['pmsn_waktu_selesai']."</td>
                                          <td>
                                          </td>
                                      </tr>";
                              }
                          } else {
                              echo "<tr><td colspan="."5".">Tidak ada pesanan.</td></tr>";
                          }
                      ?>
                  </tbody>
              </table>
          </div>
        </div>
        

      </div>
    </section>
    <!-- End Daftar Pesanan -->

    <!-- ======= Pricing Section ======= -->
    <section id="carijasa" class="pricing">
      <div class="container">
      <div class="section-title">
          <h2>Cari Jasa</h2>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="box">
              <h3>Jasa Fotografi</h3>
              <h4>25.000<span> / foto</span></h4>
              <ul>
                <li>foto bebas</li>
                <li>x5 maksimal percobaan</li>
                <li>bebas memilih file</li>
                <li>tanpa editing</li>
                <li>tidak ada pembatalan pemesanan</li>
              </ul> 
              <div class="btn-wrap">
                <a href="carifotografer.php" class="btn-buy">Pesan</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
            <div class="box featured">
              <h3>Jasa Editor</h3>
              <h4>100.000<span> / file</span></h4>
              <ul>
                <li>foto bebas</li>
                <li>x3 maksimal percobaan</li>
                <li>bebas memilih file</li>
                <li>3 hari pengerjaan</li>
                <li>tidak ada pembatalan pemesanan</li>
              </ul>
              <div class="btn-wrap">
                <a href="carieditor.html" class="btn-buy">Pesan</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
            <div class="box">
              <h3>Jasa Sewa Alat</h3>
              <h4>Menyesuaikan</span></h4>
              <ul>
                <li>memilih alat bebas</li>
                <li>barang dijamin berkualitas</li>
                <li>barang rusak harus diganti</li>
                <li>denda setiap keterlambatan</li>
                <li>tidak ada pembatalan pemesanan</li>
              </ul>
              <div class="btn-wrap">
                <a href="carialat.html" class="btn-buy">Pesan</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- End Pricing Section -->
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#home">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Fotografer</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Editor</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Penyewaan alat</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              Treasury Tower, 7th Floor<br>
              Jl. Jenderal Sudirman Kav 52-53, Senayan, 12190<br>
              <strong>Jakarta</strong><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

          </div>

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>About Viufinder</h3>
            <p>Penyedia layanan terbaik di Indonesia dibidang fotografi.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Viufinder</span></strong>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div class='modal fade' id='bayarModal' tabindex='-1' aria-labelledby='bayarModalTitle' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='bayarModalLabel'>Pembayaran Pesanan</h5>
          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
          <p>Kamu belum melakukan pembayaran pesanan ini. Untuk membayar silahkan transfer ke nomor berikut:</p>
          <h2 class="text-center"></h2>
          <h4 class="text-center"></h4>
          <p>Setelah melakukan pembayaran, silakan melakukan konfirmasi pembayaran untuk melanjutkan pesanan.</p>
        </div>
        <div class='modal-footer'>
          <a type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Tutup</a>
          <a href="..." type='button' class='btn btn-primary'>Konfirmasi Pembayaran</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script>
    var modal = document.getElementById('bayarModal')
    var modalInput = document.getElementById('modalInput')

    modal.addEventListener('shown.bs.modal', function (event) {
      modalInput.focus();
      var button = event.relatedTarget;
      var mtdnama = button.getAttribute('data-bs-mtdnama');
      var mtdnotf = button.getAttribute('data-bs-mtdnotf');
      var pid = button.getAttribute('data-bs-pid');

      var notf = modal.querySelector('h2');
      var nama = modal.querySelector('h4');
      var konfirmbtn = modal.querySelector('.btn-primary');
      var href = "dashboard_carijasa.php?pid=" + pid + "&action=bayar";

      notf.textContent = mtdnotf;
      nama.textContent = mtdnama;
      konfirmbtn.setAttribute('href', href);
      console.log(konfirmbtn.href);
    })
  </script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>