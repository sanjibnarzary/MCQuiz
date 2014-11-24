<?php
	$choice=$_POST['choice'];
	$qid=$_POST['qid'];
	//$uid=$_POST['uid'];
	if(isset($choice)&&isset($qid)){
			if(isset($_POST['isRight'])){
					$isRight=$_POST['isRight'];
				}
			else{
					$isRight=0;
				}
				try{
						require_once('../inc/functions.php');
						$str="INSERT INTO `question_choice`(`is_right`, `choice`, `question_id`) VALUES ('".$isRight."','".$choice."','".$qid."')";
						$f=new Functions;
						if($f->insertUpdateQuery($str)>=0){
								echo 'Added Options';
								header('Location: ../questions.php');
							}
						else{
							echo '<span class="alert-error">Something went wrong while submitting</span>';
							}
					}
				
				catch(PDOException $e){
						echo $e->getMessage();					
					}
		}
	else{
		echo '<span class="alert-error">You must submit it properly</span>';
		}
?>