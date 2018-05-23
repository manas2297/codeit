<?php
class Post{

   public static function createPost($postbody,$loggedInUserId,$profileUserId){

      if( strlen($postbody)>200 || strlen($postbody)<1 ){
        echo "<script>alert('Enter Post content correctly(<200 and >1)')</script>";
      }else{

        if($loggedInUserId==$profileUserId){
          DB::query('INSERT into posts(body,posted_at,user_id,likes) values (:postbody,NOW(),:userid,0)',array(':postbody'=>$postbody,':userid'=>$profileUserId));
        }else{
          die('You cannot post here');
        }
   }
 }

    public static function likePost($postid, $likerid){
      if(!DB::query('SELECT user_id from post_likes where post_id=:postid and user_id=:userid',array(':postid'=>$postid,':userid'=>$likerid))){
        DB::query('UPDATE posts set likes=likes+1 where id = :postid',array(':postid'=>$postid));
        DB::query('INSERT INTO post_likes(post_id,user_id) values (:postid,:userid)',array(':postid'=>$postid,':userid'=>$likerid));
      }else {
        DB::query('UPDATE posts set likes=likes-1 where id = :postid',array(':postid'=>$postid));
        DB::query('DELETE from post_likes where post_id=:postid and user_id=:userid',array(':postid'=>$postid,':userid'=>$likerid));
      }
    }

    public static function displayPosts($userid,$username,$loggedInUserId)
    {
      $dbposts= DB::query('SELECT * from posts where user_id=:userid order by id DESC',array(':userid'=>$userid));
      $posts = "";
      foreach ($dbposts as $p) {
        # code...
        if(!DB::query('SELECT post_id from post_likes where post_id=:postid and user_id=:userid',array(':postid'=>$p['id'],':userid'=>$loggedInUserId))){
            $posts .= htmlspecialchars($p['body'])."
            <form action='profile.php?username=$username&postid=".$p['id']."' method='post'>
            <input type='submit' name='like' value='Like'>
            <span>".$p['likes']." likes</span>
            ";
            if($userid==$loggedInUserId){
              $posts .="<input type='submit' name='deletepost' value='delete'/>";
            }
            $posts .="</form><hr /></br/>";
          }else {
            $posts .= htmlspecialchars($p['body'])."
            <form action='profile.php?username=$username&postid=".$p['id']."' method='post'>
            <input type='submit' name='unlike' value='Unlike'>
            <span>".$p['likes']." likes</span>
            ";
            if($userid==$loggedInUserId){
              $posts .="<input type='submit' name='deletepost' value='delete'/>";
            }
            $posts .="</form><hr /></br/>";
          }
      }
      return $posts;

    }
}
 ?>
