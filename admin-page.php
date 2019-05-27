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

      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Kasutajate loend</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
	<link rel="stylesheet" type="text/css" href="style/mati.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<div class="header">

        <a href="logout.php">Logi välja</a>
        <a href="user-info.php">Minu kasutaja</a>
        <a href="index.php">Luku juhtpult</a>
</div>



<font face="formation"><h2> Aktiveeritud kasutajad</h2></font>
<?php
$dbuser="kasutaja";
$dbpass="parool";
$db="andmebaas";
//ühenda andmebaasiga
$con=mysqli_connect("localhost",$dbuser,$dbpass,$db);
// Kontrolli ühendust
if (mysqli_connect_errno())
{
echo "Ühendus andmebaasiga nurjus: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT username,name,email,regdate,expiredate FROM users WHERE confirmcode = 'y'");

echo "<table border='1' class='realtable'>
<tr>
<th>Kasutajanimi</th>
<th>Nimi</th>
<th>Meiliaadress</th>
<th>Registreerumiskuupäev</th>
<th>Kasutaja aegumiskuupäev</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['regdate'] . "</td>";
echo "<td>" . $row['expiredate'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>


<font face="formation"><h2>Aktiveerimata kasutajad</h2></font>
<?php
$dbuser="remoloc";
$dbpass="remoloc123";
$db="remoloc";
//ühenda andmebaasiga
$con=mysqli_connect("localhost",$dbuser,$dbpass,$db);
// Kontrolli ühendust
if (mysqli_connect_errno())
{
echo "Ühendus andmebaasiga nurjus: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT username,name,email,regdate,expiredate,confirmcode FROM users WHERE confirmcode != 'y'");

echo "<table border='1' class='realtable'>
<tr>
<th>Kasutajanimi</th>
<th>Nimi</th>
<th>Meiliaadress</th>
<th>Registreerumiskuupäev</th>
<th>Kasutaja aegumiskuupäev</th>
<th>Kinnituskood</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['regdate'] . "</td>";
echo "<td>" . $row['expiredate'] . "</td>";
echo "<td>" . $row['confirmcode'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
<!--   -------------------  -->

<br>
<table>
	<tr>
	<th><a class="a2" href="confirmreg.php">Aktiveeri kasutaja</a></th>
	<th></th>
	<th><a class="a2" href="deluser.php">Kustuta kasutaja</a></th>
	<th></th>
	<th><a class="a2" href="register.php">Registreeri kasutaja</a></th>
	<th></th>
        <th><a class="a2" href="locklog.php">Luku logid</a></th>
	</tr>
</table>

<footer>
<p>Oled sisse logitud kui  <?= $fgmembersite->UserFullName(); ?>.    </p>
</footer>
</body>
</html>
