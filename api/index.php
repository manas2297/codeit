<?php
require_once('DB.php');

$db=new DB("127.0.0.1","snetwork","root","1234567");
if ($_SERVER['REQUEST_METHOD']=='GET') {
  # code...
  if($_GET['url']=="auth"){

  }else if($_GET['url']=="users"){

  }else if($_GET['url']=="posts"){

    $token = $_COOKIE['SNID'];
    $userid = $db->query('SELECT user_id from login_tokes where token=:token',array(":token"=>sha1($token)))[0]['user_id'];

    $followingposts=$db->query('SELECT posts.id,posts.body,posts.likes,users.username FROM users,posts,followers WHERE posts.user_id = followers.user_id AND users.id=posts.user_id AND follower_id=:follower order by posts.likes desc',array(':follower'=>$userid));
  $posts="";

  foreach ($followingposts as $p) {
    if(!$db->query('SELECT post_id from post_likes where post_id=:postid and user_id=:userid',array(':postid'=>$p['id'],':userid'=>$userid))){

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
  }
 
}
else if ($_SERVER['REQUEST_METHOD']=='POST') {
  # code...
  
  if ($_GET['url']="auth" ) {
      $postbody = file_get_contents("php://input");
      $postbody = json_decode($postbody);
      $username=$postbody->username;
      $password=$postbody->password;
      if($db->query('SELECT username From users Where username=:username', array(':username'=>$username))){
        if(password_verify($password,$db->query('SELECT password From users where username=:username',array(':username' =>$username))[0]['password'])){

          $cstrong=True;
  				$token=bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
  				$user_id=$db->query('SELECT id from users where username=:username',array(':username'=>$username))[0]['id'];
  				$db->query('INSERT into login_tokes (token,user_id) VALUES (:token,:user_id)',array(':token'=>sha1($token),':user_id'=>$user_id));
          echo '{"Token":"'.$token.'"}';
        }else {
          echo '{"Error":"Invalid Username and Password"}';
          http_response_code(401);

        }
      }else {
          echo '{"Error":"Invalid Username and Password"}';
        http_response_code(401);
      }
  }
}else if ($_SERVER['REQUEST_METHOD']=="DELETE"){
  if ($_GET['url']=="auth" ){
    if(isset($_GET['token'])){
      if($db->query("SELECT token from login_tokes where token=:token",array(':token'=>sha1($_GET['token'])))){
          $db->query('DELETE from login_tokes where token=:token',array(':token'=>sha1($_GET['token'])));
          echo '{"Status":"Success"}';
          http_response_code(200);
      }else {
        echo '{"Status":"invalid token"}';
        http_response_code(400);
      }
  }else {
    echo '{"Status":"Error"}';
    http_response_code(400);
  }
  }
}
else {
  http_response_code(405);
}


?>
