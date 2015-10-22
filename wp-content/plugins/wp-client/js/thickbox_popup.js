var TB_WIDTH = 0;
var TB_HEIGHT = 0;
jQuery.fn.wpc_thickbox_popup = function( args ) {
    var size = jQuery(this).wpc_calc_size();
    var popup_width = size.width;
    var popup_height = size.height;

    var id = jQuery(this).prop('id');

    tb_href = '#TB_inline?width=' + ( popup_width ) + '&height=' + popup_height + '&inlineId=' + id;

    if( typeof args.title != 'undefined' ) {
        p_title = args.title;
    } else {
        p_title = '';
    }

    tb_show(p_title, tb_href,'');
};

jQuery.fn.wpc_calc_size = function( args ) {
    if( jQuery(this).is(':visible') ) {
        var popup_width = jQuery(this).outerWidth(true);
        var popup_height = jQuery(this).outerHeight(true);
    } else {
        var popup_width = jQuery(this).actual('width') + 30;
        var popup_height = jQuery(this).actual('height') + 15;
    }

    if( jQuery(window).width() < popup_width ) {
        popup_width = jQuery(window).width() - 30;
    }
    if( popup_width < 300 ) popup_width = 300;

    if( jQuery(window).height()*0.9 < popup_height ) {
        popup_height = jQuery(window).height()*0.9;
    }

    return {
        'width' : popup_width,
        'height' : popup_height
    };
};

jQuery.wpcChangeSize = function() {
    var size = jQuery("#TB_ajaxContent").children().wpc_calc_size();
    popup_height = size.height * 1;
    if( jQuery(window).height()*0.9 < popup_height ) {
        popup_height = jQuery(window).height()*0.9;
    }
    TB_HEIGHT = popup_height;
    jQuery("#TB_ajaxContent").height( popup_height + 'px' );
    tb_position();
    return true;
};

jQuery.wpcShowLoad = function() {
    jQuery("body").append("<div id='TB_load'><img src='"+imgLoader.src+"' width='208' /></div>");//add loader to the page
    jQuery('#TB_load').show();//show loader
    return true;
};
jQuery.wpcHideLoad = function() {
    jQuery("#TB_load").remove();
    return true;
};

var tb_position;
!function(a) {
    tb_position = function() {
        var isIE6 = typeof document.body.style.maxHeight === "undefined";

        jQuery("#TB_window").css({marginLeft: '-' + parseInt((TB_WIDTH / 2),10) + 'px', width: TB_WIDTH + 'px'});
            if ( ! isIE6 ) { // take away IE6
                jQuery("#TB_window").css({marginTop: '-' + parseInt((TB_HEIGHT / 2),10) + 'px'});
            }
    }, a(window).resize(function() {
        tb_position()
    })
}(jQuery);

(function(a){a.fn.addBack=a.fn.addBack||a.fn.andSelf;
a.fn.extend({actual:function(b,l){if(!this[b]){throw'$.actual => The jQuery method "'+b+'" you called does not exist';}var f={absolute:true,clone:true,includeMargin:true};
var i=a.extend(f,l);var e=this.eq(0);var h,j;if(i.clone===true){h=function(){var m="position: absolute !important; top: -1000 !important; ";e=e.clone().attr("style",m).appendTo("body");
};j=function(){e.remove();};}else{var g=[];var d="";var c;h=function(){c=e.parents().addBack().filter(":hidden");d+="visibility: hidden !important; display: block !important; ";
if(i.absolute===true){d+="position: absolute !important; ";}c.each(function(){var m=a(this);var n=m.attr("style");g.push(n);m.attr("style",n?n+";"+d:d);
});};j=function(){c.each(function(m){var o=a(this);var n=g[m];if(n===undefined){o.removeAttr("style");}else{o.attr("style",n);}});};}h();var k=/(outer)/.test(b)?e[b](i.includeMargin):e[b]();
j();return k;}});})(jQuery);