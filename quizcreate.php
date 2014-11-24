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
		@session_start();
		if(isset($_SESSION['quiz_id'])&&isset($_SESSION['quiz_name'])){
				@session_start();
				$qid=$_SESSION['quiz_id'];
				@session_start();
				$qname=$_SESSION['quiz_name'];
				$quizard=1;
			}
		else{
			//echo 'Question not set';
			//$qname='';
			//$qid=0;
			$quizard=0;
			
			}
	?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
    <head>
    <title><?php echo 'Create Quiz | '.$c->siteTitle().''; ?></title>
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
                	<?php 
						if ($quizard==0){
					?>
                        <div>
                            <h4>Create a Quiz</h4>
                        </div><!-- Free Div //-->
                        <form class="form-horizontal" method="post" action="./bin/quiz_add.php">
                            <label>Choose a Category</label>
                            <select name="category">
                                <?php
                                    $str="SELECT * FROM quiz_category";
                                    try{
                                        $rows=$f->selectQueries($str);
                                        foreach($rows as $row){
                                                echo '<option value="'.$row['id'].'" disabled><u>'.str_replace('_',' ',$row['name']).'</u></option>';
                                                $str1="SELECT * FROM quiz_sub_category WHERE quiz_category_id='".$row['id']."' ORDER BY RAND()";
                                                $rows1=$f->selectQueries($str1);
                                                foreach($rows1 as $row1){
                                                    echo '<option value="'.$row1['id'].'">&nbsp;&nbsp;'.str_replace('_',' ',$row1['name']).'</option>';
                                                    }
                                            }
                                    }
                                    catch(PDOException $e){
                                        echo $e->getMessage();
                                        }
                                ?>
                            </select>&nbsp;&nbsp;<a class="btn btn-link" href="quizcat.php">Add New Quiz Category</a>
                            <input type="hidden" value="<?php echo $row['id'] ?>" name="cid" />
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
                            <label>Quiz Name</label>
                            <textarea name="name" class="input-large span6" rows="1" placeholder="Write a name that represents the Quiz!" required></textarea>
                            <label>Quiz Description</label><textarea name="description" class="input-xlarge span6" placeholder="Write what is the description or purpose of the Quiz. You will be able to add Questions later!" required></textarea>
                            <label>Quiz Keywords</label><textarea name="keywords" class="input-xlarge span6" placeholder="Keywords (Optional) separated by commas e.g., sample, mcq, mockquiz" rows="1"></textarea>
                            <br>
                            <button type="submit" class="btn btn-small pull-right" style="margin-right:15%;" <?php 
                                    if($login){
                                            echo '';
                                        }
                                        else{
                                            echo 'disabled title="You Must Logged in to Add New Quiz"';
                                            }
                                    ?>
                                    >Create Quiz</button>
                        </form>   
                        <div style="height:150px;width:auto; border:dashed; padding-top:20px;">
                        	Ads Area
                    </div>      
                    <?php
						}//end of $quizard==0
					else{
					?>
                    <div>
                        <h4>Add Questions to <a class="brand" href="/quiz/quizquestion.php?quizid=<?php echo $qid?>" target="new"><strong><?php echo $qname; ?> </strong></a>Quiz</h4>
                    </div> <!-- Free Div //-->
					<div class="well-small">
						 <form class="pull-right" style="display:inline-block;" action="bin/question_choice_delete.php" method="post">
                            <input type="hidden" name="retUrl" value="<?php echo $f->getRetUrl();?>">
                            <input type="hidden" name="questionId" value="<?php @session_start();
                            if(isset($_SESSION['quiz_question_name'])&&isset($_SESSION['quiz_question_id'])){
                                @session_start();
                                echo $_SESSION['quiz_question_id'];
                           	} ?>">
                            <input type="hidden" name="userId" value="<?php if($login){
                                @session_start();
                                echo $_SESSION['user'];
                                } ?>"><?php @session_start();
                            if(isset($_SESSION['quiz_question_name'])&&isset($_SESSION['quiz_question_id'])){ 
								if($login){
							?>
                            <button type="submit" name="quizQuestionDel" class="btn btn-mini btn-danger" title="Delete this Question!">Delete Question</button>
                            <?php }}?>
                            
                        </form>
						 <?php
                            @session_start();
                            $strCountQuestion="SELECT * FROM quiz_questions WHERE quiz_id=$qid";
                            $cnt=$f->selectQueries($strCountQuestion);
                            $count=count($cnt);
							@session_start();
                            if(isset($_SESSION['quiz_question_name'])&&isset($_SESSION['quiz_question_id'])){
                                @session_start();
                                echo 'Q#'.$count.'. <strong>'.$_SESSION['quiz_question_name'].'</strong>';
                           	}
                        ?>
                        
                        <br /><br><br>
                    	<?php
							@session_start();
                        	if(isset($_SESSION['quiz_question_name'])&&isset($_SESSION['quiz_question_id'])){
						?>
                        	<?php
								@session_start();
                            	if(isset($_SESSION['quiz_question_name'])&&isset($_SESSION['quiz_question_id'])){
									@session_start();
									$question_id=$_SESSION['quiz_question_id'];
								}
							?>
							 <?php
                                $str="SELECT * FROM question_choice WHERE question_id='".$question_id."'";
                                $strTCCount="SELECT * FROM question_choice WHERE question_id='".$question_id."' AND is_right=1";
                                $rowTCCount=$f->selectQueries($strTCCount);
                                if(empty($rowTCCount)){
                                    $count=0;
                                }
                                else{
                                	$count=1;
                                }
                                try{
									$rows=$f->selectQueries($str);
									if(count($rows)==3 && $count==0){
										$mustGiveCorrectOption=1;
										
									}
									else{
										$mustGiveCorrectOption=0;
									}
											
									foreach($rows as $row){
							?>
                                        <div class="input-prepend">
                                        <span class="add-on"><input disabled type="radio"></span>
                                        <input type="text" class="span5" value="<?php echo $row['choice']?>" disabled>
										</div><!-- Input Prepend//-->
										<div class="input-prepend">
											<span class="add-on"><input type="checkbox" <?php
												if($row['is_right']==1){
														echo 'checked';
													}
												else{
													echo '';
													}
											?> disabled></span>
											<input class="span1" type="text" value=" isRight?" disabled>
                                            
										</div><!-- Input Prepend//-->
                                        <div class="input-append">
                                        <form class="inline" style="display:inline;" action="bin/question_choice_delete.php" method="post">
                                        	<input type="hidden" name="retUrl" value="<?php echo $f->getRetUrl();?>">
                                        	<input type="hidden" name="questionId" value="<?php echo $question_id ?>">
                                            <input type="hidden" name="choiceId" value="<?php echo $row['id'] ?>">
                                            <button type="submit" name="choiceDel" class="btn btn-danger" title="Delete this Entry!">-</button>
                                            
                                        </form>
                                        </div>
										<br/>
										<?php
											if($row['is_right']==1){			
										?>
                                                <form method="post" action="./bin/quiz_question_explain_add.php">
                                                    <textarea name="explain" class="span5" placeholder="Explaination of Correct Answer if any"><?php
                                                        $strSelect="SELECT * FROM question WHERE id=".$question_id." LIMIT 1";
                                                        $rowSelect=$f->selectQuery($strSelect);
                                                        $explain=$rowSelect['explain'];
                                                        echo $explain;
                                                    ?></textarea>
                                                    <input type="hidden" name="question-id" value="<?php echo $question_id ?>">
                                                    <button class="btn alert-error" type="submit" 
                                                    <?php 
                                                        if($login)
                                                            {echo '';}
                                                        else{echo 'disabled';}
                                                    ?>>Add/Update
                                                    </button>
												</form>
										<?php 
											} 
										
									} //Foreach
								}
								catch(PDOException $e){
									echo $e->getMessage();
								}
							?>
                            <div id="choiceSubmitted">
                            </div>
                            <div id="questionChoice">
                                <form class="form-horizontal" id="choiceForm" data-async data-target="#questionChoice" action="./bin/quiz_question_choice_add.php" method="POST">
                                	<div class="input-prepend">
                                        <span class="add-on"><input type="radio"></span>
                                        <input type="text" name="choice" placeholder="Give a Choice name" class="span4 input-large">
                                     </div> <!-- Input Prepend//-->
                                     <input type="hidden" name="qid" value="<?php 
                                     	@session_start();
                                    	if(isset($_SESSION['quiz_question_name'])&&isset($_SESSION['quiz_question_id'])){
                                        @session_start();
                                        echo $_SESSION['quiz_question_id']; 
                                    }
                                    ?>" />
                                     <input type="hidden" name="uid" value="<?php
                                        @session_start();
                                        if(isset($_SESSION['user'])){
                                            @session_start();
                                            echo $_SESSION['user'];
                                            }
                                     ?>"/>
                                     <div class="input-prepend">
                                        <input type="hidden" value="<?php 
                                            if($mustGiveCorrectOption==0){
                                                echo 0;
                                                }
                                            else{
                                                echo 1;
                                                }
                                        ?>" name="isRight">
                                        <span class="add-on"><input type="checkbox" value="1" name="isRight" <?php 
                                    if($count==0 && $mustGiveCorrectOption==0){
                                            echo '';
                                        }
                                        else if($mustGiveCorrectOption==1){
                                            echo 'checked disabled title="One question must have one Correct Answer! You have given the three incorrect options Already."';
                                            }
                                            
                                        else{
                                            echo 'disabled title="One question must have only one Correct Answer! You have given the Correct Choice Already"';
                                            }
                                    ?>></span>
                                        <input type="text" disabled value="isRight?" class="span1">
                                    </div><!-- Input Prepend//-->
                                     <button type="submit" class="btn btn-warning"  id="choiceSubmit" <?php 
                                     if($login)
                                     {echo '';}
                                     else{echo 'disabled';}
                                     ?>>Add Choice</button>
                                </form>
                            </div> <!-- Question Choice//-->
                        <?php 
							}
							else{
						?>
                            <form class="form-horizontal" method="post" action="./bin/quiz_question_add.php">
                            <label>Select a Category</label>
                            <select name="category">
                                <?php
                                    $str="SELECT * FROM type_category";
                                    try{
                                        $rows=$f->selectQueries($str);
                                        foreach($rows as $row){
                                                echo '<option value="'.$row['id'].'">'.str_replace('_',' ',$row['name']).'</option>';
                                            }
                                    }
                                    catch(PDOException $e){
                                        echo $e->getMessage();
                                        }
                                ?>
                            </select>
                            &nbsp;<a class="link" href="/quiz/category.php" target="_blank">Add a new Category for questions</a>
                            <input type="hidden" value="<?php echo $row['id'] ?>" name="cid" />
                            <input type="hidden" value="<?php 
                                @session_start(); 
                                if(isset($_SESSION['quiz_id'])){
                                    @session_start();
                                    echo $_SESSION['quiz_id'];
                                    }
                            ?>" name="quiz-id">
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
                            <label>Question Keywords</label><textarea name="keywords" class="input-xlarge span6" placeholder="Keywords (Optional) separated by commas e.g., sample, mcq, mockquiz" rows="1"></textarea>
                            <br>
                            Reward Mark <select name="reward-mark" class="span1"><option>4</option><option>1</option><option>2</option><option>5</option></select>
                            &nbsp;Penalty Mark <select name="penalty-mark" class="span1"><option>1</option><option>0</option><option>2</option></select>
                            <button type="submit" class="btn btn-small pull-right" style="margin-right:15%;" <?php 
                                    if($login){
                                            echo '';
                                        }
                                        else{
                                            echo 'disabled title="You Must Logged in to Add Question"';
                                            }
                                    ?>>Add Question</button>
                        </form> 	
                        <?php
                        	}
						?>
                    </div> <!-- Well Small//-->  
                    <div>
                        <a href="./bin/add_new_quiz_question.php" class="btn btn-success">Add Another Question</a> &nbsp;&nbsp;<a href="./bin/add_new_question.php" class="btn btn-info">Add From Existing Questions</a>
                         
                    <div style="height:150px;width:auto; border:dashed;">
                        	Ads Area
                    </div>  
                    
                    </div><!-- Free Div//--> 
						<?php }?>  
                           	
           		</div> <!-- Span7//-->
                <div class="span4">
                	<div>
                    	<div style="height:250px;width:auto; border:dashed; border-style:dashed">
                        	Ads Area
                        </div>
                        
						<?php
							if($quizard==1){
                            $selectQuizQuestions="SELECT * FROM quiz_questions WHERE quiz_id=".$qid." ORDER BY id DESC";
                             $quizQuestionRows=$f->selectQueries($selectQuizQuestions);
                        ?>
                    	<h4>Total Questions (<?php $countRows=count($quizQuestionRows);
						echo $countRows;
						?>) 
						<?php
                        $strQuizSelectPub="SELECT * FROM `quiz` WHERE `id`='".$qid."' LIMIT 1";
						$rowQuizSelectPub=$f->selectQuery($strQuizSelectPub);
						if($login){
							@session_start();
							$userId=$_SESSION['user'];
							if($rowQuizSelectPub['created_by_uid']==$userId&&$rowQuizSelectPub['is_published']==0){
								if($countRows>3){
									?>
                                    <form class="inline" style="display:inline">
                                        <input type="hidden" name="quizId" value="<?php echo $qid;?>">
                                        <input type="hidden" name="retUrl" value="<?php echo $f->getRetUrl();?>">
                                        <button type="submit" name="publishQuiz" class="btn btn-mini btn-success">Publish Quiz</button>
                                    </form>
                                    <?php
									}
								}
							else if($rowQuizSelectPub['created_by_uid']==$userId&&$rowQuizSelectPub['is_published']==1){
								?>
                                 <form class="inline" style="display:inline">
                                 	<input type="hidden" name="quizId" value="<?php echo $qid;?>">
                                    <input type="hidden" name="retUrl" value="<?php echo $f->getRetUrl();?>">
	                                <button type="submit" name="unPublishQuiz" class="btn btn-mini btn-success">Upublish Quiz</button>
                                </form>
                                <?php
								}
							}
						?></h4>
                        
                        <div class="pre-scrollable">
                        <?php
                        	
							
							foreach($quizQuestionRows as $quizQuestion){
									$question="SELECT * FROM question WHERE id=".$quizQuestion['question_id']." LIMIT 1";
									$questionRow=$f->selectQuery($question);
									echo $countRows.'. <a href="#" class="brand">'.$questionRow['description']."</a>";
									echo '<br>';
									$countRows=$countRows-1;
								}
							
						?>
                        </div> <!-- Div Scrollable//-->
                        <?php
                        }
							else{
								echo 'Hi';
								}
						?>
                        <div class="well-small">
                       
                        </div> <!-- Div Small//-->
                    </div> <!-- Free Div /-->
                </div> <!-- Span 4 //-->
              </div> <!-- Row Fluid //-->
    	
        <div class="hero recent-users">
        	<img src="users/Koala.jpg" class="img-polaroid" data-src="300x200" />
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