<?php
ob_start();
session_start();

include 'dbconnect.php';

if (isset($_POST['perbarui'])) {
	$userid = $_POST['userid'];
	$namalengkap = $_POST['namalengkap'];
	$email = $_POST['email'];
	$notelp = $_POST['notelp'];
	$alamat = $_POST['alamat'];
	// $Waktu = time();
	$gambar = $_FILES['file']['name'];
	$x = explode('.', $gambar);
	$ekstensi = strtolower(end($x));
	$file_tmp = $_FILES['file']['tmp_name'];
	move_uploaded_file($file_tmp, 'images/' . $gambar);
	$query = mysqli_query($conn, "UPDATE `login` SET `namalengkap`='$namalengkap',`image`='$gambar',`email`='$email',`notelp`='$notelp',`alamat`='$alamat' WHERE `userid`='$userid'");
	$_SESSION['image'] = $gambar;
	$_SESSION['name'] = $_POST['namalengkap'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['notelp'] = $_POST['notelp'];
	$_SESSION['alamat'] = $_POST['alamat'];

	$message = "Data Berhasil Diperbarui!";
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>WOODEN</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Falenda Flora, Ruben Agung Santoso" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //for-mobile-apps -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<!-- font-awesome icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<!-- js -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<!-- //js -->
	<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
</head>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Wooden</title>
	<style>
		body {
			background: white;
		}
	</style>
</head>

<body>
	<!-- header -->
	<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
				<p>DAPATKAN PENAWARAN MENARIK KHUSUS HARI INI, BELANJA SEKARANG!</p>
			</div>
			<div class="agile-login" style="text-align: right; float:right">
				<ul>
					<?php
					if (!isset($_SESSION['log'])) {
						echo '
					<li><a href="registered.php" style="color: black"> Daftar</a></li>
					<li><a href="login.php" style="color: black">Masuk</a></li>
					';
					} else {

						if ($_SESSION['role'] == 'Member') {
							echo '
					<li style="color:white">Halo, ' . $_SESSION["name"] . '
					<li><a href="logout.php">Logout?</a></li>
					';
						} else if ($_SESSION['role'] == 'pemilik') {
							echo '
						<li style="color:white">Halo, ' . $_SESSION["name"] . '
						<li><a href="pemilik">Admin Panel</a></li>
						<li><a href="logout.php">Logout?</a></li>
						';
						} else if ($_SESSION['role'] == 'admin') {
							echo '
						<li style="color:white">Halo, ' . $_SESSION["name"] . '
						<li><a href="admin">Admin Panel</a></li>
						<li><a href="logout.php">Logout?</a></li>
						';
						};
					}
					?>

				</ul>
			</div>
			<!-- <div class="product_list_header">  
					<a href="cart.php"><button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
				 </a>
			</div> -->
			<div class="clearfix"> </div>
		</div>
	</div>

	<div class="logo_products">
		<div class="container">
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>Hubungi Kami : (+6281) 222 333</li>
				</ul>
			</div>
			<div class="w3ls_logo_products_left">
				<h1><a href="index.php">WOODEN</a></h1>
			</div>
			<div class="w3l_search">
				<form action="search.php" method="post">
					<input type="search" name="Search" placeholder="Cari produk...">
					<button type="submit" class="btn btn-default search" aria-label="Left Align">
						<i class="fa fa-search" aria-hidden="true"> </i>
					</button>
					<div class="clearfix"></div>
				</form>
			</div>

			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- header -->
	<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Halaman Profil</li>
			</ol>
		</div>
	</div>
	<!-- //breadcrumbs -->
	<div class="breadcrumbs" style="background: white">
		<div class="row h-50\">
			<div class="col col-md-4">
				<center>
					<img class="rounded-circle overflow-hidden" src="images/<?= $_SESSION['image'] ?>" alt="" style="width: 250px; height:250px">
				</center>
			</div>
			<div class="col col-md-8">
				<div class="container-fluid">
					<form method="post" enctype="multipart/form-data">
						<input type="text" name="userid" value="<?= $_SESSION['id'] ?>" style="display: none">
						<div class="my-2">
							<label>Upload Foto Profil</label>
							<input type="file" class="form-control" id="exampleFormControlInput1" name="file" required>
						</div>
						<div class="my-2">
							<label>Nama</label>
							<input type="text" class="form-control" id="exampleFormControlInput1" name="namalengkap" placeholder="Nama Lengkap" value="<?= $_SESSION['name'] ?>" required>
						</div>
						<div class="my-2">
							<label>Email</label>
							<input type="text" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Email" value="<?= $_SESSION['email'] ?>" required>
						</div>
						<div class="my-2">
							<label>Nomor Telepon</label>
							<input type="text" class="form-control" id="exampleFormControlInput1" name="notelp" placeholder="Nomor Telepon" value="<?= $_SESSION['notelp'] ?>" required>
						</div>
						<div class="my-2">
							<label>Alamat</label>
							<input type="text" class="form-control" id="exampleFormControlInput1" name="alamat" placeholder="Alamat" value="<?= $_SESSION['alamat'] ?>" required>
						</div>
						<input type="submit" name="perbarui" value="Edit" class="btn btn-primary">
				</div>
				</form>
			</div>
		</div>
	</div>
	</div>
	<!-- //footer -->
	<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
				<div class="col-md-4 w3_footer_grid">
					<h3>Hubungi Kami</h3>

					<ul class="address">
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Wooden Furniture, Jember</li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@email">woodenjember@gmail.com</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+62 8113 2322</li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Tentang Kami</h3>
					<ul class="info">
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">About Us</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">How To</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">FAQ</a></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>

		<div class="footer-copy">

			<div class="container">
				<p>© 2022 Wooden's Furniture. All rights reserved</p>
			</div>
		</div>

	</div>
	<div class="footer-botm">
		<div class="container">
			<div class="w3layouts-foot">
				<ul>
					<li><a href="#" class="w3_agile_instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				</ul>
			</div>
			<div class="payment-w3ls">
				<img src="images/card.png" alt=" " class="img-responsive">
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //footer -->
	<!-- Optional JavaScript; choose one of the two! -->
	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>