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
    <title><?php echo $c->siteTitle().''; ?></title>
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
                	<h4>Browse Questions by Categories</h4>
                </div>
                	<?php
						$str="SELECT * FROM type_category ORDER BY RAND() LIMIT 0,3";
						$rows=$f->selectQueries($str);
						foreach($rows as $row){
							
                    ?>
                    <strong><a class="btn btn-link" href="catq.php?name=<?php echo $row['name'] ?>"><?php echo str_replace('_',' ',$row['name'])?></a></strong>
                    <blockquote><div class="well-small"><?php echo str_replace('_',' ',$row['description']) ?><a href="catq.php?name=<?php echo $row['name'] ?>" class="btn btn-link btn-mini">
                            browse more..
                        </a></div></blockquote>
                    
                    <?php } ?>
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