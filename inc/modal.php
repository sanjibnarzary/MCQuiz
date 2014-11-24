<div id="signInModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 id="myModalLabel">Signin</h3>
			</div>
			<div class="modal-body">
            <center>
				<div class="fb-login">
                	<span class="fb-icon">
                    </span>
                    <span class="fb">
                    Login with <strong>Facebook</strong>
                    </span>
                </div>
                <div class="google-login">
                	<span class="google-icon">
                    </span>
                    <span class="google">
                    Login with <strong>Google</strong>
                    </span>
                </div>
                <div class="or">
                OR 
                </div>
            	
                <form class="form-modal form-inline form-horizontal" id="signInForm" data-async data-target="#signInModal" action="/quiz/bin/user_login.php" method="POST">
                <input type="hidden" name="redUrl" value="<?php echo $f->getRetUrl()?>">
                <div class="input-prepend"><span class="add-on">
                <i class="icon-user"></i></span>
                	<input type="text" class="input-medium" name="user">
                    </div>
                    <div class="input-prepend"><span class="add-on"><i class="icon-lock"></i></span><input type="password" class="input-medium" name="password"></div>&nbsp;&nbsp;<button type="submit" id="submitSignIn" class="btn btn-medium btn-success">Sign in</button>
                    <div>
                        <label class="checkbox">
                            <input type="checkbox" class="input-small"> Keep me login
                        </label>&nbsp;&nbsp;&nbsp;
                        <label class="checkbox">
                            <a class="btn-link"> Forgot your password?</a>
                        </label>
                     </div>
                </form>
                
            </center>
			</div>
			<div class="modal-footer">
				<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">Close</button>
				
			</div>
		</div>
    
    	<div id="registerModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 id="myModalLabel">Register</h3>
			</div>
			<div class="modal-body">
				<center>
				<div class="fb-login">
                	<span class="fb-icon">
                    </span>
                    <span class="fb">
                    Register with <strong>Facebook</strong>
                    </span>
                </div>
                <div class="google-login">
                	<span class="google-icon">
                    </span>
                    <span class="google">
                    Register with <strong>Google</strong>
                    </span>
                </div>
                <div class="or">
                OR 
                </div>
            	<div>
                	 <form class="form-horizontal" data-async data-target="#registerModal" action="/quiz/bin/user_add.php" method="POST">
                    
                    
                       <div class="input-prepend">
                            
                            <span class="add-on"><i class="icon-user"></i></span>
                            <input class="input-large" id="prependedInput" name="name" type="text" placeholder="Your Name">
                        </div>
                       <!-- <span class="help-inline">Username Taken</span> //-->
                     
                    <br />      <br />               
                       <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                            <input class="input-large" id="prependedInput" type="email" name="email" placeholder="Email">
                        </div>
                        <!-- <span class="help-inline">Something may have gone wrong</span> //-->
                   	<br /><br />
                         <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            <input class="input-large" id="prependedInput" type="password" name="password" placeholder="Password">
                        </div>
                       <!-- <span class="help-inline">Password must not empty</span> //-->
                    	<br />
                        <br />
                        
                        <div style="display:block;padding-left:20%; padding-right:25%">
                        <label class="checkbox">
                                    <p style="font-size:9px;"><input type="checkbox" required>By clicking <a class="brand">Create Account</a>, you agree to our <a class="brand">Terms</a> and that you have read our <a class="brand">Data use policy</a>, including our <a class="brand">Cookie Use</a>.</p>
                                </label>
                        </div>
                        
                        
                       
                        <button type="submit" id="submitRegister" class="btn btn-medium btn-success">Create Account</button>
                    
                </form>
                </div>
                
            </center>
			</div>
			
		</div>
        
        <div id="feedback" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 id="myModalLabel">Give us Feedback</h3>
			</div>
			<div class="modal-body">
				<center>
            	<div>
                	 <form class="modal-form form-horizontal" id="feedbackForm">
                    
                    
                       <table class="tbl">
                       	<tr>
                        	<td>Your Name</td><td><input type="text" class="input-xlarge" name="fromName"></td>
                        </tr>
                        <tr>
                        	<td>Subject Line</td><td><input type="text" class="input-xlarge" name="subjectLine"></td>
                        </tr>
                        <tr>
                        	<td>Message Body</td><td><textarea class="input-xlarge" name="feedbackBody"></textarea></td>
                        </tr>
                       </table>
                    
                       <!-- <span class="help-inline">Password must not empty</span> //-->
                    	<br />
                        <br />
                        
                        
                        
                       
                    
                </form>
                </div>
              
	         <button class="btn btn-success" id="submitFeedback">Give Feddback!</button>
	         
                </center>
                
            
			</div>
			
		</div>