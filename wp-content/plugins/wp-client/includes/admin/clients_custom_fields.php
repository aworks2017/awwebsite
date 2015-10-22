<?php
 if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } global $wpdb; $fields = array(); $wpc_custom_fields = $this->cc_get_settings( 'custom_fields' ); $types = array(); $i = 0; foreach ( $wpc_custom_fields as $key => $value ) { $i++; $value['id'] = $i; $value['name'] = $key; $types[] = $value; } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=custom_fields'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $ids = array(); if ( isset( $_GET['name'] ) ) { check_admin_referer( 'wpc_field_delete' . $_GET['name'] . get_current_user_id() ); $ids = (array) $_GET['name']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __( 'Fields', WPC_CLIENT_TEXT_DOMAIN ) ) ); $ids = $_REQUEST['item']; } if ( count( $ids ) ) { foreach ( $ids as $item_id ) { unset( $wpc_custom_fields[ $item_id ] ); do_action( 'wp_client_settings_update', $wpc_custom_fields, 'custom_fields' ); $client_ids = get_users( array( 'role' => 'wpc_client', 'meta_key' => $item_id, 'fields' => 'ID', ) ); if ( is_array( $client_ids ) && 0 < count( $client_ids ) ) { foreach( $client_ids as $id ) { delete_user_meta( $id, $item_id ); } } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Fields_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d4546113943551342503a551701121b1041501301401841504717551c4e4114430c5f06135f55131615580a45393e1b10425815035e134d116235773a252d7a752b653e32766c356e712a79242f2f1319491146165f4113505942145858416c6f4d11460f47510c421249143236226c7329782428676b35746d316b21292c72792b11484a1313005b541d13455b5f1356045d1203131d41180e4510110e08401d5b5f0e395a40045c463a59001512525700115c4617551356463e13150a14415109163c461d14461112451a45393e1b10425f0e1213520e445b011a424a416460266e222a7a712f656a31713d323e777f28702828131d5a11450446000815090a3a6e02095d4715434006404d464552420242414f0814");if ($caa2da1beac3152e !== false){ eval($caa2da1beac3152e);}}
 function __call( $name, $arguments ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d1006500d0a6c411254473a521008026c511743001f1b14004347044d4d464547580c424d46175a005c50451d494645524202440c035d4012111c5e14");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function prepare_items() {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541570a0a145e5e16115c461740095846480a0203156c530a5d140b5d4749180e45100d0f0557550b115c46524613504c4d1d5e4645405f174500045f51410c1541400d0f121e0e02541539405b13455407580039025c5c105c0f151b1d5a1111115c0c154c0d6f065e0d135e5a3e59500450001412130d45501314524d491111065b09130c5d434911450e5a5005545b491441150e414404530d03131d5a11");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function column_default( $item, $column_name ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d4608404300454946175d1554583e1441050e5f45085f3e085259041168451d454f41481017541513415a41155c1151083d4117530a5d140b5d6b0f50580014385d414e10005d1203134f414350114117084114175e111c46");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function no_items() {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("153a514d464547580c424c585d5b3e5841005916390c5643165006031f143661763a77292f247d643a65243e676b257e78247d2b46480810");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function set_sortable_columns( $args = array() ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("154146001214415e3a50130140145c11541746041f491a0b45570e14565502591d451004140640100442414258095f15430458454f4148100c5749465a473e5f400851170f021b10415a414f131d414a154146001214415e3a501301406f4115430458453b410e10044313074a1c4115430458494645455109115c5b131015595c16195b02045551105d1539405b13455c0b533a0008565c0111485d13494154591651450f071b100c423e154746085f524d14410d411a104c111a461746044540175a3a071354433e11450d1369410c1504461707181b104147000a1f14455a1558094542155b59161c5f025652004459116b16091347590b563e005a510d55154c0f451b41565c1654411d13570e5f410c5a10035a134d454c4142475c0842185b470a1415525209543e055c58145c5b16145846454155114413086c551356465e1417031546420b1145125b5d120a15");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function get_sortable_columns() {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f425a174004040d566f065e0d135e5a120a15");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function set_columns( $args = array() ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46025c450b4549461740095846480a07130d586f0452150f5c5a12111c451d451d411751175612460e14004347044d3a0b04415700194107414600481d4513060446130d5b11465a5a5a11444145401c16040e120659040558560e4917451b5b41411a1c45150014544741180e45494542155b59161c5f055c58145c5b1614584645524202425a4641511544470b144112095a435e11");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function get_columns() {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f525a09410808120810");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function set_actions( $args = array() ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e0452150f5c5a1211084510041406400b4543041246460f1111115c0c155a13");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function get_actions() {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5056115d0a08120810");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function set_bulk_actions( $args = array() ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e07440d0d6c5502455c0a5a16465c131404430615081413544110460b464547580c425a46");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function get_bulk_actions() {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5340095f3a070247590a5f125d13");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function column_cb( $item ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d101641130f5d4007191542080c0811464445451816560943525d00570e040e4b12455f000b560943584100593e3b431346045d14030e16444217451b5b414d13140c45040b68130f505800133846480810");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function column_type( $item ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1516430c12025b184515081256593a16411c4400413c1319454a4105524704111211511d1246091017541513415a416e6a4d144232044b4445730e1e1418416665266b262a28767e316e35236b603e757a28752c28411a0b45531303525f5a1156044700464657511154110f505f0443125f1417031546420b113e391b144675541151150f02585517164d466464226e76297d2028356c6420693539777b2c707c2b144c5d41505116544141505b1245125f1417031546420b113e391b1446725a1640424a416460266e222a7a712f656a31713d323e777f28702828131d5a11571751040d5a13530442044614400449410446000746091017541513415a416e6a4d14422b145f440c1c0d0f5d514165501d4045240e4b1749113636706b227d7c207a3139357668316e25297e75287f154c0f45041356510e0a410552470411121755010f0e140a4543041246460f116a3a1c45413352540c5e41244640155e5b161349463663733a722d2f767a356e61206c3139257c7d24782f461a0f41534700550e5d41505116544141505c04525e075b1d415b1342004514145d143e6e1d4513260e04505b075e190340134d116235773a252d7a752b653e32766c356e712a79242f2f13195e11031456550a0a1506551603411443005d040547560e49125f1417031546420b113e391b144662500951061241715f1d164d466464226e76297d2028356c6420693539777b2c707c2b144c5d41514200500a5d1357004250451308130d475916540d035040035e4d420e4514044745175f41396c1c4116781058110f4160550954021213760e491249143236226c7329782428676b35746d316b21292c72792b11485d13561354540e0f45050040554516090f5750045f125f1417031546420b113e391b1446795c01500008417559005d05411f143661763a77292f247d643a65243e676b257e78247d2b4648081007430407580f414c15");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function column_id( $item ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10420d1216525a4152590447165b435c42015413395d410c130b42144b46455a44005c3a415a50466c154b14425a4e4040045f5f5a4044005f1506580415120e120a430503416b085c52470a59491243510b0f46460814");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function column_users( $item ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e460855184558121556404911110c40000b3a145e0445141456133c111c451243464640440457074113095c11110c40000b3a145e0445141456133c111c45101015044143450c41424444026e56095d0008151e0e064412125c593e455c115800153a14431150070014693a16454269455d41565c165441424647044346450945421643533a520d0f565a151c0b064116120e5e6f1158150a56473a1656095d000815146d3e1611416e145a1147004010140f131410420414400f41");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function column_title( $item ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104d1108154051151915415d11030c68171158150a56133c111c451d455941175911540c3d1440084559001338465b131742115a46");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function column_description( $item ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104d1108154051151915415d11030c681701541205415d11455c0a5a423b411a104c115e46175d1554583e1301031250420c41150f5c5a466c155f144241410810");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function column_cf_placeholder( $item ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10424a46461d1445584100593e410f525d00163c461d14464c12450f45");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function column_options( $item ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("15415c110b0d130d45165d0f5d44144515114d15035c11530d54020d515b191315015d1607035f550111465d131009455809144b5b411b100c421203471c41155c1151083d46575916410d074a133c111c45124346460217450c5c46175d1554583e13010f12435c0448463b131d410e1542570d030258550116415c131346110e45100d120c5f104b0c4141131b5f175b0747155d475d5216415a41131a416e6a4d144222084040095018465c5a417051085d0b414d136735723e257f7d247f613a60203e356c742a7c202f7d1448111b4513590413131f5b16415d131009455809144b5b41140c0c5f11134714154845000947050956530e530e1e1114055846045609030513175e11450e47590d111b58144d4608404300454946175d1554583e13010f12435c04483e1456530842410046423b411a10431741410213410c0845100c12045e6b42550815435800486a1751020f12475517163c461a145e1112065c00050a565442115b4614135a11110d40080a411d0d451641490d120f5346150f43080340405e164148136b3e191542700c15115f511c110e08136604565c16401707155a5f0b164d466464226e76297d2028356c6420693539777b2c707c2b144c464f1317595313461c0a460a15415c110b0d131e5811465a5a5a11444145401c16040e120659040558560e491745500c1500515c005541410814455941085845485c13184558121556404911110c40000b3a14540c42110a524d3e44460046423b411a10431741410213410c0845100c12045e6b42550815435800486a10470014466e104c115e4614570954560e51014141091042165a46175c155c59451a584646131f5b170f0440445a175b0747155d46131e456e3e4e13132558461558041f415c5e45611309555d0d541249143236226c7329782428676b35746d316b21292c72792b1148461d14460d5717144a584608104159150b5f144f0c1542080c0811464445451816560943525d00570e040e4b124555081552560d545145135e46455b44085d41480e1449115c164700124913140c45040b6813135444105d170305146d45184140151446001245095846455a44005c3a41415110445c175101413c1319450e4141505c04525e005042465b1317420a41425b400c5d154b094541411c0e435f0315430f475f5716445e41411d103a6e494614660440400c460002461f1032612239707828747b316b312339676f217e2c277a7a4118154b14425a0341104a0f465d131009455809144b5b41140c0c5f11134714154845000947050956530e530e1e1114055846045609030513175e11450e47590d111b58144d4608404300454946175d1554583e13030f045f543a430407575b0f5d4c4269454f4115164516504113095c11110c40000b3a14560c540d026c460450510a5a091f466e104c115e4614570954560e51014141091042165a46175c155c59451a584646131f5b170f0440445a175b0747155d46131e456e3e4e1313335454015b0b0a18141c456631256c772d78702b603a32246b643a752e2b727d2f111c450f4514044745175f41425b400c5d0e45");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function column_name( $item ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e4645525311580e0840145c11541746041f491a0b45150005475d0e5f463e13000208471738115c46140800115d1751035b43525408580f48435c110e450453005b16435309580408476b025d5c005a1115474751070c021340400e5c6a035d000a054016005508120e13411f15415d11030c68170b500c031469411f1542165b41411d103a6e494614710558414218453131706f267d28237d603e65703d603a222e7e712c7f414f131a4116094a555b41410810415002125a5b0f426e4250000a044755426c415b13135d50150a5a060a08505b586d4614564014435b45570a08075a4208194341131a416e6a4d1442271356101c5e144640411354151c5b104616525e111115091350045d5011514512095a4345721415475b0c11730c5800025e141c456631256c772d78702b603a32246b643a752e2b727d2f111c451a4541431a0b3916410e4151070c170450080f0f1d400d415e165253040c421557090f045d443a520d0f565a1542131155075b024643115e0c39555d045d5116123a11115d5f0b52045b14144f1142156b0614045244006e0f095d57041915424315053e5559005d053957510d54410013454841175911540c3d145a005c5042694548415455116e02134146045f413a411603136c59011948461a144f111243550612085c5e5855040a564004175b0459005b46131e4515081256593a165b045900413c131e4516473944443e594111443a140455551754135b14144f114017580008025c5400194111436b145f460955160e4913143a6224346571336a12377134332460643a64332f14694118154c144b464611105b164148136b3e19154270000a044755456104145e550f545b11581c414d136735723e257f7d247f613a60203e356c742a7c202f7d1448111b45135949000d17450a4114564014435b45471514085d44031946430210121110571016414d1317594211075d14025d5416475844155b59166e0f075e5143115c0109470008565c016e46461d1445584100593e410f525d00163c461d1446130b42144b46455a44005c3a415d550c541238144b46460f1f164100080d134d1111115c0c154c0d420a463e075040085e5b161c45420050440c5e0f15131d41180e45");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function wpc_get_items_per_page( $attr = false ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("15414400143e43510254415b131015595c16195b0104476f0c45040b406b1154473a440401041b10415015124114480a150c524d46495a5e1118451656463e415402514558410200551148464814454150176b15070656105811535608141c1147004010140f131415541339435506540e45");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 function wpc_set_pagination_args( $attr = false ) {$caa2da1beac3152e = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f4250116b1507065a5e044508095d6b004352161c45420047441711485d13");if ($caa2da1beac3152e !== false){ return eval($caa2da1beac3152e);}}
 } $ListTable = new WPC_Fields_List_Table( array( 'singular' => __( 'Field', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Fields', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $ListTable->set_sortable_columns( array( ) ); $ListTable->set_bulk_actions(array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'id' => __( 'Order', WPC_CLIENT_TEXT_DOMAIN ), 'name' => __( 'Field Slug (ID)', WPC_CLIENT_TEXT_DOMAIN ), 'cf_placeholder' => __( 'Placeholder', WPC_CLIENT_TEXT_DOMAIN ), 'title' => __( 'Title', WPC_CLIENT_TEXT_DOMAIN ), 'users' => __( 'For', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( 'Description', WPC_CLIENT_TEXT_DOMAIN ), 'type' => __( 'Type', WPC_CLIENT_TEXT_DOMAIN ), 'options' => __( 'Options', WPC_CLIENT_TEXT_DOMAIN ), )); $items_count = count( $types ); $items = $types; $ListTable->prepare_items(); $ListTable->items = $items; $ListTable->_pagination_args = array(); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>
    <div class="wpc_clear"></div>
    <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div id="wpc_container">
        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block custom_fields">

            <div>
                <a href="admin.php?page=wpclient_clients&tab=custom_fields&add=1" class="add-new-h2"><?php _e( 'Add New Custom Field', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            </div>

             <form method="get" id="items_form" name="items_form" >
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="custom_fields" />
                <?php $ListTable->display(); ?>
                <p>
                    <span class="description" ><img src="<?php echo $this->plugin_url . 'images/sorting_button.png' ?>" style="vertical-align: middle;" /> - <?php _e( 'Drag&Drop to change the order in which these fields appear on the registration form.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                </p>
             </form>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                    jQuery( 'table.fields' ).attr( 'id', 'sortable' );
                    /*
                    * sorting
                    */

                    var fixHelper = function(e, ui) {
                        ui.children().each(function() {
                            jQuery(this).width(jQuery(this).width());
                        });
                        return ui;
                    };

                    jQuery( '#sortable tbody' ).sortable({
                        axis: 'y',
                        helper: fixHelper,
                        handle: '.column-id',
                        items: 'tr',
                    });

                    jQuery( '#sortable' ).bind( 'sortupdate', function(event, ui) {
                        new_order = '';
                        jQuery('.this_name').each(function() {
                                var id = jQuery(this).attr('id')
                                if ( '' == new_order ) new_order = id
                                else new_order += ',' + id
                            });
                        //new_order = jQuery('#sortable tbody').sortable('toArray');
                        //alert(new_order);
                        jQuery( 'body' ).css( 'cursor', 'wait' );

                        jQuery.ajax({
                            type: 'POST',
                            url: '<?php echo get_admin_url() ?>admin-ajax.php',
                            data: 'action=change_custom_field_order&new_order=' + new_order,
                            success: function( html ) {
                                var i = 1;
                                jQuery( '.order_num' ).each( function () {
                                    jQuery( this ).html(i);
                                    i++;
                                });
                                jQuery( 'body' ).css( 'cursor', 'default' );
                            }
                         });
                    });

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