<?php
	try{
	$pdo = new PDO('mysql:host=localhost;dbname=onlinebooks','root','');
//echo "connection successfull";
}catch(PDOException $f){

	echo $f->getmessage();

}
?>
