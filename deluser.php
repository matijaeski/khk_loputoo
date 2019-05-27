<html>
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
<head>
<title>Kustuta Kasutaja</title>
<link rel="stylesheet" type="text/css" href="style/mati.css" />
<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
</head>
<body>
<font face="formation">
<div class="header">

        <a href="logout.php">Logi välja</a>
        <a href="user-info.php">Minu kasutaja</a>
        <a href="index.php">Luku juhtpult</a>
	<a href="admin-page.php">Juhtpaneel</a>
</div>

<h2>Kustuta kasutaja<br>
See toiming kustutab konto jäädavalt!</h2>

<?php
$dbuser="kasutajanimi";
$dbpass="parool";
$db="andmebaas";
// Ühenda andmebaasiga
$link = mysqli_connect("localhost",$dbuser,$dbpass,$db);
//kontrolli ühendust
if ($link === false){
        die("Andmebaasiga ühendamine nurjus: " . mysqli_connect_error());
}

if (isset($_POST["kasutajanimi"]))
{
  $kasutajanimi = $_POST["kasutajanimi"];
  mysqli_query($link, "DELETE FROM users WHERE username = '$kasutajanimi'");
  echo "kasutaja $kasutajanimi kustutatud!";
}
else
{
  $kasutajanimi = null;
  echo "Palun sisesta kasutajanimi";
}

//Üritab viia läbi päringut
$sql = "DELETE FROM users WHERE username = $kasutajanimi;";

//sulgeb ühenduse
mysqli_close($link);
?>

<div id='fg_membersite'>
<form id='delete' action='deluser.php' method='post' accept-charset='UTF-8'>
<div class='short_explanation'>* nõutud väljad</div>
<div></div>
<div class='container'>
    <label for='kasutajanimi' >Kasutajanimi:* </label><br/>
    <input type='text' name='kasutajanimi' id='kasutajanimi' ><br/>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Kustuta' >
</form>
</div>
</font>
<footer>
<p>Oled sisse logitud kui  <?= $fgmembersite->UserFullName(); ?>.    </p>
</footer>
</body>
</html>
