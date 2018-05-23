<?php


class Login{

	public static $user;
	public static function isLoggedIn()
{
	# code...
	if(isset($_COOKIE['SNID'])){
		if (DB::query('SELECT user_id from login_tokes where token=:token',array(':token' =>sha1($_COOKIE['SNID'] )))) {
			# code...
			$user_id=DB::query('SELECT user_id from login_tokes where token=:token',array(':token' =>sha1($_COOKIE['SNID'])))[0]['user_id'];
			$user=DB::query('SELECT username from users where id=:user_id',array(':user_id' =>$user_id))[0]['username'];
			
			
			if(isset($_COOKIE['SNID_'])){
				return $user_id;
			}else {
				$cstrong=True;
				$token=bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
				DB::query('INSERT into login_tokes (token,user_id) VALUES (:token,:user_id)',array(':token'=>sha1($token),':user_id'=>$user_id));
				DB::query('DELETE from login_tokes where token=:token',array(':token'=>sha1($_COOKIE['SNID'])));
				setcookie("SNID",$token,time()+60*60*24*7,'/',NULL,NULL,True);
				setcookie("SNID_",'1',time()+60*60*24*3,'/',NULL,NULL,True);
				return $user_id;
			}

		}
	}
	return false;

}	
public static function getuser(){
			
		$user=DB::query('SELECT username from users where id=:user_id',array(':user_id' =>Login::isLoggedIn()))[0]['username'];
		return $user;
		
	
}

}

?>
