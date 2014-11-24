<?php
$cid=$_POST['category'];
//$catName=$_POST['question-category-name'];
@session_start();
$_SESSION['question-category']=$cid;


$description=$_POST['question'];
$keywords=$_POST['keywords'];
$uid=$_POST['user'];
if(isset($cid)&&isset($description)&&isset($keywords)&&isset($uid)){
		try{
			require_once('../inc/functions.php');
			$f=new Functions;
			$strSelectCat = "SELECT name FROM type_category WHERE id='".$cid."' LIMIT 1";
			$rowCat=$f->selectQuery($strSelectCat);	
			@session_start();
			$_SESSION['question-category-name']=$rowCat['0'];
			$str="INSERT INTO `question`(`description`, `keywords`, `created_on`, `created_by_uid`, `type_category_id`) VALUES ('".$description."','".$keywords."',NOW(),'".$uid."',".$cid.")";
			
			if($f->isLoggedIn()){
				if($f->insertUpdateQuery($str)>=0){
					$str="SELECT * FROM `question` WHERE `description`='".$description."' AND `created_by_uid`='".$uid."'";
					$row=$f->selectQuery($str);
					$qid=0;
					if(empty($row)){
						print_r($row);
						}
					else{
						@session_start();
						$_SESSION['question_id']=$row['id'];
						@session_start();
						$_SESSION['question_name']=$row['description'];
						
						header('Location: ../questions.php');
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