<?php include('config.php'); ?>

<?php
$rid       = mt_rand() ;
$file=$_FILES['idimage']['tmp_name'];
$image= addslashes(file_get_contents($_FILES['idimage']['tmp_name']));
$image_name= addslashes($_FILES['idimage']['name']);
$info=pathinfo($_FILES['idimage']['name']); 
if($info["extension"]=="JPG"||$info["extension"]=="JPEG"||$info["extension"]=="jpg"||$info["extension"]=="jpeg"||$info["extension"]=="PNG"||$info["extension"]=="png"){
$pic_name= "idimage/".md5($rid).$_FILES['idimage']['name'];
move_uploaded_file($file,$pic_name);
}

$rn       = $_POST['rollno'];
$name     = $_POST['name'];
$email    = $_POST['email'];
$password = md5($_POST['password']);  

$save = mysql_query("INSERT INTO `dhawal`.`mailmembers` (`rid`, `name`, `rollNumber`, `branch`, `f_s`, `year`, `idimage`, `image`, `yn`, `email`, `password`) VALUES ('$rid', '$name', '$rn', 'null', 'null', '0000', '$pic_name', 'null', '0000', '$email', '$password');");

header( 'location:http://hbtumail.decoder.co.in/new.php?status=Your HBTUMAIL account will get activated within 24hrs.' );  exit();

?>


