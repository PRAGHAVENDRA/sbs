function loadXMLDoc()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajax_info.txt",true);
xmlhttp.send();
}

function test(){
	$( "#AI_C01_S01_V01.versetext" ).load( "Aitareya_id.html",function() {
  alert( "Load was performed.")} );
}

function show_s2(){
	
}
function show_bhashya(id)
{	
	$(id).slideToggle('slow');
}
function show_nav_level1(id)
{	
	id = id + 'ul';
	$(id).slideToggle('fast');
}
