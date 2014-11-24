    <?php
		/*
		**@author Sanjib Narzary
		*/
		require_once('inc/constants.php');
		require_once('inc/functions.php');
		$c=new Constants();
		$f=new Functions();
		if($f->isLoggedIn()){
			$login=1;
			}
		else{
			$login=0;
			}
			if($login){
					@session_start;
					$user=$_SESSION['user'];
				}
			else{
				$user=0;
				}
	?>
    <?php
	
		if(isset($_GET['quizid'])){
			$quizid=$_GET['quizid'];
			}
		else{
			$quizid=1;
			}
		if(isset($_GET['name'])){
				$name=$_GET['name'];
			}
		else{
			$name="Computer";
			}
		if(isset($_GET['start'])){
			if($_GET['start']<0)
				$start=0;
			else
				$start=$_GET['start'];
			}
		else{
			$start=0;
			}
		if(isset($_GET['end'])){
			$end=$_GET['end'];
			}
		else{
			$end=1;
			}
	?>
    <?php 
		if(isset($quizid)){
				$selectQuiz="SELECT * FROM quiz WHERE id=$quizid LIMIT 1";
				$rowQuiz=$f->selectQuery($selectQuiz);
				$name=$rowQuiz['name'];
				$description=$rowQuiz['description'];
				$keywords=$rowQuiz['keywords'];
			}
		else{
			echo "You must specify correct Quiz";
			}
	?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
    <head>
    <title><?php echo 'Quiz | '.$c->siteTitle().''; ?></title>
    <meta name="description" content="<?php echo $description?>">
    <meta name="keywords" content="sample,samplequiz,indianexams,entrance,entrance-exam,<?php echo $keywords?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body>
    <div class="container">   
    		<?php
            	include('inc/header.php');
			?>
        	 <div class="container-fluid well-small">
				<!--Body content-->
            	<div class="span7">
                <div>
                	<ul class="breadcrumb">
                    	<li>
                        	Home
                        </li>
                        <li class="divider">
                        \
                        </li>
                        <li>
                        	Quiz
                        </li>
                        <li class="divider">
                        \
                        </li>
                        <li class="active">
                        <?php echo $name?>
                        </li>
                    </ul>
                </div><!-- End of breadcrumb-->
                <!-- Must check if login or not-->
                <?php if($login){
					$strSelectQuizAnswer="SELECT * FROM `user_quiz_answer_time` WHERE `quiz_id`='".$quizid."' AND `uid`='".$user."' LIMIT 1";
					$rowUserQuizAnswer=$f->selectQuery($strSelectQuizAnswer);
					if(empty($rowUserQuizAnswer)){
						//attempt code
						$isQuizStarted=0;
						$isAttemptedQuiz=0;
						}
					else{
						if($rowUserQuizAnswer['start_time']==NULL){
							$isQuizStarted=0;
						}
						else{
							$isQuizStarted=1;
							}
						if($rowUserQuizAnswer['is_finished']==1){
								$isAttemptedQuiz=1;
							}
						else{
							$isAttemptedQuiz=0;
							}
						//attempted code
						//if attempted user should be able to re attempt again 
						}
					?>
                <div><!--
                	<h5><?php echo $name; ?></h5>
                    <p class="well-small brand">
                    <?php
                    	echo $description;
					?>
                    </p>
                    -->
                    <?php if(!$isAttemptedQuiz){
						if($isQuizStarted){
						?>
                    <table class="table-striped">
                        <tr>
                         	<td>Start Time: <strong><div style="display:inline" title="<?php echo $f->dateShow($rowUserQuizAnswer['start_time'])?>"><?php date_default_timezone_set('Asia/Calcutta'); echo $f->showTime($rowUserQuizAnswer['start_time'])?> </div></strong></td><td><?php  ?></td> <td>Time Elapsed: </td><td><?php  echo $f->dateDiff($rowUserQuizAnswer['start_time'],date_create('Y-m-d h:i:s')); ?></td>                        </tr>
                    </table> 
                   <p align="right"> </p>
                    <?php 
						}else{
						?>
                        <h5><?php echo $name; ?></h5>
                    <p class="well-small brand">
                    <?php
                    	echo $description;
					?>
                    </p>
                        <?php
						}
					}else{?>
                    You have Attempted <h5 style="display:inline"><?php echo $name; ?></h5>
                    
                    <?php }?>
                </div>
                	<?php
					//$isQuizStarted
					if(!$isAttemptedQuiz){
						if($isQuizStarted){
							
							
							$strRev="SELECT * FROM quiz_questions WHERE quiz_id='".$quizid."'";
							$rowsQuizQuestion=$f->selectQueries($strRev);
		 					$questionsCount=count($rowsQuizQuestion);
							//echo $questionsCount;
							$str="SELECT * FROM quiz_questions WHERE quiz_id='".$quizid."' LIMIT ".$start.",1";
							$rowQuizQuestions=$f->selectQueries($str);
							if(!empty($rowQuizQuestions)){
								$count=$start+1;
							foreach($rowQuizQuestions as $rowQuizQuestion){
							
                    ?>
                    <div class="pull-right" style="display:block">
                    Award Mark <div class="reward-circle"><?php echo $rowQuizQuestion['reward_mark']?></div>, Penalty Mark <div class="red-circle"><?php echo $rowQuizQuestion['penalty_mark']?></div>
                    </div>
                    <br>
                    <p><strong>Q<?php echo $count;$count=$count+1;?>#:&nbsp;</strong></p><?php 
					$selectQuestionQuiz="SELECT * FROM question WHERE id=".$rowQuizQuestion['question_id']." LIMIT 1";
					$rowQuestion=$f->selectQuery($selectQuestionQuiz);
					?>
					<div class="span6 question-description">
					<?php echo $rowQuestion['description']; ?>
                    </div>
                    <div class="well-small">
                    <form method="post" action="bin/user_quiz_attempt.php">
                    <input type="hidden" name="quizId" value="<?php echo $quizid?>">
                    <input type="hidden" name="questionId" value="<?php echo $rowQuestion['id']?>">
                    <input type="hidden" name="user" value="<?php echo $user?>">
                    <input type="hidden" name="returnUrl" value="<?php echo $f->getRetUrl()?>">
                    	<?php
                        	$str="SELECT * FROM question_choice WHERE question_id='".$rowQuestion['id']."' ORDER BY RAND()";
							try{
									$rows1=$f->selectQueries($str);
									$strUserQuizAnswer="SELECT `user_choice_id` FROM `user_quiz_answers` WHERE `question_id`='".$rowQuestion['id']."' AND `uid`='".$user."' AND `quiz_id`='".$quizid."' LIMIT 1";
									$rowUserQuizAnswerChoice=$f->selectQuery($strUserQuizAnswer);
									foreach($rows1 as $row1){
											?>
                                            <div class="input-prepend">
                                            <!-- A code will be added to the radio so that if a user is already taken that quiz then he can view what option he has previously opted for-->
                        						<span class="add-on"><input type="radio" name="choiceId" <?php if($rowUserQuizAnswerChoice['0']==$row1['id']){echo 'checked';}?> value="<?php echo $row1['id']?>"></span>
                                                <input type="text" class="span5" value="<?php echo $row1['choice']?>" disabled>
                            				</div>
                                            <?php 
												if($rowUserQuizAnswerChoice['0']==$row1['id']){
													?>
                                                    <div class="input-prepend"><span class="add-on"><i class="icon-arrow-left"></i></span><input type="text" class="span1" disabled value="Chosen!"></div>
                                                    <?php
													}
                                                    if($row1['is_right']==0)
                                                        {
															echo '<div class="collapse" style="display:inline-block"></div>';
															
															}
                                                    else
                                                        {
															//remove code for correct answer
															?>
                                                            <?php
															}
                                                    ?>
                                            
                                            <br/>
                                            <?php
										}
								}
							catch(PDOException $e){
								echo $e->getMessage();
								}
						?>
                        <div>
                        <button type="submit" name="attempt" class="btn btn-mini btn-success">Attempt Question</button>&nbsp;<button type="submit" class="btn btn-info btn-mini" name="review">Attempt for review</button>&nbsp;<button type="submit" class="btn btn-mini" name="clear">Clear Answer</button> <?php if (($start+1)==$questionsCount){?><button type="submit" class="btn btn-mini btn-primary pull-right" name="finalSubmit" style="margin-right:24%" title="Press this button if you have attempted all of the questions">Finalize Quiz &amp; Submit</button><?php } ?>
  
 
&nbsp; <!-- <?php echo $rowQuestion['created_on'].' '.$rowQuestion['created_by_uid']; ?> //-->
                        </div>
                        </form>
                    </div>
                    
                    <?php }
					?>
                    <div class="pagination pagination-mini pagination-centered">
                        <ul>
                        	<?php 
							$minus=1;
							
								if($start>0 && ($start+1)<$questionsCount){
									$pluss=1;
									
									}
								else if($start==0){
										$minus=0;
										$pluss=1;
									}
								if(($start+1)>=$questionsCount){
										$start=$start;
										$pluss=0;
										
									}
								else if($start<=0){
										$minus=0;
									}
								else{
										$minus=1;
									}
							?>
                        	<li <?php if($start==0){
									echo 'class="disabled" title="To start click on submit answer"';
								}?>><a href="quizquestion.php?quizid=<?php
                            	echo ''.$quizid.'&start='.($start-$minus).'';
							?>
                            "><?php 
								if (($start)==0)
									echo 'No Previous Question(s) Left'; 
								else
									echo '&laquo; Prev Question';
							?></a></li>
                            <li <?php 
								if (($start+1)==$questionsCount)
									echo 'class="disabled" title="Press on Submit button to Finalize your quiz"'; 
								else
									echo 'Next Question &raquo;';
							?>><a href="quizquestion.php?quizid=<?php
                            	echo ''.$quizid.'&start='.($start+$pluss).'';
							?>
                            "><?php 
								if (($start+1)==$questionsCount)
									echo 'No Questions Left'; 
								else
									echo 'Next Question &raquo;';
							?></a></li>
                            
                        </ul>
                    </div><!-- Pagination Ends -->
                    <div style="border:dotted;height:150px;display:block;margin-left:-10px;padding-left:-10px;">
                                Ads Travia
                        </div>
					<?php
						}
						else{
							//this will be implemented because here if quiz does not have questions then there will be option for adding questions on that quiz if he/she is the real creator else will be redirected to another
							$row=$f->selectQuery("SELECT * FROM type_category WHERE name='".$name."' LIMIT 1");
							
							if(empty($row)){
								echo 'You have reached out of quiz question <a href="/quiz/quizquestion.php?quizid='.$quizid.'">Go to starting quiz</a>';
                                //<?php
								
								}
								else{
									echo "Do you want to add questions on <strong>$name</strong> category";
							?>
                            
                            <form class="form-horizontal" method="post" action="./bin/question_add.php">
                            	<label>Category</label>
                                <input type="text" value="<?php echo $name; ?>" name="name" class="input-xlarge span6" disabled/>
                                <input type="hidden" value="<?php echo $row['id'] ?>" name="category" />
                                <input type="hidden" value="<?php @session_start();
								if(isset($_SESSION['user']))
								{
									@session_start();
									echo  $_SESSION['user'];
								}
								else{
									echo 0;
									}
								?>" name="user">
                                <label>Question Description</label><textarea name="question" class="input-xlarge span6" placeholder="Write what is the content of the question. You will be able to add options later!" required></textarea>
                                <label>Question Keywords</label><textarea name="keywords" class="input-xlarge span6" placeholder="Keywords (Optional) separated by commas e.g., <?php echo $name ?>, mockquiz" rows="1"></textarea>
                                <br>
                                <button type="submit" class="btn btn-small pull-right" style="margin-right:15%;" <?php 
								if($login){
										echo '';
									}
									else{
										echo 'disabled title="You Must Logged in to Add Question"';
										}
								?>>Create Question</button>
                            </form>
                            <?php
								}
							} 
						}else{
							?><center>
                            <form method="post" action="bin/user_quiz_start.php">
                            <input type="hidden" name="quizId" value="<?php echo $quizid ?>">
                            <input type="hidden" name="userId" value="<?php echo $user?>">
                            <input type="hidden" name="redUrl" value="<?php echo $f->getRetUrl();?>">
                            <button type="submit" class="btn btn-success btn-small" name="quizStart">Start The Quiz</button>
                            </form>
                            </center>
                            <?php
							//echo "Can not find your Request";
							include('inc/quiz_starting_middlebody.php');
							}
					}else{
						//echo $description;
						?>
                        <p class="well-small">You can be able to<center> 
                        <form action="bin/user_quiz_attempt.php" method="post">
                        <input type="hidden" name="quizId" value="<?php echo $quizid?>">
                    
                    	<input type="hidden" name="user" value="<?php echo $user?>">
                        <input type="hidden" name="returnUrl" value="<?php echo $f->getRetUrl()?>">
                        <button class="btn btn-small btn-success" name="restartQuiz">Restart Quiz</button>&nbsp; Or &nbsp;<a class="btn btn-small btn-info" href="/quiz/quizscore.php?quizId=<?php echo $quizid?>&userId=<?php echo $user ?>">View your Score</a>
                        </form></center></p>
                        </p>
                        <div>
                        <?php
						include('inc/quiz_attempted_middlebody.php');
						
					?>
                    </div>
                    <?php
					}
				}//login check
				else{
					?>
                    <div class="well-small">You have not logged in. <a href="#signInModal" role="button"  data-toggle="modal">Log in to Start Quiz</a></div>
                    <?php }?>
                    
           		</div>
                <div class="span4">
                	<div>
                    	
                        <?php 
						include('inc/quiz_question_sidebar.php');
						if($login){
							if(!$isAttemptedQuiz)
								if($isQuizStarted){
							?>
                    	<strong><u><h5>Questions (<?php echo $questionsCount;?>)</h5></u></strong>
                        <div class="well-small">
                        <?php 
							
							$quizQuestionCounter=1;
							$strRev="SELECT id FROM user_quiz_answers WHERE quiz_id='".$quizid."' AND uid='".$user."'";
							//print_r($rowsQuizQuestion);
							foreach($rowsQuizQuestion as $rowQuizQuestion){
								$strUserQuizAnswer="SELECT `user_choice_id`,`class` FROM `user_quiz_answers` WHERE `question_id`='".$rowQuizQuestion['question_id']."' AND `uid`='".$user."' AND `quiz_id`='".$quizid."' LIMIT 1";
								$rowAnswer=$f->selectQuery($strUserQuizAnswer);
								//echo $rowAnswer['0'].$rowAnswer['1'];
								?>
									 <div class="<?php if($rowAnswer['1']=='attempted'){echo 'success-circle';}else if($rowAnswer['1']=='review'){echo 'review-circle';}else{echo 'default-circle';}?>" title="<?php if($rowAnswer['1']=='attempted'){echo 'You have attempted this question and mark it as correct!';}else if($rowAnswer['1']=='review'){echo 'You have attempted and mark this question for Review.';}else{echo 'You have not yet attempted this question';}?>"><a href="/quiz/quizquestion.php?quizid=<?php echo $quizid ?>&start=<?php echo ($quizQuestionCounter-1) ?>"><?php echo $quizQuestionCounter?></a></div>
                                     <?php
									$quizQuestionCounter++;
								}
							
							
						?>
                        
                        </div>
                        <?php
						}else{
								//echo 'Not started';
								include('inc/quiz_question_sidebar_login_no_attempted.php');
								}
								else{
									//echo 'Have already Attempted Quiz';
									include('inc/quiz_question_sidebar_login_attempted.php');
									}
						 }else{ //echo 'Not Login';
						 include('inc/quiz_question_sidebar_no_login.php');
						 }?>
                    </div>
                </div>
		</div>
    
        
         <?php
        	include('inc/footer.php');
		?>
    </div> <!-- Container //-->
    <?php
    	include('inc/modal.php');
		include('inc/scripts.php');
	?>
    </body>
    </html>