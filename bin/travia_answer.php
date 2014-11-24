<?php
require_once('../inc/functions.php');
$f=new Functions;
if(isset($_POST['travia-qid'])&&isset($_POST['user'])&&isset($_POST['choice'])){
		$traviaQuestionId=$_POST['travia-qid'];
		$traviaUserId=$_POST['user'];
		$traviaChoiceId=$_POST['choice'];
		
		$strUserTraviaAnswer="INSERT INTO `user_travia_answer`(`question_id`, `user_choice_id`, `answer_time`, `uid`) VALUES ('".$traviaQuestionId."','".$traviaChoiceId."',NOW(),'".$traviaUserId."')";
		
		if($f->insertUpdateQuery($strUserTraviaAnswer)>=0){
			echo 'inserted';
			}
		else{
			echo 'can not inserted';
			}
		$strSelectCorrect="SELECT * FROM `question_choice` WHERE (question_id='".$traviaQuestionId."' AND id='".$traviaChoiceId."' AND is_right=1) LIMIT 1";
		$traviaAnswer=$f->selectQuery($strSelectCorrect);
		if(empty($traviaAnswer)){
			$point=0;
			}
		else{
			$point=1;
			}
		$strSelectScore="SELECT `id`, `score` FROM `user_travia_score` WHERE uid='".$traviaUserId."' LIMIT 1";
		$rowSelectScore=$f->selectQuery($strSelectScore);
		if(empty($rowSelectScore)){
		$strTraviaScoreInsert="INSERT INTO `user_travia_score`(`uid`, `score`, `travia_last_attempt`) VALUES ('".$traviaUserId."','".$point."',NOW())";
		if($f->insertUpdateQuery($strTraviaScoreInsert)>=0){
			echo 'score inserted';
			}
		else{
			echo 'can not insert score';
			}
		}else{
		$totalScore=$rowSelectScore['score']+$point;
		$strTraviaScoreUpdate="UPDATE `user_travia_score` SET `uid`=$traviaUserId,`score`=$totalScore,`travia_last_attempt`=NOW() WHERE `id`='".$rowSelectScore['id']."'";
		if($f->insertUpdateQuery($strTraviaScoreUpdate)>=0){
			echo 'score updated';
			}
			else{
				echo 'can not update score';
				}
		}
		header('Location: /quiz/travia.php');
	}
	
	else{
		echo 'You must take travia properly';
		header('Location: /quiz/travia.php');
		}
?>