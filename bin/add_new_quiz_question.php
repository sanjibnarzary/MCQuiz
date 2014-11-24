<?php
/*
**@author Sanjib Narzary
*/
@session_start();
	if(isset($_SESSION['quiz_question_id'])&&isset($_SESSION['quiz_question_name'])){
			@session_start();
			unset($_SESSION['quiz_question_id']);
			@session_start();
			unset($_SESSION['quiz_question_name']);
			header('Location: ../quizcreate.php');
		}
		else{
			header('Location: ../quizcreate.php');
			}
?>