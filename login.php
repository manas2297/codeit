<?php
	include './class/DB.php';

	if (isset($_POST['login'])) {
		# code...
		$username=$_POST['username'];
		$password=$_POST['password'];

		if (DB::query('SELECT username From users Where username=:username', array(':username'=>$username))) {
			# code...
			if(password_verify($password,DB::query('SELECT password From users where username=:username',array(':username' =>$username))[0]['password'])){

				$cstrong=True;
				$token=bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
				$user_id=DB::query('SELECT id from users where username=:username',array(':username'=>$username))[0]['id'];
				DB::query('INSERT into login_tokes (token,user_id) VALUES (:token,:user_id)',array(':token'=>sha1($token),':user_id'=>$user_id));
				setcookie("SNID",$token,time()+60*60*24*7,'/',NULL,NULL,True);
				setcookie("SNID_",'1',time()+60*60*24*3,'/',NULL,NULL,True);
				header('Location:http://localhost/summer_project/home.php');


			}else
			{
				echo "<script>alert('Incorrect Password!!');</script>";
			}

		}else{
			echo "<script>alert('User Not Registered!!');</script>";
		}
	}


?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">


	 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
	<title>Login</title>
	<style type="text/css">
		body{
	background-image: url('images/log.jpg') ;
	background-size: cover;
	-webkit-background-size:cover;
	-moz-background-size:cover;
	-o-background-size:cover;
	-ms-background-size:cover;

}
.example3 .navbar-brand{
	height: 80px;

}
.example3 .nav >li >a{
	padding-top: 30px;
	padding-bottom: 30px;
}
.example3 .navbar-toggle{
	padding: 10px;
	margin:25px 15px 25px 0;
}
.login_frm .container .row .col-md-4 >header{
	padding: 10px;
	background-color: #e74c3c;
	margin-bottom:20px;
	margin-left: -15px;
	margin-right: -15px;
	border-radius: 2px;

}
.login_frm .container .row .col-md-4 >header >h3{
	font-family: 'Josefin Sans', sans-serif;
	color: white;
	letter-spacing: 2px;
	text-transform: uppercase;
	font-size: 20px;
	font-weight: 400;
	text-align: center;

}
.login_frm .container .row .wrap-login{
	background: rgba(250,250,250, 0.85);
	border:1px solid #d0d0d0;
	margin-top: 100px;
	border-radius: 2px;
	padding-bottom: 50px;
	-webkit-box-shadow: -1px -1px 35px -1px rgba(255,255,255,0.5);
-moz-box-shadow: -1px -1px 35px -1px rgba(255,255,255,0.5);
box-shadow: -1px -1px 35px -1px rgba(255,255,255,0.5);
background-o
}
.login_frm .container .row .wrap-login >form >button{

	margin-top: 10px;
	padding-right: 5px;
	width: 71px;
	overflow: hidden;
	 -webkit-transition: All 0.5s ease;
  -moz-transition: All 0.5s ease;
  -o-transition: All 0.5s ease;
  -ms-transition: All 0.5s ease;
  transition: All 0.5s ease;


}
.login_frm .container .row .wrap-login >form >button:hover{
	width: 360px;
}
.w3-myFont{
	font-family: 'Josefin Sans', sans-serif;
	font-weight: 900;
	color: #626b82;
	text-decoration: none;
	list-style-type: none;
}


	</style>




</head>
<body>
<!--navigation-->
<div class="example3">
<nav class="navbar navbar-inverse navbar-static-top">
 	<div class="container">
 		<div class="navbar-header">
 			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
 			</button>
 			<a href="index.php" class="navbar-brand" style="vertical-align: middle;"><img src="images/favicon.png" alt="CODEIT" style="height: 50px; width: auto; float: left;"></a>
 		</div>

 		<div id="navbar3" class="navbar-collapse collapse">
 			<ul class="nav navbar-nav navbar-right w3-myFont">
 				<li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				<li><a href="school.php">For Schools</a></li>
				<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
			</ul>
 		</div>
	</div>
</nav>
</div>
<!-- End Navigation-->

<!--Login Form-->
<div class="login_frm">
	<div class="container">
		<div class="row">
			<div class="wrap-login col-md-4 col-md-offset-4">
			<header>
				<h3>Login To Your Account</h3>
			</header>
				<form action="login.php" method="post">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" name="username" class="form-control" id="" placeholder="Username" required="">

					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" name="password" class="form-control" id="" placeholder="********" required="">

					</div>
					<div class="checkbox">
						<label>
						<input type="checkbox"> Remember Me
						</label>
					</div>
					<button type="submit" name="login" class="login-btn btn btn-primary"><span class="glyphicon glyphicon-log-in"></span>      Login  & Start Coding Now</button>
				</form>

			</div>

		</div>

	</div>


</div>
<!--Latest compiled and minified javascript-->
<script src="js/jquery-3.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
