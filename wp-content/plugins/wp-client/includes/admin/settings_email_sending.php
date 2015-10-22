<?php
 $wpc_email = $this->cc_get_settings( 'email_sending' ); $wpc_email['description_text'] = sprintf( __( 'Use these settings to send %s email notifications.' ), WPC_CLIENT_TEXT_DOMAIN, $this->plugin['title'] ); $settings = $this->mailer()->prepare_settings(); if ( $settings ) { if (is_string($settings)) { $msg = urlencode($settings); do_action( 'wp_client_redirect', get_admin_url(). 'admin.php?page=wpclients_settings&tab=email_sending&msg=' . $msg ); } do_action( 'wp_client_settings_update', $settings, 'email_sending' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=email_sending&msg=u' ); } ?>
    <form method="post">
<?php
 $this->mailer()->get_html_for_sending_settings( $wpc_email ); ?>
        <input type="submit" name="update_settings" class="button-primary" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
    </form>