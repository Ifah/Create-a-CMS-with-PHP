<?php
try{
	$pdo = new PDO('mysql:host=localhost; dbname=cms', 'ifah', 'password');
}catch(PDOException $e){
	exit('Database error.');
}
?>