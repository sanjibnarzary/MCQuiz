<?php
/*
**This file is user_add.php, This is used for inserting users record in to database.
**@author Sanjib Narzary
*/
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
//$uid=$_POST['user'];
if(isset($name)&&isset($email)&&isset($password)){
		try{
			require_once('../inc/functions.php');
			$str="INSERT INTO `user`(`name`, `email`, `hash`, `date`) VALUES ('".$name."','".$email."','".md5($password)."',NOW())";
			$c=new Functions;
			$c->insertUpdateQuery($str);
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
	}
else{
	echo 'You must submit properly';
	}
?>