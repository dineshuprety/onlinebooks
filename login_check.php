<?php
include('./include/db.php');
session_start();
if(isset($_POST['email']) && $_POST['password']){
	$email=$_POST['email'];
	$password=$_POST['password'];
	$select="select * from user where email=:emailid and password=:pass";
	$stmt=$pdo->prepare($select);
	$stmt->execute([':emailid'=>$email,':pass'=>$password]);
	$check=$stmt->rowCount();
	
	if($check>0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		$_SESSION['id']=$row['id'];
		$verification_status=$row['verification_status'];
		if($verification_status==0){
			echo "You have not confirmed your account yet. Please check your inbox and verify your email id.";
		}else{
			echo "done";
			$_SESSION['IS_LOGIN']=1;
			setcookie('_ua_',md5(1),time() + 86400 * 30,'','','',true);
			//header('refresh:2;index.php');
		}
	}else{
		echo "Please enter corect login details";
	}
}
?>
