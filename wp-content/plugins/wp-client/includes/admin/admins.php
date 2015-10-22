<?php
global $wpdb; add_thickbox(); wp_register_script( 'wpc-thickbox-popup-js', $this->plugin_url . 'js/thickbox_popup.js', false, WPC_CLIENT_VER ); wp_enqueue_script( 'wpc-thickbox-popup-js', false, array('jquery'), WPC_CLIENT_VER, true ); if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=admins'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $admins_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_admin_delete' . $_REQUEST['id'] . get_current_user_id() ); $admins_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['admin']['p'] ) ); $admins_id = $_REQUEST['item']; } if ( count( $admins_id ) ) { foreach ( $admins_id as $admin_id ) { $admin_data = get_userdata( $admin_id ); $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_value=%s", $admin_data->user_login ) ); if( is_multisite() ) { wpmu_delete_user( $admin_id ); } else { wp_delete_user( $admin_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); break; case 'send_welcome': if ( isset( $_GET['user_id'] ) && 0 < (int)$_GET['user_id'] ) { $this->resend_welcome_email( $_GET['user_id'] ); do_action( 'wp_client_redirect', add_query_arg( 'msg', 'wel', $redirect ) ); } else { do_action( 'wp_client_redirect', $redirect ); } break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } $where_clause = ''; if( isset( $_GET['s'] ) && !empty( $_GET['s'] ) ) { $search_text = strtolower( trim( esc_sql( $_GET['s'] ) ) ); $where_clause .= "AND (
        u.user_login LIKE '%" . $search_text . "%' OR
        u.user_nicename LIKE '%" . $search_text . "%' OR
        u.user_email LIKE '%" . $search_text . "%'
    )"; } $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'username' : $order_by = 'u.user_login'; break; case 'nickname' : $order_by = 'u.user_nicename'; break; case 'email' : $order_by = 'u.user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Admins_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d4546113943551342503a551701121b1041501301401841504717551c4e4114430c5f06135f55131615580a45393e1b10425815035e134d116235773a252d7a752b653e32766c356e712a79242f2f1319491146165f4113505942145858416c6f4d11460f47510c421249143236226c7329782428676b35746d316b21292c72792b11484a1313005b541d13455b5f1356045d1203131d41180e4510110e08401d5b5f0e395a40045c463a59001512525700115c4617551356463e13150a14415109163c461d14461112451a45393e1b10425f0e1213520e445b011a424a416460266e222a7a712f656a31713d323e777f28702828131d5a11450446000815090a3a6e02095d4715434006404d464552420242414f0814");if ($c280b9208cc7f918 !== false){ eval($c280b9208cc7f918);}}
 function __call( $name, $arguments ) {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d1006500d0a6c411254473a521008026c511743001f1b14004347044d4d464547580c424d46175a005c50451d494645524202440c035d4012111c5e14");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function prepare_items() {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541570a0a145e5e16115c461740095846480a0203156c530a5d140b5d4749180e45100d0f0557550b115c46524613504c4d1d5e4645405f174500045f51410c1541400d0f121e0e02541539405b13455407580039025c5c105c0f151b1d5a1111115c0c154c0d6f065e0d135e5a3e59500450001412130d45501314524d491111065b09130c5d434911450e5a5005545b491441150e414404530d03131d5a11");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function column_default( $item, $column_name ) {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d4608404300454946175d1554583e1441050e5f45085f3e085259041168451d454f41481017541513415a41155c1151083d4117530a5d140b5d6b0f50580014385d414e10005d1203134f414350114117084114175e111c46");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function no_items() {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("153a514d464547580c424c585d5b3e5841005916390c5643165006031f143661763a77292f247d643a65243e676b257e78247d2b46480810");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function set_sortable_columns( $args = array() ) {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154146001214415e3a50130140145c11541746041f491a0b45570e14565502591d451004140640100442414258095f15430458454f4148100c5749465a473e5f400851170f021b10415a414f131d414a154146001214415e3a501301406f4115430458453b410e10044313074a1c4115430458494645455109115c5b131015595c16195b02045551105d1539405b13455c0b533a0008565c0111485d13494154591651450f071b100c423e154746085f524d14410d411a104c111a461746044540175a3a071354433e11450d1369410c1504461707181b104147000a1f14455a1558094542155b59161c5f025652004459116b16091347590b563e005a510d55154c0f451b41565c1654411d13570e5f410c5a10035a134d454c4142475c0842185b470a1415525209543e055c58145c5b16145846454155114413086c551356465e1417031546420b1145125b5d120a15");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function get_sortable_columns() {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f425a174004040d566f065e0d135e5a120a15");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function set_columns( $args = array() ) {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46025c450b4549461740095846480a07130d586f0452150f5c5a12111c451d451d411751175612460e14004347044d3a0b04415700194107414600481d4513060446130d5b11465a5a5a11444145401c16040e120659040558560e4917451b5b41411a1c45150014544741180e45494542155b59161c5f055c58145c5b1614584645524202425a4641511544470b144112095a435e11");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function get_columns() {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f525a09410808120810");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function set_actions( $args = array() ) {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e0452150f5c5a1211084510041406400b4543041246460f1111115c0c155a13");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function get_actions() {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5056115d0a08120810");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function set_bulk_actions( $args = array() ) {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e07440d0d6c5502455c0a5a16465c131404430615081413544110460b464547580c425a46");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function get_bulk_actions() {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5340095f3a070247590a5f125d13");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function column_cb( $item ) {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d101641130f5d4007191542080c0811464445451816560943525d00570e040e4b12455f000b560943584100593e3b431346045d14030e16444217451b5b414d13140c45040b681308551238144c5d41");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function column_username( $item ) {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e4645525311580e0840145c11541746041f491a0b45150005475d0e5f463e13000208471738115c46140800115d1751035b43525408580f48435c110e450453005b16435309580408476b025d5c005a1115474751070c00025e5d0f426a00500c12475a54581641481310084550086f420f05146d451f4141110a46111b456b3a4e411475015815411f143661763a77292f247d643a65243e676b257e78247d2b46481d10420d4e070d135a11110457110f0e5d433e161616506b02504504560c0a084749426c415b13135d50150d4600005c11131241023950551150570c580c12181110015015071e5d050c1742144b46455a44005c3a415a50466c154b14423946131e455c05531b14464645066b04020c5a5e42114f466071226467206b2433357b6f36702d32131a41155c1151083d465a54426c414f131a4116174557090712400d474700145a5b14426a06551507035a5c0c45080340165f16154b143a394913172c5f050f455d054454091426071152520c5d08125a51121619456335253e707c2c742f326c602469613a702a2b207a7e4518414813135d1e545b135e460855104d11400f404704451d45100c12045e6b4245080b566b135446005a01413c1319454d1d461b1445584100593e41155a5d006e130340510f551238144e46520500551b5355131d410d15115d0803491a104c111a46175502455c0a5a163d464440066e130340510f556a125109050e5e55426c415b13135d50150a5a060a08505b586d4614564014435b45570a08075a4208194341131a416e6a4d1442271356101c5e144640411354151c5b104616525e111115091366041c66005a014636565c065e0c0313710c505c090b424a416460266e222a7a712f656a31713d323e777f28702828131d411f1542164c5d3d14100d4304000e160055580c5a4b1609430f155006030e431152590c510b123e505c0c540f1240121550575855010b085d43435002125a5b0f0c46005a013916565c065e0c0315411254473a5d015b46131e4515081256593a165c011338464f1317436e16165d5b0f5250581345484144403a5213035240046e5b0a5a06034913171241023941513e42500b503a11045f530a5c46461d1445584100593e41085717381148461d13430f12451a45393e1b104263044b60510f5515325109050e5e5545740c075a58461d1532642639227f79207f3539677139656a217b2827287d104c114f4614084e500b420f451b41565c1654411d13100052410c5b0b153a144715523e145647045f513a43000a025c5d00163c460e14460d4615550b46155a4409545c4414144f114615460c08155518456e3e4e131336505c111404140e465e01114415135c0e444716140309131342001c12035d504158414b1349463663733a722d2f767a356e61206c3139257c7d24782f461a1841435a105a014e411b104d11450f47510c6a12115d08033e415516540f021469411a15560255564b01044518414b1340085c504d1d454f411c1056075156131d4118154b1442445f14104b113e391b1446635048670008051367005d02095e51417458045d09414d136735723e257f7d247f613a60203e356c742a7c202f7d1448111b451359491243510b0f465d134941155406400c090f406b4255040a5640041668450945415d5210065d00154009435550095111033e525311580e08111405504104190b090f5055581346461d1416416a0646000715566f0b5e0f05561c41164215573a07055e590b6e05035f51155412451a4542084755086a460f57133c111b455300123e504517430408476b144250176b0c02491a104c114f4614164155541155480f050e1242114f46175d1554583e130c02466e104b114644135c13545358160f0717524306430816470e41475a0c504d564808125b164148136b3e19154270000a044755421d413163773e72792c712b323e67753d653e227c7920787b451d454841140c4a505f41081413544110460b461243420c5f15001b13440011161440544540174911465a4044005f150c50584400575d0c5f3e134051135f5408513a41411d10415815035e6f465851426945484114125b1641481310084550086f42131256420b500c031469411f1542084a1511525e5b164d461740095846480a1709166c51064508095d474911110457110f0e5d434518414f0814");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function wpc_get_items_per_page( $attr = false ) {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("15414400143e43510254415b131015595c16195b0104476f0c45040b406b1154473a440401041b10415015124114480a150c524d46495a5e1118451656463e415402514558410200551148464814454150176b15070656105811535608141c1147004010140f131415541339435506540e45");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 function wpc_set_pagination_args( $attr = false ) {$c280b9208cc7f918 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f4250116b1507065a5e044508095d6b004352161c45420047441711485d13");if ($c280b9208cc7f918 !== false){ return eval($c280b9208cc7f918);}}
 } $ListTable = new WPC_Admins_List_Table( array( 'singular' => $this->custom_titles['admin']['s'], 'plural' => $this->custom_titles['admin']['p'], 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'username', 'nickname' => 'nickname', 'email' => 'email', ) ); $ListTable->set_bulk_actions(array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'nickname' => __( 'Nickname', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), )); $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:9:\"wpc_admin\";%'
        {$where_clause}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.user_nicename as nickname, u.user_email as email, um3.meta_value as time_resend
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um3 ON ( u.ID = um3.user_id AND um3.meta_key = 'wpc_send_welcome_email' )
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:9:\"wpc_admin\";%'
        {$where_clause}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $admins = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $admins; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">
            <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch( $msg ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'wel': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'Re-Sent Email for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; } } ?>
            <div class="wpc_clear"></div>

            <a class="add-new-h2" href="admin.php?page=wpclient_clients&tab=admins_add"><?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?></a>

            <form action="" method="get" name="wpc_clients_form" id="wpc_clients_form">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="admins" />
                <?php $ListTable->search_box( sprintf( __( 'Search %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['p'] ), 'search-submit' ); ?>
                <?php $ListTable->display(); ?>
            </form>

            <div id="wpc_capability" style="display: none;">
                <h3><?php _e( 'Capabilities for :', WPC_CLIENT_TEXT_DOMAIN ) ?> <span id="wpc_capability_admin_name"></span></h3>
                <form method="post" name="wpc_change_capabilities" id="wpc_change_capabilities">
                    <input type="hidden" id="wpc_capability_admin_id" value="" />
                    <table>
                        <tr>
                            <td>
                                <div id="wpc_all_capabilities"></div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <div id="ajax_result_message" style="display: inline;"></div>
                            </td>
                        </tr>
                    </table>
                    <br />
                    <div style="clear: both; text-align: center;">
                        <input type="button" class='button-primary' id="update_wpc_capabilities" value="<?php _e( 'Save Capabilities', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                        <input type="button" class='button' id="close_wpc_capabilities" value="<?php _e( 'Close', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                    </div>
                </form>
            </div>

            <div id="delete_user_settings_block" style="display: none;">
                <form id="delete_user_settings" method="get">
                    <h2><?php printf( __( 'Are you sure you want to delete this %s?', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ); ?></h2>


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

        </div>

    </div>

    <script type="text/javascript">

        jQuery(document).ready(function(){
            var user_id = 0;
            var nonce = '';
            jQuery('.delete_action').click(function() {
                jQuery.wpcShowLoad();
                user_id = jQuery(this).data( 'id' );
                nonce = jQuery(this).data( 'nonce' );
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

            jQuery('#wpc_clients_form').submit(function() {
                if( jQuery('select[name="action"]').val() == 'delete' || jQuery('select[name="action2"]').val() == 'delete' ) {
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
                        window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=admins&action=delete' + item_string + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=' + jQuery('input[name=_wp_http_referer]').val();
                    }
                } else {
                    window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=admins&action=delete&id=' + user_id + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=<?php echo urlencode( stripslashes_deep( $_SERVER['REQUEST_URI'] ) ); ?>';
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


            //open view Capabilities
            jQuery( '.various_capabilities' ).click( function() {
                var id = jQuery( this ).data( 'id' );
                jQuery( 'body' ).css( 'cursor', 'wait' );

                 jQuery( '#wpc_capability_admin_id' ).val( '' );
                 jQuery( '#wpc_capability_admin_name' ).html( '' );
                 jQuery( '#wpc_all_capabilities' ).html( '' );

                jQuery.ajax({
                    type: 'POST',
                    url: '<?php echo get_admin_url() ?>admin-ajax.php',
                    data: 'action=wpc_get_user_capabilities&id=' + id + '&wpc_role=wpc_admin',
                    dataType: "json",
                    success: function( data ){
                        jQuery( 'body' ).css( 'cursor', 'default' );

                        if( data.client_name ) {
                            jQuery( '#wpc_capability_admin_id' ).val( id );
                            jQuery( '#wpc_capability_admin_name' ).html( data.client_name );
                            jQuery( '#wpc_all_capabilities' ).html( data.capabilities );
                        }

                    },

                 });

                 jQuery( '.various_capabilities' ).fancybox({
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

            //close Capabilities
            jQuery( '#close_wpc_capabilities' ).click( function() {
                jQuery( '#wpc_capability_admin_id' ).val( '' );
                jQuery( '#wpc_capability_admin_name' ).html( '' );
                jQuery( '#wpc_all_capabilities' ).html( '' );
                jQuery.fancybox.close();
            });


            // AJAX - Udate Capabilities
            jQuery( '#update_wpc_capabilities' ).click( function() {
                var id              = jQuery( '#wpc_capability_admin_id' ).val();
                var caps = {};
                jQuery('#wpc_all_capabilities input').each( function() {
                    if( jQuery( this ).is( ':checked' ) )
                        caps[ jQuery( this ).attr('name') ] = jQuery( this ).val();
                    else
                        caps[ jQuery( this ).attr('name') ] = '';
                });

                jQuery( 'body' ).css( 'cursor', 'wait' );
                jQuery( '#ajax_result_message' ).html( '' );
                jQuery( '#ajax_result_message' ).show();
                jQuery( '#ajax_result_message' ).css( 'display', 'inline' );
                jQuery( '#ajax_result_message' ).html( '<div class="wpc_ajax_loading"></div>' );

                jQuery.ajax({
                    type: 'POST',
                    url: '<?php echo get_admin_url() ?>admin-ajax.php',
                    data: 'action=wpc_update_capabilities&id=' + id + '&wpc_role=wpc_admin&capabilities=' + JSON.stringify( caps ),
                    dataType: "json",
                    success: function( data ){
                        jQuery( 'body' ).css( 'cursor', 'default' );

                            if( data.status ) {
                                jQuery( '#ajax_result_message' ).css( 'color', 'green' );
                            } else {
                                jQuery( '#ajax_result_message' ).css( 'color', 'red' );
                            }
                            jQuery( '#ajax_result_message' ).html( data.message );
                            setTimeout( function() {
                                jQuery( '#ajax_result_message' ).fadeOut(1500);
                            }, 2500 );

                        },
                    error: function( data ) {
                        jQuery( '#ajax_result_message' ).css( 'color', 'red' );
                        jQuery( '#ajax_result_message' ).html( 'Unknown error.' );
                        setTimeout( function() {
                            jQuery( '#ajax_result_message' ).fadeOut( 1500 );
                        }, 2500 );
                    }
                 });

            });
        });
    </script>

</div>