//for tinymce v4

var wpc_shortcodes_menu = {
    files : new Array(),
    list : new Array(),
    pages : new Array(),
    clients : new Array(),
    other : new Array()
};
var wpc_shortcode = '';
var temporary_data = {};
var input_name = '';
var temp_counters = {};

var wpc_popup_title = '';

for( key in wpc_shortcodes ) {
    if( typeof wpc_shortcodes[ key ].categories != 'undefined' && wpc_shortcodes[ key ].categories != '' ) {
        wpc_shortcodes_menu[ wpc_shortcodes[ key ].categories ].push({
            text: typeof wpc_shortcodes[ key ].title != 'undefined' ? wpc_shortcodes[ key ].title : '',
            value: key,
            onclick: function( e ) {
                e.stopPropagation();
                wpc_shortcode = this.value();
                shortcode_item_click( wpc_shortcodes[ wpc_shortcode ] );
            }
        });
    }
}

function shortcode_popup_link_click() {
    temporary_data = jQuery(this).parents('form').values();
    var temp_input_ref = jQuery(this).data('input');
    input_name = jQuery( '#' + temp_input_ref ).attr('name');
    tb_remove();
}

function shortcode_popup_assign_cancel() {
    shortcode_item_click( wpc_shortcodes[ wpc_shortcode ], temporary_data );
}

function shortcode_popup_assign_process() {
    var args = [].slice.call( arguments );
    temporary_data[ input_name ] = args[1].join(',');
    shortcode_item_click( wpc_shortcodes[ wpc_shortcode ], temporary_data );
}

function shortcode_item_click( shortcode_item, temp_data ) {
    var attributes_array = new Array();
    if( !( typeof shortcode_item.attributes == 'undefined' || shortcode_item.attributes.length == 0 ) ) {
        for( var prop in shortcode_item.attributes ) {
            attributes_array.push( prop );
        }
    }

    if( attributes_array.length > 0 ) {
        jQuery.wpcShowLoad();
        jQuery.ajax({
            type: 'POST',
            url: wpc_var.ajax_url,
            data: 'action=wpc_get_shortcode_attributes_form&shortcode=' + wpc_shortcode,
            dataType: 'json',
            success: function( data ){
                if( data.status ) {
                    jQuery('#wpc_shortcode_block').remove();
                    jQuery( 'body' ).append('<div id="wpc_shortcode_block" style="display:none;">' +
                        '<form id="wpc_shortcode_form" style="width: 480px; padding: 20px 0 0; box-sizing: border-box;">' +
                            data.html +
                            '<p class="action_buttons_block">' +
                                '<input type="button" class="button-primary add_shortcode_button" value="Add Shortcode" />' +
                                '<input type="button" class="button cancel_shortcode_button" style="float: right;" value="Cancel" />' +
                            '</p>' +
                        '</form>' +
                    '</div>');

                    jQuery.wpcHideLoad();

                    jQuery('#wpc_shortcode_form .wpc_attr_field').each(function() {
                        jQuery(this).trigger('change');
                    });

                    wpc_popup_title = data.title;
                    jQuery('#wpc_shortcode_block').wpc_thickbox_popup({
                        'title' : wpc_popup_title
                    });

                    if( typeof( temp_data ) != 'undefined' ) {
                        jQuery('#wpc_shortcode_form').values( temp_data );
                        if( 'radio' == wpc_marks_type ) {
                            if( checkbox_name.length != 0 ) {
                                temp_counters[ wpc_input_ref ] = checkbox_name;
                            }
                        } else {
                            temp_counters[ wpc_input_ref ] = checkbox_session.length;
                        }
                    }
                    for( key in temp_counters ) {
                        jQuery(".counter_" + key).html("(" + temp_counters[ key ] + ")");
                    }
                } else {
                    alert( data.message );
                }
            }
        });
    } else {
        var close_tag = '';
        if( typeof wpc_shortcodes[ wpc_shortcode ].content != 'undefined' && wpc_shortcodes[ wpc_shortcode ].content != '' ) {
            close_tag = wpc_shortcodes[ wpc_shortcode ].content + '[/' + wpc_shortcode + ']';
        } else if( typeof wpc_shortcodes[ wpc_shortcode ].close_tag != 'undefined' && wpc_shortcodes[ wpc_shortcode ].close_tag ) {
            close_tag = '[/' + wpc_shortcode + ']';
        }
        tinyMCE.activeEditor.insertContent( '[' + wpc_shortcode + ( close_tag == '' ? ' /' : '' ) + ']' + close_tag );
        wpc_shortcode = '';
    }
}

jQuery(document).ready(function() {
    jQuery(document).on('click', '.add_shortcode_button', function() {
        var attr_array = jQuery(this).parents('form').values();
        var attr_string = '';
        var temp_obj = new Object();
        for( key in attr_array ) {
            if( jQuery('#wpc_shortcode_form *[name="' + key + '"]').parent().is(':visible') ) {
                var data_key = jQuery('#wpc_shortcode_form *[name="' + key +  '"]').data('key');
                if( data_key == '' ) continue;
                if( typeof temp_obj[ data_key ] == 'undefined' ) {
                    temp_obj[ data_key ] = new Array();
                }
                temp_obj[ data_key ].push( attr_array[ key ] );
            }
        }
        for( key in temp_obj ) {
            attr_string += key + '="' + temp_obj[ key ].join(',') + '" ';
        }
        var close_tag = '';
        if( typeof wpc_shortcodes[ wpc_shortcode ].content != 'undefined' && wpc_shortcodes[ wpc_shortcode ].content != '' ) {
            close_tag = wpc_shortcodes[ wpc_shortcode ].content + '[/' + wpc_shortcode + ']';
        } else if( typeof wpc_shortcodes[ wpc_shortcode ].close_tag != 'undefined' && wpc_shortcodes[ wpc_shortcode ].close_tag ) {
            close_tag = '[/' + wpc_shortcode + ']';
        }
        tinyMCE.activeEditor.insertContent( '[' + wpc_shortcode + ' ' + attr_string + ( close_tag == '' ? '/' : '' ) + ']' + close_tag );
        wpc_shortcode = '';
        tb_remove();
    });
    jQuery(document).on('click', '.cancel_shortcode_button', function() {
        wpc_shortcode = '';
        tb_remove();
    });
    jQuery(document).on('change', '.wpc_attr_field', function() {
        var name = jQuery(this).data('key');
        var value = jQuery(this).val();
        jQuery( '.wpc_has_parent_' + name ).parents('#wpc_shortcode_form tr').hide();
        jQuery( '.wpc_has_parent_' + name + '.' + name + ( typeof( value ) == 'string' && value.length > 0 ? '_' + md5( value ) : '' ) ).parents('#wpc_shortcode_form tr').show();
        jQuery.wpcChangeSize();
    });
});

(function() {

    tinymce.PluginManager.add( 'WPC_Client_Shortcodes', function( editor, url ) {

               editor.addButton( 'wpc_client_button_shortcodes', {
                    title : 'Insert Placeholders & Shortcode',
                    type : 'menubutton',
                    menu: [
                        {
                            text: 'Placeholders: General',
                            value: '',
                            onclick: function() {
                                editor.insertContent(this.value());
                            },
                            menu: [
                                {
                                    text: '{site_title}',
                                    value: '{site_title}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{contact_name}',
                                    value: '{contact_name}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{client_business_name}',
                                    value: '{client_business_name}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{client_name}',
                                    value: '{client_name}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{client_phone}',
                                    value: '{client_phone}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{client_email}',
                                    value: '{client_email}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{client_registration_date}',
                                    value: '{client_registration_date}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{user_name}',
                                    value: '{user_name}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{login_url}',
                                    value: '{login_url}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{logout_url}',
                                    value: '{logout_url}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{manager_name}',
                                    value: '{manager_name}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{staff_display_name}',
                                    value: '{staff_display_name}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{staff_first_name}',
                                    value: '{staff_first_name}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{staff_last_name}',
                                    value: '{staff_last_name}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{staff_email}',
                                    value: '{staff_email}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{staff_login}',
                                    value: '{staff_login}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                }
                            ]

                        },
                        {
                            text: 'Placeholders: Business',
                            value: '',
                            onclick: function() {
                                editor.insertContent(this.value());
                            },
                            menu: [
                                {
                                    text: '{business_logo_url}',
                                    value: '{business_logo_url}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{business_name}',
                                    value: '{business_name}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{business_address}',
                                    value: '{business_address}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{business_mailing_address}',
                                    value: '{business_mailing_address}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{business_website}',
                                    value: '{business_website}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{business_email}',
                                    value: '{business_email}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{business_phone}',
                                    value: '{business_phone}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{business_fax}',
                                    value: '{business_fax}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                }
                            ]
                        },
                        {
                            text: 'Placeholders: Specific',
                            value: '',
                            onclick: function() {
                                editor.insertContent(this.value());
                            },
                            menu: [
                                {
                                    text: '{admin_url}',
                                    value: '{admin_url}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{approve_url}',
                                    value: '{approve_url}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{user_password}',
                                    value: '{user_password}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{page_title}',
                                    value: '{page_title}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{admin_file_url}',
                                    value: '{admin_file_url}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{message}',
                                    value: '{message}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{file_name}',
                                    value: '{file_name}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{file_category}',
                                    value: '{file_category}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{estimate_number}',
                                    value: '{estimate_number}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                },
                                {
                                    text: '{invoice_number}',
                                    value: '{invoice_number}',
                                    onclick: function(e) {
                                        e.stopPropagation();
                                        editor.insertContent(this.value());
                                    }
                                }
                            ]
                        },
                        {
                            text: 'Shortcodes: Files',
                            value: '',
                            onclick: function() {
                                editor.insertContent(this.value());
                            },
                            menu: wpc_shortcodes_menu.files
                        },
                        {
                            text: 'Shortcodes: Lists',
                            value: '',
                            onclick: function() {
                                editor.insertContent(this.value());
                            },
                            menu: wpc_shortcodes_menu.list
                        },
                        {
                            text: 'Shortcodes: Pages',
                            value: '',
                            onclick: function() {
                                editor.insertContent(this.value());
                            },
                            menu: wpc_shortcodes_menu.pages
                        },
                        {
                            text: 'Shortcodes: Users',
                            value: '',
                            onclick: function() {
                                editor.insertContent(this.value());
                            },
                            menu: wpc_shortcodes_menu.clients
                        },
                        {
                            text: 'Shortcodes: Others',
                            value: '',
                            onclick: function() {
                                editor.insertContent(this.value());
                            },
                            menu: wpc_shortcodes_menu.other
                        }
                   ]

               });



		}
	);

}
)();
