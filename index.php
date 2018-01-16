<?php session_set_cookie_params(time()+600,'/','http://www.hbtumail.decoder.co.in/',false,true);
session_start(); ?>
<?php if( $_SESSION['member'] == 'In'){ header( 'location:home.php' );  exit(); } ?>
<?php include('config.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="A mailing sevice for HBTU Kanpur devloped under coding club, Decoder by Dhawal Agrawal">
<meta property="og:image" content="images/hbtumaillogo.png">
<meta property="og:description" content="A mailing sevice for HBTU Kanpur devloped under coding club, Decoder by Dhawal Agrawal">
<meta property="og:url" content="http://www.hbtumail.decoder.co.in" />
<meta property="og:title" content="HBTU MAIL" />
<link rel="apple-touch-icon" sizes="57x57" href="/image/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/image/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/image/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/image/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/image/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/image/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/image/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/image/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/image/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/image/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/image/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/image/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/image/favicon-16x16.png">
<link rel="manifest" href="/image/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/image/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">



<meta property="og:type" content="article" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />

<title>HBTU MAIL</title>
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato|Raleway" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="controler">
<div id="head">Harcourt Butler Technical University Kanpur</div>
<div id="middle"><marquee direction="left" style="    color: #FF0000; font-size: 16px;font-weight: 600; letter-spacing: 1.1px; background: white; padding: 1.5px 0; font-family: sans-serif ,thin; opacity:.7;"><strong>Those who have not connected HBTUMAIL with their email please <a href="new.php">click here.</a> </strong></marquee>
<div id="logHolder">
<div id="logBox">
<div id="LogTextBar"> <?php if(isset($_GET['status'])){ echo $_GET['status'] ; }else{ echo 'Log into HBTU Mail' ; } ?></div>
<div id="LogInputBar">
<form action="loginchk.php" method="post" enctype="multipart/form-data">
<span><input name="email" type="text" placeholder="Email Address" required>
<input name="password" type="password" placeholder="Password"  required></span>
<input class="submitButton" type="submit" value="Log In" />
</form>
</div>
<!--<div id="LogForgotBar"> <a href="recover.php"> Recover Account </a> </div>-->
</div>
</div>
</div>
<div id="footer">© 2017 HBTU MAIL - All rights reserved - developed by Dhawal Agrawal</div></div>
</body>
</html>
