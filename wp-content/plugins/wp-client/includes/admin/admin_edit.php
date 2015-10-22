<?php
 $error = ""; if ( isset( $_REQUEST['update_user'] ) ) { if ( empty( $_REQUEST['admin_data']['user_login'] ) ) $error .= __( 'A username is required.<br/>', WPC_CLIENT_TEXT_DOMAIN ); if ( !isset( $_REQUEST['admin_data']['ID'] ) ) { if ( username_exists( $_REQUEST['admin_data']['user_login'] ) ) $error .= __( 'Sorry, that username already exists!<br/>', WPC_CLIENT_TEXT_DOMAIN ); } $user_email = apply_filters( 'pre_user_email', isset( $_REQUEST['admin_data']['email'] ) ? $_REQUEST['admin_data']['email'] : '' ); if ( email_exists( $user_email ) ) { if ( !isset( $_REQUEST['admin_data']['ID'] ) || $_REQUEST['admin_data']['ID'] != get_user_by( 'email', $user_email )->ID ) { $error .= __( 'Email address already in use.<br/>', WPC_CLIENT_TEXT_DOMAIN ); } } if ( !isset( $_REQUEST['admin_data']['ID'] ) || ( isset( $_REQUEST['update_password'] ) && '1' == $_REQUEST['update_password'] ) ) { if ( empty( $_REQUEST['admin_data']['pass1'] ) || empty( $_REQUEST['admin_data']['pass2'] ) ) { if ( empty( $_REQUEST['admin_data']['pass1'] ) ) $error .= __( 'Sorry, password is required.<br/>', WPC_CLIENT_TEXT_DOMAIN ); elseif ( empty( $_REQUEST['admin_data']['pass2'] ) ) $error .= __( 'Sorry, confirm password is required.<br/>', WPC_CLIENT_TEXT_DOMAIN ); elseif ( $_REQUEST['admin_data']['pass1'] != $_REQUEST['admin_data']['pass2'] ) $error .= __( 'Sorry, Passwords are not matched! .<br/>', WPC_CLIENT_TEXT_DOMAIN ); } } if ( empty( $error ) ) { $userdata = array( 'user_pass' => esc_attr( $_REQUEST['admin_data']['pass2'] ), 'user_login' => esc_attr( $_REQUEST['admin_data']['user_login'] ), 'user_email' => esc_attr( $_REQUEST['admin_data']['email'] ), 'first_name' => esc_attr( $_REQUEST['admin_data']['first_name'] ), 'last_name' => esc_attr( $_REQUEST['admin_data']['last_name'] ), 'send_password' => ( isset( $_REQUEST['admin_data']['send_password'] ) ) ? esc_attr( $_REQUEST['admin_data']['send_password'] ) : '', ); if ( isset( $_REQUEST['admin_data']['ID'] ) ) { $userdata['ID'] = $_REQUEST['admin_data']['ID']; } else { $userdata['role'] = 'wpc_admin'; } if ( isset( $_REQUEST['admin_data']['ID'] ) && !isset( $_REQUEST['update_password'] ) ) { unset( $userdata['user_pass'] ); } if ( !isset( $userdata['ID'] ) ) { $admin_id = wp_insert_user( $userdata ); if( !empty( $_REQUEST['admin_data']['temp_password'] ) && !empty( $_REQUEST['admin_data']['pass1'] ) ) { $user_pass = $wpdb->get_var( $wpdb->prepare( "SELECT user_pass FROM {$wpdb->users} WHERE ID = %d", $admin_id ) ); update_user_meta( $admin_id, 'wpc_temporary_password', md5( $user_pass ) ); } if ( 'on' == $userdata['send_password'] || '1' == $userdata['send_password'] ) { $args = array( 'client_id' => $admin_id, 'user_password' => $userdata['user_pass'] ); $this->cc_mail( 'admin_created', $userdata['user_email'], $args, 'admin_created' ); } } else { wp_update_user( $userdata ); $admin_id = $userdata['ID']; } if ( isset( $_REQUEST['admin_data']['ID'] ) ) do_action( 'wp_client_redirect', 'admin.php?page=wpclient_clients&tab=admins&msg=u' ); else do_action( 'wp_client_redirect', 'admin.php?page=wpclient_clients&tab=admins&msg=a' ); exit; } } if ( isset( $_REQUEST['admin_data'] ) ) { $admin_data = $_REQUEST['admin_data']; } elseif ( 'admins_edit' == $_GET['tab'] ) { $admin = get_userdata( $_GET['id'] ); $admin_data['ID'] = $admin->data->ID; $admin_data['user_login'] = $admin->data->user_login; $admin_data['email'] = $admin->data->user_email; $admin_data['first_name'] = get_user_meta( $admin->data->ID, 'first_name', true ); $admin_data['last_name'] = get_user_meta( $admin->data->ID, 'last_name', true ); } if ( 'admins_add' == $_GET['tab'] ) $button_text = sprintf( __( 'Add new %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ); else $button_text = sprintf( __( 'Edit %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ); $args = array( 'role' => 'wpc_client', 'orderby' => 'user_login', 'order' => 'ASC', 'fields' => array( 'ID', 'user_login' ), ); $clients = get_users( $args ); ?>

<style type="text/css">

.wrap input[type=text] {
    width:400px;
}

.wrap input[type=password] {
    width:400px;
}

</style>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <h2><?php echo $button_text ?></h2>

            <div id="message" class="updated wpc_notice fade" <?php echo ( empty( $error ) )? 'style="display: none;" ' : '' ?> ><?php echo $error; ?></div>

            <form name="edit_admin" id="edit_admin" method="post" >
                <?php if ( 'admins_edit' == $_GET['tab'] ): ?>
                <input type="hidden" name="admin_data[ID]" value="<?php echo ( isset( $admin_data['ID'] ) ) ? $admin_data['ID'] : '' ?>" />
                <input type="hidden" name="admin_data[user_login]" value="<?php echo ( isset( $admin_data['user_login'] ) ) ? $admin_data['user_login'] : '' ?>" />
                <?php endif; ?>

                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="user_login"><?php _e( 'Username', WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="description"><?php _e( '(required)', WPC_CLIENT_TEXT_DOMAIN ) ?></span></label>
                            </th>
                            <td>
                                <?php if ( 'admins_add' == $_GET['tab'] ): ?>
                                    <input type="text" name="admin_data[user_login]" id="user_login" value="<?php echo ( isset( $admin_data['user_login'] ) ) ? $admin_data['user_login'] : '' ?>" />
                                <?php else: ?>
                                    <input type="text" disabled id="user_login" value="<?php echo ( isset( $admin_data['user_login'] ) ) ? $admin_data['user_login'] : '' ?>" />
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="email"><?php _e( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="description"><?php _e( '(required)', WPC_CLIENT_TEXT_DOMAIN ) ?></span></label>
                            </th>
                            <td>
                                <input type="text" name="admin_data[email]" id="email" value="<?php echo ( isset( $admin_data['email'] ) ) ? $admin_data['email'] : '' ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="first_name"><?php _e( 'First Name', WPC_CLIENT_TEXT_DOMAIN ) ?> </label>
                            </th>
                            <td>
                                <input type="text" name="admin_data[first_name]" id="first_name" value="<?php echo ( isset( $admin_data['first_name'] ) ) ? $admin_data['first_name'] : '' ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="last_name"><?php _e( 'Last Name', WPC_CLIENT_TEXT_DOMAIN ) ?> </label>
                            </th>
                            <td>
                                <input type="text" name="admin_data[last_name]" id="last_name" value="<?php echo ( isset( $admin_data['last_name'] ) ) ? $admin_data['last_name'] : '' ?>" />
                            </td>
                        </tr>
                        <?php if ( 'admins_add' == $_GET['tab'] ) : ?>
                        <tr>
                            <th scope="row">
                                <label for="send_password"><?php _e( 'Send Password?', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                            </th>
                            <td>
                                <label for="send_password"><input type="checkbox" name="admin_data[send_password]" id="send_password" /> <?php _e( 'Send this password to the new user by email.', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
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
                                <input type="password" name="admin_data[pass1]" autocomplete="off" id="pass1" value="" />
                                <input type="button" class="wpc_generate_password_button button" value="<?php _e( 'Generate Password', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                                <br>
                                <input type="password" name="admin_data[pass2]" autocomplete="off" id="pass2" value="" />
                                <br>
                                <div id="pass-strength-result" style="display: block;"><?php _e( 'Strength indicator', WPC_CLIENT_TEXT_DOMAIN ) ?></div>
                                <p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', WPC_CLIENT_TEXT_DOMAIN ) ?></p>
                            </td>
                        </tr>
                        <?php if ( 'admins_add' == $_GET['tab'] ) { ?>
                            <tr>
                                <th scope="row">
                                    <label for="temp_password"><?php _e( 'Temporary Password?', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                </th>
                                <td>
                                    <label for="temp_password"><input type="checkbox" name="admin_data[temp_password]" value="1" id="temp_password" /> <?php _e( 'Mark password as temporary.', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                </td>
                            </tr>
                        <?php } ?>
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
                url      : '<?php echo get_admin_url() ?>admin-ajax.php',
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

    var site_url = '<?php echo site_url();?>';

    jQuery( document ).ready( function( $ ) {

        wpc_generate_password( '#pass1', '#pass2' );

        <?php echo ( empty( $error ) )? '$( "#message" ).hide();' : '' ?>

        $( "#update_user" ).live ( 'click', function() {

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
    });

</script>

<script type="text/javascript">

    jQuery(document).ready( function( $ ) {
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