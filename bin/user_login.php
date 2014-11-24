<?php
/*
**@author Sanjib Narzary
*/
$user=$_POST['user'];
$password=$_POST['password'];
$redUrl=$_POST['redUrl'];

if(isset($user)&&isset($password)){
		try{
			require_once('../inc/functions.php');
			//$str="SELECT (uid,hash) FROM user WHERE (uid='".$user."' OR email='".$user."') AND hash='".md5($password)."' LIMIT 1";
			$f=new Functions;
			$f->setLogIn($user,$password);
			if($f->isLoggedIn()){
				echo 'Logged in Successfully';
				if(isset($redUrl)){
					header('Location:'.$redUrl);
					}
				else
					header('Location: ./');
				}
			else{
				echo 'Could not Logged in, Please try again';
				if(isset($redUrl)){
					header('Location:'.$redUrl);
					}
				else
					header('Location: ./');
				}
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
	}
else{
	echo 'You must submit properly';
	header('Location: ./');
	}
?>