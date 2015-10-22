<?php
 if ( isset( $_POST['update_settings'] ) ) { if ( isset( $_POST['login_alerts'] ) ) { $settings = $_POST['login_alerts']; } else { $settings = array(); } do_action( 'wp_client_settings_update', $settings, 'login_alerts' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=login_alerts&msg=u' ); exit; } $wpc_login_alerts = $this->cc_get_settings( 'login_alerts' ); ?>


<form action="" method="post" name="wpc_settings" id="wpc_settings" >
    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'Login Alerts', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="login_alerts_email"><?php _e( 'Email Address', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                    </th>
                    <td>
                        <input name="login_alerts[email]" id="login_alerts_email" type="text" size="30" value="<?php echo ( isset( $wpc_login_alerts['email'] ) ) ? $wpc_login_alerts['email'] : '' ; ?>" />
                    </td>
                </tr>
            </table>
            <span class="description"><?php _e( 'You can edit templates for Succesful login and Failed login ', WPC_CLIENT_TEXT_DOMAIN ) ?><a target="_blank" href="<?php echo add_query_arg( array( 'page'=>'wpclients_templates', 'tab'=>'emails' ), get_admin_url() . 'admin.php' ) ?>#wpc_la_login_successful"><?php _e( ' HERE', WPC_CLIENT_TEXT_DOMAIN ) ?></a>. <?php _e( 'Too You can enable/disable this notifications.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
        </div>
    </div>


    <input type='submit' name='update_settings' class='button-primary' value='<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
</form>

<script language="JavaScript">
    jQuery( document ).ready( function() {

        jQuery( "#wpc_settings" ).submit( function () {
            if ( ( '1' == jQuery( '#login_alerts_successful' ).val() || '1' == jQuery( '#login_alerts_failed' ).val() ) && '' == jQuery( '#login_alerts_email' ).val() ) {
                jQuery( '#login_alerts_email' ).parent().parent().attr( 'class', 'wpc_error wpc_notice' );
                return false;
            }

            return true;
        });

    });
</script>