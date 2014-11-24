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
	?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
    <head>
    <title><?php echo 'Travia'.$c->siteTitle().''; ?></title>
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
                	<p>You are Taking Travia on <strong><?php 
					if(isset($_SESSION['travia-category'])&&isset($_SESSION['travia-category-id'])){
						$tq=$_SESSION['travia-category'];
						echo $tq;
						$traviaCategory="AND q.type_category_id='".$_SESSION['travia-category-id']."'";
						}
					else{
						$traviaCategory='';
						echo 'all';
						}
					?> </strong>Category <?php
					if(isset($_GET['cat'])){
						$change=$_GET['cat'];
						if($change=='change'){
							$strCategorySelect="SELECT * FROM type_category";
							$rowsCategory=$f->selectQueries($strCategorySelect);
							?>
                            <form method="post" class="form form-inline" action="/quiz/bin/travia_change_category.php">
                            	<select name="category">
                                	<option value="">All Category</option>
                                	<?php
                                    foreach($rowsCategory as $rowCategory){
											echo '<option value="'.$rowCategory['id'].'">'.str_replace('_',' ',$rowCategory['name']).'</option>';
										}
									?>
                                </select>
                                <button type="submit" class="btn btn-small">Change</button>
                            </form>
                            <?php
							}
					}else{
                    ?><?php if($login){?><a href="travia.php?cat=change" disabled>Change</a><?php }?>
                    
                    <?php } ?></p>
                </div>
                	<?php
						if($login==1){
							@session_start();
							$user=$_SESSION['user'];
							$strSelectUserTraviaScore="SELECT `score` FROM `user_travia_score` WHERE uid='".$user."' LIMIT 1";
							//select a random question
							$rowTraviaScore=$f->selectQuery($strSelectUserTraviaScore);
							if(empty($rowTraviaScore)){
								$score=0;
								}
							else{
								$score=$rowTraviaScore['score'];
								}
							
							$selectTraviaQuestion="SELECT q.* FROM question q LEFT JOIN user_travia_answer ta ON q.id=ta.question_id WHERE (ta.uid='".$user."' AND ta.question_id) IS NULL $traviaCategory ORDER BY RAND() LIMIT 1";
							$rowTraviaQuestion=$f->selectQuery($selectTraviaQuestion);
							echo '<div class="pull-right" style="display:block;padding-right:55px;">Your Travia Total Score:<div class="alert-success" style="display:inline-block; border-radius:20px 20px 20px 20px; font-weight:900; text-align:center; min-width:65px;">'.$score.'</div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Reward Mark <div title="Correct Answer Will Rewarded 1 Point" class="success-circle">1</div>&nbsp;Penalty Mark <div title="Wrong Answer have Penalty 0 Point" class="red-circle">0</div></div><br><br>';
							
							
					?>
                    	<div class="well-small">
                        <?php
						if(empty($rowTraviaQuestion)){
							?>
                            <div class="well-small">
                            You have Attempted All the Question<br>
                            <a href="/quiz/quiz.php" class="btn-link">Take A Quiz Now</a>
                            </div>
                            <?php
							}
						else{
                        echo '<div class="span6 question-description"><strong>Question: </strong>'.$rowTraviaQuestion['description'].'</div>';
						?>
                        <form method="post" action="/quiz/bin/travia_answer.php">
							<div class="well-small">
								<?php
								
                                    $strChoice="SELECT * FROM question_choice WHERE question_id='".$rowTraviaQuestion['id']."' ORDER BY RAND()";
                                    try{
                                            $rows1=$f->selectQueries($strChoice);
                                            foreach($rows1 as $row1){
                                                    ?>
                                                    <div class="input-prepend">
                                                        <span class="add-on"><input type="radio" name="choice" value="<?php echo $row1['id']?>"></span>
                                                        <input type="text" class="span5" value="<?php echo $row1['choice']?>" disabled>
                                                        
                                                    </div>
                                                    <input type="hidden" name="travia-qid" value="<?php echo $rowTraviaQuestion['id']?>">
                                                    <input type="hidden" name="user" value="<?php 
														@session_start(); 
														echo $_SESSION['user']
													?>">
                                                   <!-- Revoved -->
                                                    
                                                    <br/>
                                                    <?php
                                                }
                                        }
                                    catch(PDOException $e){
                                        echo $e->getMessage();
                                        }
                                ?>
                                <div>
                                <button type="submit" class="btn btn-success btn-mini">Attempt/Submit this Question</button>&nbsp;<a class="btn btn-mini" href="/quiz/travia.php">Skip this Question</a> 
          
         
        &nbsp; <!-- <?php /* echo $rowTraviaQuestion['created_on'].' '.$rowTraviaQuestion['created_by_uid']; */?> //-->
                                </div>
                                <div style="border:dotted;height:150px;display:block;margin-left:-10px;padding-left:-10px;">
                                Ads Travia
                        </div>
                            </div> <!-- Div class well small Inner -->
                            </form>
                            <?php
						}
							?>
                        </div><!-- Div class well small outer -->
					<?php
							}
						else{
								
                    ?>
                    	<div class="well-small"><a href="#signInModal" role="button"  data-toggle="modal">You Must Login to Take Travia</a></div>
                    <?php }?>
           	</div>
            <div class="span4">
                <div>
                    <?php
                    include('inc/sidebar_right.php');
					?>
                    
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