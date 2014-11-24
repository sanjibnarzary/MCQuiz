    <?php 
		require_once('inc/constants.php');
		require_once('inc/functions.php');
		$c=new Constants();
		$f=new Functions();
		if($f->isLoggedIn()){
			$login=1;
			@session_start();
			$user=$_SESSION['user'];
			}
		else{
			$login=0;
			$user=1;
			}
		if(isset($_GET['quizId'])){
				$quizId=$_GET['quizId'];
			}
			else{
				$quizId=1;
				}
		if(isset($_GET['userId'])){
			$userId=$_GET['userId'];
			}
			else{
				$userId=1;
				}
	?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
    <head>
    <title><?php echo 'Quiz Score | '.$c->siteTitle().''; ?></title>
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
					$strSelectQuizScore="SELECT * FROM `quiz_score` WHERE `quiz_id`='".$quizId."' AND `uid`='".$userId."' LIMIT 1";
					$rowQuizScore=$f->selectQuery($strSelectQuizScore);
					if(empty($rowQuizScore)){
						echo 'No score entry';
						}
					else{
						//many scores
						?>
                        <div class="well-small">
                        <strong>Score For the User</strong>
                            <div class="well-small">
                                Score: <strong><?php echo $rowQuizScore['score']?></strong> Attempted on <strong><span title="<?php echo $f->dateShow($rowQuizScore['quiz_time']);?>" class="inline"><?php echo $f->showTime($rowQuizScore['quiz_time']);?></span></strong>
                            </div>
                        </div>
                        <?php
						}
					if($login){
						include('inc/quiz_score_middle_login.php');
						}
					else{
						//not login code
						include('inc/quiz_score_middle_no_login.php');
						}
				?>
           		
                </div>
                <div class="span4">
                <?php include('inc/quizscore_sidebar.php');
				?>
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