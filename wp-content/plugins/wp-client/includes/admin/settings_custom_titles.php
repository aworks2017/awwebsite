<?php
 if ( isset( $_REQUEST['update'] ) ) { if ( isset( $_REQUEST['custom_titles'] ) && is_array( $_REQUEST['custom_titles'] ) ) { $ct = $_REQUEST['custom_titles']; foreach( $this->default_titles as $key => $values ) { $custom_titles[$key]['s'] = ( isset( $ct[$key]['s'] ) && '' != $ct[$key]['s'] ) ? $ct[$key]['s'] : $values['s']; $custom_titles[$key]['p'] = ( isset( $ct[$key]['p'] ) && '' != $ct[$key]['p'] ) ? $ct[$key]['p'] : $values['p']; } } else { $custom_titles = $this->default_titles; } do_action( 'wp_client_settings_update', $custom_titles, 'custom_titles' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=custom_titles&msg=u' ); exit; } $wpc_custom_titles = $this->cc_get_settings( 'custom_titles' ); $wpc_custom_titles = ( is_array( $wpc_custom_titles ) ) ? array_merge( $this->default_titles, $wpc_custom_titles ) : $this->default_titles; ?>

<form action="" method="post" name="wpc_settings" id="wpc_settings" >

    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'Custom Titles', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <span class="description"><?php _e( "Use the fields below to change the default text that is used for various aspects of the plugin, such as user role titles.", WPC_CLIENT_TEXT_DOMAIN ) ?></span>
            <hr />

            <table class="form-table">
            <?php foreach( $wpc_custom_titles as $key => $values ) { ?>
                <tr valign="top">

                    <th scope="row">
                        <b><?php echo ucwords( str_replace( array('_'), ' ', $key ) ) ?>:</b>
                    </th>
                    <td>&nbsp;</td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="<?php echo $key ?>_s"><span class="description"><?php _e( 'Singular:', WPC_CLIENT_TEXT_DOMAIN ) ?></span></label>
                    </th>
                    <td>
                        <input type="text" name="custom_titles[<?php echo $key ?>][s]" id="<?php echo $key ?>_s" value="<?php echo $values['s'] ?>" />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="<?php echo $key ?>_p"><span class="description"><?php _e( 'Plural:', WPC_CLIENT_TEXT_DOMAIN ) ?></span></label>
                    </th>
                    <td>
                        <input type="text" name="custom_titles[<?php echo $key ?>][p]" id="<?php echo $key ?>_p" value="<?php echo $values['p'] ?>" />
                    </td>
                </tr>
            <?php } ?>
            </table>
        </div>
    </div>
    <input type='submit' name='update' id="update" class='button-primary' value='<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
</form>