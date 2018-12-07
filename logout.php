<?Php
ob_start(); 
session_start();
unset( $_SESSION['member'] );
unset( $_SESSION['rid'] );

header( 'location:index.php' );  exit();
?>
