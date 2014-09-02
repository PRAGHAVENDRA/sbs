<?php

echo "<div id=\"sidenav\">";
echo "  <nav class=\"subnav\">";
echo "      <div class=\"arrow\"><i class=\"fa fa-navicon\"></i></div>";
echo "      <ul>";
echo "          <li><a id=\"showNavLevel1\" href=\"javascript:void(0);\">अध्यायाः</a></li>";

if($bhashya == "BS_id.xml") {
    echo "          <li><a id=\"showNavLevel2\" href=\"javascript:void(0);\">सूत्राणि</a></li>";
    echo "          <li><a id=\"showNavLevel3\" href=\"javascript:void(0);\">अधिकरणानि</a></li>";
    echo "          <li><a id=\"showNavLevel4\" href=\"javascript:void(0);\">विषयाः</a></li>";
}
echo "      </ul>";
echo "  </nav>";

echo "  <nav class=\"mainNav\">";
include("include_level".$level."_nav.php");

if($bhashya == "BS_id.xml") {
    include("include_sutra_list.php");
    include("include_adhikarana_list.php");
    include("include_vishaya_list.php");
}
echo "  </nav>";
echo "</div>";

?>
