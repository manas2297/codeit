<?php
	
	include 'DB.php';

	$userdata=DB::query('SELECT * from users');


	//var_dump($userdata);

	 $manas=  json_encode($userdata);

	echo $manas;


?>