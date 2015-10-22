<?php
 if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_add_staff' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } function wpc_import_staff( $handle, $delimiter, $custom_fields_keys, $selected_client_for_import ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e4645415f12115c46030f411546115503003e5254015405460e14510a1541470e0f116c5908410e1447145c11055e14410008565c0142415b13551343541c1c4541144055176e0d09545d0f1615580a45564d1317104204146c440042464214585841021c4516141556463e5458045d0941410e0e45034d46145008424509551c390f525d0016415b0d14521d1542470008056c40044212115c46051615580a45524d1317065d08035d403e58514214585841061c4516020a5a510f456a104700140f525d0016415b0d14571d154c0f4511095a5c001149461b144555541155455b41555700450215451c41155d045a010a041f10540151561f14455550095d080f1556424518414f13155c0c1523752935241319454a4142415b161a1e5e140c00411b1055115c5b131012455403523a0705575501114740130551110858144d4645415f12114c4617470a58453a5d08160e41444518414f134f4143501141170841030b454c410f55144911140c473a071341511c19414257551550154c14191a4101105b110209465a15191541500412001319451841055c5a15585b10515e460855104d1150460e094115470a434540471356045d120313155c0c1504461707186c43005013055b1c411640165117390d5c570c5f464a131005504104144c4647151003500d155614400c0845551714004a6f16540014505c491112104700143e43511642464a131005504104144c4647151003500d155614400c0845551714004a6f16540014505c491112104700143e565d04580d411f144555541155454f411a101e1145005a510d5546450945071341511c19485d13520e435004570d4e41175404450046524741155e004d455b5f131413500d13561448114e451013070d4655450c4112415d0c19154142040a1456104c0a410f5514491112065b0b120050443a5f000b5613410c08451013070d46554518411d13101750591051455b4114540c42110a524d3e5f540851425d414e10005d12035a524119150c5a3a071341511c19414245550d4450491441051440440a5c3e005a510d55463a5f001f1213194518411d13100758500950163d46504516450e0b6c520854590147423b3a1746045d14036e145c11110e511c5d41505f0b45080846515a11484510030f045f54166a45105258145468450945420a56495e111c46505b0f455c0b41005d414e10414412034150004554450945071341511c194141415b0d541245095b46464440066e020a5a510f456a1640040007141c45185a46555b135454065c4d46455559005d051513551211110e511c465c0d104147000a46514118151e140c00411b1042521415475b0c6e530c510902121410580c4142585118111c454f45000e41550452094e13101750591051450712131406573e0d564d410c0b451006003e4551094404461a141a111110470014055244046a46054647155e583a520c030d5743426c3a4250523e5a501c69455b415643066e00124746491141175d084e4117540445003d1757076e43045810033c131945185a464e14025e5b115d0b1304081018110800131c4158461651114e4117540445003d1742005d400069454f411a101e114513405113555411553e420a564938115c465647026e541140174e4147420c5c494617500045543e1013070d4655381148461a0f414c1518140c00411b1044581215564049111110470014055244046a46134051136e590a530c08466e104c111d1a131346110858144113125642015015076813144250176b0909065a5e426c414f13570e5f410c5a10035a135903114946125d124250111c454214405517550012526f46444600463a16004043426c414f13481d11124214585b411745165413025240006a12104700143e43511642463b131d41525a0b400c0814560b455807461b144058461651114e411745165413025240006a12104700143e565d04580d416e1448114919144241410e0d451514155646055041046f42131256423a540c075a58466c154c1406090f47590b44045d135d07111d45411603135d5108543e034b5d1245464d144113125642015015076813144250176b0909065a5e426c414f131d414a1541470e0f116c5908410e14471f4a0a15065b0b12085d45000a411b1310144250176b000b005a5c450c410743440d486a035d09120441434d11461641513e444600463a030c525909164d465a471254414d144113125642015015076813144250176b000b005a5c426c414f130b411540165117020047513e16141556463e5458045d09413c130a451646461a0f415853451c45030c5259096e041e5a4715421d4510101504416f005c000f5f1448111c454f4542125859156e080b435b13451e4e0f45050e5d440c5f140308141c111110470014055244046a46025a47115d541c6b0b070c561738115c461b1408424600404d464546430043050747553a16510c47150a004a6f0b500c0314694118154312454146131158114513405113555411553e41055a43155d001f6c5a005c504269454f410c104144120341500045543e13010f12435c04483e085259041668450e454146081041441203416b085515581412163e5a5e165413126c411254474d14411312564201501507131d5a11110447160f065d6f115e3e055f5d045f413a52090706130d4557000a40515a115c03144d46084043004549461741125447015511073a145309580408476b144250175a040b04146d45184140151440545815401c4e411745165413025240006a1206580c030f476f104204145d550c541238144c4648134b4515020a5a510f451558140203156c4516541339514d491112095b020f0f141c451514155646055041046f42050d5a550b453e134051135f540851423b411a0b455807461b144552590c510b12411a101e111416575515546a104700143e5e551150494617411254473a5d014a41144004430408476b025d5c005a1139085717491145055f5d045f41480a2c22411a0b45150015405d065f6a115b3a050d5a550b453e005f550611084540171304081018111c465a5241191544100415125a570b6e15096c570d58500b403a000d5257451747465a471254414d144113125642015015076813025d5c005a11390857173811484615124110500844111f49131410420414575515506e4257090f045d443a5805416e1448111c454f4542025f59005f15460e140654413a411603135751115049461741125447015511073a145309580408476b08551238144c5d415a5645194142505808545b11144c461a134515550012566b144250176b08031552184515141556463e5851491442160041550b453e055f5d045f413a5d01414d1314065d08035d404c0f7c21144c5d411751164208015d6b155e6a06580c030f476f035d0001130941454710515e461c134d455807461b1440155416470c010f6c440a6e020a5a510f456a035804014115164510040b43401819154147000a04504400553e055f5d045f413a520a143e5a5d155e1312131d4118151e141016055244006e141556463e5c5011554d4645464300433e0f571841164504460008156c5309580408476b08551249144115045f55064504026c570d58500b403a000e416f0c5c1109414041180e45100415125a570b6e15096c570d58500b403a000d5257450c41124141040a1518140c00411b100c421203471c411540165117020047513e16021340400e5c6a035d000a05401738114846151241011559140609145d444d114513405113555411553e41024643115e0c39555d045d5116133846481319454a41424444026e56104711090c6c560c540d0240145c111112440639025f59005f154b0d57026e5200403a150447440c5f06151b1446524016400a0b3e5559005d05151414480a15035b17030050584d114513405113555411553e41024643115e0c39555d045d5116133846004010415a041f13095f111113550913041319454a411343500045503a411603136c5d0045004e1310144250176b0c024d13140e54184a13101750591051454f5a1359031149465a471254414d14411111506f064412125c593e575c005801153a175b00483c3d1446045d5411513a120e146d45184140151446161544094512135a5d4d11451143573e524016400a0b3e5559005d051568100a544c386f4214045f5111543e125c133c111c451d451d414640015015036c411254473a590012001b1041441203416b0855194540170f0c1b10414611056c571442410a593a0008565c01423a425851186c6e4246000a0047553a450e416e14481d154142040a1456104c0a411b1349414c150c52454e415a431654154e13101442501750041200681716540f026c44004246125b1702466e104c11474013134611145814411312564201501507681312545b016b15071240470a4305416e1448114e451004140640105811001441551819154257090f045d443a58054113095f1111104700143e5a54491146134051136e45044716110e415442115c58131014425017500412006817104204146c440042464269454f5a131412410239505808545b11195b05026c5d04580d4e131312455403523a05135651115405411f144544460046010715526b42441203416b045c540c58423b4d1314044306151f1446424104520339024155044504021414480a1518144115155256036e00025751051a1e5e14184613564410430f461747155053036b04020556545e11");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 if ( isset( $_POST['import'] ) ) { $target_path = $this->get_upload_dir(); $target_path = $target_path . basename( $_FILES['file']['name'] ); $ext = explode( '.', $_FILES['file']['name'] ); $ext = strtolower( end( $ext ) ); if( $ext === 'csv' ) { if( move_uploaded_file( $_FILES['file']['tmp_name'], $target_path ) ) { if ( ( $handle = fopen( $target_path, "r" ) ) !== FALSE ) { $wpc_custom_fields = $this->cc_get_settings( 'custom_fields' ); $custom_fields_keys = array(); $cf_arr = array(); if ( is_array( $wpc_custom_fields ) && 0 < count( $wpc_custom_fields ) ) { foreach( $wpc_custom_fields as $key => $value ) { if ( isset( $value['nature'] ) && 'staff' == $value['nature'] ) { $custom_fields_keys[] = $key; } } } $selected_client_for_import = ''; if ( isset( $_POST['client_for_import'] ) && '' != $_POST['client_for_import'] ) { $selected_client_for_import = $_POST['client_for_import']; } $added_staff = wpc_import_staff( $handle, ',', $custom_fields_keys, $selected_client_for_import ); fclose( $handle ); if ( !$added_staff ) { $handle = fopen( $target_path, "r" ); $added_staff = wpc_import_staff( $handle, ';', $custom_fields_keys, $selected_client_for_import ); fclose( $handle ); } unlink( $target_path ); $msg = "ci&cl_count=" . $added_staff; } else { $msg = "uf"; } } else { $msg = "uf"; } } else { $msg = "uf"; } do_action( 'wp_client_redirect', get_admin_url(). 'admin.php?page=wpclient_clients&tab=staff&msg=' . $msg ); exit; } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=staff'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': case 'delete_from_blog': case 'delete_mu': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_staff_delete' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['staff']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) ) { foreach ( $clients_id as $client_id ) { if( $_GET['action'] == 'delete_mu' ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $where_clause = ''; if( isset( $_GET['s'] ) && !empty( $_GET['s'] ) ) { $search_text = strtolower( trim( esc_sql( $_GET['s'] ) ) ); $where_clause .= "AND (
        u.user_login LIKE '%" . $search_text . "%' OR
        um2.meta_value LIKE '%" . $search_text . "%' OR
        um3.meta_value LIKE '%" . $search_text . "%' OR
        u.user_email LIKE '%" . $search_text . "%'
    )"; } $not_approved = get_users( array( 'role' => 'wpc_client_staff', 'meta_key' => 'to_approve', 'fields' => 'ID', ) ); $not_approved = " AND u.ID NOT IN ('" . implode( ',', $not_approved ) . "')"; $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; $order_by = 'u.user_registered ' . $order; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'username' : $order_by = 'u.user_login ' . $order; break; case 'name' : $order_by = 'um2.meta_value ' . $order . ', um3.meta_value ' . $order; break; case 'email' : $order_by = 'u.user_email ' . $order; break; case 'client' : $client_ids = $wpdb->get_col("SELECT meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'parent_client_id'"); if( count( $client_ids ) ) { $client_ids = $wpdb->get_col("SELECT ID FROM {$wpdb->users} WHERE ID IN ('" . implode( "','", $client_ids ) . "') ORDER BY user_login $order"); $order_by = "FIELD( parent_client_id, '" . implode( "','", $client_ids ) . "', '' )"; } break; } } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Staff_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d4546113943551342503a551701121b1041501301401841504717551c4e4114430c5f06135f55131615580a45393e1b10425815035e134d116235773a252d7a752b653e32766c356e712a79242f2f1319491146165f4113505942145858416c6f4d11460f47510c421249143236226c7329782428676b35746d316b21292c72792b11484a1313005b541d13455b5f1356045d1203131d41180e4510110e08401d5b5f0e395a40045c463a59001512525700115c4617551356463e13150a14415109163c461d14461112451a45393e1b10425f0e1213520e445b011a424a416460266e222a7a712f656a31713d323e777f28702828131d5a11450446000815090a3a6e02095d4715434006404d464552420242414f0814");if ($ce7190b3fdbae599 !== false){ eval($ce7190b3fdbae599);}}
 function __call( $name, $arguments ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d1006500d0a6c411254473a521008026c511743001f1b14004347044d4d464547580c424d46175a005c50451d494645524202440c035d4012111c5e14");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function prepare_items() {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541570a0a145e5e16115c461740095846480a0203156c530a5d140b5d4749180e45100d0f0557550b115c46524613504c4d1d5e4645405f174500045f51410c1541400d0f121e0e02541539405b13455407580039025c5c105c0f151b1d5a1111115c0c154c0d6f065e0d135e5a3e59500450001412130d45501314524d491111065b09130c5d434911450e5a5005545b491441150e414404530d03131d5a11");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function column_default( $item, $column_name ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d4608404300454946175d1554583e1441050e5f45085f3e085259041168451d454f41481017541513415a41155c1151083d4117530a5d140b5d6b0f50580014385d414e10005d1203134f414350114117084114175e111c46");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function no_items() {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("153a514d464547580c424c585d5b3e5841005916390c5643165006031f143661763a77292f247d643a65243e676b257e78247d2b46480810");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function set_sortable_columns( $args = array() ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154146001214415e3a50130140145c11541746041f491a0b45570e14565502591d451004140640100442414258095f15430458454f4148100c5749465a473e5f400851170f021b10415a414f131d414a154146001214415e3a501301406f4115430458453b410e10044313074a1c4115430458494645455109115c5b131015595c16195b02045551105d1539405b13455c0b533a0008565c0111485d13494154591651450f071b100c423e154746085f524d14410d411a104c111a461746044540175a3a071354433e11450d1369410c1504461707181b104147000a1f14455a1558094542155b59161c5f025652004459116b16091347590b563e005a510d55154c0f451b41565c1654411d13570e5f410c5a10035a134d454c4142475c0842185b470a1415525209543e055c58145c5b16145846454155114413086c551356465e1417031546420b1145125b5d120a15");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function get_sortable_columns() {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f425a174004040d566f065e0d135e5a120a15");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function set_columns( $args = array() ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46025c450b4549461740095846480a07130d586f0452150f5c5a12111c451d451d411751175612460e14004347044d3a0b04415700194107414600481d4513060446130d5b11465a5a5a11444145401c16040e120659040558560e4917451b5b41411a1c45150014544741180e45494542155b59161c5f055c58145c5b1614584645524202425a4641511544470b144112095a435e11");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function get_columns() {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f525a09410808120810");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function set_actions( $args = array() ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e0452150f5c5a1211084510041406400b4543041246460f1111115c0c155a13");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function get_actions() {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5056115d0a08120810");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function set_bulk_actions( $args = array() ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e07440d0d6c5502455c0a5a16465c131404430615081413544110460b464547580c425a46");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function get_bulk_actions() {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5340095f3a070247590a5f125d13");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function column_cb( $item ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d101641130f5d4007191542080c0811464445451816560943525d00570e040e4b12455f000b560943584100593e3b431346045d14030e16444217451b5b414d13140c45040b681308551238144c5d41");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function column_client( $item ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541440414045d443a520d0f565a156e5c01145846455a44005c3a41435513545b116b060a08565e116e080214695a111106580c030f476f0b500c0313094116125e140c00411b1055115d4617440043500b403a050d5a550b453e0f571448114e4510060a08565e11115c465451156e40165117020047514d1145165246045f413a57090f045d443a5805461a0f415853451c4542025f59005f15461a141a111106580c030f476f0b500c031309411556095d0008151e0e0254154e1313144250176b0909065a5e4211485d1349414c1517511113135d1041520d0f565a156e5b0459005d41");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function column_name( $item ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10415815035e6f46575c174711390f525d00163c461d14461112451a4542084755086a460a5247156e5b045900413c0810");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function column_username( $item ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e4645525311580e0840145c11541746041f491a0b45150005475d0e5f463e1308031240550254463b130941160904140d1404550d4750050b5a5a4f415d150b150706560d1241020a5a510f45463a570a0815565e11171507510911435c135511033e5e5516420001564747444600463a0f050e17451f41425a40045c6e425d01413c131e4516435814144f116a3a1c45412c56431650060340134d116235773a252d7a752b653e32766c356e712a79242f2f13194b11465a1c555f160e45100405155a5f0b423a41565008451238145846460f51455913035509435051085d0b48115b405a4100015609164156095d0008156c53095804084747474554070916120055563a54050f471208550842144b46455a44005c3a415a50466c154b1442445f14104b113e391b144674510c40424a416460266e222a7a712f656a31713d323e777f28702828131d4f1112591b0458460810415002125a5b0f426e424315053e50511550030f5f5d15481238145846460f5145591303550943124215573a0500435107580d0f474d4311510440044b08570d471641481310084550086f420f05146d451f41416c13411f150850504e41144715523e055f5d045f413a471107075517451f413576773463703a753032296c63247d35461d1445584100593e41085717381148461d1446131506580415120e121350130f5c41126e5604440404085f5911580415110a46111b456b3a4e4114790b5508105a50145059457704160051590958150f5647461d1532642639227f79207f3539677139656a217b2827287d104c114f4614084e500b420f450f071b100c423e0b46581558460c40004e481319454a4142525715585a0b473e4105565c0045043955460e5c6a07580a01466e105811465a52140e5f56095d060d5c6f1717541513415a41525a0b520c140c1b1242114f46404413585b11524d463e6c18451620145614185e40454710140413490a444111525a1511410a1401030d56440011150e5a474114465a1349463663733a722d2f767a356e61206c3139257c7d24782f461a1841154215573a050d5a550b454c58504112455a086b110f155f55166a46154755075712386f4215466e104c114f461416480a6942140d1404550d4750050b5a5a4f415d150b150706560d1241020a5a510f456a06580c030f4743434500040e4715505303120405155a5f0b0c05035f5115546a03460a0b3e515c0a56470f570946111b45100c12045e6b425805416e144f1112436b12160f5c5e06545c41131a4146453a5717030047553a5f0e0850514911121244063912475103573e02565804455042144b46455a44005c3a415a50466c154b140203156c53104313035d403e444600463a0f051b19451841481313476e42156b0d1215436f175407034151130c12451a4513135f550b520e02561c414241175d15150d52430d541239575104411d45103a3524616620633a41617130647036603a33337a17381148461a144f111247145b41411d103a6e49461470045d5011514520135c5d45730d0954134d116235773a252d7a752b653e32766c356e712a79242f2f1319451f41410f1b000f125e1441070247590a5f123d1450045d501151423b410e10420d00465c5a025d5c065f583a4641551144130813570e5f530c46084e4314104b111216415d0f45534d143a39491317244304464a5b14114610460046185c45454600084714155e1501510903155610115908151311120e1249143236226c7329782428676b35746d316b21292c72792b11484a13101641563a57090f045d44480f021340400e5c6a115d110a04406b424215075552466c6e4247423b411a104b1146441a0f3d16150d4600005c1151015c08081d4409410a155502035c4440065d08035d403e52590c510b1212154404535c1547550757130457110f0e5d0d01540d0347513e5c40435d015b46131e4515081256593a165c011338464f1317436e16165d5b0f5250581345484144403a5213035240046e5b0a5a06034913171241023940400057533a50000a04475542114f46175d1554583e130c02466e104b110603476b02444717510b123e464300433e0f571c48111c451a4541476c47156e091247443e435003511703130e17451f41134158045f560a50004e414044175811155f55125950166b010304431845153e3576663774673e13372330667536653e33617d466c154c144c464f131747115f41131a416e6a4d144222045f5511544120415b0c117b0040120913581749113636706b227d7c207a3139357668316e25297e75287f154c144b46460f1f040f465d13494154591651451d411751064508095d473a16510058001204146d450c41410f55415e5b06580c050a0e6c4243041246460f11560a5a030f135e1847164148134711435c0b40034e416c6f4d114627415141485a101416131356101c5e144644550f4515115b4502045f55115441125b5d121110160b424a416460266e222a7a712f656a31713d323e777f28702828131d4d111112440639025f59005f154b0d571442410a593a1208475c00423a41404000575342693e4112146d45184148131343180e3913450e135656581300025e5d0f1f450d445a16005455584611055f5d045f413a57090f045d44161715075109124554035243070247590a5f5c025658044550435d015b46131e4515081256593a165c011338464f1317436e16165d5b0f5250581345484144403a5213035240046e5b0a5a06034913171241023940400057533a50000a04475542114f46175d1554583e130c02466e104b110603476b02444717510b123e464300433e0f571c48111c451a4541476c47156e091247443e435003511703130e17451f41134158045f560a50004e414044175811155f55125950166b010304431845153e3576663774673e13372330667536653e33617d466c154c144c464f131747115f41131a416e6a4d144222045f551154464a136331726a26782c232f676f317439326c702e7c742c7a454f411d10420d4e070d135a11484546001214415e454211145a5a15571d42115442121315571512411f14460d4615550b4608570d4742150755523e444600460b070c566f42114f46175d1554583e130c02466e104b1146440d13411f15415d11030c6817104204145d550c541238144b46460f1f164100080d134d1111115c0c154c0d420a463e075040085e5b161c45420050440c5e0f15131d41180e45");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function wpc_get_items_per_page( $attr = false ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("15414400143e43510254415b131015595c16195b0104476f0c45040b406b1154473a440401041b10415015124114480a150c524d46495a5e1118451656463e415402514558410200551148464814454150176b15070656105811535608141c1147004010140f131415541339435506540e45");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 function wpc_set_pagination_args( $attr = false ) {$ce7190b3fdbae599 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f4250116b1507065a5e044508095d6b004352161c45420047441711485d13");if ($ce7190b3fdbae599 !== false){ return eval($ce7190b3fdbae599);}}
 } $ListTable = new WPC_Staff_List_Table( array( 'singular' => $this->custom_titles['staff']['s'], 'plural' => $this->custom_titles['staff']['p'], 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'username', 'name' => 'name', 'email' => 'email', 'client' => 'client' ) ); if( is_multisite() ) { $ListTable->set_bulk_actions(array( 'delete' => __( 'Delete From Network', WPC_CLIENT_TEXT_DOMAIN ), 'delete_from_blog' => __( 'Delete Delete From Blog Network', WPC_CLIENT_TEXT_DOMAIN ), )); } else { $ListTable->set_bulk_actions(array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); } $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'name' => __( 'Name', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), 'client' => sprintf( __( 'Assigned to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), )); $manager_clients = ''; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $clients_ids = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'client' ); $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); foreach ( $manager_groups as $group_id ) { $add_client = $this->cc_get_group_clients_id( $group_id ); $clients_ids = array_merge( $clients_ids, $add_client ); } $clients_ids = array_unique( $clients_ids ); $manager_clients = " AND um4.meta_value IN ('" . implode( "','", $clients_ids ) . "')"; } $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um4 ON u.ID = um4.user_id AND um4.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.user_email as email, um2.meta_value as first_name, um3.meta_value as last_name, um4.meta_value as parent_client_id
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id AND um2.meta_key = 'first_name'
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id AND um3.meta_key = 'last_name'
    LEFT JOIN {$wpdb->usermeta} um4 ON u.ID = um4.user_id AND um4.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    ORDER BY $order_by
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $staff = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $staff; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch($msg) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'ci': echo '<div id="message" class="updated wpc_notice fade"><p>' . ( ( isset( $_GET['cl_count'] ) ) ? $_GET['cl_count'] . ' ' : '0 ') . sprintf( __( '%s are <strong>Imported</strong>.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ) . '</p></div>'; break; case 'uf': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'There was an error uploading the file, please try again!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block staff">

            <?php if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_add_staff' ) ) { ?>
                <a class="add-new-h2" href="?page=wpclient_clients&tab=staff_add"><?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            <?php } ?>
            <?php if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>
                <a class="add-new-h2" id="slide_panel_1" rel="1" href="javascript:;"><?php _e( 'Import', WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="arrow"></span></a>
            <?php } ?>

            <?php if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>
                <div id="slide_client_panel_1" class="slide_client_panel" style="display: none;">
                    <form action="?page=wpclient_clients&tab=staff" method="post" enctype="multipart/form-data">
                        <div style="width: 60%;float:left;">
                            <h3 style="text-align: center;">
                                <?php printf( __( 'Import %s from CSV File:', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ) ?>
                            </h3>
                            <table style="width: 100%;float:left;">
                                <tr style="line-height: 30px;">
                                    <td style="width: 40%;text-align: left;">
                                        <label for="file"><?php _e( 'Import CSV List' , WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                    </td>
                                    <td style="text-align: left;padding: 0;"><input type="file" name="file" id="file" accept=".csv" /></td>
                                </tr>
                                <!--<tr style="line-height: 30px;">
                                    <td style="width: 40%;text-align: left;">
                                        <label for="update_exist_clients">
                                            <?php printf( __( 'Update existing %s via import', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ); ?>:
                                        </label>
                                        <span style="padding: 0 0 0 5px; vertical-align: middle;">
                                            <?php echo $this->tooltip( sprintf(__( 'With this box checked, your existing %s data will be overwritten/updated based on the data in the imported CSV file. Use this to bulk update passwords, emails, etc. Only %s whose usernames match usernames in the CSV will be updated.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'], $this->custom_titles['staff']['p'] ) ) ?>
                                        </span>
                                    </td>
                                    <td style="text-align: left;padding: 0;">
                                        <input type="checkbox" name="update_exist_clients" id="update_exist_clients" value="1" />
                                    </td>
                                </tr>-->
                                <tr style="line-height: 30px;">
                                    <td style="width: 40%;text-align: left;">
                                        <?php printf( __( '%s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'], $this->custom_titles['client']['p'] ); ?>:
                                    </td>
                                    <td style="text-align: left;padding: 0;">
                                        <?php $link_array = array( 'title' => sprintf( __( 'Assign to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'text' => sprintf( __( 'Assign to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'data-marks' => 'radio' ); $input_array = array( 'name' => 'client_for_import', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => '0' ); $this->acc_assign_popup( 'client', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                    </td>
                                </tr>
                                <tr style="line-height: 30px;">
                                    <td colspan="2" style="padding: 0;"><input type="submit" class='button-primary' name="import" value="Import !" onclick="return checkform();" /></td>
                                </tr>
                            </table>
                        </div>
                        <div class="clear"></div>
                    </form>
                </div>
            <?php } ?>


<!--        <?php if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>

            <div class="alignleft actions">
                <form action="?page=wpclient_clients&tab=staff" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>
                            <span style="color: #800000;">
                                <em>
                                    <span style="font-size: small;">
                                        <span style="line-height: normal;">
                                            <?php printf( __( 'Import %s from CSV File:', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ) ?>
                                        </span>
                                    </span>
                                </em>
                            </span>
                            </td>
                            <td><input type="file" name="file" id="file" accept=".csv" /></td>
                            <td>
                                <?php
 $link_array = array( 'title' => sprintf( __( 'Assign to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'text' => sprintf( __( 'Assign to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'data-marks' => 'radio' ); $input_array = array( 'name' => 'client_for_import', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => '0' ); $this->acc_assign_popup( 'client', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                            </td>
                            <td><input type="submit" class='button-primary' name="import" value="Import !" onclick="return checkform();" /></td>
                        </tr>
                    </table>

                </form>
            </div>
            <br clear="all" />
            <hr />

        <?php } ?>
                  -->
            <form action="" method="get" name="wpc_clients_form" id="wpc_clients_form">

                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="staff" />
                <?php $ListTable->search_box( sprintf( __( 'Search %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ), 'search-submit' ); ?>
                <?php $ListTable->display(); ?>
            </form>

        </div>


        <div id="wpc_capability" style="display: none;">
            <h3><?php _e( 'Capabilities for :', WPC_CLIENT_TEXT_DOMAIN ) ?> <span id="wpc_capability_client_staff_name"></span></h3>
            <form method="post" name="wpc_change_capabilities" id="wpc_change_capabilities">
                <input type="hidden" id="wpc_capability_client_staff_id" value="" />
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




        <script type="text/javascript">

            jQuery(document).ready(function(){

                jQuery( '#slide_panel_1' ).click( function() {
                    var current_slider = this;
                    var current_panel = '#slide_client_panel_' + jQuery( this ).attr( 'rel' );

                    if ( jQuery( current_panel ).is( ':visible' ) ) {
                        jQuery( current_slider ).toggleClass( 'active' );
                        jQuery( current_panel ).slideToggle( 'fast' );
                    } else if ( jQuery( '#slide_client_panel_1' ).is( ':visible' ) ) {
                        jQuery( current_slider ).toggleClass( 'active' );
                        jQuery( '#slide_client_panel_1' ).slideToggle( 'fast', function() {
                            jQuery( '#slide_client_panel_1' ).removeClass( 'active' );
                            jQuery( current_panel ).slideToggle( 'slow' );
                        } );
                    } else {
                        jQuery( current_panel ).slideToggle( 'slow' );
                        jQuery( current_slider ).toggleClass( 'active' );
                    }
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

                     jQuery( '#wpc_capability_client_staff_id' ).val( '' );
                     jQuery( '#wpc_capability_client_staff_name' ).html( '' );
                     jQuery( '#wpc_all_capabilities' ).html( '' );

                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_admin_url() ?>admin-ajax.php',
                        data: 'action=wpc_get_user_capabilities&id=' + id + '&wpc_role=wpc_client_staff',
                        dataType: "json",
                        success: function( data ){
                            jQuery( 'body' ).css( 'cursor', 'default' );

                            if( data.client_name ) {
                                jQuery( '#wpc_capability_client_staff_id' ).val( id );
                                jQuery( '#wpc_capability_client_staff_name' ).html( data.client_name );
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
                    jQuery( '#wpc_capability_client_staff_id' ).val( '' );
                    jQuery( '#wpc_capability_client_staff_name' ).html( '' );
                    jQuery( '#wpc_all_capabilities' ).html( '' );
                    jQuery.fancybox.close();
                });


                // AJAX - Udate Capabilities
                jQuery( '#update_wpc_capabilities' ).click( function() {
                    var id              = jQuery( '#wpc_capability_client_staff_id' ).val();
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
                        data: 'action=wpc_update_capabilities&id=' + id + '&wpc_role=wpc_client_staff&capabilities=' + JSON.stringify( caps ),
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

</div>