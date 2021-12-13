<?php
session_start();
if(!isset($_SESSION['email']) || (isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'admin')){
  header("location:index.php");
}
include("database/db_connection.php");
$email = $_SESSION['email'];
 
$query = "SELECT * FROM admin_web WHERE adm_email='$email'";
$admdata = mysqli_fetch_assoc(mysqli_query($conn, $query));
$id = $admdata['adm_id'];

if(isset($_GET['pid']) && isset($_GET['action']) && $_GET['action'] == 'verifikasi'){
    $pid = $_GET['pid'];
    $query = "INSERT INTO `terverifikasi` (adm_id, pjasa_id) VALUES ($id , $pid)";
    mysqli_query($conn, $query);
}
if(isset($_GET['pid']) && isset($_GET['action']) && $_GET['action'] == 'nonaktif'){
    $pid = $_GET['pid'];
    $query1 = "INSERT INTO nonaktif (adm_id, pjasa_id) VALUES ($id , $pid)";
    mysqli_query($conn, $query1);
    $query2 = "DELETE FROM terverifikasi WHERE pjasa_id = $pid";
    mysqli_query($conn, $query2);
}
if(isset($_GET['action'])) {
    header("location:dashboard_admin.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin Viufinder</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/389e9b29e9.js" crossorigin="anonymous"></script>
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand">VIUFINDER</a> 
            </div>
            <div style="color: white;
                padding: 15px 50px 5px 50px;
                float: right;
                font-size: 16px;"> <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
            </div>
        </nav>   
        <!-- /. NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
                    <li>
                        <a class="active-menu"  href="#"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>		 
                </ul>
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard</h2>   
                        <h3>Selamat datang, <b><?php echo $admdata['adm_nama'] ?></b></h3>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6">           
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php
                                    $query = "SELECT COUNT(*) FROM pencari_jasa";
                                    if( $result = mysqli_query($conn, $query) ) {
                                        $row = mysqli_fetch_assoc($result);
                                        echo $row['COUNT(*)'];
                                    } else {
                                        $error = $conn->errno . ' ' . $conn->error;
                                        echo $error;
                                    }
                                ?></p>
                                <p class="text-muted">Pencari Jasa</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon">
                                <i class="fas fa-portrait"></i>
                            </span>
                            <div class="text-box" >
                            <p class="main-text"><?php
                                    $query = "SELECT COUNT(*) FROM penyedia_jasa";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_row($result);
                                    echo $row[0];
                                ?></p>
                                <p class="text-muted">Penyedia Jasa</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-blue set-icon">
                                <i class="fa fa-user-alt-slash"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php
                                    $query = "SELECT COUNT(*) FROM penyedia_jasa
                                                WHERE pjasa_id NOT IN (SELECT pjasa_id FROM terverifikasi);";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_row($result);
                                    echo $row[0];
                                ?></p>
                                <p class="text-muted">Belum Terverifikasi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-brown set-icon">
                                <i class="fa fa-folder"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php
                                    $query = "SELECT COUNT(*) FROM pemesanan_jasa";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_row($result);
                                    echo $row[0];
                                ?></p>
                                <p class="text-muted">Pemesanan</p>
                            </div>
                        </div>
                    </div>   
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="text-align: center;"><br>Daftar Penyedia Jasa<br><br></h1>
                    <div class="table-responsive table-borderless">
                        <table class="table">
                            <thead class="table-dark" style="background: black;color: white;">
                                <tr>
                                    <th><h4><b>ID</b></h4></th>
                                    <th><h4><b>Nama</b></h4></th>
                                    <th><h4><b>Alamat</b></h4></th>
                                    <th><h4><b>Admin</b></h4></th>
                                    <th><h4><b>Aksi</b></h4></th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                <tr class="table-light" style="background: cyan;">
                                    <td colspan="5">
                                        <b>Penyedia Jasa Belum Terverifikasi</b>
                                    </td>
                                </tr>
                                <?php
                                    $terverifikasi = "SELECT pjasa_id FROM terverifikasi";
                                    $nonaktif = "SELECT pjasa_id FROM nonaktif";
                                    $query = "SELECT * FROM penyedia_jasa pj
                                                WHERE pj.pjasa_id NOT IN (SELECT pjasa_id FROM ($terverifikasi) t)
                                                AND pj.pjasa_id NOT IN (SELECT pjasa_id FROM ($nonaktif) n)";
                                    $result = mysqli_query($conn, $query);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>".$row['pjasa_id']."</td>
                                                    <td>".$row['pjasa_nama']."</td>
                                                    <td>".$row['pjasa_alamat']."</td>
                                                    <td>Kosong</td>
                                                    <td>
                                                        <a href='dashboard_admin.php?pid=".$row['pjasa_id']."&action=nonaktif' class='btn btn-danger'>Nonaktifkan</a>
                                                        <a href='dashboard_admin.php?pid=".$row['pjasa_id']."&action=verifikasi' class='btn btn-success'>Verifikasi</a>
                                                        <a href='profil_sediajasa.php?id=".$row['pjasa_id']."' class='btn btn-primary'>Lihat Profil</a>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan="."5".">Tidak ada.</td></tr>";
                                    }
                                ?>
                                <tr class="table-secondary" style="background: cyan;">
                                    <td colspan="5">
                                        <b>Penyedia Jasa Terverifikasi</b>
                                    </td>
                                </tr>
                                <?php
                                    $terverifikasi = "SELECT pj.*, a.adm_nama FROM penyedia_jasa pj 
                                                        INNER JOIN terverifikasi t ON pj.pjasa_id = t.pjasa_id 
                                                        INNER JOIN admin_web a ON a.adm_id = t.adm_id";
                                    $result = mysqli_query($conn, $terverifikasi);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>".$row['pjasa_id']."</td>
                                                    <td>".$row['pjasa_nama']."</td>
                                                    <td>".$row['pjasa_alamat']."</td>
                                                    <td>".$row['adm_nama']."</td>
                                                    <td>
                                                    <a href='dashboard_admin.php?pid=".$row['pjasa_id']."&action=nonaktif' class='btn btn-danger'>Nonaktifkan</a>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan="."5".">Tidak ada.</td></tr>";
                                    }
                                ?>
                                <tr class="table-light" style="background: cyan;">
                                    <td colspan="5">
                                        <b>Penyedia Jasa Nonaktif</b>
                                    </td>
                                </tr>
                                <?php
                                    $nonaktif = "SELECT pj.*, t.adm_id FROM penyedia_jasa pj 
                                                        INNER JOIN nonaktif t ON pj.pjasa_id = t.pjasa_id 
                                                        INNER JOIN admin_web a ON a.adm_id = t.adm_id;";
                                    $result = mysqli_query($conn, $nonaktif);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>".$row['pjasa_id']."</td>
                                                    <td>".$row['pjasa_nama']."</td>
                                                    <td>".$row['pjasa_alamat']."</td>
                                                    <td>".$row['adm_id']."</td>
                                                    <td>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan="."5".">Tidak ada.</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div> 
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
