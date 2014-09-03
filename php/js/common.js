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

function getUrlParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}

function OnloadFunction(){
    $("#sidenav").height("100%");
    $("#rsidenav").height("96%");
    $("#sidenav").mCustomScrollbar({scrollInertia: 100});
    $(".mainNav #navLevel1").show();
    $("#showNavLevel1").addClass( "active" );
    setTimeout(function(){$('#sidenav').css('left','-360px');},1000);
    
    $( "#sidenav .arrow" ).click(
        function() {
            if($( '#sidenav' ).hasClass( "show" )){
                $( '#sidenav' ).removeClass( "show" );
                $( '.arrow i' ).fadeOut( 400, function(){$( '.arrow i' ).removeClass( "fa-times" );$( '.arrow i' ).addClass( "fa-navicon" );$( '.arrow i' ).fadeIn( 20 );} );
            }
            else{
                $( '#sidenav' ).addClass( "show" );
                $( '.arrow i' ).fadeOut( 400, function(){$( '.arrow i' ).removeClass( "fa-navicon" );$( '.arrow i' ).addClass( "fa-times" );$( '.arrow i' ).fadeIn( 20 );} );
            }
        }
    );    
    
    $( "#showNavLevel1" ).click(function() {$( ".mainNav ul" ).hide();$( "#showNavLevel2, #showNavLevel3, #showNavLevel4" ).removeClass( "active" );$( ".mainNav #navLevel1" ).show();$( "#showNavLevel1" ).addClass( "active" );$( ".sort" ).hide();$("#sidenav").mCustomScrollbar("scrollTo", 0);});
    $( "#showNavLevel2" ).click(function() {$( ".mainNav ul" ).hide();$( "#showNavLevel3, #showNavLevel4, #showNavLevel1" ).removeClass( "active" );$( ".mainNav #navLevel2" ).show();$( "#showNavLevel2" ).addClass( "active" );$( ".sort" ).show();$("#sidenav").mCustomScrollbar("scrollTo", 0);});
    $( "#showNavLevel3" ).click(function() {$( ".mainNav ul" ).hide();$( "#showNavLevel4, #showNavLevel1, #showNavLevel2" ).removeClass( "active" );$( ".mainNav #navLevel3" ).show();$( "#showNavLevel3" ).addClass( "active" );$( ".sort" ).show();$("#sidenav").mCustomScrollbar("scrollTo", 0);});
    $( "#showNavLevel4" ).click(function() {$( ".mainNav ul" ).hide();$( "#showNavLevel1, #showNavLevel2, #showNavLevel3" ).removeClass( "active" );$( ".mainNav #navLevel4" ).show();$( "#showNavLevel4" ).addClass( "active" );$( ".sort" ).show();$("#sidenav").mCustomScrollbar("scrollTo", 0);});
    
    setTimeout(function(){
        var hloc = window.location.href;
        var jump_id = hloc.split("#");
        jump_id = jump_id[1];
        $('#BH_'+jump_id).slideToggle('slow');
        var qid = getUrlParameter('qid');
        var hval = getUrlParameter('hval');
        if(qid === undefined){
        }
        else{
            $( "#" + qid ).before( "<p class=\"vishaya\"><i class=\"fa fa-arrow-right\"></i> " + decodeURIComponent(hval) +"</p>" );
            $("html, body").hide().fadeIn('slow').animate({ scrollTop: $( ".vishaya" ).offset().top - 140 }, 1)
        }
    },100);





    setTimeout( function(){$(document).scroll(function(){$('#callout').fadeOut(2000)})}, 2000);
    
    $(".qt a").hover(function(){var htmlc;var ht;htmlc = $(this).html();htmlc = htmlc.replace("<span class=\"highlight\">", "");htmlc = htmlc.replace("<\/span>", "");if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '#' + this.href.split(/\#/)[1];}});
    $(".qt a").focus(function(){var htmlc;var ht;htmlc = $(this).html();htmlc = htmlc.replace("<span class=\"highlight\">", "");htmlc = htmlc.replace("<\/span>", "");if((this.href.match(/bhashya/) == 'bhashya') && (this.href.match(/hval/) == null)){this.href = this.href.split(/\#/)[0] + '&hval=' + htmlc + '#' + this.href.split(/\#/)[1];}});
}
