<?php
require_once('./include/db.php');
$msg="";
if(isset($_POST['btn_signup'])){
	$name=$_POST['txtname'];
	$email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];
	$date=date('j F Y');
	$verification_status=0;
	
	$select="select * from user where email='$email'";
	$stmt=$pdo->prepare($select);
	$stmt->execute();
	$check=$stmt->rowCount();
	
	if($check>0){
		$msg="Email id already present";
		header('refresh:4;index.php');
	}else{
		$verification_id=rand(111111111,999999999);
		
		$insert=$pdo->prepare("insert into user(name,email,password,verification_status,verification_id,date) values(:name,:email,:password,:verification_status,:verification_id,:date)");
		$insert->execute([
			':name'=>$name,
			':email'=>$email,
			':password'=>$password,
			':verification_status'=>$verification_status,
			':verification_id'=>$verification_id,
			':date'=>$date
		]);
		
		$msg="We've just sent a verification link to <strong>$email</strong>. Please check your inbox and click on the link to get started. If you can't find this email (which could be due to spam filters), just request a new one here.";
		
		$mailHtml="Please confirm your account registration by clicking the button or link below: <a href='http://localhost/onlinebooks/check.php?id=$verification_id'>http://localhost/onlinebooks/check.php?id=$verification_id</a>";
		
        smtp_mailer($email,'Account Verification',$mailHtml);
        
        header('refresh:10;index.php');
		
	}
}

function smtp_mailer($to,$subject, $msg){
	require_once("smtp/class.phpmailer.php");
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPDebug = 1; 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'TLS'; 
	$mail->Host = "smtp.sendgrid.net";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "nepha6ker";
	$mail->Password = "dhacker!@#1";
	$mail->SetFrom("nepha6ker@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	if(!$mail->Send()){
		return 0;
	}else{
		return 1;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
div {
  border: 1px solid gray;
  padding: 8px;
}

h1 {
  text-align: center;
  text-transform: uppercase;
  color: #4CAF50;
}

p {
  text-indent: 50px;
  text-align: justify;
  letter-spacing: 3px;
}

a {
  text-decoration: none;
  color: #008CBA;
}
</style>
</head>
<body>

<div>
  <h1></h1>
  <p> <?php echo $email;?>
  <a target="_blank" href="index.php">"<?php echo $msg; ?>"</a></p>
</div>

</body>
</html>

