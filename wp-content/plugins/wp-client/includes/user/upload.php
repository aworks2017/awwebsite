<?php
ob_start(); global $post, $wpdb, $current_user; if ( !ini_get( 'safe_mode' ) ) { @set_time_limit(0); } $wpc_file_sharing = $this->cc_get_settings( 'file_sharing' ); ?>

<div class="wpc_client_upload_form">

<?php
if ( is_multisite() && !is_upload_space_available() ) { echo '<p>' . __( 'Sorry, you have used all of your storage quota.', WPC_CLIENT_TEXT_DOMAIN ) . '</p>'; } else { if ( isset( $wpc_file_sharing['flash_uplader_client'] ) && 'html5' == $wpc_file_sharing['flash_uplader_client'] ) { $uploader_id = rand( 0, 10000 ); if ( isset( $_GET['msg'] ) && 'success' == $_GET['msg'] ) echo '<br /><p style="margin:0;padding:0">' . __( 'File was uploaded successfully!', WPC_CLIENT_TEXT_DOMAIN ) . '</p>'; ?>
            <div id="uploader_warning" style="display: none;"></div>
            <form enctype="multipart/form-data" method="post">
                <br clear="all" />
                <input type="hidden" name="include_ext" id="include_ext_<?php echo $uploader_id ?>" value="<?php echo ( isset( $atts['include'] ) && '' != $atts['include'] ) ? $atts['include'] : '' ?>">
                <input type="hidden" name="exclude_ext" id="exclude_ext_<?php echo $uploader_id ?>" value="<?php echo ( isset( $atts['exclude'] ) && '' != $atts['exclude'] ) ? $atts['exclude'] : '' ?>">
                <div class="button_addfile">
                    <?php echo $this->build_uploader_category_selectbox( $client_id, $uploader_id, $atts ); ?>

                    <div id="queue_<?php echo $uploader_id ?>" class="wpc_uploadifive_queue"></div>
                    <input id="wpc_file_upload_<?php echo $uploader_id ?>" class="wpc_file_upload" name="Filedata" data-form_id="<?php echo $uploader_id ?>" type="file" multiple="true">
                    <?php if( !( isset( $atts['auto_upload'] ) && 'yes' == $atts['auto_upload'] ) ) { ?><a class="button" style="position: relative; top: 8px;" href="javascript:jQuery( '#wpc_file_upload_<?php echo $uploader_id ?>' ).uploadifive('upload')"><?php _e( 'Upload Files', WPC_CLIENT_TEXT_DOMAIN ) ?></a><?php } ?>
                </div>
            </form>
    <?php } elseif( isset( $wpc_file_sharing['flash_uplader_client'] ) && 'plupload' == $wpc_file_sharing['flash_uplader_client'] ) { $uploader_id = rand( 0, 10000 ); if ( isset( $_GET['msg'] ) && 'success' == $_GET['msg'] ) echo '<br /><p style="margin:0;padding:0">' . __( 'File was uploaded successfully!', WPC_CLIENT_TEXT_DOMAIN ) . '</p>'; if( ( isset( $atts['include'] ) && '' != $atts['include'] ) || ( isset( $atts['exclude'] ) && '' != $atts['exclude'] ) ) { $include_array = ( isset( $atts['include'] ) && '' != $atts['include'] ) ? explode( ',', $atts['include'] ) : array(); $exclude_array = ( isset( $atts['exclude'] ) && '' != $atts['exclude'] ) ? explode( ',', $atts['exclude'] ) : array(); if( isset( $atts['include'] ) && '' != $atts['include'] ) { if( is_array( $exclude_array ) && 0 < count( $exclude_array ) ) { $include_array = array_diff( $include_array, $exclude_array ); } $text = implode( ', ', $include_array ); $text = __( 'All files, exclude ', WPC_CLIENT_TEXT_DOMAIN ) . implode( ', ', $include_array ); } elseif( isset( $atts['exclude'] ) && '' != $atts['exclude'] && !( isset( $atts['include'] ) && '' != $atts['include'] ) ) { $text = implode( ', ', $exclude_array ); } ?>
            <div id="uploader_warning"> <?php echo $text . __( ' files will be not uploaded', WPC_CLIENT_TEXT_DOMAIN ) ?></div>
        <?php } ?>

        <form enctype="multipart/form-data" method="post">
            <br clear="all" />
            <input type="hidden" name="include_ext" id="include_ext_<?php echo $uploader_id ?>" value="<?php echo ( isset( $atts['include'] ) && '' != $atts['include'] ) ? $atts['include'] : '' ?>">
            <input type="hidden" name="exclude_ext" id="exclude_ext_<?php echo $uploader_id ?>" value="<?php echo ( isset( $atts['exclude'] ) && '' != $atts['exclude'] ) ? $atts['exclude'] : '' ?>">
            <div class="button_addfile">
                <?php echo $this->build_uploader_category_selectbox( $client_id, $uploader_id, $atts ); ?>

                <div id="queue_<?php echo $uploader_id ?>" class="wpc_plupload_queue" data-form_id="<?php echo $uploader_id ?>">
                    <p><?php _e( "Your browser doesn't have Flash, Silverlight or HTML5 support.", WPC_CLIENT_TEXT_DOMAIN ) ?></p>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <!-- Regular uploader -->
        <?php
 $uploader_id = rand( 0, 10000 ); if ( isset( $_GET['msg'] ) && 'success' == $_GET['msg'] ) echo '<br /><p style="margin:0;padding:0">' . __( 'File was uploaded successfully!', WPC_CLIENT_TEXT_DOMAIN ) . '</p>'; if ( isset( $msg ) && !empty( $msg ) ) echo '<br><p>' . $msg . '</p>'; ?>

        <div id="uploader_warning" style="display: none;"> <?php _e( 'File will be not uploaded', WPC_CLIENT_TEXT_DOMAIN ) ?></div><br />
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file" />
            <?php if( isset( $wpc_file_sharing['show_file_note'] ) && 'yes' == $wpc_file_sharing['show_file_note'] ) { ?>
                <textarea class="note_field" name="note" rows="5" cols="50"></textarea>
            <?php } ?>
            <br />
            <br />
            <input type="hidden" name="include_ext" id="include_ext" value="<?php echo ( isset( $atts['include'] ) && '' != $atts['include'] ) ? $atts['include'] : '' ?>">
            <input type="hidden" name="exclude_ext" id="exclude_ext" value="<?php echo ( isset( $atts['exclude'] ) && '' != $atts['exclude'] ) ? $atts['exclude'] : '' ?>">
            <input type="hidden" name="wpc_auto_upload" id="wpc_auto_upload" value="<?php echo ( isset( $atts['auto_upload'] ) && '' != $atts['auto_upload'] ) ? $atts['auto_upload'] : '' ?>">

            <?php echo $this->build_uploader_category_selectbox( $client_id, $uploader_id, $atts ); ?>

            <input type="submit" value="<?php _e( 'Upload File', WPC_CLIENT_TEXT_DOMAIN ) ?>" name="b[upload]" id="uploader_submit" <?php if( isset( $atts['auto_upload'] ) && 'yes' == $atts['auto_upload'] ) { ?>style="display: none;"<?php } ?> />
        </form>
    <?php } } ?>
</div>

<?php $out2 = ob_get_contents(); if( ob_get_length() ) { ob_end_clean(); } return $out2; ?>