<?php

include './class/DB.php';

	if (isset($_POST['caccount'])) {

		# code...
		$username=$_POST['username'];
		$password=$_POST['password'];
		$email=$_POST['email'];

		if (!DB::query('SELECT username from users Where username=:username', array(':username' =>$username ))) {

			if(strlen($username)>= 3 && strlen($username)<=32){

				if(preg_match('/[a-zA-Z0-9_]+/', $username)){

					if(strlen($password)>=6&&strlen($password)<=60){

						if(filter_var($email,FILTER_VALIDATE_EMAIL)){

							if(!DB::query('SELECT email from users where email=:email',array(':email'=>$email))){

							DB::query('INSERT INTO users (username,password,email) VALUES (:username,:password,:email)', array(':username'=>$username,':password'=>password_hash($password,PASSWORD_BCRYPT),':email'=>$email));

							header('Location:http://localhost/summer_project/login.php');
							}else{
								echo "<script>alert('Email Already Registered.')</script>";
							}
						}else{
						echo "<script>alert('Invalid Email.')</script>";
						}
					}else{
						echo "<script>alert('Invalid Password.')</script>";
					}
				}else {
					echo "<script>alert('Invalid Username.')</script>";
				}
			}else{
				echo "<script>alert('Invalid Username.')</script>";
			}

		}else {
			# code...
			echo "<script>alert('Username Already Exists.')</script>";
		}
	}



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Josefin+Sans:700">

	 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
	<title>Create Account</title>

	<style >
	body{
	background-image: url('images/sig.jpg') ;
	background-size: auto;
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


.login_frm .container .row .col-md-6 >header{
	padding: 10px;
	background-color: #e74c3c;
	margin-bottom:20px;
	margin-left: -15px;
	margin-right: -15px;
	border-radius: 2px;

}
.login_frm .container .row .col-md-6 >header >h3{
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
	align-items: center;



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
 				<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				<li><a href="school.php">For Schools</a></li>
				<li class="active"><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>

			</ul>

 		</div>
	</div>
</nav>
</div>
<!-- End Navigation-->
<!--
<div class="w3-top">
	<div class="w3-bar w3-myFont" style="background-color: #f8f9fa;">
		<a href="index.php" class="w3-bar-item w3-wide w3-myFont"><img src="images/favicon.png" class="logo"> CodeIT</a>


		<a href="login.php" class="w3-bar-item head w3-button w3-hover-blue w3-hover-text-white w3-round-large w3-margin-left w3-margin-right  w3-border log w3-right w3-border-blue">Log In</a>

		<a href="school.html" class="w3-bar-item  head w3-hover-text-blue w3-myFont w3-right">For Schools</a>
		<a href="practice.html" class="w3-bar-item w3-hover-text-blue head w3-right w3-myFont">Practice</a>
	</div>
</div>
-->


<div class="login_frm" >
	<div class="container">
		<div class="row">
			<div class=" wrap-login col-md-6 col-md-offset-3">
				<header>
				<h3>Get Registered</h3>
			</header>
			<form action="signup.php" method="post">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" name="username" class="form-control" id="" placeholder="Username" required="">

					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" name="password" class="form-control" id="" placeholder="********" required="">

					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" class="form-control" name="email" placeholder="Enter your email" required="">

					</div>

					<button type="submit" name="caccount" class="login-btn btn btn-danger"><span class="glyphicon glyphicon-user"></span> Submit</button>

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
