  jQuery( document ).ready( function() {
        var wpc_offset = ( typeof wpc_shortcode_messages_atts != 'undefined' && typeof wpc_shortcode_messages_atts.show_number != 'undefined' ) ?  wpc_shortcode_messages_atts.show_number : 10;

        var wpc_show_more = ( typeof wpc_shortcode_messages_atts != 'undefined' && typeof wpc_shortcode_messages_atts.show_more_number != 'undefined' ) ?  wpc_shortcode_messages_atts.show_more_number : 10;


        var wpc_no_messages = ( typeof wpc_comments_translate != 'undefined' && typeof wpc_comments_translate.no_messages != 'undefined' ) ?  wpc_comments_translate.no_messages : '';



        jQuery( '.wpc_ajax_time_filter' ).click( function() {
            jQuery( 'body' ).css( 'cursor', 'wait' );

            var data            = jQuery( '#wpc_show_more_params' ).val();
            var data            = data.split(',');

            var site_url        = data[0];
            var user_id         = data[1];
            var code            = data[2];
            var count_messages  = data[3];

            var time            = jQuery( this ).parent().attr('id');

            jQuery( ".wpc_ajax_time_filter" ).each( function( index ) {
                jQuery( this ).removeClass('wpc_link_current');
            });

            jQuery( this ).addClass( 'wpc_link_current' );

            jQuery.ajax({
                type: 'POST',
                url: site_url + '/wp-admin/admin-ajax.php',
                data: 'action=wpc_time_filter_messages&user_id=' + user_id + '&offset=' + wpc_offset + '&code=' + code + '&time=' + time,
                dataType: "json",
                success: function( data ){
                    jQuery( 'body' ).css( 'cursor', 'default' );
                    if( !data ) {
                        jQuery( '.wpc_client_messages' ).html('<tbody><tr><td colspan="3">' + wpc_no_messages + '</td></tr></tbody>');
                    } else {
                        jQuery( '.wpc_client_messages' ).html( '<tbody>' + data.html + '</tbody>' );

                        var hidden_data = [site_url, user_id, code, data.messages_count, time].join(',');
                        jQuery( '#wpc_show_more_params' ).val( hidden_data );

                        if ( wpc_offset*1 >= data.messages_count*1 ) {
                            jQuery( '#wpc_show_more_mess' ).css('display','none');
                        } else {
                            jQuery( '#wpc_show_more_mess' ).css('display','block');
                        }
                    }
                }
            });

        });



        // AJAX - get more messages
        jQuery( '#wpc_show_more_mess' ).click( function() {
            jQuery( 'body' ).css( 'cursor', 'wait' );

            var data            = jQuery( '#wpc_show_more_params' ).val();
            var data            = data.split(',');

            var site_url        = data[0];
            var user_id         = data[1];
            var code            = data[2];
            var count_messages  = data[3];
            var time            = data[4];

            jQuery.ajax({
                type: 'POST',
                url: site_url + '/wp-admin/admin-ajax.php',
                data: 'action=wpc_get_more_messages&user_id=' + user_id + '&offset=' + wpc_offset + '&show_more=' + wpc_show_more + '&code=' + code + '&time=' + time,
                success: function( html ){
                    jQuery( 'body' ).css( 'cursor', 'default' );
                    if ( '' == html || 0 == html ) {
                        jQuery( '#wpc_show_more_mess' ).remove( 'display', 'none' );
                    } else {
                        wpc_offset = wpc_offset * 1 + wpc_show_more * 1;
                        jQuery( '.wpc_client_messages tbody tr:last' ).after( html );
                        if ( count_messages <= wpc_offset )
                            jQuery( '#wpc_show_more_mess' ).css( 'display', 'none' );
                    }
                }
             });
        });

        jQuery( '#wpc_add_cc_email_user' ).click( function() {
            jQuery( '#wpc_add_cc_email_user' ).css( 'display', 'none' );
            jQuery( '#wpc_input_cc_email_user' ).css( 'display', 'block' );
        });
    });