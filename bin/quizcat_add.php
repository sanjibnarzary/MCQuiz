<?php
$name=$_POST['name'];
$category=$_POST['category'];//if the category is parent the its value is 0
$description=$_POST['description'];
$keywords=$_POST['keywords'];
$uid=$_POST['user'];
if(isset($name)&&isset($category)&&isset($description)&&isset($keywords)&&isset($uid)){
		try{
			$name=str_replace(' ','_',$name);
			require_once('../inc/functions.php');
			if($category==0){
					$db_table="`quiz_category`";
					$str="INSERT INTO $db_table (`name`, `description`, `keywords`, `created_on`, `created_by_uid`) VALUES ('".$name."','".$description."','".$keywords."',NOW(),".$uid.")";
				}
			else{
					$db_table="`quiz_sub_category`";
					$str="INSERT INTO `quiz_sub_category`(`name`, `description`, `keywords`, `created_on`, `created_by_uid`, `quiz_category_id`) VALUES ('".$name."','".$description."','".$keywords."',NOW(),".$uid.",'".$category."')";
				}
			
			$c=new Functions;
			$c->insertUpdateQuery($str);
		}
		catch(PDOException $e){
			echo $e->getMessage();
			}
	}
else{
	echo 'You must submit properly';
	}
?>