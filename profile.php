<?php

include './class/DB.php';
include 'Login.php';
include './class/Post.php';

$username="";
$isFollowing=false;
$userid=DB::query('SELECT id from users where username=:username',array(':username'=>$_GET['username']))[0]['id'];
				$followerid=Login::isLoggedIn();

if(Login::isLoggedIn()){
		if (isset($_GET['username'])) {
					if(DB::query('SELECT username from users where username=:username',array(':username'=>$_GET['username']))){
							$username=DB::query('SELECT username from users where username=:username',array(':username'=>$_GET['username']))[0]['username'];
							if (isset($_POST['follow'])) {
									if($userid!=$followerid){
											if (!DB::query('SELECT follower_id from followers where user_id=:userid and follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$followerid))) {
													DB::query('INSERT into followers (user_id,follower_id) values (:userid,:followerid)',array(':userid'=>$userid,':followerid'=>$followerid));
											}else{
														echo "Already Following!!";
													}
													$isFollowing=true;
									}
							}


			if (isset($_POST['unfollow'])) {
					if($userid!=$followerid){
						if (DB::query('SELECT follower_id from followers where user_id=:userid and follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$followerid))) {
							DB::query('DELETE from followers where user_id=:userid and follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$followerid));
							$isFollowing=false;
						}
					}
			}

			if (DB::query('SELECT follower_id from followers where user_id=:userid and follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$followerid))) {
				$isFollowing=true;
			}


			if (isset($_POST['deletepost'])) {
				if(DB::query('SELECT id from posts where id=:postid and user_id=:userid',array(':postid'=>$_GET['postid'],':userid'=>$followerid))){
					DB::query('DELETE from posts where id=:postid and user_id=:userid',array(':postid'=>$_GET['postid'],':userid'=>$followerid));
					DB::query('DELETE from post_likes where post_id=:postid',array(':postid'=>$_GET['postid']));
					DB::query('DELETE from comments where post_id=:postid',array(':postid'=>$_GET['postid']));
				}
			}

			if(isset($_POST['post'])){
						Post::createPost($_POST['postbody'],Login::isLoggedIn(),$userid);
			}




				if(isset($_GET['postid']) && !isset($_POST['deletepost'])){
						Post::likePost($_GET['postid'],$followerid);
				}

			$posts = Post::displayPosts($userid,$username,$followerid);

		}else{
			echo "<script>alert('User not found!!!')</script>";
		}

	}else{
		echo "<script>alert('User not found!!!')</script>";
	}
}else{
	echo "<script>alert('Login to see that page.')</script>";
	header('Location:http://localhost/summer_project/login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $username; ?></title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">

	<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
</head>
<style type="text/css">
	body{
		background: #d0d0d0;
	}
</style>
<body>
<div class="container">
<h1><?php echo $username; ?>'s Profile</h1>

<form action="profile.php?username=<?php echo $username;?>" method="post">
	<?php
	if($userid!=$followerid){

		if ($isFollowing==true) {
			echo '<input type="submit" name="unfollow" value="Unfollow">';
		}else{
			echo '<input type="submit" name="follow" value="Follow">';
		}
	}
	?>
</form>
<form action="profile.php?username=<?php echo $username;?>" method="post">
	<textarea name="postbody" id="post_b" rows="8" cols="80" ></textarea>
	<input type="submit" id="sub" name="post" value="Post">


</form>
<div class="container">
	<div class="posts ">
		<?php echo $posts; ?>
	</div>
</div>
</div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="profile.js"></script>

</body>
</html>
