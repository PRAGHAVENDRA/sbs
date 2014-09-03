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
echo "      <div class=\"sort hide\">";
echo "          <button title=\"Sort by order of occurrence\" id=\"sortNumeric\"><i class=\"fa fa-sort-numeric-asc\"></i></button>";
echo "          <button title=\"Sort alphabetically\" id=\"sortAlphabet\"><i class=\"fa fa fa-sort-alpha-asc\"></i></button>";
echo "      </div>";
include("include_level".$level."_nav.php");

if($bhashya == "BS_id.xml") {
    echo "  <ul id=\"navLevel2\">";
    include("include_sutra_list.php");
    echo "  </ul>";
    
    echo "  <ul id=\"navLevel3\">";
    include("include_adhikarana_list.php");
    echo "  </ul>";
    
    echo "  <ul id=\"navLevel4\">";
    include("include_vishaya_list.php");
    echo "  </ul>";
}
echo "  </nav>";
echo "</div>";

?>
