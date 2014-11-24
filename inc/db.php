<?php
/*
**@author Sanjib Narzary
*/
	class DBCon{
			public $username;      
    		public $password;       
    		public $db;
		function conN(){
				$username='root';        
    		 	$password = '';        
    			$db='mockquiz'; 
        		$conn = new PDO('mysql:host=127.0.0.1;dbname='.$db.'',$username, $password);
        		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		}
		
	}
?>
