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
                    <form class="form-horizontal" method="post" action="bin/type_category_add.php">
                        <label>Category Name</label>
                                <input type="text" name="name" class="input-xlarge span6" placeholder="Name of Category"/>
                        <!-- <input type="hidden" value="<?php echo $row['id'] ?>" name="cid" /> -->
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
                        <label>Category Description</label><textarea name="description" class="input-xlarge span6" placeholder="Write the description of the Category so that users get to know about your category" required></textarea>
                        <label>Question Keywords</label><textarea name="keywords" class="input-xlarge span6" placeholder="Keywords (Optional) separated by commas e.g., sample, mcq, category" rows="1"></textarea>
                        <br>
                        <button type="submit" class="btn btn-small pull-right" style="margin-right:15%;" <?php 
								if($login){
										echo '';
									}
									else{
										echo 'disabled title="You Must Logged in to create category"';
										}
								?>>Create Category</button>
                    </form>       
                    <?php
							
							}
						else{
					?>
                    <div>
                        <h4>Add Choices for Question<a class="brand" href="#"> <strong><?php echo $qname; ?></strong></a></h4>
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