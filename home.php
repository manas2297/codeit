<?php

include './class/DB.php';
include 'Login.php';
include './class/Post.php';
include './class/Comment.php';

if(Login::isLoggedIn())
{
	$userid=Login::isLoggedIn();
	$username=DB::query('SELECT username from users where id=:userid',array(':userid'=>$userid))[0]['username'];

	if(isset($_GET['postid' ])){
			Post::likePost($_GET['postid'],$userid);
	}
	if(isset($_POST['comment'])){
			Comment::createComment($_POST['commentbody'],$_GET['postid'],$userid);
	}

	
	$followingposts=DB::query('SELECT posts.id,posts.body,posts.likes,users.username FROM users,posts,followers WHERE posts.user_id = followers.user_id AND users.id=posts.user_id AND follower_id=:follower order by posts.likes desc',array(':follower'=>$userid));
	$posts="";

	foreach ($followingposts as $p) {
		if(!DB::query('SELECT post_id from post_likes where post_id=:postid and user_id=:userid',array(':postid'=>$p['id'],':userid'=>$userid))){

			$posts .= $p['body']." ~ ".$p['username']."<form action='home.php?postid=".$p['id']."' method='post'>
			<input type='submit' name='like' value='Like'>
			<span>".$p['likes']." likes</span>
			</form>
			<form action='home.php?postid=".$p['id']."'method='post'>
			<textarea name='commentbody' rows='4' cols='30' ></textarea>
			<input type='submit' name='comment' value='Comment'>

			</form><hr/>";
		}else {
			$posts .= $p['body']." ~ ".$p['username']."
			<form action='home.php?postid=".$p['id']."' method='post'>
			<input type='submit' name='unlike' value='Unlike'>
			<span>".$p['likes']." likes</span>
			</form>
			<form action='home.php?postid=".$p['id']."' method='post'>
			<textarea name='commentbody' rows='4' cols='30' ></textarea>
			<input type='submit' name='comment' value='Comment'>
			</form>
			<hr /></br/>";
		}
		# code...
	}
$follow=DB::query('SELECT user_id,users.username FROM users,followers WHERE followers.user_id=users.id AND followers.follower_id=:userid ',array(':userid'=>$userid));
$name="";
foreach ($follow as $f) {

	$name .= $f['username']."<br/><hr/>";

	# code...
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Josefin+Sans:700">
<link rel="stylesheet" type="text/css" href="css/w3.css">
<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

	<title>HOME</title>

<style >
	body,h1,h2,h3,h4,h5,h6 {font-family: 'Josefin Sans', sans-serif;}
body, html {
    			height: 100%;
   					 line-height: 1.4;
			}
			.w3-myFont{
	font-family: 'Josefin Sans', sans-serif;
	font-weight: 900;
	color: #626b82;
	text-decoration: none;
	list-style-type: none;
}
.log{
	border-color:#0088b7;
	border-width: 20px;
	color: #0088b7;
	background-color: #ffffff;
	text-decoration: none;
	}
.logo{
	height: 40px;
	width: 30px;
	vertical-align: middle;
	margin-top: 5px;
	margin-right: 10px;
}
.head {
		margin-bottom: 15px;
		margin-top: 15px;


	}

.w3-bar{
	box-shadow: 2px 2px 9px #888888;
}
.dashboard{
	
	border-bottom:2px solid #eee;
	margin-top:-20px;
	padding:20px;
	
}
.dashboard .dash{
	font-size:20px;
	font-weight:100;
	color:#a2a2a2;
}

.ques{
	margin-top:50px;
	}
.ques .container{
	border-bottom:1px solid #9b9b9b;
}
.ques .container section{
	font-weight:700;
	font-size:18px;
	color:#394353;
}
.q_box .container{
	
}

.box{
	margin-top:30px;
	border: 2px solid #4e5666;
	border-radius:8px;
	height:180px;
	
}

.b_head{
	padding-bottom:
	font-family: 'Montserrat', sans-serif;
	color:#2a7e37;
	margin:10px;
	border-bottom:1px solid #85878b;
}
.b_htext{
	font-weight:bold;
	margin-bottom:2px;
}
.image img {
	margin-left:10px;
	margin-top:15px;
	
}
.b_text{
	position:relative;
	left:70px;
	top: -40px;
	
}
.b_btn{
position:absolute;
	top:150px;
	left:0px;
	right:0px;
	
}
</style>
</head>
<body>
<div class="w3-top">
	<div class="w3-bar w3-myFont" style="background-color: #f8f9fa">

		<a href="home.php" class="w3-bar-item w3-wide w3-myFont"><img src="images/favicon.png" class="logo"> CodeIT</a>

		<a href="logout.php" class="w3-bar-item head w3-button w3-hover-blue w3-hover-text-white w3-round-large w3-margin-left w3-margin-right  w3-border log w3-right w3-border-blue" name="logout">Logout</a>

		<div class="w3-dropdown-hover w3-bar-item head w3-right w3-margin-left w3-margin-right w3-myFont w3-hover-text-blue">
			<a href="" class="w3-myFont head"><?php echo Login::getuser().' ' ;?><i class="fa fa-caret-down"></i>
			</a>
		 	<div class="w3-dropdown-content w3-card-2 w3-bar-block">
      		<a href="logout.php" class="w3-bar-item w3-myFont w3-hover-text-blue">Logout</a>
      		<a href="changepass.php" class="w3-bar-item w3-myFont w3-hover-text-blue">Change Password</a>
      		<a href="profile.php?username=<?php echo $username;?>" class="w3-bar-item w3-myFont w3-hover-text-blue">Profile</a>
      		</div>
		</div>
		<a href="school.html" class="w3-bar-item  head w3-hover-text-blue w3-myFont w3-right">For Schools</a>
		<a href="practice.html" class="w3-bar-item w3-hover-text-blue head w3-right w3-myFont">Practice</a>


	</div>
</div>


<div class="dashboard">
	<div class="container">
	<section class="dash">Dashboard</section>
	</div>
</div>

<div class="ques">
	<div class="container">
		<section>TRACKS</section>
		
		</div>
</div>

<div class="q_box">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="box">
					<div class="b_head">
						<h5 class="b_htext">Practice</h5>	
					</div>
					<div class="image">
						<img src="http://res.cloudinary.com/dshrduotu/image/upload/c_scale,w_40/v1502788571/practice_q59opj.png">
					</div>
					<div class="b_text">
						<p>Hone your programming skills.<br>Start Practice today.</p>
						
					</div>
					<div class="b_btn text-center">
						<button class="btn btn-success" type="button"><a href="practice.html">Practice</a></button>
					</div>
					</div>
				</div>
			
			
			<div class="col-sm-4">
				<div class="box">
					<div class="b_head">
						<h5 class="b_htext">Compette</h5>	
					</div>
					<div class="image">
						<img src="http://res.cloudinary.com/dshrduotu/image/upload/c_scale,h_50,w_45/v1502789479/compette_sa22yk.png">
					</div>
					<div class="b_text">
						<p>Challenge the Best in the World.<br>Join Competition</p>
						
					</div>
					<div class="b_btn text-center">
						<button class="btn btn-success" type="button">Compette</button>
					</div>
					</div>
					</div>
				
			
		
		<div class="col-sm-4">
				<div class="box">
					<div class="b_head">
						<h5 class="b_htext">Fast Track</h5>	
					</div>
					<div class="image">
						<img src="http://res.cloudinary.com/dshrduotu/image/upload/c_scale,h_40,w_50/v1502790122/ftrack_btggva.png">
					</div>
					<div class="b_text">
						<p>Speed Up your coding.</p>
						
					</div>
					<div class="b_btn text-center">
						<button class="btn btn-success" type="button">CodeIt</button>
					</div>
					</div>
				</div>
			
		</div>
		
	</div>
	
</div>
<hr>




</body>
</html>
<?php
}
else{
	die('404: Page not found.');
}
