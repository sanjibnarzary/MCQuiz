<?php
/*
**@author Sanjib Narzary
*/
$cid=$_POST['category'];
$name=$_POST['name'];
$description=$_POST['description'];
$keywords=$_POST['keywords'];
$uid=$_POST['user'];
if(isset($cid)&&isset($description)&&isset($keywords)&&isset($uid)){
		try{
			require_once('../inc/functions.php');
		
			$str="INSERT INTO `quiz`(`name`, `description`, `keywords`, `created_on`, `created_by_uid`, `quiz_sub_category_id`) VALUES ('".$name."','".$description."','".$keywords."',NOW(),'".$uid."',".$cid.")";
			$f=new Functions;
			if($f->isLoggedIn()){
				if($f->insertUpdateQuery($str)>=0){
					$str="SELECT * FROM `quiz` WHERE `name`='".$name."' AND `created_by_uid`='".$uid."'";
					$row=$f->selectQuery($str);
					$qid=0;
					if(empty($row)){
						print_r($row);
						}
					else{
						@session_start();
						$_SESSION['quiz_id']=$row['id'];
						@session_start();
						$_SESSION['quiz_name']=$row['name'];
						
						header('Location: ../quizcreate.php');
						}
					}
				
				else{
					print 'is here';
					
					}
				}
			else{
				
				echo 'You Must Login to Add Questions';
				}
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
	}
else{
	echo 'You must submit properly';
	}
?>