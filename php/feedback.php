<?php
session_start();

if(!(isset($_SESSION['valid'])))
{
	@header("Location: login.php");
	exit;
}
elseif($_SESSION['valid'] != 1)
{
	@header("Location: login.php");
	exit;
}

require_once("common.php");
require_once("connect.php");
require_once('recaptchalib.php');
require_once('includes/class.phpmailer.php');

$error_message = array("0"=>"","1"=>"Name can not be left blank<br />","2"=>"E-mail can not be left blank<br />","3"=>"Message type can not be left blank<br />","4"=>"Subject can not be left blank<br />","5"=>"Message is blank!<br />","6"=>"Invalid CAPTCHA! Please try again<br />","7"=>"Invalid e-mail!<br />");

$publickey = "6Lc6KPMSAAAAAJ-yzoW7_KCxyv2bNEZcLImzc7I8";
$privatekey = "6Lc6KPMSAAAAANrIJ99zGx8wxzdUJ6SwQzk1BgXX";

$error_val = 0;

if(isset($_POST['message'])){$message = $_POST['message'];if($message == ''){$error_val = 5;}}else{$message = '';}
if(isset($_POST['subject'])){$subject = $_POST['subject'];if($subject == ''){$error_val = 4;}}else{$subject = '';}
if(isset($_POST['type'])){$type = $_POST['type'];if($type == ''){$error_val = 3;}}else{$type = '';}
if(isset($_POST['email'])){$email = $_POST['email'];if($email == ''){$error_val = 2;}else{if(!(preg_match("/.*\@[a-zA-Z0-9\.]+\.[a-zA-Z0-9\.]+/", $email))){$error_val = 7;}}}else{$email = '';}
if(isset($_POST['name'])){$name = $_POST['name'];if($name == ''){$error_val = 1;}}else{$name = '';}
$resp = null;
$error = null;

$isfirst = 1;
if($error_val == 0)
{
    if (isset($_POST["recaptcha_response_field"])) {
            $isfirst = 0;
            $resp = recaptcha_check_answer ($privatekey,
                                            $_SERVER["REMOTE_ADDR"],
                                            $_POST["recaptcha_challenge_field"],
                                            $_POST["recaptcha_response_field"]);
            if ($resp->is_valid) {
                    
            } else {
                    $error_val = 6;
            }
    }
}

if(($error_val == 0) && ($isfirst == 0))
{
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang= "en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style/indexstyle.css" media ="screen" />
	<link rel="stylesheet" type="text/css" href="style/reset.css" media ="screen" />
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<title>Shankara Bhashya</title>
    <script type="text/javascript">
	function OnloadFunction(){
        setTimeout(function () {
            window.location.href= 'prasthanatraya.php';
         },7000);
	}
	$(document).ready(OnloadFunction);
	</script>
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
    <div class="page">
<?php
    $to = $supportEmail;
    
    $mail = new PHPMailer();
    $mail->isSendmail();
    $mail->WordWrap = 50;
    $mail->setFrom($email, $name);
    $mail->addReplyTo($email, $name);
    $mail->addAddress($to, 'Advaita Sharada');
    $mail->Subject = '[' . $type . '] ' . $subject;
    $mail->Body = $message;

    if($mail->send())
    {
        echo "<p class=\"fgentium small clr\">Thank you for giving your feedback. You wil hear from us shortly.<br />Now you will be redirected to the home page.</p>";
    }
    else
    {
        echo "<p class=\"fgentium small clr\">".$mail->ErrorInfo."<br />Error encountered while submitting your feedback. Please try again after some time. Sorry for the inconvenience.</p>";
    }
    echo "
    </div>
</body>
</html>";
}
elseif(($error_val > 0) || ($isfirst == 1))
{
    $err_str = $error_message{$error_val};
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang= "en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style/indexstyle.css" media ="screen" />
	<link rel="stylesheet" type="text/css" href="style/reset.css" media ="screen" />
<!--
	<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script><script>
        tinymce.init({selector:'textarea', menubar: "fasle", toolbar: "bold italic underline | bullist numlist | outdent indent"});
    </script>
-->
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
    <div class="page">
<?php
    echo "<p class=\"fgentium small clr\">Feedback</p>
        <form method=\"post\" action=\"feedback.php\">
            <div class=\"feedback\">
                <div class=\"otherp\">
                    <ul>
                         <li>
                            <h2 class=\"clr2 required_notification\">$err_str</h2>
                            <h2 class=\"big clr2\"></h2>
                        </li>
                        <li>
                            <label for=\"name\">Name&nbsp;<span class=\"clr2\">*</span></label><br />
                            <input class=\"rinput\" type=\"text\" name=\"name\" value=\"$name\"/>
                        </li>
                        <li>
                            <label for=\"email\">Email&nbsp;<span class=\"clr2\">*</span></label><br />
                            <input class=\"rinput\" type=\"text\" name=\"email\" value=\"$email\" />
                        </li>
                        <li>
                            <label for=\"type\">Message type&nbsp;<span class=\"clr2\">*</span></label><br />";?>
<select class="rinput" name="type" >
    <option value=""></option>
    <option value="Shastra" <?php echo preg_match("/^Shastra$/", $type) ? "selected=\"selected\"" : ""?>>Shastra</option>
    <option value="Software" <?php echo preg_match("/^Software$/", $type) ? "selected=\"selected\"" : ""?>>Software</option>
    <option value="General" <?php echo preg_match("/^General$/", $type) ? "selected=\"selected\"" : ""?>>General</option>
</select>
<?php echo "</li>
                        <li>
                            <label for=\"subject\">Subject&nbsp;<span class=\"clr2\">*</span></label><br />
                            <input class=\"rinput\" type=\"text\" name=\"subject\" value=\"$subject\"/>
                        </li>
                        <li>
                            <label for=\"message\">Message&nbsp;<span class=\"clr2\">*</span></label><br />
                            <textarea class=\"rinput tinput\" name=\"message\" placeholder=\"Please let us know your feedback.\">$message</textarea>
                        </li>
                        <li>";
echo recaptcha_get_html($publickey);
echo "                  </li>
                        <li>
                            <input class=\"rsubmit\" type=\"submit\" name=\"submit\" value=\"submit\"/>
                        </li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</body>
</html>";
}
?>
