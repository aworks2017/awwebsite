<?php
if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'read_hubpage' ) && !current_user_can( 'edit_hubpage' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclients_content&tab=files' ); } global $wpdb; if( isset( $_GET['dev_mode'] ) && '1' == $_GET['dev_mode'] && isset( $_GET['dev_action'] ) && 'broken_hubs_creation' == $_GET['dev_action'] ) { $excluded_clients = $this->cc_get_excluded_clients(); $wpc_clients = get_users( array( 'role' => 'wpc_client', 'blog_id' => get_current_blog_id(), 'exclude' => $excluded_clients, ) ); if( isset( $wpc_clients ) && !empty( $wpc_clients ) ) { foreach( $wpc_clients as $user_object ) { $business_name = get_user_meta( $user_object->ID, 'wpc_cl_business_name', true ); $hub_page_id = get_user_meta( $user_object->ID, 'wpc_cl_hubpage_id', true ); if( !( isset( $business_name ) && !empty($business_name ) ) ) { $business_name = $user_object->get( 'user_login' ); update_user_meta( $user_object->ID, 'wpc_cl_business_name', $business_name ); } if( !( isset( $hub_page_id ) && !empty( $hub_page_id ) ) ) { $args = array( 'client_id' => $user_object->ID, 'business_name' => $business_name, ); $this->cc_create_hub_page( $args ); } } } $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=hub_pages'; do_action( 'wp_client_redirect', $redirect ); exit; } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=hub_pages'; } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } $where_status = ''; if( isset( $_GET['filter_status'] ) && !empty( $_GET['filter_status'] ) ) { $where_status = " AND p.post_status = '" . esc_sql( $_GET['filter_status'] ) . "'"; } $where_clause = ''; if( isset( $_GET['s'] ) && !empty( $_GET['s'] ) ) { $search_text = strtolower( trim( esc_sql( $_GET['s'] ) ) ); $where_clause = " AND p.post_title LIKE '%" . $search_text . "%'"; } $where_manager = ''; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_id = get_current_user_id(); $client_ids = $this->cc_get_assign_data_by_object( 'manager', $manager_id, 'client' ); $manager_groups = $this->cc_get_assign_data_by_object( 'manager', $manager_id, 'circle' ); foreach ( $manager_groups as $group_id ) { $add_client = $this->cc_get_group_clients_id( $group_id ); $client_ids = array_merge( $client_ids, $add_client ); } $client_ids = array_unique( $client_ids ); $client_hub_ids = $wpdb->get_col( "SELECT meta_value
           FROM {$wpdb->usermeta}
           WHERE meta_key = 'wpc_cl_hubpage_id'
           AND user_id IN ('" . implode( "','", $client_ids ) . "')" ); $where_manager = " AND p.ID IN ('" . implode( "','", $client_hub_ids ) . "')"; } $where_date = ''; $m = ( isset( $_GET['m'] ) ) ? (int)$_GET['m'] : 0 ; if ( 0 < $m && 6 == strlen( $m ) ) { $year = substr( $m, 0, 4 ); $month = substr( $m, 4, 6 ); $next_month = $month + 1; $where_date = " AND p.post_modified > '{$year}-{$month}-01 00:00:00' AND p.post_modified < '{$year}-{$next_month}-01 00:00:00'"; } $order_by = 'p.ID'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'date' : $order_by = 'p.post_modified'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Hubpages_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d4546113943551342503a551701121b1041501301401841504717551c4e4114430c5f06135f55131615580a45393e1b10425815035e134d116235773a252d7a752b653e32766c356e712a79242f2f1319491146165f4113505942145858416c6f4d11460f47510c421249143236226c7329782428676b35746d316b21292c72792b11484a1313005b541d13455b5f1356045d1203131d41180e4510110e08401d5b5f0e395a40045c463a59001512525700115c4617551356463e13150a14415109163c461d14461112451a45393e1b10425f0e1213520e445b011a424a416460266e222a7a712f656a31713d323e777f28702828131d5a11450446000815090a3a6e02095d4715434006404d464552420242414f0814");if ($c2852cdc5ef7d196 !== false){ eval($c2852cdc5ef7d196);}}
 function __call( $name, $arguments ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d1006500d0a6c411254473a521008026c511743001f1b14004347044d4d464547580c424d46175a005c50451d494645524202440c035d4012111c5e14");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function prepare_items() {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541570a0a145e5e16115c461740095846480a0203156c530a5d140b5d4749180e45100d0f0557550b115c46524613504c4d1d5e4645405f174500045f51410c1541400d0f121e0e02541539405b13455407580039025c5c105c0f151b1d5a1111115c0c154c0d6f065e0d135e5a3e59500450001412130d45501314524d491111065b09130c5d434911450e5a5005545b491441150e414404530d03131d5a11");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function column_default( $item, $column_name ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d4608404300454946175d1554583e1441050e5f45085f3e085259041168451d454f41481017541513415a41155c1151083d4117530a5d140b5d6b0f50580014385d414e10005d1203134f414350114117084114175e111c46");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function no_items() {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("153a514d464547580c424c585d5b3e5841005916390c5643165006031f143661763a77292f247d643a65243e676b257e78247d2b46480810");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function set_sortable_columns( $args = array() ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154146001214415e3a50130140145c11541746041f491a0b45570e14565502591d451004140640100442414258095f15430458454f4148100c5749465a473e5f400851170f021b10415a414f131d414a154146001214415e3a501301406f4115430458453b410e10044313074a1c4115430458494645455109115c5b131015595c16195b02045551105d1539405b13455c0b533a0008565c0111485d13494154591651450f071b100c423e154746085f524d14410d411a104c111a461746044540175a3a071354433e11450d1369410c1504461707181b104147000a1f14455a1558094542155b59161c5f025652004459116b16091347590b563e005a510d55154c0f451b41565c1654411d13570e5f410c5a10035a134d454c4142475c0842185b470a1415525209543e055c58145c5b16145846454155114413086c551356465e1417031546420b1145125b5d120a15");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function get_sortable_columns() {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f425a174004040d566f065e0d135e5a120a15");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function set_columns( $args = array() ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46025c450b4549461740095846480a07130d586f0452150f5c5a12111c451d451d411751175612460e14004347044d3a0b04415700194107414600481d4513060446130d5b11465a5a5a11444145401c16040e120659040558560e4917451b5b41411a1c45150014544741180e45494542155b59161c5f055c58145c5b1614584645524202425a4641511544470b144112095a435e11");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function get_columns() {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f525a09410808120810");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function set_actions( $args = array() ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e0452150f5c5a1211084510041406400b4543041246460f1111115c0c155a13");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function get_actions() {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5056115d0a08120810");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function set_bulk_actions( $args = array() ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e07440d0d6c5502455c0a5a16465c131404430615081413544110460b464547580c425a46");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function get_bulk_actions() {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5340095f3a070247590a5f125d13");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function column_cb( $item ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d101641130f5d4007191542080c0811464445451816560943525d00570e040e4b12455f000b560943584100593e3b431346045d14030e16444217451b5b414d13140c45040b681308551238144c5d41");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function column_title( $item ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b40494645444001535a46175502455c0a5a16465c13511743001f1b1d5a115c03144d4602464217540f126c411254473a5704084913171241023952500c585b42144c461d4f1006441314565a156e401651173902525e4d1146075759085f5c16401707155c42421148464f4841524017460008156c451654133950550f19154251010f156c5810531107545146111c4c141e4645525311580e08406f4654510c40423b410e10420d00465b4604570847440a15151d400d415e165c47150c12451a4542084755086a460f57133c111b451343070247590a5f5c03575d151315115d110a040e1242114f465647026e541140174e416c6f4d114623575d1511410d5d16460847550816414f131d411f1542165b41411d103a6e494614710558414218453131706f267d28237d603e65703d603a222e7e712c7f414f131a4116094a555b415a134d4558074e1357144347005a1139144055176e02075d1c464645066b04020c5a5e3a441203416b0d5e520c5a424f411a101e1145134051136e5c0114584645444001534c585451156e4304464d4645444001534c58434604415417514d4432767c20723546464704436a0c504520337c7d454a45114350031c0b104700140c5644044c41317b71337415085111073e58551c0c461143573e52593a5c1004115257006e08021414207f7145590012006c46045d14030e1105131945100c12045e6b425805416e1448111c5e140c00491359166e0f135e511358564d1441131256423a5805461a1448114e4510160509565d04115c465a473e4246091c4c465e13170d451516400e4e1e12450e4541094744150b4e49140f411556104617030f476f10430d460e144542560d510807411d10416e3223616224636e427c3132316c782a6235416e144f11113a6720343776623e16332362612462613a61372f466e0b45150913516b114350135d00113e464209115c465451156e5401590c083e46420919410846580d1d120450080f0f1d400d415e1143573e5056115d0a085c4155095e060f5d12115052006b0b070c560d0d4403405a505c16154b1441131256423a5805461d144617470052001404416f10430d5b14144f114017580008025c540019414250411343500b403a13135f104c11485d13494154591651451d41175810533e164151175850126b10140d130d4516465d1349414c15005816034148100c57414e13101641563a57090f045d44480f11034159005d5c0b5f164648134b45150913516b114350135d00113e464209115c46174311526a06580c030f471d5b5202395451156e460941024e41145810533e165253046e5c0113454f411d10415815035e6f46585142695e461c1355094204464814455940076b151404455900463e134158410c150450013910465517483e0741534911541746041f49131712410239435506541245095b46465b45076e1114564208544242184541115257006e0f075e514611085b14420e1451174911461143573e415402513a10005f450016415b0d1445584100593e410857173811484a13101641563a57090f045d44480f02056c5304456a165810014913170d440339435506546a0c50424a415551094204461a14480a151814184645525311580e08406f46475c0043423b410e10420d00465b4604570847134b46455b45076e111456420854423a41170a411d1747110e08505808525e58684214044745175f41055c5a075847081c4741411d101641130f5d400719153a6b4d46436a5f1011160f5f584153504546004b0d5c570254054b5a5a41445b01511746155b5545430e0a56140e5715404745120e13401754170f564341455d0c4745160054554b1122095d40085f40000b474a416460266e222a7a712f656a31713d323e777f28702828131d4d111112440639025f59005f154b0d571442410a593a1208475c00423a41505808545b1113383d464017381148461d1446131c5e6842465f14104b113e391b1446614700420c0316141c456631256c772d78702b603a32246b643a752e2b727d2f111c451a45415d1c515b165a4641511544470b141616135a5e11574941160545421540064115461f10420d03580f5541594700525844115c43111f110e430b115e46110942464f13140c45040b681308551238144b46461551064508095d0904555c11165b41411d104d114946141341100845100c12045e6b424508125f51466c154c145a46455a44005c3a41475d155d504269455c41141842114f466c6b4911120b5b451208475c00164d466464226e76297d2028356c6420693539777b2c707c2b144c464f13174c16414f131a4116094a555b5a4e510e421d4142475c0842185b460a113e525311580e08401c41155406400c090f40104c11485d13");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function extra_tablenav( $which ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c52454e4114440a4146460e094115420d5d060e411a101e1145125b5d121c0b085b0b1209406f01430e16575b165f1d45130d13034351025446461a0f41424007590c123e514511450e081b143e6e1d4513230f0d47551716414f1f1446534011400a08461f104257080a4751136e5406400c090f141c4557000a40514d11541746041f4913170c5546460e0a4116450a47114b10465517484c1546560c584142144c464808101811");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function column_date( $item ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541471107154643450c414e1313114457095d160e46130d5811450f47510c6a1216400412144017381148460c143e6e1d45133513035f59165904021418416665266b262a28767e316e35236b603e757a28752c28411a105f113e391b14467d541640452b0e5759035804021418416665266b262a28767e316e35236b603e757a28752c28411a105e1113034741135f15420804040341101158150a56094316154b14410f15565d3e1605074751466c154b1442445f14104b11450f47510c6a1201551103466e104b11465a1c550353475b080714411c0e42114f4617471550411047455d41");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function wpc_get_items_per_page( $attr = false ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("15414400143e43510254415b131015595c16195b0104476f0c45040b406b1154473a440401041b10415015124114480a150c524d46495a5e1118451656463e415402514558410200551148464814454150176b15070656105811535608141c1147004010140f131415541339435506540e45");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 function wpc_set_pagination_args( $attr = false ) {$c2852cdc5ef7d196 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f4250116b1507065a5e044508095d6b004352161c45420047441711485d13");if ($c2852cdc5ef7d196 !== false){ return eval($c2852cdc5ef7d196);}}
 } $ListTable = new WPC_Hubpages_List_Table( array( 'singular' => __( 'HUB Page', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'HUB Pages', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'date' => 'date', ) ); $ListTable->set_columns(array( 'title' => __( 'HUB Title', WPC_CLIENT_TEXT_DOMAIN ), 'client' => $this->custom_titles['client']['s'], 'date' => __( 'Date', WPC_CLIENT_TEXT_DOMAIN ), )); $sql = "SELECT count( p.ID )
    FROM {$wpdb->posts} p
    WHERE
        p.post_type = 'hubpage'
        {$where_manager}
        {$where_status}
        {$where_clause}
        {$where_date}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT p.ID as id, p.post_title as title, p.post_modified as date, p.post_status as status, u.user_login as client
    FROM {$wpdb->posts} p
    LEFT JOIN {$wpdb->usermeta} um ON ( um.meta_key = 'wpc_cl_hubpage_id' AND um.meta_value = p.ID )
    LEFT JOIN {$wpdb->users} u ON ( um.user_id = u.ID )
    WHERE
        p.post_type = 'hubpage'
        {$where_manager}
        {$where_status}
        {$where_clause}
        {$where_date}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $pages = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $pages; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">


            <?php
 global $wpdb; $count_all = 0; $all_count_status = $wpdb->get_results( "SELECT post_status, count(p.ID) as count
                FROM {$wpdb->posts} p
                WHERE post_type = 'hubpage'
                {$where_manager}
                GROUP BY post_status", ARRAY_A ); foreach ( $all_count_status as $status ) { $count_all += $status['count']; } $filter_status = (string)@$_GET['filter_status']; ?>

            <ul class="subsubsub" style="margin: 0px 0px 0px 0px;" >
                <li class="all"><a class="<?php echo ( '' == $filter_status ) ? 'current' : '' ?>" href="admin.php?page=wpclients_content&tab=hub_pages"  ><?php _e( 'All', WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="count">(<?php echo $count_all ?>)</span></a></li>
            <?php
 foreach ( $all_count_status as $status ) { $stat = strtolower( $status['post_status'] ); $class = ( $stat == $filter_status ) ? 'current' : ''; echo ' | <li class="image"><a class="' . $class . '" href="admin.php?page=wpclients_content&tab=hub_pages&filter_status=' . $stat . '">' . ( ( 'publish' == $stat ) ? __( 'Published', WPC_CLIENT_TEXT_DOMAIN ) : ucfirst( $stat ) ) . '<span class="count">(' . $status['count'] . ')</span></a></li>'; } ?>
            </ul>
           <form action="" method="get" name="wpc_clients_form" id="wpc_clients_form">

                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="hub_pages" />
                <?php $ListTable->search_box( __( 'Search HUB Page', WPC_CLIENT_TEXT_DOMAIN ), 'search-submit' ); ?>
                <?php $ListTable->display(); ?>
            </form>
        </div>

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