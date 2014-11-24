<?php
$name=$_POST['name'];
$description=$_POST['description'];
$keywords=$_POST['keywords'];
$uid=$_POST['user'];
if(isset($name)&&isset($description)&&isset($keywords)&&isset($uid)){
		try{
			$name=str_replace(' ','_',$name);
			require_once('../inc/functions.php');
			$str="INSERT INTO `type_category`(`name`, `description`, `keywords`, `created_on`, `created_by_uid`) VALUES ('".$name."','".$description."','".$keywords."',NOW(),".$uid.")";
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