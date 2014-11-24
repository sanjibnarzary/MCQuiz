<?php
/*
**@author Sanjib Narzary
*/
require_once('db.php');
/*
**This class Functions is a collection of all the functions required to build the site.
*/
class Functions{
		/*
		**This function insertUpdateQuery() will take a string as a parameter which is a SQL INSERT/UPDATE statement string and do the SQL operation in the database.  
		*/
		function insertUpdateQuery($str){
				$c=new DBCon();
				$con=$c->conN();
				$stmt=$con->prepare($str);
				$stmt->execute();
			}
			/*
			**This function selectQuery() will take one argument as string which is a SQL SELECT statement string and return the one row result.
			*/
		function selectQuery($str){
				$c=new DBCon();
				$con=$c->conN();
				$stmt=$con->prepare($str);
				$stmt->execute();
				$row=$stmt->fetch();
				return $row;
			}
			/*
			**This function selectQueries() will take one argument as string which is a SQL SELECT statement string and return the results of rows in an array.
			*/
			function selectQueries($str){
				$c=new DBCon();
				$con=$c->conN();
				$stmt=$con->prepare($str);
				$stmt->execute();
				$rows=$stmt->fetchAll();
				return $rows;
			}
			/*
			**The isLoggedIn() function will check whether the user is login or not. This will return a boolean value of either 0 or 1. If the user is logged in this will return 1 and 0 otherwise.
			*/
			function isLoggedIn(){
					@session_start();
					if(isset($_SESSION['user'])&&isset($_SESSION['hash'])){
							$str="SELECT * FROM user WHERE uid='".$_SESSION['user']."' AND hash='".$_SESSION['hash']."' LIMIT 1";
							try{
								$f=new Functions;
								$row=$f->selectQuery($str);
								if(empty($row)){
									
									@session_start();
									if(isset($_SESSION['user'])&&isset($_SESSION['hash'])){
										unset($_SESSION['user']);
										unset($_SESSION['hash']);
										}
										return !1;
									}
								else{
									return !0;
									}
								}catch(PDOException $e){
									}
							
						}
					else{
						return !1;
						}
				}
				/*
				**The setLogIn function takes two arguments, user as the first parameter and hash of password as the second parameter and that will be stored as sessions.
				*/
			function setLogIn($u,$p){
				
				$str="SELECT * FROM user WHERE (uid='".$u."' OR username='".$u."' OR email='".$u."') AND hash='".md5($p)."' LIMIT 1";

				try{
					$f=new Functions;
					$row=$f->selectQuery($str);
					if(empty($row)){
						echo 'can not login';
						}
					else{
						$user=$row['uid'];
						$hash=$row['hash'];
						@session_start();
						$_SESSION['user']=$user;
						@session_start();
						$_SESSION['hash']=$hash;
					}
				}
				
				catch(PDOException $e){
					echo $e->getMessage();
					}
				}
				/*
				**This function setLogOut() when is called then it will unset al the user and has session values. and after this if the isLoggedIn() function is called then it will return a value 0. 
				*/
			function setLogOut(){
					@session_start();
					if(isset($_SESSION['user'])&&isset($_SESSION['hash'])){
						unset($_SESSION['user']);
						unset($_SESSION['hash']);
						}
					else{
						echo 'User not login';
						}
				}
			function getRetUrl(){
					return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				}
			function dateShow($dt){
					date_default_timezone_set('Asia/Calcutta');
					$dtnew=new DateTime($dt);
					return date_format($dtnew,'D/M/Y');
				}
			function showTime($dt){
				
					date_default_timezone_set('Asia/Calcutta');
					$dtnew=new DateTime($dt);
					return date_format($dtnew,'h:i:s A');
				}
			function dateDiff($s,$e){
					date_default_timezone_set('Asia/Calcutta');
					$dtStart=new DateTime($s);
					$dtEnd=new DateTime($e);
					$dDiff=$dtStart->diff($dtEnd);
					//return $dDiff;
					$dtMe='';
					if((int)($dDiff->format('%m'))>0){
						$dtMe=$dtMe.$dDiff->format('%m').' Months ' ;
						}
					if((int)($dDiff->format('%d'))>0){
						$dtMe=$dtMe.$dDiff->format('%d').' Days ';
						}
					if((int)($dDiff->format('%h'))>0){
						$dtMe=$dtMe.$dDiff->format('%h').' Hours ';
						}
					if((int)($dDiff->format('%i'))>0){
						$dtMe=$dtMe.$dDiff->format('%i').' Min ';
						}
					if((int)($dDiff->format('%r%s'))>0){
						$dtMe=$dtMe.$dDiff->format('%r%s').' Sec';
						}
					return $dtMe;
				}
	}
?>