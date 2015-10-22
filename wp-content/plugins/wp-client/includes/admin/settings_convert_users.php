<?php
 global $wpdb; if ( isset( $_POST['update_settings'] ) ) { if ( isset( $_POST['wpc_convert_users'] ) ) { $settings = $_POST['wpc_convert_users']; if ( isset( $settings['role_all'] ) && count( $settings['role_all'] ) ) { foreach( $settings['role_all'] as $key=>$val ) { if( 'yes' == $val ) { unset( $settings['auto_convert_role'][ $key ] ); } } } $settings['client_wpc_circles'] = ( isset( $_POST['client_wpc_circles'] ) ) ? $_POST['client_wpc_circles'] : '' ; $settings['client_wpc_managers'] = ( isset( $_POST['client_wpc_managers'] ) ) ? $_POST['client_wpc_managers'] : '' ; $settings['staff_wpc_clients'] = ( isset( $_POST['staff_wpc_clients'] ) ) ? $_POST['staff_wpc_clients'] : '' ; $settings['manager_wpc_clients'] = ( isset( $_POST['manager_wpc_clients'] ) ) ? $_POST['manager_wpc_clients'] : '' ; $settings['manager_wpc_circles'] = ( isset( $_POST['manager_wpc_circles'] ) ) ? $_POST['manager_wpc_circles'] : '' ; } else { $settings = array(); } do_action( 'wp_client_settings_update', $settings, 'convert_users' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=convert_users&msg=u' ); exit; } $wpc_convert_users = $this->cc_get_settings( 'convert_users' ); $business_name_field = ( isset( $wpc_convert_users['client_business_name_field'] ) ) ? $wpc_convert_users['client_business_name_field'] : '{first_name}' ; $client_wpc_managers = ( isset( $wpc_convert_users['client_wpc_managers'] ) ) ? $wpc_convert_users['client_wpc_managers'] : ''; $staff_wpc_clients = ( isset( $wpc_convert_users['staff_wpc_clients'] ) ) ? $wpc_convert_users['staff_wpc_clients'] : ''; $manager_wpc_clients = ( isset( $wpc_convert_users['manager_wpc_clients'] ) ) ? $wpc_convert_users['manager_wpc_clients'] : ''; $manager_wpc_circles = ( isset( $wpc_convert_users['manager_wpc_circles'] ) ) ? $wpc_convert_users['manager_wpc_circles'] : ''; ?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.wpc_convert_users_auto_convert').change( function(){
            if( jQuery(this).val() == 'no') {
                jQuery( '.auto_convert_table td.' + jQuery( this ).data( 'role' ) + ',.auto_convert_table th.' + jQuery( this ).data( 'role' ) ).hide();
            } else if( jQuery(this).val() == 'yes') {
                jQuery( '.auto_convert_table td.' + jQuery( this ).data( 'role' ) + ',.auto_convert_table th.' + jQuery( this ).data( 'role' ) ).show();
            }


            /*if( jQuery(this).val() == 'no') {
                jQuery(this).parents('.inside').find('.block_for_auto_convert_role').slideUp('high');
            } else if( jQuery(this).val() == 'yes') {
                jQuery(this).parents('.inside').find('.block_for_auto_convert_role').slideDown('high');
            }*/
        });

        /*jQuery('.wpc_convert_users_role_all').change(function(){
            if ( jQuery(this).is(':checked') ) {
                jQuery(this).parents('.inside').find('.role_item').attr( 'checked', true );
            } else{
                jQuery(this).parents('.inside').find('.role_item').attr( 'checked', false );
            }
        });

        jQuery('.role_item').change(function(){
            if ( jQuery(this).is(':checked') ) {
                if( jQuery('.role_item').length == jQuery('.role_item:checked').length )
                    jQuery(this).parents('.inside').find('.wpc_convert_users_role_all').attr( 'checked', true );
            } else{
                jQuery(this).parents('.inside').find('.wpc_convert_users_role_all').attr( 'checked', false );
            }

        }); */



        jQuery( '.role_item.all_roles' ).change( function(){
            jQuery( '.role_item:not(.all_roles)' ).prop( 'checked', false );
        });

        jQuery( '.role_item:not(.all_roles)' ).change( function(){
            jQuery( '.all_roles' ).prop( 'checked', false );
        });



        jQuery('#wpc_settings').submit(function() {
            /*var enabled_array = jQuery(".wpc_convert_users_auto_convert option[value=yes]:selected").parent();

            if( enabled_array.length > 1 ) {
                var roles_count = jQuery( enabled_array[0] ).parents('.inside').find('.role_item').length;
            }

            var checked_count;
            for( var i = 0; i < roles_count; i++ ) {
                checked_count = 0;
                enabled_array.each(function() {
                    if( jQuery( jQuery(this).parents('.inside').find('.role_item').get( i ) ).is(':checked') ) {
                        checked_count++;
                    }
                });
                if( checked_count > 1 ) {
                    alert("<?php _e('Role can not be converted to several WPC Roles', WPC_CLIENT_TEXT_DOMAIN) ?>");
                    return false;
                }
            }

            return true;*/
        });
    });
</script>

<h3 class="hndle"><span><?php _e( 'Convert Users Settings:', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
<form action="" method="post" name="wpc_settings" id="wpc_settings" >

    <div class="postbox">
        <h3 class="hndle"><span><?php printf( __( 'Default Settings for Converting Users to WPC-%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ?></span></h3>
        <div class="inside">
            <table cellspacing="6" style="width: 100%;float:left;">
                <tr>
                    <td style="width: 30%;">
                        <label for="business_name_field"><?php _e( 'Which User Meta Field Use For Business Name', WPC_CLIENT_TEXT_DOMAIN ) ?></label>

                    </td>
                    <td>
                        <input type="text" name="wpc_convert_users[client_business_name_field]" id="business_name_field" value="<?php echo $business_name_field ?>" />
                        <br />
                        <span class="description"><?php _e( 'by default "first_name", or "user_login" if meta values and "first_name" is empty.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;">
                        <label for="wpc_convert_client_create_client_page"><?php printf( __( 'Create automatic %s', WPC_CLIENT_TEXT_DOMAIN ) , $this->custom_titles['portal']['s'] ) ?></label>
                    </td>
                    <td>
                        <select name="wpc_convert_users[client_create_page]" id="wpc_convert_client_create_client_page" style="width: 100px;">
                            <option value="no" <?php echo ( !isset( $wpc_convert_users['client_create_page'] ) || 'yes' != $wpc_convert_users['client_create_page'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="yes" <?php echo ( isset( $wpc_convert_users['client_create_page'] ) && 'yes' == $wpc_convert_users['client_create_page'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="width: 30%;">
                        <label for="wpc_convert_users_client_save_role"><?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                    </td>
                    <td>
                        <select name="wpc_convert_users[client_save_role]" id="wpc_convert_users_client_save_role" style="width: 100px;">
                            <option value="no" <?php echo ( !isset( $wpc_convert_users['client_save_role'] ) || 'yes' != $wpc_convert_users['client_save_role'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="yes" <?php echo ( isset( $wpc_convert_users['client_save_role'] ) && 'yes' == $wpc_convert_users['client_save_role'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <br>
                        <span class="description"><?php printf( __( "If set to Yes, the user's current role will be saved, but user will also take on the characteristics of the %s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;"></td>
                    <td>
                        <?php
 if ( isset( $wpc_convert_users['client_wpc_circles'] ) ) { $client_wpc_circles = $wpc_convert_users['client_wpc_circles'] ; } else { $client_wpc_circles = array(); $groups = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wpc_client_groups ORDER BY group_name ASC", ARRAY_A ); if ( is_array( $groups ) && 0 < count( $groups ) ) { foreach ( $groups as $group ) { if( '1' == $group['auto_select'] ) { $client_wpc_circles[] = $group['group_id']; } } } $client_wpc_circles = implode( ',', $client_wpc_circles ); } ?>

                        <?php
 $link_array = array( 'title' => sprintf( __( 'Select %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Select %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['p'] ), 'data-input' => 'client_wpc_circles' ); $input_array = array( 'name' => 'client_wpc_circles', 'id' => 'client_wpc_circles', 'value' => $client_wpc_circles ); $additional_array = array( 'counter_value' => ( '' != $client_wpc_circles ) ? count( explode( ',', $client_wpc_circles ) ) : 0 ); $this->acc_assign_popup( 'circle', '', $link_array, $input_array, $additional_array ); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;"></td>
                    <td>
                        <?php
 $link_array = array( 'title' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['p'] ), 'text' => __( 'Select', WPC_CLIENT_TEXT_DOMAIN ) . ' ' . $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['manager']['p'], 'data-input' => 'client_wpc_managers' ); $input_array = array( 'name' => 'client_wpc_managers', 'id' => 'client_wpc_managers', 'value' => $client_wpc_managers ); $additional_array = array( 'counter_value' => ( '' != $client_wpc_managers ) ? count( explode( ',', $client_wpc_managers ) ) : 0 ); $this->acc_assign_popup( 'manager', '', $link_array, $input_array, $additional_array ); ?>
                    </td>
                </tr>
                <!--<tr valign="top">
                    <td scope="row">
                        <?php _e( 'Enable Auto-Convert', WPC_CLIENT_TEXT_DOMAIN ) ?>
                    </td>
                    <td>
                        <label>
                            <select name="wpc_convert_users[auto_convert][client]" class="wpc_convert_users_auto_convert" data-role="client" style="width: 100px;">
                                <option value="no" <?php echo ( !isset( $wpc_convert_users['auto_convert']['client'] ) || 'no' == $wpc_convert_users['auto_convert']['client'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                <option value="yes" <?php echo ( isset( $wpc_convert_users['auto_convert']['client'] ) && 'yes' == $wpc_convert_users['auto_convert']['client'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            </select>
                            <br />
                            <span class="description"><?php printf( __( "If set to Yes, this setting will automatically convert any users of the roles selected below into %s. Only applies to new users created in that role.", WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></span>
                        </label>
                    </td>
                </tr>-->
            </table>
            <div class="clear"></div>
            <!--<table class="form-table block_for_auto_convert_role" <?php echo ( !isset( $wpc_convert_users['auto_convert']['client'] ) || 'no' == $wpc_convert_users['auto_convert']['client'] ) ? ' style="display: none;"' : '' ?> >
                <?php $all_convert_role = isset( $wpc_convert_users['role_all']['client'] ) && 'yes' == $wpc_convert_users['role_all']['client']; ?>
                <tr valign="top">
                    <td scope="row" class="auto_convert_role">
                        <?php _e( 'For:', WPC_CLIENT_TEXT_DOMAIN ) ?>
                    </td>
                    <td class="auto_convert_role">
                        <label>
                            <input type="checkbox" name="wpc_convert_users[role_all][client]" class="wpc_convert_users_role_all" value="yes" <?php checked( $all_convert_role ); ?> />
                            <?php _e( 'All', WPC_CLIENT_TEXT_DOMAIN ) ?>
                        </label>
                    </td>
                </tr>
                    <?php
 global $wp_roles; $all_roles = $wp_roles->roles; foreach( $all_roles as $key => $role ) { if( 'wpc_' == substr( $key, 0, 4 ) ) continue; ?>
                            <tr valign="top">
                                <td scope="row" class="auto_convert_role">
                                </td>
                                <td class="auto_convert_role">
                                    <label>
                                        <input class="role_item" type="checkbox" name="wpc_convert_users[auto_convert_role][client][<?php echo $key ?>]" class="wpc_convert_users_<?php echo $key ?>" value="yes" <?php checked( $all_convert_role || isset( $wpc_convert_users['auto_convert_role']['client'][ $key ] ) && 'yes' == $wpc_convert_users['auto_convert_role']['client'][ $key ] ); ?> />
                                        <?php echo $role['name'] ?>
                                    </label>
                                </td>
                            </tr>
                            <?php
 } ?>
            </table> -->
        </div>
    </div>

    <div class="postbox">
        <h3 class='hndle'><span><?php printf( __( 'Default Settings for Converting Users to WPC-%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ) ?></span></h3>
        <div class="inside">
            <table cellspacing="6" style="width: 100%;float:left;">
                <tr>
                    <td valign="top" style="width: 30%;">
                        <label for="wpc_convert_users_staff_save_role"><?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                    </td>
                    <td>
                        <select name="wpc_convert_users[staff_save_role]" id="wpc_convert_users_staff_save_role" style="width: 100px;">
                            <option value="no" <?php echo ( !isset( $wpc_convert_users['staff_save_role'] ) || 'yes' != $wpc_convert_users['staff_save_role'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="yes" <?php echo ( isset( $wpc_convert_users['staff_save_role'] ) && 'yes' == $wpc_convert_users['staff_save_role'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <br>
                        <span class="description"><?php printf( __( "If set to Yes, the user's current role will be saved, but user will also take on the characteristics of the WPC-%s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;"></td>
                    <td>
                        <?php
 $link_array = array( 'title' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'text' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'data-input' => 'staff_wpc_clients', 'data-marks' => 'radio' ); $input_array = array( 'name' => 'staff_wpc_clients', 'id' => 'staff_wpc_clients', 'value' => $staff_wpc_clients ); $additional_array = array( 'counter_value' => ( $staff_wpc_clients ) ? get_userdata( $staff_wpc_clients )->user_login : '' ); $this->acc_assign_popup('client', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                    </td>
                </tr>
                <!--<tr valign="top">
                    <td scope="row">
                        <?php _e( 'Enable Auto-Convert', WPC_CLIENT_TEXT_DOMAIN ) ?>
                    </td>
                    <td>
                        <label>
                            <select name="wpc_convert_users[auto_convert][staff]" class="wpc_convert_users_auto_convert" data-role="staff" style="width: 100px;">
                                <option value="no" <?php echo ( !isset( $wpc_convert_users['auto_convert']['staff'] ) || 'no' == $wpc_convert_users['auto_convert']['staff'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                <option value="yes" <?php echo ( isset( $wpc_convert_users['auto_convert']['staff'] ) && 'yes' == $wpc_convert_users['auto_convert']['staff'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            </select>
                            <br />
                            <span class="description"><?php printf( __( "If set to Yes, this setting will automatically convert any users of the roles selected below into WPC-%s. Only applies to new users created in that role.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) ?></span>
                        </label>
                    </td>
                </tr>-->
            </table>
            <div class="clear"></div>
            <!--<table class="form-table block_for_auto_convert_role" <?php echo ( !isset( $wpc_convert_users['auto_convert']['staff'] ) || 'no' == $wpc_convert_users['auto_convert']['staff'] ) ? ' style="display: none;"' : '' ?> >
                <?php $all_convert_role = isset( $wpc_convert_users['role_all']['staff'] ) && 'yes' == $wpc_convert_users['role_all']['staff']; ?>
                <tr valign="top">
                    <td scope="row" class="auto_convert_role">
                        <?php _e( 'For:', WPC_CLIENT_TEXT_DOMAIN ) ?>
                    </td>
                    <td class="auto_convert_role">
                        <label>
                            <input type="checkbox" name="wpc_convert_users[role_all][staff]" class="wpc_convert_users_role_all" value="yes" <?php checked( $all_convert_role ); ?> />
                            <?php _e( 'All', WPC_CLIENT_TEXT_DOMAIN ) ?>
                        </label>
                    </td>
                </tr>
                    <?php
 global $wp_roles; $all_roles = $wp_roles->roles; foreach( $all_roles as $key => $role ) { if( 'wpc_' == substr( $key, 0, 4 ) ) continue; ?>
                            <tr valign="top">
                                <td scope="row" class="auto_convert_role">
                                </td>
                                <td class="auto_convert_role">
                                    <label>
                                        <input class="role_item" type="checkbox" name="wpc_convert_users[auto_convert_role][staff][<?php echo $key ?>]" class="wpc_convert_users_<?php echo $key ?>" value="yes" <?php checked( $all_convert_role || isset( $wpc_convert_users['auto_convert_role']['staff'][ $key ] ) && 'yes' == $wpc_convert_users['auto_convert_role']['staff'][ $key ] ); ?> />
                                        <?php echo $role['name'] ?>
                                    </label>
                                </td>
                            </tr>
                            <?php
 } ?>
            </table>-->
        </div>
    </div>

    <div class="postbox">
        <h3 class='hndle'><span><?php printf( __( 'Default Settings for Converting Users to WPC-%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['p'] ) ?></span></h3>
        <div class="inside">
            <table cellspacing="6" style="width: 100%;float:left;">
                <tr>
                    <td valign="top" style="width: 30%;">
                        <label for="wpc_convert_users_manager_save_role"><?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                    </td>
                    <td>
                        <select name="wpc_convert_users[manager_save_role]" id="wpc_convert_users_manager_save_role" style="width: 100px;">
                            <option value="no" <?php echo ( !isset( $wpc_convert_users['manager_save_role'] ) || 'yes' != $wpc_convert_users['manager_save_role'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="yes" <?php echo ( isset( $wpc_convert_users['manager_save_role'] ) && 'yes' == $wpc_convert_users['manager_save_role'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <br>
                        <span class="description"><?php printf( __( "If set to Yes, the user's current role will be saved, but user will also take on the characteristics of the WPC-%s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) ?></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;"></td>
                    <td>
                        <?php
 $link_array = array( 'title' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'text' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'data-input' => 'manager_wpc_clients' ); $input_array = array( 'name' => 'manager_wpc_clients', 'id' => 'manager_wpc_clients', 'value' => $manager_wpc_clients ); $additional_array = array( 'counter_value' => ( '' != $manager_wpc_clients ) ? count( explode( ',', $manager_wpc_clients ) ) : 0 ); $this->acc_assign_popup('client', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;"></td>
                    <td>
                        <?php
 $link_array = array( 'title' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ), 'data-input' => 'manager_wpc_circles' ); $input_array = array( 'name' => 'manager_wpc_circles', 'id' => 'manager_wpc_circles', 'value' => $manager_wpc_circles ); $additional_array = array( 'counter_value' => ( '' != $manager_wpc_circles ) ? count( explode( ',', $manager_wpc_circles ) ) : 0 ); $this->acc_assign_popup('circle', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                    </td>
                </tr>
                <!--<tr valign="top">
                    <td scope="row">
                        <?php _e( 'Enable Auto-Convert', WPC_CLIENT_TEXT_DOMAIN ) ?>
                    </td>
                    <td>
                        <label>
                            <select name="wpc_convert_users[auto_convert][manager]" class="wpc_convert_users_auto_convert" data-role="manager" style="width: 100px;">
                                <option value="no" <?php echo ( !isset( $wpc_convert_users['auto_convert']['manager'] ) || 'no' == $wpc_convert_users['auto_convert']['manager'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                <option value="yes" <?php echo ( isset( $wpc_convert_users['auto_convert']['manager'] ) && 'yes' == $wpc_convert_users['auto_convert']['manager'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            </select>
                            <br />
                            <span class="description"><?php printf( __( "If set to Yes, this setting will automatically convert any users of the roles selected below into WPC-%s. Only applies to new users created in that role.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) ?></span>
                        </label>
                    </td>
                </tr>-->
            </table>
            <div class="clear"></div>
            <!--<table class="form-table block_for_auto_convert_role" <?php echo ( !isset( $wpc_convert_users['auto_convert']['manager'] ) || 'no' == $wpc_convert_users['auto_convert']['manager'] ) ? ' style="display: none;"' : '' ?> >
                <?php $all_convert_role = isset( $wpc_convert_users['role_all']['manager'] ) && 'yes' == $wpc_convert_users['role_all']['manager']; ?>
                <tr valign="top">
                    <td scope="row" class="auto_convert_role">
                        <?php _e( 'For:', WPC_CLIENT_TEXT_DOMAIN ) ?>
                    </td>
                    <td class="auto_convert_role">
                        <label>
                            <input type="checkbox" name="wpc_convert_users[role_all][manager]" class="wpc_convert_users_role_all" value="yes" <?php checked( $all_convert_role ); ?> />
                            <?php _e( 'All', WPC_CLIENT_TEXT_DOMAIN ) ?>
                        </label>
                    </td>
                </tr>
                    <?php
 global $wp_roles; $all_roles = $wp_roles->roles; foreach( $all_roles as $key => $role ) { if( 'wpc_' == substr( $key, 0, 4 ) ) continue; ?>
                            <tr valign="top">
                                <td scope="row" class="auto_convert_role">
                                </td>
                                <td class="auto_convert_role">
                                    <label>
                                        <input class="role_item" type="checkbox" name="wpc_convert_users[auto_convert_role][manager][<?php echo $key ?>]" class="wpc_convert_users_<?php echo $key ?>" value="yes" <?php checked( $all_convert_role || isset( $wpc_convert_users['auto_convert_role']['manager'][ $key ] ) && 'yes' == $wpc_convert_users['auto_convert_role']['manager'][ $key ] ); ?> />
                                        <?php echo $role['name'] ?>
                                    </label>
                                </td>
                            </tr>
                            <?php
 } ?>
            </table>-->
        </div>
    </div>

    <div class="postbox">
        <h3 class='hndle'><span><?php printf( __( 'Default Settings for Converting Users to WPC-%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['p'] ) ?></span></h3>
        <div class="inside">
            <table cellspacing="6" style="width: 100%;float:left;">
                <tr>
                    <td valign="top" style="width: 30%;">
                        <label for="wpc_convert_users_admin_save_role"><?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                    </td>
                    <td>
                        <select name="wpc_convert_users[admin_save_role]" id="wpc_convert_users_admin_save_role" style="width: 100px;">
                            <option value="no" <?php echo ( !isset( $wpc_convert_users['admin_save_role'] ) || 'yes' != $wpc_convert_users['admin_save_role'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="yes" <?php echo ( isset( $wpc_convert_users['admin_save_role'] ) && 'yes' == $wpc_convert_users['admin_save_role'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <br>
                        <span class="description"><?php printf( __( "If set to Yes, the user's current role will be saved, but user will also take on the characteristics of the WPC-%s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) ?></span>
                    </td>
                </tr>
                <!--<tr valign="top">
                    <td scope="row">
                        <?php _e( 'Enable Auto-Convert', WPC_CLIENT_TEXT_DOMAIN ) ?>
                    </td>
                    <td>
                        <label>
                            <select name="wpc_convert_users[auto_convert][admin]" class="wpc_convert_users_auto_convert" data-role="admin" style="width: 100px;">
                                <option value="no" <?php echo ( !isset( $wpc_convert_users['auto_convert']['admin'] ) || 'no' == $wpc_convert_users['auto_convert']['admin'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                <option value="yes" <?php echo ( isset( $wpc_convert_users['auto_convert']['admin'] ) && 'yes' == $wpc_convert_users['auto_convert']['admin'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            </select>
                            <br />
                            <span class="description"><?php printf( __( "If set to Yes, this setting will automatically convert any users of the roles selected below into WPC-%s. Only applies to new users created in that role.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['p'] ) ?></span>
                        </label>
                    </td>
                </tr>-->
            </table>
            <div class="clear"></div>
            <!--<table class="form-table block_for_auto_convert_role" <?php echo ( !isset( $wpc_convert_users['auto_convert']['admin'] ) || 'no' == $wpc_convert_users['auto_convert']['admin'] ) ? ' style="display: none;"' : '' ?> >
                <?php $all_convert_role = isset( $wpc_convert_users['role_all']['admin'] ) && 'yes' == $wpc_convert_users['role_all']['admin']; ?>
                <tr valign="top">
                    <td scope="row" class="auto_convert_role">
                        <?php _e( 'For:', WPC_CLIENT_TEXT_DOMAIN ) ?>
                    </td>
                    <td class="auto_convert_role">
                        <label>
                            <input type="checkbox" name="wpc_convert_users[role_all][admin]" class="wpc_convert_users_role_all" value="yes" <?php checked( $all_convert_role ); ?> />
                            <?php _e( 'All', WPC_CLIENT_TEXT_DOMAIN ) ?>
                        </label>
                    </td>
                </tr>
                    <?php
 global $wp_roles; $all_roles = $wp_roles->roles; foreach( $all_roles as $key => $role ) { if( 'wpc_' == substr( $key, 0, 4 ) ) continue; ?>
                            <tr valign="top">
                                <td scope="row" class="auto_convert_role">
                                </td>
                                <td class="auto_convert_role">
                                    <label>
                                        <input class="role_item" type="checkbox" name="wpc_convert_users[auto_convert_role][admin][<?php echo $key ?>]" class="wpc_convert_users_<?php echo $key ?>" value="yes" <?php checked( $all_convert_role || isset( $wpc_convert_users['auto_convert_role']['admin'][ $key ] ) && 'yes' == $wpc_convert_users['auto_convert_role']['admin'][ $key ] ); ?> />
                                        <?php echo $role['name'] ?>
                                    </label>
                                </td>
                            </tr>
                            <?php
 } ?>
            </table>-->
        </div>
    </div>

    <?php $auto_convert_roles = array(); $wpc_roles = array( 'client' => sprintf( __( 'WPC-%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'staff' => sprintf( __( 'WPC-%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ), 'manager' => sprintf( __( 'WPC-%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['p'] ), 'admin' => sprintf( __( 'WPC-%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['p'] ) ); ?>
    <div class="postbox">
        <h3 class="hndle"><span><?php _e( 'Auto Convert Roles', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <span class="description"><?php echo __( "Use the settings below to setup the plugin to automatically convert newly registered users into WP-Client roles. You can \"enable\" the four main WP-Client roles, and that will make them selectable in the grid below. From there, you can set specific non-WP-Client user roles to be automatically converted into WP-Client roles when registered. These settings will only apply to new users that are registered with the below roles. Existing users will not be affected, regardless of role.", WPC_CLIENT_TEXT_DOMAIN ) ?></span>
            <table cellspacing="6" style="float:left;width:100%;margin-top: 10px;">
                <?php foreach( $wpc_roles as $role=>$title ) { ?>
                <tr valign="top">
                    <td scope="row" style="width:30%;">
                        <?php echo __( 'Enable Auto-Convert to ', WPC_CLIENT_TEXT_DOMAIN ) . $title ?>
                    </td>
                    <td>
                        <label>
                            <select name="wpc_convert_users[auto_convert][<?php echo $role ?>]" class="wpc_convert_users_auto_convert" data-role="<?php echo $role ?>" style="width: 100px;">
                                <option value="no" <?php echo ( !isset( $wpc_convert_users['auto_convert'][$role] ) || 'no' == $wpc_convert_users['auto_convert'][$role] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                <option value="yes" <?php echo ( isset( $wpc_convert_users['auto_convert'][$role] ) && 'yes' == $wpc_convert_users['auto_convert'][$role] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            </select>
                        </label>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <table cellspacing="6" style="width: 100%;" class="auto_convert_table">
                <thead>
                    <tr>
                        <th></th>
                        <?php foreach( $wpc_roles as $role=>$title ) { $hide = ''; if( !isset( $wpc_convert_users['auto_convert'][$role] ) || ( isset( $wpc_convert_users['auto_convert'][$role] ) && 'no' == $wpc_convert_users['auto_convert'][$role] ) ) { $hide = "display:none;"; } ?>
                            <th class="<?php echo $role ?>" style="<?php echo $hide ?>"><?php echo $title ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr valign="top">
                        <th scope="row" class="auto_convert_role" style="text-align: left !important;">
                            <?php _e( 'All', WPC_CLIENT_TEXT_DOMAIN ) ?>
                        </th>
                        <?php foreach( $wpc_roles as $role=>$title ) { $hide = ''; if( !isset( $wpc_convert_users['auto_convert'][$role] ) || ( isset( $wpc_convert_users['auto_convert'][$role] ) && 'no' == $wpc_convert_users['auto_convert'][$role] ) ) { $hide = "display:none;"; } ?>
                            <td class="auto_convert_role <?php echo $role ?>" style="text-align: center !important; <?php echo $hide ?>">
                                <input class="role_item all_roles" type="radio" name="wpc_convert_users[auto_convert_role][role_all]" value="wpc_<?php echo $role ?>" class="wpc_convert_users_<?php echo $key ?>" <?php checked( isset( $wpc_convert_users['auto_convert_role']['role_all'] ) && $wpc_convert_users['auto_convert_role']['role_all'] == 'wpc_' . $role ) ?> />
                            </td>
                        <?php } ?>
                    </tr>
                    <?php global $wp_roles; $all_roles = $wp_roles->roles; foreach( $all_roles as $key=>$role ) { if( 'wpc_' == substr( $key, 0, 4 ) ) continue; ?>
                        <tr valign="top">
                            <th scope="row" class="auto_convert_role" style="text-align: left !important;">
                                <?php echo $role['name'] ?>
                            </th>

                            <?php foreach( $wpc_roles as $role=>$title ) { $hide = ''; if( !isset( $wpc_convert_users['auto_convert'][$role] ) || ( isset( $wpc_convert_users['auto_convert'][$role] ) && 'no' == $wpc_convert_users['auto_convert'][$role] ) ) { $hide = "display:none;"; } ?>
                                <td class="auto_convert_role <?php echo $role ?>" style="text-align: center !important; <?php echo $hide ?>">
                                    <input class="role_item" type="radio" name="wpc_convert_users[auto_convert_role][<?php echo $key ?>]" value="wpc_<?php echo $role ?>" class="wpc_convert_users_<?php echo $key ?>" <?php checked( isset( $wpc_convert_users['auto_convert_role'][$key] ) && $wpc_convert_users['auto_convert_role'][$key] == 'wpc_' . $role ) ?> />
                                </td>
                            <?php } ?>
                        </tr>
                        <?php
 } ?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>
    </div>

    <input type='submit' name='update_settings' id="wpc_submit_button" class='button-primary' value='<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
</form>