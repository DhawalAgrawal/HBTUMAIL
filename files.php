<?php ob_start();
session_start();
    include('config.php');
	
	$randomid = mt_rand();
	for($i=0; $i<count($_FILES['url']['name']); $i++) {   
	$path = "uploadFiles/";
	$name = $_FILES['url']['name'][$i];
	$size = $_FILES['url']['size'][$i];  
	list($txt, $ext) = explode(".", $name);
	$file= time().substr(str_replace(" ", "_", $txt), 0);
	$info = pathinfo($file);
	$filename = $file.".".$ext;
	move_uploaded_file($_FILES['url']['tmp_name'][$i], $path.$filename); 
	$file_name_all.=addslashes($filename)."*";
	}
	
	$filepath = rtrim($file_name_all, '*');

    //foreach($_POST['to'] as $selected) { echo $selected."*"; }
	
	$save=mysql_query( "INSERT INTO `dhawal`.`sentmail` (`mailid`, `senderrid`, `receiverrid`, `sub`, `message`, `files`, `blockcount`, `date`) VALUES ('".$randomid."', '".$_SESSION['rid']."', '0', '', '', '".$filepath."', '', now())" );
	
	session_start();
	
	$_SESSION["filesid"] = $randomid ;
	
?>