    <?php 
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
    <title><?php echo $c->siteTitle().' | Quiz'; ?></title>
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
                    <h4>Create a Quiz Category</h4>
                    </div>
                    <form class="form-horizontal" method="post" action="./bin/quizcat_add.php">
                    	<label>Quiz Category</label>
                        <input type="text" class="input-large span6" name="name" placeholder="Name of Category">
                        <label>Category</label>
                        <select name="category">
                        	<option value="0">Parent</option>
                        	<?php
                            	$str="SELECT * FROM quiz_category";
								try{
									$rows=$f->selectQueries($str);
									foreach($rows as $row){
											echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
										}
								}
								catch(PDOException $e){
									echo $e->getMessage();
									}
							?>
                        </select>
                        
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
                        <label>Quiz Category Description</label><textarea name="description" class="input-xlarge span6" placeholder="Write what is the description or purpose of the Quiz Category." required></textarea>
                        <label>Quiz Category Keywords</label><textarea name="keywords" class="input-xlarge span6" placeholder="Keywords (Optional) separated by commas e.g., sample, mcq, interview, mockquiz" rows="1"></textarea>
                        <br>
                        <button type="submit" class="btn btn-small pull-right" style="margin-right:15%;" <?php 
								if($login){
										echo '';
									}
									else{
										echo 'disabled title="You Must Logged in to Add New Quiz"';
										}
								?>
                                >Create Quiz Category</button>
                    </form>       
                    <?php
							
							}
						else{
					?>
                    <div>
                        <h4><a class="brand" href="#">Add Question for <strong><?php echo $qname; ?> </strong>Quiz</a></h4>
                    </div>
					<div class="well-small">
                    	<?php
                        	$str="SELECT * FROM question_choice WHERE question_id='".$qid."' ORDER BY RAND()";
							try{
									$rows=$f->selectQueries($str);
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
                                    <input type="hidden" value="0" name="isRight">
                                    <span class="add-on"><input type="checkbox" value="1" name="isRight"></span>
                                    <input type="text" disabled value="isRight?" class="span1">
                                </div>
                                 <button type="submit" class="btn btn-warning"  id="choiceSubmit">Add Choice</button>
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