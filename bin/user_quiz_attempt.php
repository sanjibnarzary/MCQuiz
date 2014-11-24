<?php
require_once('../inc/functions.php');
$questionId=$_POST['questionId'];
$user=$_POST['user'];
$redUrl=$_POST['returnUrl'];
$quizId=$_POST['quizId'];
$f=new Functions;
if(isset($questionId)&&isset($user)&&isset($redUrl)&&isset($quizId)){
	if(isset($_POST['attempt'])){
		//$choiceId=$_POST['choiceId'];
		$attempt=$_POST['attempt'];
		$strUserAttemptExists="SELECT * FROM `user_quiz_answers` WHERE uid='".$user."' AND quiz_id='".$quizId."' AND question_id='".$questionId."' LIMIT 1";
		$rowUserAttempted=$f->selectQuery($strUserAttemptExists);
		if(empty($rowUserAttempted)){
			
			if(isset($_POST['choiceId'])){
				echo 'should insert';
				echo 'Attempted';
				$strInsertUserQuizAnswer="INSERT INTO `user_quiz_answers`(`question_id`, `user_choice_id`, `answer_time`, `class`, `uid`, `quiz_id`) VALUES ('".$questionId."','".$_POST['choiceId']."', NOW(),'attempted','".$user."','".$quizId."')";
				if($f->insertUpdateQuery($strInsertUserQuizAnswer)>=0){
						header('Location:'.$redUrl);
					}
				else{
					echo 'can not insert';
					}
				}
			else{
				header('Location:'.$redUrl);
				}
			}
		else{
			
			if(isset($_POST['choiceId'])){
				$strUpdateUserQuizAnswer="UPDATE `user_quiz_answers` SET `user_choice_id`='".$_POST['choiceId']."', `answer_time`= NOW(), `class`='attempted' WHERE `quiz_id`='".$quizId."' AND `uid`='".$user."' AND `question_id`='".$questionId."' AND `id`='".$rowUserAttempted['id']."'";
				if($f->insertUpdateQuery($strUpdateUserQuizAnswer)>=0){
						header('Location:'.$redUrl);
					}
				else{
					echo 'can not update';
					}
				}
			else{
				header('Location:'.$redUrl);
				}
			}
		
		}
	else if(isset($_POST['review'])){
		//$attempt=$_POST['attempt'];
		$strUserAttemptExists="SELECT * FROM `user_quiz_answers` WHERE uid='".$user."' AND quiz_id='".$quizId."' AND question_id='".$questionId."' LIMIT 1";
		$rowUserAttempted=$f->selectQuery($strUserAttemptExists);
		if(empty($rowUserAttempted)){
			
			if(isset($_POST['choiceId'])){
				echo 'should insert';
				echo 'Attempted';
				$strInsertUserQuizAnswer="INSERT INTO `user_quiz_answers`(`question_id`, `user_choice_id`, `answer_time`, `class`, `uid`, `quiz_id`) VALUES ('".$questionId."','".$_POST['choiceId']."', NOW(),'review','".$user."','".$quizId."')";
				if($f->insertUpdateQuery($strInsertUserQuizAnswer)>=0){
						header('Location:'.$redUrl);
					}
				else{
					echo 'can not insert';
					}
				}
			else{
				header('Location:'.$redUrl);
				}
			}
		else{
			
			if(isset($_POST['choiceId'])){
				$strUpdateUserQuizAnswer="UPDATE `user_quiz_answers` SET `user_choice_id`='".$_POST['choiceId']."', `answer_time`= NOW(), `class`='review' WHERE `quiz_id`='".$quizId."' AND `uid`='".$user."' AND `question_id`='".$questionId."' AND `id`='".$rowUserAttempted['id']."'";
				if($f->insertUpdateQuery($strUpdateUserQuizAnswer)>=0){
						header('Location:'.$redUrl);
					}
				else{
					echo 'can not update';
					}
				}
			else{
				header('Location:'.$redUrl);
				}
			}
		
		}
	else if(isset($_POST['clear'])){
		$strUserAttemptExists="SELECT * FROM `user_quiz_answers` WHERE uid='".$user."' AND quiz_id='".$quizId."' AND question_id='".$questionId."' LIMIT 1";
		$rowUserAttempted=$f->selectQuery($strUserAttemptExists);
		if(empty($rowUserAttempted)){
			header('Location:'.$redUrl);
		}else{
			if(isset($_POST['choiceId'])){
				
				$strDel="DELETE FROM `user_quiz_answers` WHERE `question_id`='".$questionId."' AND `user_choice_id`='".$_POST['choiceId']."' AND `uid`='".$user."' AND `quiz_id`='".$quizId."'";
				if($f->insertUpdateQuery($strDel)>=0){
					header('Location:'.$redUrl);
					}
				else{header('Location:'.$redUrl);}
				}
			else{
				header('Location:'.$redUrl);
				}
			}
		}
	
}
//this is for quiz end
if(isset($_POST['finalSubmit'])){
			if(isset($user)&&isset($quizId)){
				$strUpdateFinalSubmit="UPDATE `user_quiz_answer_time` SET `end_time`=NOW(),`is_finished`=1 WHERE `quiz_id`=$quizId AND `uid`=$user";
				//calculation of marks
				$strUserAttemts="SELECT `question_id`, `user_choice_id` FROM `user_quiz_answers` WHERE `uid`='".$user."' AND `quiz_id`='".$quizId."'";
				$rowUserAttempts=$f->selectQueries($strUserAttemts);
				$mark=0;
				foreach($rowUserAttempts as $rowUserAttempt){
					$strMark="SELECT `reward_mark`, `penalty_mark` FROM `quiz_questions` WHERE `quiz_id`='".$quizId."' AND `question_id`='".$rowUserAttempt['0']."' LIMIT 1";
					$rowMark=$f->selectQuery($strMark);
					$strCorrect="SELECT `is_right` FROM `question_choice` WHERE `question_id`='".$rowUserAttempt['0']."' AND `id`='".$rowUserAttempt['1']."' LIMIT 1";
					$rowCorrect=$f->selectQuery($strCorrect);
					if($rowCorrect['0']==1){
						$mark=$mark+$rowMark['0'];
						}
					else{
						$mark=$mark-$rowMark['1'];
						}
					}
				$strScore="INSERT INTO `quiz_score`(`quiz_id`, `uid`, `score`, `quiz_time`) VALUES('".$quizId."','".$user."','".$mark."',NOW())";
				if($f->insertUpdateQuery($strScore)>=0){
					echo 'Inserted';
					}
				if($f->insertUpdateQuery($strUpdateFinalSubmit)>=0){
					if(isset($redUrl)){
					header('Location:'.$redUrl);
					}
					else{
						header('Location: /quiz');
					}
					}
				}
			else{
				if(isset($redUrl)){
					header('Location:'.$redUrl);
					}
					else{
						header('Location: /quiz');
					}
				}
		}
if(isset($_POST['startQuiz'])){
	echo 'start';
	}
if(isset($_POST['restartQuiz'])){
	
	//reset quiz score
	$strDelScore="DELETE FROM `quiz_score` WHERE `quiz_id`='".$quizId."' AND `uid`='".$user."'";
	//delete all attempted questions
	if($f->insertUpdateQuery($strDelScore)>=0){
		echo 'done';
		}
	$strDelQuizAnswers="DELETE FROM `user_quiz_answers` WHERE `quiz_id`='".$quizId."' AND `uid`='".$user."'";
	//increase attempts
	if($f->insertUpdateQuery($strDelQuizAnswers)>=0){
		echo 'done';
		}
	$strAttemp="SELECT `attempts` FROM `user_quiz_answer_time` WHERE `quiz_id`='".$quizId."' AND `uid`='".$user."' LIMIT 1";
	$rowAttemp=$f->selectQuery($strAttemp);
	//set to normal
	$strRestartQuiz="UPDATE `user_quiz_answer_time` SET `start_time`=NOW(), `end_time`=NULL, `is_finished`=0,`attempts`='".($rowAttemp['0']+1)."' WHERE `quiz_id`='".$quizId."' AND `uid`='".$user."'";
	if($f->insertUpdateQuery($strRestartQuiz)>=0){
			if(isset($redUrl)){
					header('Location:/quiz/quizquestion.php?quizid='.$quizId);
					}
					else{
						header('Location: /quiz');
					}
		}
	echo 'restart';
	}
else{
	echo 'You must submit from proper form';
	}
?>