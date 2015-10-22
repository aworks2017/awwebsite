jQuery(document).ready(function() {

    jQuery( '.wpc_client_client_pages_tree' ).each( function() {
        var obj = jQuery(this);

        var form_id = obj.data( 'form_id' );
        var php_data = window['wpc_pagel_pagination' + form_id];

        var client_id = ( php_data.client_id ) ? php_data.client_id : 0;
        var _wpnonce = ( php_data.client_id ) ? php_data._wpnonce : '';

        var search = '';

        var order_by = '';
        var order = '';
        obj.find( 'th.wpc_sortable' ).each( function(){
            order_by = jQuery(this).find( '.wpc_cust_page_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');

            if( jQuery(this).hasClass( 'wpc_sort_desc' ) ) {
                order = 'desc';
            } else if( jQuery(this).hasClass( 'wpc_sort_asc' ) ) {
                order = 'asc';
            }
        });

        obj.find( '.wpc_ajax_overflow_tree' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_pagel_shortcode_tree_pagination&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&search=' + search + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {
                    obj.find( '.wpc_client_pages_tree_content' ).html( '<table class="wpc_client_pages_tree">' + data.html + '</table><div class="wpc_ajax_overflow_tree"><div class="wpc_ajax_loading"></div></div>' );

                    init_treetable( false, obj.find( '.wpc_client_pages_tree' ) );

                    obj.find( '.wpc_ajax_overflow_tree' ).hide();
                }
            }
        });
    });

    function init_treetable( with_loader, shortcode ) {
        if( with_loader ) {
            shortcode.treetable({
                expandable: true,
                onInitialized: function() {
                    shortcode.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_ajax_overflow_tree' ).hide();
                    shortcode.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_client_pages_tree' ).show();
                }
            });
        } else {
            shortcode.treetable({
                expandable: true,
                onInitialized: function() {
                    shortcode.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_client_pages_tree' ).show();
                }
            });
        }

        var $bodyCells = shortcode.find('tbody tr');

        var item = 0;
        $bodyCells.each( function() {
            if( jQuery( this ).is( ':visible' ) ) {
                item++;
                if( item%2 == 0 ) {
                    jQuery( this ).css( 'background', '#eee' );
                } else {
                    jQuery( this ).css( 'background', '#fff' );
                }
            }

            if( shortcode.height() < 300 ) {
                jQuery( this ).append( '<td class="wpc_scroll_column"></td>' );
            }
        });
    }

    jQuery( '.wpc_client_client_pages_tree' ).on( 'click', '.indenter', function() {
        var $table = jQuery(this).parents( '.wpc_client_pages_tree' );
        var $bodyCells = $table.find('tbody tr');

        var item = 0;
        $bodyCells.each( function() {
            if( jQuery( this ).is( ':visible' ) ) {
                item++;
                if( item%2 == 0 ) {
                    jQuery( this ).css( 'background', '#eee' );
                } else {
                    jQuery( this ).css( 'background', '#fff' );
                }
            }

            if( $table.height() < 300 ) {
                if( jQuery( this ).find( '.wpc_scroll_column' ).length == 0 ) {
                    jQuery( this ).append( '<td class="wpc_scroll_column"></td>' );
                }
            } else {
                jQuery( this ).find( '.wpc_scroll_column' ).remove();
            }
        });
    });


    jQuery( '.wpc_client_client_pages_tree .wpc_pages_search_button' ).click( function() {
        var obj = jQuery(this);

        var form_id = obj.parents( '.wpc_client_client_pages_tree' ).data( 'form_id' );
        var php_data = window['wpc_pagel_pagination' + form_id];

        var client_id = ( php_data.client_id ) ? php_data.client_id : 0;
        var _wpnonce = ( php_data.client_id ) ? php_data._wpnonce : '';

        var search = jQuery.trim( obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_pages_search' ).val() );
        if( search == '' ) {
            return false;
        }

        var order_by = '';
        var order = '';
        obj.parents( '.wpc_client_client_pages_tree' ).find( 'th.wpc_sortable' ).each( function() {
            order_by = jQuery(this).find( '.wpc_cust_page_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');

            if( jQuery(this).hasClass( 'wpc_sort_desc' ) ) {
                order = 'desc';
            } else if( jQuery(this).hasClass( 'wpc_sort_asc' ) ) {
                order = 'asc';
            }
        });

        obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_ajax_overflow_tree' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_pagel_shortcode_tree_pagination&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&search=' + search + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {

                    obj.parents('.wpc_client_client_pages_tree').find( '.wpc_client_pages_tree_content' ).html( '<table class="wpc_client_pages_tree">' + data.html + '</table><div class="wpc_ajax_overflow_tree"><div class="wpc_ajax_loading"></div></div>' );

                    init_treetable( false, obj.parents('.wpc_client_client_pages_tree').find( '.wpc_client_pages_tree' ) );

                    obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_pages_search' ).addClass( 'wpc_searched' );
                    obj.parents( '.wpc_client_client_pages_tree' ).find('.wpc_pages_clear_search' ).show();

                    obj.parents('.wpc_client_client_pages_tree').find( '.wpc_ajax_overflow_tree' ).hide();
                }
            }
        });
    });


    jQuery( '.wpc_client_client_pages_tree .wpc_pages_search' ).keyup( function(event) {
        if( event.keyCode == 13 ) {
            jQuery(this).parents( '.wpc_client_client_pages_tree' ).find( '.wpc_pages_search_button' ).trigger( 'click' );
            event.stopPropagation();
        }
    });


    jQuery( '.wpc_client_client_pages_tree .wpc_pages_clear_search' ).click( function() {
        var obj = jQuery(this);

        var form_id = obj.parents( '.wpc_client_client_pages_tree' ).data( 'form_id' );
        var php_data = window['wpc_pagel_pagination' + form_id];

        var client_id = ( php_data.client_id ) ? php_data.client_id : 0;
        var _wpnonce = ( php_data.client_id ) ? php_data._wpnonce : '';

        var search = '';

        var order_by = '';
        var order = '';
        obj.parents( '.wpc_client_client_pages_tree' ).find( 'th.wpc_sortable' ).each( function() {
            order_by = jQuery(this).find( '.wpc_cust_page_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');

            if( jQuery(this).hasClass( 'wpc_sort_desc' ) ) {
                order = 'desc';
            } else if( jQuery(this).hasClass( 'wpc_sort_asc' ) ) {
                order = 'asc';
            }
        });

        obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_ajax_overflow_tree' ).show();
/*var obj = jQuery(this);

var client_id  = 0;
var _wpnonce = '';

var form_id = obj.parents( '.wpc_client_client_pages_tree' ).data( 'form_id' );
var php_data = window['wpc_fileslu_pagination' + files_form_id];

if( php_data.client_id ) {
    var client_id = php_data.client_id;
    var _wpnonce = php_data._wpnonce;
}

var search = '';

var order_by = '';
var order = '';
obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_client_files th.wpc_sortable' ).each( function(){
    if( jQuery(this).hasClass( 'wpc_sort_desc' ) ) {

        var clsName = jQuery(this).find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w)[0].replace('wpc_cust_sort_','');
        order_by = clsName;
        order = 'desc';

    } else if( jQuery(this).hasClass( 'wpc_sort_asc' ) ) {

        var clsName = jQuery(this).find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w)[0].replace('wpc_cust_sort_','');
        order_by = clsName;
        order = 'asc';

    }
});

obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_ajax_overflow_tree' ).show();  */
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_pagel_shortcode_tree_pagination&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&search=' + search + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {

                    obj.parents('.wpc_client_client_pages_tree').find( '.wpc_client_pages_tree_content' ).html( '<table class="wpc_client_pages_tree">' + data.html + '</table><div class="wpc_ajax_overflow_tree"><div class="wpc_ajax_loading"></div></div>' );

                    init_treetable( false, obj.parents('.wpc_client_client_pages_tree').find( '.wpc_client_pages_tree' ) );

                    obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_pages_search' ).removeClass( 'wpc_searched' ).val('');
                    obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_pages_clear_search' ).hide();

                    obj.parents('.wpc_client_client_pages_tree').find( '.wpc_ajax_overflow_tree' ).hide();

                }
            }
        });
    });


    jQuery( '.wpc_client_pages_tree_header th.wpc_sortable' ).on( 'click', function() {
        var obj = jQuery(this);
        var clsName = obj.find( '.wpc_cust_page_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');

        var form_id = obj.parents( '.wpc_client_client_pages_tree' ).data( 'form_id' );
        var php_data = window['wpc_pagel_pagination' + form_id];

        var client_id = ( php_data.client_id ) ? php_data.client_id : 0;
        var _wpnonce = ( php_data.client_id ) ? php_data._wpnonce : '';


        var search = obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_pages_search.wpc_searched' ).val();

        if( typeof search === "undefined") {
            search = '';
        }


        if( obj.hasClass( 'wpc_sort_asc' ) ) {

            var order_by = clsName;
            var order = 'desc';

        } else if( obj.hasClass( 'wpc_sort_desc' ) ) {

            var order_by = clsName;
            var order = 'asc';

        } else if( !obj.hasClass( 'wpc_sort_desc' ) && !obj.hasClass( 'wpc_sort_asc' ) ) {

            var order_by = clsName;
            var order = 'asc';
        }

        if( obj.hasClass( 'wpc_sort_asc' ) ) {
            obj.parents( '.wpc_client_client_pages_tree' ).find('th.wpc_sortable').removeClass('wpc_sort_asc').removeClass('wpc_sort_desc');
            obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_cust_sort_' + clsName ).parents('th.wpc_sortable').addClass( 'wpc_sort_desc' );


        } else if( obj.hasClass( 'wpc_sort_desc' ) ) {
            obj.parents( '.wpc_client_client_pages_tree' ).find('th.wpc_sortable').removeClass('wpc_sort_asc').removeClass('wpc_sort_desc');
            obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_cust_sort_' + clsName ).parents('th.wpc_sortable').addClass( 'wpc_sort_asc' );


        } else if( !obj.hasClass( 'wpc_sort_desc' ) && !obj.hasClass( 'wpc_sort_asc' ) ) {
            obj.parents( '.wpc_client_client_pages_tree' ).find('th.wpc_sortable').removeClass('wpc_sort_asc').removeClass( 'wpc_sort_desc' );
            obj.addClass( 'wpc_sort_asc' );
        }


        obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_ajax_overflow_tree' ).show();

/*        var order_by = '';
        var order = '';
        obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_client_files th.wpc_sortable' ).each( function() {
            order_by = jQuery(this).find( '.wpc_cust_page_sort' ).attr('class').match(/\w*wpc_cust_sort_\w/)[0].replace('wpc_cust_sort_','');

            if( jQuery(this).hasClass( 'wpc_sort_desc' ) ) {
                order = 'desc';
            } else if( jQuery(this).hasClass( 'wpc_sort_asc' ) ) {
                order = 'asc';
            }
        }); */
/*        var obj = jQuery(this);
        var clsName = obj.find( '.wpc_cust_page_sort' ).attr('class').match(/\w*wpc_cust_sort_\w/)[0].replace('wpc_cust_sort_','');

        var form_id = obj.parents( '.wpc_client_client_pages_tree' ).data( 'form_id' );
        var php_data = window['wpc_fileslu_pagination' + form_id];

        var client_id  = 0;
        var _wpnonce = '';

        if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';

        } else if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_filesla_shortcode' ) ) {

            var shortcode_type = 'filesla';
            var php_data = window['wpc_filesla_pagination' + files_form_id];
        }

        if( php_data.client_id ) {
            var client_id = php_data.client_id;
            var _wpnonce = php_data._wpnonce;
        }







        obj.parents( '.wpc_client_client_pages_tree' ).find( '.wpc_ajax_overflow_tree' ).show();     */
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_pagel_shortcode_tree_pagination&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&search=' + search + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {
                    obj.parents('.wpc_client_client_pages_tree').find( '.wpc_client_pages_tree_content' ).html( '<table class="wpc_client_pages_tree">' + data.html + '</table><div class="wpc_ajax_overflow_tree"><div class="wpc_ajax_loading"></div></div>' );

                    init_treetable( false, obj.parents('.wpc_client_client_pages_tree').find( '.wpc_client_pages_tree' ) );

                    obj.parents('.wpc_client_client_pages_tree').find( '.wpc_ajax_overflow_tree' ).hide();
                }
            }
        });

    });

});
