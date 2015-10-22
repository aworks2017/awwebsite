var filter = new Object();
var submit_marker = false;
jQuery(document).ready(function() {

    init_tooltips();

    /*bulk actions js*/
    jQuery( '.wpc_client_files_table' ).on( 'click', '.bulk_ids', function() {
        if( jQuery(this).parents( '.wpc_client_files_table' ).find( '.bulk_ids:checked' ).length == jQuery(this).parents( '.wpc_client_files_table' ).find( '.bulk_ids' ).length ) {
            jQuery(this).parents( '.wpc_client_files_table' ).find( '.bulk_ids_all' ).prop( 'checked', true );
        } else {
            jQuery(this).parents( '.wpc_client_files_table' ).find( '.bulk_ids_all' ).prop( 'checked', false );
        }
    });


    jQuery( '.wpc_client_files_table' ).on( 'click', '.bulk_ids_all', function() {
        if( jQuery(this).is(':checked') ) {
            jQuery(this).parents( '.wpc_client_files_table' ).find( '.bulk_ids' ).prop( 'checked', true );
            jQuery(this).parents( '.wpc_client_files_table' ).find( '.bulk_ids_all' ).prop( 'checked', true );
        } else {
            jQuery(this).parents( '.wpc_client_files_table' ).find( '.bulk_ids' ).prop( 'checked', false );
            jQuery(this).parents( '.wpc_client_files_table' ).find( '.bulk_ids_all' ).prop( 'checked', false );
        }
    });


    jQuery( '.wpc_client_files_table' ).on( 'click', '.wpc_files_bulk_actions_apply_button', function() {
        if( jQuery(this).siblings( '.wpc_files_bulk_action' ).val() == 'none' ) {
            return false;
        }
        if( jQuery(this).siblings( '.wpc_files_bulk_action' ).val() != 'none' &&
            jQuery(this).parents( '.wpc_client_files_table' ).find( '.bulk_ids:checked' ).length == 0 ) {
            return false;
        }

        jQuery(this).parents( '.wpc_client_files_table' ).find( '.wpc_files_bulk_action' ).val( jQuery(this).siblings( '.wpc_files_bulk_action' ).val() );

        submit_marker = true;
        jQuery(this).parents( '.wpc_client_files_table' ).find( '.wpc_client_files_form' ).submit();
        submit_marker = false;
    });


    /*filters js*/
    jQuery( '.wpc_client_files_table .wpc_show_filters' ).click( function(e) {
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

    jQuery( '.wpc_client_files_table .wpc_filter_by' ).change( function() {
        var obj = jQuery(this);

        if( obj.val() == 'none' ) {
            obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_filter' ).hide();
            return false;
        }

        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        var files_form_id = obj.parents( '.wpc_client_files_table' ).data( 'form_id' );
        if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_filesla_shortcode' ) ) {

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

        var search = obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_search.wpc_searched' ).val();
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
                    obj.parents( '.wpc_client_files_table' ).find( '.wpc_filter' ).html( data.filter_html ).show();
                }
            }
        });
    });

    if( jQuery( '.wpc_client_files_table .wpc_filter_by' ).length > 0 ) {
        jQuery( '.wpc_client_files_table .wpc_filter_by' ).trigger( 'change' );
    }



    //change filtering reload filestable
    jQuery( '.wpc_client_files_table .wpc_filters_wrapper' ).change( function() {
        var obj = jQuery(this);

        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        var files_form_id = obj.parents( '.wpc_client_files_table' ).data( 'form_id' );

        if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_filesla_shortcode' ) ) {

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

        var search = obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_search.wpc_searched' ).val();

        if( typeof search === "undefined") {
            search = '';
        }

        var order_by = '';
        var order = '';
        obj.parents( '.wpc_client_files_table' ).find( '.wpc_client_files th.wpc_sortable' ).each( function(){
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

        obj.parents( '.wpc_client_files_table' ).find( '.wpc_ajax_overflow_table' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_files_shortcode_table_pagination&shortcode_type=' + shortcode_type + '&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&filters=' + filters + '&search=' + search + '&exclude_author=' + exclude_author + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {

                    obj.parents( '.wpc_client_files_table' ).find( 'tbody' ).html( data.html );
                    obj.parents( '.wpc_client_files_table' ).find( '.wpc_ajax_overflow_table' ).hide();

                    if( data.filter_html != '' ) {
                        obj.parents( '.wpc_client_files_table' ).find('.wpc_show_filters').prop('disabled', false);
                        obj.parents( '.wpc_client_files_table' ).find('.wpc_filter_by').html( data.filter_html ).trigger( 'change' );
                    } else {
                        obj.parents( '.wpc_client_files_table' ).find('.wpc_show_filters').prop('disabled', true);
                    }

                    if( php_data.data.show_pagination ) {
                        var pagination_html = '';

                        pagination_html += '<span class="wpc_files_counter">' + data.pagination.files_count + '</span>'
                        if( data.pagination.count_pages > 1 ) {
                            pagination_html +='<a href="javascript:void(0);" class="wpc_pagination_links wpc_first" style="display:none;"> << </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_previous" style="display:none;"> < </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_previous_pages" style="display:none;"> ... </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_active_page"> 1 </a>';
                            if( data.pagination.count_pages <= 3 ) {
                                for( var i = 2; i <= data.pagination.count_pages; i++ ) {
                                    pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links"> ' + i + ' </a>';
                                }
                            } else if ( data.pagination.count_pages > 3 ) {
                                for( var i = 2; i <= 3; i++ ) {
                                    pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links"> ' + i + ' </a>';
                                }
                                for( var i = 4; i <= data.pagination.count_pages; i++ ) {
                                    pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links" style="display:none;"> ' + i + ' </a>';
                                }
                                pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links wpc_next_pages"> ... </a>';
                            }
                            pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links wpc_next"> > </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_last"> >> </a>';
                        }

                        obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_pagination' ).html( pagination_html );
                        php_data.count_pages = data.pagination.count_pages;
                    }

                    init_tooltips();
                }
            }
        });
    });


    //add filter
    jQuery( '.wpc_client_files_table .wpc_add_filter' ).click( function() {

        var obj = jQuery(this);

        var files_form_id = obj.parents( '.wpc_client_files_table' ).data( 'form_id' );
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

        add_filter( obj.parents( '.wpc_client_files_table' ), filter_by, filter_id );

        obj.parents( '.wpc_files_filter_block' ).find('.wpc_filters_select_wrapper').removeClass( 'filtered' );

    });






    jQuery( '.wpc_client_files_table .wpc_client_files th.wpc_sortable' ).on( 'click', function() {
        var obj = jQuery(this);
        var clsName = obj.find( '.wpc_cust_file_sort' ).attr('class').match(/\w*wpc_cust_sort_\w*/)[0].replace('wpc_cust_sort_','');


        var page_number = obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_active_page' ).html();
        if( typeof page_number === 'undefined' ) {
            page_number = '1';
        }

        var search = obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_search.wpc_searched' ).val();

        if( typeof search === "undefined") {
            search = '';
        }

        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        var files_form_id = obj.parents( '.wpc_client_files_table' ).data( 'form_id' );

        if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_filesla_shortcode' ) ) {

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

        obj.parents( '.wpc_client_files_table' ).find( '.wpc_ajax_overflow_table' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_files_shortcode_table_pagination&shortcode_type=' + shortcode_type + '&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&filters=' + filters + '&search=' + search + '&current_page=' + page_number + '&exclude_author=' + exclude_author + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {

                    obj.parents( '.wpc_client_files_table' ).find( 'tbody' ).html( data.html );
                    obj.parents( '.wpc_client_files_table' ).find( '.wpc_ajax_overflow_table' ).hide();

                    if( obj.hasClass( 'wpc_sort_asc' ) ) {
                        obj.parents( '.wpc_client_files' ).find('th.wpc_sortable').removeClass('wpc_sort_asc').removeClass('wpc_sort_desc');
                        obj.parents( '.wpc_client_files' ).find( '.wpc_cust_sort_' + clsName ).parents('th.wpc_sortable').addClass( 'wpc_sort_desc' );


                    } else if( obj.hasClass( 'wpc_sort_desc' ) ) {
                        obj.parents( '.wpc_client_files' ).find('th.wpc_sortable').removeClass('wpc_sort_asc').removeClass('wpc_sort_desc');
                        obj.parents( '.wpc_client_files' ).find( '.wpc_cust_sort_' + clsName ).parents('th.wpc_sortable').addClass( 'wpc_sort_asc' );


                    } else if( !obj.hasClass( 'wpc_sort_desc' ) && !obj.hasClass( 'wpc_sort_asc' ) ) {
                        obj.parents( '.wpc_client_files' ).find('th.wpc_sortable').removeClass('wpc_sort_asc').removeClass('wpc_sort_desc');
                        obj.addClass( 'wpc_sort_asc' );
                    }

                    init_tooltips();
                }
            }
        });

    });


    jQuery( '.wpc_client_files_table .wpc_files_search_button' ).click( function() {
        var obj = jQuery(this);

        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        var files_form_id = obj.parents( '.wpc_client_files_table' ).data( 'form_id' );

        if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_filesla_shortcode' ) ) {

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

        var search = jQuery.trim( obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_search' ).val() );
        if( search == '' ) {
            return false;
        }

        var order_by = '';
        var order = '';
        obj.parents( '.wpc_client_files_table' ).find( '.wpc_client_files th.wpc_sortable' ).each( function(){
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

        obj.parents( '.wpc_client_files_table' ).find( '.wpc_ajax_overflow_table' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_files_shortcode_table_pagination&shortcode_type=' + shortcode_type + '&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&filters=' +  filters + '&search=' + search + '&exclude_author=' + exclude_author + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {

                    obj.parents( '.wpc_client_files_table' ).find( 'tbody' ).html( data.html );
                    obj.parents( '.wpc_client_files_table' ).find( '.wpc_ajax_overflow_table' ).hide();

                    obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_search' ).addClass( 'wpc_searched' );
                    obj.parents( '.wpc_client_files_table' ).find('.wpc_files_clear_search' ).show();

                    if( data.filter_html != '' ) {
                        obj.parents( '.wpc_client_files_table' ).find('.wpc_show_filters').prop('disabled', false);
                        obj.parents( '.wpc_client_files_table' ).find('.wpc_filter_by').html( data.filter_html ).trigger( 'change' );
                    } else {
                        obj.parents( '.wpc_client_files_table' ).find('.wpc_show_filters').prop('disabled', true);
                    }

                    if( php_data.data.show_pagination ) {
                        var pagination_html = '';

                        pagination_html += '<span class="wpc_files_counter">' + data.pagination.files_count + '</span>'
                        if( data.pagination.count_pages > 1 ) {
                            pagination_html +='<a href="javascript:void(0);" class="wpc_pagination_links wpc_first" style="display:none;"> << </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_previous" style="display:none;"> < </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_previous_pages" style="display:none;"> ... </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_active_page"> 1 </a>';
                            if( data.pagination.count_pages <= 3 ) {
                                for( var i = 2; i <= data.pagination.count_pages; i++ ) {
                                    pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links"> ' + i + ' </a>';
                                }
                            } else if ( data.pagination.count_pages > 3 ) {
                                for( var i = 2; i <= 3; i++ ) {
                                    pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links"> ' + i + ' </a>';
                                }
                                for( var i = 4; i <= data.pagination.count_pages; i++ ) {
                                    pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links" style="display:none;"> ' + i + ' </a>';
                                }
                                pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links wpc_next_pages"> ... </a>';
                            }
                            pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links wpc_next"> > </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_last"> >> </a>';
                        }

                        obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_pagination' ).html( pagination_html );
                        php_data.count_pages = data.pagination.count_pages;
                    }

                    //obj.parents( '.wpc_client_files_table' ).find('th.wpc_sortable').removeClass('wpc_sort_asc').removeClass('wpc_sort_desc');

                    init_tooltips();
                }
            }
        });
    });

    jQuery( '.wpc_client_files_table .wpc_files_search' ).keyup( function(event) {
        if( event.keyCode == 13 ) {
            jQuery(this).parents( '.wpc_client_files_table' ).find( '.wpc_files_search_button' ).trigger( 'click' );
            event.stopPropagation();
        }
    });

    jQuery( '.wpc_client_files_table .wpc_client_files_form' ).submit( function(event) {
        if( !submit_marker ) {
            return false;
        }
    });


    jQuery( '.wpc_client_files_table .wpc_files_clear_search' ).click( function() {
        var obj = jQuery(this);

        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        var files_form_id = obj.parents( '.wpc_client_files_table' ).data( 'form_id' );

        if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_filesla_shortcode' ) ) {

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
        obj.parents( '.wpc_client_files_table' ).find( '.wpc_client_files th.wpc_sortable' ).each( function(){
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

        obj.parents( '.wpc_client_files_table' ).find( '.wpc_ajax_overflow_table' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_files_shortcode_table_pagination&shortcode_type=' + shortcode_type + '&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&filters=' + filters + '&search=' + search + '&exclude_author=' + exclude_author + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {

                    obj.parents( '.wpc_client_files_table' ).find( 'tbody' ).html( data.html );
                    obj.parents( '.wpc_client_files_table' ).find( '.wpc_ajax_overflow_table' ).hide();

                    obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_search' ).removeClass( 'wpc_searched' ).val('');
                    obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_clear_search' ).hide();

                    if( data.filter_html != '' ) {
                        obj.parents( '.wpc_client_files_table' ).find('.wpc_show_filters').prop('disabled', false);
                        obj.parents( '.wpc_client_files_table' ).find('.wpc_filter_by').html( data.filter_html ).trigger( 'change' );
                    } else {
                        obj.parents( '.wpc_client_files_table' ).find('.wpc_show_filters').prop('disabled', true);
                    }

                    /*obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_filter' ).html( '' ).hide();
                    obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_filter_by' ).val( 'none' );
                    */
                    if( php_data.data.show_pagination ) {
                        var pagination_html = '';

                        pagination_html += '<span class="wpc_files_counter">' + data.pagination.files_count + '</span>'
                        if( data.pagination.count_pages > 1 ) {
                            pagination_html +='<a href="javascript:void(0);" class="wpc_pagination_links wpc_first" style="display:none;"> << </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_previous" style="display:none;"> < </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_previous_pages" style="display:none;"> ... </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_active_page"> 1 </a>';
                            if( data.pagination.count_pages <= 3 ) {
                                for( var i = 2; i <= data.pagination.count_pages; i++ ) {
                                    pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links"> ' + i + ' </a>';
                                }
                            } else if ( data.pagination.count_pages > 3 ) {
                                for( var i = 2; i <= 3; i++ ) {
                                    pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links"> ' + i + ' </a>';
                                }
                                for( var i = 4; i <= data.pagination.count_pages; i++ ) {
                                    pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links" style="display:none;"> ' + i + ' </a>';
                                }
                                pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links wpc_next_pages"> ... </a>';
                            }
                            pagination_html += '<a href="javascript:void(0);" class="wpc_pagination_links wpc_next"> > </a>' +
                            '<a href="javascript:void(0);" class="wpc_pagination_links wpc_last"> >> </a>';
                        }

                        obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_pagination' ).html( pagination_html );
                        php_data.count_pages = data.pagination.count_pages;
                    }

                    /*if( obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_filter_block' ).length > 0 ) {
                        obj.parents( '.wpc_client_files_table' ).find('.wpc_files_filter_block').show();
                    }*/
                    //obj.parents( '.wpc_client_files_table' ).find( 'th.wpc_sortable' ).removeClass('wpc_sort_asc').removeClass('wpc_sort_desc');

                    init_tooltips();
                }
            }
        });
    });


    jQuery( '.wpc_client_files_table' ).on( 'click', 'a.wpc_pagination_links', function() {
        var obj = jQuery(this);
        var page_number = '';

        if( obj.hasClass( 'wpc_active_page' ) ) {
            return false;
        }

        var exclude_author = '';
        var client_id  = 0;
        var _wpnonce = '';

        var files_form_id = obj.parents( '.wpc_client_files_table' ).data( 'form_id' );

        if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_fileslu_shortcode' ) ) {

            var shortcode_type = 'fileslu';
            var php_data = window['wpc_fileslu_pagination' + files_form_id];

        } else if( obj.parents( '.wpc_client_files_table' ).hasClass( 'wpc_filesla_shortcode' ) ) {

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

        var search = obj.parents( '.wpc_client_files_table' ).find( '.wpc_files_search.wpc_searched' ).val();
        if( typeof search === "undefined") {
            search = '';
        }

        var order_by = '';
        var order = '';
        obj.parents( '.wpc_client_files_table' ).find( '.wpc_client_files th.wpc_sortable' ).each( function(){
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


        if( obj.hasClass( 'wpc_last' ) ) {
            page_number = php_data.count_pages;
        } else if( obj.hasClass( 'wpc_first' ) ) {
            page_number = 1;
        } else if( obj.hasClass( 'wpc_next' ) ) {
            page_number = obj.siblings('.wpc_active_page').html()*1 + 1;
        } else if( obj.hasClass( 'wpc_previous' ) ) {
            page_number = obj.siblings('.wpc_active_page').html()*1 - 1;
        } else if( obj.hasClass( 'wpc_next_pages' ) )  {
            page_number = ( Math.floor( ( obj.siblings('.wpc_active_page').html()*1 - 1 ) / 3 ) + 1 )*3 + 1;
        } else if( obj.hasClass( 'wpc_previous_pages' ) ) {
            page_number = ( Math.floor( ( obj.siblings('.wpc_active_page').html()*1 - 1 ) / 3 ) )*3;
        } else {
            page_number = obj.html()*1;
        }


        obj.parents( '.wpc_client_files_table' ).find( '.wpc_ajax_overflow_table' ).show();
        jQuery.ajax({
            type: 'POST',
            url: php_data.ajax_url,
            data: 'action=wpc_files_shortcode_table_pagination&shortcode_type=' + shortcode_type + '&shortcode_data=' + jQuery.base64Encode( JSON.stringify( php_data.data ) ) + '&filters=' + filters + '&search=' + search + '&current_page=' + page_number + '&exclude_author=' + exclude_author + '&order_by=' + order_by + '&order=' + order + '&client_id=' + client_id + '&security=' + _wpnonce,
            dataType: "json",
            success: function( data ){
                if( !data.status ) {
                    alert( data.message );
                } else {

                    obj.parents( '.wpc_client_files_table' ).find( 'tbody' ).html( data.html );
                    obj.parents( '.wpc_client_files_table' ).find( '.wpc_ajax_overflow_table' ).hide();

                    if( obj.hasClass( 'wpc_last' ) ) {

                        obj.parents( '.wpc_client_files_table' ).find('.wpc_last').hide();
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next_pages' ).hide();
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next' ).hide();

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).removeClass( 'wpc_active_page' );
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next_pages' ).prev().addClass( 'wpc_active_page' ).show();

                        if( page_number*1 > 3 ) {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous_pages' ).show();
                        }
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous' ).show();
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_first' ).show();

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).each( function() {
                            if( jQuery(this).html()*1 > ( Math.floor( ( page_number*1 - 1 ) / 3 ) )*3 && jQuery(this).html()*1 < ( Math.floor( ( page_number*1 - 1 ) / 3 ) + 1 )*3 + 1 ) {
                                jQuery(this).show();
                            } else if( jQuery.isNumeric( jQuery(this).html() ) ) {
                                jQuery(this).hide();
                            }
                        });

                    } else if( obj.hasClass( 'wpc_first' ) ) {

                        obj.parents( '.wpc_client_files_table' ).find('.wpc_first').hide();
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous_pages' ).hide();
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous' ).hide();

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).removeClass( 'wpc_active_page' );
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous_pages' ).next().addClass( 'wpc_active_page' ).show();

                        if( page_number*1 < ( ( Math.ceil( php_data.count_pages/3 ) - 1)*3 + 1 ) ) {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next_pages' ).show();
                        }
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next' ).show();
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_last' ).show();

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).each( function() {
                            if( jQuery(this).html()*1 > ( Math.floor( ( page_number*1 - 1 ) / 3 ) )*3 && jQuery(this).html()*1 < ( Math.floor( ( page_number*1 - 1 ) / 3 ) + 1 )*3 + 1 ) {
                                jQuery(this).show();
                            } else if( jQuery.isNumeric( jQuery(this).html() ) ) {
                                jQuery(this).hide();
                            }
                        });

                    } else if( obj.hasClass( 'wpc_next' ) ) {

                        var before_active = obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_active_page' );
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).removeClass( 'wpc_active_page' );
                        before_active.next().addClass( 'wpc_active_page' ).show();

                        if( page_number*1 > 1 ) {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous' ).show();
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_first' ).show();
                        }

                        if( page_number*1 > 3 ) {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous_pages' ).show();
                        }

                        if( page_number*1 == php_data.count_pages*1 ) {
                            obj.parents( '.wpc_client_files_table' ).find( '.wpc_next' ).hide();
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next_pages' ).hide();
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_last' ).hide();
                        }

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).each( function() {
                            if( jQuery(this).html()*1 > ( Math.floor( ( page_number*1 - 1 ) / 3 ) )*3 && jQuery(this).html()*1 < ( Math.floor( ( page_number*1 - 1 ) / 3 ) + 1 )*3 + 1 ) {
                                jQuery(this).show();
                            } else if( jQuery.isNumeric( jQuery(this).html() ) ) {
                                jQuery(this).hide();
                            }
                        });

                        if( ( Math.floor( ( page_number*1 - 1 ) / 3 ) + 1 )*3 + 1 > php_data.count_pages ) {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next_pages' ).hide();
                        }

                    } else if( obj.hasClass( 'wpc_previous' ) ) {

                        var before_active = obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_active_page' );
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).removeClass( 'wpc_active_page' );
                        before_active.prev().addClass( 'wpc_active_page' ).show();

                        if( page_number*1 < php_data.count_pages*1 ) {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next' ).show();
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_last' ).show();
                        }

                        if( page_number*1 < ( ( Math.ceil( php_data.count_pages/3 ) - 1)*3 + 1 ) ) {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next_pages' ).show();
                        }

                        if( page_number*1 == 1 ) {
                            obj.parents( '.wpc_client_files_table' ).find( '.wpc_previous' ).hide();
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous_pages' ).hide();
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_first' ).hide();
                        }

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).each( function() {
                            if( jQuery(this).html()*1 > ( Math.floor( ( page_number*1 - 1 ) / 3 ) )*3 && jQuery(this).html()*1 < ( Math.floor( ( page_number*1 - 1 ) / 3 ) + 1 )*3 + 1 ) {
                                jQuery(this).show();
                            } else if( jQuery.isNumeric( jQuery(this).html() ) ) {
                                jQuery(this).hide();
                            }
                        });

                        if( Math.floor( ( page_number*1 - 1 ) / 3 ) == 0 ) {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous_pages' ).hide();
                        }

                    } else if( obj.hasClass( 'wpc_next_pages' ) )  {

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).removeClass( 'wpc_active_page' );

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous_pages' ).show();
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous' ).show();
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_first' ).show();

                        if( ( Math.floor( ( page_number*1 - 1 ) / 3 ) + 1 )*3 + 1 > php_data.count_pages ) {
                            obj.parents( '.wpc_client_files_table' ).find( '.wpc_next_pages' ).hide();
                        }

                        if( page_number*1 == php_data.count_pages ) {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next' ).hide();
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_last' ).hide();
                        }

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).each( function() {
                            if( jQuery(this).html()*1 > ( Math.floor( ( page_number*1 - 1 ) / 3 ) )*3 && jQuery(this).html()*1 < ( Math.floor( ( page_number*1 - 1 ) / 3 ) + 1 )*3 + 1 ) {
                                jQuery(this).show();
                            } else if( jQuery.isNumeric( jQuery(this).html() ) ) {
                                jQuery(this).hide();
                            }

                            if( jQuery(this).html()*1 == page_number*1 ) {
                                jQuery(this).addClass( 'wpc_active_page' );
                            }
                        });

                    } else if( obj.hasClass( 'wpc_previous_pages' ) ) {
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).removeClass( 'wpc_active_page' );

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next_pages' ).show();
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next' ).show();
                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_last' ).show();

                        if( Math.floor( ( page_number*1 - 1 ) / 3 ) == 0 ) {
                            obj.parents( '.wpc_client_files_table' ).find('.wpc_previous_pages').hide();
                        }

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).each( function() {
                            if( jQuery(this).html()*1 > ( Math.floor( ( page_number*1 - 1 ) / 3 ) )*3 && jQuery(this).html()*1 < ( Math.floor( ( page_number*1 - 1 ) / 3 ) + 1 )*3 + 1 ) {
                                jQuery(this).show();
                            } else if( jQuery.isNumeric( jQuery(this).html() ) ) {
                                jQuery(this).hide();
                            }

                            if( jQuery(this).html()*1 == page_number*1 ) {
                                jQuery(this).addClass( 'wpc_active_page' );
                            }
                        });

                    } else {

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).removeClass( 'wpc_active_page' );

                        obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links' ).each( function() {
                            if( obj.html() == jQuery(this).html() ) {
                                jQuery(this).addClass( 'wpc_active_page' );
                            }
                        });

                        if( page_number*1 < php_data.count_pages*1 ) {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next' ).show();
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_last' ).show();
                        } else {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_next' ).hide();
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_last' ).hide();
                        }

                        if( page_number*1 > 1 ) {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous' ).show();
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_first' ).show();
                        } else {
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_previous' ).hide();
                            obj.parents( '.wpc_client_files_table' ).find( 'a.wpc_pagination_links.wpc_first' ).hide();
                        }
                    }

                    init_tooltips();
                }
            }
        });

    });


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
    jQuery( '.wpc_client_files_table' ).on( 'click', '.wpc_remove_filter', function() {
        var obj = jQuery(this);

        var files_form_id = obj.parents( '.wpc_client_files_table' ).data( 'form_id' );
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
    jQuery( '.wpc_client_files_table' ).on( 'click', '.wpc_tag', function() {
        var obj = jQuery(this);

        if( !obj.parents( '.wpc_client_files_table' ).find( '.wpc_show_filters' ).prop('disabled') ) {

            var files_form_id = obj.parents( '.wpc_client_files_table' ).data( 'form_id' );
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

            add_filter( obj.parents( '.wpc_client_files_table' ), filter_by, filter_id );

        }
    });


    //add filter from category
    jQuery( '.wpc_client_files_table' ).on( 'click', '.wpc_file_category_value', function() {
        var obj = jQuery(this);

        if( !obj.parents( '.wpc_client_files_table' ).find( '.wpc_show_filters' ).prop('disabled') ) {

            var files_form_id = obj.parents( '.wpc_client_files_table' ).data( 'form_id' );
            var filter_before = filter[files_form_id];

            var filter_by = 'category';
            var filter_id = obj.data('category_id').toString();

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

            add_filter( obj.parents( '.wpc_client_files_table' ), filter_by, filter_id );

        }
    });


    //add filter from author
    jQuery( '.wpc_client_files_table' ).on( 'click', '.wpc_file_author_value', function() {
        var obj = jQuery(this);

        if( !obj.parents( '.wpc_client_files_table' ).find( '.wpc_show_filters' ).prop('disabled') ) {

            var files_form_id = obj.parents( '.wpc_client_files_table' ).data( 'form_id' );
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

            add_filter( obj.parents( '.wpc_client_files_table' ), filter_by, filter_id );

        }
    });

});