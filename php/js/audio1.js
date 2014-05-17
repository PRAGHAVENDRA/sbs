$(document).ready(function() {
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'audio/verse1.mp3');
        audioElement.setAttribute('id', 'verse1');
        //audioElement.load()

        $.get();
        audioElement.addEventListener("load", function() {audioElement.play();}, true);
        $('#play1').click(function() {$('#playbutton1').hide(10);$('#pausebutton1').show(10);audioElement.play();});		
		$(audioElement).bind("ended", function(){$('#pausebutton1').hide(10);$('#playbutton1').show(10);});
        $('#pause1').click(function() {$('#pausebutton1').hide(10);$('#playbutton1').show(10);audioElement.pause();});
    });    
