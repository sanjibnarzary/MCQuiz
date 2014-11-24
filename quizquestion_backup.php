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
	?>
    <?php
	
		if(isset($_GET['quizid'])){
			$quizid=$_GET['quizid'];
			}
		else{
			$cid=0;
			}
		if(isset($_GET['name'])){
				$name=$_GET['name'];
			}
		else{
			$name="Computer";
			}
		if(isset($_GET['start'])){
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
			}
		else{
			echo "You must specify correct Quiz";
			}
	?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
    <head>
    <title><?php echo 'Quiz | '.$c->siteTitle().''; ?></title>
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
                <div><!--
                	<h5><?php echo $name; ?></h5>
                    <p class="well-small brand">
                    <?php
                    	echo $description;
					?>
                    </p>
                    -->
                    <table class="table-striped">
                        <tr>
                         	<td>Start Time: </td><td>00:00pm</td> <td>Time Elapsed: </td><td><?php date_default_timezone_set('Asia/Calcutta'); echo date('H:i:s')?></td> 
                        </tr>
                    </table> 
                </div>
                	<?php
						if(true){
							
							
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
                    <p>Q<?php echo $count;$count=$count+1;?>#:&nbsp;<strong><?php 
					$selectQuestionQuiz="SELECT * FROM question WHERE id=".$rowQuizQuestion['question_id']." LIMIT 1";
					$rowQuestion=$f->selectQuery($selectQuestionQuiz);
					
					echo $rowQuestion['description']; ?></strong></p>
                    <div class="well-small">
                    	<?php
                        	$str="SELECT * FROM question_choice WHERE question_id='".$rowQuestion['id']."' ORDER BY RAND()";
							try{
									$rows1=$f->selectQueries($str);
									foreach($rows1 as $row1){
											?>
                                            <div class="input-prepend">
                                            <!-- A code will be added to the radio so that if a user is already taken that quiz then he can view what option he has previously opted for-->
                        						<span class="add-on"><input type="radio" name="choice"></span>
                                                <input type="text" class="span5" value="<?php echo $row1['choice']?>" disabled>
                            				</div>
                                            <?php 
                                                    if($row1['is_right']==0)
                                                        {
															echo '<div class="collapse" style="display:inline-block"></div>';
															
															}
                                                    else
                                                        {
															?>
                                                           
                                                           <div id="ans<?php echo $rowQuizQuestion['id']?>" class="collapse" style="display:inline-block;margin-bottom:0px; vertical-align:middle;color:#0F6;" >
                                                            <div id="ans<?php echo $rowQuizQuestion['id']?>" class="input-prepend" >
                                                                <span class="add-on"><i class="<?php 
                                                                if($row1['is_right']==0)
                                                                    echo '';
                                                                else
                                                                    echo 'icon-check';
                                                                ?>"></i></span>
                                                                <input type="text" class="span1" value="<?php 
                                                                if($row1['is_right']==0)
                                                                    echo '';
                                                                else
                                                                    echo 'Answer';
                                                                ?>" disabled>
                                                            </div>
                                                          </div>
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
                        <a class="btn btn-mini btn-success">Submit Answer</a>&nbsp;<button type="button" class="btn btn-info btn-mini" data-toggle="collapse" data-target="#ans<?php echo $rowQuizQuestion['id']?>">Submit for review</button>&nbsp;<a class="btn btn-mini">Clear Answer</a> 
  
 
&nbsp; <?php echo $rowQuestion['created_on'].' '.$rowQuestion['created_by_uid']; ?>
                        </div>
                        
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
                    <?php
						}
						else{
							//this will be implemented because here if quiz does not have questions then there will be option for adding questions on that quiz if he/she is the real creator else will be redirected to another
							$row=$f->selectQuery("SELECT * FROM type_category WHERE name='".$name."' LIMIT 1");
							
							if(empty($row)){
								echo "<span class=\"alert-error\"><b>$name</b> Category does not Exists, Do you want to Create <strong>$name</strong> category?</span>";
								?>
                                <form class="form-horizontal" method="post" action="bin/type_category_add.php">
                                <br>
                            	<label>Category Name</label>
                                <input type="text" value="<?php echo $name; ?>" name="name" class="input-xlarge span6" disabled/>                                <input type="hidden" value="<?php echo $name; ?>" name="name" class="input-xlarge span6" />
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
                                <label>Category Description</label><textarea required name="description" placeholder="Write Description about <?php echo $name; ?>" class="input-xlarge span6"></textarea>
                                <label>Category Keywords</label><textarea required name="keywords" rows="1" placeholder="Write keywords like <?php echo $name?>, UPSC, MockQuiz" class="input-xlarge span6"></textarea><br>
                                <button type="submit" class="btn btn-small pull-right" style="margin-right:15%;" <?php 
								if($login){
										echo '';
									}
									else{
										echo 'disabled title="You Must Logged in to Add New Category"';
										}
								?>>Create Category</button>
                            </form>
                                <?php
								
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
							echo "Can not find your Request";
							}
					?>
           		</div>
                <div class="span4">
                	<div>
                    	<div style="height:250px;width:auto; border:dashed; border-style:dashed">
                        	Ads Area
                        </div>
                    	<strong><u><h5>Questions (<?php echo $questionsCount;?>)</h5></u></strong>
                        <div class="well-small">
                        <?php 
							if($login){
									@session_start;
									$user=$_SESSION['user'];
								}
							else{
								$user=0;
								}
							$quizQuestionCounter=1;
							$strRev="SELECT id FROM user_quiz_answers WHERE quiz_id='".$quizid."' AND uid='".$user."'";
							
							foreach($rowsQuizQuestion as $rowQuizQuestion){
								?>
									 <div class="success-circle"><a href="/quiz/quizquestion.php?quizid=<?php echo $quizid ?>&start=<?php echo ($quizQuestionCounter-1) ?>"><?php echo $quizQuestionCounter?></div>
                                     <?php
									$quizQuestionCounter++;
								}
							
						?>
                        </div>
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