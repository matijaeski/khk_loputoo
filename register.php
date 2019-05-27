<?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
        $fgmembersite->RedirectToURL("thank-you.html");
   }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Registreeri</title>
    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
    <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
    <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
    <script src="scripts/pwdwidget.js" type="text/javascript"></script>
    <link rel="STYLESHEET" type="text/css" href="style/mati.css" />
</head>
<body>
<div class="header">
        <a href="logout.php">Logi välja</a>
        <a href="user-info.php">Minu kasutaja</a>
		<?php if($fgmembersite->UserFullName() == 'admin'){?>
        <a href="admin-page.php">Juhtpaneel</a>
		<?php }else{ ?>
		<a href="index.php">Juhtpult</a>
		<?php } ?>
</div>

<!-- Form Code Start -->
<div id='fg_membersite'>
<form id='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend style="color: white;">Registreeri</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation' style="color: white;">* nõutud väljad</div>
<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='name' >Sinu täispikk nimi*: </label><br/>
    <input type='text' name='name' id='name' value='<?php echo $fgmembersite->SafeDisplay('name') ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='email' >Meiliaadress*:</label><br/>
    <input type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='register_email_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='username' >Kasutajanimi*:</label><br/>
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='register_username_errorloc' class='error'></span>
</div>
<div class='container' style='height:60px;'>
    <label for='password' >Salasõna*:</label><br/>
    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
    <noscript>
    <input type='password' name='password' id='password' maxlength="50" />
    </noscript>
    <div id='register_password_errorloc' class='error' style='clear:both'></div>
</div>
<div class='container'>
    <label for='expiredate' >Kasutaja aegumiskuupäev*:<br/>(formaadis YYYY-MM-DD)</label><br/>
    <input type='text' name='expiredate' id='expiredate' value='<?php echo $fgmembersite->SafeDisplay('expiredate') ?>' maxlength="10" /><br/>
    <span id='register_expiredate_errorloc' class='error'></span>
</div>
<div class='container'>
    <input type='submit' name='Submit' value='Registreeri' />
</div>
</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Palun sisesta oma nimi");

    frmvalidator.addValidation("email","req","Palun sisesta oma meiliaadress");

    frmvalidator.addValidation("email","email","Palun sisesta kehtiv meiliaadress");

    frmvalidator.addValidation("username","req","Palun sisesta kasutajanimi");
    
    frmvalidator.addValidation("password","req","Palun sisesta parool");

    frmvalidator.addValidation("expiredate","req","Palun sisesta aegumiskuupäev");

    frmvalidator.addValidation("expiredate","date","Palun sisesta kuupäev järgmises formaadis: aasta-kuu-päev");

// ]]>
</script>

<!--
Form Code End (see html-form-guide.com for more info.)
-->

<footer>
</footer>

</body>
</html>
