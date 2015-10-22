var filter = new Object();

jQuery(document).ready(function() {

/*    jQuery( '.wpc_files_tree' ).each( function() {
        init_treetable( true, jQuery(this) );
    });

    // We need to rework the sizes so they are actually sortable
    jQuery('td.size').each(function() {
        var size = jQuery(this).attr('data-size').split(' ');
        var multiplier = 1;
        switch(size[1]) {
            case 'K':
                multiplier = 1000;
                break;
            case 'MB':
                multiplier = 1000000;
                break;
            case 'G':
                multiplier = 1000000000;
                break;
        }
        jQuery(this).attr('data-size', Math.round(parseFloat(size[0]) * multiplier) );

    });


    init_tooltips();  */


    jQuery( '.wpc_client_files_tree' ).each( function() {
        var obj = jQuery(this);

        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        var files_form_id = obj.data( 'form_id' );

        if( obj.hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.hasClass( 'wpc_filesla_shortcode' ) ) {

            var shortcode_type = 'filesla';
            var php_data = window['wpc_filesla_pagination' + files_form_id];
            var exclude_author = php_data.exclude_author;

        }

        if( php_data.client_id ) {
            var client_id = php_data.client_id;
            var _wpnonce = php_data._wpnonce;
        }

        var filters = '';
        var search = '';
        var order_by = '';
        var order = '';
        obj.find( '.wpc_client_files th.wpc_sortable' ).each( function(){
            if( jQuery(this).hasClass( 'wpc_sort_desc' ) ) {

                var clsName = jQuery(this).find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');
                order_by = clsName;
                order = 'desc';

            } else if( jQuery(this).hasClass( 'wpc_sort_asc' ) ) {

                var clsName = jQuery(this).find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');
                order_by = clsName;
                order = 'asc';

            }
        });

        obj.find( '.wpc_ajax_overflow_tree' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_files_shortcode_tree_pagination&shortcode_type=' + shortcode_type + '&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&filters=' + filters + '&search=' + search + '&exclude_author=' + exclude_author + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {
                    obj.find( '.wpc_files_tree_content' ).html( '<table class="wpc_files_tree">' + data.html + '</table><div class="wpc_ajax_overflow_tree"><div class="wpc_ajax_loading"></div></div>' );

                    init_tooltips();
                    init_treetable( false, obj.find( '.wpc_files_tree' ) );

                    obj.find( '.wpc_ajax_overflow_tree' ).hide();
                }
            }
        });
    });



    jQuery( '.wpc_client_files_tree' ).on( 'click', '.indenter', function() {
        var $table = jQuery(this).parents('.wpc_files_tree');
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

            if( $table.height() < 200 ) {
                if( jQuery( this ).find( '.wpc_scroll_column' ).length == 0 ) {
                    jQuery( this ).append( '<td class="wpc_scroll_column"></td>' );
                }
            } else {
                jQuery( this ).find( '.wpc_scroll_column' ).remove();
            }
        });
    });


    jQuery( '.wpc_files_tree_header th.wpc_sortable' ).on( 'click', function() {
        var obj = jQuery(this);
        var clsName = obj.find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');

        var files_form_id = obj.parents( '.wpc_client_files_tree' ).data( 'form_id' );

        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_filesla_shortcode' ) ) {

            var shortcode_type = 'filesla';
            var php_data = window['wpc_filesla_pagination' + files_form_id];
            var exclude_author = php_data.exclude_author;

        }

        if( php_data.client_id ) {
            var client_id = php_data.client_id;
            var _wpnonce = php_data._wpnonce;
        }


        var filters = '';
        if( typeof filter !== 'undefined' && typeof filter[files_form_id] !== 'undefined' && Object.keys(filter[files_form_id]).length > 0 ) {
            filters = jQuery.base64Encode( JSON.stringify( filter[files_form_id] ) );
        }

        var search = obj.parents( '.wpc_client_files_tree' ).find( '.wpc_files_search.wpc_searched' ).val();

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
            obj.parents( '.wpc_client_files_tree' ).find('th.wpc_sortable').removeClass('wpc_sort_asc').removeClass('wpc_sort_desc');
            obj.parents( '.wpc_client_files_tree' ).find( '.wpc_cust_sort_' + clsName ).parents('th.wpc_sortable').addClass( 'wpc_sort_desc' );


        } else if( obj.hasClass( 'wpc_sort_desc' ) ) {
            obj.parents( '.wpc_client_files_tree' ).find('th.wpc_sortable').removeClass('wpc_sort_asc').removeClass('wpc_sort_desc');
            obj.parents( '.wpc_client_files_tree' ).find( '.wpc_cust_sort_' + clsName ).parents('th.wpc_sortable').addClass( 'wpc_sort_asc' );


        } else if( !obj.hasClass( 'wpc_sort_desc' ) && !obj.hasClass( 'wpc_sort_asc' ) ) {
            obj.parents( '.wpc_client_files_tree' ).find('th.wpc_sortable').removeClass('wpc_sort_asc').removeClass( 'wpc_sort_desc' );
            obj.addClass( 'wpc_sort_asc' );
        }

        obj.parents( '.wpc_client_files_tree' ).find( '.wpc_ajax_overflow_tree' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_files_shortcode_tree_pagination&shortcode_type=' + shortcode_type + '&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&filters=' + filters + '&search=' + search + '&exclude_author=' + exclude_author + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {

                    obj.parents('.wpc_client_files_tree').find( '.wpc_files_tree_content' ).html( '<table class="wpc_files_tree">' + data.html + '</table><div class="wpc_ajax_overflow_tree"><div class="wpc_ajax_loading"></div></div>' );

                    init_tooltips();
                    init_treetable( false, obj.parents('.wpc_client_files_tree').find( '.wpc_files_tree' ) );

                    obj.parents( '.wpc_client_files_tree' ).find( '.wpc_ajax_overflow_tree' ).hide();
                }
            }
        });

    });


    jQuery( '.wpc_client_files_tree' ).on( 'click', '.wpc_show_file_details', function() {
        var files_form_id = jQuery(this).parents( '.wpc_client_files_tree' ).data( 'form_id' );

        if( jQuery(this).parents( '.wpc_client_files_tree' ).hasClass( 'wpc_fileslu_shortcode' ) ) {
            var php_data = window['wpc_fileslu_pagination' + files_form_id];
        } else if( jQuery(this).parents( '.wpc_client_files_tree' ).hasClass( 'wpc_filesla_shortcode' ) ) {
            var php_data = window['wpc_filesla_pagination' + files_form_id];
        }

        if( jQuery(this).parents('.wpc_filename_block').find( '.wpc_file_details' ).hasClass( 'is_details' ) ) {
            jQuery(this).parents('.wpc_filename_block').find( '.wpc_file_details' ).slideUp();
            jQuery(this).html( php_data.data.texts.show_details );
        } else {
            jQuery(this).parents('.wpc_filename_block').find( '.wpc_file_details' ).slideDown();
            jQuery(this).html( php_data.data.texts.hide_details );
        }
        jQuery(this).parents('.wpc_filename_block').find( '.wpc_file_details' ).toggleClass( 'is_details' );
    });


    /*filters js*/
    jQuery( '.wpc_client_files_tree .wpc_show_filters' ).click( function(e) {
        jQuery( '.wpc_show_filters' ).not( this ).parents( '.wpc_filters_select_wrapper' ).removeClass( 'filtered' );
        jQuery(this).parents( '.wpc_filters_select_wrapper' ).toggleClass( 'filtered' );

        e.stopPropagation();

        jQuery( 'body' ).bind( 'click', function( event ) {
            jQuery( '.wpc_show_filters' ).parents( '.wpc_filters_select_wrapper' ).removeClass( 'filtered' );
            jQuery( 'body' ).unbind( event );
        });
    });

    jQuery( '.wpc_filters_contect' ).click( function(e) {
        e.stopPropagation();
    });

    jQuery( '.wpc_client_files_tree .wpc_filter_by' ).change( function() {
        var obj = jQuery(this);

        if( obj.val() == 'none' ) {
            obj.parents( '.wpc_client_files_tree' ).find( '.wpc_files_filter' ).hide();
            return false;
        }

        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        var files_form_id = obj.parents( '.wpc_client_files_tree' ).data( 'form_id' );
        if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_filesla_shortcode' ) ) {

            var shortcode_type = 'filesla';
            var php_data = window['wpc_filesla_pagination' + files_form_id];
            var exclude_author = php_data.exclude_author;

        }

        if( php_data.client_id ) {
            var client_id = php_data.client_id;
            var _wpnonce = php_data._wpnonce;
        }

        var filters = '';
        if( typeof filter !== 'undefined' && typeof filter[files_form_id] !== 'undefined' && Object.keys(filter[files_form_id]).length > 0 ) {
            filters = jQuery.base64Encode( JSON.stringify( filter[files_form_id] ) );
        }

        var search = obj.parents( '.wpc_client_files_tree' ).find( '.wpc_files_search.wpc_searched' ).val();
        if( typeof search === "undefined") {
            search = '';
        }

        obj.parents('.wpc_filters_contect').find( '.wpc_ajax_content' ).addClass( 'wpc_is_loading' );
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_files_shortcode_get_filter&shortcode_type=' + shortcode_type + '&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&filter_by=' + obj.val() + '&filters=' + filters + '&search=' + search + '&exclude_author=' + exclude_author + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {
                    obj.parents('.wpc_filters_contect').find( '.wpc_ajax_content' ).removeClass( 'wpc_is_loading' );
                    obj.parents( '.wpc_client_files_tree' ).find( '.wpc_filter' ).html( data.filter_html ).show();
                }
            }
        });
    });

    if( jQuery( '.wpc_client_files_tree .wpc_filter_by' ).length > 0 ) {
        jQuery( '.wpc_client_files_tree .wpc_filter_by' ).trigger( 'change' );
    }


    //change filtering reload filestable
    jQuery( '.wpc_client_files_tree .wpc_filters_wrapper' ).change( function() {
        var obj = jQuery(this);

        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        var files_form_id = obj.parents( '.wpc_client_files_tree' ).data( 'form_id' );

        if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_filesla_shortcode' ) ) {

            var shortcode_type = 'filesla';
            var php_data = window['wpc_filesla_pagination' + files_form_id];
            var exclude_author = php_data.exclude_author;

        }

        if( php_data.client_id ) {
            var client_id = php_data.client_id;
            var _wpnonce = php_data._wpnonce;
        }

        var filters = '';
        if( typeof filter !== 'undefined' && typeof filter[files_form_id] !== 'undefined' && Object.keys(filter[files_form_id]).length > 0 ) {
            filters = jQuery.base64Encode( JSON.stringify( filter[files_form_id] ) );
        }

        var search = obj.parents( '.wpc_client_files_tree' ).find( '.wpc_files_search.wpc_searched' ).val();

        if( typeof search === "undefined") {
            search = '';
        }

        var order_by = '';
        var order = '';
        obj.parents( '.wpc_client_files_tree' ).find( '.wpc_client_files th.wpc_sortable' ).each( function(){
            if( jQuery(this).hasClass( 'wpc_sort_desc' ) ) {

                var clsName = jQuery(this).find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');
                order_by = clsName;
                order = 'desc';

            } else if( jQuery(this).hasClass( 'wpc_sort_asc' ) ) {

                var clsName = jQuery(this).find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');
                order_by = clsName;
                order = 'asc';

            }
        });

        obj.parents( '.wpc_client_files_tree' ).find( '.wpc_ajax_overflow_tree' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_files_shortcode_tree_pagination&shortcode_type=' + shortcode_type + '&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&filters=' + filters + '&search=' + search + '&exclude_author=' + exclude_author + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {
                    obj.parents('.wpc_client_files_tree').find( '.wpc_files_tree_content' ).html( '<table class="wpc_files_tree">' + data.html + '</table><div class="wpc_ajax_overflow_tree"><div class="wpc_ajax_loading"></div></div>' );

                    init_tooltips();
                    init_treetable( false, obj.parents('.wpc_client_files_tree').find( '.wpc_files_tree' ) );

                    if( data.filter_html != '' ) {
                        obj.parents( '.wpc_client_files_tree' ).find('.wpc_show_filters').prop('disabled', false);
                        obj.parents( '.wpc_client_files_tree' ).find('.wpc_filter_by').html( data.filter_html ).trigger( 'change' );
                    } else {
                        obj.parents( '.wpc_client_files_tree' ).find('.wpc_show_filters').prop('disabled', true);
                    }

                    obj.parents( '.wpc_client_files_tree' ).find( '.wpc_ajax_overflow_tree' ).hide();
                }
            }
        });
    });


    //add filter
    jQuery( '.wpc_client_files_tree .wpc_add_filter' ).click( function() {

        var obj = jQuery(this);

        var files_form_id = obj.parents( '.wpc_client_files_tree' ).data( 'form_id' );
        var filter_before = filter[files_form_id];

        var filter_by = obj.parents( '.wpc_files_filter_block' ).find('.wpc_filter_by').val();
        var filter_id = obj.parents( '.wpc_files_filter_block' ).find('.wpc_filter').val()

        var in_array = false;

        if( typeof filter_before !== 'undefined' && filter_before.hasOwnProperty( filter_by ) ) {
            jQuery.map( filter_before[filter_by], function( elementOfArray, indexInArray ) {
                if( elementOfArray == filter_id ) {
                    in_array = true;
                }
            });
        }

        if( in_array ) {
            return false;
        }

        if( typeof filter_before === 'undefined' ) {
            filter[files_form_id] = {};
            filter[files_form_id][filter_by] = [];
        }

        if( !filter[files_form_id].hasOwnProperty( filter_by ) ) {
            filter[files_form_id][filter_by] = [];
        }

        filter[files_form_id][filter_by].push( filter_id );

        add_filter( obj.parents( '.wpc_client_files_tree' ), filter_by, filter_id );

        obj.parents( '.wpc_files_filter_block' ).find('.wpc_filters_select_wrapper').removeClass( 'filtered' );

    });


    jQuery( '.wpc_client_files_tree .wpc_files_search_button' ).click( function() {
        var obj = jQuery(this);
        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        var files_form_id = obj.parents( '.wpc_client_files_tree' ).data( 'form_id' );

        if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_filesla_shortcode' ) ) {

            var shortcode_type = 'filesla';
            var php_data = window['wpc_filesla_pagination' + files_form_id];
            var exclude_author = php_data.exclude_author;

        }

        if( php_data.client_id ) {
            var client_id = php_data.client_id;
            var _wpnonce = php_data._wpnonce;
        }

        var filters = '';
        if( typeof filter !== 'undefined' && typeof filter[files_form_id] !== 'undefined' && Object.keys(filter[files_form_id]).length > 0 ) {
            filters = jQuery.base64Encode( JSON.stringify( filter[files_form_id] ) );
        }

        var search = jQuery.trim( obj.parents( '.wpc_client_files_tree' ).find( '.wpc_files_search' ).val() );
        if( search == '' ) {
            return false;
        }

        var order_by = '';
        var order = '';
        obj.parents( '.wpc_client_files_tree' ).find( '.wpc_client_files th.wpc_sortable' ).each( function(){
            if( jQuery(this).hasClass( 'wpc_sort_desc' ) ) {

                var clsName = jQuery(this).find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');
                order_by = clsName;
                order = 'desc';

            } else if( jQuery(this).hasClass( 'wpc_sort_asc' ) ) {

                var clsName = jQuery(this).find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');
                order_by = clsName;
                order = 'asc';

            }
        });

        obj.parents( '.wpc_client_files_tree' ).find( '.wpc_ajax_overflow_tree' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_files_shortcode_tree_pagination&shortcode_type=' + shortcode_type + '&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&filters=' +  filters + '&search=' + search + '&exclude_author=' + exclude_author + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {

                    obj.parents('.wpc_client_files_tree').find( '.wpc_files_tree_content' ).html( '<table class="wpc_files_tree">' + data.html + '</table><div class="wpc_ajax_overflow_tree"><div class="wpc_ajax_loading"></div></div>' );

                    init_tooltips();
                    init_treetable( false, obj.parents('.wpc_client_files_tree').find( '.wpc_files_tree' ) );

                    obj.parents( '.wpc_client_files_tree' ).find( '.wpc_files_search' ).addClass( 'wpc_searched' );
                    obj.parents( '.wpc_client_files_tree' ).find('.wpc_files_clear_search' ).show();

                    if( data.filter_html != '' ) {
                        obj.parents( '.wpc_client_files_tree' ).find('.wpc_show_filters').prop('disabled', false);
                        obj.parents( '.wpc_client_files_tree' ).find('.wpc_filter_by').html( data.filter_html ).trigger( 'change' );
                    } else {
                        obj.parents( '.wpc_client_files_tree' ).find('.wpc_show_filters').prop('disabled', true);
                    }

                    obj.parents( '.wpc_client_files_tree' ).find( '.wpc_ajax_overflow_tree' ).hide();
                }
            }
        });
    });


    jQuery( '.wpc_client_files_tree .wpc_files_search' ).keyup( function(event) {
        if( event.keyCode == 13 ) {
            jQuery(this).parents( '.wpc_client_files_tree' ).find( '.wpc_files_search_button' ).trigger( 'click' );
            event.stopPropagation();
        }
    });


    jQuery( '.wpc_client_files_tree .wpc_client_files_form' ).submit( function(event) {
        return false;
    });


    jQuery( '.wpc_client_files_tree .wpc_files_clear_search' ).click( function() {
        var obj = jQuery(this);

        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        var files_form_id = obj.parents( '.wpc_client_files_tree' ).data( 'form_id' );

        if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.parents( '.wpc_client_files_tree' ).hasClass( 'wpc_filesla_shortcode' ) ) {

            var shortcode_type = 'filesla';
            var php_data = window['wpc_filesla_pagination' + files_form_id];
            var exclude_author = php_data.exclude_author;

        }

        if( php_data.client_id ) {
            var client_id = php_data.client_id;
            var _wpnonce = php_data._wpnonce;
        }


        var filters = '';
        if( typeof filter !== 'undefined' && typeof filter[files_form_id] !== 'undefined' && Object.keys(filter[files_form_id]).length > 0 ) {
            filters = jQuery.base64Encode( JSON.stringify( filter[files_form_id] ) );
        }

        var search = '';

        var order_by = '';
        var order = '';
        obj.parents( '.wpc_client_files_tree' ).find( '.wpc_client_files th.wpc_sortable' ).each( function(){
            if( jQuery(this).hasClass( 'wpc_sort_desc' ) ) {

                var clsName = jQuery(this).find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');
                order_by = clsName;
                order = 'desc';

            } else if( jQuery(this).hasClass( 'wpc_sort_asc' ) ) {

                var clsName = jQuery(this).find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');
                order_by = clsName;
                order = 'asc';

            }
        });

        obj.parents( '.wpc_client_files_tree' ).find( '.wpc_ajax_overflow_tree' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_files_shortcode_tree_pagination&shortcode_type=' + shortcode_type + '&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&filters=' + filters + '&search=' + search + '&exclude_author=' + exclude_author + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {

                    obj.parents('.wpc_client_files_tree').find( '.wpc_files_tree_content' ).html( '<table class="wpc_files_tree">' + data.html + '</table><div class="wpc_ajax_overflow_tree"><div class="wpc_ajax_loading"></div></div>' );

                    init_tooltips();
                    init_treetable( false, obj.parents('.wpc_client_files_tree').find( '.wpc_files_tree' ) );

                    obj.parents( '.wpc_client_files_tree' ).find( '.wpc_files_search' ).removeClass( 'wpc_searched' ).val('');
                    obj.parents( '.wpc_client_files_tree' ).find( '.wpc_files_clear_search' ).hide();

                    if( data.filter_html != '' ) {
                        obj.parents( '.wpc_client_files_tree' ).find('.wpc_show_filters').prop('disabled', false);
                        obj.parents( '.wpc_client_files_tree' ).find('.wpc_filter_by').html( data.filter_html ).trigger( 'change' );
                    } else {
                        obj.parents( '.wpc_client_files_tree' ).find('.wpc_show_filters').prop('disabled', true);
                    }

                    obj.parents( '.wpc_client_files_tree' ).find( '.wpc_ajax_overflow_tree' ).hide();
                }
            }
        });
    });

    function init_treetable( with_loader, shortcode ) {
        if( with_loader ) {
            shortcode.treetable({
                expandable: true,
                onInitialized: function() {
                    shortcode.parents( '.wpc_client_files_tree' ).find( '.wpc_ajax_overflow_tree' ).hide();
                    shortcode.parents( '.wpc_client_files_tree' ).find( '.wpc_files_tree' ).show();
                }
            });
        } else {
            shortcode.treetable({
                expandable: true,
                onInitialized: function() {
                    shortcode.parents( '.wpc_client_files_tree' ).find( '.wpc_files_tree' ).show();
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

            if( shortcode.height() < 200 ) {
                jQuery( this ).append( '<td class="wpc_scroll_column"></td>' );
            }
        });
    }

    function init_tooltips() {
        jQuery( '.wpc_img_file_icon' ).tooltip({
            items: "[wpc_images]",
            content: function() {
                var element = jQuery( this );
                if( element.is( "[wpc_images]" ) ) {
                    var text = element.attr( 'wpc_images' );
                    return "<img alt='" + text + "' src='" + text + "' style='width:100%;'>";
                }
            },
            show: null, // show immediately
            open: function( event, ui ) {
                if( typeof( event.originalEvent ) === 'undefined') {
                    return false;
                }

                var $id = jQuery( ui.tooltip ).attr( 'id' );

                // close any lingering tooltips
                jQuery( 'div.ui-tooltip' ).not( '#' + $id ).remove();
                // ajax function to pull in data and add it to the tooltip goes here
            },
            close: function( event, ui ) {
                ui.tooltip.hover( function() {
                    jQuery( this ).stop( true ).fadeTo( 400, 1 );
                },
                function() {
                    jQuery( this ).fadeOut( '400', function() {
                        jQuery(this).remove();
                    });
                });
            }
        });
    }


    function add_filter( table, filter_by, filter_id ) {

        var files_form_id = table.data( 'form_id' );

        if( table.hasClass( 'wpc_fileslu_shortcode' ) ) {
            var php_data = window['wpc_fileslu_pagination' + files_form_id];
        } else if( table.hasClass( 'wpc_filesla_shortcode' ) ) {
            var php_data = window['wpc_filesla_pagination' + files_form_id];
        }

        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_get_filter_data&filter_by=' + filter_by + '&filter_id=' + filter_id,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {
                    table.find( '.wpc_filters_wrapper' ).append(
                        '<div class="wpc_filter_wrapper" data-filter_by="' + filter_by + '" data-filter_id="' + filter_id + '">' +
                            data.title + ': ' + data.name +
                            '<div class="wpc_remove_filter">&times;</div>' +
                        '</div>'
                    ).trigger( 'change' );
                }
            }
        });

    }


    //remove filters
    jQuery( '.wpc_client_files_tree' ).on( 'click', '.wpc_remove_filter', function() {
        var obj = jQuery(this);

        var files_form_id = obj.parents( '.wpc_client_files_tree' ).data( 'form_id' );
        var filter_before = filter[files_form_id];

        var filter_by = obj.parents( '.wpc_filter_wrapper' ).data('filter_by');
        var filter_id = obj.parents( '.wpc_filter_wrapper' ).data('filter_id');

        var index = filter_before[filter_by].indexOf( filter_id.toString() );
        if( index > -1 ) {
            filter[files_form_id][filter_by].splice( index, 1 );
        }

        obj.parents( '.wpc_filters_wrapper' ).trigger( 'change' );
        obj.parents( '.wpc_filter_wrapper' ).remove();
    });


    //add filter from tag
    jQuery( '.wpc_client_files_tree' ).on( 'click', '.wpc_tag', function() {
        var obj = jQuery(this);

        if( !obj.parents( '.wpc_client_files_tree' ).find( '.wpc_show_filters' ).prop('disabled') ) {

            var files_form_id = obj.parents( '.wpc_client_files_tree' ).data( 'form_id' );
            var filter_before = filter[files_form_id];

            var filter_by = 'tags';
            var filter_id = obj.data('term_id').toString();

            var in_array = false;

            if( typeof filter_before !== 'undefined' && filter_before.hasOwnProperty( filter_by ) ) {
                jQuery.map( filter_before[filter_by], function( elementOfArray, indexInArray ) {
                    if( elementOfArray == filter_id ) {
                        in_array = true;
                    }
                });
            }

            if( in_array ) {
                return false;
            }

            if( typeof filter_before === 'undefined' ) {
                filter[files_form_id] = {};
                filter[files_form_id][filter_by] = [];
            }

            if( !filter[files_form_id].hasOwnProperty( filter_by ) ) {
                filter[files_form_id][filter_by] = [];
            }

            filter[files_form_id][filter_by].push( filter_id );

            add_filter( obj.parents( '.wpc_client_files_tree' ), filter_by, filter_id );

        }
    });


    //add filter from author
    jQuery( '.wpc_client_files_tree' ).on( 'click', '.wpc_file_author_value', function() {
        var obj = jQuery(this);

        if( !obj.parents( '.wpc_client_files_tree' ).find( '.wpc_show_filters' ).prop('disabled') ) {

            var files_form_id = obj.parents( '.wpc_client_files_tree' ).data( 'form_id' );
            var filter_before = filter[files_form_id];

            var filter_by = 'author';
            var filter_id = obj.data('author_id').toString();

            if( filter_id == '' ) {
                return false;
            }

            var in_array = false;

            if( typeof filter_before !== 'undefined' && filter_before.hasOwnProperty( filter_by ) ) {
                jQuery.map( filter_before[filter_by], function( elementOfArray, indexInArray ) {
                    if( elementOfArray == filter_id ) {
                        in_array = true;
                    }
                });
            }

            if( in_array ) {
                return false;
            }

            if( typeof filter_before === 'undefined' ) {
                filter[files_form_id] = {};
                filter[files_form_id][filter_by] = [];
            }

            if( !filter[files_form_id].hasOwnProperty( filter_by ) ) {
                filter[files_form_id][filter_by] = [];
            }

            filter[files_form_id][filter_by].push( filter_id );

            add_filter( obj.parents( '.wpc_client_files_tree' ), filter_by, filter_id );

        }
    });

});
