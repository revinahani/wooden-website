<?php
session_start();
if(!isset($_SESSION['log'])){

} else {
	header('location:index.php');
};
include 'dbconnect.php';

if(isset($_POST['adduser']))
	{
		$nama = $_POST['nama'];
		$telp = $_POST['telp'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];
		$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

		$tambahuser = mysqli_query($conn,"insert into user (namalengkap, email, password, notelp, alamat)
		values('$nama','$email','$pass','$telp','$alamat')");
		if ($tambahuser){
		echo " <div class='alert alert-success'>
			Berhasil mendaftar, silakan masuk.
		  </div>
		<meta http-equiv='refresh' content='1; url= login.php'/>  ";
		} else { echo "<div class='alert alert-warning'>
			Gagal mendaftar, silakan coba lagi.
		  </div>
		 <meta http-equiv='refresh' content='1; url= registered.php'/> ";
		}

	};

?>

!<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title></title>
    <style media="screen">
    h1 {
      margin-bottom: 50px;
      }
      body{
      background-color:#a99066;
      }

      .signup-page {
        height: 100%;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        overflow: hidden;
      }

      .signup-left {
      height: 100%;
      background-color: rgba(255, 255, 255, 1);
      color: #434245;
      width: 50%;
      min-width: 486px;
      float: left;
      z-index: 1;
      overflow-y: auto;
      }
      .signup-right{
        height: 100%;
        width:50%;
        background-color: #a99066 !important;
        min-width: 486px;
          float: right;
          z-index: 1;
					background:url('')
      }

      @media(max-width: 769px) {
      .signup-left {
      background-color: rgba(255, 255, 255, 0.2);
      }
      }

        .header {
        width: 100%;
        z-index: 2px;
      }

      #logo {
        margin: 10px 30px;
        height: 30px;
        height: 60px;
      }

      .create-account {
        margin-top: 30%;
        padding: 0 60px;
        position: relative;
        align-self: center;
        max-width: 100%;
      }

      form {
        margin-top: 20px;
      }



      @media (max-height: 900px) {

      h1 {
          font-size: 25px;
          margin-bottom: 15px;
        }

      .create-account {
            margin-top: 15%;
          }
          .btn {
          margin-top: 5%;
        }
      }

      @media (max-width: 767px) {

        h1 {
          font-size: 30px;
          margin-bottom: 0;
        }
          .signup-left {
              height: 100%;
              width: 100%;
              overflow-x: auto;
          }

          .create-account {
            margin-top: 0;
            padding: 0 30px;
            position: absolute;
            width: 100%;
          }

        .btn {
          margin-top: 5%;
        }
      }
    </style>
  </head>
  <body>
    <div class="signup-page">
       <div class="signup-left">
         <div class="header">
            <h2 id="logo"> <a href="index.php">WOODEN</a> </h2>
         </div>

         <div class="register">
       		<div class="container">
       			<h2>Daftar Disini</h2>
       			<div class="login-form-grids">
       				<h5>Informasi Pribadi</h5>
       				<form method="post">
                <div class="form-group row">
                  <div class="col-sm-2 m-auto">
                    <label >Nama</label>
                  </div>
                  <div class="col-sm-10">
                    <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-2 m-auto">
                    <label >Nomor Telepon</label>
                  </div>
                  <div class="col-sm-10">
                    <input class="form-control" type="text" name="telp" placeholder="Nomor Telepon" required maxlength="13">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-2 m-auto">
                    <label >Alamat Lengkap</label>
                  </div>
                  <div class="col-sm-10">
                    <input class="form-control" type="text" name="alamat" placeholder="Alamat Lengkap" required>
                  </div>
                </div>
       				  <h4 class="pb-2">Informasi Login</h4>
                <div class="form-group row">
                  <div class="col-sm-2 m-auto">
                    <label >Email</label>
                  </div>
                  <div class="col-sm-10">
                    	<input class="form-control" type="email" name="email" placeholder="Email" required="@">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-2 m-auto">
                    <label >Password</label>
                  </div>
                  <div class="col-sm-10">
                    	<input class="form-control" type="password" name="pass" placeholder="Password" required>
                  </div>
                </div>

       					<input class="btn btn-primary" type="submit" name="adduser" value="Daftar"> <a href="index.php">Batal</a>
       				</form>
       			</div>

       		</div>
       	</div>
       </div>
       <div class="signup-right" >

       </div>
      </div>
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" charset="utf-8"></script>
</html>
