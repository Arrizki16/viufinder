<?php
session_start();
if(!isset($_SESSION['email'])){
  header("location: index.php");
}                                                 
$sediajasaid = (isset($_GET['id']) ? $_GET['id'] : null);
$user_type = (isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null);

if(is_null($user_type)){
  header("location: index.php");
}

if(is_null($sediajasaid)){
  header('Location: index.php');
} else {
  include_once("database/db_connection.php");
  $query = "SELECT * FROM penyedia_jasa WHERE pjasa_id = '$sediajasaid'";
  $result = $conn->query($query);
  $sediajasadata = $result->fetch_assoc();
  if(!$sediajasadata){
    header('Location: index.php');
  }
} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Metadata -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="George W. Park" />
    <meta name="description" content="This project demonstrates how CSS grid (with flexbox and float fallback) can be used to re-create the layout of an Instagram profile page." />

    <!-- Title -->
    <title>Instagram Profile Layout</title>

    <!-- External CSS Files -->
    <link rel="stylesheet" href="/css/reset.css" />
    <link rel="stylesheet" href="assets/css/dashboard.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" />
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">  
  </head>
  <body>
    <!-- ======= Header ======= -->
  <header id="header" class="sticky-top d-flex align-items-center bg-black">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="dashboard_carijasa.php">Viufinder</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href=index.php" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" 
            href="dashboard_<?php
                if($user_type == 'penyedia_jasa'){
                  echo "sediajasa";
                } else if ($user_type == 'pencari_jasa'){
                  echo "carijasa";
                } else if ($user_type == 'admin'){
                  echo "admin";
                }
              ?>.php">Dashboard</a></li>
          <li>
            <div class="dropdown">
              <a class="getstarted scrollto dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['email']; ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" 
                  href="profil_<?php
                    if($user_type == 'penyedia_jasa'){
                      echo "sediajasa";
                    } else if ($user_type == 'pencari_jasa'){
                      echo "carijasa";
                    } else if ($user_type == 'admin'){
                      echo "admin";
                    }
                  ?>.php">Profil</a>
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

    <header>
      <div class="container">
        <div class="profile">
          <div class="profile-image">
            <img src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=faces" alt="" />
          </div>

          <div class="profile-user-settings">
            <h1 class="profile-user-name">
              <?php echo $sediajasadata['pjasa_nama']; ?>
            </h1>
            <h3>
              <?php echo $sediajasadata['pjasa_alamat']; ?>
            </h3>
            <?php
              if($user_type == 'penyedia_jasa'){
                echo '<a class="btn btn-primary" href="dashboard_sediajasa.php" role="button">Ubah Data</a>';
              } else if ($user_type == 'pencari_jasa'){
                echo '<a class="btn btn-primary" href="pemesanan.php?id='.$sediajasadata['pjasa_id'].'" role="button">Pesan Jasa</a>';
              } else if ($user_type == 'admin'){
                $id = $sediajasadata['pjasa_id'];

                $nonaktif = "SELECT * FROM nonaktif WHERE pjasa_id = '$id'";
                $resNonaktif = mysqli_query($conn, $nonaktif);
                $isNonaktif = ($resNonaktif->num_rows > 0) ? true : false;

                $terverifikasi = "SELECT * FROM terverifikasi WHERE pjasa_id = '$id'";
                $resTerverifikasi = mysqli_query($conn, $nonaktif);
                $isTerverifikasi = ($resTerverifikasi->num_rows > 0) ? true : false;

                if($isTerverifikasi) {
                  echo '<a class="btn btn-danger" href="dashboard_admin.php?pid='.$sediajasaid.'&action=nonaktif" role="button">Nonaktifkan</a>';
                } else {
                  echo '<a class="btn btn-primary" href="dashboard_admin.php?pid='.$sediajasaid.'&action=verifikasi" role="button">Verifikasi</a>';
                }
              }
            ?>
            
          </div>          
        </div>
        <!-- End of profile section -->
      </div>
      <!-- End of container -->
    </header>

    <main>
      <div class="container">
        <h2>Portofolio Fotografer</h2>
        <hr style="height: 2px; border-width: 0; color: gray; background-color: gray" />
        <div class="gallery">
          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1511765224389-37f0e77cf0eb?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 56</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
              </ul>
            </div>
          </div>

          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1497445462247-4330a224fdb1?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 89</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 5</li>
              </ul>
            </div>
          </div>

          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-type"><span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i></div>

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 42</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 1</li>
              </ul>
            </div>
          </div>

          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1502630859934-b3b41d18206c?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-type"><span class="visually-hidden">Video</span><i class="fas fa-video" aria-hidden="true"></i></div>

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 38</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 0</li>
              </ul>
            </div>
          </div>

          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1498471731312-b6d2b8280c61?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-type"><span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i></div>

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 47</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 1</li>
              </ul>
            </div>
          </div>

          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1515023115689-589c33041d3c?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 94</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 3</li>
              </ul>
            </div>
          </div>

          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1504214208698-ea1916a2195a?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-type"><span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i></div>

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 52</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 4</li>
              </ul>
            </div>
          </div>

          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1515814472071-4d632dbc5d4a?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 66</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
              </ul>
            </div>
          </div>

          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1511407397940-d57f68e81203?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-type"><span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i></div>

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 45</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 0</li>
              </ul>
            </div>
          </div>

          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1518481612222-68bbe828ecd1?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 34</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 1</li>
              </ul>
            </div>
          </div>

          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1505058707965-09a4469a87e4?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 41</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 0</li>
              </ul>
            </div>
          </div>

          <div class="gallery-item" tabindex="0">
            <img src="https://images.unsplash.com/photo-1423012373122-fff0a5d28cc9?w=500&h=500&fit=crop" class="gallery-image" alt="" />

            <div class="gallery-item-type"><span class="visually-hidden">Video</span><i class="fas fa-video" aria-hidden="true"></i></div>

            <div class="gallery-item-info">
              <ul>
                <li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 30</li>
                <li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
              </ul>
            </div>
          </div>
        </div>
        <!-- End of gallery -->
      </div>
      <!-- End of container -->
    </main>
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
                Treasury Tower, 7th Floor<br />
                Jl. Jenderal Sudirman Kav 52-53, Senayan, 12190<br />
                <strong>Jakarta</strong><br />
                <strong>Phone:</strong> +1 5589 55488 55<br />
                <strong>Email:</strong> info@example.com<br />
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
    </footer>
  </body>
</html>
