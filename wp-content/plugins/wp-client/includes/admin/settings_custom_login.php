<?php
 if ( isset( $_POST['custom_login'] ) ) { $settings = $_POST['custom_login']; $settings['cl_color'] = str_replace( '#', '', $settings['cl_color'] ); $settings['cl_color'] = substr( $settings['cl_color'], 0, 6 ); $settings['cl_error_color'] = str_replace( '#', '', $settings['cl_error_color'] ); $settings['cl_error_color'] = substr( $settings['cl_error_color'], 0, 6 ); $settings['cl_backgroundColor'] = str_replace( '#', '', $settings['cl_backgroundColor'] ); $settings['cl_backgroundColor'] = substr( $settings['cl_backgroundColor'], 0, 6 ); $settings['cl_form_border'] = ( isset( $settings['cl_form_border'] ) && '1' == $settings['cl_form_border'] ) ? '1' : '0'; $settings['cl_linkColor'] = str_replace( '#', '', $settings['cl_linkColor'] ); $settings['cl_linkColor'] = substr( $settings['cl_linkColor'], 0, 6 ); $settings['cl_background'] = esc_url_raw( $settings['cl_background'] ); if( !$this->permalinks ) { $settings['cl_login_url'] = ''; $settings['cl_hide_admin'] = 'no'; } if( isset( $settings['cl_login_url'] ) && '' != $settings['cl_login_url'] ) { $settings['cl_login_url'] = sanitize_title_with_dashes( $settings['cl_login_url'] ); $settings['cl_login_url'] = str_replace( '/', '', $settings['cl_login_url'] ); $disallowed = array( 'user', 'wp-admin', 'wp-content', 'wp-includes', 'wp-feed.php', 'index', 'feed', 'rss', 'robots', 'robots.txt', 'wp-login.php', 'wp-login', 'wp-config', 'blog', 'sitemap', 'sitemap.xml', ); if ( in_array( $settings['cl_login_url'], $disallowed ) ) { do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=custom_login&msg=cl_url' ); exit; } } do_action( 'wp_client_settings_update', $settings, 'custom_login' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=custom_login&msg=u' ); exit; } $wpc_custom_login = $this->cc_get_settings( 'custom_login' ); ?>

<form action="" method="post" name="wpc_settings" id="wpc_settings" >

    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'Custom Login', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="cl_enable"><?php _e( 'Use Custom Login Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="custom_login[cl_enable]" id="cl_enable">
                            <option value="yes" <?php echo ( isset( $wpc_custom_login['cl_enable'] ) && 'yes' == $wpc_custom_login['cl_enable'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_custom_login['cl_enable'] ) && 'no' == $wpc_custom_login['cl_enable'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>
                <tr <?php if( $this->permalinks ) { ?>style="display:none;"<?php } else {?>style="border: 1px solid #dd3d36;border-bottom: none;"<?php } ?>>
                    <td colspan="2">
                        <div style="background: #fff;border-left: 4px solid #dd3d36;padding: 10px 12px;line-height:20px;font-size:13px;box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);">
                            <?php _e( '<strong>Important!:</strong> Security settings for Hide WP Admin & Custom Login URL don\'t work with default permalinks. If you want to use this settings please change your permalink settings ', WPC_CLIENT_TEXT_DOMAIN ) ?><a href="<?php echo get_admin_url( get_current_blog_id(), 'options-permalink.php' ) ?>" target="_blank"><?php _e( 'HERE', WPC_CLIENT_TEXT_DOMAIN ) ?></a>.
                        </div>
                    </td>
                </tr>
                <tr valign="top" <?php if( !$this->permalinks ) { ?>style="border: 1px solid #dd3d36;border-bottom: none;border-top: none;"<?php } ?>>
                    <th scope="row">
                        <label for="cl_hide_site"><?php _e( 'Hide Site for not logged in Users', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="custom_login[cl_hide_site]" id="cl_hide_site" <?php disabled( !$this->permalinks ) ?>>
                            <option value="yes" <?php echo ( isset( $wpc_custom_login['cl_hide_site'] ) && 'yes' == $wpc_custom_login['cl_hide_site'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !isset( $wpc_custom_login['cl_hide_site'] ) || 'yes' != $wpc_custom_login['cl_hide_site'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description">
                            <?php _e( 'Non-logged in users will redirect to login page', WPC_CLIENT_TEXT_DOMAIN ) ?>
                        </span>
                    </td>
                </tr>
                <tr valign="top" <?php if( !$this->permalinks ) { ?>style="border: 1px solid #dd3d36;border-bottom: none;border-top: none;"<?php } ?>>
                    <th scope="row">
                        <label for="cl_hide_admin"><?php _e( 'Hide WP Admin', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="custom_login[cl_hide_admin]" id="cl_hide_admin" <?php disabled( !$this->permalinks ) ?>>
                            <option value="yes" <?php echo ( isset( $wpc_custom_login['cl_hide_admin'] ) && 'yes' == $wpc_custom_login['cl_hide_admin'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_custom_login['cl_hide_admin'] ) && 'no' == $wpc_custom_login['cl_hide_admin'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description">
                            <?php _e( 'Non-logged in users will receive a 404 when they try to access /wp-admin', WPC_CLIENT_TEXT_DOMAIN ) ?>
                        </span>
                    </td>
                </tr>

                <tr valign="top" <?php if( !$this->permalinks ) { ?>style="border: 1px solid #dd3d36;border-top: none;"<?php } ?>>
                    <th scope="row">
                        <label for="cl_login_url"><?php _e( 'Custom Login URL', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <label for="cl_login_url" style="cursor: default;"><b><?php echo home_url() . '/'; ?></b>&nbsp;&nbsp;
                            <input type="text" name="custom_login[cl_login_url]" id="cl_login_url" <?php disabled( !$this->permalinks ) ?> value="<?php echo ( isset( $wpc_custom_login['cl_login_url'] ) ) ? $wpc_custom_login['cl_login_url'] : '' ?>" style="width: 257px;"/>
                        </label>
                        <br />
                        <span class="description">
                            <?php echo __( 'This will change it from ', WPC_CLIENT_TEXT_DOMAIN ) . '<b>' . wp_guess_url() . '/wp-login.php' . '</b>' . __( ' to whatever you put in this box ', WPC_CLIENT_TEXT_DOMAIN ) . '. <br />' . __('Say if you put "login" into the box, your new login URL will be ' , WPC_CLIENT_TEXT_DOMAIN ) . home_url() . '/login/.' ?>
                        </span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="cl_logo_link"><?php _e( 'Logo Link (when clicked)', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="custom_login[cl_logo_link]" id="cl_logo_link" value="<?php echo ( isset( $wpc_custom_login['cl_logo_link'] ) ) ? $wpc_custom_login['cl_logo_link'] : '' ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="cl_logo_title"><?php _e( 'Logo Title (tooltip)', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="custom_login[cl_logo_title]" id="cl_logo_title" value="<?php echo ( isset( $wpc_custom_login['cl_logo_title'] ) ) ? $wpc_custom_login['cl_logo_title'] : '' ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="cl_background"><?php _e( 'Background Image Url', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="custom_login[cl_background]" id="cl_background" value="<?php echo ( isset( $wpc_custom_login['cl_background'] ) ) ? $wpc_custom_login['cl_background'] : '' ?>" />
                        <br />
                        <span class="description"><?php _e( 'URL path to image to use for background (sized 312px wide, and around 600px tall so that it can be cropped). <br /> You can upload your image with the media uploader', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="cl_backgroundColor"><?php _e( 'Page Background Color', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="custom_login[cl_backgroundColor]" id="cl_backgroundColor" value="<?php echo ( isset( $wpc_custom_login['cl_backgroundColor'] ) ) ? $wpc_custom_login['cl_backgroundColor'] : '' ?>" />
                        <br>
                        <span class="description"><?php _e( '6 digit hex color code', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="cl_color"><?php _e( 'Text Color', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="custom_login[cl_color]" id="cl_color" value="<?php echo ( isset( $wpc_custom_login['cl_color'] ) ) ? $wpc_custom_login['cl_color'] : '' ?>" />
                        <br>
                        <span class="description"><?php _e( '6 digit hex color code', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="cl_error_color"><?php _e( 'Error Text Color', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="custom_login[cl_error_color]" id="cl_error_color" value="<?php echo ( isset( $wpc_custom_login['cl_error_color'] ) ) ? $wpc_custom_login['cl_error_color'] : '' ?>" />
                        <br>
                        <span class="description"><?php _e( '6 digit hex color code', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="cl_linkColor"><?php _e( 'Text Link Color', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="custom_login[cl_linkColor]" id="cl_linkColor" value="<?php echo ( isset( $wpc_custom_login['cl_linkColor'] ) ) ? $wpc_custom_login['cl_linkColor'] : '' ?>" />
                        <br>
                        <span class="description"><?php _e( '6 digit hex color code', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label><?php _e( 'Form Border', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <label>
                        <input type="checkbox" name="custom_login[cl_form_border]" id="cl_form_border" value="1" <?php echo ( isset( $wpc_custom_login['cl_form_border'] ) && '1' == $wpc_custom_login['cl_form_border'] ) ? 'checked' : '' ?>" />
                        <?php _e( 'Hide Form Border', WPC_CLIENT_TEXT_DOMAIN ) ?>
                        </label>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <input type='submit' name='update_settings' class='button-primary' value='<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
</form>