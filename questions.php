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
		if(isset($_SESSION['question_id'])&&isset($_SESSION['question_name'])){
				@session_start();
				$qid=$_SESSION['question_id'];
				@session_start();
				$qname=$_SESSION['question_name'];
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
    <title><?php echo 'Questions | '.$c->siteTitle().''; ?></title>
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
                    <h4>Create a Question</h4>
                    </div>
                    <form class="form-horizontal" method="post" action="./bin/question_add.php">
                        <label>Category</label>
                        <select name="category">
                       
                        	<?php
							@session_start();
							if(isset($_SESSION['question-category'])){
								@session_start();
								echo '<option value="'.$_SESSION['question-category'].'">'.str_replace('_',' ',$_SESSION['question-category-name']).'</option>';
								}else{}
                            	$str="SELECT * FROM type_category";
								try{
									$rows=$f->selectQueries($str);
									foreach($rows as $row){
											echo '<option value="'.$row['id'].'">'.str_replace('_',' ',$row['name']).'</option>';
											//echo '<input type="hidden" name="question-category-name" value="'.$row['name'].'">';
										}
								}
								catch(PDOException $e){
									echo $e->getMessage();
									}
							?>
                        </select>
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
                        <label>Question Description</label><textarea name="question" class="input-xlarge span7 ckeditor" placeholder="Write what is the content of the question. You will be able to add options later!" required></textarea>
                        <label>Question Keywords</label><textarea name="keywords" class="input-xlarge span7" placeholder="Keywords (Optional) separated by commas e.g., sample, mcq, mockquiz" rows="1"></textarea>
                        <br>
                        <button type="submit" class="btn btn-small pull-right" style="/*margin-right:15%;*/" <?php 
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
						else{
					?>
                    <div>
                        <h4>Add Choices for <a class="brand" href="#"><strong>Question</strong></a>
                        
                        
                                        <form class="inline" style="display:inline;" action="bin/question_choice_delete.php" method="post">
                                        	<input type="hidden" name="retUrl" value="<?php echo $f->getRetUrl();?>">
                                        	<input type="hidden" name="questionId" value="<?php echo $question_id ?>">
                                            <input type="hidden" name="userId" value="<?php if($login){
												@session_start();
												echo $_SESSION['user'];
												} ?>">
                                            <button type="submit" name="questionDel" class="btn btn-mini btn-danger" title="Delete this Question!">Delete Question</button>
                                            
                                        </form>
                                        
                        </h4><?php echo $qname; ?>
                    </div>
					<div class="well-small">
                    	<?php
                        	$str="SELECT * FROM question_choice WHERE question_id='".$qid."'";
							$strTCCount="SELECT * FROM question_choice WHERE question_id='".$qid."' AND is_right=1";
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
                            				</div>
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
                            				</div>
                                            <div class="input-append">
                                        <form class="inline" style="display:inline;" action="bin/question_choice_delete.php" method="post">
                                        	<input type="hidden" name="retUrl" value="<?php echo $f->getRetUrl();?>">
                                        	<input type="hidden" name="questionId" value="<?php echo $qid ?>">
                                            <input type="hidden" name="choiceId" value="<?php echo $row['id'] ?>">
                                            <button type="submit" name="choiceDel" class="btn btn-danger" title="Delete this Entry!">-</button>
                                            
                                        </form>
                                        </div>
                                             <?php
                                            if($row['is_right']==1){
															
														?>
                                            <form method="post" action="./bin/question_explain_add.php">
                                            <textarea name="explain" class="span5" placeholder="Explaination of Correct Answer if any"><?php
											$strSelect="SELECT * FROM question WHERE id=".$qid." LIMIT 1";
											$rowSelect=$f->selectQuery($strSelect);
											$explain=$rowSelect['explain'];
											echo $explain;
                                            ?></textarea>
                                            <input type="hidden" name="question-id" value="<?php echo $qid ?>">
                                            <button class="btn alert-error" type="submit" <?php 
												 if($login)
												 {echo '';}
												 else{echo 'disabled';}
												 ?>>Add/Update
                                            </button>
                                            </form>
											<?php } ?>
                                            <br/>
                                            <?php
										}
								}
							catch(PDOException $e){
								echo $e->getMessage();
								}
						?>
                        <div id="choiceSubmitted">
                        </div>
                        <div id="questionChoice">
                            
                            <form class="form-horizontal" id="choiceForm" data-async data-target="#questionChoice" action="./bin/question_choice_add.php" method="POST">
                                <div class="input-prepend">
                                    <span class="add-on"><input type="radio"></span>
                                    <input type="text" name="choice" placeholder="Give a Choice name" class="span4 input-large">
                                 </div>
                                 <input type="hidden" name="qid" value="<?php echo $qid; ?>" />
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
                                </div>
                                 <button type="submit" class="btn btn-warning"  id="choiceSubmit" <?php 
								 if($login){
									 }
									 else{
										 echo 'diabled';
										 }
								 ?>>Add Choice</button>
                            </form>
                        </div>
                        
                    </div>  
                    <a href="./bin/add_new_question.php" class="btn btn-success">Add New Question</a> 
                    <?php }?>                 
           		</div>
                <div class="span3">
                	<div>
                    	<h3>Recent Quizes</h3>
                        
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