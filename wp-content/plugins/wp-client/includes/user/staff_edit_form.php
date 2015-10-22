<div class="registration_form" id="registration_form">

    <div id="message" class="error wpc_notice fade" <?php echo ( empty( $error ) )? 'style="display: none;" ' : '' ?> >
        <?php echo $error; ?>
    </div>

    <form name="edit_employee" id="edit_employee" method="post" >

        <?php if( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) { ?>
            <input type="hidden" id="user_ID" name="user_data[ID]" value="<?php echo ( isset( $user_data['ID'] ) ) ? $user_data['ID'] : ''  ?>" />
            <input type="hidden" id="user_ID" name="user_data[user_login]" value="<?php echo ( isset( $user_data['user_login'] ) ) ? $user_data['user_login'] : ''  ?>" />
        <?php } ?>

        <p class="user_login">
            <label class="title" for="user_login"><?php printf( __( '%s Login', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) ?><font color="red" title="<?php _e( 'This field is marked as required by the administrator', WPC_CLIENT_TEXT_DOMAIN ) ?>.">*</font></label>
            <input type="text" id="user_login" name="user_data[user_login]" <?php if( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) { ?>disabled="disabled" <?php } ?>value="<?php echo ( isset( $user_data['user_login'] ) ) ? $user_data['user_login'] : ''  ?>" />
        </p>

        <p class="email">
            <label class="title" for="email"><?php _e( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ) ?><font color="red" title="<?php _e( 'This field is marked as required by the administrator', WPC_CLIENT_TEXT_DOMAIN ) ?>.">*</font></label>
            <input type="text" id="email" name="user_data[email]" value="<?php echo ( isset( $user_data['email'] ) ) ? $user_data['email'] : ''  ?>" />
        </p>

        <p class="first_name">
            <label class="title" for="first_name"><?php _e( 'First Name', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
            <input type="text" id="first_name" name="user_data[first_name]" value="<?php echo ( isset( $user_data['first_name'] ) ) ? $user_data['first_name'] : ''  ?>" />
        </p>

        <p class="last_name">
            <label class="title" for="last_name"><?php _e( 'Last Name', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
            <input type="text" id="last_name" name="user_data[last_name]" value="<?php echo ( isset( $user_data['last_name'] ) ) ? $user_data['last_name'] : ''  ?>" />
        </p>
        <?php

        //block 'custom_field'
        $user_id = ( isset( $user_data['ID'] ) ) ? $user_data['ID'] : 0 ;
        if( $user_id )
            $custom_fields = $this->get_custom_fields( 'user_edit', $user_id, false, 'staff' );
        else
            $custom_fields = $this->get_custom_fields( 'user_registered', $user_id, false, 'staff' );
        $custom_field = array();
        if ( is_array( $custom_fields ) && 0 < count( $custom_fields ) ) {
            $this->add_custom_fields_scripts();

            foreach( $custom_fields as $key => $value ) {
                if ( 'hidden' == $value['type'] ) {
                    echo $value['field'];
                } elseif ( 'checkbox' == $value['type'] || 'radio' == $value['type'] ) {
                    echo '<p>';
                    echo ( !empty( $value['label'] ) ) ? $value['label'] . '<label class="opt">&nbsp;</label>' : '';

                    if ( !empty( $value['field'] ) )
                        foreach ( $value['field'] as $field ) {
                            echo '<label class="title">&nbsp;</label>' . $field ;
                        }

                    echo ( !empty( $value['description'] ) ) ? $value['description'] : '';
                    echo '</p>';
                } else {
                    echo '<p>';
                    echo ( !empty( $value['label'] ) ) ? $value['label'] : '';
                    echo ( !empty( $value['field'] ) ) ? $value['field'] : '';
                    echo ( !empty( $value['description'] ) ) ? '<br />' . $value['description']: '';
                    echo '</p>';
                }
            }
        }
        ?>

        <?php if( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) { ?>
            <p class="update_password">
                <label class="title" for="send_password">
                    <?php _e( 'Update Password?', WPC_CLIENT_TEXT_DOMAIN ) ?>
                </label>
                <input type="checkbox" name="update_password" id="update_password" />
                <?php printf( __( 'Update password for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ); ?>
            </p>
        <?php } ?>
        <div class="passwords_block" <?php if( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) { ?>style="display:none;"<?php } ?>>
            <p class="pass1">
                <label class="title" for="pass1"><?php _e( 'Password', WPC_CLIENT_TEXT_DOMAIN ) ?><font color="red" title="<?php _e( 'This field is marked as required by the administrator', WPC_CLIENT_TEXT_DOMAIN ) ?>.">*</font></label>
                <input type="password" id="pass1" name="user_data[pass1]" autocomplete="off" value="" />
            </p>
            <p class="pass2">
                <label class="title" for="pass2"><?php _e( 'Confirm Password', WPC_CLIENT_TEXT_DOMAIN ) ?><font color="red" title="<?php _e( 'This field is marked as required by the administrator', WPC_CLIENT_TEXT_DOMAIN ) ?>.">*</font></label>
                <input type="password" id="pass2" name="user_data[pass2]" autocomplete="off" value="" />
            </p>

            <div id="pass-strength-result" style="display: block;"><?php _e( 'Strength indicator', WPC_CLIENT_TEXT_DOMAIN ) ?></div>
            <span class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', WPC_CLIENT_TEXT_DOMAIN ) ?></span>

            <p class="send_password">
                <label class="title" for="send_password">
                    <?php _e( 'Send Password?', WPC_CLIENT_TEXT_DOMAIN ) ?>
                </label>
                <input type="checkbox" name="user_data[send_password]" id="send_password" />
                <?php printf( __( 'Send this password to the %s by email.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ); ?>
            </p>
        </div>
        <p class="submit">
        <?php if( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) { ?>
            <input type="submit" value="<?php printf( __( 'Save %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ); ?>" class="button-primary" id="update_user" name="update_user">
        <?php } else { ?>
            <input type="submit" value="<?php printf( __( 'Add new %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ); ?>" class="button-primary" id="update_user" name="update_user">
        <?php } ?>
        <input type="button" value="<?php _e( 'Back', WPC_CLIENT_TEXT_DOMAIN ) ?>" onclick="window.history.back();" />
        </p>
    </form>

</div>
