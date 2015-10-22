<?php
if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_view_email_templates' ) && !current_user_can( 'wpc_edit_email_templates' ) ) { if ( current_user_can( 'wpc_view_shortcode_templates' ) || current_user_can( 'wpc_edit_shortcode_templates' ) ) $adress = get_admin_url() . 'admin.php?page=wpclients_templates&tab=shortcodes'; else $adress = get_admin_url( 'index.php' ); do_action( 'wp_client_redirect', $adress ); } $can_edit = ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_edit_email_templates' ) ) ? true : false; $wpc_templates_emails = $this->cc_get_settings( 'templates_emails' ); $wpc_emails_array['new_client_password'] = array( 'tab_label' => sprintf( __( 'New %s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'New %s Created by Admin', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => '', ); $wpc_emails_array['self_client_registration'] = array( 'tab_label' => sprintf( __( 'Self %s Registration', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'New %s Registration', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => '', ); $wpc_emails_array['convert_to_client'] = array( 'tab_label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent when a user is converted to a WPC-%s role', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => '', ); $wpc_emails_array['convert_to_staff'] = array( 'tab_label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'description' => sprintf( __( '  >> This email will be sent when a user is converted to a WPC-%s role', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'subject_description' => '', 'body_description' => '', ); $wpc_emails_array['convert_to_manager'] = array( 'tab_label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'description' => sprintf( __( '  >> This email will be sent when a user is converted to a WPC-%s role', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'subject_description' => '', 'body_description' => '', ); $wpc_emails_array['convert_to_admin'] = array( 'tab_label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'label' => sprintf( __( 'Convert User - %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'description' => sprintf( __( '  >> This email will be sent when a user is converted to a WPC-%s role', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'subject_description' => '', 'body_description' => '', ); $wpc_emails_array['new_client_verify_email'] = array( 'tab_label' => __( 'Verify Email', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( "Client's Email verification", WPC_CLIENT_TEXT_DOMAIN ), 'description' => sprintf( __( '  >> This email will be sent to %s for verify email address', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => '', ); $wpc_emails_array['client_updated'] = array( 'tab_label' => sprintf( __( '%s Password Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Password Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) , 'subject_description' => '', 'body_description' => '', ); $wpc_emails_array['new_client_registered'] = array( 'tab_label' => sprintf( __( 'New %s Registers', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'New %s registers using Self-Registration Form', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to Admin after a new %s registers with client registration form', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{site_title}, {contact_name}, {user_name} and {approve_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['account_is_approved'] = array( 'tab_label' => sprintf( __( '%s Account is approved', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Account is approved', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s after their account will approved (if "Send approval email" is checked).', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => __( '{site_title} and {contact_name} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'body_description' => __( '{site_title}, {contact_name}, {user_name} and {login_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['staff_created'] = array( 'tab_label' => sprintf( __( '%s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'label' => sprintf( __( '%s Created by website Admin', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'subject_description' => '', 'body_description' => __( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['staff_registered'] = array( 'tab_label' => sprintf( __( '%s Registered', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'label' => sprintf( __( '%s Registered by %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'], $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s after %s registered him (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['staff_created_admin_notify'] = array( 'tab_label' => sprintf( __( 'Notify %s %s Registered', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['staff']['s'] ), 'label' => sprintf( __( 'Notify %s %s Registered by %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['staff']['s'], $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s after %s registered %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['client']['s'], $this->custom_titles['staff']['s'] ), 'subject_description' => '', 'body_description' => __( '{approve_url} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['manager_created'] = array( 'tab_label' => sprintf( __( '%s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'label' => sprintf( __( '%s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ), 'subject_description' => '', 'body_description' => __( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['admin_created'] = array( 'tab_label' => sprintf( __( '%s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'label' => sprintf( __( '%s Created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Password" is checked)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ), 'subject_description' => '', 'body_description' => __( '{contact_name}, {user_name}, {password} and {admin_url} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['client_page_updated'] = array( 'tab_label' => sprintf( __( '%s Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal']['s'] ), 'label' => sprintf( __( '%s Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s (if "Send Update to selected %s is checked") when %s updating', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['client']['p'], $this->custom_titles['portal']['s'] ), 'subject_description' => __( '{contact_name}, {user_name}, {page_title} and {page_id} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'body_description' => __( '{contact_name}, {page_title} and {page_id} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['new_file_for_client_staff'] = array( 'tab_label' => __( 'Admin uploads new file', WPC_CLIENT_TEXT_DOMAIN ), 'label' => sprintf( __( 'Admin uploads new file for %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s and his %s when Admin or %s uploads a new file for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['staff']['p'], $this->custom_titles['manager']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{site_title}, {file_name}, {file_category} and {login_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['client_uploaded_file'] = array( 'tab_label' => sprintf( __( '%s Uploads new file', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Uploads new file', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to Admin and %s when %s uploads file(s)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['manager']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{user_name}, {site_title}, {file_name}, {file_category} and {admin_file_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['client_downloaded_file'] = array( 'tab_label' => sprintf( __( '%s Downloaded File', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Downloaded File', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to Admin and %s when %s Download file', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['manager']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{user_name}, {site_title}, {file_name} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['notify_client_about_message'] = array( 'tab_label' => sprintf( __( 'PM: Notify To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Private Message: Notify Message To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s when Admin/%s sent private message (if "Receive email notification of private messages from admin" in selected in plugin settings).', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['manager']['s'] ), 'subject_description' => '', 'body_description' => __( '{user_name}, {site_title}, {message} and {login_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['notify_cc_about_message'] = array( 'tab_label' => __( 'PM: Notify To CC Email', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Private Message: Notify Message To CC Email', WPC_CLIENT_TEXT_DOMAIN ), 'description' => sprintf( __( '  >> This email will be sent to CC Email when %s sent private message (if "Add CC Email for Private Messaging" is selected in plugin settings and %s added CC Email).', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{user_name}, {site_title} and {message} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['notify_admin_about_message'] = array( 'tab_label' => sprintf( __( 'PM: Notify To %s/%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['manager']['s'] ), 'label' => sprintf( __( 'Private Message: Notify Message To %s/%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['manager']['s'] ), 'description' => sprintf( __( '  >> This email will be sent to %s/%s when %s sent private message (if "Receive email notification of private messages from %s" is selected in plugin settings).', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'], $this->custom_titles['manager']['s'], $this->custom_titles['client']['s'], $this->custom_titles['client']['p'] ), 'subject_description' => '', 'body_description' => __( '{user_name}, {site_title}, {message} and {admin_url} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['reset_password'] = array( 'tab_label' => sprintf( __( 'Reset %s Password', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Reset %s Password', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( "  >> This email will be sent to %s when %s forgot it`s password and try to reset it.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{site_title}, {user_name} and {reset_address} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['profile_updated'] = array( 'tab_label' => sprintf( __( '%s Profile Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Profile Updated', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => sprintf( __( "  >> This email will be sent to Admins when %s update own profile.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'subject_description' => '', 'body_description' => __( '{site_title}, {admin_url}, {user_name}, {business_name} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['la_login_successful'] = array( 'tab_label' => __( 'Login Alert: Login Successful', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Login Alert: Login Successful', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This email will be sent to selected email address when user login was successful', WPC_CLIENT_TEXT_DOMAIN ), 'subject_description' => __( '{user_name} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'body_description' => __( '{ip_address} and {current_time} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array['la_login_failed'] = array( 'tab_label' => __( 'Login Alert: Login Failed', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Login Alert: Login Failed', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This email will be sent to selected email address when user login was failed', WPC_CLIENT_TEXT_DOMAIN ), 'subject_description' => __( '{la_user_name} will not be changed as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), 'body_description' => __( '{la_user_name}, {la_status}, {ip_address} and {current_time} will not be change as these placeholders will be used in the email.', WPC_CLIENT_TEXT_DOMAIN ), ); $wpc_emails_array = apply_filters( 'wpc_client_templates_emails_array', $wpc_emails_array ); ?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />

<style type="text/css">

    input[type="text"]{
        width: 100% ! important;
    }

</style>

<script type="text/javascript" language="javascript">
    jQuery(document).ready(function() {

        var site_url = '<?php echo site_url();?>';

        jQuery( "#email_tabs" ).tabs({ selected : <?php echo ( (isset( $_GET['set_tab'] ) && is_numeric( $_GET['set_tab'] ) ? $_GET['set_tab'] : 0 ) ) ?> }).addClass( "ui-tabs-vertical ui-helper-clearfix" );
        jQuery( "#email_tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

        jQuery(".submit_email").click(function() {
            var name    = jQuery(this).attr('name');
            var id      = jQuery(this).attr('name')+"_body";

            //get content from editor
            if ( jQuery( '#wp-' + id + '-wrap' ).hasClass( 'tmce-active' ) ) {
                var content = tinyMCE.get( id ).getContent();
            } else {
                var content = jQuery( '#' + id ).val();
            }

            var subject = jQuery( '#' + jQuery(this).attr('name') + '_subject' ).val();

            jQuery("#ajax_result_"+name).html('');
            jQuery("#ajax_result_"+name).show();
            jQuery("#ajax_result_"+name).css('display', 'inline');
            jQuery("#ajax_result_"+name).html('<div class="wpc_ajax_loading"></div>');
            var crypt_content    = jQuery.base64Encode( content );
            crypt_content        = crypt_content.replace(/\+/g, "-");

            var crypt_subject    = jQuery.base64Encode( subject );
            crypt_subject        = crypt_subject.replace(/\+/g, "-");
            jQuery.ajax({
                type: "POST",
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: "action=wpc_save_template&wpc_templates[wpc_templates_emails][" + name + "][subject]=" + crypt_subject + "&wpc_templates[wpc_templates_emails][" + name + "][body]=" + crypt_content,
                dataType: "json",
                success: function(data){
                    if(data.status) {
                        jQuery("#ajax_result_"+name).css('color', 'green');
                    } else {
                        jQuery("#ajax_result_"+name).css('color', 'red');
                    }
                    jQuery("#ajax_result_"+name).html(data.message);
                    setTimeout(function() {
                        jQuery("#ajax_result_"+name).fadeOut(1500);
                    }, 2500);
                },
                error: function(data) {
                    jQuery("#ajax_result_"+name).css('color', 'red');
                    jQuery("#ajax_result_"+name).html('Unknown error.');
                    setTimeout(function() {
                        jQuery("#ajax_result_"+name).fadeOut(1500);
                    }, 2500);
                }
            });
        });


        jQuery(".wpc_templates_enable").click( function() {

            if ( 'checked' == jQuery( this ).attr( 'checked' ) ) {
                var value    = jQuery.base64Encode( '1' );
                value        = value.replace(/\+/g, "-");
            } else {
                var value    = jQuery.base64Encode( '0' );
                value        = value.replace(/\+/g, "-");
            }

            var name        = jQuery(this).attr('data-key');
            var checkbox    = jQuery( this );

            checkbox.hide();
            jQuery( '#wpc_ajax_loading_' + name ).addClass( 'wpc_ajax_loading' );

            jQuery.ajax({
                type: "POST",
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: "action=wpc_save_template&wpc_templates[wpc_templates_emails][" + name + "][enable]=" + value,
                dataType: "json",
                success: function(data){
                    jQuery( '#wpc_ajax_loading_' + name ).removeClass( 'wpc_ajax_loading' );
                    checkbox.show();

                },
            });
        });


    });

</script>



<div class="icon32" id="icon-link-manager"></div>
<h2><?php printf( __( '%s Emails Settings', WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></h2>
<p><?php _e( 'From here you can edit the email templates and settings.', WPC_CLIENT_TEXT_DOMAIN ) ?></p>


<form action="" method="post">

    <div id="email_tabs">
        <ul>
            <?php
 if ( is_array( $wpc_emails_array )&& count( $wpc_emails_array ) ) { foreach( $wpc_emails_array as $key => $values ) { $checked = ( !isset( $wpc_templates_emails[$key]['enable'] ) || '1' == $wpc_templates_emails[$key]['enable'] ) ? 'checked' : ''; echo '<li><table width="100%" class="settings_tab_table"><tr><td width="10"><span id="wpc_ajax_loading_' . $key . '"></span><input type="checkbox"' . ( $can_edit ? '' : ' disabled="disabled"' ) . ' data-key="' . $key . '" class="wpc_templates_enable" name="wpc_templates[emails][' . $key . '][enable]" value="1" ' . $checked . ' title="' . __( 'Disable\Enable Notification', WPC_CLIENT_TEXT_DOMAIN ) . '" /></td><td><a href="#wpc_' . $key . '">' . $values['tab_label'] .'</a></td></tr></table></li>'; } } ?>
        </ul>


        <?php
 if ( is_array( $wpc_emails_array )&& count( $wpc_emails_array ) ) { foreach( $wpc_emails_array as $key => $values ) { ?>
        <div id="wpc_<?php echo $key ?>">
            <div class="postbox" style="width: 100%;">
                <h3 class="hndle"><span><?php echo $values['label'] ?></span></h3>
                <span class="description"><?php echo $values['description'] ?></span>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                        <tr valign="top">
                            <td colspan="2">
                                <label for="<?php echo $key ?>_subject"><?php _e( 'Email Subject', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                <br>
                                <input type="text"<?php echo $can_edit ? '' : ' readonly="readonly"' ?> name="wpc_templates[emails][<?php echo $key ?>][subject]" id="<?php echo $key ?>_subject" value="<?php echo ( isset( $wpc_templates_emails[$key]['subject'] ) ) ? stripslashes( $wpc_templates_emails[$key]['subject'] ) : '' ?>" />
                                <?php if ( isset( $values['subject_description'] ) && '' != $values['subject_description'] ) { ?>
                                <span class="description"><?php echo $values['subject_description'] ?></span>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td colspan="2">
                                <label for="<?php echo $key ?>"><?php _e( 'Email Body', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                <br>
                                <?php
 $body = ( isset( $wpc_templates_emails[$key]['body'] ) ) ? stripslashes( $wpc_templates_emails[$key]['body'] ) : ''; if ($can_edit) { wp_editor( $body, $key . '_body', array( 'textarea_name' => 'wpc_templates[emails][' . $key . '][body]', 'textarea_rows' => 15, 'wpautop' => false, 'media_buttons' => false ) ); } else { echo '<textarea style="width: 100%;" rows="25" readonly>' . $body . '</textarea>'; } ?>
                                <?php if ( isset( $values['body_description'] ) && '' != $values['body_description'] ) { ?>
                                <span class="description"><?php echo $values['body_description'] ?></span>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
 if ($can_edit) { ?>
                        <tr>
                            <td valign="middle" align="left">
                                <input type="button" name="<?php echo $key ?>" class="button-primary submit_email" value="Update" />
                                <div id="ajax_result_<?php echo $key ?>" style="display: inline;"></div>
                            </td>
                            <td valign="middle" align="right">
                            </td>
                        </tr>
                        <?php
 } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
 } } ?>


    </div>

</form>