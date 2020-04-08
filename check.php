<?php
require_once('./include/db.php');
$id=$_GET['id'];
$update=$pdo->prepare("update user set verification_status='1' where verification_id= :id");
$update->execute([':id'=>$id]);
$text="Your account verified";
header('refresh:7;index.php');
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
  <h1><?php echo $text; ?></h1>
  <p> Your Account has be Activate. We can Login In now. Thank You For Subcraption.
  <a target="_blank" href="index.php">"Click Here For Login"</a> link.</p>
</div>

</body>
</html>

