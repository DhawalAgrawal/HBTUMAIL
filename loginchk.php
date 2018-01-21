<?php include('config.php'); ?>

<?php

$email = $_POST['email'] ;
$pass  = $_POST['password'] ;

$row = mysql_query("SELECT * FROM  `mailmembers` WHERE  `email` LIKE  '$email'") ;
$result = mysql_fetch_array( $row );
?>

<?php if($result['email']==$email && $result['password']==md5($pass) ){
if($result['yn']==1){
 session_start(); $_SESSION['rid'] = $result['rid'] ;  
$_SESSION['member'] = 'In' ;
header( 'location:home.php' );  exit();
}else{ 

header( 'location:http://hbtumail.decoder.co.in/?status=Your HBTUMAIL account is currently inactive.' );  exit();}
 }else{ 

header( 'location:http://hbtumail.decoder.co.in/?status=Username or Password is Incorrect.' );  exit();

} ?>

