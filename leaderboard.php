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
		
				
		if(isset($_GET['userId'])){
			$userId=$_GET['userId'];
			}
			else{
				$userId=1;
				}
				@session_start();
				if(!isset($_SESSION['refreshed'])){ 
				$strUsers="SELECT uid FROM user";
				$rowUsers=$f->selectQueries($strUsers);
				$strDelLeaderboardTemp="DELETE FROM `user_leaderboard_score_temp` WHERE 1";
					if($f->insertUpdateQuery($strDelLeaderboardTemp)>=0){
						//echo 'deleted';
						}
					else{
						//echo 'not deleted';
						}
				$strDelLeaderboard="DELETE FROM `user_leaderboard_score` WHERE 1";
					if($f->insertUpdateQuery($strDelLeaderboard)>=0){
						//echo 'deleted';
						}
					else{
						//echo 'not deleted';
						}
				foreach($rowUsers as $rowUser){
					$strQuizScore="SELECT SUM(t.score) AS total FROM (SELECT score FROM quiz_score WHERE uid='".$rowUser['0']."' UNION ALL SELECT score FROM user_travia_score WHERE uid='".$rowUser['0']."') t LIMIT 1";
					$rowQuizScore=$f->selectQuery($strQuizScore);
					$strInsertLeaderboard="INSERT INTO `user_leaderboard_score_temp`(`uid`, `score`) VALUES ('".$rowUser['0']."','".$rowQuizScore['0']."')";
					if($f->insertUpdateQuery($strInsertLeaderboard)>=0){
						//echo 'inserted';
						}
					else{
						//echo 'not not inserted';
						}
					}
				//$strQuizScore="SELECT SUM(score) FROM quiz_score WHERE uid='".."'";
				$strLeaderboard="SELECT * FROM `user_leaderboard_score_temp` ORDER BY score DESC";
				$rowsLeaderboard=$f->selectQueries($strLeaderboard);
				$rank=1;
				foreach($rowsLeaderboard as $rowLeaderboard){
					//echo '<br>Your Rank #'.$rank.' '.$rowLeaderboard['uid'].' Total '.$rowLeaderboard['score'].'<br>';
					$strInsertLeaderboardRank="INSERT INTO `user_leaderboard_score`(`rank`, `score`, `uid`) VALUES ('".$rank."','".$rowLeaderboard['score']."','".$rowLeaderboard['uid']."')";
					if($f->insertUpdateQuery($strInsertLeaderboardRank)>=0){}else{}
					$rank=$rank+1;
					}
				@session_start();
				$_SESSION['refreshed']="refreshed";
				}else{
					//already refreshed the score
					}
				if(isset($_GET['refresh'])){
					@session_start();
					unset($_SESSION['refreshed']);
					}
	?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
    <head>
    <title><?php echo 'Leaderboard | '.$c->siteTitle().''; ?></title>
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
                <ul class="breadcrumb">
                    	<li>
                        	<a href="/quiz">Home</a>
                        </li>
                        <li class="divider">
                        \
                        </li>
                        
                        <li>
                        <a href="/quiz/leaderboard.php">Leaderboard</a>
                        </li>
                        <li class="divider">
                        \
                        </li>
                        <li class="active">
                        Rankings
                        </li>
                        <li class="pull-right">
							<a href="/quiz/leaderboard.php?refresh">Refresh</a>
                        </li>
                    </ul>

                <table class="table table-striped">
                
                <tr style="background:#666;">
                <td>Rank</td><td>User</td><td>Total Scores</td>
                </tr>
                
                <?php
				if($login){						
					$strLeaderboardRankUser="SELECT * FROM `user_leaderboard_score` WHERE uid='".$user."' LIMIT 1";
					$rowLeaderboardRankUser=$f->selectQuery($strLeaderboardRankUser);
					$strUser="SELECT name FROM user WHERE uid='".$rowLeaderboardRankUser['uid']."' LIMIT 1";
					$rowUserName=$f->selectQuery($strUser);
					echo '<tr style="background:#CCC;"><td>#'.$rowLeaderboardRankUser['rank'].'</td><td> '.$rowUserName['0'].'</td><td>'.$rowLeaderboardRankUser['score'].'</td></tr>';

					}
				?>
                
                <?php
				if($login){
					$strLeaderboardRank="SELECT * FROM `user_leaderboard_score` WHERE uid!='".$user."' ORDER BY rank ASC";
					}
				else{
				$strLeaderboardRank="SELECT * FROM `user_leaderboard_score` ORDER BY rank ASC";
				}
				$rowsLeaderboardRank=$f->selectQueries($strLeaderboardRank);
				
				foreach($rowsLeaderboardRank as $rowLeaderboardRank){
					$strUser="SELECT name FROM user WHERE uid='".$rowLeaderboardRank['uid']."' LIMIT 1";
					$rowUserName=$f->selectQuery($strUser);
					echo '<tr><td>#'.$rowLeaderboardRank['rank'].'</td><td> '.$rowUserName['0'].'</td><td>'.$rowLeaderboardRank['score'].'</td></tr>';
					
					}
					
				?>
                </table>
           		
                </div>
                <div class="span4">
                <?php include('inc/leaderboard_sidebar.php');
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