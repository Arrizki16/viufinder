<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page &mdash; Bootstrap 4 Login Page Snippet</title>
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
</head>
<body class="my-login-page">
	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top d-flex align-items-center ">
		<div class="container d-flex align-items-center justify-content-between">
	
		  <h1 class="logo"><a href="index.php">Viufinder</a></h1>
		  <!-- Uncomment below if you prefer to use an image logo -->
		  <!-- <a href=index.php" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
	
		  <nav id="navbar" class="navbar">
			<ul>
			  <li><a class="nav-link scrollto" href="index.php">Home</a></li>
			  <li>
				<div class="dropdown">
				  <a class="getstarted scrollto active dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="Login_carijasa.php">Login</a>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="Login_carijasa.php">Pencari Jasa</a>
				    <a class="dropdown-item" href="Login_sediajasa.php">Penyedia Jasa</a>
				  </ul>
			  </li>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		  </nav>
	
		</div>
	  </header>
	  <!-- End Header -->
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
			<!-- <div class="row justify-content-md-center align-items-center h-100"> -->
				<div class="card-wrapper">
					<div class="brand">
						<a href="index.php"><img src="assets/img/logo-viufinder.png" alt="bootstrap 4 login page"></a>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title text-center">Forgot Password</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" placeholder="your registered email" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
									<div class="form-text text-muted">
										By clicking "Reset Password" we will send a password reset link
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Reset Password
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="assets/js/login.js"></script>
</body>
</html>