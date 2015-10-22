<?php
 if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=files_categories'; } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $order_by = 'fc.cat_order'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'cat_name' : $order_by = 'fc.cat_name'; break; case 'cat_id' : $order_by = 'fc.cat_id'; break; case 'cat_order' : $order_by = 'fc.cat_order'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'DESC' : 'ASC'; $sql = "SELECT count( cat_id )
    FROM {$wpdb->prefix}wpc_client_file_categories
    "; $items_count = $wpdb->get_var( $sql ); $cats = $wpdb->get_results( "SELECT fc.cat_id AS cat_id, cat_name, folder_name, cat_order, parent_id, COUNT(f.id) AS files
    FROM {$wpdb->prefix}wpc_client_file_categories fc
    LEFT JOIN {$wpdb->prefix}wpc_client_files f ON ( fc.cat_id = f.cat_id )
    WHERE fc.parent_id = '0'
    GROUP BY fc.cat_id
    ORDER BY fc.cat_order ASC", ARRAY_A ); $count_childrens = $wpdb->get_col( "SELECT COUNT(fc2.cat_id) AS parent_count
    FROM {$wpdb->prefix}wpc_client_file_categories fc
    LEFT JOIN {$wpdb->prefix}wpc_client_file_categories fc2 ON ( fc2.parent_id = fc.cat_id )
    WHERE fc.parent_id = '0'
    GROUP BY fc.cat_id
    ORDER BY fc.cat_order ASC" ); $all_categories = $wpdb->get_results( "SELECT cat_id,
        cat_name
    FROM {$wpdb->prefix}wpc_client_file_categories
    WHERE parent_id='0'
    ORDER BY cat_order ASC", ARRAY_A ); $depth = 0; $categories = array(); foreach( $all_categories as $category ) { $categories[$category['cat_id']] = array( 'category_name'=>$category['cat_name'], 'depth' => $depth ); $children_categories = $this->cc_get_file_categories( $category['cat_id'], $depth ); $categories += $children_categories; } ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch($msg) { case 'null': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category name is null!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fnull': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category Folder Name is null!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cne': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category with this name already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fne': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category with this folder already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fe': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category Folder already exists on FTP!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cr': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category has been created!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'reas': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category is reassigned!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 's': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'The changes of the Category are saved!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category is deleted!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <a class="add-new-h2 wpc_form_link" id="slide_new_form_panel" href="javascript:;">
                <?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?>
                <span class="arrow"></span>
            </a>
            <a class="add-new-h2 wpc_form_link" id="slide_reasign_form_panel" href="javascript:;">
                <?php _e( 'Reassign Files', WPC_CLIENT_TEXT_DOMAIN ) ?>
                <span class="arrow"></span>
            </a>
            <span class="display_link_block">
                <a class="display_link selected_link" href="#"><?php _e( 'New view', WPC_CLIENT_TEXT_DOMAIN ) ?></a> |
                <a class="display_link" href="admin.php?page=wpclients_content&tab=files_categories&display=old"><?php _e( 'Old view', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            </span>

            <div id="new_form_panel">
                <table class="">
                    <tr>
                        <td>
                            <h3><?php _e( 'New Category', WPC_CLIENT_TEXT_DOMAIN ) ?></h3>

                            <form method="post" name="new_cat" id="new_cat" >
                                <input type="hidden" name="wpc_action" value="create_file_cat" />
                                <table class="">
                                    <tr>
                                        <td>
                                            <label for="cat_name_new"><?php _e( 'Title', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                        </td>
                                        <td>
                                            <input type="text" name="cat_name_new" id="cat_name_new" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="cat_folder_new"><?php _e( 'Folder name', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                        </td>
                                        <td>
                                            <input type="text" name="cat_folder_new" id="cat_folder_new" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="parent_cat"><?php _e( 'Parent', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                        </td>
                                        <td>
                                            <select name="parent_cat" id="parent_cat">
                                                <option value="0"><?php _e( '(no parent)', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                                <?php foreach( $categories as $cat_id=>$value ) { ?>
                                                    <option value="<?php echo $cat_id ?>" >
                                                        <?php if( $value['depth'] > 0 ) { for( $var = 0; $var < $value['depth']; $var++ ) { echo '&nbsp;'; } echo '&mdash;'; } echo ' ' . $value['category_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label><?php echo $this->custom_titles['client']['p'] ?>:</label>
                                        </td>
                                        <td>
                                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to File Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'wpclients_filescat', $link_array, $input_array, $additional_array ); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label><?php echo $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ?>:</label>
                                        </td>
                                        <td>
                                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to File Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('circle', 'wpclients_filescat', $link_array, $input_array, $additional_array ); ?>
                                        </td>
                                    </tr>
                                </table>
                                <br />
                                <input type="submit" class='button-primary' value="<?php _e( 'Create Category', WPC_CLIENT_TEXT_DOMAIN ) ?>" name="create_cat" />
                            </form>
                        </td>
                    </tr>
                </table>
            </div>

            <div id="reasign_form_panel">
                <h3><?php _e( 'Reassign Files Category', WPC_CLIENT_TEXT_DOMAIN ) ?></h3>
                <form method="post" name="reassign_files_cat" id="reassign_files_cat" >
                    <input type="hidden" name="wpc_action" id="wpc_action3" value="" />
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <label for="old_cat_id"><?php _e( 'Category From', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="old_cat_id" id="old_cat_id">
                                    <?php foreach( $categories as $cat_id=>$value ) { ?>
                                        <option value="<?php echo $cat_id ?>">
                                            <?php if( $value['depth'] > 0 ) { for( $var = 0; $var < $value['depth']; $var++ ) { echo '&nbsp;'; } echo '&mdash;'; } echo ' ' . $value['category_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="new_cat_id"><?php _e( 'Category To', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="new_cat_id" id="new_cat_id">
                                    <?php foreach( $categories as $cat_id=>$value ) { ?>
                                        <option value="<?php echo $cat_id ?>">
                                            <?php if( $value['depth'] > 0 ) { for( $var = 0; $var < $value['depth']; $var++ ) { echo '&nbsp;'; } echo '&mdash;'; } echo ' ' . $value['category_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <br />
                    <input type="button" class="button-primary" name="" value="<?php _e( 'Reassign', WPC_CLIENT_TEXT_DOMAIN ) ?>" id="reassign_files" />
                </form>
            </div>

            <p>
                <span class="description" >
                    <?php _e( 'Drag&Drop items for change category order.', WPC_CLIENT_TEXT_DOMAIN ) ?>
                </span>
            </p>

            <form action="" method="get" name="edit_cat" id="edit_cat">
                <input type="hidden" name="wpc_action" id="wpc_action2" value="" />
                <input type="hidden" name="cat_id" id="cat_id" value="" />
                <input type="hidden" name="reassign_cat_id" id="reassign_cat_id" value="" />

                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="files_categories" />

                <table style="margin-top:5px;float: left;width:100%;font-weight: 400;font-size: 14px;font-family: 'Open Sans',sans-serif;line-height: 1.4em;color: #333;">
                    <tr>
                        <td><?php _e( 'Category Name (#ID)', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                        <td style="width: 290px;"><?php _e( 'Folder Name', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                        <td style="width: 100px;text-align: center;"><?php _e( 'Files', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                        <td style="width: 100px;text-align: center;"><?php echo $this->custom_titles['client']['p'] ?></td>
                        <td style="width: 100px;text-align: center;"><?php echo $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ?></td>
                    </tr>
                </table>
                <ol class="sortable hidden_content" style="position:relative;">
                    <?php foreach( $cats as $key=>$cat ) { ?>
                        <li class="sortable_loading" style="background:#fff;height:100%;position:absolute;width:100%;top:0;left:0;margin:0;padding:0;"><div class="ajax_sort_loading"></div></li>
                        <li id="list_<?php echo $cat['cat_id'] ?>" class="sortable_item">
                            <div class="category">
                                <span class="disclose">
                                &nbsp;</span>
                                <div class="category_name">
                                    <span id="cat_name_block_<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_name'] ?></span>
                                    <span id="cat_id_block_<?php echo $cat['cat_id'] ?>"><?php echo ' (#' . $cat['cat_id'] . ')' ?></span>
                                    <div id="save_or_close_block_<?php echo $cat['cat_id'] ?>" style="display:none">
                                        <a href="javascript:void(0);" id="close_button_<?php echo $cat['cat_id'] ?>" onclick="jQuery(this).editGroup('<?php echo $cat['cat_id'] ?>', 'close' );" >
                                            <?php _e( 'Close', WPC_CLIENT_TEXT_DOMAIN ) ?>
                                        </a>&nbsp;|&nbsp;
                                        <a href="javascript:void(0);" id="save_button_<?php echo $cat['cat_id'] ?>" onClick="jQuery(this).saveGroup();">
                                            <?php _e( 'Save', WPC_CLIENT_TEXT_DOMAIN ) ?>
                                        </a>
                                    </div>

                                    <?php if ( 'General' != $cat['cat_name'] ) { ?>

                                        <div class="row-actions">
                                            <span class="edit">
                                                <a id="edit_button_<?php echo $cat['cat_id'] ?>" onclick="jQuery(this).editGroup( '<?php echo $cat['cat_id'] ?>', 'edit' );"><?php _e( 'Edit', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                                <span id="save_block_<?php echo $cat['cat_id'] ?>"></span> |
                                            </span>
                                            <?php $show_or_delete = ( 0 < $cat['files'] ) ? 'show' : 'delete' ; ?>
                                            <span class="delete">
                                                <a class="group_delete" onclick="jQuery(this).deleteCat( '<?php echo $cat['cat_id'] ?>', '<?php echo $show_or_delete ?>');"><?php _e( 'Delete', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                            </span>
                                        </div>

                                        <?php if ( 0 < $cat['files'] ) { ?>
                                            <div class="cat_reassign_block" id="cat_reassign_block_<?php echo $cat['cat_id'] ?>">
                                                <hr />
                                                <span><b><?php _e( 'Category have Files. What do with Files', WPC_CLIENT_TEXT_DOMAIN ) ?>:</b></span>
                                                <br />
                                                <select name="cat_reassign">
                                                    <?php foreach( $categories as $cat_id=>$value ) { if ( $cat['cat_id'] != $cat_id ) { ?>
                                                            <option value="<?php echo $cat_id ?>">
                                                                <?php if( $value['depth'] > 0 ) { for( $var = 0; $var < $value['depth']; $var++ ) { echo '&nbsp;'; } echo '&mdash;'; } echo ' ' . $value['category_name']; ?>
                                                            </option>
                                                        <?php } } ?>
                                                </select>
                                                <input type="button" value="<?php _e( 'Reassign Files', WPC_CLIENT_TEXT_DOMAIN ) ?>" onclick="jQuery(this).deleteCat( '<?php echo $cat['cat_id'] ?>', 'reassign' );" />
                                                <?php _e( 'or', WPC_CLIENT_TEXT_DOMAIN ) ?>
                                                <input type="button" value="<?php _e( 'Delete Files', WPC_CLIENT_TEXT_DOMAIN )?>" onclick="jQuery(this).deleteCat( '<?php echo $cat['cat_id'] ?>', 'delete' );" />
                                            </div>
                                        <?php } } ?>
                                </div>
                                <div style="float: right;width: 600px;">
                                    <div style="float: left;width:300px;height:33px;">
                                        <span style="float: left;width:100%;height:33px;" id="folder_name_block_<?php echo $cat['cat_id'] ?>"><?php echo $cat['folder_name'] ?></span>
                                    </div>
                                    <div style="float: left;width:100px;text-align: center;"><?php echo $cat['files'] ?></div>
                                    <div style="float: left;width:100px;text-align: center;">
                                        <?php
 $id_array = $this->cc_get_assign_data_by_object( 'file_category', $cat['cat_id'], 'client' ); if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_clients = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'client' ); $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); foreach ( $manager_groups as $group_id ) { $add_client = $this->cc_get_group_clients_id( $group_id ); $manager_clients = array_merge( $manager_clients, $add_client ); } $manager_clients = array_unique( $manager_clients ); } $user_count = 0; foreach ( $id_array as $client_id ) { if ( 0 < $client_id ) { if ( isset( $manager_clients ) && !in_array( $client_id, $manager_clients ) ) continue; if( !empty( $client_id ) ) { $user_count++; } } } $link_array = array( 'title' => sprintf( __( 'Assign %s to', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) . ' ' . $cat['cat_name'], 'data-ajax' => true, 'data-id' => $cat['cat_id'], ); $input_array = array( 'name' => 'wpc_clients_ajax[]', 'id' => 'wpc_clients_' . $cat['cat_id'], 'value' => implode( ',', $id_array ) ); $additional_array = array( 'counter_value' => $user_count ); $this->acc_assign_popup( 'client', 'wpclients_filescat', $link_array, $input_array, $additional_array ); ?>
                                    </div>
                                    <div style="float: left;width:100px;text-align: center;">
                                        <?php $id_array = $this->cc_get_assign_data_by_object( 'file_category', $cat['cat_id'], 'circle' ); if( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_manager' ) ) { $link_array = array( 'data-id' => $cat['cat_id'], 'data-ajax' => 1, 'title' => sprintf( __( 'Assign %s to', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ) . ' ' . $cat['cat_name'] ); $input_array = array( 'name' => 'wpc_circles_ajax[]', 'id' => 'wpc_circles_' . $cat['cat_id'], 'value' => implode( ',', $id_array ) ); $additional_array = array( 'counter_value' => count( $id_array ) ); $this->acc_assign_popup( 'circle', 'wpclients_filescat', $link_array, $input_array, $additional_array ); } ?>
                                    </div>
                                </div>
                            </div>

                            <?php if( isset( $count_childrens[$key] ) && (int)$count_childrens[$key] > 0 ) { ?>
                                <ol>
                                    <?php echo $this->ac_children_categories( $cat['cat_id'] ); ?>
                                </ol>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ol>
            </form>


        </div>

        <script type="text/javascript">
            var site_url = '<?php echo site_url();?>';

            jQuery( document ).ready( function() {


                //show/hide forms with actions
                jQuery( '.wpc_form_link' ).click( function() {
                    var obj = jQuery( this );
                    var link_id = jQuery( this ).attr( 'id' );
                    var form_id = link_id.replace( /slide_/g, "" );


                    jQuery( '.wpc_form_link' ).each( function(e) {
                        if( link_id != jQuery( this ).attr( 'id' ) ) {
                            jQuery( this ).removeClass( 'active' );
                            jQuery( '#' + jQuery( this ).attr( 'id' ).replace( /slide_/g, "" ) ).slideUp( 'slow' );
                        }
                    });

                    if( !obj.hasClass( 'active' ) ) {
                        jQuery( '#' + link_id ).addClass( 'active' );
                        jQuery( '#' + form_id ).slideDown( 'slow' );
                    } else {
                        jQuery( '#' + link_id ).removeClass( 'active' );
                        jQuery( '#' + form_id ).slideUp( 'slow' );
                    }

                });


                var group_name          = "";
                var group_auto_select   = "";


                var folder_name          = "";

                jQuery.fn.editGroup = function ( id, action ) {
                    if ( action == 'edit' ) {
                        jQuery( '#cat_id_block_' + id ).hide();

                        group_name = jQuery( '#cat_name_block_' + id ).html();
                        group_name = group_name.replace(/(^\s+)|(\s+$)/g, "");

                        folder_name = jQuery( '#folder_name_block_' + id ).html();
                        folder_name = folder_name.replace(/(^\s+)|(\s+$)/g, "");

                        jQuery( '#cat_name_block_' + id ).html( '<input type="text" name="cat_name" size="15" id="edit_cat_name"  value="' + group_name + '" /><input type="hidden" name="cat_id" value="' + id + '" />' );
                        jQuery( '#folder_name_block_' + id ).html( '<input type="text" name="folder_name" size="15" id="edit_folder_name"  value="' + folder_name + '" />' );

                        jQuery( '#edit_cat input[type="button"]' ).attr( 'disabled', true );

                        jQuery( this ).parent().parent().attr('style', "display:none" );
                        jQuery( '#save_or_close_block_' + id ).attr('style', "display:block;" );

                        return;

                    } else if ( action == 'close' ) {
                        jQuery( '#cat_id_block_' + id ).show();
                        jQuery( '#cat_name_block_' + id ).html( group_name );
                        jQuery( '#folder_name_block_' + id ).html( folder_name );

                        jQuery( '#save_or_close_block_' + id ).attr('style', "display:none;" );
                        jQuery( this ).parent().next().attr('style', "display:block" );

                        return;
                    }


                };


                jQuery.fn.saveGroup = function ( ) {

                    jQuery( '#edit_cat_name' ).parent().parent().removeClass( 'wpc_error' );

                    if ( '' == jQuery( '#edit_cat_name' ).val() ) {
                        jQuery( '#edit_cat_name' ).parent().parent().addClass( 'wpc_error' );
                        return false;
                    }

                    jQuery( '#wpc_action2' ).val( 'edit_file_cat' );
                    jQuery( '#edit_cat' ).submit();
                };


                //block for delete cat
                jQuery.fn.deleteCat = function ( id, act ) {
                    if ( 'show' == act ) {
                        jQuery( '#cat_reassign_block_' + id ).slideToggle( 'slow' );

                        if( jQuery(this).html() == '<?php _e( 'Cancel Delete', WPC_CLIENT_TEXT_DOMAIN ) ?>' ) {
                            jQuery(this).html( '<?php _e( 'Delete', WPC_CLIENT_TEXT_DOMAIN ) ?>' );
                        } else {
                            jQuery(this).html( '<?php _e( 'Cancel Delete', WPC_CLIENT_TEXT_DOMAIN ) ?>' );
                        }

                    } else if( 'reassign' == act ) {
                        if( confirm("<?php _e( 'Are you sure want to delete permanently this category and reassign all files and parent categories to another category? ', WPC_CLIENT_TEXT_DOMAIN ) ?>") ) {
                            jQuery( '#wpc_action2' ).val( 'delete_file_category' );
                            jQuery( '#cat_id' ).val( id );
                            jQuery( '#reassign_cat_id' ).val( jQuery( '#cat_reassign_block_' + id + ' select' ).val() );
                            jQuery( '#edit_cat' ).submit();
                        }
                    } else if( 'delete' == act ) {
                        if( confirm("<?php _e( 'Are you sure want to delete permanently this category with all files and parent categories? ', WPC_CLIENT_TEXT_DOMAIN ) ?>") ) {
                            jQuery( '#wpc_action2' ).val( 'delete_file_category' );
                            jQuery( '#cat_id' ).val( id );
                            jQuery( '#edit_cat' ).submit();
                        }
                    }
                };


                //Reassign files to another cat
                jQuery( '#reassign_files' ).click( function() {
                    if ( jQuery( '#old_cat_id' ).val() == jQuery( '#new_cat_id' ).val() ) {
                        jQuery( '#old_cat_id' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }
                    jQuery( '#wpc_action3' ).val( 'reassign_files_from_category' );
                    jQuery( '#reassign_files_cat' ).submit();
                    return false;
                });


                jQuery( 'input[name=create_cat]' ).click( function() {
                    if( jQuery( '#cat_name_new' ).val() != '' ) {
                        return true;
                    }
                    return false;
                });

                // sortable
                jQuery('ol.sortable').nestedSortable({
                    forcePlaceholderSize: true,
                    handle: 'div',
                    helper: 'clone',
                    items: 'li:not(.sortable_loading)',
                    opacity: .6,
                    placeholder: 'placeholder',
                    revert: 250,
                    tabSize: 25,
                    tolerance: 'pointer',
                    toleranceElement: '> div',
                    listType: 'ol',

                    isTree: true,
                    expandOnHover: 700,
                    startCollapsed: true,
                    hoveringClass: 'wpc_category-hovering',
                    collapsedClass: 'wpc_category-collapsed',
                    expandedClass: 'wpc_category-expanded',
                    branchClass: 'wpc_category-branch',
                    leafClass: 'wpc_category-leaf',

                    update: function (event, ui) {
                        var data = jQuery(this).nestedSortable( 'toArray' );
                        var currentItem = jQuery(this).nestedSortable( 'getCurrentItem', {currentID: jQuery( ui.item ).attr('id')} );

                        var height = jQuery( 'ol.sortable' ).height();
                        jQuery( 'ol.sortable' ).prepend( '<li class="sortable_loading" style="background:rgba(255, 255, 255, 0.75);height:' + height + 'px;position:absolute;width:100%;top:0;left:0;margin:0;padding:0;"><div class="ajax_sort_loading"></div></li>' );

                        jQuery( 'body' ).css( 'cursor', 'wait' );
                        jQuery.ajax({
                            type: 'POST',
                            url: '<?php echo get_admin_url() ?>admin-ajax.php',
                            data: {
                                'action':'change_cat_order',
                                'new_order': jQuery.base64Encode( window.JSON.stringify(data) ),
                                'current_item': jQuery.base64Encode( window.JSON.stringify(currentItem) )
                            },
                            success: function( html ) {
                                if( html == '<?php _e( 'This folder is already exist in this level', WPC_CLIENT_TEXT_DOMAIN ) ?>' ) {
                                    alert( html );
                                    jQuery( 'ol.sortable .sortable_loading' ).remove();
                                    jQuery( 'ol.sortable' ).nestedSortable( 'cancel' );
                                } else {
                                    jQuery( 'ol.sortable .sortable_loading' ).remove();
                                    jQuery( 'body' ).css( 'cursor', 'default' );
                                }
                            }
                        });
                    },
                    create: function( event, ui ) {
                        jQuery( 'ol.sortable .sortable_loading' ).remove();
                        jQuery( 'ol.sortable' ).removeClass('hidden_content');
                    }
                });


                jQuery('.disclose').on('click', function() {
                    jQuery(this).parent().parent().toggleClass('wpc_category-collapsed').toggleClass('wpc_category-expanded');
                });

            });
        </script>

    </div>

</div>