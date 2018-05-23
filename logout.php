<?php
include 'Login.php';
include './class/DB.php';

if (!Login::isLoggedIn()) {
	# code...
	die('Not Logged in!!');
}

if (isset($_COOKIE['SNID'])) {

		DB::query('DELETE from login_tokes where user_id=:userid',array(':userid'=>Login::isLoggedIn()));
		setcookie('SNID','1',time()-3600);
		setcookie('SNID_','1',time()-3600);
	}



header('Location:login.php');

?>
