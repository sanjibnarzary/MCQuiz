<?php
require_once('../inc/functions.php');
$f=new Functions;
if(isset($_POST['choiceDel'])){
	
	if(isset($_POST['retUrl']))
		$retUrl=$_POST['retUrl'];
	else
		$retUrl='/quiz';
	
	
	if(isset($_POST['questionId'])&&isset($_POST['choiceId'])){
		$questionId=$_POST['questionId'];
		$choiceId=$_POST['choiceId'];
		$strChoiceDel="DELETE FROM `question_choice` WHERE `id`='".$choiceId."' AND `question_id`='".$questionId."'";
		if($f->insertUpdateQuery($strChoiceDel)>=0){
			header('Location:'.$retUrl);
			}
		else{
			header('Location:'.$retUrl);
			}
	}
	else{
		header('Location:'.$retUrl);
		}

	}

if(isset($_POST['questionDel'])){
if(isset($_POST['retUrl']))
		$retUrl=$_POST['retUrl'];
	else
		$retUrl='/quiz';
	
	
	if(isset($_POST['questionId'])){
		$questionId=$_POST['questionId'];
		$userId=$_POST['userId'];
		$choiceId=$_POST['choiceId'];
		$strQuestionDel="DELETE FROM `question` WHERE `created_by_uid`='".$userId."' AND id='".$questionId."'";
		$strChoiceDel="DELETE FROM `question_choice` WHERE `question_id`='".$questionId."'";
		if($f->insertUpdateQuery($strChoiceDel)>=0){
			if($f->insertUpdateQuery($strQuestionDel)>=0){
				@session_start();
				unset($_SESSION['question_id']);
				@session_start();
				unset($_SESSION['question_name']);
				header('Location:'.$retUrl);
				}
			else{
				header('Location:'.$retUrl);
				}
			}
		else{
			header('Location:'.$retUrl);
			}
	}
	else{
		header('Location:'.$retUrl);
		}
	
	}
if(isset($_POST['quizQuestionDel'])){
	
	if(isset($_POST['retUrl']))
		$retUrl=$_POST['retUrl'];
	else
		$retUrl='/quiz';
	
	
	if(isset($_POST['questionId'])){
		$questionId=$_POST['questionId'];
		$userId=$_POST['userId'];
		//$choiceId=$_POST['choiceId'];
		$strQuestionDel="DELETE FROM `question` WHERE `created_by_uid`='".$userId."' AND id='".$questionId."'";
		$strQuizQuestion="DELETE FROM `quiz_questions` WHERE `question_id`='".$questionId."'";
		$strChoiceDel="DELETE FROM `question_choice` WHERE `question_id`='".$questionId."'";
		if($f->insertUpdateQuery($strChoiceDel)>=0){
			if($f->insertUpdateQuery($strQuizQuestion)>=0){
				
				if($f->insertUpdateQuery($strQuestionDel)>=0){
					@session_start();
					unset($_SESSION['quiz_question_id']);
					@session_start();
					unset($_SESSION['quiz_question_name']);
					header('Location:'.$retUrl);
					}
				else{
					header('Location:'.$retUrl);
					}
				}
			else{
				header('Location:'.$retUrl);
				}
			}
		else{
			header('Location:'.$retUrl);
			}
	}
	else{
		header('Location:'.$retUrl);
		}
	
	
	}
else{
	header('Location:'.$retUrl);
	}
?>