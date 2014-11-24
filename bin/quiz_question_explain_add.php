<?php
$explain=$_POST['explain'];
$qid=$_POST['question-id'];

if(isset($explain)&&isset($qid)){
		try{
			require_once('../inc/functions.php');
		
			$str="UPDATE `question` SET `explain`='".$explain."' WHERE `id`=".$qid."";
			$f=new Functions;
			if($f->isLoggedIn()){
				if($f->insertUpdateQuery($str)>=0){
						
						header('Location: ../quizcreate.php');
						
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