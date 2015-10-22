 <?php

//check auth
if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_approve_staff' ) ) {
    do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' );
}

if ( isset($_REQUEST['_wp_http_referer']) ) {
    $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) );
} else {
    $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=staff_approve';
}
if ( isset( $_GET['action'] ) ) {
    switch ( $_GET['action'] ) {
        /* delete action */
        case 'delete':

            $clients_id = array();
            if ( isset( $_REQUEST['id'] ) ) {
                check_admin_referer( 'wpc_staff_approve_delete' .  $_REQUEST['id'] . get_current_user_id() );
                $clients_id = (array) $_REQUEST['id'];
            } elseif( isset( $_REQUEST['item'] ) )  {
                check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['staff']['p'] ) );
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
        /* approve action */
        case 'approve':

            $clients_id = array();
            if ( isset( $_REQUEST['id'] ) ) {
                check_admin_referer( 'wpc_staff_approved' .  $_REQUEST['id'] . get_current_user_id() );
                $clients_id = (array) $_REQUEST['id'];
            } elseif( isset( $_REQUEST['item'] ) )  {
                check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['staff']['p'] ) );
                $clients_id = $_REQUEST['item'];
            }
            if ( count( $clients_id ) ) {
                foreach ( $clients_id as $client_id ) {
                    delete_user_meta( $client_id, 'to_approve' );
                }
                do_action( 'wp_client_redirect', add_query_arg( 'msg', 'a', $redirect ) );
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
        um2.meta_value LIKE '%" . $search_text . "%' OR
        u.user_email LIKE '%" . $search_text . "%'
    )";
}

$not_approved = get_users( array( 'role' => 'wpc_client_staff', 'meta_key' => 'to_approve', 'fields' => 'ID', ) );
$not_approved = " AND u.ID IN ('" . implode( "','", $not_approved ) . "')";

$order_by = 'u.user_registered';
if ( isset( $_GET['orderby'] ) ) {
    switch( $_GET['orderby'] ) {
        case 'username' :
            $order_by = 'u.user_login';
            break;
        case 'first_name' :
            $order_by = 'um2.meta_value';
            break;
        case 'email' :
            $order_by = 'u.user_email';
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

    function column_client( $item ) {
        $parent_client_id = $item['parent_client_id'];
        $client_name = '';
        if ( 0 < $parent_client_id ) {
            $client = get_userdata( $parent_client_id );
            if ( $client ) {
                $client_name = $client->get( 'user_login' );
            }
        }

        return $client_name;
    }

    function column_username( $item ) {
        global $wpc_client;

        $actions = array();

        $actions['edit'] = '<a href="admin.php?page=wpclient_clients&tab=staff_approve&action=approve&id=' . $item['id'] . '&_wpnonce=' . wp_create_nonce( 'wpc_staff_approved' . $item['id'] . get_current_user_id() ) . '&_wp_http_referer=' . urlencode( stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) . '" >' . __( 'Approve', WPC_CLIENT_TEXT_DOMAIN ) . '</a>';
        $actions['delete']  = '<a onclick=\'return confirm("' . sprintf( __( 'Are you sure you want to delete this %s?', WPC_CLIENT_TEXT_DOMAIN ), $wpc_client->custom_titles['staff']['s'] ) . '");\' href="admin.php?page=wpclient_clients&tab=staff_approve&action=delete&id=' . $item['id'] . '&_wpnonce=' . wp_create_nonce( 'wpc_staff_approve_delete' . $item['id'] . get_current_user_id() ) . '&_wp_http_referer=' . urlencode( stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) . '" >' . __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ) . '</a>';

        return sprintf('%1$s %2$s', '<span id="staff_username_' . $item['id'] . '">' . $item['username'] . '</span>', $this->row_actions( $actions ) );
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
        'singular'  => $this->custom_titles['staff']['s'],
        'plural'    => $this->custom_titles['staff']['p'],
        'ajax'      => false

));

$per_page   = $ListTable->wpc_get_items_per_page( 'users_per_page' );
$paged      = $ListTable->get_pagenum();

$ListTable->set_sortable_columns( array(
    'username'          => 'username',
    'first_name'        => 'first_name',
    'email'             => 'email',
) );

$ListTable->set_bulk_actions(array(
    'approve'   => __( 'Approve', WPC_CLIENT_TEXT_DOMAIN ),
    'delete'    => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ),
));

$ListTable->set_columns(array(
    'cb'                => '<input type="checkbox" />',
    'username'          => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ),
    'first_name'        => __( 'First Name', WPC_CLIENT_TEXT_DOMAIN ),
    'email'             => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ),
    'client'            => sprintf( __( 'Assigned to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ),
));


$manager_clients = '';
if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) {
    $clients_ids    = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'client' );
    $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' );
    foreach ( $manager_groups as $group_id ) {
        $add_client = $this->cc_get_group_clients_id( $group_id );
        $clients_ids = array_merge( $clients_ids, $add_client );
    }
    $clients_ids = array_unique( $clients_ids );
    $manager_clients = " AND um3.meta_value IN ('" . implode( "','", $clients_ids ) . "')";
}


$sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id AND um3.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        AND um2.meta_key = 'first_name'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    ";
$items_count = $wpdb->get_var( $sql );

$sql = "SELECT u.ID as id, u.user_login as username, u.user_email as email, um2.meta_value as first_name, um3.meta_value AS parent_client_id
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id AND um3.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        AND um2.meta_key = 'first_name'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page";
$staff = $wpdb->get_results( $sql, ARRAY_A );


$ListTable->prepare_items();
$ListTable->items = $staff;
$ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) );


?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        switch($msg) {
            case 'a':
                echo '<div id="message" class="updated wpc_notice fade"><p>' .  sprintf( __( '%s is approved.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>';
                break;
            case 'd':
                echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>';
                break;
        }
    }
    ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block staff_approve">

           <form action="" method="get" name="wpc_clients_form" id="wpc_clients_form">

                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="staff_approve" />
                <?php $ListTable->search_box( sprintf( __( 'Search %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ), 'search-submit' ); ?>
                <?php $ListTable->display(); ?>
            </form>

        </div>


        <script type="text/javascript">

            jQuery(document).ready(function(){

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );

                    return true;
                });
            });
        </script>

    </div>

</div>
