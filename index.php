<html>
<head>
<?php

require_once("./include/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}


shell_exec("gpio mode 1 pwm");
shell_exec("gpio pwm-ms");
shell_exec("gpio pwmc 192");
shell_exec("gpio pwmr 2000");
shell_exec("gpio mode 7 out");

$btn = exec('gpio read 7');
$praegu = date("Y-m-d H:i:s");
$logifail = "include/lock.log";
$kes = $fgmembersite->UserFullName();

if (isset($_POST['onoff'])){
        if ($btn==1){
                shell_exec("gpio write 7 0");
                shell_exec("gpio pwm 1 50");
		file_put_contents($logifail," $praegu $kes lukustas ukse. <br>",FILE_APPEND);
        }
        elseif ($btn==0){
                shell_exec("gpio write 7 1");
                shell_exec("gpio pwm 1 120");
		file_put_contents($logifail," $praegu $kes avas ukse. <br>",FILE_APPEND);
        }
}
?>


<title>Nutiluku kontrollpult</title>
<link rel="stylesheet" type="text/css" href="style/mati.css" />

</head>
<body>
<div class="header">

        <a href="logout.php">Logi välja</a>
        <a href="user-info.php">Minu kasutaja</a>
	<?php if($fgmembersite->UserFullName() == 'admin'){?>
		<a href="admin-page.php">Juhtpaneel</a>
	<?php }?>
</div>


		<center class="centered">
			<form method="post">
				<div>
				<?php if($btn == 1) {?>
					<button class="lockbutton" name="onoff"><img src="/img/locked.png" style="height:500px; width 350px; -webkit-filter: invert(1); filter: invert(1)" ></button>
				<?php }if($btn == 0){?>
					<button class="lockbutton" name="onoff"><img src="/img/unlocked.png" style="height:500px; width 350px; -webkit-filter: invert(1); filter: invert(1);"></button>
				<?php }?>
				</div>
			</form>
		</center>

<!-- <button style="height:100px;width:150px" name="onoff">lüliti</button> -->
<footer class="footer">
<center>
Oled sisse logitud kui  <?= $fgmembersite->UserFullName(); ?>.
<center>
</footer>

</body>
</html>
