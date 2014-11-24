<!-- Begin of Header//--> 
<?php
	if($f->getRetUrl()=='http://'.$_SERVER['HTTP_HOST'].'/quiz/'){
		$ds='class="active"';
		}
	else{
		$ds='';
		}
?> 
           	<div class="navbar navbar-inverse" style="position:static;">
    			<div class="navbar-inner">
                	<div class="container">
                  		<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    	<span class="icon-bar"></span>
                   	 	<span class="icon-bar"></span>
                    	<span class="icon-bar"></span>
                  		</a>
                  		<a class="brand" href="/quiz"><?php echo $c->siteTitle().''; ?></a>
                  		<div class="nav-collapse collapse navbar-inverse-collapse">
                    		<ul class="nav">
                      			<li <?php echo $ds ?>><a href="/quiz" class="">Home</a></li>
                      			<li><a href="/quiz/quiz.php">Take Quiz</a></li>
                      			<li><a href="/quiz/travia.php">Travia</a></li>
                                
                      			<li class="dropdown">
                        			<a href="#" class="dropdown-toggle" data-toggle="dropdown">More Feature<b class="caret"></b></a>
                        			<ul class="dropdown-menu">
                                    	<li><a href="/quiz/leaderboard.php">Leaderboard</a></li>
                                		<li><a href="/quiz/tutorial">Tutorials</a></li>
                                        <li><a href="/quiz/quizcreate.php">Create Quiz</a></li>
                          				<li><a href="questions.php">Create Question</a></li>
                          				<li><a href="category.php">Create Category</a></li>
                          				<li class="divider"></li>
                          				<li><a href="#">Frequently Asked Questions</a></li>
                          				<li><a href="#">Help!</a></li>
                        			</ul>
                      			</li>
                    		</ul>
                    		<form class="navbar-search pull-left form-search" action="/quiz/search.php" method="get">
                    		<div class="input-append">
								<input type="text" placeholder="Find a Test Question" class="span3 search-query input-large" name="name">
								<button type="submit" class="btn btn-success">Go</button>
							</div>
                    		</form>
                    		<ul class="nav pull-right">
                      			
                      			<li class="divider-vertical"></li>
                      			<li class="dropdown">
                                <?php if(!$f->isLoggedIn()){?>
                                
                        			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Register/Signin <b class="caret"></b></a>
                        			<ul class="dropdown-menu">
                          				<li><a href="#signInModal" role="button"  data-toggle="modal">Sign</a></li>
                          				<li><a href="#registerModal" role="button"  data-toggle="modal">Register</a></li>

                                        <li><a href="/quiz/about-sanjib.php">About Developer</a></li>
                          				<li class="divider"></li>
                          				<li><a href="#">Help!</a></li>
                        			</ul>
                                    
                                    <?php }
									else{
									?>
                                    
                                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Acoounts/Settings <b class="caret"></b></a>
                        			<ul class="dropdown-menu">
                          				<li><a href="#signInModal" role="button"  data-toggle="modal">Dashboard</a></li>
                          				<li><a href="/quiz/questions.php" role="button"  data-toggle="modal">Questions</a></li>

                                        <li><a href="/quiz/about-sanjib.php">About Developer</a></li>
                          				<li class="divider"></li>
                          				<li><a href="/quiz/bin/user_logout.php">Logout</a></li>
                        			</ul>
                                    
                                    <?php } ?>
                      			</li>
                    		</ul>
                  		</div><!-- /.nav-collapse -->
                	</div>
             	</div>
    		</div>
			<!-- End of Header//-->
    	