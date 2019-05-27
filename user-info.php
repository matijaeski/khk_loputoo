<html>
<head>
<?php

require_once("./include/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
?>


<title>Minu kasutaja</title>
<link rel="stylesheet" type="text/css" href="style/mati.css" />

</head>
<body>
<div class="header">

        <a href="logout.php">Logi välja</a>
        <a href="index.php">Juhtpult</a>
	<?php if($fgmembersite->UserFullName() == 'admin'){?>
		<a href="admin-page.php">Juhtpaneel</a>
	<?php }?>
</div>

<?php
$dbuser="kasutaja";
$dbpass="parool";
$db="andmebaas";
$kes=$fgmembersite->UserFullName();
//ühenda andmebaasiga
$con=mysqli_connect("localhost",$dbuser,$dbpass,$db);
// Kontrolli ühendust
if (mysqli_connect_errno())
{
echo "Ühendus andmebaasiga nurjus: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT username,name,email,regdate,expiredate FROM users WHERE name = '$kes';");

while($row = mysqli_fetch_array($result)){
echo "<p>Kasutajanimi: " . $row['username'] . "</p><br>";
echo "<p>Sinu nimi: " . $row['name'] . "</p><br>";
echo "<p>Sinu meiliaadress: " . $row['email'] . "</p><br>";
echo "<p>Kasutaja registreeritud: " . $row['regdate'] . "</p><br>";
echo "<p>Kasutaja aegub: " . $row['expiredate'] . "</p>";
echo "<br>";
}
$result2 =  mysqli_query($con,"SELECT email FROM users WHERE name = 'admin';");

if($fgmembersite->UserFullName() !== 'admin'){
	while($adminmail = mysqli_fetch_array($result2)){
	echo "<p>Seadme omaniku meiliaadress: " . $adminmail['email'] . "</p>";
	}
}
mysqli_close($con);
?>
<br><a class="a2" href="change-pwd.php">Vaheta parooli</a>


<footer class="footer">
<center>
Oled sisse logitud kui  <?= $fgmembersite->UserFullName(); ?>.
<center>
</footer>

</body>
</html>
