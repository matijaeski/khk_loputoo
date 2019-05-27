<?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("index.php");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Logi sisse</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
	<link rel="stylesheet" type="text/css" href="style/mati.css" />
</head>
<body>
<?php if($fgmembersite->CheckLogin()){?>
<div class="header">

        <a href="logout.php">Logi välja</a>
        <a href="user-info.php">Muuda kasutajaandmeid</a>
        <a href="admin-page.php">Juhtpaneel</a>
</div>
<center>
<?php } ?>
<!-- Form Code Start -->
<div id='fg_membersite'>
<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend style="color: white;">Logi sisse</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation' style="color: white;">* nõutud väljad</div>

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='username' >Kasutajanimi*:</label><br/>
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='login_username_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='password' >Salasõna*:</label><br/>
    <input type='password' name='password' id='password' maxlength="50" /><br/>
    <span id='login_password_errorloc' class='error'></span>
</div>

<div class='container'>
    <input type='submit' name='submit' value='Logi sisse' />
</div>
</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Palun sisesta kasutajanimi");
    
    frmvalidator.addValidation("password","req","Palun sisesta parool");

// ]]>
</script>
</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->
<br>
<?php if (!$fgmembersite->CheckLogin()){ ?>
<div>
	<a class="a2" href="confirmreg.php">Aktiveeri uus kasutaja</a>
</div>
<?php } elseif ($fgmembersite->UserFullName() == 'admin') {?>
	<a class="a2" href="admin-page.php">Juhtpaneeli</a>
<?php } ?>
</center>
</body>
</html>
