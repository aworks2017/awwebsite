<?php
 if ( isset( $_POST['custom_style'] ) ) { do_action( 'wp_client_settings_update', $_POST['custom_style'], 'custom_style' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=custom_style&msg=u' ); exit; } $wpc_custom_style = $this->cc_get_settings( 'custom_style' ); ?>

<form action="" method="post" name="wpc_settings" id="wpc_settings" >

    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'Custom CSS Style', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <td scope="row">
                        <span class="description"><?php _e( 'This CSS code will be included at all pages on user area in head side.', WPC_CLIENT_TEXT_DOMAIN ) ?> <b><?php _e( 'Be sure that CSS code is valid!', WPC_CLIENT_TEXT_DOMAIN ) ?></b></span>
                        <br>
                        <textarea name="custom_style[style]" cols="70" rows="20"><?php echo ( isset( $wpc_custom_style['style'] ) ) ? $wpc_custom_style['style'] : ''?></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <input type='submit' name='update_settings' class='button-primary' value='<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
</form>