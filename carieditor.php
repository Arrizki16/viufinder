<?php
session_start();
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,600,700" rel="stylesheet" />
    <link href="assets/css/main.css" rel="stylesheet" />
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/389e9b29e9.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="sticky-top d-flex align-items-center bg-black">
      <div class="container d-flex align-items-center justify-content-between">
  
        <h1 class="logo"><a href="index.php">Viufinder</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href=index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        <?php
          if(isset($_SESSION['email'])) {
        ?>
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
        <?php
          }
        ?>
      </div>
    </header>
    <!-- End Header -->

    <div class="s008">
      <form>
        <div class="inner-form">
          <div class="advance-search">
            <span class="awal"><a href="index.html">Beranda</a> > <a href="carieditor.html">Cari Editor</a></span>
            <span class="desc">Cari Berdasarkan</span>
            <div class="row">
              <div class="col input-field">
                <span>Nama</span>
                <div class="">
                  <input type="text" class="form-control" id="nama" placeholder="Nama" />
                </div>
              </div>
              <div class="input-field">
                <span>Lokasi</span>
                <div class="input-select">
                  <select id="lokasi" data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Semua lokasi</option>
                    <option>Jakarta</option>
                    <option>Surabaya</option>
                    <option>Malang</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col input-field">
                <span>Kategori</span>
                <div class="input-select">
                  <select id="kategori" data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Semua kategori</option>
                    <option>Prewedding</option>
                    <option>Wedding</option>
                    <option>Baby Shoot</option>
                    <option>Family</option>
                    <option>Portrait</option>
                    <option>Maternity</option>
                  </select>
                </div>
              </div>
              <div class="col input-field">
                <span>Rating</span>
                <div class="input-select">
                  <select id="rating" data-trigger="" name="choices-single-defaul">
                    <option placeholder="" value="">Semua rating</option>
                    <option>Belum Ada Rating</option>
                    <option>0 - 1 Rating</option>
                    <option>1 - 2 Rating</option>
                    <option>2 - 3 Rating</option>
                    <option>3 - 4 Rating</option>
                    <option>4 - 5 Rating</option>
                  </select>
                </div>
              </div>
            </div>
            <div><br></div>
          </div>
        </div>
      </form>
    </div>

    <div class="searchbutton1">
      <div class="container">
        <div class="row">
          <div class="input-field">
            <div class="group-btn">
              <button class="btn btn-primary" onclick="search()">Temukan</button>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="foto">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col lg-12 info-panel">
            <div class="row row-cols-1 row-cols-md-4 g-4">
   
            <?php
                include_once("database/db_connection.php");
                $name = (isset($_GET['nama'])) ? $_GET['nama'] : '';
                $category = (isset($_GET['kategori'])) ? $_GET['kategori'] : '';
                $ratingMin = (isset($_GET['minrating'])) ? $_GET['minrating'] : 0;
                $ratingMax = (isset($_GET['maxrating'])) ? $_GET['maxrating'] : 5;
                $location = (isset($_GET['lokasi'])) ? $_GET['lokasi'] : '';
                $nonaktif = "SELECT pjasa_id FROM nonaktif";
                
                $editor = "SELECT p.pjasa_id, p.pjasa_nama, p.pjasa_alamat, p.pjasa_foto, f.*, k.* FROM penyedia_jasa AS p
                                INNER JOIN penyedia_jasa_rangkap AS r ON p.pjasa_id = r.pjasa_id
                                INNER JOIN editor as f ON r.edtr_id = f.edtr_id
                                INNER JOIN editor_kategori fk ON fk.edtr_id = f.edtr_id
                                INNER JOIN kategori_jasa k ON k.ktg_id = fk.ktg_id
                                WHERE p.pjasa_id NOT IN ($nonaktif) n";
                $query = "SELECT DISTINCT(pjasa_id), pjasa_nama, pjasa_alamat, edtr_id, edtr_rating, edtr_tarif FROM ($editor) edtr
                          WHERE pjasa_nama LIKE '%$name%'
                          AND pjasa_alamat LIKE '%$location%'
                          AND edtr_rating > $ratingMin AND edtr_rating <= $ratingMax
                          AND ktg_kategori LIKE '%$category%'";
                $result = mysqli_query($conn, $query);

                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()){
                    $nama = $row['pjasa_nama'];
                    $id = $row['pjasa_id'];
                    $edtrid = $row['edtr_id'];
                    $alamat = $row['pjasa_alamat'];
                  ?>
                  <div class="col mx-auto">
                    <div class="card h-100 text-center">
                      <img src="/assets/img/blog/comments-1.jpg" width=100px height=100px class="rounded-circle mx-auto" alt="...">
                      <div class="card-body">
                        <div class="card-title">
                          <h5><?php echo $nama; ?></h5>
                          <h7><?php echo $alamat;?></h7>
                        </div>
                        <p class="card-text">
                          <?php
                            $rating = $row['edtr_rating'];
                            for ($i=0; $i < $rating; $i++) { 
                              echo '<i class="fas fa-star"></i>';
                            }
                          ?>
                        </p>
                        <p>
                          <?php
                            $kategori = "SELECT ktg_kategori FROM kategori_jasa AS k
                                        INNER JOIN editor_kategori AS fk ON k.ktg_id = fk.ktg_id
                                        INNER JOIN editor AS f ON fk.edtr_id = f.edtr_id
                                        WHERE f.edtr_id = $edtrid";
                            $resultKategori = mysqli_query($conn, $kategori);
                            echo "Kategori: <br>";
                            while($rowKategori = $resultKategori->fetch_assoc()){
                              ?>
                              <div class="bd-highlight">
                                <?php echo $rowKategori['ktg_kategori']; ?>
                              </div>
                              <?php                             
                            }
                          ?>
                        </p>
                        <a href="profil_sediajasa.php?id=<?php echo $id; ?>" class="btn btn-primary text-white">Kunjungi Profil</a>
                      </div>
                    </div>
                  </div>     
                <?php
                  }
                } else {
                  echo "<h1>Tidak ada hasil</h1>";
                }
                ?>
            </div>
        </div>
      </div>
    </div>

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
    <script src="assets/js/extention/choices.js"></script>
    <script>
      const customSelects = document.querySelectorAll("select");
      const choices = new Choices("select", {
        searchEnabled: false,
        itemSelectText: "",
        removeItemButton: true,
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="assets/js/search.js"></script>
  </body>
  <!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
