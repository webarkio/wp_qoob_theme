/*
 * Webark Vimeo
 *
 *
 */
(function($) {
    var player, options;

    $.webarkVimeo = function(options) {

        var base = this;

        // kick things off
        base.init = function() {
            base.options = $.extend({}, $.webarkVimeo.options, options);
            $(window).data('webarkOptions', base.options);
            base.loadVimeoAPI();
        };

        // load Vimeo API by inserting player iframe
        base.loadVimeoAPI = function() {
            base.options.target.append('<div class="mbYTP_wrapper"><iframe id="webarkplayer' + base.options.videoId + '" class="webarkplayer" src="//player.vimeo.com/video/' + base.options.videoId + '?api=1&title=0&byline=0&portrait=0&playbar=0&loop=' + base.options.loop + '&autoplay=1&player_id=webarkplayer' + base.options.videoId + '" frameborder="0" style="visibility:hidden;"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>');
            options = jQuery(window).data('webarkOptions');
            var iframe = options.target.find('#webarkplayer' + base.options.videoId)[0],
                player = $f(iframe);

            player.addEvent('ready', function() {
                player.api('setLoop', options.loop);
                player.api('setVolume', options.volume);
                // hide player until Vimeo hides controls...
                window.setTimeout(function() {
                    options.target.find('#webarkplayer' + base.options.videoId).css('visibility', 'visible');
                }, 4000);
            });
        };

        base.init();
    };

    $.webarkVimeo.options = {
        loop: 1,
        volume: 0,
        onReady: null,
        autoplay: true
    };

    $.fn.webarkVimeo = function(options) {
        options.target = this;
        return this.each(function() {
            (new $.webarkVimeo(options));
        });
    };

})(jQuery);