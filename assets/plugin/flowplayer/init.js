+function($){
    $(document).ready(function(){
      // Option: playerSrc can also be set to: http://releases.flowplayer.org/swf/flowplayer-3.2.18.swf
      var playerSrc = $("#player").attr('player-src');
      flowplayer("player", playerSrc, {
          clip: {
              autoPlay: false,
              autoBuffering: true
          }
      });
    });
}(jQuery);