<?php
global $wpdb, $wpc_client; add_thickbox(); wp_register_script( 'wpc-thickbox-popup-js', $this->plugin_url . 'js/thickbox_popup.js', false, WPC_CLIENT_VER ); wp_enqueue_script( 'wpc-thickbox-popup-js', false, array('jquery'), WPC_CLIENT_VER, true ); if ( !current_user_can( 'wpc_archive_clients' ) && !current_user_can( 'wpc_restore_clients' ) && !current_user_can( 'wpc_delete_clients' ) && !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } if ( isset( $_GET['_wp_http_referer'] ) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=archive'; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Archive_User_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d4546113943551342503a551701121b1041501301401841504717551c4e4114430c5f06135f55131615580a45393e1b10425815035e134d116235773a252d7a752b653e32766c356e712a79242f2f1319491146165f4113505942145858416c6f4d11460f47510c421249143236226c7329782428676b35746d316b21292c72792b11484a1313005b541d13455b5f1356045d1203131d41180e4510110e08401d5b5f0e395a40045c463a59001512525700115c4617551356463e13150a14415109163c461d14461112451a45393e1b10425f0e1213520e445b011a424a416460266e222a7a712f656a31713d323e777f28702828131d5a11450446000815090a3a6e02095d4715434006404d464552420242414f0814");if ($c6cc64d127b086ca !== false){ eval($c6cc64d127b086ca);}}
 function __call( $name, $arguments ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d1006500d0a6c411254473a521008026c511743001f1b14004347044d4d464547580c424d46175a005c50451d494645524202440c035d4012111c5e14");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function prepare_items() {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541570a0a145e5e16115c461740095846480a0203156c530a5d140b5d4749180e45100d0f0557550b115c46524613504c4d1d5e4645405f174500045f51410c1541400d0f121e0e02541539405b13455407580039025c5c105c0f151b1d5a1111115c0c154c0d6f065e0d135e5a3e59500450001412130d45501314524d491111065b09130c5d434911450e5a5005545b491441150e414404530d03131d5a11");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function column_default( $item, $column_name ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d4608404300454946175d1554583e1441050e5f45085f3e085259041168451d454f41481017541513415a41155c1151083d4117530a5d140b5d6b0f50580014385d414e10005d1203134f414350114117084114175e111c46");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function no_items() {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("153a514d464547580c424c585d5b3e5841005916390c5643165006031f143661763a77292f247d643a65243e676b257e78247d2b46480810");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function set_sortable_columns( $args = array() ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("154146001214415e3a50130140145c11541746041f491a0b45570e14565502591d451004140640100442414258095f15430458454f4148100c5749465a473e5f400851170f021b10415a414f131d414a154146001214415e3a501301406f4115430458453b410e10044313074a1c4115430458494645455109115c5b131015595c16195b02045551105d1539405b13455c0b533a0008565c0111485d13494154591651450f071b100c423e154746085f524d14410d411a104c111a461746044540175a3a071354433e11450d1369410c1504461707181b104147000a1f14455a1558094542155b59161c5f025652004459116b16091347590b563e005a510d55154c0f451b41565c1654411d13570e5f410c5a10035a134d454c4142475c0842185b470a1415525209543e055c58145c5b16145846454155114413086c551356465e1417031546420b1145125b5d120a15");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function get_sortable_columns() {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f425a174004040d566f065e0d135e5a120a15");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function set_columns( $args = array() ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46025c450b4549461740095846480a07130d586f0452150f5c5a12111c451d451d411751175612460e14004347044d3a0b04415700194107414600481d4513060446130d5b11465a5a5a11444145401c16040e120659040558560e4917451b5b41411a1c45150014544741180e45494542155b59161c5f055c58145c5b1614584645524202425a4641511544470b144112095a435e11");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function get_columns() {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f525a09410808120810");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function set_actions( $args = array() ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e0452150f5c5a1211084510041406400b4543041246460f1111115c0c155a13");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function get_actions() {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5056115d0a08120810");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function set_bulk_actions( $args = array() ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e07440d0d6c5502455c0a5a16465c131404430615081413544110460b464547580c425a46");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function get_bulk_actions() {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5340095f3a070247590a5f125d13");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function column_cb( $item ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d101641130f5d4007191542080c0811464445451816560943525d00570e040e4b12455f000b560943584100593e3b431346045d14030e16444217451b5b414d13140c45040b681308551238144c5d41");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function column_username( $item ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e4645525311580e0840145c11541746041f491a0b455807461b1402444717510b123e464300433e05525a49111212440639135643115e13036c570d58500b401641411a10194d4105464613545b116b101504416f06500f4e13131641563a55010b085d174518411a4f1402444717510b123e464300433e05525a4911120450080f0f5a43114300125c4646111c451d451d411751064508095d473a16470047110913561738115c461408001156095516155c115501581544135c13545358164248415455116e00025e5d0f6e4017584d4f411d104250050b5a5a4f415d150b150706560d1241020a5a510f456a06580c030f4743434500040e5513525d0c4200400050440c5e0f5b415112455a1751430f050e17451f41425a40045c6e425d01413c131e4516473944440f5e5b06515841411d1012413e0541510045503a5a0a0802561845161616506b025d5c005a1139135643115e130314144f11110c40000b3a145901163c461a144f1112470a370312475f17545d49520a460a1518140c00491359166e0c135f4008425c11514d4f411a101e110800131c41524017460008156c451654133950550f1915424315053e5755095415036c570d58500b401641411a10194d4105464613545b116b101504416f06500f4e13131641563a55010b085d174518411a4f1402444717510b123e464300433e05525a4911120450080f0f5a43114300125c4646111c451d451d411751064508095d473a16510058001204146d450c41410f554152590447165b435755095415036c5502455c0a5a4746055244041c0005475d0e5f084750000a0447553a5713095e6b035d5a02164502004751485f0e0850515c1312451a4511116c5317540012566b0f5e5b06514d46464440066e020a5a510f456a01510903155617451f41425a40045c6e425d01413c1319451f4141111405504104190c025c1117451f41425a40045c6e425d01413c131e451643465b46045708475e0410004053175811120914175e5c011c554f5a110e42114f466c6b491112215109031556103554130b525a045f41094d4520135c5d45730d0954134d116235773a252d7a752b653e32766c356e712a79242f2f1319451f41410f1b000f125e1441070247590a5f123d1450045d501151423b410e10420d00465058004246581601030d5644006e0005475d0e5f1745500412001e51064508095d09435c403a50000a0447554711050747554c5f5a0b57005b4314104b1116166c5713545411513a080e5d53001941414444026e56095d0008156c54005d04125613411f15415d11030c68170c55463b131d411f15421645020047514858055b1113411f15415d11030c68170c55463b131a411617455c1703070e120f5017074057135845110e45100e5a544d01485d110a46111b456b3a4e411474005d0412561431544708550b030f475c1c1127145c59417f5011430a140a141c456631256c772d78702b603a32246b643a752e2b727d2f111c451a45415d1c515b165a464e141c1150094700461a13140452150f5c5a126a120151090315561738115c461408001156095516155c1154005d0412566b0052410c5b0b4441575111504c085c5a025408471345484144403a5213035240046e5b0a5a060349131712410239505808545b116b01030d5644001641481310084550086f420f05146d4518414813134311510440044b08570d471641481310084550086f420f05146d451f414111140943500309470c0045511652130f43405b11430a5d014e511a0b470f46461d143e6e1d451321030d5644001131034159005f500b40091f461f1032612239707828747b316b312339676f217e2c277a7a4118154b14425a4e520e420a411b1346044540175a45151141590b45074e14115015464511574212141c4515081256593a164016511708005e55426c4d461740095846480a1709166c51064508095d474911110457110f0e5d434518414f0814");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function column_contact_name( $item ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10415815035e6f46525a0b400405156c5e045c04416e0f41");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function column_business_name( $item ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10415815035e6f465340165d0b0312406f0b500c0314695a11");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function wpc_get_items_per_page( $attr = false ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("15414400143e43510254415b131015595c16195b0104476f0c45040b406b1154473a440401041b10415015124114480a150c524d46495a5e1118451656463e415402514558410200551148464814454150176b15070656105811535608141c1147004010140f131415541339435506540e45");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 function wpc_set_pagination_args( $attr = false ) {$c6cc64d127b086ca = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f4250116b1507065a5e044508095d6b004352161c45420047441711485d13");if ($c6cc64d127b086ca !== false){ return eval($c6cc64d127b086ca);}}
 } $ListTable = new WPC_Archive_User_List_Table(array( 'singular' => $this->custom_titles['client']['s'], 'plural' => $this->custom_titles['client']['p'], 'ajax' => false )); switch ( $ListTable->current_action() ) { case 'delete': case 'delete_from_blog': case 'mu_delete': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_client_delete' . $_REQUEST['id'] ); $clients_id = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } else if ( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['client']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) && ( current_user_can( 'wpc_delete_clients' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { foreach ( $clients_id as $client_id ) { if( $ListTable->current_action() == 'mu_delete' ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } if( 1 == count( $clients_id ) ) do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); else do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ds', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; case 'restore': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_client_restore' . $_REQUEST['id'] ); $clients_id = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } else if ( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['client']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) && ( current_user_can( 'wpc_delete_clients' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { foreach ( $clients_id as $client_id ) { $this->restore_client( $client_id ); } if( 1 == count( $clients_id ) ) do_action( 'wp_client_redirect', add_query_arg( 'msg', 'r', $redirect ) ); else do_action( 'wp_client_redirect', add_query_arg( 'msg', 'rs', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; default: if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } break; } $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $where_clause = ''; if( isset( $_GET['s'] ) && !empty( $_GET['s'] ) ) { $search_text = strtolower( trim( esc_sql( $_GET['s'] ) ) ); $where_clause .= "AND (
        u.user_login LIKE '%" . $search_text . "%' OR
        u.display_name LIKE '%" . $search_text . "%' OR
        u.user_email LIKE '%" . $search_text . "%'
    )"; } $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'user_login' : $order_by = 'user_login'; break; case 'display_name' : $order_by = 'display_name'; break; case 'business_name' : $order_by = 'um2.meta_value'; break; case 'user_email' : $order_by = 'user_email'; break; } } $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id

    WHERE um.meta_key = 'archive' AND um.meta_value = 1
    " . $where_clause . ""; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.display_name as contact_name, u.user_email as email, um2.meta_value as business_name
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id AND um2.meta_key = 'wpc_cl_business_name'
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id
    WHERE um.meta_key = '{$wpdb->prefix}capabilities' AND um.meta_value LIKE '%s:10:\"wpc_client\";%' AND um3.meta_key = 'archive' AND um3.meta_value = 1
    " . $where_clause . "

    ORDER BY $order_by
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $users = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->set_sortable_columns( array( 'username' => 'user_login', 'contact_name' => 'display_name', 'business_name' => 'business_name', 'email' => 'user_email', ) ); $bulk_actions = array( 'restore' => __( 'Restore', WPC_CLIENT_TEXT_DOMAIN ), ); if( is_multisite() ) { $bulk_actions['delete_from_blog'] = __( 'Delete From Blog', WPC_CLIENT_TEXT_DOMAIN ); $bulk_actions['mu_delete'] = __( 'Delete From Network', WPC_CLIENT_TEXT_DOMAIN ); } else { $bulk_actions['delete'] = __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ); } $ListTable->set_bulk_actions( $bulk_actions ); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'contact_name' => __( 'Contact Name', WPC_CLIENT_TEXT_DOMAIN ), 'business_name' => __( 'Business Name', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->prepare_items(); $ListTable->items = $users; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'r': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Restored</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) . '</p></div>'; break; case 'rs': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Restored</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) . '</p></div>'; break; case 'ds': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) . '</p></div>'; break; } } ?>

<div style="" class='wrap'>

    <?php echo $wpc_client->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <div class="wpc_tab_container_block clients_archive">
            <form action="" method="get" id="wpc_clients_list_form">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="archive" />
                <div class="wpc_clear"></div>
                    <?php $ListTable->search_box( __( 'Search Users' ), 'user' ); ?>
                    <?php $ListTable->display(); ?>
            </form>
        </div>
    </div>
</div>

<div id="delete_user_settings_block" style="display: none;">
    <form id="delete_user_settings" method="get">
        <h2><?php printf( __( 'Are you sure you want to delete this %s?', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ); ?></h2>

        <h3><?php _e( 'What should be done with files owned by this user?', WPC_CLIENT_TEXT_DOMAIN ); ?></h3>
        <p>
            <label>
                <input type="radio" name="delete_user_settings[files]" value="remove" checked="checked" />
                <?php _e( 'Remove files', WPC_CLIENT_TEXT_DOMAIN ); ?>
            </label> <br />

            <label>
                <input type="radio" name="delete_user_settings[files]" value="reassign" />
                <?php _e( 'Reassign files to', WPC_CLIENT_TEXT_DOMAIN ); ?>
            </label>
            <select name="delete_user_settings[files_user]" id="delete_settings_user_list">
            </select>
        </p>
        <hr />

        <h3><?php printf( __( 'What should be done with %s %s?', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['staff']['s'] ); ?></h3>
        <p>
            <label>
                <input type="radio" name="delete_user_settings[staff]" value="remove" checked="checked" />
                <?php printf( __( 'Remove %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ); ?>
            </label> <br />

            <label>
                <input type="radio" name="delete_user_settings[staff]" value="unassign" />
                <?php printf( __( 'Unassign %s from %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'], $this->custom_titles['client']['s'] ); ?>
            </label>
        </p>
        <hr />

        <h3><?php _e( 'What should be done with messages sent by this user?', WPC_CLIENT_TEXT_DOMAIN ); ?></h3>
        <p>
            <label>
                <input type="radio" name="delete_user_settings[messages]" value="remove" checked="checked" />
                <?php _e( 'Remove messages', WPC_CLIENT_TEXT_DOMAIN ); ?>
            </label> <br />

            <label>
                <input type="radio" name="delete_user_settings[messages]" value="leave" />
                <?php _e( 'Leave in message history', WPC_CLIENT_TEXT_DOMAIN ); ?>
            </label>
        </p>

        <p>
            <input type="button" class="button-primary delete_user_button" value="<?php _e( 'Delete user', WPC_CLIENT_TEXT_DOMAIN ); ?>" />
            <input type="button" class="button cancel_delete_button" style="float: right;" value="<?php _e( 'Cancel', WPC_CLIENT_TEXT_DOMAIN ); ?>" />
        </p>
    </form>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){

        var user_id = 0;
        var nonce = '';
        var action = '';

        jQuery('.delete_action').click(function() {
            jQuery.wpcShowLoad();
            user_id = jQuery(this).data( 'id' );
            nonce = jQuery(this).data( 'nonce' );
            action = jQuery(this).data('action') ? jQuery(this).data('action') : 'delete';
            if( user_id > 0 ) {
                jQuery.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
                    data: 'action=wpc_get_user_list&exclude=' + user_id,
                    dataType: 'json',
                    success: function( data ){
                        if( data.status ) {
                            jQuery( '#delete_settings_user_list' ).html('');
                            if( data.message.all.length ) {
                                data.message.all.forEach(function( item, i ) {
                                    jQuery( '#delete_settings_user_list' ).append('<optgroup label="' + item.title + '">');
                                    item.items.forEach(function( item2, i ) {
                                        jQuery( '#delete_settings_user_list' ).append('<option value="' + item2.ID + '">' + item2.user_login  + '</option>');
                                    });
                                    jQuery( '#delete_settings_user_list' ).append('</optgroup>');
                                });
                            }

                            jQuery( '#delete_settings_manager_list' ).html('');
                            if( data.message.managers.length ) {
                                data.message.managers.forEach(function( item, i ) {
                                    jQuery( '#delete_settings_manager_list' ).append('<option value="' + item.ID + '">' + item.user_login  + '</option>');
                                });
                            }

                            jQuery.wpcHideLoad();

                            jQuery('#delete_user_settings_block').wpc_thickbox_popup({
                                'title' : '<?php _e( 'Delete User', WPC_CLIENT_TEXT_DOMAIN ); ?>'
                            });
                        } else {
                            alert( data.message );
                        }
                    }
                });
            }
            return false;
        });

        jQuery('#wpc_clients_list_form').submit(function() {
            if( jQuery('select[name="action"]').val() == 'delete' || jQuery('select[name="action2"]').val() == 'delete' ||
                jQuery('select[name="action"]').val() == 'mu_delete' || jQuery('select[name="action2"]').val() == 'mu_delete' ||
                jQuery('select[name="action"]').val() == 'delete_from_blog' || jQuery('select[name="action2"]').val() == 'delete_from_blog' ) {
                action = jQuery('select[name="action"]').val();
                jQuery.wpcShowLoad();
                user_id = new Array();
                jQuery("input[name^=item]:checked").each(function() {
                    user_id.push( jQuery(this).val() );
                });
                nonce = jQuery('input[name=_wpnonce]').val();
                if( user_id.length ) {
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
                        data: 'action=wpc_get_user_list&exclude=' + user_id.join(','),
                        dataType: 'json',
                        success: function( data ){
                            if( data.status ) {
                                jQuery( '#delete_settings_user_list' ).html('');
                                if( data.message.all.length ) {
                                    data.message.all.forEach(function( item, i ) {
                                        jQuery( '#delete_settings_user_list' ).append('<optgroup label="' + item.title + '">');
                                        item.items.forEach(function( item2, i ) {
                                            jQuery( '#delete_settings_user_list' ).append('<option value="' + item2.ID + '">' + item2.user_login  + '</option>');
                                        });
                                        jQuery( '#delete_settings_user_list' ).append('</optgroup>');
                                    });
                                }

                                jQuery.wpcHideLoad();

                                jQuery('#delete_user_settings_block').wpc_thickbox_popup({
                                    'title' : '<?php _e( 'Delete User', WPC_CLIENT_TEXT_DOMAIN ); ?>'
                                });
                            } else {
                                alert( data.message );
                            }
                        }
                    });
                } else {
                    jQuery.wpcHideLoad();
                }
                return false;
            }
        });

        jQuery(document).on('click', '.cancel_delete_button', function() {
            tb_remove();
            user_id = 0;
            nonce = '';
        });

        jQuery(document).on('click', '.delete_user_button', function() {
            if( user_id instanceof Array ) {
                if( user_id.length ) {
                    var item_string = '';
                    user_id.forEach(function( item, key ) {
                        item_string += '&item[]=' + item;
                    });
                    window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=archive&action=' + action + item_string + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=' + jQuery('input[name=_wp_http_referer]').val();
                }
            } else {
                window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=archive&action=' + action + '&id=' + user_id + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=<?php echo urlencode( stripslashes_deep( $_SERVER['REQUEST_URI'] ) ); ?>';
            }
            tb_remove();
            user_id = 0;
            nonce = '';
            return false;
        });

        //reassign file from Bulk Actions
        jQuery( '#doaction2' ).click( function() {
            var action = jQuery( 'select[name="action2"]' ).val() ;
            jQuery( 'select[name="action"]' ).attr( 'value', action );
            return true;
        });

    });
</script>