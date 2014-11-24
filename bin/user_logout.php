<?php
/*
**@author Sanjib Narzary

*/

try{
	require_once('../inc/functions.php');

	$f=new Functions;
	$f->setLogOut();
}
catch(Exception $e){
	echo $e->getMessage();
	}
	#
?>