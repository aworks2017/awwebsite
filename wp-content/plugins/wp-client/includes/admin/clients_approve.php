 <?php
//check auth
if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_approve_clients' ) ) {
    do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' );
}

if ( isset($_REQUEST['_wp_http_referer']) ) {
    $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) );
} else {
    $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=approve';
}
if ( isset( $_GET['action'] ) ) {
    switch ( $_GET['action'] ) {
        /* delete action */
        case 'delete':

            $clients_id = array();
            if ( isset( $_REQUEST['id'] ) ) {
                check_admin_referer( 'wpc_client_delete' .  $_REQUEST['id'] . get_current_user_id() );
                $clients_id = (array) $_REQUEST['id'];
            } elseif( isset( $_REQUEST['item'] ) )  {
                check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['client']['p'] ) );
                $clients_id = $_REQUEST['item'];
            }

            if ( count( $clients_id ) ) {
                foreach ( $clients_id as $client_id ) {
                    if( is_multisite() ) {
                        wpmu_delete_user( $client_id );
                    } else {
                        wp_delete_user( $client_id );
                    }
                }
                do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) );
                exit;
            }
            do_action( 'wp_client_redirect', $redirect );
            exit;

        break;
    }
}

//remove extra query arg
if ( !empty( $_GET['_wp_http_referer'] ) ) {
    do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) );
    exit;
}


global $wpdb;

$where_clause = '';
if( isset( $_GET['s'] ) && !empty( $_GET['s'] ) ) {
    $search_text = strtolower( trim( esc_sql( $_GET['s'] ) ) );
    $where_clause .= "AND (
        u.user_login LIKE '%" . $search_text . "%' OR
        u.display_name LIKE '%" . $search_text . "%' OR
        um.meta_value LIKE '%" . $search_text . "%' OR
        u.user_email LIKE '%" . $search_text . "%'
    )";
}

$not_approved = get_users( array( 'role' => 'wpc_client', 'meta_key' => 'to_approve', 'fields' => 'ID', ) );
$not_approved = " AND u.ID IN ('" . implode( "','", $not_approved ) . "')";

$order_by = 'u.user_registered';
if ( isset( $_GET['orderby'] ) ) {
    switch( $_GET['orderby'] ) {
        case 'user_login' :
            $order_by = 'user_login';
            break;
        case 'display_name' :
            $order_by = 'display_name';
            break;
        case 'business_name' :
            $order_by = 'um.meta_value';
            break;
        case 'user_email' :
            $order_by = 'user_email';
            break;
    }
}

$order = ( isset( $_GET['order'] ) && 'asc' ==  strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC';


if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class WPC_Staff_List_Table extends WP_List_Table {

    var $no_items_message = '';
    var $sortable_columns = array();
    var $default_sorting_field = '';
    var $actions = array();
    var $bulk_actions = array();
    var $columns = array();

    function __construct( $args = array() ){
        $args = wp_parse_args( $args, array(
            'singular'  => __( 'item', WPC_CLIENT_TEXT_DOMAIN ),
            'plural'    => __( 'items', WPC_CLIENT_TEXT_DOMAIN ),
            'ajax'      => false
        ) );

        $this->no_items_message = $args['plural'] . ' ' . __( 'not found.', WPC_CLIENT_TEXT_DOMAIN );

        parent::__construct( $args );


    }

    function __call( $name, $arguments ) {
        return call_user_func_array( array( $this, $name ), $arguments );
    }

    function prepare_items() {
        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array( $columns, $hidden, $sortable );
    }

    function column_default( $item, $column_name ) {
        if( isset( $item[ $column_name ] ) ) {
            return $item[ $column_name ];
        } else {
            return '';
        }
    }

    function no_items() {
        _e( $this->no_items_message, WPC_CLIENT_TEXT_DOMAIN );
    }

    function set_sortable_columns( $args = array() ) {
        $return_args = array();
        foreach( $args as $k=>$val ) {
            if( is_numeric( $k ) ) {
                $return_args[ $val ] = array( $val, $val == $this->default_sorting_field );
            } else if( is_string( $k ) ) {
                $return_args[ $k ] = array( $val, $k == $this->default_sorting_field );
            } else {
                continue;
            }
        }
        $this->sortable_columns = $return_args;
        return $this;
    }

    function get_sortable_columns() {
        return $this->sortable_columns;
    }

    function set_columns( $args = array() ) {
        if( count( $this->bulk_actions ) ) {
            $args = array_merge( array( 'cb' => '<input type="checkbox" />' ), $args );
        }
        $this->columns = $args;
        return $this;
    }

    function get_columns() {
        return $this->columns;
    }

    function set_actions( $args = array() ) {
        $this->actions = $args;
        return $this;
    }

    function get_actions() {
        return $this->actions;
    }

    function set_bulk_actions( $args = array() ) {
        $this->bulk_actions = $args;
        return $this;
    }

    function get_bulk_actions() {
        return $this->bulk_actions;
    }

    function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="item[]" value="%s" />', $item['id']
        );
    }

    function column_username( $item ) {
        global $wpc_client;

        $actions = array();

        //$actions['edit'] = '<a href="admin.php?page=wpclient_clients&tab=approve&action=approve&id=' . $item['id'] . '&_wpnonce=' . wp_create_nonce( 'wpc_client_approved' . $item['id'] . get_current_user_id() ) . '&_wp_http_referer=' . urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ) . '" >' . __( 'Approve', WPC_CLIENT_TEXT_DOMAIN ) . '</a>';
        $actions['edit'] = '<a onclick="jQuery(this).getGroups(' . $item['id'] . ');" href="#">' . __( 'Approve', WPC_CLIENT_TEXT_DOMAIN ) . '</a>';

        if ( current_user_can( 'wpc_view_client_details' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) {
            $actions['view'] = '<a href="#view_client" rel="' . $item['id'] . '_' . md5( 'wpcclientview_' . $item['id'] ) . '" class="various" >' . __( 'View', WPC_CLIENT_TEXT_DOMAIN ). '</a>';
        }

        $actions['delete']  = '<a onclick=\'return confirm("' . sprintf( __( 'Are you sure you want to delete this %s?', WPC_CLIENT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['s'] ) . '");\' href="admin.php?page=wpclient_clients&tab=approve&action=delete&id=' . $item['id'] . '&_wpnonce=' . wp_create_nonce( 'wpc_client_delete' . $item['id'] . get_current_user_id() ) . '&_wp_http_referer=' . urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ) . '" >' . __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ) . '</a>';

        return sprintf('%1$s %2$s', '<span id="username_' . $item['id'] . '">' . $item['username'] . '</span>', $this->row_actions( $actions ) );
    }


    function wpc_get_items_per_page( $attr = false ) {
        $per_page = $this->get_items_per_page( $attr );
        if( (int)$per_page > 100 ) {
            $per_page = 20;
        }
        return $per_page;
    }

    function wpc_set_pagination_args( $attr = false ) {
        return $this->set_pagination_args( $attr );
    }

}


$ListTable = new WPC_Staff_List_Table( array(
    'singular'  => $this->custom_titles['client']['s'],
    'plural'    => $this->custom_titles['client']['p'],
    'ajax'      => false

));

$per_page   = $ListTable->wpc_get_items_per_page( 'users_per_page' );
$paged      = $ListTable->get_pagenum();

$ListTable->set_sortable_columns( array(
    'username'          => 'user_login',
    'contact_name'      => 'display_name',
    'business_name'     => 'business_name',
    'email'             => 'user_email',
) );

$ListTable->set_bulk_actions(array(
    'approve'   => 'Approve',
    'delete'    => 'Delete',
));

$ListTable->set_columns(array(
    'cb'                => '<input type="checkbox" />',
    'username'          => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ),
    'contact_name'      => __( 'Contact Name', WPC_CLIENT_TEXT_DOMAIN ),
    'business_name'     => __( 'Business Name', WPC_CLIENT_TEXT_DOMAIN ),
    'email'             => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ),
));

$sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    WHERE
        um2.meta_key = '{$wpdb->prefix}capabilities'
        AND um2.meta_value LIKE '%s:10:\"wpc_client\";%'
        AND um.meta_key = 'wpc_cl_business_name'
        {$not_approved}
        {$where_clause}
    ";
$items_count = $wpdb->get_var( $sql );

$sql = "SELECT u.ID as id, u.user_login as username, u.display_name as contact_name, u.user_email as email, um.meta_value as business_name
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    WHERE
        um2.meta_key = '{$wpdb->prefix}capabilities'
        AND um2.meta_value LIKE '%s:10:\"wpc_client\";%'
        AND um.meta_key = 'wpc_cl_business_name'
        {$not_approved}
        {$where_clause}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page";
$clients = $wpdb->get_results( $sql, ARRAY_A );


$ListTable->prepare_items();
$ListTable->items = $clients;
$ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) );


?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        switch($msg) {
            case 'a':
                echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s is approved.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) . '</p></div>';
                break;
            case 'd':
                echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) . '</p></div>';
                break;
        }
    }
    ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block clients_approve">

            <form action="" method="get" name="wpc_clients_form" id="wpc_clients_form">

                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="approve" />
                <?php $ListTable->search_box( sprintf( __( 'Search %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'search-submit' ); ?>
                <?php $ListTable->display(); ?>
            </form>


            <div id="opaco"></div>
            <div id="opaco2"></div>

            <div id="popup_block" style="width: auto; left: 35%;">
                <form name="approve_client" method="post" >
                    <input type="hidden" name="wpc_action" value="client_approve" />
                    <input type="hidden" name="client_id" id="client_id" value="" />
                    <input type="hidden" value="<?php echo wp_create_nonce( 'wpc_client_approve' ) ?>" name="_wpnonce" id="_wpnonce">

                    <h3 id="assign_name"></h3>

                    <table>
                        <?php
                            //get managers
                            $args = array(
                                'role'      => 'wpc_manager',
                                'orderby'   => 'user_login',
                                'order'     => 'ASC',
                                'fields'    => array( 'ID','user_login' ),

                            );

                            $managers = get_users( $args );

                            if ( is_array( $managers ) && 0 < count( $managers ) ) { ?>
                            <tr>
                                <td>
                                    <?php
                                        $link_array = array(
                                            'title'   => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['p'] ),
                                            'text'    => sprintf( __( 'Assign To %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['manager']['p'] )
                                        );
                                        $input_array = array(
                                            'name'  => 'wpc_managers',
                                            'id'    => 'wpc_managers',
                                            'value' => ''
                                        );
                                        $additional_array = array(
                                            'counter_value' => 0
                                        );
                                        $this->acc_assign_popup('manager', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array );
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>
                                <?php
                                    $groups = $this->cc_get_groups();
                                    $selected_groups = array();
                                    foreach ( $groups as $group ) {
                                        if( '1' == $group['auto_select'] ) {
                                            $selected_groups[] = $group['group_id'];
                                        }
                                    }

                                    $link_array = array(
                                        'title'   => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ),
                                        'text'    => sprintf( __( 'Assign To %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['p'] )
                                    );
                                    $input_array = array(
                                        'name'  => 'wpc_circles',
                                        'id'    => 'wpc_circles',
                                        'value' => implode(',', $selected_groups)
                                    );
                                    $additional_array = array(
                                        'counter_value' => count( $selected_groups )
                                    );
                                    $this->acc_assign_popup('circle', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array );
                                ?>
                            </td>
                        </tr>
                        <tr style="height:15px;"><td>&nbsp;</td></tr>
                        <tr>
                            <td>
                                <input type="submit" name="save" id="save_popup" value="<?php _e( 'Approve', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                                <input type="button" name="cancel" id="cancel_popup" value="<?php _e( 'Cancel', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <?php if ( current_user_can( 'wpc_view_client_details' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>
            <div id="view_client" style="display: none;">
                <div id="wpc_client_details_content"></div>
            </div>
            <?php } ?>



        </div>


        <script type="text/javascript">
            jQuery(document).ready(function(){

                jQuery( '#doaction' ).click( function() {
                    var action = jQuery(this).parent().find('select[name=action]').val() ;
                    if( action == 'approve' ) {
                        var items = new Array();
                        jQuery('input[name="item[]"]:checked').each( function() {
                            items.push( jQuery( this ).val() );
                        });

                        jQuery(this).getGroups( items );
                    } else {
                        return true;
                    }
                    return false;
                });


                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery(this).parent().find('select[name=action2]').val() ;
                    if( action == 'approve' ) {
                        var items = new Array();
                        jQuery('input[name="item[]"]:checked').each( function() {
                            items.push( jQuery( this ).val() );
                        });

                        jQuery(this).getGroups( items );
                    } else {
                        jQuery( 'select[name="action"]' ).attr( 'value', action );
                        return true;
                    }
                    return false;
                });

                // AJAX - assign Client Circles to client
                jQuery.fn.getGroups = function ( client_id ) {
                    var assign_name = '<?php printf( __( 'Approve the %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?>: ' + jQuery( '#username_' + client_id ).html();

                    if( jQuery.isArray( client_id ) ) {
                        client_id = client_id.join(',');
                        assign_name = '<?php printf( __( 'Approve selected %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ?>';
                    }

                    jQuery( '#popup_content' ).html( '' );
                    jQuery( '#select_all' ).parent().hide();
                    jQuery( '#admin_manager :first' ).attr( 'selected', 'selected' );
                    jQuery( '#select_all' ).attr( 'checked', false );
                    jQuery( '#save_popup' ).hide();
                    jQuery( '#client_id' ).val( client_id );
                    jQuery( '#assign_name' ).html( assign_name );
                    jQuery( 'body' ).css( 'cursor', 'wait' );
                    jQuery( '#opaco' ).fadeIn( 'slow' );
                    jQuery( '#popup_block' ).fadeIn( 'slow' );

                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_admin_url() ?>admin-ajax.php',
                        data: 'action=get_all_groups',
                        success: function( html ){
                            jQuery( 'body' ).css( 'cursor', 'default' );
                            if ( 'false' == html ) {
                                jQuery( '#save_popup' ).show();
                            } else {
                                jQuery( '#save_popup' ).show();
                            }
                        }
                     });
                };


                //Cancel Assign block
                jQuery( "#cancel_popup" ).click( function() {
                    jQuery( '#popup_block' ).fadeOut( 'fast' );
                    jQuery( '#opaco' ).fadeOut( 'fast' );
                });

                //Select/Un-select
                jQuery( "#select_all" ).change( function() {
                    if ( 'checked' == jQuery( this ).attr( 'checked' ) ) {
                        jQuery( '#popup_content input[type="checkbox"]' ).attr( 'checked', true );
                    } else {
                        jQuery( '#popup_content input[type="checkbox"]' ).attr( 'checked', false );
                    }
                });


                <?php if ( current_user_can( 'wpc_view_client_details' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>
                //open view client
                jQuery( '.various' ).click( function() {
                    var id = jQuery( this ).attr( 'rel' );
                    jQuery( 'body' ).css( 'cursor', 'wait' );

                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_admin_url() ?>admin-ajax.php',
                        data: 'action=wpc_view_client&id=' + id,
                        dataType: "json",
                        success: function( data ){
                            jQuery( 'body' ).css( 'cursor', 'default' );

                            if( data.content ) {
                                jQuery( '#wpc_client_details_content' ).html( data.content );
                            } else {
                                jQuery( '#wpc_client_details_content' ).html( '' );
                            }

                        },

                     });

                     jQuery( '.various' ).fancybox({
                        minWidth    : 500,
                        minHeight   : 400,
                        autoResize  : true,
                        autoSize    : true,
                        closeClick  : false,
                        openEffect  : 'none',
                        closeEffect : 'none',
                        helpers : {
                            title : null,
                        }
                    });

                });
                <?php } ?>

            });
        </script>

    </div>

</div>

<?php
    $current_page = isset( $_GET['page'] ) ? $_GET['page'] : '';
    $this->acc_get_assign_circles_popup( $current_page );
    $this->acc_get_assign_managers_popup( $current_page );
?>
