<?php
 if ( isset( $_POST['update_settings'] ) ) { if ( isset( $_POST['wpc_clients_staff'] ) ) { $settings = $_POST['wpc_clients_staff']; $settings['auto_client_approve'] = ( isset( $settings['auto_client_approve'] ) ) ? 'yes' : 'no'; $settings['auto_client_staff_approve'] = ( isset( $settings['auto_client_staff_approve'] ) ) ? 'yes' : 'no'; $settings['new_client_admin_notify'] = ( isset( $settings['new_client_admin_notify'] ) ) ? 'yes' : 'no'; $settings['send_approval_email'] = ( isset( $settings['send_approval_email'] ) ) ? 'yes' : 'no'; $settings['captcha_version'] = 'recaptcha_2'; $settings['captcha_publickey_2'] = ( isset( $settings['captcha_publickey_2'] ) && '' != $settings['captcha_publickey_2'] ) ? $settings['captcha_publickey_2'] : ''; $settings['captcha_privatekey_2'] = ( isset( $settings['captcha_privatekey_2'] ) && '' != $settings['captcha_privatekey_2'] ) ? $settings['captcha_privatekey_2'] : ''; $settings['captcha_theme'] = !empty( $settings['captcha_theme'] ) ? $settings['captcha_theme'] : 'light'; } else { $settings = array(); } if ( isset( $settings['using_captcha'] ) && 'yes' == $settings['using_captcha'] && 'recaptcha_2' == $settings['captcha_version'] && ( empty( $settings['captcha_publickey_2'] ) || empty( $settings['captcha_privatekey_2'] ) ) ) do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=clients_staff&msg=nk' ); do_action( 'wp_client_settings_update', $settings, 'clients_staff' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=clients_staff&msg=u' ); exit; } $wpc_clients_staff = $this->cc_get_settings( 'clients_staff' ); ?>

<script type="text/javascript">
jQuery( document ).ready( function() {
    var plugin_url = '<?php echo $this->plugin_url ?>';


    jQuery('#recaptcha_preview_theme').attr('src', plugin_url + 'images/recaptcha_2_0.png');

    if( jQuery('#wpc_clients_staff_using_captcha').val() == 'no') {
        jQuery('#captcha_hiding_settings').css('display','none');
    } else if( jQuery('#wpc_clients_staff_using_captcha').val() == 'yes') {
        jQuery('#captcha_hiding_settings').css('display','block');
    }

    if( jQuery('#wpc_clients_staff_registration_using_terms').val() == 'no') {
        jQuery('#terms_hiding_settings').css('display','none');
    } else if( jQuery('#wpc_clients_staff_registration_using_terms').val() == 'yes') {
        jQuery('#terms_hiding_settings').css('display','block');
    }

    jQuery('#block_captcha_theme').show();
    jQuery('#description_for_2_0').show();
    jQuery('.wpc_recapcha_1').css( 'display', 'none' );
    jQuery('.wpc_recapcha_2').css( 'display', 'table-row' );
    <?php if( isset( $wpc_clients_staff['captcha_theme'] ) && 'dark' == $wpc_clients_staff['captcha_theme'] ) { ?>
        jQuery('#recaptcha_preview_theme').attr('src', plugin_url + 'images/recaptcha_2_0_dark.png');
    <?php } else { ?>
        jQuery('#recaptcha_preview_theme').attr('src', plugin_url + 'images/recaptcha_2_0.png');
    <?php } ?>

    jQuery('#wpc_clients_staff_captcha_theme').change(function() {
        var value = jQuery(this).val();
        if( value == 'dark' ) {
            jQuery('#recaptcha_preview_theme').attr('src', plugin_url + 'images/recaptcha_2_0_dark.png');
        } else {
            jQuery('#recaptcha_preview_theme').attr('src', plugin_url + 'images/recaptcha_2_0.png');
        }
    });

    jQuery('#update_settings').click(function(){
        var errors = 0;
        jQuery('#wpc_clients_staff_captcha_privatekey_2').removeClass( 'wpc_error' ) ;
        jQuery('#wpc_clients_staff_captcha_publickey_2').removeClass( 'wpc_error' ) ;
        if ( 'yes' == jQuery('#wpc_clients_staff_using_captcha').val() ) {
            if ( '' == jQuery('#wpc_clients_staff_captcha_privatekey_2').val() ) {
                jQuery('#wpc_clients_staff_captcha_privatekey_2').addClass( 'wpc_error' ).focus();
                errors++;
            }
            if ( '' == jQuery('#wpc_clients_staff_captcha_publickey_2').val() ) {
                jQuery('#wpc_clients_staff_captcha_publickey_2').addClass( 'wpc_error' ).focus();
                errors++;
            }
        }

        if( errors == 0 ) {
            errors = 0;
            return true;
        } else {
            errors = 0;
            return false;
        }
    });

    jQuery('#wpc_clients_staff_using_captcha').change(function(){
        if( jQuery(this).val() == 'no') {
            jQuery('#captcha_hiding_settings').slideUp('high');
        } else if( jQuery(this).val() == 'yes') {
            jQuery('#captcha_hiding_settings').slideDown('high');
        }
    });

    jQuery('#wpc_clients_staff_registration_using_terms').change(function(){
        if( jQuery(this).val() == 'no') {
            jQuery('#terms_hiding_settings').slideUp('high');
        } else if( jQuery(this).val() == 'yes') {
            jQuery('#terms_hiding_settings').slideDown('high');
        }
    });

    jQuery('#wpc_clients_staff_captcha_publickey_2').change(function(){
        if( jQuery(this).val() != '' && jQuery('#wpc_clients_staff_captcha_privatekey_2').val() == '' && jQuery('#captcha_warning').css('display') == 'none' ) {
            jQuery('#captcha_warning').slideDown('high');
        } else if( jQuery(this).val() == '' && jQuery('#wpc_clients_staff_captcha_privatekey_2').val() != '' && jQuery('#captcha_warning').css('display') == 'none' ) {
            jQuery('#captcha_warning').slideDown('high');
        } else if( jQuery(this).val() != '' && jQuery('#wpc_clients_staff_captcha_privatekey_2').val() != '' && jQuery('#captcha_warning').css('display') == 'block' ) {
            jQuery('#captcha_warning').slideUp('high');
        } else if( jQuery(this).val() == '' && jQuery('#wpc_clients_staff_captcha_privatekey_2').val() == '' && jQuery('#captcha_warning').css('display') == 'block' ) {
            jQuery('#captcha_warning').slideUp('high');
        }
    });

    jQuery('#wpc_clients_staff_captcha_privatekey_2').change(function(){
        if( jQuery(this).val() != '' && jQuery('#wpc_clients_staff_captcha_publickey_2').val() == '' && jQuery('#captcha_warning').css('display') == 'none' ) {
            jQuery('#captcha_warning').slideDown('high');
        } else if( jQuery(this).val() == '' && jQuery('#wpc_clients_staff_captcha_publickey_2').val() != '' && jQuery('#captcha_warning').css('display') == 'none' ) {
            jQuery('#captcha_warning').slideDown('high');
        } else if( jQuery(this).val() != '' && jQuery('#wpc_clients_staff_captcha_publickey_2').val() != '' && jQuery('#captcha_warning').css('display') == 'block' ) {
            jQuery('#captcha_warning').slideUp('high');
        } else if( jQuery(this).val() == '' && jQuery('#wpc_clients_staff_captcha_publickey_2').val() == '' && jQuery('#captcha_warning').css('display') == 'block' ) {
            jQuery('#captcha_warning').slideUp('high');
        }
    });

    jQuery('#wpc_clients_staff_captcha_publickey_2').keyup(function(e){
        if( jQuery(this).val() != '' && jQuery('#wpc_clients_staff_captcha_privatekey_2').val() == '' && jQuery('#captcha_warning').css('display') == 'none' ) {
            jQuery('#captcha_warning').slideDown('high');
        } else if( jQuery(this).val() == '' && jQuery('#wpc_clients_staff_captcha_privatekey_2').val() != '' && jQuery('#captcha_warning').css('display') == 'none' ) {
            jQuery('#captcha_warning').slideDown('high');
        } else if( jQuery(this).val() != '' && jQuery('#wpc_clients_staff_captcha_privatekey_2').val() != '' && jQuery('#captcha_warning').css('display') == 'block' ) {
            jQuery('#captcha_warning').slideUp('high');
        } else if( jQuery(this).val() == '' && jQuery('#wpc_clients_staff_captcha_privatekey_2').val() == '' && jQuery('#captcha_warning').css('display') == 'block' ) {
            jQuery('#captcha_warning').slideUp('high');
        }
    });

    jQuery('#wpc_clients_staff_captcha_privatekey_2').keyup(function(e){
        if( jQuery(this).val() != '' && jQuery('#wpc_clients_staff_captcha_publickey_2').val() == '' && jQuery('#captcha_warning').css('display') == 'none' ) {
            jQuery('#captcha_warning').slideDown('high');
        } else if( jQuery(this).val() == '' && jQuery('#wpc_clients_staff_captcha_publickey_2').val() != '' && jQuery('#captcha_warning').css('display') == 'none' ) {
            jQuery('#captcha_warning').slideDown('high');
        } else if( jQuery(this).val() != '' && jQuery('#wpc_clients_staff_captcha_publickey_2').val() != '' && jQuery('#captcha_warning').css('display') == 'block' ) {
            jQuery('#captcha_warning').slideUp('high');
        } else if( jQuery(this).val() == '' && jQuery('#wpc_clients_staff_captcha_publickey_2').val() == '' && jQuery('#captcha_warning').css('display') == 'block' ) {
            jQuery('#captcha_warning').slideUp('high');
        }
    });

});
</script>
<form action="" method="post" name="wpc_settings" id="wpc_settings" >

    <div class="postbox">
        <h3 class='hndle'><span><?php printf( __( '%s/%s Settings', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['staff']['s'] ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_create_portal_page"><?php printf( __( 'Automatically create %s when new %s is created', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal']['s'], $this->custom_titles['client']['s'] ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[create_portal_page]" id="wpc_clients_staff_create_portal_page" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_clients_staff['create_portal_page'] ) && 'yes' == $wpc_clients_staff['create_portal_page'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_clients_staff['create_portal_page'] ) && 'no' == $wpc_clients_staff['create_portal_page'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_use_portal_page_settings"><?php printf( __( 'Ignore Theme Link Page Options for Automatically created %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal']['s'] ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[use_portal_page_settings]" id="wpc_clients_staff_use_portal_page_settings" style="width: 100px;">
                            <option value="0" <?php echo ( isset( $wpc_clients_staff['use_portal_page_settings'] ) && '0' == $wpc_clients_staff['use_portal_page_settings'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="1" <?php echo ( isset( $wpc_clients_staff['use_portal_page_settings'] ) && '1' == $wpc_clients_staff['use_portal_page_settings'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_hide_dashboard"><?php _e( 'Hide dashboard/backend', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[hide_dashboard]" id="wpc_clients_staff_hide_dashboard" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_clients_staff['hide_dashboard'] ) && 'yes' == $wpc_clients_staff['hide_dashboard'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !isset( $wpc_clients_staff['hide_dashboard'] ) || 'no' == $wpc_clients_staff['hide_dashboard'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"><?php printf( __( 'Hides WordPress admin dashboard/backend from %s and %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['staff']['p'] ) ?></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_hide_admin_bar"><?php _e( 'Hide Admin Bar', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[hide_admin_bar]" id="wpc_clients_staff_hide_admin_bar" style="width: 100px;">
                            <option value="yes" <?php echo ( !isset( $wpc_clients_staff['hide_admin_bar'] ) || 'yes' == $wpc_clients_staff['hide_admin_bar'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_clients_staff['hide_admin_bar'] ) && 'no' == $wpc_clients_staff['hide_admin_bar'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"><?php printf( __( 'Hides top WordPress Admin Bar from %s and %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['staff']['p'] ) ?></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_lost_password"><?php _e( 'Allow "Lost your password"', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[lost_password]" id="wpc_clients_staff_lost_password" style="width: 100px;">
                            <option value="no" <?php echo ( isset( $wpc_clients_staff['lost_password'] ) && 'no' == $wpc_clients_staff['lost_password'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="yes" <?php echo ( isset( $wpc_clients_staff['lost_password'] ) && 'yes' == $wpc_clients_staff['lost_password'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"><?php _e( 'Displays "Lost your password" link on login form.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_client_registration"><?php printf( __( 'Open %s Registration', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[client_registration]" id="wpc_clients_staff_client_registration" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_clients_staff['client_registration'] ) && 'yes' == $wpc_clients_staff['client_registration'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_clients_staff['client_registration'] ) && 'no' == $wpc_clients_staff['client_registration'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"><?php printf( __( 'Allows %2$s to self-register using %1$s Registration Form. By default, self-registered %2$s required Admin approval before their account is active.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['client']['p'] ) ?></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" name="wpc_clients_staff[new_client_admin_notify]" id="wpc_clients_staff_new_client_admin_notify" value="yes" <?php echo ( !isset( $wpc_clients_staff['new_client_admin_notify'] ) || 'yes' == $wpc_clients_staff['new_client_admin_notify'] ) ? 'checked' : '' ?> />
                            <?php _e( 'Notify Admin about new registrations.', WPC_CLIENT_TEXT_DOMAIN ) ?>
                        </label>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" name="wpc_clients_staff[auto_client_approve]" id="wpc_clients_staff_auto_client_approve" value="yes" <?php echo ( isset( $wpc_clients_staff['auto_client_approve'] ) && 'yes' == $wpc_clients_staff['auto_client_approve'] ) ? 'checked' : '' ?> />
                            <?php printf( __( 'Automatically approve %s who register using form.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ?>
                        </label>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" name="wpc_clients_staff[auto_login_after_registration]" id="wpc_clients_staff_auto_login_after_registration" value="yes" <?php echo ( isset( $wpc_clients_staff['auto_login_after_registration'] ) && 'yes' == $wpc_clients_staff['auto_login_after_registration'] ) ? 'checked' : '' ?> />
                            <?php printf( __( 'Automatically login %s after registration.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ?>
                        </label>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" name="wpc_clients_staff[verify_email]" id="wpc_clients_staff_verify_email" value="yes" <?php echo ( isset( $wpc_clients_staff['verify_email'] ) && 'yes' == $wpc_clients_staff['verify_email'] ) ? 'checked' : '' ?> />
                            <?php printf( __( 'Send verification email to %s who self-register.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ?>
                        </label>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" name="wpc_clients_staff[send_approval_email]" id="wpc_clients_staff_send_approval_email" value="yes" <?php echo ( isset( $wpc_clients_staff['send_approval_email'] ) && 'yes' == $wpc_clients_staff['send_approval_email'] ) ? 'checked' : '' ?> />
                            <?php printf( __( 'Send email notification to %s after %s approves their account.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['admin']['s'] ) ?>
                        </label>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_staff_registration"><?php printf( __( 'Open %s Registration', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[staff_registration]" id="wpc_clients_staff_staff_registration" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_clients_staff['staff_registration'] ) && 'yes' == $wpc_clients_staff['staff_registration'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_clients_staff['staff_registration'] ) && 'no' == $wpc_clients_staff['staff_registration'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"><?php printf( __( 'Allows %1$s to register their own %2$s users. By default, %2$s users require %3$s approval before their account is active.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['staff']['s'], $this->custom_titles['admin']['s'] ) ?></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" name="wpc_clients_staff[auto_client_staff_approve]" id="wpc_clients_staff_auto_client_staff_approve" value="yes" <?php echo ( isset( $wpc_clients_staff['auto_client_staff_approve'] ) && 'yes' == $wpc_clients_staff['auto_client_staff_approve'] ) ? 'checked' : '' ?> />
                            <?php printf( __( 'Automatically approve %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ) ?>
                        </label>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_add_cc_email"><?php _e( 'Add CC Email for Private Messaging', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[add_cc_email]" id="wpc_clients_staff_add_cc_email" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_clients_staff['add_cc_email'] ) && 'yes' == $wpc_clients_staff['add_cc_email'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !isset( $wpc_clients_staff['add_cc_email'] ) || 'yes' != $wpc_clients_staff['add_cc_email'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_send_pm_email_to_admin"><?php _e( 'Send Email to Admin Email address for Private Messaging', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[send_pm_email_to_admin]" id="wpc_clients_staff_send_pm_email_to_admin" style="width: 100px;">
                            <option value="yes" <?php echo ( !isset( $wpc_clients_staff['send_pm_email_to_admin'] ) || 'no' != $wpc_clients_staff['send_pm_email_to_admin'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_clients_staff['send_pm_email_to_admin'] ) && 'no' == $wpc_clients_staff['send_pm_email_to_admin'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'Password Requirements', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_password_minimal_length"><?php _e( 'Password Minimum Length', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="wpc_clients_staff[password_minimal_length]" id="wpc_clients_staff_password_minimal_length" style="width: 100px;" value="<?php echo ( ( isset( $wpc_clients_staff['password_minimal_length'] ) && is_numeric( $wpc_clients_staff['password_minimal_length'] ) ) ? $wpc_clients_staff['password_minimal_length'] : 1 ); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_password_strength"><?php _e( 'Password Strength', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[password_strength]" id="wpc_clients_staff_password_strength" style="width: 100px;">
                            <option value="5" <?php selected ( isset( $wpc_clients_staff['password_strength'] ) ? $wpc_clients_staff['password_strength'] : 5, 5 ); ?>><?php _e( 'Very Weak', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="2" <?php selected ( isset( $wpc_clients_staff['password_strength'] ) ? $wpc_clients_staff['password_strength'] : 5, 2 ); ?>><?php _e( 'Weak', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="3" <?php selected ( isset( $wpc_clients_staff['password_strength'] ) ? $wpc_clients_staff['password_strength'] : 5, 3 ); ?>><?php _e( 'Medium', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="4" <?php selected ( isset( $wpc_clients_staff['password_strength'] ) ? $wpc_clients_staff['password_strength'] : 5, 4 ); ?>><?php _e( 'High', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_password_black_list"><?php _e( 'Password Black List', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <textarea name="wpc_clients_staff[password_black_list]" id="wpc_clients_staff_password_black_list" style="width: 300px;" rows="5"><?php echo ( isset( $wpc_clients_staff['password_black_list'] ) ? $wpc_clients_staff['password_black_list'] : "password\nqwerty\n123456789" ); ?></textarea>
                        <br>
                        <span class="description"><?php _e( 'Enter values here to prevent a user from choosing them. One per line.', WPC_CLIENT_TEXT_DOMAIN ); ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_password_mixed_case"><?php _e( 'Password Mixed Case', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="wpc_clients_staff[password_mixed_case]" id="wpc_clients_staff_password_mixed_case" value="1" <?php checked( isset( $wpc_clients_staff['password_mixed_case'] ) ? $wpc_clients_staff['password_mixed_case'] : 0, 1 ); ?> />
                        <span class="description"><?php _e( 'Password must contain a mix of uppercase and lowercase characters.', WPC_CLIENT_TEXT_DOMAIN ); ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_password_numeric_digits"><?php _e( 'Password Numeric Digits', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="wpc_clients_staff[password_numeric_digits]" id="wpc_clients_staff_password_numeric_digits" value="1" <?php checked( isset( $wpc_clients_staff['password_numeric_digits'] ) ? $wpc_clients_staff['password_numeric_digits'] : 0, 1 ); ?> />
                        <span class="description"><?php _e( 'Password must contain numeric digits (0-9).', WPC_CLIENT_TEXT_DOMAIN ); ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_password_special_chars"><?php _e( 'Password Special Characters', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="checkbox" name="wpc_clients_staff[password_special_chars]" id="wpc_clients_staff_password_special_chars" value="1" <?php checked( isset( $wpc_clients_staff['password_special_chars'] ) ? $wpc_clients_staff['password_special_chars'] : 0, 1 ); ?> />
                        <span class="description"><?php _e( 'Password must contain special characters (eg: .,!#$%_+).', WPC_CLIENT_TEXT_DOMAIN ); ?></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'Terms/Conditions', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_registration_using_terms"><?php _e( 'Use Terms/Conditions', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[registration_using_terms]" id="wpc_clients_staff_registration_using_terms" style="width: 100px;">
                            <option value="no" <?php echo ( !isset( $wpc_clients_staff['registration_using_terms'] ) || ( isset( $wpc_clients_staff['registration_using_terms'] ) && 'no' == $wpc_clients_staff['registration_using_terms'] ) ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="yes" <?php echo ( isset( $wpc_clients_staff['registration_using_terms'] ) && 'yes' == $wpc_clients_staff['registration_using_terms'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"><?php printf( __( 'Use Terms/Conditions on %s Registration form.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?></span>
                    </td>
                </tr>
            </table>
            <table class="form-table" id="terms_hiding_settings">
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_terms_default_checked"><?php _e( 'Checked by default', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[terms_default_checked]" id="wpc_clients_staff_terms_default_checked" style="width: 100px;">
                            <option value="no" <?php echo ( !isset( $wpc_clients_staff['terms_default_checked'] ) || ( isset( $wpc_clients_staff['terms_default_checked'] ) && 'no' == $wpc_clients_staff['terms_default_checked'] ) ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="yes" <?php echo ( isset( $wpc_clients_staff['terms_default_checked'] ) && 'yes' == $wpc_clients_staff['terms_default_checked'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_terms_hyperlink"><?php _e( 'Terms Hyperlink', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="wpc_clients_staff[terms_hyperlink]" id="wpc_clients_staff_terms_hyperlink" value="<?php echo ( isset( $wpc_clients_staff['terms_hyperlink'] ) ) ? $wpc_clients_staff['terms_hyperlink'] : '' ?>" />
                        <br />
                        <span class="description"></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_terms_notice"><?php _e( 'Terms Error Text', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <textarea id="wpc_clients_staff_terms_notice" name="wpc_clients_staff[terms_notice]" style="width: 400px; height: 100px;"><?php echo ( isset( $wpc_clients_staff['terms_notice'] ) && !empty( $wpc_clients_staff['terms_notice'] ) ) ? $wpc_clients_staff['terms_notice'] : __( 'Sorry, you must agree to the Terms/Conditions to continue', WPC_CLIENT_TEXT_DOMAIN ) ?></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'Captcha', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_clients_staff_using_captcha"><?php _e( 'Use Captcha', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[using_captcha]" id="wpc_clients_staff_using_captcha" style="width: 100px;">
                            <option value="no" <?php selected( isset( $wpc_clients_staff['using_captcha'] ) && 'no' == $wpc_clients_staff['using_captcha'] ); ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="yes" <?php selected( isset( $wpc_clients_staff['using_captcha'] ) && 'yes' == $wpc_clients_staff['using_captcha'] ); ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"><?php printf( __( 'Use captcha on %s forms.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?></span>
                    </td>
                </tr>
            </table>
            <table class="form-table" id="captcha_hiding_settings">

                <tr valign="top">
                    <th scope="row">
                        <label><?php _e( 'Use on', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" name="wpc_clients_staff[registration_form_using_captcha]" id="wpc_clients_staff_registration_form_using_captcha" value="yes" <?php checked( isset( $wpc_clients_staff['registration_form_using_captcha'] ) ? $wpc_clients_staff['registration_form_using_captcha'] : '', 'yes' ); ?> />
                            <?php _e( 'Registration Form', WPC_CLIENT_TEXT_DOMAIN ); ?>
                        </label>
                        <br />
                        <label>
                            <input type="checkbox" name="wpc_clients_staff[login_using_captcha]" id="wpc_clients_staff_login_using_captcha" value="yes" <?php checked( isset( $wpc_clients_staff['login_using_captcha'] ) ? $wpc_clients_staff['login_using_captcha'] : '', 'yes' ); ?> />
                            <?php _e( 'Login Forms', WPC_CLIENT_TEXT_DOMAIN ); ?>
                        </label>
                    </td>
                </tr>

                <tr valign="top" class="wpc_recapcha_1" style="display: none;">
                    <th scope="row">
                        <label for="wpc_clients_staff_captcha_publickey"><?php _e( 'Captcha Public Key', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="hidden" name="wpc_clients_staff[captcha_version]" value="<?php echo( isset( $wpc_clients_staff['captcha_version'] ) ? $wpc_clients_staff['captcha_version'] : 'recaptcha_2' ); ?>" />

                        <input type="text" name="wpc_clients_staff[captcha_publickey]" id="wpc_clients_staff_captcha_publickey" value="<?php echo ( isset( $wpc_clients_staff['captcha_publickey'] ) ) ? $wpc_clients_staff['captcha_publickey'] : '' ?>" />
                        <br />
                        <span class="description">
                            (<?php _e( 'leave blank for use default key or Get your Public Key - ', WPC_CLIENT_TEXT_DOMAIN ) ?>
                            <a href="http://www.google.com/recaptcha"> <?php _e( 'Here', WPC_CLIENT_TEXT_DOMAIN ) ?></a>)
                        </span>
                    </td>
                </tr>

                <tr valign="top" class="wpc_recapcha_1" style="display: none;">
                    <th scope="row">
                        <label for="wpc_clients_staff_captcha_privatekey"><?php _e( 'Captcha Private Key', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="wpc_clients_staff[captcha_privatekey]" id="wpc_clients_staff_captcha_privatekey" value="<?php echo ( isset( $wpc_clients_staff['captcha_privatekey'] ) ) ? $wpc_clients_staff['captcha_privatekey'] : '' ?>" />
                        <br />
                        <span class="description">
                            (<?php _e( 'leave blank for use default key or Get your Private Key - ', WPC_CLIENT_TEXT_DOMAIN ) ?>
                            <a href="http://www.google.com/recaptcha"> <?php _e( 'Here', WPC_CLIENT_TEXT_DOMAIN ) ?></a>)
                        </span>
                    </td>
                </tr>

                <tr valign="top" class="wpc_recapcha_2">
                    <th scope="row">
                        <label for="wpc_clients_staff_captcha_publickey_2"><?php _e( 'Captcha Public Key (required)', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="wpc_clients_staff[captcha_publickey_2]" id="wpc_clients_staff_captcha_publickey_2" value="<?php echo ( isset( $wpc_clients_staff['captcha_publickey_2'] ) ) ? $wpc_clients_staff['captcha_publickey_2'] : '' ?>" />
                        <br />
                        <span class="description">
                            (<?php _e( 'Get your Public and Private Key - ', WPC_CLIENT_TEXT_DOMAIN ) ?>
                            <a href="http://www.google.com/recaptcha" target="_blank"> <?php _e( 'Here', WPC_CLIENT_TEXT_DOMAIN ) ?></a>)
                        </span>
                    </td>
                </tr>

                <tr valign="top" class="wpc_recapcha_2">
                    <th scope="row">
                        <label for="wpc_clients_staff_captcha_privatekey_2"><?php _e( 'Captcha Private Key (required)', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="wpc_clients_staff[captcha_privatekey_2]" id="wpc_clients_staff_captcha_privatekey_2" value="<?php echo ( isset( $wpc_clients_staff['captcha_privatekey_2'] ) ) ? $wpc_clients_staff['captcha_privatekey_2'] : '' ?>" />
                    </td>
                </tr>

                <tr valign="top" class="wpc_recapcha_2">
                    <td></td>
                    <td>
                        <div style="display: none;" id="captcha_warning"><?php _e( 'Both fields must be filled!', WPC_CLIENT_TEXT_DOMAIN ) ?></div>
                    </td>
                </tr>

                <tr valign="top" id="block_captcha_theme">
                    <th scope="row">
                        <label for="wpc_clients_staff_captcha_theme"><?php _e( 'Captcha Theme', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_clients_staff[captcha_theme]" id="wpc_clients_staff_captcha_theme" style="width: 100px;">
                            <option value="light" <?php selected( isset( $wpc_clients_staff['captcha_theme'] ) ? $wpc_clients_staff['captcha_theme'] : '', 'light' ); ?> ><?php _e( 'Light', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="dark" <?php selected( isset( $wpc_clients_staff['captcha_theme'] ) ? $wpc_clients_staff['captcha_theme'] : '', 'dark' ); ?> ><?php _e( 'Dark', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>

                <tr valign="top" style="height: 161px;">
                    <th>
                        <label><?php _e( 'Preview', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <img src="" alt="recaptcha_theme" id="recaptcha_preview_theme">
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <input type='submit' name='update_settings' id='update_settings' class='button-primary' value='<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
</form>