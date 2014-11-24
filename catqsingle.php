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
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
    <head>
    <title><?php echo 'Single Question | '.$c->siteTitle().''; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/quiz/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/quiz/assets/css/style.css" rel="stylesheet">
    </head>
    <body>
    <div class="container">   
    		<?php
            	include('inc/header.php');
				
				if(isset($_GET['cid'])){
					$cid=$_GET['cid'];
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
        	 <div class="container-fluid well-small">
				<!--Body content-->
            	<div class="span7">
                <div>
                	<ul class="breadcrumb">
                    	<li>
                        	<a href="#">Tutorial</a>
                        </li>
                        <li class="divider">
                        \
                        </li>
                        <li>
                        	<a href="/quiz/tutorial">Category</a>
                        </li>
                        <li class="divider">
                        \
                        </li>
                        <li>
                        	<a href="/quiz/tutorial/<?php echo $name?>"><?php echo str_replace('_',' ',$name)?></a>
                        </li>
                        <li class="divider">
                        	\
                        </li>
                        <li class="active">
                        Single Question View
                        </li>
                    </ul>
                </div><!-- End of breadcrumb-->
                <div>
                	<h4>Category <?php echo str_replace('_',' ',$name); ?></h4>
                    <p class="well-small brand">
                    <?php
                    	$str1="SELECT * FROM type_category WHERE name='$name'";
						$row=$f->selectQuery($str1);
						echo $row['description'];
						$cid=$row['id'];
					?>
                    </p>
                </div>
                	<?php
						if(true){
							
							
							
		 					
							$str="SELECT * FROM question WHERE type_category_id='".$cid."' AND id=".$start." LIMIT 1";
							$rowQuestions=$f->selectQueries($str);
							if(!empty($rowQuestions)){
								$count=$start+1;
							foreach($rowQuestions as $row){
							
                    ?>
                    
                    <strong><a class="brand" href="/quiz/tutorial/<?php echo $name ?>/question/single/<?php echo $row['id']?>">Q<?php echo $start;//$count;$count=$count+1;?>#:</a></strong>&nbsp;<br><div class="question-description span6"><?php echo $row['description']; ?></div><br/>
                    <div class="well-large">
                    	<?php
                        	$str="SELECT * FROM question_choice WHERE question_id='".$row['id']."' ORDER BY RAND()";
							try{
									$rows1=$f->selectQueries($str);
									foreach($rows1 as $row1){
											?>
                                            <div class="input-prepend">
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
                                                           
                                                           <div id="ans<?php echo $row['id']?>" class="collapse" style="display:inline-block;margin-bottom:0px; vertical-align:middle;color:#0F6;" >
                                                            <div id="ans<?php echo $row['id']?>" class="input-prepend" >
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
                        <button type="button" class="btn btn-success btn-mini" data-toggle="collapse" data-target="#ans<?php echo $row['id']?>">Submit/View Answer</button>&nbsp;<button type="button" class="btn btn-info btn-mini" data-toggle="collapse" data-target="#explain<?php echo $row['id']?>">Show Explaination</button>
  
 
&nbsp; <div style="display:inline-block;font-size:10px;line-height:8px;padding-top:3px;border-top:3px">Created by <strong><?php
$selectUser="SELECT name FROM user WHERE uid=".$row['created_by_uid']." LIMIT 1"; $rowName=$f->selectQuery($selectUser); echo '<strong>'.$rowName['name'].' <br> On '.$row['created_on']; ?></strong></div>
                        </div>
                        <div id="explain<?php echo $row['id']?>" class="collapse">
                       		<div style="font-size:12px;font-weight:200"> <br><strong>Explaination:</strong><br><span><?php echo $row['explain']?></span>
                            </div>
                        </div>
                        
                    </div>
                    
                    <?php }
					?>
                    <div class="pagination pagination-centered">
                        <ul>
                        	<?php 
								$rowQuizPrev=$f->selectQuery("SELECT MAX(id) FROM question WHERE type_category_id='".$cid."' AND id < ".$start." LIMIT 1");
								$rowQuizNext=$f->selectQuery("SELECT MIN(`id`) FROM question WHERE type_category_id='".$cid."' AND id > ".$start." LIMIT 1");
								//print_r($rowQuizPrev[0]);
								//print_r($rowQuizNext[0]);
							?>
                        	<?php //echo count($rowQuizAll);
								if(empty($rowQuizPrev[0])){
										$cls='class="disabled"';
									}
								else{
										$cls='';
									}
								if(empty($rowQuizNext[0])){
										$crs='class="disabled"';
									}
								else{
										$crs='';
									}
									/*if($start<=0)
										$cls='class="disabled"';
									else
										$cls='';*/
									?>
                                	<li <?php echo $cls;?>><?php if(!$cls==''){echo '<a href="#">&laquo; Prev</a>';}else{?><a href="/quiz/tutorial/<?php echo $name; ?>/question/single/<?php echo $rowQuizPrev[0]?>">&laquo;Prev</a><?php }?></li>
                                    <?php 
										
									
									?>
                                    <li <?php echo $crs; ?>><?php 
										if(!$crs==''){
											echo '<a href="#">Next &raquo;</a>';
										}else{
											?>
                                            <a href="/quiz/tutorial/<?php echo $name; ?>/question/single/<?php
												 	echo $rowQuizNext[0];
												?>">Next &raquo;
                                             </a>
											<?php 
												}
											?>
                                      </li>
                            
                        </ul>
                    </div><!-- Pagination Ends -->
                    <div style="border:dotted;height:150px;display:block;margin-left:-10px;padding-left:-10px;">
                    </div>
                    <?php
						}
						else{
							
							$row=$f->selectQuery("SELECT * FROM type_category WHERE name='".$name."' LIMIT 1");
							
							if(empty($row)){
								echo "<span class=\"alert-error\"><b>$name</b> Category does not Exists, Do you want to Create <strong>$name</strong> category?</span>";
								?>
                                <form class="form-horizontal" method="post" action="/quiz/bin/type_category_add.php">
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
                            
                            <form class="form-horizontal" method="post" action="/quiz/bin/question_add.php">
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
                    	<h4>Recent Quizes</h4>
                        
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