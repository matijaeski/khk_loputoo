<?php
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin()){
            $fgmembersite->RedirectToURL("login.php");
            exit;
}
elseif($fgmembersite->UserFullName() !== 'admin'){
                $fgmembersite->RedirectToURL("index.php");
                exit;
}
$logifail= "include/lock.log";
if (isset($_GET['delete'])){
	unlink($logifail);
	$fgmembersite->RedirectToURL("locklog.php");
	exit;
}else {
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
<h2>Oled sa kindel, et soovid logifaile kustutada?</h2>
<p>Fail kustutatakse jäädavalt.</p>

<table>
<tr>
<th><a class="a2" href='dellog.php?delete=true'>Jah</a></th>
<th></th>
<th><a class="a2" href="locklog.php">Ei</a></th>
</tr>
</table>
<br>
<br>

<footer>
<p>Oled sisse logitud kui  <?= $fgmembersite->UserFullName(); ?>.    </p>
</footer>
</body>
</html>
