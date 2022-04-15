
<?php 
	session_start();
	include '../dbconnect.php';
		
	if(isset($_POST['addKaryawan']))
	{
		$namaKaryawan = $_POST['namaKaryawan'];
        $gambar = $_POST['gambar'];
        $tanggalLahirKaryawan = $_POST['tanggalLahirKaryawan'];
        $idAsal = $_POST['idAsal'];
        $teleponKaryawan = $_POST['teleponKaryawan'];
        $tanggalMasukKaryawan = $_POST['tanggalMasukKaryawan'];
        $statusKaryawan = $_POST['statusKaryawan'];
        $usernameKaryawan = $_POST['usernameKaryawan'];
		$passwordKaryawan = password_hash($_POST['passwordKaryawan'], PASSWORD_DEFAULT); 
			  
		$tambahKaryawan = mysqli_query($conn,"insert into karyawan_adminitrasi (namaKaryawan, gambar, tanggalLahirKaryawan, idAsal, teleponKaryawan, tanggalMasukKaryawan, statusKaryawan, keterangan, usernameKaryawan, passwordKaryawan)
        values('$namaKaryawan','$gambar','$tanggalLahirKaryawan','$idAsal', '$teleponKaryawan','$tanggalMasukKaryawan','$statusKaryawan','$keterangan','$usernameKaryawan','$passwordKaryawan')");
		if ($tambahKaryawan){
		echo " <div class='alert alert-success'>
			Berhasil menambahkan staff baru.
		  </div>
		<meta http-equiv='refresh' content='1; url= user.php'/>  ";
		} else { echo "<div class='alert alert-warning'>
			Gagal menambahkan staff baru.
		  </div>
		 <meta http-equiv='refresh' content='1; url= user.php'/> ";
		}
		
	};
	?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
	<link rel="icon" 
      type="image/png" 
      href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kelola Karyawan - Wooden</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
	
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	<!-- Start datatable css -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
							<li><a href="index.php"><span>Home</span></a></li>
							<li><a href="../"><span>Kembali ke Toko</span></a></li>
							<li>
                                <a href="manageorder.php"><i class="ti-dashboard"></i><span>Kelola Pesanan</span></a>
                            </li>
							<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Kelola Toko
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="kategori.php">Kategori</a></li>
                                    <li><a href="produk.php">Produk</a></li>
									<li><a href="pembayaran.php">Metode Pembayaran</a></li>
                                </ul>
                            </li>
							<li><a href="customer.php"><span>Kelola Pelanggan</span></a></li>
							<li class="active"><a href="user.php"><span>Kelola Staff</span></a></li>
                            <li>
                                <a href="../logout.php"><span>Logout</span></a>
                                
                            </li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li><h3><div class="date">
								<script type='text/javascript'>
						<!--
						var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
						var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
						var date = new Date();
						var day = date.getDate();
						var month = date.getMonth();
						var thisDay = date.getDay(),
							thisDay = myDays[thisDay];
						var yy = date.getYear();
						var year = (yy < 1000) ? yy + 1900 : yy;
						document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);		
						//-->
						</script></b></div></h3>

						</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            
            <!-- page title area end -->
            <div class="main-content-inner">
               
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Daftar Karyawan</h2>
                                    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah Karyawan</button>
									</div>
                                    <div class="data-tables datatable-dark">
										 <table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
												<th>No.</th>
												<th>Nama</th>
												<th>Foto Profil</th>
												<th>Tanggal Lahir</th>
												<th>Alamat</th>
                                                <th>No Telepon</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Status Karyawan</th>
                                                <th>Keterangan</th>
                                                <th>Username</th>
                                                <th>Password</th>

											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from karyawan_adminitrasi order by idKaryawan ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
                                                $id = $p['idKaryawan'];

												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['namaKaryawan'] ?></td>
													<td><?php echo $p['gambar'] ?></td>
													<td><?php echo $p['tanggalLahirKaryawan'] ?></td>
													<td><?php echo $p['idAsal'] ?></td>
                                                    <td><?php echo $p['teleponKaryawan'] ?></td>
                                                    <td><?php echo $p['tanggalMasukKaryawan'] ?></td>
                                                    <td><?php echo $p['statusKaryawan'] ?></td>
                                                    <td><?php echo $p['keterangan'] ?></td>
                                                    <td><?php echo $p['usernameKaryawan'] ?></td>
                                                    <td><?php echo $p['passwordKaryawan'] ?></td>
                                                
													
												</tr>		
												
												
												<?php 
											}
													
											?>
										</tbody>
										</table>
                                    </div>
								 </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>By Wooden Furniture</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
	
			<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Tambah Karyawan Baru</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Nama</label>
									<input name="namaKaryawan" type="text" class="form-control" placeholder="Nama" required autofocus>
								</div>
								<div class="form-group">
									<label>Foto Karyawan</label>
									<input name="gambar" type="file" class="form-control" placeholder="Foto Karyawan">
								</div>
                                <div class="form-group">
									<label>Tanggal Lahir</label>
									<input name="tanggalLahirKaryawan" type="date" class="form-control" placeholder="Tanggal lahir" required autofocus>
								</div>
                                <div class="form-group">
									<label>Asal</label>
									<input name="idAsal" type="text" class="form-control" placeholder="Asal Tinggal" required autofocus>
								</div>
                                <div class="form-group">
									<label>No Telepon</label>
									<input name="teleponKaryawan" type="text" class="form-control" placeholder="No Telepon" required autofocus>
								</div>
                                <div class="form-group">
									<label>Tanggal Masuk Karyawan</label>
									<input name="tanggalMasukKaryawan" type="date" class="form-control" placeholder="Tanggal Masuk Karyawan" required autofocus>
								</div>
                                <div class="form-group">
									<label>Status Karyawan</label>
                                        <select id="statusKaryawan" name="statusKaryawan">
    						                <option value="Aktif">Aktif</option>
    						                <option value="Cuti">Cuti</option>
                                            <option value="Pensiun">Pensiun</option>
						                </select>
								</div>
                                <div class="form-group">
									<label>Keterangan</label>
									<input name="keterangan" type="text" class="form-control" placeholder="Keterangan" required autofocus>
								</div>
                                <div class="form-group">
									<label>Username</label>
									<input name="usernameKaryawan" type="text" class="form-control" placeholder="Username Karyawan" required autofocus>
								</div>
                                <div class="form-group">
									<label>Password</label>
									<input name="passwordKaryawan" type="password" class="form-control" placeholder="Password" required autofocus>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="addKaryawan" type="submit" class="btn btn-primary" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
	<script>
	$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
	} );
	</script>
	
	<!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
		<!-- Start datatable js -->
	 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
	
</body>
</html>
