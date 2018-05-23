<?php
include './class/DB.php';
include 'Login.php';

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" type="text/css" href="css/style.css">-->
<link rel="stylesheet" type="text/css" href="css/w3.css">
<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Josefin+Sans:700">

	<title>CodeIT</title>
	<style >
	body,h1,h2,h3,h4,h5,h6 {font-family: 'Josefin Sans', sans-serif;}
body, html {
    			height: 100%;
   					 line-height: 1.4;
			}
	.head {
		margin-bottom: 15px;
		margin-top: 15px;


	}

	.bgimg-1 {
		opacity: 0.75;
    background-position: center;
    background-size: cover;
    background-image: url("images/2.jpg");
    min-height: 550px;

	}
	.head1 a:hover{
	text-decoration: none;
	}
	.head1 .heading{
		font-family: 'Josefin Sans', sans-serif;
	}



		.log{

			border-color:#0088b7;
			border-width: 20px;
			color: #0088b7;
			background-color: #ffffff;
		}
		.w3-border{
			border-color: #0088b7;
		}
.w3-btn{
	background-color: #0088b7;
}


.w3-btn :hover{
	box-shadow: none;
}
.w3-row hr{
	margin-left: 100px;
	height: 3px;
	margin-right:100px;
}
.w3-myFont{
	font-family: 'Josefin Sans', sans-serif;
	font-weight: 900;
	color: #626b82;
	text-decoration: none;
	list-style-type: none;
}

.logo{
	height: 40px;
	width: 30px;
	vertical-align: middle;
	margin-top: 5px;
	margin-right: 10px;
}
.w3-bar{
	box-shadow: 2px 2px 9px #888888;
}
.w3-foot{
	text-decoration: none;
	list-style-type: none;
	font-size: 10px;
	color: #626b82;
	font-weight: bold;


}

.frm input[type="text"],input[type="password"],input[type="email"]{
	width: 250px;
}


</style>


</head>
<body>

<!--Navigation Bar -->
<div class="w3-top">
	<div class="w3-bar w3-myFont" style="background-color: #f8f9fa;">
		<a href="index.php" class="w3-bar-item w3-wide w3-myFont"><img src="images/favicon.png" class="logo"> CodeIT</a>


		<a href="signup.php" class="w3-bar-item head w3-btn w3-right w3-round-large w3-margin-left w3-margin-right w3-text-white ">Sign Up</a>

		<a href="login.php" class="w3-bar-item head w3-button w3-hover-blue w3-hover-text-white w3-round-large w3-margin-left w3-margin-right  w3-border log w3-right w3-border-blue">Log In</a>




		<a href="school.html" class="w3-bar-item  head w3-hover-text-blue w3-myFont w3-right">For Schools</a>
		<a href="practice.html" class="w3-bar-item w3-hover-text-blue head w3-right w3-myFont">Practice</a>
	</div>
</div>
<!-- End Of Navigation-->

<!--Header -->

<header class="bgimg-1 head1 w3-display-container w3-grayscale-min" id="home">

	<div class=" w3-text-white " style="padding: 50px">
		<span class=" heading w3-jumbo w3-display-topmiddle w3-text-white" style="padding-top: 100px">Code.Practice.Compete</span>
		<span class=" heading w3-large w3-display-topmiddle w3-text-white" style="padding-top: 180px">while(<strong style="color: #0088b7; opacity: 100%;">!SUCCESS</strong>){cout<<"<strong style="color: #0088b7; opacity: 1.0;">PRACTICE</strong>";}</span><br>

		<div class="w3-card-2 frm">
			<form class=" w3-container w3-display-topmiddle" action="signup.php" style="padding-top: 250px">

				<input class="w3-input w3-round-large" type="text" name="username" placeholder="First & Last name">

				<p>
					<input class="w3-input w3-round-large" type="email" name="email" placeholder="Email">
				</p>
				<p>
					<input class="w3-input w3-round-large" type="password" name="password" placeholder="********">
				</p>
				<p>
					<input class="w3-button w3-black w3-hover-blue w3-hover-text-white w3-round-large"  name="caccount" value="Sign Up & Start Coding" type="submit">
				</p>
			</form>
		</div>
	</div>
</header>

<!--End of Header-->

<!--Description-->
<div class=" w3-myFont w3-row w3-center" style="margin-top: 40px;">
  <div class="w3-col brd l6 w3-border-right w3-border-grey" >
  		<img src="images/trophy.png" class="w3-center">
  		<h3 class="w3-center">Competition</h3>
  		<p class="w3-center t1">Compete with Thousands of students.<br>
  			An opurtunity to showcase your skills.
  		</p>
  		<button class="w3-btn w3-round-large w3-text-white">Learn More</button>
  		<hr/>
  		<p >
  			<img src="images/text.png" class="w3-center">
  		</p>
	</div>



  <div class="w3-col l6">
  		<img src="images/bag.png" class="w3-center">
  		<h3 class="w3-center">Schools</h3>
  		<p class="w3-center t1 w3-panel">CodeIT is an initiative to enhance<br>
  									the thinking and creative skills in students.
  		</p>
  		<button class="w3-btn w3-round-large w3-text-white">Learn More</button>
  		<hr/>

  		<p>
  		<img src="images/text2.png" class="w3-center">
  		</p>
    </div>
</div>
<!--End of Description-->
<hr style="margin-top: 100px;"/>


<div class="footer"  style="background-color: #2C3E50; margin-top: -20px;">
<div class="w3-row">
<div class="w3-container w3-third">
	<img src="images/foot.png" class="w3-margin-bottom w3-responsive w3-margin-top" style="margin-left: 50px;">
</div>

<div class="w3-container  w3-text-white w3-third">
	<p>

		<div class="w3-foot w3-text-white" >
		<h6 class="w3-bold w3-text-white" style="font-weight: 900;font-size: 11px;">COMPANY</h6>
		<li>About Us</li>

		<li>Contact Us</li>

		<li>Blog</li>

		<li>Career</li>
		</div>
	</p>

</div>
<div class="w3-container  w3-third">
	<p>

		<div class="w3-foot w3-text-white" >
		<h6 class="w3-bold w3-text-white" style="font-weight: 900;font-size: 11px;">COMPANY</h6>
		<li>About Us</li>

		<li>Contact Us</li>

		<li>Blog</li>

		<li>Career</li>
		</div>
	</p>

</div>
</div>
</div>






<!--Latest compiled and minified javascript-->
<script src="js/jquery-3.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>
