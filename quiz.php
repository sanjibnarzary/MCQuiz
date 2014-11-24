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
		
		//this is for the type of quiz
		if(isset($_GET['flt'])){
			$filter=$_GET['flt'];
			}
		else{
			$filter='all';
			}
			
		//this is the cursor for quiz filter
		if(isset($_GET['st'])){
				$start=$_GET['st'];
			}
		else{
				$start=0;
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
                            	<a href="/quiz/">Home</a>
                            </li>
                            
                            
                            <?php 
								if(isset($_GET['quiz-cat'])&&!isset($_GET['quiz-sub-cat'])){
									echo '<li class="divider">\</li>';
									echo '<li><a href="">&nbsp;Quiz&nbsp;</a></li>';
									echo '<li class="divider">\</li>';
									echo '<li class="active">&nbsp;'.str_replace('_',' ',$_GET['quiz-cat']).'&nbsp;</li>';
									}
								else if(isset($_GET['quiz-cat'])&&isset($_GET['quiz-sub-cat'])){
										echo '<li class="divider">\</li>';
										echo '<li>&nbsp;<a href="/quiz/quiz.php">Quiz</a>&nbsp;</li>';
										echo '<li class="divider">\</li>';
										echo '<li>&nbsp;<a href="quiz.php?quiz-cat='.$_GET['quiz-cat'].'">'.str_replace('_',' ',$_GET['quiz-cat']).'</a>&nbsp;</li>';
										echo '<li class="divider">\</li>';
										echo '<li class="active">&nbsp;'.str_replace('_',' ',$_GET['quiz-sub-cat']).'&nbsp;</li>';
									}
								else{
									echo '<li class="divider">\</li>';
									echo '<li class="active">&nbsp;Quiz&nbsp;</li>';
									}
							
							 ?>
                            
                        </ul>
                    </div><!-- End of breadcrumb-->
                    <div> <!-- Start of Quiz Categories-->
                    <?php 
						if(isset($_GET['quiz-cat'])){
							$quizCategory=$_GET['quiz-cat'];
							if(isset($_GET['quiz-sub-cat'])){
								$quizSubCategory=$_GET['quiz-sub-cat'];
								$selectQuizSubCategory="SELECT id FROM quiz_sub_category WHERE name='".$quizSubCategory."' LIMIT 1";
								$rowQuizSubCategoryID=$f->selectQuery($selectQuizSubCategory);
								?>
                                <!-- Added From Cat Remove-->
                                <div>
                                    <h4>Categories</h4>
                                    <div>
                                        <ul class="nav nav-pills">
                                            <li <?php if($filter=='all') echo 'class="active"'?>>
                                                <a href="quiz.php?quiz-cat=<?php echo $quizCategory?>&quiz-sub-cat=<?php echo $quizSubCategory?>&flt=all">All</a>
                                            </li>
                                            <li <?php if($filter=='recent') echo 'class="active"'?>>
                                                <a href="quiz.php?quiz-cat=<?php echo $quizCategory?>&quiz-sub-cat=<?php echo $quizSubCategory?>&flt=recent">Recent Quiz</a>
                                            </li>
                                            <li <?php if($filter=='challenges') echo 'class="active"'?>>
                                                <a href="quiz.php?quiz-cat=<?php echo $quizCategory?>&quiz-sub-cat=<?php echo $quizSubCategory?>&flt=challenges">Recent Challenges</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <div class="well-small">
                                        <?php
                                            if($filter=='challenges'){
                                        ?>
                                            
                                            <ul class="nav nav-pills" style="margin-top:-25px;margin-bottom:-10px;">
                                                <li <?php
                                                    if(isset($_GET['order']))
                                                        if(($_GET['order'])=='newest')
                                                            echo 'class="active"';
                                                        else if(($_GET['order'])=='')
                                                            echo 'class="active"';
                                                    else
                                                        echo '';
                                                ?>><a href="quiz.php?quiz-cat=<?php echo $quizCategory?>&quiz-sub-cat=<?php echo $quizSubCategory?>&flt=challenges&order=newest">Latest First</a></li>
                                                <li <?php
                                                    if(isset($_GET['order']))
                                                        if(($_GET['order'])=='oldest')
                                                            echo 'class="active"';
                                                        else
                                                            echo '';
                                                    else
                                                        echo '';
            
                                                ?>><a href="quiz.php?quiz-cat=<?php echo $quizCategory?>&quiz-sub-cat=<?php echo $quizSubCategory?>&flt=challenges&order=oldest">Oldest First</a></li>
                                            </ul>
                                        <?php
                                        }
                                        ?>
                                        </div>
                                        <p class="well well-small">
                                            
                                                
                                            <?php
                                                
                                            if($filter=='recent')
                                            {
                                                $strQuiz="SELECT * FROM quiz WHERE quiz_sub_category_id='".$rowQuizSubCategoryID[0]."' AND is_published=1 ORDER BY created_on DESC LIMIT $start,5";
                                            }
                                            else if($filter=='challenge'){
                                                    $strQuiz="SELECT * FROM quiz "; //yet to create
                                                }
                                            else{
                                                $strQuiz="SELECT * FROM quiz WHERE quiz_sub_category_id='".$rowQuizSubCategoryID[0]."' AND is_published=1 LIMIT $start,5";
                                            }	
                                            $rowQuizAll=$f->selectQueries("SELECT * FROM quiz");
                                            $rowQuizes=$f->selectQueries($strQuiz); 
                                            
                                            foreach($rowQuizes as $rowQuiz){
													$selectCountQuizQuestion="SELECT * FROM quiz_questions WHERE quiz_id='".$rowQuiz['id']."'";
													$quizQuestionCount=$f->selectQueries($selectCountQuizQuestion);
													
                                                ?>
                                                    <a href="quizquestion.php?quizid=<?php echo $rowQuiz['id']?>"><?php echo $rowQuiz['name'].' (Total <strong>'.count($quizQuestionCount).'</strong> Questions)<br>';?></a>
                                                <?php
                                                    
                                                }
                                            ?>
                                        </p>
                                        <div class="pagination pagination-mini pagination-centered">
                                            <ul>
                                                <?php 
                                                if($start<=0)
                                                    $cls='class="disabled"';
												else 
													$cls='';
                                                ?>
                                                <li <?php echo $cls;?>><?php if($start<=0){echo '<a href="#">&laquo; Prev</a>';}else{?><a href="quiz.php?quiz-cat=<?php echo $quizCategory?>&quiz-sub-cat=<?php echo $quizSubCategory?>&flt=<?php echo $filter?>&st=<?php echo ($start-5)?>">&laquo;Prev</a><?php }?></li>
                                                <?php 
                                                if(($start+12)>=count($rowQuizAll)){
                                                    $crs='class="disabled"';
												}else{
													$crs='';
													}
                                                ?>
                                                <li <?php echo $crs; ?>><?php if(($start+2)>=count($rowQuizes)){echo '<a href="#">Next &raquo;</a>';}else{?><a href="quiz.php?quiz-cat=<?php echo $quizCategory?>&quiz-sub-cat=<?php echo $quizSubCategory?>&flt=<?php echo $filter?>&st=<?php echo ($start+5)?>">Next &raquo;</a><?php }?></li>
                                            </ul>
                                        </div>
                                    </div>                        
                                </div>
                                <?php
								}
							else{
								$selectQuizCategory="SELECT * FROM quiz_category WHERE name='".$quizCategory."' LIMIT 1";
								$rowQuizCategory=$f->selectQuery($selectQuizCategory);
								echo '<h4>'.str_replace('_',' ',$rowQuizCategory['name']).'</h4>';
								echo '<div class="well-small">'.$rowQuizCategory['description'].'</div>';
								echo 'Categories under <strong>'.str_replace('_',' ',$rowQuizCategory['name']).'</strong><br>';
								echo '<div class="well-small">';
								if(isset($_GET['sub-cat-start'])&&!empty($_GET['sub-cat-start'])){
								$subCatStart=$_GET['sub-cat-start'];
								}
								else{
									$subCatStart=0;
									}
								$selectQuizSubCategory="SELECT * FROM quiz_sub_category WHERE quiz_category_id='".$rowQuizCategory['id']."' LIMIT ".$subCatStart.",10";
								$rowsQuizSubCategory=$f->selectQueries($selectQuizSubCategory);
								foreach($rowsQuizSubCategory as $rowQuizSubCategory){
									echo '<a href="quiz.php?quiz-cat='.$quizCategory.'&quiz-sub-cat='.$rowQuizSubCategory['name'].'">'.str_replace('_',' ',$rowQuizSubCategory['name']).'</a><br />';
									}
									//pagination
									?>
                                    <div class="pagination pagination-mini pagination-centered">
                                        <ul>
                                            <?php 
                                            if($subCatStart<=10)
                                                $clsSubCat='class="disabled"';
                                            else 
                                                $clsSubCat='';
                                            ?>
                                            <li <?php echo $clsSubCat;?>><?php if($subCatStart<=10){echo '<a href="#">&laquo; Prev</a>';}else{?><a href="quiz.php?quiz-cat=".$quizCategory."&sub-cat-start=<?php echo ($catStart-10)?>">&laquo;Prev</a><?php }?></li>
                                            <?php 
                                            if(($start+12)>=count($rowsQuizSubCategory)){
                                                $crsSubCat='class="disabled"';
                                            }else{
                                                $crsSubCat='';
                                                }
                                            ?>
                                            <li <?php echo $crsSubCat; ?>><?php if(($subCatStart+12)>=count($rowsQuizSubCategory)){echo '<a href="#">Next &raquo;</a>';}else{?><a href="quiz.php?quiz-cat=".$quizCategory."&sub-cat-start=<?php echo ($subCatStart+10)?>">Next &raquo;</a><?php }?></li>
                                        </ul>
                                    </div>
                                    <?php
								echo '</div>';
							}
							}
						else{
						echo '<h5>List of Quiz Sample Categories</h5>';
						echo '<div class="well well-small">';
						if(isset($_GET['cat-start'])&&!empty($_GET['cat-start'])){
								$catStart=$_GET['cat-start'];
							}
							else{
								$catStart=0;
								}
						$selectQuizCategory="SELECT * FROM quiz_category LIMIT ".$catStart.",10";
						$rowsQuizCategory=$f->selectQueries($selectQuizCategory);
						foreach($rowsQuizCategory as $rowQuizCategory){
							echo '<a href="quiz.php?quiz-cat='.$rowQuizCategory['name'].'">'.str_replace('_',' ',$rowQuizCategory['name']).'</a><br>';
							}
							//pagination
							?>
                            <div class="pagination pagination-mini pagination-centered">
                                <ul>
                                    <?php 
                                    if($catStart<=10)
                                        $clsCat='class="disabled"';
                                    else 
                                        $clsCat='';
                                    ?>
                                    <li <?php echo $clsCat;?>><?php if($catStart<=10){echo '<a href="#">&laquo; Prev</a>';}else{?><a href="quiz.php?cat-start=<?php echo ($catStart-10)?>">&laquo;Prev</a><?php }?></li>
                                    <?php 
                                    if(($start+12)>=count($rowsQuizCategory)){
                                        $crsCat='class="disabled"';
                                    }else{
                                        $crsCat='';
                                        }
                                    ?>
                                    <li <?php echo $crsCat; ?>><?php if(($catStart+12)>=count($rowsQuizCategory)){echo '<a href="#">Next &raquo;</a>';}else{?><a href="quiz.php?cat-start=<?php echo ($catStart+10)?>">Next &raquo;</a><?php }?></li>
                                </ul>
                            </div>
                            <?php
						echo '</div>';
						}
					?>
                    </div> <!-- Quiz Category -->
                    <!-- Cat Remove -->     
                    <?php
                    include('inc/quiz_middlebody_suggestion.php');
					?>                                          
           		</div>
                <div class="span4">
                	<?php
                    include('inc/quiz_sidebar.php');
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