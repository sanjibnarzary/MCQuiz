<?php
/*
**@author Sanjib Narzary
*/
	class DBCon{
		public $username;      
    		public $password;       
    		public $db;
		function conN(){
			//Here you must put your database username
			$username='root';       
			//This field is for password, if your database have password protected user that use that password in plaintext
    		 	$password = '';        
    		 	//This field is for database name change it for your corresponding database name
    			$db='mcquiz'; 
        		$conn = new PDO('mysql:host=127.0.0.1;dbname='.$db.'',$username, $password);
        		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		}
		
	}
?>
