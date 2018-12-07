<?php ob_start(); session_start(); ?>
<?php include('config.php'); ?>
<?php $o = mysql_query("SELECT * FROM  `mailmembers` WHERE  `rid` LIKE  '".$_SESSION['rid']."'") ; $p = mysql_fetch_array($o); ?>
<?php if(!$p['id']){ header( 'location:index.php' );  exit(); } ?>
<?php if($p['yn']==0){ header( 'location:index.php' );  exit(); } ?>
<?php
		$randomid = $_SESSION['filesid'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$teacher  = $_POST['teacher'];
	$student  = $_POST['student'];
	$First  = $_POST['First'];
	$Second  = $_POST['Second'];
	$Third  = $_POST['Third'];
	$Final  = $_POST['Final'];
	$BE  = $_POST['BE'];
	$CE  = $_POST['CE'];
	$CHE  = $_POST['CHE'];
	$CSE  = $_POST['CSE'];
	$EE  = $_POST['EE'];
	$ET  = $_POST['ET'];
	$FT  = $_POST['FT'];
	$IT  = $_POST['IT'];
	$LT  = $_POST['LT'];
	$ME  = $_POST['ME'];
	$OT  = $_POST['OT'];
	$PT  = $_POST['PT'];
	$PL  = $_POST['PL'];
	$MCA  = $_POST['MCA'];
	$st=array();
	$b=array();
	$y=array();
	$ri=array();$l=0;
	$i=0;
	if($student=='student'){$st[$i]=$student;$i++;}
	if($teacher=='teacher'){$st[$i]=$teacher;$i++;}
	$i=0;
	if($First=='First'){$y[$i]=$First;$i++;}
	if($Second=='Second'){$y[$i]=$Second;$i++;}
	if($Third=='Third'){$y[$i]=$Third;$i++;}
	if($Final=='Final'){$y[$i]=$Final;$i++;}
	$i=0;
	if($BE=='BE'){$b[$i]=$BE;$i++;}
	if($CE=='CE'){$b[$i]=$CE;$i++;}
	if($CHE=='CHE'){$b[$i]=$CHE;$i++;}
	if($CSE=='CSE'){$b[$i]=$CSE;$i++;}
	if($EE=='EE'){$b[$i]=$EE;$i++;}
	if($ET=='ET'){$b[$i]=$ET;$i++;}
	if($FT=='FT'){$b[$i]=$FT;$i++;}
	if($IT=='IT'){$b[$i]=$IT;$i++;}
	if($LT=='LT'){$b[$i]=$LT;$i++;}
	if($ME=='ME'){$b[$i]=$ME;$i++;}
	if($OT=='OT'){$b[$i]=$OT;$i++;}
	if($PT=='PT'){$b[$i]=$PT;$i++;}
	if($PL=='PL'){$b[$i]=$PL;$i++;}
	if($MCA=='MCA'){$b[$i]=$MCA;$i++;}
if(sizeof($st)!=0 && sizeof($y)!=0 && sizeof($b)!=0)
{for($i=0;$i<sizeof($st);$i++)
{for($j=0;$j<sizeof($y);$j++)
{for($k=0;$k<sizeof($b);$k++){
$rr=mysql_query("SELECT * FROM  `mailmembers` WHERE  `branch` LIKE  '$b[$k]' AND  `f_s` LIKE  '$st[$i]' AND  `year` LIKE  '$y[$j]'");
while($b = mysql_fetch_array($rr))
{$ri[$l]=$b['rid'];
$l++;}}}
}}
else if(sizeof($st)!=0 && sizeof($y)!=0 && sizeof($b)==0)
{for($i=0;$i<sizeof($st);$i++)
{for($j=0;$j<sizeof($y);$j++)
{
$rr=mysql_query("SELECT * FROM  `mailmembers` WHERE  `f_s` LIKE  '$st[$i]' AND  `year` LIKE  '$y[$j]'");
while($b = mysql_fetch_array($rr))
{$ri[$l]=$b['rid'];
$l++;}}}
}
else if(sizeof($st)!=0 && sizeof($y)==0 && sizeof($b)!=0)
{for($i=0;$i<sizeof($st);$i++)
{for($k=0;$k<sizeof($b);$k++){
$rr=mysql_query("SELECT * FROM  `mailmembers` WHERE  `branch` LIKE  '$b[$k]' AND  `f_s` LIKE  '$st[$i]'");
while($b = mysql_fetch_array($rr))
{$ri[$l]=$b['rid'];
$l++;}}
}}
else if(sizeof($st)==0 && sizeof($y)!=0 && sizeof($b)!=0)
{for($j=0;$j<sizeof($y);$j++)
{for($k=0;$k<sizeof($b);$k++){
$rr=mysql_query("SELECT * FROM  `mailmembers` WHERE  `branch` LIKE  '$b[$k]' AND  `year` LIKE  '$y[$j]'");
while($b = mysql_fetch_array($rr))
{$ri[$l]=$b['rid'];
$l++;}}
}}
else if(sizeof($st)!=0 && sizeof($y)==0 && sizeof($b)==0)
{for($i=0;$i<sizeof($st);$i++){
$rr=mysql_query("SELECT * FROM  `mailmembers` WHERE  `f_s` LIKE  '$st[$i]'");
while($b = mysql_fetch_array($rr))
{$ri[$l]=$b['rid'];
$l++;}}}

else if(sizeof($st)==0 && sizeof($y)!=0 && sizeof($b)==0)
{for($j=0;$j<sizeof($y);$j++)
{
$rr=mysql_query("SELECT * FROM  `mailmembers` WHERE  `year` LIKE  '$y[$j]'");
while($b = mysql_fetch_array($rr))
{$ri[$l]=$b['rid'];
$l++;}}}
else if(sizeof($st)==0 && sizeof($y)==0 && sizeof($b)!=0)
{for($k=0;$k<sizeof($b);$k++){
$rr=mysql_query("SELECT * FROM  `mailmembers` WHERE  `branch` LIKE  '$b[$k]'");
while($b = mysql_fetch_array($rr))
{$ri[$l]=$b['rid'];
$l++;}}}
$sa = implode("*",$ri);
	
	$save = mysql_query("UPDATE  `dhawal`.`sentmail` SET  `sub` =  '$subject' WHERE  `sentmail`.`mailid` LIKE '$randomid'");
	$save = mysql_query("UPDATE  `dhawal`.`sentmail` SET  `message` =  '$message' WHERE  `sentmail`.`mailid` LIKE '$randomid'");
	$save = mysql_query("UPDATE  `dhawal`.`sentmail` SET  `receiverrid` =  '$sa' WHERE  `sentmail`.`mailid` LIKE '$randomid'");

	//header("location:mailer.php");

?>
<script>
    window.location="mailer.php";
   </script>