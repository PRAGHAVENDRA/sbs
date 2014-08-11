<?php

require_once('recaptchalib.php');
$publickey = "6Lc6KPMSAAAAAJ-yzoW7_KCxyv2bNEZcLImzc7I8";
$privatekey = "6Lc6KPMSAAAAANrIJ99zGx8wxzdUJ6SwQzk1BgXX";

$resp = null;
$error = null;

if (isset($_POST["recaptcha_response_field"])) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);
        if ($resp->is_valid) {
				
        } else {
				@header("Location: login.php?error=11#regForm");
				exit;
        }
}

if(isset($_POST['name'])){$name = $_POST['name'];if($name == ''){@header("Location: login.php?error=4#regForm");exit;}}else{@header("Location: login.php?error=4#regForm");exit;}

if(isset($_POST['email']))
{
	$email = $_POST['email'];
	if($email == '')
	{
		@header("Location: login.php?error=5#regForm");
		exit;
	}
	else
	{
		if(!(preg_match("/.*\@[a-zA-Z0-9\.]+\.[a-zA-Z0-9\.]+/", $email)))
		{
			@header("Location: login.php?error=10#regForm");
			exit;
		}
	}
}
else
{
	@header("Location: login.php?error=5#regForm");
	exit;
}

/*
if(isset($_POST['info'])){$info = $_POST['info'];if($info == ''){@header("Location: login.php?error=6#regForm");exit;}}else{@header("Location: login.php?error=6#regForm");exit;}
*/
if(isset($_POST['info'])){$info = $_POST['info'];}else{$info = '';}
if(isset($_POST['password'])){$pwd = $_POST['password'];if($pwd == ''){@header("Location: login.php?error=7#regForm");exit;}}else{@header("Location: login.php?error=7#regForm");exit;}
if(isset($_POST['cpassword'])){$cpassword = $_POST['cpassword'];if($cpassword == ''){@header("Location: login.php?error=8#regForm");exit;}}else{@header("Location: login.php?error=8#regForm");exit;}
if($pwd != $cpassword)
{
	@header("Location: login.php?error=9#regForm");
	exit;
}

echo "<!DOCTYPE html>

<html xmlns=\"http://www.w3.org/1999/xhtml\" lang= \"en\" xml:lang=\"en\">
<head>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"style/indexstyle.css\" media =\"screen\" />
	<link rel=\"stylesheet\" type=\"text/css\" href=\"style/reset.css\" media =\"screen\" />
	<script type=\"text/javascript\" src=\"js/common.js\" charset=\"UTF-8\"></script>
	<script type=\"text/javascript\" src=\"js/jquery-1.9.1.js\"></script>
	<script type=\"text/javascript\" src=\"js/devanagari_kbd.js\" charset=\"UTF-8\"></script>
	<title>Shankara Bhashya</title>
</head>";

echo "<body>";

echo "<div class=\"header_top\" id=\"header_top\">
		<div class=\"container\">
			<nav class=\"fsan\">
				<ul>
					<li><a title=\"Main Page\" href=\"prasthanatraya.php\">मुख्यपृष्ठम्</a></li>
					<li><a title=\"Sri Shankara Bhashya\" href=\"prasthanatraya_list.php\">श्रीशाङ्करप्रस्थानत्रयभाष्यम्</a></li>
					<li><a title=\"Search\" href=\"search.php\">अन्वेषणम्</a></li>
				</ul>
			</nav>
			<div class=\"logo\"><a href=\"http://www.sringeri.net/\"><img src=\"images/logo.png\" alt=\"Sringeri Logo\" /></a></div>
			<div class=\"title fsan\">
				<span class=\"clr noul\"><a href=\"../index.php\">अद्वैतशारदा</a></span><br />
				दक्षिणाम्नाय श्रीशारदापीठम्, शृङ्गेरी
			</div>
		</div>
	</div>
	<div class=\"clearfix\">&nbsp;</div>";
echo "<div class=\"page\" id=\"page\">";


include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$query_l2 = "select count(*) from details where email='$email'";
$result_l2 = mysql_query($query_l2);
$row_l2=mysql_fetch_assoc($result_l2);
$num=$row_l2['count(*)'];

if($num == 0)
{
	$salt = "shankara";
	$pwd = sha1($salt.$pwd);
	
	$query = "INSERT INTO details values('$name','$email','$info','$pwd','','','0','1','')";
	$result = mysql_query($query);

	if($result)
	{
		$_SESSION['email'] = $email;
		$_SESSION['valid'] = 1;
		
		echo "<p class=\"fgentium small clr\">Registration Successful!</p>";		
		echo "<div class=\"fgentium small regs\" style=\"text-align: left\">";
		echo "<p>Thank you for registering!</p>";
		echo "<p>Please tick what applies to you. The short time you spend here will help us tune the content and interfaces in the subsequent releases. Thank you!</p>";
		echo "<form action=\"register_aux.php\" method=\"post\"><ul>
				<li><input name=\"interests[]\" type=\"checkbox\" id=\"b01\" value=\"Scholar\" /> <label for=\"b01\">Scholar</label></li>
				<li><input name=\"interests[]\" type=\"checkbox\" id=\"b02\" value=\"Studied the Prasthanatraya Bhashya\" /> <label for=\"b02\">Studied the Prasthanatraya Bhashya</label></li>
				<li><input name=\"interests[]\" type=\"checkbox\" id=\"b03\" value=\"Student of the Shastras\" /> <label for=\"b03\">Student of the Shastras</label></li>
				<li><input name=\"interests[]\" type=\"checkbox\" id=\"b04\" value=\"Academician\" /> <label for=\"b04\">Academician</label></li>
				<li><input name=\"interests[]\" type=\"checkbox\" id=\"b05\" value=\"Interested Seeker with good knowledge of Shastras and Sanskrit\" /> <label for=\"b05\">Interested Seeker with good knowledge of Shastras and Sanskrit</label></li>
				<li><input name=\"interests[]\" type=\"checkbox\" id=\"b06\" value=\"Interested Seeker with good knowledge of the Shastras acquired through translations\" /> <label for=\"b06\">Interested Seeker with good knowledge of the Shastras acquired through translations</label></li>
				<li><input name=\"interests[]\" type=\"checkbox\" id=\"b07\" value=\"Interested seeker and beginner with good knowledge of Sanskrit\" /> <label for=\"b07\">Interested seeker and beginner with good knowledge of Sanskrit</label></li>
				<li><input name=\"interests[]\" type=\"checkbox\" id=\"b08\" value=\"Interested seeker and beginner\" /> <label for=\"b08\">Interested seeker and beginner</label></li>
			</ul>";
		echo "<p>We welcome your feedback describing your experience with the present release. We are also very happy to receive your suggestions for improvement and feature additions in future releases.</p>"; 
		echo "<input class=\"proceed fright\" name=\"submit\" type=\"submit\" id=\"submit\" value=\"Proceed to Prasthanatraya Bhashya\"/>";
		echo "<input class=\"hide\" name=\"email\" type=\"input\" id=\"email\" value=\"$email\"/>";
		echo "</div></form>";
	}
}
else
{
	echo "<p class=\"fgentium small clr\">This e-mail id seems to be already registered with us. Try logging in or use another id.</p>";
	echo "<form method=\"post\" action=\"login_confirm.php\">
		<div class=\"registration\">
			<div class=\"otherp\">
				<ul>
					 <li>
						<h2 class=\"clr2 required_notification\">&nbsp;</h2>
						<h2 class=\"big clr2\">Login</h2>
					</li>
					<li>
						<label for=\"lemail\">Email&nbsp;<span class=\"clr2\">*</span></label><br />
						<input class=\"rinput\" type=\"text\" name=\"lemail\" id=\"lemail\" />
					</li>
					<li>
						<label for=\"lpassword\">Password&nbsp;<span class=\"clr2\">*</span></label><br />
						<input class=\"rinput\" type=\"password\" name=\"lpassword\" id=\"lpassword\" />
					</li>
                    <li id=\"pr_email_show\">
						<label for=\"pr_email\" class=\"clr2\">Enter your email address</label><br />
						<input class=\"rinput\" type=\"text\" name=\"pr_email\" id=\"pr_email\" />
 					</li>
					<li id=\"regForm\">
						<input class=\"rsubmit\" type=\"submit\" name=\"submit\" value=\"submit\"/>
                        <p class=\"forgotPassword fright clr2\"><a href=\"javascript:void(0);\" onclick=\"$('#lemail').prop('disabled', true);$('#lpassword').prop('disabled', true);$('#regForm h2').hide();$('#pr_email_show').show();\">Forgot your password?</a></p>
						<h2 class=\"clr2\" style=\"margin-top: 1em;\">If you are a first time user, then we request you to register below</h2>
					</li>
				</ul>
			</div>
		</div>
		</form>
		<form method=\"post\" action=\"register.php\">
		<div class=\"registration\">
			<div class=\"otherp\">
				<ul>
					 <li>
						<h2 class=\"clr2 required_notification\">* Required Field</h2>
						<h2 class=\"big clr2\">Registration</h2>
					</li>
					<li>
						<label for=\"name\">Name&nbsp;<span class=\"clr2\">*</span></label><br />
						<input class=\"rinput\" type=\"text\" name=\"name\" />
					</li>
					<li>
						<label for=\"email\">Email&nbsp;<span class=\"clr2\">*</span></label><br />
						<input class=\"rinput\" type=\"text\" name=\"email\" />
					</li>
					<li>
						<label for=\"info\">Information about yourself</label><br />
						<textarea class=\"rinput tinput\" name=\"info\" placeholder=\"Please tell us your background, interests and anything else you would like to share with us\"></textarea>
					</li>
					<li>
						<label for=\"password\">Password&nbsp;<span class=\"clr2\">*</span></label><br />
						<input class=\"rinput\" type=\"password\" name=\"password\" />
					</li>
					<li>
						<label for=\"cpassword\">Confirm Password&nbsp;<span class=\"clr2\">*</span></label><br />
						<input class=\"rinput\" type=\"password\" name=\"cpassword\" />
					</li>
					<li>
						<input class=\"rsubmit\" type=\"submit\" name=\"submit\" />
					</li>
				</ul>
			</div>
		</div>
		</form>";
}

?>
	</div>
</body>
</html>
