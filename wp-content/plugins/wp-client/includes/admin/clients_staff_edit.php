<?php
 if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_add_staff' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } global $wpdb; $error = ""; $id_client = ( isset( $_GET['id'] ) && 0 < $_GET['id'] ) ? $_GET['id'] : 0 ; if ( isset( $_REQUEST['update_user'] ) ) { if ( empty( $_REQUEST['user_data']['user_login'] ) ) $error .= __( 'A username is required.<br/>', WPC_CLIENT_TEXT_DOMAIN ); if ( !isset( $_REQUEST['user_data']['ID'] ) ) { if ( username_exists( $_REQUEST['user_data']['user_login'] ) ) $error .= __( 'Sorry, that username already exists!<br/>', WPC_CLIENT_TEXT_DOMAIN ); } $user_email = apply_filters( 'pre_user_email', isset( $_REQUEST['user_data']['email'] ) ? $_REQUEST['user_data']['email'] : '' ); if ( email_exists( $user_email ) ) { if ( !isset( $_REQUEST['user_data']['ID'] ) || $_REQUEST['user_data']['ID'] != get_user_by( 'email', $user_email )->ID ) { $error .= __( 'Email address already in use.<br/>', WPC_CLIENT_TEXT_DOMAIN ); } } if ( !isset( $_REQUEST['user_data']['ID'] ) || ( isset( $_REQUEST['update_password'] ) && '1' == $_REQUEST['update_password'] ) ) { if ( empty( $_REQUEST['user_data']['pass1'] ) || empty( $_REQUEST['user_data']['pass2'] ) ) { if ( empty( $_REQUEST['user_data']['pass1'] ) ) $error .= __( 'Sorry, password is required.<br/>', WPC_CLIENT_TEXT_DOMAIN ); elseif ( empty( $_REQUEST['user_data']['pass2'] ) ) $error .= __( 'Sorry, confirm password is required.<br/>', WPC_CLIENT_TEXT_DOMAIN ); elseif ( $_REQUEST['user_data']['pass1'] != $_REQUEST['user_data']['pass2'] ) $error .= __( 'Sorry, Passwords are not matched! .<br/>', WPC_CLIENT_TEXT_DOMAIN ); } } if ( isset( $_REQUEST['custom_fields'] ) ) $custom_fields = $_REQUEST['custom_fields'] ; $all_custom_fields = $this->get_custom_fields( 'admin_edit', $id_client, false, 'staff' ); if ( isset( $custom_fields ) && is_array( $custom_fields ) && is_array( $all_custom_fields ) ) { foreach ( $all_custom_fields as $all_key=>$all_value ) { if ( ( 'checkbox' == $all_value['type'] || 'radio' == $all_value['type'] || 'multiselectbox' == $all_value['type'] ) && !key_exists( $all_key, $custom_fields ) ) { $custom_fields[$all_key] = ''; } foreach ( $custom_fields as $key=>$value ) { if ( $key == $all_key && isset( $all_value['required'] ) && '1' == $all_value['required'] && '' == $value ) { $error .= __( $all_custom_fields[$all_key]['title'] . " is required! Please fill in the field and try again!<br/>", WPC_CLIENT_TEXT_DOMAIN); } } } } if ( empty( $error ) ) { $userdata = array( 'user_pass' => esc_attr( $_REQUEST['user_data']['pass2'] ), 'user_login' => esc_attr( $_REQUEST['user_data']['user_login'] ), 'user_email' => esc_attr( $_REQUEST['user_data']['email'] ), 'first_name' => esc_attr( $_REQUEST['user_data']['first_name'] ), 'last_name' => esc_attr( $_REQUEST['user_data']['last_name'] ), 'send_password' => ( isset( $_REQUEST['user_data']['send_password'] ) ) ? esc_attr( $_REQUEST['user_data']['send_password'] ) : '', 'parent_client_id' => esc_attr( $_REQUEST['wpc_clients'] ), ); if ( isset( $_REQUEST['user_data']['ID'] ) ) { $userdata['ID'] = $_REQUEST['user_data']['ID']; } else { $userdata['role'] = 'wpc_client_staff'; } if ( isset( $_REQUEST['user_data']['ID'] ) && !isset( $_REQUEST['update_password'] ) ) { unset( $userdata['user_pass'] ); } if ( !isset( $userdata['ID'] ) ) { $user_id = wp_insert_user( $userdata ); if( !empty( $_REQUEST['user_data']['temp_password'] ) && !empty( $userdata['user_pass'] ) ) { $user_pass = $wpdb->get_var( $wpdb->prepare( "SELECT user_pass FROM {$wpdb->users} WHERE ID = %d", $user_id ) ); update_user_meta( $user_id, 'wpc_temporary_password', md5( $user_pass ) ); } if ( 'on' == $userdata['send_password'] || '1' == $userdata['send_password'] ) { $args = array( 'client_id' => $user_id, 'user_password' => $userdata['user_pass'] ); $this->cc_mail( 'staff_created', $userdata['user_email'], $args, 'staff_created' ); } } else { wp_update_user( $userdata ); $user_id = $userdata['ID']; } if ( isset( $custom_fields ) && 0 < count( $custom_fields ) ) { $wpc_custom_fields = $this->cc_get_settings( 'custom_fields' ); foreach( $custom_fields as $key => $value ) { update_user_meta( $user_id, $key, $value ); if ( isset( $wpc_custom_fields[$key]['relate_to'] ) && '' != trim( $wpc_custom_fields[$key]['relate_to'] ) ) { update_user_meta( $user_id, trim( $wpc_custom_fields[$key]['relate_to'] ), $value ); } } } update_user_meta( $user_id, 'parent_client_id', $userdata['parent_client_id'] ); if ( isset( $_REQUEST['user_data']['ID'] ) ) do_action( 'wp_client_redirect', 'admin.php?page=wpclient_clients&tab=staff&msg=u' ); else do_action( 'wp_client_redirect', 'admin.php?page=wpclient_clients&tab=staff&msg=a' ); exit; } } if ( isset( $_REQUEST['user_data'] ) ) { $user_data = $_REQUEST['user_data']; } elseif ( 'staff_edit' == $_GET['tab'] ) { $user = get_userdata( $_GET['id'] ); $user_data['ID'] = $user->data->ID; $user_data['user_login'] = $user->data->user_login; $user_data['email'] = $user->data->user_email; $user_data['first_name'] = get_user_meta( $user->data->ID, 'first_name', true ); $user_data['last_name'] = get_user_meta( $user->data->ID, 'last_name', true ); $user_data['parent_client_id'] = get_user_meta( $user->data->ID, 'parent_client_id', true ); } if ( 'staff_add' == $_GET['tab'] ) $button_text = sprintf( __( 'Add new %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['staff']['s'] ); else $button_text = sprintf( __( 'Update %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['staff']['s'] ); $not_approved_clients = get_users( array( 'role' => 'wpc_client', 'meta_key' => 'to_approve', 'fields' => 'ID', ) ); $args = array( 'role' => 'wpc_client', 'orderby' => 'user_login', 'order' => 'ASC', 'exclude' => $not_approved_clients, 'fields' => array( 'ID', 'user_login' ), ); $clients = get_users( $args ); ?>

<style type="text/css">

.wrap input[type=text] {
    width:400px;
}

.wrap input[type=password] {
    width:400px;
}

</style>

<script type="text/javascript">
    var site_url = '<?php echo site_url();?>';
</script>

<div class='wrap'>

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <h2></h2>

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>
        <div class="wpc_tab_container_block add_staff">
            <h2><?php echo $button_text ?></h2>
            <div id="message" class="error wpc_notice fade" <?php echo ( empty( $error ) )? 'style="display: none;" ' : '' ?> ><?php echo $error; ?></div>

            <form name="edit_employee" id="edit_employee" method="post" >
                <?php if ( 'staff_edit' == $_GET['tab'] ): ?>
                <input type="hidden" name="user_data[ID]" value="<?php echo ( isset( $user_data['ID'] ) ) ? $user_data['ID'] : '' ?>" />
                <input type="hidden" name="user_data[user_login]" value="<?php echo ( isset( $user_data['user_login'] ) ) ? $user_data['user_login'] : '' ?>" />
                <?php endif; ?>

                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="user_login"><?php printf( __( '%s Login', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) ?> <span class="description"><?php _e( '(required)', WPC_CLIENT_TEXT_DOMAIN ) ?></span></label>
                            </th>
                            <td>
                                <?php if ( 'staff_add' == $_GET['tab'] ): ?>
                                    <input type="text" name="user_data[user_login]" id="user_login" value="<?php echo ( isset( $user_data['user_login'] ) ) ? $user_data['user_login'] : '' ?>" />
                                <?php else: ?>
                                    <input type="text" disabled id="user_login" value="<?php echo ( isset( $user_data['user_login'] ) ) ? $user_data['user_login'] : '' ?>" />
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="email"><?php _e( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="description"><?php _e( '(required)', WPC_CLIENT_TEXT_DOMAIN ) ?></span></label>
                            </th>
                            <td>
                                <input type="text" name="user_data[email]" id="email" value="<?php echo ( isset( $user_data['email'] ) ) ? $user_data['email'] : '' ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="first_name"><?php _e( 'First Name', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                            </th>
                            <td>
                                <input type="text" name="user_data[first_name]" id="first_name" value="<?php echo ( isset( $user_data['first_name'] ) ) ? $user_data['first_name'] : '' ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="last_name"><?php _e( 'Last Name', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                            </th>
                            <td>
                                <input type="text" name="user_data[last_name]" id="last_name" value="<?php echo ( isset( $user_data['last_name'] ) ) ? $user_data['last_name'] : '' ?>" />
                            </td>
                        </tr>

                        <?php
 if ( $id_client ) $custom_fields = $this->get_custom_fields( 'admin_edit', $id_client, false, 'staff' ); else $custom_fields = $this->get_custom_fields( 'admin_add', $id_client, false, 'staff' ); if ( is_array( $custom_fields ) && 0 < count( $custom_fields ) ) { $this->add_custom_fields_scripts(); foreach( $custom_fields as $key => $value ) { if ( 'hidden' == $value['type'] ) { echo $value['field']; } elseif ( 'checkbox' == $value['type'] || 'radio' == $value['type'] ) { echo '<tr><th scope="row">'; echo ( !empty( $value['label'] ) ) ? $value['label'] : ''; echo '</th><td>'; if ( !empty( $value['field'] ) ) foreach ( $value['field'] as $field ) { echo $field . '<br />'; } echo ( !empty( $value['description'] ) ) ? $value['description'] : ''; echo '</td></tr>'; } else { echo '<tr><th>'; echo ( !empty( $value['label'] ) ) ? $value['label'] : ''; echo '</th><td>'; echo ( !empty( $value['field'] ) ) ? $value['field'] : ''; echo ( !empty( $value['description'] ) ) ? '<br />' . $value['description']: ''; echo '</td></tr>'; } } } ?>

                        <?php if ( 'staff_add' == $_GET['tab'] ) : ?>
                        <tr>
                            <th scope="row">
                                <label for="send_password"><?php _e( 'Send Password?', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                            </th>
                            <td>
                                <label for="send_password"><input type="checkbox" name="user_data[send_password]" id="send_password" /> <?php _e( 'Send this password to the new user by email.', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                            </td>
                        </tr>
                        <?php else: ?>
                        <tr>
                            <th scope="row">
                                <label for="send_password"><?php _e( 'Update Password?', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                            </th>
                            <td>
                                <label for="send_password"><input type="checkbox" name="update_password" value="1" id="update_password" /> <?php _e( 'Checking this box will change the password.', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                            </td>
                        </tr>
                        <?php endif; ?>


                        <tr>
                            <th scope="row">
                                <label for="pass1"><?php _e( 'Password', WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="description"><?php _e( '(twice, required)', WPC_CLIENT_TEXT_DOMAIN ) ?></span></label>
                            </th>
                            <td>
                                <input type="password" name="user_data[pass1]" autocomplete="off" id="pass1" value="" />
                                <input type="button" class="wpc_generate_password_button button" value="<?php _e( 'Generate Password', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                                <br>
                                <input type="password" name="user_data[pass2]" autocomplete="off" id="pass2" value="" />
                                <br>
                                <div id="pass-strength-result" style="display: block;"><?php _e( 'Strength indicator', WPC_CLIENT_TEXT_DOMAIN ) ?></div>
                                <p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', WPC_CLIENT_TEXT_DOMAIN ) ?></p>
                            </td>
                        </tr>

                        <?php if ( 'staff_add' == $_GET['tab'] ) { ?>
                            <tr>
                                <th scope="row">
                                    <label for="temp_password"><?php _e( 'Temporary Password?', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                </th>
                                <td>
                                    <label for="temp_password"><input type="checkbox" name="user_data[temp_password]" value="1" id="temp_password" /> <?php _e( 'Mark password as temporary.', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                </td>
                            </tr>
                        <?php } ?>

                        <?php if ( is_array( $clients ) && 0 < count( $clients ) ): ?>
                        <tr>
                            <td colspan="2">
                                <?php
 $link_array = array( 'title' => sprintf( __( 'Assign to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'text' => sprintf( __( 'Assign to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'data-marks' => 'radio' ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => ( isset( $user_data['parent_client_id'] ) && !empty( $user_data['parent_client_id'] ) ) ? $user_data['parent_client_id'] : '' ); $additional_array = array( 'counter_value' => ( isset( $user_data['parent_client_id'] ) && !empty( $user_data['parent_client_id'] ) ) ? get_userdata( $user_data['parent_client_id'] )->get( 'user_login' ) : '' ); $this->acc_assign_popup( 'client', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <p class="submit">
                        <input type="submit" value="<?php echo $button_text ?>" class="button-primary" id="update_user" name="update_user">
                </p>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" language="javascript">
    function wpc_generate_password( pass1, pass2 ) {
        jQuery('.wpc_generate_password_button').click(function() {
            var obj = jQuery(this);
            obj.next('.wpc_show_password').remove();
            jQuery( pass1 ).val('');
            jQuery( pass2 ).val('');
            jQuery( pass1 ).trigger('keyup');
            obj.after(' <span class="wpc_ajax_loading"></span>');
            jQuery.ajax({
                type     : 'POST',
                dataType : 'json',
                url      : '<?php echo site_url() ?>/wp-admin/admin-ajax.php',
                data     : 'action=wpc_generate_password',
                success: function( data ){
                    if( data.status ) {
                        obj.next('.wpc_ajax_loading').remove();
                        obj.after(' <span class="wpc_show_password">' + data.message + '</span>');
                        jQuery( pass1 ).val( data.message );
                        jQuery( pass2 ).val( data.message );
                        jQuery( pass1 ).trigger('keyup');
                    } else {
                        alert( data.message );
                    }
                }
            });
        });
    }

    jQuery( document ).ready( function( $ ) {
        wpc_generate_password( '#pass1', '#pass2' );

        <?php echo ( empty( $error ) )? '$( "#message" ).hide();' : '' ?>

        $( "#update_user" ).live( 'click', function() {

            var msg = '';

            var emailReg = /^([\w-+\.]+@([\w-]+\.)+[\w-]{2,})?$/;

            if ( $( "#user_login" ).val() == '' ) {
                msg += "<?php _e( 'A username is required.', WPC_CLIENT_TEXT_DOMAIN ) ?><br/>";
            }

            if ( $( "#email" ).val() == '' ) {
                msg += "<?php _e( 'Email required.', WPC_CLIENT_TEXT_DOMAIN ) ?><br/>";
            } else if ( !emailReg.test( $( "#email" ).val() ) ) {
                msg += "<?php _e( 'Invalid Email.', WPC_CLIENT_TEXT_DOMAIN ) ?><br/>";
            }


            if ( $( '#update_password' ).length == 0 || $( "#update_password" ).is(':checked') ) {
                if ( $( "#pass1" ).val() == '' ) {
                    msg += "<?php _e( 'Password required.', WPC_CLIENT_TEXT_DOMAIN ) ?><br/>";
                } else if ( $( "#pass2" ).val() == '' ) {
                    msg += "<?php _e( 'Confirm Password required.', WPC_CLIENT_TEXT_DOMAIN ) ?><br/>";
                } else if ( $( "#pass1" ).val() != $( "#pass2" ).val() ) {
                    msg += "<?php _e( 'Passwords are not matched.', WPC_CLIENT_TEXT_DOMAIN ) ?><br/>";
                }
            }


            if ( msg != '' ) {
                $( "#message" ).html( msg );
                $( "#message" ).show();
                return false;
            }
        });

        $( '.indicator-hint' ).html( wpc_password_protect.hint_message );

        $( 'body' ).on( 'keyup', '#pass1, #pass2',
            function( event ) {
                checkPasswordStrength(
                    $('#pass1'),
                    $('#pass2'),
                    $('#pass-strength-result'),
                    $('#update_user'),
                    wpc_password_protect.blackList
                );
            }
        );

    });

</script>