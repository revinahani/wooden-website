<?php
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['log'])) {
  header('location:login.php');
}

$uid = $_SESSION['id'];
$orders = mysqli_query($conn, "SELECT * FROM cart WHERE cart.userid = $uid AND cart.status = 'Selesai'");

$dataOrders = [];
$i = 0;
while ($order = mysqli_fetch_assoc($orders)) {
  $dataOrders[$i] = [
    'idcart' => $order['idcart'],
    'orderid' => $order['orderid'],
    'userid' => $order['userid'],
    'tglorder' => $order['tglorder'],
    'status' => $order['status'],
  ];

  $sqlProducts = mysqli_query($conn, "SELECT * from detailorder INNER JOIN produk ON detailorder.idproduk = produk.idproduk where orderid = '" . $order['orderid'] . "'");
  $sqlReviews = mysqli_query($conn, "SELECT * from review INNER JOIN produk ON review.idproduk = produk.idproduk where orderid = '" . $order['orderid'] . "'");

  $dataReviews = [];
  $dataNotReviews = [];

  while ($review = mysqli_fetch_assoc($sqlReviews)) {
    $dataReviews[] = [
      'reviewid' => $review['reviewid'],
      'idproduk' => $review['idproduk'],
      'namaproduk' => $review['namaproduk'],
      'hargaafter' => $review['hargaafter'],
      'gambar' => $review['gambar'],
      'content' => $review['content'],
      'rating' => $review['rating'],
      'submit_date' => $review['submit_date'],
    ];
  }

  while ($product = mysqli_fetch_assoc($sqlProducts)) {
    $hasReview = false;
    foreach ($dataReviews as $review) {
      if ($review['idproduk'] == $product['idproduk']) {
        $hasReview = true;
      }
    }

    if ($hasReview) {
      continue;
    } else {
      $dataNotReviews[] = [
        'idproduk' => $product['idproduk'],
        'namaproduk' => $product['namaproduk'],
        'hargaafter' => $product['hargaafter'],
        'qty' => $product['qty'],
        'gambar' => $product['gambar'],
      ];
    }
  }

  $dataOrders[$i] += [
    'reviews' => $dataReviews,
    'notreviews' => $dataNotReviews,
  ];

  $i++;
}

if (isset($_POST["review"])) {
  $rating = $_POST['rating'] ?? 0;
  $ulasan = $_POST['ulasan'];
  $orderid = $_POST['orderid'];
  $produkid = $_POST['produkid'];
  $date = date("Y-m-d");

  if ($rating == 0) {
    echo "<script>alert('Rating harus diisi!');
    window.location.href='review.php';
    </script>
    ";
  } else {
    $q = mysqli_query($conn, "INSERT INTO review (idproduk, orderid, userid, content, rating, submit_date) VALUES ($produkid, '$orderid', $uid, '$ulasan', $rating, '$date')");
    if ($q) {
      echo "<script>alert('Terima kasih telah memberikan ulasan');
      window.location.href='review.php';
      </script>";
    } else {
      echo "<script>alert('Gagal memberikan ulasan');
      window.location.href='review.php';
      </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Wooden - Review</title>
  <!-- for-mobile-apps -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Wooden, Richard's Lab" />
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
					<li style="color:white">Halo, ' . $_SESSION["name"] . '
					<li><a href="logout.php">Logout?</a></li>
					';
            } else {
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
      <ol class="breadcrumb breadcrumb1">
				<li><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Ulasan</li>
        <!-- <li class="active">Review</li> -->
      </ol>
    </div>
  </div>
  <!-- //breadcrumbs -->
  <!-- review -->
  <div id="reviewTab" class="container" style="margin-top: 80px">
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#1" data-toggle="tab">Menunggu Diulas</a>
      </li>
      <li>
        <a href="#2" data-toggle="tab">Ulasan Saya</a>
      </li>
    </ul>
    <br>
    <div class="tab-content">
      <div class="tab-pane active" id="1" style="margin-bottom: 150px">
        <?php
        $checkNotReviews = false;
        foreach ($dataOrders as $order) {
          $subtotal = 0;
          if ($order['notreviews']) {
            $checkNotReviews = true;
        ?>
            <div class="panel panel-default">
              <div class="panel-heading">Kode Order: <?php echo $order['orderid'] ?></div>
              <?php
              foreach ($order['notreviews'] as $product) {
                $hrg = $product['hargaafter'];
                $qtyy = $product['qty'];
                $totalharga = $hrg * $qtyy;
                $subtotal += $totalharga;
              ?>
                <div class="panel-body">
                  <div class="col-md-3">
                    <a href="product.php?idproduk=<?php echo $product['idproduk'] ?>">
                      <img src="<?php echo $product['gambar'] ?>" alt="<?php echo $product['namaproduk'] ?>" height="250" width="250">
                    </a>
                  </div>
                  <div class="col-md-9">
                    <br>
                    <h3><?php echo $product['namaproduk'] ?></h3>
                    <br>
                    <p><?php echo $product['qty'] ?> Barang</p>
                    <br>
                    <p>Rp. <?php echo number_format($product['hargaafter'], 0, ',', '.') ?></p>
                    <br>
                    <a href="#" class="btn btn-success openReview" data-toggle="modal" data-target="#reviewModal" data-produk="<?php echo $product['idproduk'] ?>" data-order="<?php echo $order['orderid'] ?>">Beri Ulasan</a>
                  </div>
                </div>
              <?php
              }
              ?>
              <div class="panel-footer">
                <p style="margin-bottom: 10px;">Total Belanja</p>
                <h4>Rp. <?php echo number_format($subtotal, 0, ',', '.') ?></h4>
              </div>
            </div>
          <?php
          }
        }
        if ($checkNotReviews == false) {
          ?>
          <div class="panel panel-default" style="margin-bottom:100px">
            <div class="panel-body">
              <div class="col-md-12">
                <h3>Tidak ada produk yang belum diulas</h3>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
      <div class="tab-pane" id="2" style="margin-bottom: 150px">
        <?php
        $checkNotReviews = false;
        foreach ($dataOrders as $order) {
          if ($order['reviews']) {
            $checkNotReviews = true;
        ?>
            <div class="panel panel-default">
              <div class="panel-heading">Kode Order: <?php echo $order['orderid'] ?></div>
              <?php
              foreach ($order['reviews'] as $review) { ?>
                <div class="panel-body">
                  <div class="col-md-3">
                    <a href="product.php?idproduk=<?php echo $review['idproduk'] ?>">
                      <img src="<?php echo $review['gambar'] ?>" alt="<?php echo $review['namaproduk'] ?>" height="250" width="250">
                    </a>
                  </div>
                  <div class="col-md-9">
                    <br>
                    <h3><?php echo $review['namaproduk'] ?></h3>
                    <br>
                    <div class="review" style="display:block">
                      <?php
                      for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $review['rating']) {
                          echo '<span class="glyphicon glyphicon-star star"></span>';
                        } else {
                          echo '<span class="glyphicon glyphicon-star-empty"></span>';
                        }
                      }
                      ?>
                      <br>
                      <p class="content"><?php echo $review['content'] ?></p>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          <?php
          }
        }
        if ($checkNotReviews == false) {
          ?>
          <div class="panel panel-default" style="margin-bottom:100px">
            <div class="panel-body">
              <div class="col-md-12">
                <h3>Tidak ada ulasan</h3>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
  <!-- //review -->
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
        <p>© 2020 Wooden's Furniture. All rights reserved</p>
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

  <!-- Modal -->
  <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size: 35px">&times;</span></button>
          <h4 class="modal-title" id="reviewModalLabel">Berikan Rating</h4>
          <p class="text-dark">Berikan ulasan untuk produk ini</p>
        </div>
        <div class="modal-body">
          <form action="#" method="POST" class="rate py-3 mt-3">
            <input type="hidden" name="produkid" value="0">
            <input type="hidden" name="orderid" value="0">
            <input type="hidden" name="review" value="0">

            <div class="container">
              <div class="feedback">
                <div class="rating text-center">
                  <input type="radio" name="rating" value="5" id="rating-5">
                  <label for="rating-5"></label>
                  <input type="radio" name="rating" value="4" id="rating-4">
                  <label for="rating-4"></label>
                  <input type="radio" name="rating" value="3" id="rating-3">
                  <label for="rating-3"></label>
                  <input type="radio" name="rating" value="2" id="rating-2">
                  <label for="rating-2"></label>
                  <input type="radio" name="rating" value="1" id="rating-1">
                  <label for="rating-1"></label>
                  <div class="emoji-wrapper">
                    <div class="emoji">
                      <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                        <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534" />
                        <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff" />
                        <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347" />
                        <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63" />
                        <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff" />
                        <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347" />
                        <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63" />
                        <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347" />
                      </svg>
                      <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                        <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                        <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347" />
                        <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534" />
                        <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff" />
                        <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347" />
                        <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff" />
                        <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534" />
                        <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff" />
                        <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347" />
                        <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff" />
                      </svg>
                      <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                        <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                        <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347" />
                        <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff" />
                        <circle cx="340" cy="260.4" r="36.2" fill="#3e4347" />
                        <g fill="#fff">
                          <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10" />
                          <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z" />
                        </g>
                        <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347" />
                        <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff" />
                      </svg>
                      <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                        <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347" />
                        <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                        <g fill="#fff">
                          <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z" />
                          <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81" />
                        </g>
                        <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347" />
                        <g fill="#fff">
                          <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1" />
                          <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81" />
                        </g>
                        <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347" />
                        <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff" />
                      </svg>
                      <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <circle cx="256" cy="256" r="256" fill="#ffd93b" />
                        <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534" />
                        <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b" />
                        <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f" />
                        <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff" />
                        <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b" />
                        <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f" />
                        <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff" />
                        <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347" />
                        <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b" />
                      </svg>
                      <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <g fill="#ffd93b">
                          <circle cx="256" cy="256" r="256" />
                          <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z" />
                        </g>
                        <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4" />
                        <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea" />
                        <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88" />
                        <g fill="#38c0dc">
                          <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z" />
                        </g>
                        <g fill="#d23f77">
                          <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z" />
                        </g>
                        <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347" />
                        <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b" />
                        <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2" />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <p>Berikan ulasan untuk produk ini agar mitra lain dapat terbantu dengan ulasan kamu dan akan membantu kami untuk memantau vendor kami</p>

            <div class="form-group" style="margin-top: 20px">
              <label for="ulasanProduk" style="margin-bottom: 10px">Berikan Ulasan Produk</label>
              <textarea class="form-control" id="ulasanProduk" rows="3" placeholder="Tulis ulasanmu disini" name="ulasan" required></textarea>
            </div>

            <div class="buttons px-4 mt-0">
              <button class="btn btn-warning btn-block rating-submit">Kirim Ulasan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- //Modal -->

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
  </script>
  <!-- //main slider-banner -->

  <script type="text/javascript">
    $(".openReview").click(function() {
      var produkid = $(this).attr('data-produk');
      var orderid = $(this).attr('data-order');

      $("input[name='produkid']").val(produkid);
      $("input[name='orderid']").val(orderid);
    });
  </script>
</body>

</html>