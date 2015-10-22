<?php
 if ( !( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { do_action( 'wp_client_redirect', get_admin_url( 'index.php' ) ); exit; } global $wpdb; $error = ""; if ( isset( $_REQUEST['update_user'] ) ) { if ( empty( $_REQUEST['manager_data']['user_login'] ) ) $error .= __( 'A username is required.<br/>', WPC_CLIENT_TEXT_DOMAIN ); if ( !isset( $_REQUEST['manager_data']['ID'] ) ) { if ( username_exists( $_REQUEST['manager_data']['user_login'] ) ) $error .= __( 'Sorry, that username already exists!<br/>', WPC_CLIENT_TEXT_DOMAIN ); } $contact_email = apply_filters( 'pre_user_email', isset( $_REQUEST['manager_data']['email'] ) ? $_REQUEST['manager_data']['email'] : '' ); if ( email_exists( $contact_email ) ) { if ( !isset( $_REQUEST['manager_data']['ID'] ) || $_REQUEST['manager_data']['ID'] != get_user_by( 'email', $contact_email )->ID ) { $error .= __( 'Email address already in use.<br/>', WPC_CLIENT_TEXT_DOMAIN ); } } if ( !isset( $_REQUEST['manager_data']['ID'] ) || ( isset( $_REQUEST['update_password'] ) && '1' == $_REQUEST['update_password'] ) ) { if ( empty( $_REQUEST['manager_data']['pass1'] ) || empty( $_REQUEST['manager_data']['pass2'] ) ) { if ( empty( $_REQUEST['manager_data']['pass1'] ) ) $error .= __( 'Sorry, password is required.<br/>', WPC_CLIENT_TEXT_DOMAIN ); elseif ( empty( $_REQUEST['manager_data']['pass2'] ) ) $error .= __( 'Sorry, confirm password is required.<br/>', WPC_CLIENT_TEXT_DOMAIN ); elseif ( $_REQUEST['manager_data']['pass1'] != $_REQUEST['manager_data']['pass2'] ) $error .= __( 'Sorry, Passwords are not matched! .<br/>', WPC_CLIENT_TEXT_DOMAIN ); } } if ( empty( $error ) ) { $userdata = array( 'user_pass' => esc_attr( $_REQUEST['manager_data']['pass2'] ), 'user_login' => esc_attr( $_REQUEST['manager_data']['user_login'] ), 'user_email' => esc_attr( $_REQUEST['manager_data']['email'] ), 'first_name' => esc_attr( $_REQUEST['manager_data']['first_name'] ), 'last_name' => esc_attr( $_REQUEST['manager_data']['last_name'] ), 'display_name' => esc_attr( $_REQUEST['manager_data']['first_name'] . ' ' . $_REQUEST['manager_data']['last_name'] ), 'send_password' => ( isset( $_REQUEST['manager_data']['send_password'] ) ) ? esc_attr( $_REQUEST['manager_data']['send_password'] ) : '', ); if ( isset( $_REQUEST['manager_data']['ID'] ) ) { $userdata['ID'] = $_REQUEST['manager_data']['ID']; } else { $userdata['role'] = 'wpc_manager'; } if ( isset( $_REQUEST['manager_data']['ID'] ) && !isset( $_REQUEST['update_password'] ) ) { unset( $userdata['user_pass'] ); } $auto_assigned = ( isset( $_REQUEST['manager_data']['auto_assign'] ) && 'on' == $_REQUEST['manager_data']['auto_assign'] ) ? true : false; if ( !isset( $userdata['ID'] ) ) { $manager_id = wp_insert_user( $userdata ); if( !empty( $_REQUEST['manager_data']['temp_password'] ) && !empty( $_REQUEST['manager_data']['pass1'] ) ) { $user_pass = $wpdb->get_var( $wpdb->prepare( "SELECT user_pass FROM {$wpdb->users} WHERE ID = %d", $manager_id ) ); update_user_meta( $manager_id, 'wpc_temporary_password', md5( $user_pass ) ); } if ( 'on' == $userdata['send_password'] || '1' == $userdata['send_password'] ) { $args = array( 'client_id' => $manager_id, 'user_password' => $userdata['user_pass'] ); $this->cc_mail( 'manager_created', $userdata['user_email'], $args, 'manager_created' ); } update_user_meta( $manager_id, 'wpc_auto_assigned_clients', $auto_assigned ); update_user_meta( $manager_id, 'contact_phone', $_POST['manager_data']['contact_phone'] ); update_user_meta( $manager_id, 'address', $_POST['manager_data']['address'] ); } else { wp_update_user( $userdata ); $manager_id = $userdata['ID']; update_user_meta( $manager_id, 'wpc_auto_assigned_clients', $auto_assigned ); update_user_meta( $manager_id, 'contact_phone', $_POST['manager_data']['contact_phone'] ); update_user_meta( $manager_id, 'address', $_POST['manager_data']['address'] ); } $client_ids = array(); if ( isset( $_REQUEST['wpc_clients'] ) && ( 'managers_add' == $_GET['tab'] || 'managers_edit' == $_GET['tab'] ) ) { if( $_REQUEST['wpc_clients'] == 'all' ) { $client_ids = $this->acc_get_client_ids(); } elseif( '' != $_REQUEST['wpc_clients'] ) { $client_ids = explode( ',', $_REQUEST['wpc_clients'] ); } } $this->cc_set_assigned_data( 'manager', $manager_id, 'client', $client_ids ); $circle_ids = array(); if ( isset( $_REQUEST['wpc_circles'] ) && ( 'managers_add' == $_GET['tab'] || 'managers_edit' == $_GET['tab'] ) ) { if( $_REQUEST['wpc_circles'] == 'all' ) { $circle_ids = $this->cc_get_group_ids(); } elseif ('' != $_REQUEST['wpc_circles'] ) { $circle_ids = explode( ',', $_REQUEST['wpc_circles'] ); } } $this->cc_set_assigned_data( 'manager', $manager_id, 'circle', $circle_ids ); do_action( 'wpc_client_manager_data_saved', $manager_id, $userdata ); if ( isset( $_REQUEST['manager_data']['ID'] ) ) { do_action( 'wpc_client_manager_updated', $manager_id, $userdata ); do_action( 'wp_client_redirect', 'admin.php?page=wpclient_clients&tab=managers&msg=u' ); } else { do_action( 'wpc_client_manager_created', $manager_id ); do_action( 'wp_client_redirect', 'admin.php?page=wpclient_clients&tab=managers&msg=a' ); } exit; } } $manager_data = array(); if ( isset( $_REQUEST['manager_data'] ) ) { $manager_data = $_REQUEST['manager_data']; } elseif ( 'managers_edit' == $_GET['tab'] ) { $manager = get_userdata( $_GET['id'] ); $manager_data['ID'] = $manager->data->ID; $manager_data['user_login'] = $manager->data->user_login; $manager_data['email'] = $manager->data->user_email; $manager_data['first_name'] = get_user_meta( $manager->data->ID, 'first_name', true ); $manager_data['last_name'] = get_user_meta( $manager->data->ID, 'last_name', true ); $manager_data['contact_phone'] = get_user_meta( $manager->data->ID, 'contact_phone', true ); $manager_data['address'] = get_user_meta( $manager->data->ID, 'address', true ); $manager_data['auto_assign'] = get_user_meta( $manager->data->ID, 'wpc_auto_assigned_clients', true ); } if ( 'managers_add' == $_GET['tab'] ) $button_text = sprintf( __( 'Add new %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ); else $button_text = sprintf( __( 'Edit %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ); $clients_this_manager = ( isset( $manager_data['ID'] ) ) ? $this->cc_get_assign_data_by_object( 'manager', $manager_data['ID'], 'client' ) : array(); $circles_this_manager = ( isset( $manager_data['ID'] ) ) ? $this->cc_get_assign_data_by_object( 'manager', $manager_data['ID'], 'circle' ) : array(); $args = array( 'role' => 'wpc_client', 'orderby' => 'user_login', 'order' => 'ASC', 'fields' => array( 'ID', 'user_login' ), ); $clients = get_users( $args ); ?>

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

            <div id="message" class="updated wpc_notice fade" <?php echo ( empty( $error ) ) ? 'style="display: none;" ' : '' ?> ><?php echo $error; ?></div>

            <form name="edit_manager" id="edit_manager" method="post" >
                <?php if ( 'managers_edit' == $_GET['tab'] ): ?>
                <input type="hidden" name="manager_data[ID]" value="<?php echo ( isset( $manager_data['ID'] ) ) ? $manager_data['ID'] : '' ?>" />
                <input type="hidden" name="manager_data[user_login]" value="<?php echo ( isset( $manager_data['user_login'] ) ) ? $manager_data['user_login'] : '' ?>" />
                <?php endif; ?>

                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="user_login"><?php _e( 'Username', WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="description"><?php _e( '(required)', WPC_CLIENT_TEXT_DOMAIN ) ?></span></label>
                            </th>
                            <td>
                                <?php if ( 'managers_add' == $_GET['tab'] ): ?>
                                    <input type="text" name="manager_data[user_login]" id="user_login" value="<?php echo ( isset( $manager_data['user_login'] ) ) ? $manager_data['user_login'] : '' ?>" />
                                <?php else: ?>
                                    <input type="text" disabled id="user_login" value="<?php echo ( isset( $manager_data['user_login'] ) ) ? $manager_data['user_login'] : '' ?>" />
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="email"><?php _e( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="description"><?php _e( '(required)', WPC_CLIENT_TEXT_DOMAIN ) ?></span></label>
                            </th>
                            <td>
                                <input type="text" name="manager_data[email]" id="email" value="<?php echo ( isset( $manager_data['email'] ) ) ? $manager_data['email'] : '' ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="first_name"><?php _e( 'First Name', WPC_CLIENT_TEXT_DOMAIN ) ?> </label>
                            </th>
                            <td>
                                <input type="text" name="manager_data[first_name]" id="first_name" value="<?php echo ( isset( $manager_data['first_name'] ) ) ? $manager_data['first_name'] : '' ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="last_name"><?php _e( 'Last Name', WPC_CLIENT_TEXT_DOMAIN ) ?> </label>
                            </th>
                            <td>
                                <input type="text" name="manager_data[last_name]" id="last_name" value="<?php echo ( isset( $manager_data['last_name'] ) ) ? $manager_data['last_name'] : '' ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="contact_phone"><?php _e( 'Phone', WPC_CLIENT_TEXT_DOMAIN ) ?> </label>
                            </th>
                            <td>
                                <input type="text" name="manager_data[contact_phone]" id="contact_phone" value="<?php echo ( isset( $manager_data['contact_phone'] ) ) ? $manager_data['contact_phone'] : '' ; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="address"><?php _e( 'Address', WPC_CLIENT_TEXT_DOMAIN ) ?> </label>
                            </th>
                            <td>
                                <input type="text" name="manager_data[address]" id="address" value="<?php echo ( isset( $manager_data['address'] ) ) ? $manager_data['address'] : '' ; ?>" />
                            </td>
                        </tr>


                        <?php
 do_action( 'wpc_client_manager_add_edit_form_html', $manager_data ); ?>

                        <tr>
                            <th scope="row">
                                <label for="auto_assign"><?php  printf( __( 'Auto Assign New %s?', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ?></label>
                            </th>
                            <td>
                                <label for="auto_assign"><input type="checkbox" name="manager_data[auto_assign]" id="auto_assign" <?php if( isset( $manager_data['auto_assign'] ) && '1' == $manager_data['auto_assign'] ) {?>checked="checked"<?php } ?>/>
                                    <?php printf( __( 'Auto-assign newly registered %s to this WPC-Manager', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ?></label>
                            </td>
                        </tr>

                        <?php if ( 'add' == $_GET['tab'] ) : ?>
                        <tr>
                            <th scope="row">
                                <label for="send_password"><?php _e( 'Send Password?', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                            </th>
                            <td>
                                <label for="send_password"><input type="checkbox" name="manager_data[send_password]" id="send_password" /> <?php _e( 'Send this password to the new user by email.', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
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
                                <input type="password" name="manager_data[pass1]" autocomplete="off" id="pass1" value="" />
                                <input type="button" class="wpc_generate_password_button button" value="<?php _e( 'Generate Password', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                                <br>
                                <input type="password" name="manager_data[pass2]" autocomplete="off" id="pass2" value="" />
                                <br>
                                <div id="pass-strength-result" style="display: block;"><?php _e( 'Strength indicator', WPC_CLIENT_TEXT_DOMAIN ) ?></div>
                                <p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', WPC_CLIENT_TEXT_DOMAIN ) ?></p>
                            </td>
                        </tr>
                        <?php if ( 'managers_add' == $_GET['tab'] ) { ?>
                            <tr>
                                <th scope="row">
                                    <label for="temp_password"><?php _e( 'Temporary Password?', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                </th>
                                <td>
                                    <label for="temp_password"><input type="checkbox" name="manager_data[temp_password]" value="1" id="temp_password" /> <?php _e( 'Mark password as temporary.', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="2">
                                <?php if ( 'managers_add' == $_GET['tab'] ) { $link_array = array( 'title' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'wpclients_managers', $link_array, $input_array, $additional_array ); } elseif( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) { $link_array = array( 'title' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => ( ( isset( $clients_this_manager ) && is_array( $clients_this_manager ) ) ) ? implode( ',', $clients_this_manager ) : '' ); $additional_array = array( 'counter_value' => count( $clients_this_manager ) ); $this->acc_assign_popup('client', 'wpclients_managers', $link_array, $input_array, $additional_array ); } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <?php if ( 'managers_add' == $_GET['tab'] ) { $link_array = array( 'title' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('circle', 'wpclients_managers', $link_array, $input_array, $additional_array ); } elseif( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ) { $link_array = array( 'title' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => implode( ',', $circles_this_manager ) ); $additional_array = array( 'counter_value' => count( $circles_this_manager ) ); $this->acc_assign_popup('circle', 'wpclients_managers', $link_array, $input_array, $additional_array ); } ?>
                            </td>
                        </tr>
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

    var site_url = '<?php echo site_url();?>';

    jQuery( document ).ready( function( $ ) {

        wpc_generate_password( '#pass1', '#pass2' );

        //Select/Un-select all clients
        jQuery( "#select_all" ).change( function() {
            if ( 'checked' == jQuery( this ).attr( 'checked' ) ) {
                jQuery( '#edit_manager input[name="manager_data[clients_id][]"]' ).attr( 'checked', true );
            } else {
                jQuery( '#edit_manager input[name="manager_data[clients_id][]"]' ).attr( 'checked', false );
            }
        });


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