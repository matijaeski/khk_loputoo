<?php
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
        {
            $fgmembersite->RedirectToURL("login.php");
            exit;
        }
if($fgmembersite->UserFullName() !== 'admin')
        {
                $fgmembersite->RedirectToURL("index.php");
                exit;
        }

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style/mati.css" />
</head>
<body>
<div class="header">
        <a href="logout.php">Logi välja</a>
        <a href="user-info.php">Minu kasutaja</a>
        <a href="admin-page.php">Juhtpaneel</a>
	<a href="index.php">Juhtpult</a>
</div>
<br>
<table>
<tr>
<th><a class="a2" href="dellog.php">Kustuta logid</a></th>
<th></th>
<th><a class="a2" href="include/lock.log" download="logid.txt">Lae logid alla</a></th>
</tr>
</table>
<br>
<br>
<?php
$logfile = 'include/lock.log';
if (file_exists($logfile)){
	readfile($logfile);
	exit;
}else{
	echo "Logifaili pole veel loodud!";
} ?>

<footer>
<p>Oled sisse logitud kui  <?= $fgmembersite->UserFullName(); ?>.    </p>
</footer>
</body>
</html>
