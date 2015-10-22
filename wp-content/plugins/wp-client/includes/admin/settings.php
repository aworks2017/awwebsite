<?php
 ?>

<style type="text/css">
    .wrap input[type=text] {
        width:400px;
    }

    .wrap input[type=password] {
        width:400px;
    }

    #captcha_warning,
    #filesize_warning {
        background-color: #FFFFE0;
        border-color: #E6DB55;
        border-radius: 3px 3px 3px 3px;
        border-style: solid;
        border-width: 1px;
        color: #000000;
        font-family: sans-serif;
        font-size: 12px;
        line-height: 1.4em;
        padding: 12px;
    }

</style>

<div class='wrap'>

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <?php if ( isset( $_GET['msg'] ) && !empty( $_GET['msg'] ) ) { ?>
        <div id="message" class="<?php echo ( 't' == $_GET['msg'] || 'pc' == $_GET['msg'] || 'pu' == $_GET['msg'] || 'u' == $_GET['msg'] || 'ps' == $_GET['msg'] ) ? 'updated' : 'error' ?> wpc_notice fade">
            <p>
            <?php
 switch( $_GET['msg'] ) { case 'u': _e( 'Settings Updated.', WPC_CLIENT_TEXT_DOMAIN ); break; case 'cl_url': _e( 'Login URL used default names of Wordpress. Settings are not updated.', WPC_CLIENT_TEXT_DOMAIN ); break; case 'pu': _e( 'Pages Updated Successfully.', WPC_CLIENT_TEXT_DOMAIN ); break; case 'pc': _e( 'Pages Created Successfully', WPC_CLIENT_TEXT_DOMAIN ); break; case 'ps': _e( 'You are skipped auto-install pages - please do it manually.', WPC_CLIENT_TEXT_DOMAIN ); break; case 't': _e( 'Import was successful', WPC_CLIENT_TEXT_DOMAIN ); break; case 'f': _e( 'Invalid *.xml file', WPC_CLIENT_TEXT_DOMAIN ); break; case 'pr_ng': _e( 'Note: The registration will not work until you select "Payment Gateways". Clients will see a message that "Registration temporarily unavailable".', WPC_CLIENT_TEXT_DOMAIN ); break; case 'pr_f': _e( 'Invalid settings', WPC_CLIENT_TEXT_DOMAIN ); break; case 'pr_na': _e( 'Not all registration levels was saved', WPC_CLIENT_TEXT_DOMAIN ); break; case 'nk': _e( 'Public or(and) Privat Key is empty.', WPC_CLIENT_TEXT_DOMAIN ); break; default: echo stripslashes(urldecode($_GET['msg'])); } ?>
            </p>
        </div>
    <?php } ?>

    <div class="icon32" id="icon-options-general"></div>
    <h2><?php printf( __( '%s Settings', WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></h2>

    <p><?php printf( __( 'From here you can manage a variety of options for the %s plugin.', WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></p>

    <div style="width: 100%;">
        <ul id="tab-headers">
            <?php
 $tabs = $this->get_tabs_of_settings(); $current_tab = ( empty( $_GET['tab'] ) ) ? 'general' : urldecode( $_GET['tab'] ); foreach ( $tabs as $name => $label ) { $active = ( $current_tab == $name ) ? 'class="active"' : ''; echo '<li ' . $active . '><a href="' . admin_url( 'admin.php?page=wpclients_settings&tab=' . $name ) . '" >' . $label . '</a></li>'; } do_action( 'wpc_client_settings_tabs' ); ?>
            </ul>
        <div id="tab-container">
            <?php
 switch ( $current_tab ) { case "general": include_once( $this->plugin_dir . 'includes/admin/settings_general.php' ); break; case "clients_staff": include_once( $this->plugin_dir . 'includes/admin/settings_clients_staff.php' ); break; case "file_sharing": include_once( $this->plugin_dir . 'includes/admin/settings_file_sharing.php' ); break; case "about": include_once( $this->plugin_dir . 'includes/admin/settings_about.php' ); break; case "business_info": include_once( $this->plugin_dir . 'includes/admin/settings_business_info.php' ); break; case "login_alerts": include_once( $this->plugin_dir . 'includes/admin/settings_login_alerts.php' ); break; case "skins": include_once( $this->plugin_dir . 'includes/admin/settings_skins.php' ); break; case "pages": include_once( $this->plugin_dir . 'includes/admin/settings_pages.php' ); break; case "capabilities": include_once( $this->plugin_dir . 'includes/admin/settings_capabilities.php' ); break; case "custom_titles": include_once( $this->plugin_dir . 'includes/admin/settings_custom_titles.php' ); break; case "custom_login": include_once( $this->plugin_dir . 'includes/admin/settings_custom_login.php' ); break; case "custom_style": include_once( $this->plugin_dir . 'includes/admin/settings_custom_style.php' ); break; case "default_redirects": include_once( $this->plugin_dir . 'includes/admin/settings_login_logout.php' ); break; case "email_sending": include_once( $this->plugin_dir . 'includes/admin/settings_email_sending.php' ); break; case "import_export": include_once( $this->plugin_dir . 'includes/admin/settings_import_export.php' ); break; case "limit_ips": include_once( $this->plugin_dir . 'includes/admin/settings_limit_ips.php' ); break; case "convert_users": include_once( $this->plugin_dir . 'includes/admin/settings_convert_users.php' ); break; default: do_action( 'wpc_client_settings_tabs_' . $current_tab ); break; } ?>
        </div>
    </div>
</div>