<?php session_start(); ?>
<?php include('config.php'); ?>
<?php $o = mysql_query("SELECT * FROM  `mailmembers` WHERE  `rid` LIKE  '".$_SESSION['rid']."'") ; $p = mysql_fetch_array($o); ?>
<?php if(!$p['id']){ header( 'location:index.php' );  exit(); } ?>
<?php if($p['yn']==0){ header( 'location:index.php' );  exit(); } ?>
<?php 
		$randomid = $_SESSION['filesid'];
$row = mysql_query("SELECT * FROM  `sentmail` WHERE  `mailid` ='".$randomid."' ") ;
$result = mysql_fetch_array( $row );
$c = mysql_query("SELECT * FROM  `mailmembers` WHERE  `rid` LIKE  '".$result['senderrid']."'") ;
$d = mysql_fetch_array( $c );
		$each = explode('*',$result['receiverrid']);
		$total = count($each);
		for($i=0;$i<$total;$i++)
		{
		 $info = new SplFileInfo($each[$i]);
		$a = mysql_query("SELECT * FROM  `mailmembers` WHERE  `rid` LIKE  '".$info."' AND  `yn` =1") ; $b = mysql_fetch_array($a);




    $mailto = $b['email'];
    $subject = $result['sub'] ;
    $message = $result['message'];
	$path = "uploadFiles/";
	$replyto= $d['email'];
	$uid = md5(uniqid(time()));
// header
$header = "From: ".$d['name']." <".$d['email'].">\r\n";
$header .= "Reply-To: ".$replyto."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

// message  
$nmessage = "--".$uid."\r\n";
$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$nmessage .= $message."\r\n\r\n";	
$nmessage .= "--".$uid."\r\n";
$fileall = explode('*',$result['files']);	
$tot = count($fileall);
for($j=0;$j<$tot;$j++)
{
$filename[$j]= new SplFileInfo($fileall[$j]);
 $file[$j] = $path.$filename[$j];
$content[$j] = file_get_contents( $file[$j]);
$content[$j] = chunk_split(base64_encode($content[$j]));

$name[$j] = basename($file[$j]);

//attachment

$nmessage .= "Content-Type: application/octet-stream; name=\"".$filename[$j]."\"\n";
$nmessage .= "Content-Transfer-Encoding: base64\n";
$nmessage .= "Content-Disposition: attachment; filename=\"".$filename[$j]."\"\n\n";
$nmessage .= $content[$j]."\n";
$nmessage .= "--".$uid."\n";
}


mail($mailto, $subject, $nmessage, $header);

}
unset( $_SESSION['filesid'] );
?>
<script>
    window.location="compose.php";
   </script>
