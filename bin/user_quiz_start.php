<?php
require_once('../inc/functions.php');
$f=new Functions;


if(isset($_POST['quizId'])&&isset($_POST['userId'])&&isset($_POST['redUrl'])&&isset($_POST['quizStart'])){
	$strQuizStartInsert="INSERT INTO `user_quiz_answer_time`(`start_time`,`is_finished`, `attempts`, `quiz_id`, `uid`) VALUES ( NOW(),'0','1','".$_POST['quizId']."','".$_POST['userId']."')";
	if($f->insertUpdateQuery($strQuizStartInsert)>=0){
		if(isset($_POST['redUrl'])){
			header('Location:'.$_POST['redUrl']);
			}
		else{
			header('Location: /quiz');
			}
		}
		else{
			echo 'Can not Insert';
			if(isset($_POST['redUrl'])){
			header('Location:'.$_POST['redUrl']);
			}
		else{
			header('Location: /quiz');
			}

			}
	}
	else{
		echo 'You must start properly';
		if(isset($_POST['redUrl'])){
			header('Location:'.$_POST['redUrl']);
			}
		else{
			header('Location: /quiz');
			}
		}
?>