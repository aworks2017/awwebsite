<?php
global $wpdb; $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=private_messages_chain&user_id=' . $_GET['user_id'] . '&from_id=' . $_GET['from_id'] . '&to_id=' . $_GET['to_id'] ; if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $ids = array(); if ( isset( $_GET['id'] ) ) { check_admin_referer( 'wpc_message_delete' . $_GET['id'] . get_current_user_id() ); $ids = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( 'Massages' ) ); $ids = $_REQUEST['item']; } if ( count( $ids ) ) { foreach ( $ids as $id ) { $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}wpc_client_comments WHERE id=%d ", $id ) ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } if( !empty( $_GET['user_id'] ) && current_user_can('wpc_manager') && !current_user_can( 'administrator' ) ) { $manager_clients = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'client' ); $manager_circles = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); foreach( $manager_circles as $c_id ) { $manager_clients = array_merge( $manager_clients, $this->cc_get_group_clients_id( $c_id ) ); } $manager_clients = array_unique( $manager_clients ); if( !in_array( $_GET['user_id'], $manager_clients ) ) { die( __( 'You do not have access to these messages!', WPC_CLIENT_TEXT_DOMAIN ) ); } } if ( isset( $_GET['user_id'] ) && isset( $_GET['from_id'] ) && isset( $_GET['to_id'] ) ) { $messages = $wpdb->get_results( $wpdb->prepare( "SELECT cc.id as id, cc.time as time, u.display_name as sent_from, u.user_login as sent_from_login, cc.sent_from as from_id, cc.comment as comment
                    FROM {$wpdb->prefix}wpc_client_comments cc
                    LEFT JOIN {$wpdb->users} u ON (cc.sent_from = u.ID)
                    LEFT JOIN {$wpdb->users} u2 ON (cc.sent_to = u2.ID)
                    WHERE user_id=%d
                    ORDER BY time DESC ", $_GET['user_id'] ), ARRAY_A ); $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->prefix}wpc_client_comments SET new_flag='0' WHERE new_flag='1' AND user_id=%d ", $_GET['user_id'] ) ); $args = array( 'role' => 'wpc_client_staff', 'orderby' => 'display_name', 'order' => 'ASC', 'meta_key' => 'parent_client_id', 'meta_value' => $_GET['user_id'], 'fields' => array( 'ID', 'display_name' ), ); $client_staff = get_users( $args ); ?>

    <div class="wrap">

        <?php echo $this->get_plugin_logo_block() ?>

        <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Message is deleted.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

        <div class="wpc_clear"></div>

        <div id="wpc_container">

            <?php echo $this->gen_tabs_menu( 'content' ) ?>

            <span class="wpc_clear"></span>

            <div class="wpc_tab_container_block">

                <h3><?php _e( 'Chain of Messages', WPC_CLIENT_TEXT_DOMAIN ) ?></h3>


                <table class="widefat" >
                    <?php
 if ( is_array( $messages ) && 0 < count( $messages ) ) { foreach ( $messages as $message ) { ?>
                    <tr <?php echo ( $message['from_id'] == get_current_user_id() ) ? 'style="background-color: #F4F4F4;"' : 'style="background-color: #FFF;"' ?> >
                        <td>
                            <?php echo $this->cc_date_format( $message['time'] ) ?>  -
                            <strong>
                            <?php
 if ( '' == $message['sent_from'] ) echo $message['sent_from_login']; else echo $message['sent_from']; ?></strong>: <br />
                            <?php echo nl2br( htmlspecialchars( stripslashes( $message['comment'] ) ) ) ?>
                            <br>
                            <br>
                            <span class="delete"><a onclick='return confirm("<?php _e( 'Are you sure you want to delete this message?', WPC_CLIENT_TEXT_DOMAIN )?>")' href="<?php echo $redirect ?>&action=delete&id=<?php echo $message['id']?>&_wpnonce=<?php echo wp_create_nonce( 'wpc_message_delete' . $message['id'] . get_current_user_id() )?>" class="submitdelete" title="Delete" ><?php _e( 'Delete', WPC_CLIENT_TEXT_DOMAIN ) ?></a></span>
                            <br>
                            <br>
                        </td>
                    </tr>
                    <?php
 } } else { ?>
                    <tr>
                        <td>
                            <p>
                                <?php _e( 'No message.', WPC_CLIENT_TEXT_DOMAIN ) ?>
                            </p>
                        </td>
                    </tr>
                    <?php
 } ?>
                </table>

                <br>
                <form action="admin.php?page=wpclients_content&tab=private_messages&action=add_message&from_id=<?php echo $_GET['from_id'] ?>&user_id=<?php echo $_GET['user_id'] ?>" method="post">
                <table width="100%">
                    <tr>
                        <td align="center">
                            <label for="sent_client_id"><?php _e( 'Sent message to', WPC_CLIENT_TEXT_DOMAIN ) ?>: </label>  &nbsp;
                            <select name="sent_client_id" id="sent_client_id" >
                                <option value="-1">&nbsp;<?php printf( __( '-Select %s / %s-', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['staff']['s'] ) ?>&nbsp;&nbsp;</option>
                                <option value="<?php echo $_GET['user_id'] ?>" selected ><?php echo get_userdata( $_GET['user_id'] )->get( 'display_name' ) ?></option>';

                                <?php if ( is_array( $client_staff ) && 0 < count( $client_staff ) ) { foreach( $client_staff as $staff ) echo '<option value="' . $staff->ID . '"> - ' . $staff->display_name . '</option>'; } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                                <textarea name="private_message" id="private_message" style="width:500px; height:100px;" placeholder="<?php _e( 'Type your private message here', WPC_CLIENT_TEXT_DOMAIN ) ?>"></textarea>
                                <br/>
                                <input type="submit" name="submit" id="submit" class='button-primary' value="<?php _e( 'Send private message', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                        </td>
                    </tr>
                </table>
                </form>
            </div>

        </div>

    </div>


    <script type="text/javascript">
        jQuery(document).ready(function(){

            //submit message
            jQuery( "#submit" ).click( function() {
                if ( 1 > jQuery( "#sent_client_id" ).val() ) {
                    jQuery( '#sent_client_id' ).parent().parent().attr( 'class', 'wpc_error' );
                    return false;
                }
                if ( !jQuery( "#private_message" ).val() ) {
                    jQuery( '#private_message' ).parent().attr( 'class', 'wpc_error' );
                    return false;
                }
                return true;
            });
        });
    </script>



<?php }