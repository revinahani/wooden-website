<?php
session_start();

if(!isset($_SESSION['log'])){

} else {
	header('location:index.php');
};

include 'dbconnect.php';
date_default_timezone_set("Asia/Bangkok");
$timenow = date("j-F-Y-h:i:s A");

	if(isset($_POST['login']))
	{
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$pass = mysqli_real_escape_string($conn,$_POST['pass']);
	$queryuser = mysqli_query($conn,"SELECT * FROM user WHERE email='$email'");
	$cariuser = mysqli_fetch_assoc($queryuser);

		if( password_verify($pass, $cariuser['password']) ) {
			$_SESSION['id'] = $cariuser['userid'];
			$_SESSION['role'] = $cariuser['role'];
			$_SESSION['notelp'] = $cariuser['notelp'];
			$_SESSION['name'] = $cariuser['namalengkap'];
			$_SESSION['log'] = "Logged";
			header('location:index.php');
		} else {
			echo 'Username atau password salah';
			header("location:login.php");
		}
	}

?>

!<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/css/bootstrap.css">
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

      .btn {
        margin-top: 25%;
        font-size: 20px;
        height: 55px;
        width: 150px;
        background-color: #00aeff;

        &:hover {
          background-color: #008bcc;
        }
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

         <div class="create-account">
           <h1>Login</h1>
           <form role="form" method="post">
             <div class="tog1">
             <div class="form-group">
               <label for="username">username:</label>
               <input type="text" name="email"  class="form-control input-md" id="email">
             </div>
             </div>
             <div class="tog">
             <div class="form-group">
               <label for="pwd">Password:</label>
               <input type="password" name="pass" placeholder="Password" required class="form-control input-md" id="pwd">
             </div>
             </div>

             <button type="submit" name="login" value="Masuk" class="center-block btn  btn-default">Continue  <i class="glyphicon glyphicon-chevron-right"> </i> </button>
           </form>
       </div>
       </div>
       <div class="signup-right" >

       </div>
      </div>
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" charset="utf-8"></script>
</html>
