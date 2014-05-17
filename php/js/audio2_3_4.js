$(document).ready(function() {
        var audioElement2 = document.createElement('audio');
        audioElement2.setAttribute('src', 'audio/verse2.mp3');
        audioElement2.setAttribute('id', 'verse2');
        
        var audioElement3 = document.createElement('audio');
        audioElement3.setAttribute('src', 'audio/verse3.mp3');
        audioElement3.setAttribute('id', 'verse3');
        
        var audioElement4 = document.createElement('audio');
        audioElement4.setAttribute('src', 'audio/verse4.mp3');
        audioElement4.setAttribute('id', 'verse4');
        
        $.get();
        audioElement2.addEventListener("load", function() {audioElement2.play();}, true);
        audioElement3.addEventListener("load", function() {audioElement3.play();}, true);
        audioElement4.addEventListener("load", function() {audioElement4.play();}, true);
        
        $('#play2').click(function() {$('#playbutton2').hide(10);$('#pausebutton2').show(10);audioElement2.play();audioElement3.pause();audioElement4.pause();$('#pausebutton3').hide(1);$('#playbutton3').show(1);$('#pausebutton4').hide(1);$('#playbutton4').show(1);});
		$(audioElement2).bind("ended", function(){$('#pausebutton2').hide(10);$('#playbutton2').show(10);});
        $('#pause2').click(function() {$('#pausebutton2').hide(10);$('#playbutton2').show(10);audioElement2.pause();});
        
        $('#play3').click(function() {$('#playbutton3').hide(10);$('#pausebutton3').show(10);audioElement3.play();audioElement2.pause();audioElement4.pause();$('#pausebutton2').hide(1);$('#playbutton2').show(1);$('#pausebutton4').hide(1);$('#playbutton4').show(1);});
		$(audioElement3).bind("ended", function(){$('#pausebutton3').hide(10);$('#playbutton3').show(10);});
        $('#pause3').click(function() {$('#pausebutton3').hide(10);$('#playbutton3').show(10);audioElement3.pause();});
        
        $('#play4').click(function() {$('#playbutton4').hide(10);$('#pausebutton4').show(10);audioElement4.play();audioElement2.pause();audioElement3.pause();$('#pausebutton2').hide(1);$('#playbutton2').show(1);$('#pausebutton3').hide(1);$('#playbutton3').show(1);});
		$(audioElement4).bind("ended", function(){$('#pausebutton4').hide(10);$('#playbutton4').show(10);});
        $('#pause4').click(function() {$('#pausebutton4').hide(10);$('#playbutton4').show(10);audioElement4.pause();});
    });    
