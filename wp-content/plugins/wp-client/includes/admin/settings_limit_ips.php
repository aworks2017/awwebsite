<?php
 if ( isset( $_POST['update_settings'] ) ) { if ( isset( $_POST['wpc_limit_ips'] ) ) { $settings = $_POST['wpc_limit_ips']; if( isset( $settings['ips'] ) && is_array( $settings['ips'] ) ) { foreach( $settings['ips'] as $key=>$ip ) { $valid = preg_match( '/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/', $ip ); if( !$valid || $ip == '0.0.0.0' ) { unset( $settings['ips'][$key] ); } } } } else { $settings = array(); } do_action( 'wp_client_settings_update', $settings, 'limit_ips' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=limit_ips&msg=u' ); exit; } $wpc_limit_ips = $this->cc_get_settings( 'limit_ips' ); $wpc_currency = $this->cc_get_settings( 'currency' ); ?>

<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery( "#wpc_add_ip_field" ).on( 'click', function() {
            jQuery( ".wpc_ip_field:last" ).after( '<span class="wpc_ip_field"><input type="text" name="wpc_limit_ips[ips][]" class="ips" value="" /><span style="float:left;margin-left: 10px;"><a href="javasctipt:;" class="wpc_delete_ip_field"><?php _e( 'Delete', WPC_CLIENT_TEXT_DOMAIN ) ?></a></span></span>' );
        });

        jQuery( "#wpc_settings" ).on( 'click', '.wpc_delete_ip_field', function() {
            jQuery( this ).parents( '.wpc_ip_field' ).remove();
        });

        jQuery( "#wpc_settings" ).on( 'keypress', '.ips', function(e) {
            if( ( ( e.which == 0 || e.which == 8 ) && jQuery( this ).val().length > 0 ) || ( e.which == 46 || ( e.which > 47 && e.which < 58 ) ) ) {
                return true;
            }
            return false;
        });

        jQuery( "#wpc_settings" ).on( 'change', '.ips', function() {
            if( ValidateIPaddress( jQuery( this ).val() ) ) {
                jQuery(this).css( 'border-color', '#ddd' );
            } else {
                jQuery(this).css( 'border-color', 'red' );
            }
        });

        jQuery( "#enable_limit" ).change( function() {

            if( jQuery( this ).val() == 'yes' ) {
                jQuery( this ).parents( 'tr' ).siblings( 'tr:last' ).slideDown('slow');
            } else {
                jQuery( this ).parents( 'tr' ).siblings( 'tr:last' ).slideUp('slow');
            }
        });

        jQuery( "#enable_limit" ).trigger('change');

    });

    function ValidateIPaddress( ip_address ) {
        var ip_format = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
        if( ip_address.match( ip_format ) && ip_address != '0.0.0.0' ) {
            return true;
        }
        return false;
    }
</script>

<form action="" method="post" name="wpc_settings" id="wpc_settings" >

    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'IP Restriction Settings', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="enable_limit"><?php _e( 'Restrict access to the site by IP', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_limit_ips[enable_limit]" id="enable_limit" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_limit_ips['enable_limit'] ) && $wpc_limit_ips['enable_limit'] == 'yes' ) ? "selected" : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !isset( $wpc_limit_ips['enable_limit'] ) || ( isset( $wpc_limit_ips['enable_limit'] ) && $wpc_limit_ips['enable_limit'] == 'no' ) ) ? "selected" : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>

                <tr valign="top" <?php if( !( isset( $wpc_limit_ips['ips'] ) && is_array( $wpc_limit_ips['ips'] ) && 0 < count( $wpc_limit_ips['ips'] ) ) ) { ?> style="display:none;" <?php } ?>>
                    <th scope="row">
                        <label for="ips"><?php _e( 'Allowed IP Addresses', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <?php if( isset( $wpc_limit_ips['ips'] ) && is_array( $wpc_limit_ips['ips'] ) && 0 < count( $wpc_limit_ips['ips'] ) ) { $count = 0; foreach( $wpc_limit_ips['ips'] as $key=>$ip ) { $count++; ?>
                                <span class="wpc_ip_field">
                                    <input type="text" name="wpc_limit_ips[ips][]" class="ips" value="<?php echo ( isset( $ip ) && !empty( $ip ) ) ? $ip : '' ?>" style="float:left;"/>
                                    <?php if( $count > '1' ) { ?>
                                        <span style="float:left;margin-left: 10px;"><a href="javasctipt:;" class="wpc_delete_ip_field"><?php _e( 'Delete', WPC_CLIENT_TEXT_DOMAIN ) ?></a></span>
                                    <?php } ?>
                                </span>
                            <?php } } else { ?>
                            <span class="wpc_ip_field"><input type="text" name="wpc_limit_ips[ips][]" class="ips" value="" /></span>
                        <?php } ?>

                        <span style="float: left;width: 100%;"><a href="javascript:;" id="wpc_add_ip_field"><?php _e( 'Add new IP', WPC_CLIENT_TEXT_DOMAIN ) ?></a></span>
                    </td>
                </tr>

            </table>
        </div>
    </div>

    <input type="submit" name="update_settings" class="button-primary" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
</form>