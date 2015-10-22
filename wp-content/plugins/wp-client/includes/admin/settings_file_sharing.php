<?php if ( isset( $_POST['update_settings'] ) ) { if( isset( $_POST['wpc_file_sharing']['bulk_download_zip'] ) && !empty( $_POST['wpc_file_sharing']['bulk_download_zip'] ) ) { $_POST['wpc_file_sharing']['bulk_download_zip'] = trim( $_POST['wpc_file_sharing']['bulk_download_zip'] ); } if ( isset( $_POST['wpc_file_sharing'] ) ) { $settings = $_POST['wpc_file_sharing']; } else { $settings = array(); } do_action( 'wp_client_settings_update', $settings, 'file_sharing' ); wp_clear_scheduled_hook( 'wpc_client_ftp_synchronization' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=file_sharing&msg=u' ); exit; } $wpc_file_sharing = $this->cc_get_settings( 'file_sharing' ); ?>

<script type="text/javascript">
jQuery( document ).ready( function() {
    var plugin_url = '<?php echo $this->plugin_url ?>';

    jQuery( "#wpc_file_sharing_wp_thumbnail" ).change( function() {

        if( jQuery(this).val() == 'no' ) {
            jQuery("#wpc_file_sharing_custom_thumbnail_size").show();
        } else {
            jQuery("#wpc_file_sharing_custom_thumbnail_size").hide();
        }

    });

    jQuery( "#wpc_file_sharing_thumbnail_resize_now" ).click( function() {
        if( jQuery( "#wpc_file_sharing_wp_thumbnail" ).val() == 'no' && ( jQuery( "#wpc_file_sharing_thumbnail_size_w" ).val() == '' || jQuery( "#wpc_file_sharing_thumbnail_size_h" ).val() == '' ) ) {
            return false;
        }


        var wp_thumbnail = jQuery( "#wpc_file_sharing_wp_thumbnail" ).val();
        var thumbnail_size_w = jQuery( "#wpc_file_sharing_thumbnail_size_w" ).val();
        var thumbnail_size_h = jQuery( "#wpc_file_sharing_thumbnail_size_h" ).val();
        var thumbnail_crop = jQuery( "#wpc_file_sharing_thumbnail_crop" ).prop( "checked" );

        jQuery( '#resize_ajax_loader' ).show();
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo get_admin_url() ?>admin-ajax.php',
            data: 'action=wpc_resize_all_thumbnails&wp_thumbnail=' + wp_thumbnail + '&thumbnail_size_w=' + thumbnail_size_w + '&thumbnail_size_h=' + thumbnail_size_h + '&thumbnail_crop=' + thumbnail_crop,
            dataType: "json",
            success: function( data ){
                jQuery( '#resize_ajax_loader' ).hide();
                if( data.status ) {
                    jQuery( "#resize_ajax_answer" ).css('color', 'green');
                } else {
                    jQuery( "#resize_ajax_answer" ).css('color', 'red');
                }
                jQuery( "#resize_ajax_answer" ).html( data.message ).fadeIn(1500);
                setTimeout( function() {
                    jQuery( '#resize_ajax_answer' ).fadeOut(1500);
                }, 2500 );
            }
        });
    });

    jQuery( '#wpc_file_sharing_bulk_download_zip' ).keypress( function(e) {
        if( ( ( e.which == 0 || e.which == 8 ) && jQuery( this ).val().length > 0 ) || ( e.which > 47 && e.which < 58 ) || ( e.which > 64 && e.which < 91 ) || ( e.which > 96 && e.which < 123 ) ) {
            return true;
        }
        return false;
    });

    jQuery( '#wpc_file_sharing_file_size_limit' ).keypress( function(e) {
        if( ( ( e.which == 0 || e.which == 8 ) && jQuery( this ).val().length > 0 ) || ( e.which > 47 && e.which < 58 ) ) {
            return true;
        }
        return false;
    });

});
</script>

<form action="" method="post" name="wpc_settings" id="wpc_settings" >

    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'File Display Settings', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_view_type"><?php _e( 'View File Type', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[view_type]" id="wpc_file_sharing_view_type" style="width: 200px;">
                            <option value="regular" <?php selected( !( isset( $wpc_file_sharing['view_type'] ) && 'google_doc' == $wpc_file_sharing['view_type'] ) ); ?> ><?php _e( 'Regular', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="google_doc" <?php selected( isset( $wpc_file_sharing['view_type'] ) && 'google_doc' == $wpc_file_sharing['view_type'] ); ?> ><?php _e( 'Google Docs Embed', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"><?php _e( '(allow to view Files in Google Docs)', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_default_notify_checkbox"><?php printf( __( 'Make checkbox for sending email notification to %s about new files checked by default', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ); ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[default_notify_checkbox]" id="wpc_file_sharing_default_notify_checkbox" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_file_sharing['default_notify_checkbox'] ) && 'yes' == $wpc_file_sharing['default_notify_checkbox'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !( isset( $wpc_file_sharing['default_notify_checkbox'] ) && 'yes' == $wpc_file_sharing['default_notify_checkbox'] ) ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_nesting_category_assign"><?php _e( 'Nesting File Category Assigns', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[nesting_category_assign]" id="wpc_file_sharing_nesting_category_assign" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_file_sharing['nesting_category_assign'] ) && 'yes' == $wpc_file_sharing['nesting_category_assign'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !( isset( $wpc_file_sharing['nesting_category_assign'] ) && 'yes' == $wpc_file_sharing['nesting_category_assign'] ) ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_bulk_download_zip"><?php _e( 'Bulk Download ZIP file name', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="wpc_file_sharing[bulk_download_zip]" id="wpc_file_sharing_bulk_download_zip" value="<?php echo ( isset( $wpc_file_sharing['bulk_download_zip'] ) ) ? $wpc_file_sharing['bulk_download_zip'] : 'files' ?>" style="width: 200px;" />
                        <span class="description"><?php _e( '.zip', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                        <br>
                        <span class="description"><?php _e( 'ATTENTION!!!: Use only letters without spaces', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'File Upload Settings', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_show_file_note"><?php _e( 'Show File Description in Uploader', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[show_file_note]" id="wpc_file_sharing_show_file_note" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_file_sharing['show_file_note'] ) && 'yes' == $wpc_file_sharing['show_file_note'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !( isset( $wpc_file_sharing['show_file_note'] ) && 'yes' == $wpc_file_sharing['show_file_note'] ) ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"><?php printf( __( 'Display File Description in Uploader on %s HUB page.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_deny_file_cats"><?php printf( __( 'Enable category choice for %s file upload', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[deny_file_cats]" id="wpc_file_sharing_deny_file_cats" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_file_sharing['deny_file_cats'] ) && 'yes' == $wpc_file_sharing['deny_file_cats'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_file_sharing['deny_file_cats'] ) && 'no' == $wpc_file_sharing['deny_file_cats'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"><?php _e( 'By default, files will be uploaded in "General" category.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_deny_file_cats"><?php _e( 'Uploader in Admin area', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[flash_uplader_admin]" id="wpc_file_sharing_flash_uplader_admin" style="width: auto;">
                            <option value="regular" <?php echo ( isset( $wpc_file_sharing['flash_uplader_admin'] ) && 'regular' == $wpc_file_sharing['flash_uplader_admin'] ) ? 'selected' : '' ?> ><?php _e( 'Regular', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="html5" <?php echo ( isset( $wpc_file_sharing['flash_uplader_admin'] ) && 'html5' == $wpc_file_sharing['flash_uplader_admin'] ) ? 'selected' : '' ?> ><?php _e( 'HTML5 (with progress bar, multiple files uploading)', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="plupload" <?php echo ( isset( $wpc_file_sharing['flash_uplader_admin'] ) && 'plupload' == $wpc_file_sharing['flash_uplader_admin'] ) ? 'selected' : '' ?> ><?php _e( 'uberLOADER (with progress bar, multiple files uploading, chunking upload for big files)', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_deny_file_cats"><?php printf( __( 'Uploader in %s area', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[flash_uplader_client]" id="wpc_file_sharing_flash_uplader_client" style="width: auto;">
                            <option value="regular" <?php echo ( isset( $wpc_file_sharing['flash_uplader_client'] ) && 'regular' == $wpc_file_sharing['flash_uplader_client'] ) ? 'selected' : '' ?> ><?php _e( 'Regular', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="html5" <?php echo ( isset( $wpc_file_sharing['flash_uplader_client'] ) && 'html5' == $wpc_file_sharing['flash_uplader_client'] ) ? 'selected' : '' ?> ><?php _e( 'HTML5 (with progress bar, multiple files uploading)', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="plupload" <?php echo ( isset( $wpc_file_sharing['flash_uplader_client'] ) && 'plupload' == $wpc_file_sharing['flash_uplader_client'] ) ? 'selected' : '' ?> ><?php _e( 'uberLOADER (with progress bar, multiple files uploading, chunking upload for big files)', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_file_size_limit"><?php _e( 'Max File Size For Upload (Kb)', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="wpc_file_sharing[file_size_limit]" id="wpc_file_sharing_file_size_limit" value="<?php echo ( isset( $wpc_file_sharing['file_size_limit'] ) ) ? $wpc_file_sharing['file_size_limit'] : '' ?>" />
                        <span class="description"><?php _e( 'Remember: 1M = 1024Kb', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                        <br>
                        <span class="description"><?php _e( 'Leave blank to allow unlimited file size.<br>NOTE: This setting does not change your server settings. You should change your server settings if you are have trouble.<br>Your server settings are:', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                        <?php
 echo '<br><span class="description"><b>upload_max_filesize</b> = ' . ini_get( 'upload_max_filesize' ) . '</span>'; echo '<br><span class="description"><b>post_max_size</b> = ' . ini_get( 'post_max_size' ) . '</span>'; ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td></td>
                    <td>
                        <div style="display: none;" id="filesize_warning"><?php _e( 'Value must be numeric!', WPC_CLIENT_TEXT_DOMAIN ) ?></div>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_attach_file_admin"><?php printf( __( 'Attach uploaded files to the notification email sent to Admin/%s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[attach_file_admin]" id="wpc_file_sharing_attach_file_admin" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_file_sharing['attach_file_admin'] ) && 'yes' == $wpc_file_sharing['attach_file_admin'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !isset( $wpc_file_sharing['attach_file_admin'] ) || 'no' == $wpc_file_sharing['attach_file_admin'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"><?php _e( '(size may be limited by email providers)', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="postbox">
        <h3 class="hndle"><span><?php _e( 'FTP Syncronization Settings', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_manual_sync_author"><?php _e( 'Manual FTP Syncronization Author', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[manual_sync_author]" id="wpc_file_sharing_manual_sync_author" style="width: 150px;">
                            <option value="sync" <?php echo ( !isset( $wpc_file_sharing['manual_sync_author'] ) || 'sync' == $wpc_file_sharing['manual_sync_author'] ) ? 'selected' : '' ?>><?php _e( 'Syncronization', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="current_user" <?php echo ( isset( $wpc_file_sharing['manual_sync_author'] ) && 'current_user' == $wpc_file_sharing['manual_sync_author'] ) ? 'selected' : '' ?>><?php _e( 'Current User', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_ftp_synchronize"><?php _e( 'Auto Syncronize Files and File Categories with FTP', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[ftp_synchronize]" id="wpc_file_sharing_ftp_synchronize" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_file_sharing['ftp_synchronize'] ) && 'yes' == $wpc_file_sharing['ftp_synchronize'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !isset( $wpc_file_sharing['ftp_synchronize'] ) || 'no' == $wpc_file_sharing['ftp_synchronize'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_ftp_synchronize_period"><?php _e( 'Syncronization period every', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="text" name="wpc_file_sharing[ftp_synchronize_period]" id="wpc_file_sharing_ftp_synchronize_period" value="<?php echo ( isset( $wpc_file_sharing['ftp_synchronize_period'] ) ) ? $wpc_file_sharing['ftp_synchronize_period'] : '' ?>" style="width: 100px;text-align: right;"/>
                        <span class="description"><?php _e( 'minutes', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_sync_notification"><?php printf( __( 'Notify %s after new Files was assigned with FTP Syncronization', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[sync_notification]" id="wpc_file_sharing_sync_notification" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_file_sharing['sync_notification'] ) && 'yes' == $wpc_file_sharing['sync_notification'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !isset( $wpc_file_sharing['sync_notification'] ) || 'no' == $wpc_file_sharing['sync_notification'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_remote_sync"><?php _e( 'Remote Syncronization Link', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <span class="description"><?php echo __( 'You can use this link for remote syncronization', WPC_CLIENT_TEXT_DOMAIN ) . '<br /> <a href="' . add_query_arg( array( 'action'=>'wpc_client_remote_sync', 'key'=>get_option( 'wpc_client_sync_key' ) ), admin_url( 'admin-ajax.php' ) ) . '" >' . add_query_arg( array( 'action'=>'wpc_client_remote_sync', 'key'=>get_option( 'wpc_client_sync_key' ) ), admin_url( 'admin-ajax.php' ) ) . '</a>' ?></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="postbox">
        <h3 class='hndle'><span><?php _e( 'Thumbnails Settings', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_wp_thumbnail"><?php _e( 'Use Media Settings Thumbnail size?', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_file_sharing[wp_thumbnail]" id="wpc_file_sharing_wp_thumbnail" style="width: 100px;">
                            <option value="yes" <?php echo ( !isset( $wpc_file_sharing['wp_thumbnail'] ) || 'yes' == $wpc_file_sharing['wp_thumbnail'] ) ? 'selected' : '' ?> ><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_file_sharing['wp_thumbnail'] ) && 'no' == $wpc_file_sharing['wp_thumbnail'] ) ? 'selected' : '' ?> ><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>

                <tr valign="top" id="wpc_file_sharing_custom_thumbnail_size" style="<?php if( !isset( $wpc_file_sharing['wp_thumbnail'] ) || 'yes' == $wpc_file_sharing['wp_thumbnail'] ) { ?>display:none;<?php } ?>">
                    <th scope="row">
                        <label for="wpc_file_sharing_thumbnail_size"><?php _e( 'Thumbnail size', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <label><?php _e( 'Width', WPC_CLIENT_TEXT_DOMAIN ) ?> <input type="text" name="wpc_file_sharing[thumbnail_size_w]" id="wpc_file_sharing_thumbnail_size_w" value="<?php echo ( isset( $wpc_file_sharing['thumbnail_size_w'] ) && !empty( $wpc_file_sharing['thumbnail_size_w'] ) ) ? $wpc_file_sharing['thumbnail_size_w'] : '' ?>" style="width: 100px;"/> <?php _e( 'px', WPC_CLIENT_TEXT_DOMAIN ) ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label><?php _e( 'Height', WPC_CLIENT_TEXT_DOMAIN ) ?> <input type="text" name="wpc_file_sharing[thumbnail_size_h]" id="wpc_file_sharing_thumbnail_size_h" value="<?php echo ( isset( $wpc_file_sharing['thumbnail_size_h'] ) && !empty( $wpc_file_sharing['thumbnail_size_h'] ) ) ? $wpc_file_sharing['thumbnail_size_h'] : '' ?>" style="width: 100px;"/> <?php _e( 'px', WPC_CLIENT_TEXT_DOMAIN ) ?></label><br /><br />
                        <label><input type="checkbox" name="wpc_file_sharing[thumbnail_crop]" id="wpc_file_sharing_thumbnail_crop" value="1" <?php if( isset( $wpc_file_sharing['thumbnail_crop'] ) && !empty( $wpc_file_sharing['thumbnail_crop'] ) ) {?>checked="checked" <?php } ?>/> <?php _e( 'Crop thumbnail to exact dimensions (normally thumbnails are proportional)', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_file_sharing_thumbnail_size"><?php _e( 'Resize all thumbnails now?', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <input type="button" class="button" id="wpc_file_sharing_thumbnail_resize_now" value="<?php _e( 'Resize', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                        <span id="resize_ajax_loader" class="wpc_ajax_loading" style="display: none;"></span>
                        <span id="resize_ajax_answer" style="display: none;width: 200px;"></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <input type='submit' name='update_settings' class='button-primary' value='<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
</form>