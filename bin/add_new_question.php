<?php
@session_start();
	if(isset($_SESSION['question_id'])&&isset($_SESSION['question_name'])){
			@session_start();
			unset($_SESSION['question_id']);
			@session_start();
			unset($_SESSION['question_name']);
			header('Location: ../questions.php');
		}
		else{
			header('Location: ../questions.php');
			}
?>