<?php
include 'Login.php';
include './class/DB.php';


if (Login::isLoggedIn()) {

	if (isset($_POST['change'])) {
		$oldpassword=$_POST['oldpassword'];
		$newpassword=$_POST['newpassword'];
		$newpasswordrepeat=$_POST['newpasswordrepeat'];
		$userid=Login::isLoggedIn();

		if(password_verify($oldpassword,DB::query('SELECT password From users where id=:userid',array(':userid' =>$userid))[0]['password'])){
			if ($newpassword== $newpasswordrepeat) {

					if(strlen($newpassword)>=6&&strlen($newpassword)<=60){

						DB::query('UPDATE users Set password=:newpassword where id=:userid', array(':newpassword'=>password_hash($newpassword,PASSWORD_BCRYPT),':userid'=>$userid));
						echo "<script>alert('Password changed Successfully!!');</script>";

					}
			}else{
				echo "<script>alert('Password Do not match');</script>";
			}

		}else{
		echo "<script>alert('Incorrect old Password!');</script>";
		}
	}
}

else{
	die('404:page not found');
}
?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Change Password</title>
		<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">

    <style type="text/css">
		.pcenter {
     position: absolute;
     top: 50%;
     left:50%;
     transform: translate(-50%,-50%);

   }

	</style>
	</head>


	<body>


	<div class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a  class="navbar-brand" href="home.php">CodeIT</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="#">About</a></li>


				i>Logout</li>


		</div>

	</div>


	<div class="container">
	<div class="pcenter">
	<div class="jumbotron">
	<h2>Change Password</h2>

		<form action="changepass.php" method="post">
			<div class="form-group">
			<input type="password" name="oldpassword" value="" placeholder="Old Password" class="form-control">
			</div>
			<div class="form-group">
			<input type="password" name="newpassword" placeholder="New Password.." class="form-control">
			</div>
			<div class="form-group">
			<input type="password" name="newpasswordrepeat" placeholder="Confirm new password" class="form-control">
			</div>
			<button type="submit" name="change" class="btn btn-primary">Change Password</button>

		</form>


	</div>
	</div>




<!--Latest compiled and minified javascript-->
<script src="js/jquery-3.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>

	</body>
	</html>
