/*
 * FeatureList - simple and easy creation of an interactive "Featured Items" widget
 * Examples and documentation at: http://jqueryglobe.com/article/feature_list/
 * Version: 1.0.0 (01/09/2009)
 * Copyright (c) 2009 jQueryGlobe
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
 * Requires: jQuery v1.3+
*/
;(function($) {
	$.fn.featureList = function(options) {
		var tabs	= $(this);
		var output	= $(options.output);
		
		new $.featureList(tabs, output, options);

		return this;	
	};

	$.featureList = function(tabs, output, options) {
		function slide(nr) {
			if (typeof nr === "undefined") {
				nr = visible_item + 1;
				nr = nr >= total_items ? 0 : nr;
			}
                        visible_item = nr;
                        if (tabs) {
                            tabs.removeClass('current').filter(":eq(" + nr + ")").addClass('current');
			
                            tabs.parent('li').removeClass('current');
                            tabs.filter(":eq(" + nr + ")").parent('li:first').addClass('current');
                        }
                         
			output.stop(true, true).filter(":visible").fadeOut(options.transition_speed);
			output.filter(":eq(" + nr + ")").fadeIn(options.transition_speed);
		}
                var tb_change = "next";
		var options			= options || {}; 
		var total_items		= tabs.length || output.length;
		var visible_item	= options.start_item || 0;

		options.pause_on_hover		= options.pause_on_hover		|| true;
		options.transition_interval	= options.transition_interval	|| 5000;
                options.transition_speed        = options.transition_speed || true;
                options.arrow_nav               = options.arrow_nav.length === 2 ? options.arrow_nav : false;

		output.hide().eq( visible_item ).show();
                if (tabs) {
                    tabs.eq( visible_item ).addClass('current');
                    tabs.eq( visible_item ).parent('li:first').addClass('current');

                    tabs.click(function() {
                            if ($(this).hasClass('current')) {
                                    return false;	
                            }

                            slide( tabs.index( this) );
                        });
                }
                if (options.arrow_nav) {
                    options.arrow_nav.css({"cursor": "pointer"});
                    options.arrow_nav.click(function(){
                       clickArrow(this);
                    });
                }
                
                function clickArrow(el) {
                    var nr = visible_item + (+ $(el).attr("data-toggle")); 
                    if (nr >= total_items) {
                        nr = 0;
                    } else if (nr < 0) {
                        nr = total_items - 1;
                    } 
                   slide(nr);
                   return;
                }

		if (options.transition_interval > 0) {
			var timer = setInterval(function () {
				slide();
			}, options.transition_interval);

			if (options.pause_on_hover) {
                            if (options.arrow_nav) {
                                options.arrow_nav.mouseenter(function() {
                                    clearInterval( timer );
                                }).mouseleave(function() {
                                    clearInterval( timer );
                                    timer = setInterval(function () {
                                        slide();
                                    }, options.transition_interval);
				});
                            }
                            if (tabs) {
                                tabs.mouseenter(function() {
                                        clearInterval( timer );

                                }).mouseleave(function() {
                                        clearInterval( timer );
                                        timer = setInterval(function () {
                                                slide();
                                        }, options.transition_interval);
                                });
                            }
			}
		}
	};
})(jQuery);