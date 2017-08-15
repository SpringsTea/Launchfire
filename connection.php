<?php

try{
	$db = new PDO( 'mysql:host=localhost;dbname=user_colors;charset=utf8', 'root', '');	
}
catch( Exception $e){
	echo "PDO connection failed <br />".$e->getMessage();
}



?>