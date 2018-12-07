<?php ob_start();include('config.php'); ?>

<?php $rrid=$_GET['rrid'];
$sid=$_GET['sid'];
$mailid=$_GET['mailid'];
$a = mysql_query("SELECT * FROM  `sentmail` WHERE  `mailid` LIKE  '".$mailid."' AND  `email` LIKE  '".$_GET['email']."'"); $b = mysql_fetch_array($a); ?>
<?php if(!$b['id']){ header( 'location:index.php' );  exit(); } ?>
<?php if($b['yn']==0){ header( 'location:index.php' );  exit(); } ?>

<?php

 $a = mysql_query("SELECT * FROM  `members` WHERE  `email` LIKE  '".$email."'") ; $b = mysql_fetch_array($a); ?>
<?php if($b['rid']==$ridd){  }

header( 'location:index.php' );  exit();}

?>


