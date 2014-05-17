<?php

include("common.php");

if(isset($_POST['lemail']))
{
	$lemail = $_POST['lemail'];
	if($lemail == '')
	{
		@header("Location: login.php?error=1");
		exit;
	}
}
else
{
	@header("Location: login.php?error=1");
	exit;
}

if(isset($_POST['lpassword']))
{
	$lpassword = $_POST['lpassword'];
	if($lpassword == '')
	{
		@header("Location: login.php?error=2");
		exit;
	}
}
else
{
	@header("Location: login.php?error=2");
	exit;
}

VerifyCredentials($lemail, $lpassword);

?>
