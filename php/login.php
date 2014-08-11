<?php

session_start(); 
if(isset($_SESSION['valid']))
{
    if($_SESSION['valid'] == 1)
    {
        @header("Location: prasthanatraya.php");
        exit;
    }
}
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang= "en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style/indexstyle.css" media ="screen" />
	<link rel="stylesheet" type="text/css" href="style/reset.css" media ="screen" />
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<title>Shankara Bhashya</title>
</head>

<body>
	<div class="header_top">
		<div class="container">
			<nav class="fsan">
				<ul>
					<li><a title="Main Page" href="prasthanatraya.php">मुख्यपृष्ठम्</a></li>
					<li><a title="Sri Shankara Bhashya" href="prasthanatraya_list.php">श्रीशाङ्करप्रस्थानत्रयभाष्यम्</a></li>
					<li><a title="Search" href="search.php">अन्वेषणम्</a></li>
				</ul>
			</nav>
			<div class="logo"><a href="http://www.sringeri.net/"><img src="images/logo.png" alt="Sringeri Logo" /></a></div>
			<div class="title fsan">
				<span class="clr noul"><a href="../index.php">अद्वैतशारदा</a></span><br />
				दक्षिणाम्नाय श्रीशारदापीठम्, शृङ्गेरी
			</div>
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
<?php

unset($_POST['lemail']);
unset($_POST['lpassword']);

$error_message = array("1"=>"E-mail field is empty<br />","2"=>"Password field is empty<br />","3"=>"Invalid email or password.<br />");
$error_message_registration = array("4"=>"Name field is empty<br />","5"=>"E-mail field is empty<br />","6"=>"Please fill in information about yourself<br />","7"=>"Password field is empty<br />","8"=>"Confirm-password filed is empty<br />","9"=>"Passwords not in confirmation<br />","10"=>"E-mail address invalid<br />","11"=>"Invalid CAPTCHA! Please try again<br />");

$err_str = "&nbsp;";
$err_str_registration = "&nbsp;";
if(isset($_GET['error']))
{
	if($_GET['error'] < 4)
	{
		$err_str = $error_message{$_GET['error']};
	}
	else
	{
		$err_str_registration = $error_message_registration{$_GET['error']};
	}
}
else
{
	$err_str = "&nbsp;";
	$err_str_registration = "&nbsp;";
}

?>
	<div class="page">
		<p class="fgentium small clr">Please login</p>
		<form method="post" action="login_confirm.php">
		<div class="registration">
			<div class="otherp">
				<ul>
					 <li>
						<h2 class="clr2 required_notification"><?php echo $err_str;?></h2>
						<h2 class="big clr2">Login</h2>
					</li>
					<li>
						<label for="lemail">Email&nbsp;<span class="clr2">*</span></label><br />
						<input class="rinput" type="text" name="lemail" id="lemail" />
					</li>
					<li>
						<label for="lpassword">Password&nbsp;<span class="clr2">*</span></label><br />
						<input class="rinput" type="password" name="lpassword" id="lpassword" />
					</li>
                    <li id="pr_email_show">
						<label for="pr_email" class="clr2">Enter your email address</label><br />
						<input class="rinput" type="text" name="pr_email" id="pr_email" />
 					</li>
					<li id="regForm">
						<input class="rsubmit" type="submit" name="submit" value="submit"/>
                        <p class="forgotPassword fright clr2"><a href="javascript:void(0);" onclick="$('#lemail').prop('disabled', true);$('#lpassword').prop('disabled', true);$('#regForm h2').hide();$('#pr_email_show').show();">Forgot your password?</a></p>
						<h2 class="clr2" style="margin-top: 1em;">If you are a first time user, then we request you to register below</h2>
					</li>
				</ul>
			</div>
		</div>
		</form>
		<form method="post" action="register.php">
		<div class="registration">
			<div class="otherp">
				<ul>
					 <li>
						<h2 class="clr2 required_notification"><?php echo $err_str_registration; ?></h2>
						<h2 class="big clr2">Registration</h2>
					</li>
					<li>
						<label for="name">Name&nbsp;<span class="clr2">*</span></label><br />
						<input class="rinput" type="text" name="name" />
					</li>
					<li>
						<label for="email">Email&nbsp;<span class="clr2">*</span></label><br />
						<input class="rinput" type="text" name="email" />
					</li>
					<li>
						<label for="info">Information about yourself</label><br />
						<textarea class="rinput tinput" name="info" placeholder="Please tell us your background, interests and anything else you would like to share with us"></textarea>
					</li>
					<li>
						<label for="password">Password&nbsp;<span class="clr2">*</span></label><br />
						<input class="rinput" type="password" name="password" />
					</li>
					<li>
						<label for="cpassword">Confirm Password&nbsp;<span class="clr2">*</span></label><br />
						<input class="rinput" type="password" name="cpassword" />
					</li>
					<li>
<?php
require_once('recaptchalib.php');
$publickey = "6Lc6KPMSAAAAAJ-yzoW7_KCxyv2bNEZcLImzc7I8";
$privatekey = "6Lc6KPMSAAAAANrIJ99zGx8wxzdUJ6SwQzk1BgXX";
echo recaptcha_get_html($publickey);
?>
					</li>
					<li>
						<input class="rsubmit" type="submit" name="submit" value="submit"/>
					</li>
				</ul>
			</div>
		</div>
		</form>
	</div>
</body>
</html>
