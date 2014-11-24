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
    <title><?php echo $c->siteTitle().'Search'; ?></title>
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
            	<div class="span6">
                <div>
                	<h3 class="">Browse by Categories</h3>
                </div>
                	<?php
						if(true){
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
								$end=10;
								}
							
							
		 					
							$str="SELECT * FROM type_category WHERE id='".$cid."' OR name LIKE '%".$name."%' LIMIT ".$start.",".$end."";
							$rows=$f->selectQueries($str);
							if(!empty($rows)){
							foreach($rows as $row){
							
                    ?>
                    <h4><a class="brand" href="#"><?php echo $row['name']?></a></h4>
                    <p><?php echo $row['description'] ?> &nbsp;<a class="btn btn-mini">
                            browse more..
                        </a></p>
                    
                    <?php }
						}
						else{
							echo "No Results";
							} 
						}else{
							echo "Can not find your Request";
							}
					?>
           		</div>
                <div class="span4">
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