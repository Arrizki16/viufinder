<?php
session_start();
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
    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">
        <div class="section-title">
          <?php
            include_once('database/db_connection.php');
            $query = "SELECT pcr_nama FROM pencari_jasa WHERE pcr_email = '".$_SESSION['email']."'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            echo "<h2>Selamat datang, ".$row['pcr_nama']."!</h2>";
          ?>
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

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>