<?php
session_start();

// if (isset($_SESSION['email'])) {
//   header('Location: table.php');
// }

include_once("database/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	$address = $_POST['address'];
	$isFtg = (isset($_POST['checkftg'])) ? 1 : 0;
	$isEdtr = (isset($_POST['checkedtr'])) ? 1 : 0;
	$isPalat = (isset($_POST['checkpalat'])) ? 1 : 0;

	$ftgq = ($isFtg) ? "INSERT INTO `fotografer` (`ftg_rating`) VALUES (`5`);" : "";
	$edtrq = ($isEdtr) ? "INSERT INTO `editor` (`edtr_rating`) VALUES (`5`);" : "";
	$palatq = ($isPalat) ? "INSERT INTO `penyewaan_alat` (`palat_rating`) VALUES (`5`);" : "";

	$ftgid = ($isFtg) ? "(SELECT MAX(`ftg_id`) FROM `fotografer`)" : "null";
	$edtrid = ($isEdtr) ? "(SELECT MAX(`edtr_id`) FROM `editor`)" : "null";
	$palatid = ($isPalat) ? "(SELECT MAX(`palat_id`) FROM `penyewaan_alat`)" : "null";

	$pjasaid = "(SELECT MAX(`pjasa_id`) FROM `penyedia_jasa`)";
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	echo $name;
	// echo $email;	
	$query = "INSERT INTO `penyedia_jasa` (`pjasa_nama`, `pjasa_email`, `pjasa_password`, `pjasa_alamat`) VALUES ('$name', '$email', '$password', '$address');
				$ftgq $edtrq $palatq
				INSERT INTO `penyedia_jasa_rangkap` (`pjasa_id`, `ftg_id`, `edtr_id`, `palat_id`) VALUES ($pjasaid, $ftgid, $edtrid, $palatid);";
	
	if($stmt = mysqli_multi_query($conn, $query)) { 
		header('Location: login_sediajasa.php');
	} else {
		$error = $conn->errno . ' ' . $conn->error;
		echo $error; // 1054 Unknown column 'foo' in 'field list'
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Resgister Penyedia Jasa &mdash; Bootstrap 4 Login Page Snippet</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Favicons -->
	<link href="assets/img/favicon.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

	<!-- Template Main CSS File -->
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link href="assets/css/style.css" rel="stylesheet">
	<style>
		section { overflow-y: scroll !important; }
		/* body, html { position: absolute !important; } */
	</style>
</head>
<body class="my-login-page">
	<!-- ======= Header ======= -->
	<!-- <header id="header" class="fixed-top d-flex align-items-center ">
		<div class="container d-flex align-items-center justify-content-between">
	
		  <h1 class="logo"><a href="index.php">Viufinder</a></h1>
		  
	
		  <nav id="navbar" class="navbar">
			<ul>
			  <li><a class="nav-link scrollto" href="index.php">Home</a></li>
			  <li>
				<div class="dropdown">
				  <a class="getstarted scrollto active dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="login_sediajasa.php">Login</a>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="login_carijasa.php">Pencari Jasa</a>
				    <a class="dropdown-item" href="login_sediajasa.php">Penyedia Jasa</a>
				  </ul>
			  </li>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		  </nav>
	
		</div>
	  </header> -->
	  <!-- End Header -->
	
	  <section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<a href="index.php"><img src="assets/img/logo-viufinder.png" alt="bootstrap 4 login page"></a>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title text-center">REGISTER PENYEDIA JASA</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="name">Name</label>
									<input id="name" type="text" class="form-control" placeholder="type your name" name="name" required autofocus>
									<div class="invalid-feedback">
										What's your name?
									</div>
								</div>

								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" placeholder="type your email" name="email" required>
									<div class="invalid-feedback">
										Your email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" placeholder="type your password" name="password" required data-eye>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>
								<div class="form-group">
									<label for="address">Address</label>
									<input id="address" type="text" class="form-control" placeholder="type your address" name="address" required data-eye>
									<div class="invalid-feedback">
										Address is required
									</div>
								</div>

								<label>Jenis Jasa</label>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="checkftg" name="checkftg" checked>
									<label class="form-check-label" for="checkftg">
										Fotografer
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="checkedtr" name="checkedtr">
									<label class="form-check-label" for="checkedtr">
										Editor
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="checkpalat" name="checkpalat">
									<label class="form-check-label" for="checkpalat">
										Penyewaan Alat
									</label>
								</div>
								<p><br></p>
								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="agree" id="agree" class="custom-control-input" required="">
										<label for="agree" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label>
										<div class="invalid-feedback">
											You must agree with our Terms and Conditions
										</div>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Register
									</button>
								</div>
								<div class="mt-4 text-center">
									Already have an account? <a href="login_sediajasa.php">Login</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="assets/js/login.js"></script>
</body>
</html>