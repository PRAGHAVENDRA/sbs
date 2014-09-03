<?php

if(($hval != '') && (!(isset($_GET['qid']))))
{
	echo "<div class=\"callout left\" id=\"callout\">
	<span class=\"qt\">$hval</span>
	<b class=\"co_arrow co_arrow_border\"></b>
	<b class=\"co_arrow\"></b>
	</div>";
}

?>
