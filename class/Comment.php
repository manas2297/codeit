<?php
  class Comment {
    public static function createComment($commentbody,$postid,$userId){

       if( strlen($commentbody)>200 || strlen($commentbody)<1 ){
         echo "<script>alert('Enter Post content correctly(<200 and >1)')</script>";
       }
         if(!DB::query('SELECT id from posts where id=:postid',array(':postid'=>$postid))){
           echo "<script> alert('Wrong Post')</script>";
         }else {
           DB::query('INSERT into comments (comment,user_id,posted_at,post_id) values (:comment,:userid,NOW(),:postid)',array(':comment'=>$commentbody,':userid'=>$userId,':postid'=>$postid));
         }
     }
  }


 ?>
