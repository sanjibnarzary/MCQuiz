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
            	<div class="span10">
                    <div class="row-fluid">
                    	<div class="span3">
                        <img class="img-circle" src="/quiz/assets/img/sanjib.jpg">
                        My Twiiter Id <a href="http://twitter.com/SanjibNarzary">@sanjibnarzary</a>
                        </div>
                        <div class="span7">
                          <p>I am <strong>Sanjib Narzary</strong> and I have developed this website. You can reach me by <a href="http://www.twitter.com/sanjibnarzary">Twitter</a> or by mailing to san [AT] cit [DOT] ac [DOT] in.</p>
                          <p><br>
                        I am currently working as a <strong>Asst. Prof.</strong> at <strong>Central Institute of technology, Kokrajhar</strong><br>
                        </p>
                          <p>&nbsp;</p>
                          <p>I Graduated in<strong> Computer Science and Engineering</strong> from <strong>National Institute of Technology, Silchar</strong> and Post Graduated in <strong>Computer Science and Information Security</strong> from <strong>National Institute of Technology, Calicut.</strong><br>
                          </p>
                          <p>&nbsp;</p>
                          <p>My hobbies include writing codes at free times, playing footbal, watching movies and contributing to open source works.<br>
                        </p>
                          <p>&nbsp;</p>
                          <p>Besides my teaching jobs, I also coordinate BRX language in Gnome, Fedoraproject, Ubuntu launchpad and transifex.</p>
                          <p>&nbsp;</p>
                          <p>I am also a good blogger, but a bit careless. I have previously many blogs which I have forgotten many. Now i maintain my blog site <a href="http://www.gitspot.com">www.gitspot.com</a><br>
                          </p>
                          <p>&nbsp;</p>
                          <p>This website is written completely at free times during <strong>summer vacation of 2013</strong>. Neither CIT Kokrajhar nor its employee have the right to this site/any of the codes. </p>
                      </div>
                    </div>
                </div>
                <div class="span2">
                	
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