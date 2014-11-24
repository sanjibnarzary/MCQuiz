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
			
			?>
    <div class="row-fluid">
    <div class="span8">
    <div class="well-small">
                                <form class="form-horizontal" method="post" action="bin/type_category_add.php">
                                <br>
                            	<label>Category Name</label>
                                <input type="text" name="name" class="input-xlarge span8" placeholder="Name of Category"/>
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
                                <label>Category Description</label><textarea required name="description" placeholder="Write Description about the category" class="input-xlarge span8"></textarea>
                                <label>Category Keywords</label><textarea required name="keywords" rows="1" placeholder="Write keywords like UPSC, MockQuiz" class="input-xlarge span8"></textarea><br>
                                <button type="submit" class="btn btn-small btn-success"  <?php 
								if($login){
										echo '';
									}
									else{
										echo 'disabled title="You Must Logged in to Add New Category"';
										}
								?>>Create Category</button>
                            </form>
</div>
</div>
<div class="span4">
hi
</div>
</div><!-- row Fluid-->
</div>
</body>
</html>