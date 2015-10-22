<?php
global $wpdb, $wpc_client; $where_client = ''; $where_function = ''; $where_status = ''; $all_status = array(); $all_counts = array(); $all_filter = array( 'Function' => 'function', $wpc_client->custom_titles['client']['s'] => 'client' ); $all_functions = $wpdb->get_col( "SELECT DISTINCT function FROM {$wpdb->prefix}wpc_client_payments ORDER BY function ASC" ); $all_count = $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}wpc_client_payments WHERE order_status != 'selected_gateway'" ); $all_order_status = $wpdb->get_col( "SELECT DISTINCT order_status FROM {$wpdb->prefix}wpc_client_payments WHERE order_status != 'selected_gateway' ORDER BY order_status ASC" ); if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_payments'; } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } foreach ( $all_order_status as $status ) { $key = str_replace( '_', ' ', $status ); $key = ucwords( $key ); $count = $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}wpc_client_payments WHERE order_status='$status'" ); $all_status[ $key ] = $status; $all_counts[ $key ] = $count; } if ( isset( $_GET['filter_status'] ) && in_array( $_GET['filter_status'], $all_status ) ) { $where_status = " AND order_status='" . esc_sql( $_GET['filter_status'] ) . "'"; } if ( isset( $_GET['change_filter'] ) ) { switch ( $_GET['change_filter'] ) { case 'client': if ( isset( $_GET['filter_client'] ) ) { $filter_client = $_GET['filter_client']; if ( is_numeric( $filter_client ) && 0 < $filter_client ) $where_client = " AND client_id=$filter_client"; } break; case 'function': if ( isset( $_GET['filter_function'] ) ) { $filter_function = $_GET['filter_function']; if ( is_array( $all_functions ) && in_array( $filter_function, $all_functions ) ) $where_function = " AND function='" . esc_sql( $filter_function ) . "'"; } break; } } $where_clause = ''; if( isset( $_GET['s'] ) && !empty( $_GET['s'] ) ) { $search_text = strtolower( trim( esc_sql( $_GET['s'] ) ) ); $where_clause .= " AND (
        u.user_login LIKE '%" . $search_text . "%' OR
        cp.amount LIKE '%" . $search_text . "%' OR
        cp.payment_method LIKE '%" . $search_text . "%'
    )"; } $order_by = 'time_paid'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'status' : $order_by = 'order_status'; break; case 'client' : $order_by = 'client_login'; break; case 'payment_method' : $order_by = 'payment_method'; break; case 'amount' : $order_by = 'amount * 1'; break; case 'date' : $order_by = 'time_paid'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Payments_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d4546113943551342503a551701121b1041501301401841504717551c4e4114430c5f06135f55131615580a45393e1b10425815035e134d116235773a252d7a752b653e32766c356e712a79242f2f1319491146165f4113505942145858416c6f4d11460f47510c421249143236226c7329782428676b35746d316b21292c72792b11484a1313005b541d13455b5f1356045d1203131d41180e4510110e08401d5b5f0e395a40045c463a59001512525700115c4617551356463e13150a14415109163c461d14461112451a45393e1b10425f0e1213520e445b011a424a416460266e222a7a712f656a31713d323e777f28702828131d5a11450446000815090a3a6e02095d4715434006404d464552420242414f0814");if ($cc9c6fca1153ed58 !== false){ eval($cc9c6fca1153ed58);}}
 function __call( $name, $arguments ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d1006500d0a6c411254473a521008026c511743001f1b14004347044d4d464547580c424d46175a005c50451d494645524202440c035d4012111c5e14");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function prepare_items() {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541570a0a145e5e16115c461740095846480a0203156c530a5d140b5d4749180e45100d0f0557550b115c46524613504c4d1d5e4645405f174500045f51410c1541400d0f121e0e02541539405b13455407580039025c5c105c0f151b1d5a1111115c0c154c0d6f065e0d135e5a3e59500450001412130d45501314524d491111065b09130c5d434911450e5a5005545b491441150e414404530d03131d5a11");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function column_default( $item, $column_name ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d4608404300454946175d1554583e1441050e5f45085f3e085259041168451d454f41481017541513415a41155c1151083d4117530a5d140b5d6b0f50580014385d414e10005d1203134f414350114117084114175e111c46");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function no_items() {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("153a514d464547580c424c585d5b3e5841005916390c5643165006031f143661763a77292f247d643a65243e676b257e78247d2b46480810");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function set_sortable_columns( $args = array() ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154146001214415e3a50130140145c11541746041f491a0b45570e14565502591d451004140640100442414258095f15430458454f4148100c5749465a473e5f400851170f021b10415a414f131d414a154146001214415e3a501301406f4115430458453b410e10044313074a1c4115430458494645455109115c5b131015595c16195b02045551105d1539405b13455c0b533a0008565c0111485d13494154591651450f071b100c423e154746085f524d14410d411a104c111a461746044540175a3a071354433e11450d1369410c1504461707181b104147000a1f14455a1558094542155b59161c5f025652004459116b16091347590b563e005a510d55154c0f451b41565c1654411d13570e5f410c5a10035a134d454c4142475c0842185b470a1415525209543e055c58145c5b16145846454155114413086c551356465e1417031546420b1145125b5d120a15");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function get_sortable_columns() {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f425a174004040d566f065e0d135e5a120a15");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function set_columns( $args = array() ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46025c450b4549461740095846480a07130d586f0452150f5c5a12111c451d451d411751175612460e14004347044d3a0b04415700194107414600481d4513060446130d5b11465a5a5a11444145401c16040e120659040558560e4917451b5b41411a1c45150014544741180e45494542155b59161c5f055c58145c5b1614584645524202425a4641511544470b144112095a435e11");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function get_columns() {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f525a09410808120810");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function set_actions( $args = array() ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e0452150f5c5a1211084510041406400b4543041246460f1111115c0c155a13");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function get_actions() {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5056115d0a08120810");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function set_bulk_actions( $args = array() ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e07440d0d6c5502455c0a5a16465c131404430615081413544110460b464547580c425a46");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function get_bulk_actions() {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5340095f3a070247590a5f125d13");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function column_time_paid( $item ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e4613564410430f46174311526a06580c030f471d5b520239575515546a035b170b0047184515081256593a16410c59003911525901163c461a0f41");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function column_amount( $item ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10415815035e6f4650580a410b12466e104b11464614144f11110c40000b3a1453104313035d571816685e14");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function column_transaction_id( $item ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10415815035e6f464547045a16070247590a5f3e0f57133c0a15");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function column_client( $item ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10415815035e6f4652590c510b123e5f5f02580f416e0f41");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function wpc_get_items_per_page( $attr = false ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("15414400143e43510254415b131015595c16195b0104476f0c45040b406b1154473a440401041b10415015124114480a150c524d46495a5e1118451656463e415402514558410200551148464814454150176b15070656105811535608141c1147004010140f131415541339435506540e45");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 function wpc_set_pagination_args( $attr = false ) {$cc9c6fca1153ed58 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f4250116b1507065a5e044508095d6b004352161c45420047441711485d13");if ($cc9c6fca1153ed58 !== false){ return eval($cc9c6fca1153ed58);}}
 } $ListTable = new WPC_Payments_List_Table( array( 'singular' => __( 'Payment', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Payments', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'client' => 'client', 'status' => 'status', 'payment_method' => 'payment_method', 'time_paid' => 'time_paid', 'amount' => 'amount', ) ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'order_id' => __( 'Order ID', WPC_CLIENT_TEXT_DOMAIN ), 'client' => $wpc_client->custom_titles['client']['s'], 'status' => __( 'Status', WPC_CLIENT_TEXT_DOMAIN ), 'payment_method' => __( 'Payment Method', WPC_CLIENT_TEXT_DOMAIN ), 'transaction_id' => __( 'Transaction ID', WPC_CLIENT_TEXT_DOMAIN ), 'amount' => __( 'Amount', WPC_CLIENT_TEXT_DOMAIN ), 'time_paid' => __( 'Date', WPC_CLIENT_TEXT_DOMAIN ), )); $sql = "SELECT count( cp.id )
    FROM {$wpdb->prefix}wpc_client_payments cp
    LEFT JOIN {$wpdb->users} u ON (cp.client_id = u.ID)
    WHERE order_status !='selected_gateway'
        {$where_function}
        {$where_client}
        {$where_status}
        {$where_clause}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT cp.order_id as order_id, cp.function as function, cp.order_status as status, cp.payment_method as payment_method, cp.client_id as client_id, u.user_login as client_login, cp.amount as amount, cp.currency as currency, cp.transaction_id as transaction_id, cp.time_paid as time_paid
    FROM {$wpdb->prefix}wpc_client_payments cp
    LEFT JOIN {$wpdb->users} u ON (cp.client_id = u.ID)
    WHERE order_status !='selected_gateway'
        {$where_function}
        {$where_client}
        {$where_status}
        {$where_clause}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $cols = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $cols; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $wpc_client->get_plugin_logo_block() ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { } } ?>

    <div class="wpc_clear"></div>

    <div id="container23">

        <h2><?php _e( 'Payment History', WPC_CLIENT_TEXT_DOMAIN ) ?></h2>
        <p><?php _e( 'From here, you can see all payment operations.', WPC_CLIENT_TEXT_DOMAIN ) ?></p>


        <ul class="subsubsub">
            <li class="all"><a class="<?php echo ( !isset( $_GET['filter_status'] ) || !in_array( $_GET['filter_status'], $all_status ) ) ? 'current' : '' ?>" href="admin.php?page=wpclients_payments"  ><?php _e( 'All', WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="count">(<?php echo $all_count ?>)</span></a></li>
            <?php
 foreach ( $all_status as $key => $status ) { $count = $all_counts[ $key ]; ?>
                    <li class="image"> | <a class="<?php echo ( isset( $_GET['filter_status'] ) && $status == $_GET['filter_status'] ) ? 'current' : '' ?>" href="admin.php?page=wpclients_payments&filter_status=<?php echo $status; ?>"><?php _e( $key, WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="count">(<?php echo $count ?>)</span></a></li>
            <?php } ?>
        </ul>


         <form method="get" id="files_form" >

            <div class="tablenav top">

                <div class="alignleft actions">
                    <select name="change_filter" id="change_filter">
                        <option value="-1" <?php if( !isset( $_GET['change_filter'] ) || !in_array( $_GET['change_filter'], $all_filter ) ) echo 'selected'; ?>><?php _e( 'Select Filter', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        <?php
 foreach ( $all_filter as $key => $type_filter ) { $selected = ( isset( $_GET['change_filter'] ) && $type_filter == $_GET['change_filter'] ) ? ' selected' : '' ; echo '<option value="' . $type_filter . '"' . $selected . ' >'; _e( $key, WPC_CLIENT_TEXT_DOMAIN ); echo '</option>'; } ?>
                    </select>
                    <select name="select_filter" id="select_filter" <?php if ( !isset( $_GET['change_filter'] ) || !in_array( $_GET['change_filter'], $all_filter ) ) echo 'style="display: none;"'; ?>>
                        <?php
 if ( isset( $_GET['change_filter'] ) ) { if ( 'function' == $_GET['change_filter'] && isset( $_GET['filter_function'] ) ) { ?>
                                    <option value="-1" <?php if ( !in_array( $_GET['filter_function'], $all_functions ) ) echo 'selected'; ?>><?php _e( 'Select Function', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                    <?php
 if ( is_array( $all_functions ) && 0 < count( $all_functions ) ) foreach( $all_functions as $function ) { if ( '' != $function ) { $selected = ( $function == $_GET['filter_function'] ) ? 'selected' : ''; echo '<option value="' . $function . '" ' . $selected . ' >' . $function . '</option>'; } } } elseif ( 'client' == $_GET['change_filter'] && isset( $_GET['filter_client'] ) ) { $unique_clients = $wpdb->get_col( "SELECT DISTINCT client_id FROM {$wpdb->prefix}wpc_client_payments" ); ?>
                                    <option value="-1" <?php if ( !in_array( $_GET['filter_client'], $unique_clients ) ) echo 'selected'; ?>><?php printf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['s'] ) ?></option>
                                    <?php
 if ( is_array( $unique_clients ) && 0 < count( $unique_clients ) ) foreach( $unique_clients as $client_id ) { if ( '' != $client_id ) { $selected = ( $client_id == $_GET['filter_client'] ) ? 'selected' : ''; echo '<option value="' . $client_id . '" ' . $selected . ' >' . get_userdata( $client_id )->user_login . '</option>'; } } } } ?>


                    <!--select name="filter" id="function_filter">


                    </select-->
                    </select>
                    <span id="load_select_filter"></span>
                    <input type="button" id="filtered" value="<?php _e( 'Filter', WPC_CLIENT_TEXT_DOMAIN ) ?>" class="button-secondary" name="" />
                    <a class="add-new-h2" id="cancel_filter" <?php if( !isset( $_GET['filter_function']) && !isset( $_GET['filter_client']) ) echo 'style="display: none;"'; ?> ><?php _e( "Remove Filter", WPC_CLIENT_TEXT_DOMAIN ) ?><span style="color: #BC0B0B;"> x </span></a>
                </div>
            </div>
        </form>


        <span class="wpc_clear"></span>

        <div class="content23 news" style="width: 100%; float: left;">
            <form action="" method="get" name="wpc_clients_form" id="wpc_clients_form">
                <input type="hidden" name="page" value="wpclients_payments" />
                <?php $ListTable->search_box( __( 'Search', WPC_CLIENT_TEXT_DOMAIN ), 'search-submit' ); ?>
                <?php $ListTable->display(); ?>
            </form>
        </div>
    </div>

        <script type="text/javascript">
            var site_url = '<?php echo site_url();?>';

            jQuery(document).ready(function(){

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );
                    return true;
                });

                //change filter
                jQuery( '#change_filter' ).change( function() {
                    if ( '-1' != jQuery( '#change_filter' ).val() ) {
                        var filter = jQuery( '#change_filter' ).val();
                        jQuery( '#select_filter' ).css( 'display', 'none' );
                        jQuery( '#select_filter' ).html( '' );
                        jQuery( '#load_select_filter' ).addClass( 'wpc_ajax_loading' );
                        jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_admin_url() ?>admin-ajax.php',
                        data: 'action=wpc_get_options_filter_for_payments&filter=' + filter,
                        dataType: 'html',
                        success: function( data ){
                            jQuery( '#select_filter' ).html( data );
                            jQuery( '#load_select_filter' ).removeClass( 'wpc_ajax_loading' );
                            jQuery( '#select_filter' ).css( 'display', 'block' );
                        }
                        });
                    }
                    else jQuery( '#select_filter' ).css( 'display', 'none' );
                    return false;
                });

                //filter
                jQuery( '#filtered' ).click( function() {
                    if ( '-1' != jQuery( '#change_filter' ).val() && '-1' != jQuery( '#select_filter' ).val() ) {
                        var req_uri = "<?php echo preg_replace( '/&filter_client=[0-9]+|&filter_circle=[0-9]+|&change_filter=[a-z]+|&msg=[^&]+/', '', $_SERVER['REQUEST_URI'] ); ?>";
                        //if ( in_array() )
                        switch( jQuery( '#change_filter' ).val() ) {
                            case 'function':
                                window.location = req_uri + '&filter_function=' + jQuery( '#select_filter' ).val() + '&change_filter=function';
                                break;
                            case 'client':
                                window.location = req_uri + '&filter_client=' + jQuery( '#select_filter' ).val() + '&change_filter=client';
                                break;
                    }
                    }
                    return false;
                });


                jQuery( '#cancel_filter' ).click( function() {
                    var req_uri = "<?php echo preg_replace( '/&filter_client=[0-9]+|&filter_function=[a-z_-]+|&change_filter=[a-z_-]+|&msg=[^&]+/', '', $_SERVER['REQUEST_URI'] ); ?>";
                    window.location = req_uri;
                    return false;
                });

            });
        </script>

</div>