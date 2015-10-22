<?php
global $wp_roles; $capabilities_maps = $this->acc_get_capabilities_maps(); if ( isset( $_REQUEST['update'] ) && isset( $_REQUEST['wpc_role'] ) && '' != $_REQUEST['wpc_role'] ) { global $wp_roles; $wpc_capabilities = $this->cc_get_settings( 'capabilities' ); foreach ( $capabilities_maps[ $_POST['wpc_role'] ]['variable'] as $cap_key => $cap_val ) { $cap = ( isset( $_POST['capabilities'][$cap_key] ) && true == $_POST['capabilities'][$cap_key] ) ? true : false; $wpc_capabilities[$_POST['wpc_role']][$cap_key] = $cap; } do_action( 'wp_client_settings_update', $wpc_capabilities, 'capabilities' ); $wpc_capabilities = apply_filters( 'wp_client_change_caps', $wpc_capabilities ); $wpc_role = $_POST['wpc_role'] ; if( in_array( $wpc_role, array_keys( $capabilities_maps ) ) ) { $this->added_role( $wpc_role, $wpc_capabilities ); $args = array( 'role' => $wpc_role, 'meta_key' => 'wpc_individual_caps', 'meta_value' => true, 'fields' => 'ID', ); if ( isset( $_POST['wpc_remove_individual'] ) && 1 == $_POST['wpc_remove_individual'] ) { $users_ids = get_users( $args ); foreach ( $users_ids as $user_id ) { $user = new WP_User( $user_id ); foreach ( $wpc_capabilities[ $wpc_role ] as $cap_name => $cap_val ) { $user->remove_cap( $cap_name ) ; } delete_user_meta( $user_id, 'wpc_individual_caps' ); } } else if ( isset( $_POST['individual'] ) ) { $users_ids = get_users( $args ); foreach ( $users_ids as $user_id ) { $user = new WP_User( $user_id ); foreach ( $wpc_capabilities[ $wpc_role ] as $cap_name => $cap_val ) { $user->add_cap( $cap_name, $cap_val ) ; } } } } do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=capabilities&msg=u' ); exit; } ?>

<form action="" method="post" name="wpc_settings" id="wpc_settings" >

    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'Capabilities', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <span class="description">
                <?php
 printf( __( "Use this section to select which capabilities will be granted to each role within %s", WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ); echo '<br>'; _e( 'Individual user capabilities can be modified on a per-user basis from the "Members" menu.', WPC_CLIENT_TEXT_DOMAIN ); ?>
            </span>
            <hr />

            <table class="form-table">
                <tr>
                    <th>
                        <label for="roles"><?php _e( 'Assign Capabilities', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                    </th>
                    <td>
                        <span class="wpc_ajax_loading" style="display: none;" id="wpc_role_loading"></span>
                        <select id="wpc_role" name="wpc_role">
                            <?php foreach ( $capabilities_maps as $role => $map ) { if( isset( $map['variable'] ) && is_array( $map['variable'] ) && count( $map['variable'] ) ) { ?>
                                    <option value="<?php echo $role; ?>"><?php echo isset( $wp_roles->roles[ $role ]['name'] ) ? $wp_roles->roles[ $role ]['name'] : ''; ?></option>
                            <?php } } ?>
                        </select>
                        <span class="description"><?php _e( 'Select the role for which you want to adjust capabilities', WPC_CLIENT_TEXT_DOMAIN ); ?></span>

                        <br /><br />

                        <div id="role111_capabilities"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <label for="wpc_remove_individual" class="wpc_margin_5"><input type="checkbox" name="wpc_remove_individual" id="wpc_remove_individual" value="1" /><span class="description"><?php _e( 'Remove Individual Capabilities', WPC_CLIENT_TEXT_DOMAIN ) ?></span></label>
    <br />
    <br />

    <input type='submit' name='update' id="update" class='button-primary' value='<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
</form>

<script type="text/javascript">

    jQuery( document ).ready( function() {

        //ajax get capabilities
        jQuery.fn.get_capabilities = function () {
            var wpc_role = jQuery( '#wpc_role' ).val();
            jQuery( '#wpc_remove_individual' ).prop("checked", false);
            jQuery( '#wpc_role_loading' ).show();

            jQuery.ajax({
                type        : 'POST',
                dataType    : 'json',
                url         : '<?php echo admin_url() ?>admin-ajax.php',
                data        : 'action=wpc_get_capabilities&wpc_role=' + wpc_role,
                success     : function( response ) {

                    jQuery( '#wpc_role_loading' ).hide();
                    jQuery( '#role111_capabilities' ).html( response.caps );
                }
            });
        }

        //change role
        jQuery( '#wpc_role' ).change( function() {
            jQuery( this ).get_capabilities();
        });

        jQuery( this ).get_capabilities();

    });
</script>