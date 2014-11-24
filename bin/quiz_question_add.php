<?php
/*
**@author Sanjib Narzary
*/

$cid=$_POST['category'];
$qid=$_POST['quiz-id'];
$description=$_POST['question'];
$keywords=$_POST['keywords'];
$uid=$_POST['user'];
$rm=$_POST['reward-mark'];
$pm=$_POST['penalty-mark'];
if(isset($cid)&&isset($description)&&isset($keywords)&&isset($uid)&&isset($rm)&&isset($pm)){
		try{
			require_once('../inc/functions.php');
		
			$str="INSERT INTO `question`(`description`, `keywords`, `created_on`, `created_by_uid`, `type_category_id`) VALUES ('".$description."','".$keywords."',NOW(),'".$uid."',".$cid.")";
			
			$f=new Functions;
			if($f->isLoggedIn()){
				if($f->insertUpdateQuery($str)>=0){
					$str="SELECT * FROM `question` WHERE `description`='".$description."' AND `created_by_uid`='".$uid."' AND `type_category_id`='".$cid."'";
					$row=$f->selectQuery($str);
					//$qid=0;
					if(empty($row)){
						print_r($row);
						}
					else{
						@session_start();
						$_SESSION['quiz_question_id']=$row['id'];
						@session_start();
						$_SESSION['quiz_question_name']=$row['description'];
						$strQuiz="INSERT INTO `quiz_questions`(`quiz_id`, `question_id`, `reward_mark`, `penalty_mark`) VALUES (".$qid.",".$row['id'].",'".$rm."','".$pm."')";
						if($f->insertUpdateQuery($strQuiz)>=0){
							header('Location: ../quizcreate.php');
						}
						else{
							echo 'Can not add';
							}
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