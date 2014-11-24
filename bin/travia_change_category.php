<?php
	require_once('../inc/functions.php');
	$f=new Functions;
	if(isset($_POST['category'])){
		if(empty($_POST['category'])){
			@session_start();
			unset($_SESSION['travia-category-id']);
			@session_start();
			unset($_SESSION['travia-category']);
			
			
			header('Location:/quiz/travia.php');
			}
		else{
			@session_start();
			$_SESSION['travia-category-id']=$_POST['category'];
			$selectCatName="SELECT name FROM type_category WHERE id=".$_POST['category']." LIMIT 1";
			$rowCatName=$f->selectQuery($selectCatName);
			@session_start();
			$_SESSION['travia-category']=str_replace('_',' ',$rowCatName['name']);
			
			header('Location:/quiz/travia.php');
		}
		}
	else{
		echo 'you must submit properly';
		header('Location: /quiz/travia.php');
		}
?>