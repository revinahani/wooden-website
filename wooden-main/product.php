<?php
session_start();
include 'dbconnect.php';

$idproduk = $_GET['idproduk'];
if (isset($_GET['filter'])) {
	$filter = $_GET['filter'];
} else {
	$filter = 'all';
}

if (isset($_POST['addprod'])) {
	if (!isset($_SESSION['log'])) {
		header('location:login.php');
	} else {

		$ui = $_SESSION['id'];
		$cek = mysqli_query($conn, "select * from cart where userid='$ui' and status='Cart'");
		$liat = mysqli_num_rows($cek);
		$f = mysqli_fetch_array($cek);
		if (isset($f['orderid'])) {
			$orid = $f['orderid'];
		}
		// echo "<pre>";
		// print_r($f);
		// echo "</pre>";
		// echo "----";
		// echo "<pre>";
		// print_r($orid);
		// echo "</pre>";

		//kalo ternyata udeh ada order id nya
		if ($liat > 0) {

			//cek barang serupa
			$cekbrg = mysqli_query($conn, "select * from detailorder where idproduk='$idproduk' and orderid='$orid'");
			// $liatlg = mysqli_num_rows($cekbrg);
			// while ($fetc = mysqli_fetch_array($caricart)) {
			// 	# code...
			// 	$orderidd = $fetc['orderid'];
			// }
			$liatlg = mysqli_num_rows($cekbrg);
			$jmlh = 0;
			while ($brpbanyak = mysqli_fetch_array($cekbrg)) {
				$jmlh += floatval($brpbanyak['qty']);
			}
			// $jmlh = $brpbanyak['qty'];

			//kalo ternyata barangnya ud ada
			if ($liatlg > 0) {
				$i = 1;
				$baru = $jmlh + $i;

				$updateaja = mysqli_query($conn, "update detailorder set qty='$baru' where orderid='$orid' and idproduk='$idproduk'");

				if ($updateaja) {
					echo " <div class='alert alert-success'>
								Barang sudah pernah dimasukkan ke keranjang, jumlah akan ditambahkan
							  </div>
								<meta http-equiv='refresh' content='2; url= product.php?idproduk=" . $idproduk . "'/>";
				} else {
					echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							  <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/>";
				}
			} else {

				$tambahdata = mysqli_query($conn, "insert into detailorder (orderid,idproduk,qty) values('$orid','$idproduk','1')");
				if ($tambahdata) {
					echo " <div class='alert alert-success'>
								Berhasil menambahkan ke keranjang
							  </div>
							<meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/>  ";
				} else {
					echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							 <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/> ";
				}
			};
		} else {

			//kalo belom ada order id nya
			$oi = crypt(rand(22, 999), time());

			$bikincart = mysqli_query($conn, "insert into cart (orderid, userid) values('$oi','$ui')");

			if ($bikincart) {
				$tambahuser = mysqli_query($conn, "insert into detailorder (orderid,idproduk,qty) values('$oi','$idproduk','1')");
				if ($tambahuser) {
					echo " <div class='alert alert-success'>
								Berhasil menambahkan ke keranjang
							  </div>
							<meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/>  ";
				} else {
					echo "<div class='alert alert-warning'>
								Gagal menambahkan ke keranjang
							  </div>
							 <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/> ";
				}
			} else {
				echo "gagal bikin cart";
			}
		}
	}
};
?>

<!DOCTYPE html>
<html>

<head>
	<title>Wooden - Produk</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Wooden, Rambipuji" />
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

<body>
	<!-- header -->
	<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
				<p>DAPATKAN PENAWARAN MENARIK KHUSUS HARI INI, BELANJA SEKARANG!</p>
			</div>
			<div class="agile-login">
				<ul>
					<?php
					if (!isset($_SESSION['log'])) {
						echo '
					<li><a href="registered.php"> Daftar</a></li>
					<li><a href="login.php">Masuk</a></li>
					';
					} else {

						if ($_SESSION['role'] == 'Member') {
							echo '
					<li><a href="logout.php">Logout?</a></li>
					';
						} else {
							echo '
					<li><a href="admin">Admin Panel</a></li>
					<li><a href="logout.php">Logout?</a></li>
					';
						};
					}
					?>

				</ul>
			</div>
			<div class="product_list_header">
				<a href="cart.php"><button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
				</a>
			</div>
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
	<!-- //header -->
	<!-- navigation -->
	<div class="navigation-agileits">
		<div class="container">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php" class="act">Home</a></li>
						<!-- Mega Menu -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Kategori Produk<b class="caret"></b></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="row">
									<div class="multi-gd-img">
										<ul class="multi-column-dropdown">
											<h6>Kategori</h6>

											<?php
											$kat = mysqli_query($conn, "SELECT * from kategori order by idkategori ASC");
											while ($p = mysqli_fetch_array($kat)) {

											?>
												<li><a href="kategori.php?idkategori=<?php echo $p['idkategori'] ?>"><?php echo $p['namakategori'] ?></a></li>

											<?php
											}
											?>
										</ul>
									</div>

								</div>
							</ul>
						</li>
						<?php
						if (!isset($_SESSION['log'])) {
							echo '
						<li><a href="registered.php" style="color: black"> Daftar</a></li>
						<li><a href="login.php" style="color: black">Login</a></li>
						';
						} else {

							if ($_SESSION['role'] == 'Member') {
								echo '
						<li><a href="cart.php">Keranjang Saya</a></li>
						<li><a href="daftarorder.php">Daftar Pesanan</a></li>
						<li><a href="review.php">Ulasan</a></li>
						';
							} elseif ($_SESSION['role'] == 'pemilik') {
								echo '
						';
							} else {
								echo '
						';
							};
						}
						?>
						<!-- <li><a href="cart.php">Keranjang Saya</a></li>
						<li><a href="daftarorder.php">Daftar Pesanan</a></li>
						<li><a href="review.php">Ulasan</a></li> -->
					</ul>
				</div>
			</nav>
		</div>
	</div>

	<!-- //navigation -->
	<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><span class="glyphicon glyphicon-bed" aria-hidden="true"></span></li><?php
														$p = mysqli_fetch_array(mysqli_query($conn, "Select * from produk where idproduk='$idproduk'"));
														echo $p['namaproduk'];
														?></li>
			</ol>
		</div>
	</div>
	<!-- //breadcrumbs -->
	<div class="products">
		<div class="container">
			<div class="agileinfo_single">

				<div class="col-md-4 agileinfo_single_left">
					<img id="example" src="<?php echo $p['gambar'] ?>" alt=" " class="img-responsive">
				</div>
				<div class="col-md-8 agileinfo_single_right">
					<h2><?php echo $p['namaproduk'] ?></h2>
					<div class="rating1">
						<span class="starRating">
							<?php
							$bintang = '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
							$rate = $p['rate'];

							for ($n = 1; $n <= $rate; $n++) {
								echo '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
							};
							?>
						</span>
					</div>
					<div class="w3agile_description">
						<h4>Deskripsi :</h4>
						<p><?php echo $p['deskripsi'] ?></p>
					</div>
					<div class="snipcart-item block">
						<div class="snipcart-thumb agileinfo_single_right_snipcart">
							<h4 class="m-sing">Rp<?php echo number_format($p['hargaafter']) ?> <span>Rp<?php echo number_format($p['hargabefore']) ?></span></h4>
						</div>
						<div class="snipcart-details agileinfo_single_right_details">
							<form action="#" method="post">
								<fieldset>
									<input type="hidden" name="idprod" value="<?php echo $idproduk ?>">
									<input type="submit" name="addprod" value="Tambah keranjang" class="button">
								</fieldset>
							</form>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>

		<?php
		$avg = mysqli_query($conn, "SELECT AVG(rating) as avg from review where idproduk='$idproduk'");
		$avg = mysqli_fetch_array($avg);
		$avg = number_format($avg['avg'], 1);
		?>

		<div class="review container">
			<div class="row">
				<div class="col-md">
					<div class="card text-center">
						<div class="row">
							<div class="col-md-4" style="margin-bottom:20px">
								<div class="rating-box">
									<h1>
										<?php echo $avg ?>
									</h1>
									<p>out of 5</p>
								</div>
								<div style="margin-top: 10px">
									<?php
									for ($i = 1; $i <= 5; $i++) {
										if ($i <= $avg) {
											echo '<span class="glyphicon glyphicon-star star"></span>';
										} else {
											echo '<span class="glyphicon glyphicon-star-empty"></span>';
										}
									}
									?>
								</div>
							</div>
							<div class="col-md-8">
								<?php
								$total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM review where idproduk='$idproduk'"));
								?>
								<div class="rating-bar0 justify-content-center" data-rows="<?php echo $total_rows ?>">
									<table class="text-left mx-auto">
										<?php
										$five = mysqli_num_rows(mysqli_query($conn, "SELECT * from review where idproduk='$idproduk' and rating=5"));
										$four = mysqli_num_rows(mysqli_query($conn, "SELECT * from review where idproduk='$idproduk' and rating=4"));
										$three = mysqli_num_rows(mysqli_query($conn, "SELECT * from review where idproduk='$idproduk' and rating=3"));
										$two = mysqli_num_rows(mysqli_query($conn, "SELECT * from review where idproduk='$idproduk' and rating=2"));
										$one = mysqli_num_rows(mysqli_query($conn, "SELECT * from review where idproduk='$idproduk' and rating=1"));
										?>
										<tr>
											<td class="rating-label">Excellent</td>
											<td class="rating-bar" data-numbers="<?php echo $five ?>">
												<div class="bar-container">
													<div class="bar-5"></div>
												</div>
											</td>
											<td class="text-right"><?php echo $five ?></td>
										</tr>
										<tr>
											<td class="rating-label">Good</td>
											<td class="rating-bar" data-numbers="<?php echo $four ?>">
												<div class="bar-container">
													<div class="bar-4"></div>
												</div>
											</td>
											<td class="text-right"><?php echo $four ?></td>
										</tr>
										<tr>
											<td class="rating-label">Average</td>
											<td class="rating-bar" data-numbers="<?php echo $three ?>">
												<div class="bar-container">
													<div class="bar-3"></div>
												</div>
											</td>
											<td class="text-right"><?php echo $three ?></td>
										</tr>
										<tr>
											<td class="rating-label">Poor</td>
											<td class="rating-bar" data-numbers="<?php echo $two ?>">
												<div class="bar-container">
													<div class="bar-2"></div>
												</div>
											</td>
											<td class="text-right"><?php echo $two ?></td>
										</tr>
										<tr>
											<td class="rating-label">Terrible</td>
											<td class="rating-bar" data-numbers="<?php echo $one ?>">
												<div class="bar-container">
													<div class="bar-1"></div>
												</div>
											</td>
											<td class="text-right"><?php echo $one ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="row container" style="margin-top: 20px">
						<div class="col-md">
							<h3>Filter</h3>
							<button type="button" class="btn <?php echo ($filter == 'all') ? 'btn-success' : '' ?> filterReview" data-filter="all">Semua (<?php echo $total_rows ?>)</button>
							<button type="button" class="btn <?php echo ($filter == '5') ? 'btn-success' : '' ?> filterReview" data-filter="5">
								<span class="glyphicon glyphicon-star star"></span>
								5
							</button>
							<button type="button" class="btn <?php echo ($filter == '4') ? 'btn-success' : '' ?> filterReview" data-filter="4">
								<span class="glyphicon glyphicon-star star"></span>
								4
							</button>
							<button type="button" class="btn <?php echo ($filter == '3') ? 'btn-success' : '' ?> filterReview" data-filter="3">
								<span class="glyphicon glyphicon-star star"></span>
								3
							</button>
							<button type="button" class="btn <?php echo ($filter == '2') ? 'btn-success' : '' ?> filterReview" data-filter="2">
								<span class="glyphicon glyphicon-star star"></span>
								2
							</button>
							<button type="button" class="btn <?php echo ($filter == '1') ? 'btn-success' : '' ?> filterReview" data-filter="1">
								<span class="glyphicon glyphicon-star star"></span>
								1
							</button>
						</div>
					</div>

					<?php
					if ($filter == 'all') {
						$reviews = mysqli_query($conn, "SELECT * FROM review INNER JOIN login ON review.userid = login.userid where idproduk='$idproduk' ORDER BY review.reviewid DESC");
					} else {
						$reviews = mysqli_query($conn, "SELECT * FROM review INNER JOIN login ON review.userid = login.userid where idproduk='$idproduk' AND rating='$filter' ORDER BY review.reviewid DESC");
					}

					while ($review = mysqli_fetch_array($reviews)) { ?>
						<div class="card">
							<div class="row" style="display: flex!important;">
								<?php
								if ($review['image']) { ?>
									<img class="profile-pic" src="images/<?php echo $review['image']  ?>">'
								<?php
								} else { ?>
									<img class="profile-pic" src="http://www.gravatar.com/avatar/3b3be63a4c2a439b013787725dfce802?d=identicon">
								<?php
								}
								?>
								<div class="d-flex flex-column">
									<h3 class="mt-2 mb-0"><?php echo $review['namalengkap']  ?></h3>
									<div>
										<p class="text-left" style="margin-top: 10px">
											<span class="text-muted"><?php echo $review['rating'] ?>.0</span>
											<span class="text-muted">
												<?php
												for ($i = 1; $i <= 5; $i++) {
													if ($i <= $review['rating']) {
														echo '<span class="glyphicon glyphicon-star star"></span>';
													} else {
														echo '<span class="glyphicon glyphicon-star-empty"></span>';
													}
												}
												?>
											</span>
										</p>
									</div>
								</div>
								<div style="margin-left: auto">
									<p class="text-muted pt-5 pt-sm-3"><?php echo $review['submit_date'] ?></p>
								</div>
							</div>
							<div class="row text-left">
								<p class="content">
									<?php echo $review['content']  ?>
								</p>
							</div>
						</div>
					<?php
					}
					?>
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
				<p>© Wooden's Furniture. All rights reserved</p>
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
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- top-header and slider -->
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {

			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 4000,
				easingType: 'linear'
			};


			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //here ends scrolling icon -->

	<!-- main slider-banner -->
	<script src="js/skdslider.min.js"></script>
	<link href="css/skdslider.css" rel="stylesheet">
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#demo1').skdslider({
				'delay': 5000,
				'animationSpeed': 2000,
				'showNextPrev': true,
				'showPlayButton': true,
				'autoSlide': true,
				'animationType': 'fading'
			});

			jQuery('#responsive').change(function() {
				$('#responsive_wrapper').width(jQuery(this).val());
			});

		});

		$(document).ready(function() {
			$('.rating-bar').each(function() {
				var s = $(this).data('numbers');
				var p = $(this).parent().parent().parent().parent().data('rows');
				var r = s / p * 100;
				$(this).children().children().css('width', r + '%');
			});

			$('.filterReview').click(function() {
				var filter = $(this).data('filter');
				var idproduk = $('input[name=idprod]').val();
				window.location.href = 'product.php?idproduk=' + idproduk + '&filter=' + filter;
			});

			$('#')
		});
	</script>
	<!-- //main slider-banner -->
</body>

</html>