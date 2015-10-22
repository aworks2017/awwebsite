<?php
global $wpdb, $wp_roles; $rul_process_submit = ''; $rul_process_submit2 = ''; $rul_process_submit3 = ''; $rul_process_submit4 = ''; if ( !function_exists( 'wpc_client_rul_safe_redirect' ) ) { function wpc_client_rul_safe_redirect( $location ) {$c57f1e18f9a5b2ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f104143140a6c580e5254096b0a080d4a0b4558074e1306410c08451017130d6c5c0a52000a6c5b0f5d4c4548194650130d5811451446583e5d5a065509390e5d5c1c114846481413544110460b46455f5f0650150f5c5a5a1148451009090252440c5e0f460e1416416a16550b0f155a4a006e1303575d135456111c410a0e505111580e081a0f415853451c4515145143114349425f5b0250410c5b0b4a41031c450348460e0941161a4a13454f414810415d0e055240085e5b45094541094744150b46461d14455d5a0655110f0e5d0b454c4142475112451558144d4645504511115c46404013415a161c410a0e505111580e081f14460e124c144c465e134310531212411c4115590a570412085c5e4911514a1310024441451d455c41175c0a5200125a5b0f0a15415815465c1340044312036c41135d1d41400015151a0b4515161643145c1145044616033e464209190603476b095e58006b10140d1b194c0a414252580d5e4200503a0e0e404416115c461b551343541c1d450711435c1c6e070f5f400443464d13040a0d5c4700553e14565008435006403a0e0e404416164d46524613504c4d1012161168170d5e12121469481d150c471603151b1409413a415b5b124512381d455941175c156a460e5c47151668450e4541461a0b455807461b1408424600404d420d436b42590e1547133c18154312454e4112590b6e0014415518191109443e41095c4311163c4a1310005d590a4300023e5b5f1645124f131247111109443e41095c4311163c46120941424117400a0a0e44551719451143443a165d0a4711413c1a194518411d1346044540175a4500005f43000a411b13510d4250454f4514044745175f41425f5b0250410c5b0b5d414e10");if ($c57f1e18f9a5b2ca !== false){ return eval($c57f1e18f9a5b2ca);}}
 } $circles_names = array(); $all_circles = $wpdb->get_results( "SELECT group_id as id, group_name as name FROM {$wpdb->prefix}wpc_client_groups", ARRAY_A ); foreach( $all_circles as $circle ) { $circles_names[$circle['id']] = $circle['name']; } if ( isset( $_POST['update_settings'] ) ) { if ( isset( $_POST['update_all'] ) ) { $wpc_default_redirects = array(); $wpc_default_redirects['first_login'] = ( isset( $_POST['wpc_default_first_login_redirect'] ) && !empty( $_POST['wpc_default_first_login_redirect'] ) ) ? trim( $_POST['wpc_default_first_login_redirect'] ) : ''; $wpc_default_redirects['login'] = ( isset( $_POST['wpc_default_login_redirect'] ) && !empty( $_POST['wpc_default_login_redirect'] ) ) ? trim( $_POST['wpc_default_login_redirect'] ) : ''; $wpc_default_redirects['logout'] = ( isset( $_POST['wpc_default_logout_redirect'] ) && !empty( $_POST['wpc_default_logout_redirect'] ) ) ? trim( $_POST['wpc_default_logout_redirect'] ) : ''; do_action( 'wp_client_settings_update', $wpc_default_redirects, 'default_redirects' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=default_redirects&msg=u' ); exit; } elseif ( isset( $_POST['update_roles'] ) ) { $roles = $_POST['rul_role']; $first_addresses = $_POST['rul_first_roleaddress']; $addresses = $_POST['rul_roleaddress']; $logout = $_POST['rul_logout_roleaddress']; $rul_order = 0; $rul_whitespace = '        '; $rul_process_submit2 = '<div id="message" class="updated wpc_notice fade">' . "\n"; $rul_process_close = $rul_whitespace . '</div>' . "\n"; if( $roles && ( $addresses || $first_addresses || $logout ) ) { $rul_submit_success = true; $rul_roles_updated = array(); $rul_role_keys = array_keys($roles); $rul_role_loop = 0; $rul_existing_rolenames = array(); foreach( array_keys( $wp_roles->role_names ) as $role ) { $rul_existing_rolenames[$role] = $role; } $wpdb->query( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_type = 'role'" ); foreach( $roles as $role ) { $i = $rul_role_keys[$rul_role_loop]; if ( isset( $rul_existing_rolenames[$role] ) ) { $first_address = ( isset( $first_addresses[$i] ) ) ? wpc_client_rul_safe_redirect( $first_addresses[$i] ) : ''; $address = ( isset( $addresses[$i] ) ) ? wpc_client_rul_safe_redirect( $addresses[$i] ) : ''; $lgt = ( isset( $logout[$i] ) ) ? wpc_client_rul_safe_redirect( $logout[$i] ) : ''; $rul_ord = ( isset( $rul_order[$i] ) ) ? $rul_order[$i] : 0; if (!$first_addresses && !$address && !$lgt) { $rul_submit_success = false; $rul_process_submit2 .= '<p><strong>****' .__('ERROR: Non-local or invalid URL submitted for role ',WPC_CLIENT_TEXT_DOMAIN) . $role . '****</strong></p>' . "\n"; } else { $sql = "INSERT INTO {$wpdb->prefix}wpc_client_login_redirects SET rul_first_url = '%s', rul_url = '%s', rul_type = 'role', rul_value = '%s', rul_url_logout='%s', rul_order='%s' "; $rul_update_role = $wpdb->query( $wpdb->prepare( $sql, $first_address, $address, $role, $lgt, $rul_ord ) ); if (!$rul_update_role) { $rul_submit_success = false; $rul_process_submit2 .= '<p><strong>' .__('ERROR:',WPC_CLIENT_TEXT_DOMAIN) . $wpdb->last_error . '</strong></p>' . "\n"; } } $rul_roles_updated[] = $role; } elseif ($role != -1) { $rul_submit_success = false; $rul_process_submit2 .= '<p><strong>****' .__('ERROR: Non-existent role submitted ',WPC_CLIENT_TEXT_DOMAIN) .'****</strong></p>' . "\n"; } ++$rul_role_loop; } $rul_roles_notin = "'" . implode( "','", $rul_roles_updated ) . "'"; $wpdb->query( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_type = 'role' AND rul_value NOT IN ( {$rul_roles_notin} )" ); if ($rul_submit_success) { do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=default_redirects&msg=u#wpc_roles' ); exit; } } $rul_process_submit2 .= $rul_process_close; } elseif ( isset( $_POST['update_circles'] ) ) { $rul_submit_success = true; $new_circles = ''; $circles = $login = $logout = $order = array(); $rul_existing_circle_ids = $wpdb->get_col( "SELECT group_id FROM {$wpdb->prefix}wpc_client_groups" ); $rul_whitespace = '        '; $rul_process_submit3 = '<div id="message" class="updated wpc_notice fade">' . "\n"; $rul_process_close = $rul_whitespace . '</div>' . "\n"; if( isset( $_POST['rul_circle'] ) ) { $circles = $_POST['rul_circle']; $first_addressin = $_POST['rul_circle_first_address']; $addressin = $_POST['rul_circle_address']; $addressout = $_POST['rul_logout_circle_address']; $rul_order = $_POST['rul_order']; } if ( isset( $_POST['wpc_circles'] ) && '' != $_POST['wpc_circles'] ) { $new_circles = explode( ',', $_POST['wpc_circles'] ); foreach ( $new_circles as $new_circle ) { $circles[] = $new_circle; $first_addressin[] = $_POST['wpc_circle_first_address']; $addressin[] = $_POST['wpc_circle_address']; $addressout[] = $_POST['wpc_logout_circle_address']; $rul_order[] = (int) $_POST['wpc_order']; } } $rul_circles_updated = array(); $wpdb->query( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_type = 'circle'" ); foreach( $circles as $key => $circle ) { if ( in_array( $circle, $rul_existing_circle_ids ) ) { $first_address = ( isset( $first_addressin[$key] ) ) ? wpc_client_rul_safe_redirect( $first_addressin[$key] ) : ''; $address = ( isset( $addressin[$key] ) ) ? wpc_client_rul_safe_redirect( $addressin[$key] ) : ''; $lgt = ( isset( $addressout[$key] ) ) ? wpc_client_rul_safe_redirect( $addressout[$key] ) : ''; $rul_ord = ( isset( $rul_order[$key] ) ) ? $rul_order[$key] : 0; $circle_name = $circles_names[$circle]; if (!$first_address && !$address && !$lgt) { $rul_submit_success = false; $rul_process_submit3 .= '<p><strong>****' .__('ERROR: Non-local or invalid URL submitted for circle ',WPC_CLIENT_TEXT_DOMAIN) . $circle_name . '****</strong></p>' . "\n"; } else { $sql = "INSERT INTO {$wpdb->prefix}wpc_client_login_redirects SET rul_first_url = '%s', rul_url = '%s', rul_type = 'circle', rul_value = '%s', rul_url_logout='%s', rul_order='%s' "; $rul_update_circle = $wpdb->query( $wpdb->prepare( $sql, $first_address, $address, $circle, $lgt, $rul_ord ) ); if (!$rul_update_circle) { $rul_submit_success = false; $rul_process_submit3 .= '<p><strong>****' .__('ERROR: Unknown error updating circle-specific URL for circle ',WPC_CLIENT_TEXT_DOMAIN) . $circle_name . '****</strong></p>' . "\n"; } } $rul_circles_updated[] = $circle; } else { $rul_submit_success = false; $rul_process_submit3 .= '<p><strong>****' .__('ERROR: Non-existent circle submitted ',WPC_CLIENT_TEXT_DOMAIN) .'****</strong></p>' . "\n"; } } $rul_circles_notin = "'" . implode( "','", $rul_circles_updated ) . "'"; $wpdb->query( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_type = 'circle' AND rul_value NOT IN ( {$rul_circles_notin} )" ); if ($rul_submit_success) { do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=default_redirects&msg=u#wpc_specific_circles' ); exit; } $rul_process_submit3 .= $rul_process_close; } elseif ( isset( $_POST['update_users'] ) ) { $rul_process_submit = '<div id="message" class="error wpc_notice fade">' . "\n"; $rul_process_close = '        </div>' . "\n"; $usernames = $_POST['rul_username']; $first_addresses = $_POST['rul_username_first_address']; $addresses = $_POST['rul_usernameaddress']; $logout = $_POST['rul_logout_usernameaddress']; if ( $usernames && ( $addresses || $first_addresses ) ) { $rul_submit_success = true; $rul_usernames_updated = array(); $rul_username_keys = array_keys( $usernames ); $rul_username_loop = 0; $wpdb->query( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_type = 'user'" ); foreach( $usernames as $username ) { $i = $rul_username_keys[$rul_username_loop]; if ( username_exists( $username ) ) { $first_address = wpc_client_rul_safe_redirect( $first_addresses[$i] ); $address = wpc_client_rul_safe_redirect( $addresses[$i] ); $lgt = ( isset( $logout[$i] ) ) ? wpc_client_rul_safe_redirect( $logout[$i] ) : ''; if (!$address) { $rul_submit_success = false; $rul_process_submit .= '<p><strong>****' .__('ERROR: Non-local or invalid URL submitted for user ',WPC_CLIENT_TEXT_DOMAIN) . $username . '****</strong></p>' . "\n"; } else { $sql = "INSERT INTO {$wpdb->prefix}wpc_client_login_redirects SET rul_first_url = '%s', rul_url = '%s', rul_type = 'user', rul_value = '%s', rul_url_logout='%s'"; $rul_update_username = $wpdb->query( $wpdb->prepare( $sql, $first_address, $address, $username, $lgt ) ); if ( !$rul_update_username ) { $rul_submit_success = false; $rul_process_submit .= '<p><strong>****' .__('ERROR: Unknown error updating user-specific URL for user ',WPC_CLIENT_TEXT_DOMAIN) . $username . '****</strong></p>' . "\n"; } } } elseif ($username != -1) { $rul_submit_success = false; $rul_process_submit .= '<p><strong>****' .__('ERROR: Non-existent username submitted ',WPC_CLIENT_TEXT_DOMAIN) .'****</strong></p>' . "\n"; } ++$rul_username_loop; } if ( $rul_submit_success ) { do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=default_redirects&msg=u#wpc_specific_users' ); exit; } } $rul_process_submit .= $rul_process_close; } elseif ( isset( $_POST['update_non_login'] ) ) { $wpc_default_non_login_redirects = array(); $wpc_default_non_login_redirects['url'] = ( isset( $_POST['wpc_non_login_redirect'] ) && !empty( $_POST['wpc_non_login_redirect'] ) ) ? trim( $_POST['wpc_non_login_redirect'] ) : ''; do_action( 'wp_client_settings_update', $wpc_default_non_login_redirects, 'default_non_login_redirects' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=default_redirects&msg=u#wpc_non_login' ); exit; } } $rules_array = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wpc_client_login_redirects ORDER BY rul_type, rul_order, rul_value", "ARRAY_A" ); $users_rul_existing = array(); $roles_rul_existing = array(); $circles_rul_existing = array(); $users_rules_html = ''; $circles_rules_html = ''; $roles_rules_html = ''; if ( is_array( $rules_array ) && count( $rules_array ) ) { $i_user = $i_role = $i_circle = 0; foreach( $rules_array as $rule ) { if ( 'user' == $rule['rul_type'] ) { $rul_first_url = ( isset( $_POST['rul_username_first_address'][$i_user] ) ) ? $_POST['rul_username_first_address'][$i_user] : $rule['rul_first_url']; $rul_url = ( isset( $_POST['rul_usernameaddress'][$i_user] ) ) ? $_POST['rul_usernameaddress'][$i_user] : $rule['rul_url']; $rul_url_logout = ( isset( $_POST['rul_logout_usernameaddress'][$i_user] ) ) ? $_POST['rul_logout_usernameaddress'][$i_user] : $rule['rul_url_logout']; $users_rules_html .= '<tr>'; $users_rules_html .= '    <td><p><input type="checkbox" name="rul_username[' . $i_user . ']" value="' . $rule['rul_value'] . '" checked="checked" /> ' . $rule['rul_value'] . '</p></td>'; $users_rules_html .= '    <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_username_first_address[' . $i_user . ']" value="' . $rul_first_url . '" /> </p></td>'; $users_rules_html .= '    <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_usernameaddress[' . $i_user . ']" value="' . $rul_url . '" /> </p></td>'; $users_rules_html .= '    <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_logout_usernameaddress[' . $i_user . ']" value="' . $rul_url_logout . '" /> </p></td>'; $users_rules_html .= '</tr>'; $users_rul_existing[] = $rule['rul_value']; ++$i_user; } elseif( 'role' == $rule['rul_type'] ) { $roles_rules_html .= '<tr>'; $roles_rules_html .= '   <td><p><input type="checkbox" name="rul_role[' . $i_role . ']" value="' . $rule['rul_value'] . '" checked="checked" /> ' . $rule['rul_value'] . '</p></td>'; $roles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_first_roleaddress[' . $i_role . ']" value="' . $rule['rul_first_url'] . '" /></p></td>'; $roles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_roleaddress[' . $i_role . ']" value="' . $rule['rul_url'] . '" /></p></td>'; $roles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_logout_roleaddress[' . $i_role . ']" value="' . $rule['rul_url_logout'] . '" /></p></td>'; $roles_rules_html .= '</tr>'; $roles_rul_existing[] = $rule['rul_value']; ++$i_role; } elseif( 'circle' == $rule['rul_type'] ) { if( isset( $circles_names[$rule['rul_value']] ) && !empty( $circles_names[$rule['rul_value']] ) ) { $circles_rules_html .= '<tr>'; $circles_rules_html .= '   <td><p><input type="checkbox" name="rul_circle[' . $i_circle . ']" value="' . $rule['rul_value'] . '" checked="checked" /> ' . $circles_names[$rule['rul_value']] . '</p></td>'; $circles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_circle_first_address[' . $i_circle . ']" value="' . $rule['rul_first_url'] . '" /></p></td>'; $circles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_circle_address[' . $i_circle . ']" value="' . $rule['rul_url'] . '" /></p></td>'; $circles_rules_html .= '   <td><p><input type="text" style="width: 150px;" maxlength="500" name="rul_logout_circle_address[' . $i_circle . ']" value="' . $rule['rul_url_logout'] . '" /></p></td>'; $circles_rules_html .= '   <td><p><input type="number" style="width: 50px;" name="rul_order[' . $i_circle . ']" value="' . $rule['rul_order'] . '" /></p></td>'; $circles_rules_html .= '</tr>'; $circles_rul_existing[] = $rule['rul_value']; ++$i_circle; } } } } else { $i_user = $i_role = $i_circle = 1; } $wpc_enable_custom_redirects = $this->cc_get_settings( 'enable_custom_redirects', 'no' ); $wpc_default_redirects = $this->cc_get_settings( 'default_redirects' ); $wpc_default_non_login_redirects = $this->cc_get_settings( 'default_non_login_redirects' ); ?>

<form action="<?php echo get_admin_url() . 'admin.php?page=wpclients_settings&tab=default_redirects' ?>" method="post" name="wpc_settings" id="wpc_settings" >
    <p>
        <span style="font-size: 14px; font-weight: bold;"><?php _e( 'Enable custom redirects', WPC_CLIENT_TEXT_DOMAIN ) ?>:</span>
        <select name="wpc_enable_custom_redirects" id="wpc_enable_custom_redirects" style="width: 70px;">
            <option value="no" <?php echo ( isset( $wpc_enable_custom_redirects ) && 'no' == $wpc_enable_custom_redirects ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
            <option value="yes" <?php echo ( isset( $wpc_enable_custom_redirects ) && 'yes' == $wpc_enable_custom_redirects ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
        </select>
        <span id="ajax_result" style="display: inline;"></span>
    </p>
    <br />
    <div class="wpc_clear"></div>
</form>


<div id="redirects_tabs" <?php echo ( isset( $wpc_enable_custom_redirects ) && 'yes' == $wpc_enable_custom_redirects ) ? '' : 'style="display: none;"' ?>>
    <ul style="float:left; width: 23%; margin: 0;">
        <li><a href="#wpc_all_user"><?php _e( 'Login/Logout For All', WPC_CLIENT_TEXT_DOMAIN ) ?><br /><?php _e( '(low priority)', WPC_CLIENT_TEXT_DOMAIN ) ?></a></li>
        <li><a href="#wpc_roles"><?php _e( 'Login/Logout For Roles', WPC_CLIENT_TEXT_DOMAIN ) ?><br /><?php _e( '(medium priority)', WPC_CLIENT_TEXT_DOMAIN ) ?></a></li>
        <li><a href="#wpc_specific_circles"><?php printf( __( 'Login/Logout For %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ) ?><br /><?php _e( '(high priority)', WPC_CLIENT_TEXT_DOMAIN ) ?></a></li>
        <li><a href="#wpc_specific_users"><?php _e( 'Login/Logout For Users', WPC_CLIENT_TEXT_DOMAIN ) ?><br /><?php _e( '(highest priority)', WPC_CLIENT_TEXT_DOMAIN ) ?></a></li>
        <li><a href="#wpc_non_login"><?php _e( 'For Non-logged-in', WPC_CLIENT_TEXT_DOMAIN ) ?></a></li>
    </ul>

    <div id="wpc_all_user" style="float: right; width: 73%; margin: 0 !important; padding: 0 !important;">
        <form action="<?php echo get_admin_url() . 'admin.php?page=wpclients_settings&tab=default_redirects' ?>" method="post" name="wpc_settings1" id="wpc_settings1" >
            <input type="hidden" name="update_settings" value="1" />

            <div class="postbox">
                <h3 class='hndle'><span><?php _e( 'Manage Default Login/Logout Redirect rules', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                <div class="inside">

                    <p>
                        <span class="description"><?php _e( "Low Priority - Will work for any Users who do not have specific Login/Logout Redirect rules.", WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </p>

                    <label for="wpc_default_first_login_redirect"><?php _e( 'First Time Login Redirect', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    <br />
                    <input type="text" id="wpc_default_first_login_redirect" name="wpc_default_first_login_redirect" size="83" maxlength="500" value="<?php echo ( isset( $wpc_default_redirects['first_login'] ) ) ? $wpc_default_redirects['first_login'] : '' ?>"/>
                    <span class="description"><?php _e( 'first time login redirect for all users.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <br />
                    <br />

                    <label for="wpc_default_login_redirect"><?php _e( 'Login Redirect', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    <br />
                    <input type="text" id="wpc_default_login_redirect" name="wpc_default_login_redirect" size="83" maxlength="500" value="<?php echo ( isset( $wpc_default_redirects['login'] ) ) ? $wpc_default_redirects['login'] : '' ?>"/>
                    <span class="description"><?php _e( 'default login redirect for all users.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <br />
                    <br />

                    <label for="wpc_default_logout_redirect"><?php _e( 'Logout Redirect', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    <br />
                    <input type="text" id="wpc_default_logout_redirect" name="wpc_default_logout_redirect" size="83" maxlength="500" value="<?php echo ( isset( $wpc_default_redirects['logout'] ) ) ? $wpc_default_redirects['logout'] : '' ?>"/>
                    <span class="description"><?php _e( 'default logout redirect for all users.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <br />
                    <br />

                    <input type="submit" class='button-primary' name="update_all" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" /><br />
                    <br />
                </div>
            </div>
        </form>
    </div>


    <div id="wpc_roles" style="float: right; width: 73%; margin: 0 !important; padding: 0 !important;">
        <form action="<?php echo get_admin_url() . 'admin.php?page=wpclients_settings&tab=default_redirects#wpc_roles' ?>" method="post" name="wpc_settings3" id="wpc_settings3" >
            <input type="hidden" name="update_settings" value="1" />
            <div class="postbox">
                <h3 class='hndle'><span><?php _e( 'Manage Login/Logout Redirect rules for any role', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                <div class="inside">

                    <?php echo $rul_process_submit2 ?>

                    <h4><?php _e( 'Specific roles', WPC_CLIENT_TEXT_DOMAIN ) ?></h4>

                    <p>
                        <span class="description"><?php _e( "Medium Priority - Will work for Users who have these roles and do not have specific Login/Logout Redirect rules.", WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </p>

                    <table>
                        <tr>
                            <td><?php _e( 'Add:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <select name="rul_role[<?php echo $i_role ?>]" >
                                    <option value="-1"><?php _e( 'Select a role', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                    <?php
 $roles_name = array(); foreach( array_keys( $wp_roles->role_names ) as $role ) { $roles_name[$role] = $role; } if ( $roles_name ) { foreach( $roles_name as $role_name ) { if ( !in_array( $role_name, $roles_rul_existing ) ) { echo '<option value="' . $role_name . '">' . $role_name . '</option>'; } } } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><?php _e( 'First Time Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <input type="text" size="83" maxlength="500" name="rul_first_roleaddress[<?php echo $i_role ?>]" />
                            </td>
                        </tr>
                        <tr>
                            <td><?php _e( 'Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <input type="text" size="83" maxlength="500" name="rul_roleaddress[<?php echo $i_role ?>]" />
                            </td>
                        </tr>
                        <tr>
                            <td><?php _e( 'Logout URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <input type="text" size="83" maxlength="500" name="rul_logout_roleaddress[<?php echo $i_role ?>]" />
                            </td>
                        </tr>
                    </table>

                    <table class="widefat">
                        <tr>
                            <th><?php _e( 'Role', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            <th><?php _e( 'First Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            <th><?php _e( 'Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            <th><?php _e( 'Logout URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                        </tr>
                        <?php echo $roles_rules_html ?>
                    </table>
                    <br />
                    <br />
                    <input type="submit" class='button-primary' name="update_roles" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                    <br />
                    <br />
                </div>
            </div>
        </form>
    </div>


    <div id="wpc_specific_users" style="float: right; width: 73%; margin: 0 !important; padding: 0 !important;">
        <form action="<?php echo get_admin_url() . 'admin.php?page=wpclients_settings&tab=default_redirects#wpc_specific_users' ?>" method="post" name="wpc_settings2" id="wpc_settings2" >
            <input type="hidden" name="update_settings" value="1" />

            <div class="postbox">
                <h3 class='hndle'><span><?php _e( 'Manage Login/Logout Redirect rules for any user', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                <div class="inside">

                    <?php echo $rul_process_submit ?>

                    <h4><?php _e( 'Specific users', WPC_CLIENT_TEXT_DOMAIN ) ?></h4>
                    <p>
                        <span class="description"><?php _e( "Highest Priority - Will always work - Does not matter if user has any other Login/Logout Redirect rules.", WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </p>

                    <table>
                        <tr>
                            <td><?php _e( 'Add:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <select name="rul_username[<?php echo $i_user ?>]" >
                                    <option value="-1"><?php _e( 'Select a username', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                    <?php
 $exclude_users = "'" . implode( "','", $users_rul_existing ) . "'"; $users = $wpdb->get_results( "SELECT user_login FROM {$wpdb->users} WHERE user_login NOT IN ( {$exclude_users} ) ORDER BY user_login", "ARRAY_A" ); if ( $users ) { foreach( $users as $user ) { echo '<option value="' . $user['user_login'] . '">' . $user['user_login'] . '</option>'; } } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><?php _e( 'First Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <input type="text" size="83" maxlength="500" name="rul_username_first_address[<?php echo $i_user ?>]" />
                            </td>
                        </tr>
                        <tr>
                            <td><?php _e( 'Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <input type="text" size="83" maxlength="500" name="rul_usernameaddress[<?php echo $i_user ?>]" />
                            </td>
                        </tr>
                        <tr>
                            <td><?php _e( 'Logout URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <input type="text" size="83" maxlength="500" name="rul_logout_usernameaddress[<?php echo $i_user ?>]" />
                            </td>
                        </tr>
                    </table>

                    <table class="widefat">
                        <tr>
                            <th><?php _e( 'Username', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            <th><?php _e( 'First Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            <th><?php _e( 'Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            <th><?php _e( 'Logout URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                        </tr>
                        <?php echo $users_rules_html ?>
                    </table>
                    <br />
                    <br />
                    <input type="submit" class='button-primary' name="update_users" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                    <br />
                    <br />
                </div>
            </div>
        </form>
    </div>


    <div id="wpc_specific_circles" style="float: right; width: 73%; margin: 0 !important; padding: 0 !important;">
        <form action="<?php echo get_admin_url() . 'admin.php?page=wpclients_settings&tab=default_redirects#wpc_specific_circles' ?>" method="post" name="wpc_settings3" id="wpc_settings3" >
            <input type="hidden" name="update_settings" value="1" />

            <div class="postbox">
                <h3 class='hndle'><span><?php printf( __( 'Manage Login/Logout Redirect rules for any %s', WPC_CLIENT_TEXT_DOMAIN), $this->custom_titles['circle']['s'] ) ?></span></h3>
                <div class="inside">

                    <?php echo $rul_process_submit3 ?>

                    <h4><?php printf( __( 'Specific %s', WPC_CLIENT_TEXT_DOMAIN), $this->custom_titles['circle']['p'] ) ?></h4>
                    <p>
                        <span class="description"><?php printf( __( "High Priority - Will work for Users who have these %s and do not have specific Login/Logout Redirect rules.", WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ) ?></span>
                    </p>

                    <table>
                        <tr id="is_choose1">
                            <td colspan="2">
                                <?php
 $link_array = array( 'title' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('circle', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); $current_page = isset( $_GET['page'] ) ? $_GET['page'] : ''; $this->acc_get_assign_circles_popup( $current_page ); ?>
                            </td>
                        </tr>
                        <tr id="is_choose4">
                            <td><?php _e( 'First Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <input type="text" size="83" maxlength="500" name="wpc_circle_first_address" id="wpc_circle_first_address" />
                            </td>
                        </tr>
                        <tr id="is_choose2">
                            <td><?php _e( 'Login URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <input type="text" size="83" maxlength="500" name="wpc_circle_address" id="wpc_circle_address" />
                            </td>
                        </tr>
                        <tr id="is_choose3">
                            <td><?php _e( 'Logout URL:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <input type="text" size="83" maxlength="500" name="wpc_logout_circle_address"  id="wpc_logout_circle_address" />
                            </td>
                        </tr>
                        <tr>
                            <td><?php _e( 'Order:', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                            <td>
                                <input type="number" name="wpc_order" value="0" />
                            </td>
                        </tr>
                    </table>

                    <table class="widefat">
                        <tr>
                            <th><?php printf( __( '%s Name', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) ?></th>
                            <th><?php _e( 'First Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            <th><?php _e( 'Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            <th><?php _e( 'Logout URL', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                            <th><?php _e( 'Order', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                        </tr>
                        <?php echo $circles_rules_html ?>
                    </table>
                    <br />
                    <br />
                    <input type="submit" class='button-primary' name="update_circles" id="update_circles" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                    <br />
                    <br />
                </div>
            </div>
        </form>
    </div>


    <div id="wpc_non_login" style="float: right; width: 73%; margin: 0 !important; padding: 0 !important;">
        <form action="<?php echo get_admin_url() . 'admin.php?page=wpclients_settings&tab=default_redirects#wpc_non_login' ?>" method="post" name="wpc_settings4" id="wpc_settings4" >
            <input type="hidden" name="update_settings" value="1" />

            <div class="postbox">
                <h3 class='hndle'><span><?php _e( 'Default for Non-logged-in Redirects', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
                <div class="inside">

                    <?php echo $rul_process_submit4 ?>

                    <table>
                        <tr>
                            <td><label for="wpc_non_login_redirect"><?php _e( 'Redirect to:', WPC_CLIENT_TEXT_DOMAIN ) ?></label></td>
                            <td>
                                <input type="text" size="83" maxlength="500" name="wpc_non_login_redirect" id="wpc_non_login_redirect" value="<?php echo ( isset( $wpc_default_non_login_redirects['url'] ) ) ? $wpc_default_non_login_redirects['url'] : '' ?>" />
                            </td>
                        </tr>
                    </table>
                    <br />
                    <br />
                    <input type="submit" class='button-primary' name="update_non_login" id="update_non_login" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                    <br />
                    <br />
                </div>
            </div>
        </form>
    </div>

</div>

<div class="wpc_clear"></div>



<script type="text/javascript" language="javascript">
    var site_url = '<?php echo site_url();?>';
    jQuery(document).ready(function() {

        var admin_url = '<?php echo get_admin_url();?>';

        jQuery( "#redirects_tabs" ).tabs({ selected : <?php echo ( (isset( $_GET['set_tab'] ) && is_numeric( $_GET['set_tab'] ) ? $_GET['set_tab'] : 0 ) ) ?> }).addClass( "ui-tabs-vertical ui-helper-clearfix" );
        jQuery( "#redirects_tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );

        jQuery( '#wpc_enable_custom_redirects' ).change( function() {
            var enable = jQuery( this ).val();

            jQuery( "#redirects_tabs" ).slideToggle( 'slow' );

            jQuery( "#ajax_result" ).html( '' );
            jQuery( "#ajax_result" ).show();
            jQuery( "#ajax_result" ).css( 'display', 'inline' );
            jQuery( "#ajax_result" ).html( '<span class="wpc_ajax_loading"></span>' );

            jQuery.ajax({
                type: "POST",
                url: admin_url+"/admin-ajax.php",
                data: "action=wpc_save_enable_custom_redirects&wpc_enable_custom_redirects=" + enable,
                dataType: "json",
                success: function( data ){
                    if ( data.status ) {
                        jQuery( "#ajax_result" ).css( 'color', 'green' );
                    } else {
                        jQuery( "#ajax_result" ).css( 'color', 'red' );
                    }
                    jQuery( "#ajax_result" ).html( data.message );
                    setTimeout( function() {
                        jQuery( "#ajax_result" ).fadeOut( 1500 );
                    }, 2500 );
                },
                error: function( data ) {
                    jQuery( "#ajax_result" ).css( 'color', 'red' );
                    jQuery( "#ajax_result" ).html( 'Unknown error.' );
                    setTimeout( function() {
                        jQuery( "#ajax_result" ).fadeOut( 1500 );
                    }, 2500 );
                }
            });
        });

        //wpc_client_rul_submit_username( $_POST['rul_username'], $_POST['rul_usernameaddress'], $_POST['rul_logout_usernameaddress'] );

    });

</script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />

<style type="text/css">

    #tabs, #redirects_tabs {
        width: 100%;
        border: 0 !important;
    }
    #tabs ul, #redirects_tabs ul {
        padding-right: 5px;
        background: #ccc;
    }
    #tabs > div, #redirects_tabs > div {
        float: left;
        padding-top: 0px;
        padding-right: 8px;
/*        width: 83%;*/
    }
    .ui-tabs-vertical { width: 55em; }
    .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 17em; }
    .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
    .ui-tabs-vertical .ui-tabs-nav li a { display:block; }
    .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
    .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 68em;}
    .ui-tabs .ui-tabs-hide {display: none;}


</style>