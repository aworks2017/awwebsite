<?php
 if ( !( current_user_can( 'wpc_show_circles' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { do_action( 'wp_client_redirect', get_admin_url( 'index.php' ) ); exit; } if ( isset( $_REQUEST['wpc_action2'] ) ) { switch ( $_REQUEST['wpc_action2'] ) { case 'edit_group': if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); if( !empty( $_REQUEST['group_id'] ) && !in_array( $_REQUEST['group_id'], $manager_groups ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ae', get_admin_url(). 'admin.php?page=wpclients_groups' ) ); exit; } } if ( !empty( $_REQUEST['group_name'] ) && !empty( $_REQUEST['group_id'] ) && wp_verify_nonce( $_REQUEST['update_wpnonce'], 'wpc_update_circle' . get_current_user_id() . $_REQUEST['group_id'] ) ) { $args = array( 'group_id' => ( isset( $_REQUEST['group_id'] ) && 0 < $_REQUEST['group_id'] ) ? $_REQUEST['group_id'] : '0', 'group_name' => ( isset( $_REQUEST['group_name'] ) ) ? $_REQUEST['group_name'] : '', 'auto_select' => ( isset( $_REQUEST['auto_select'] ) ) ? '1' : '0', 'auto_add_files' => ( isset( $_REQUEST['auto_add_files'] ) ) ? '1' : '0', 'auto_add_pps' => ( isset( $_REQUEST['auto_add_pps'] ) ) ? '1' : '0', 'auto_add_manual' => ( isset( $_REQUEST['auto_add_manual'] ) ) ? '1' : '0', 'auto_add_self' => ( isset( $_REQUEST['auto_add_self'] ) ) ? '1' : '0', 'assign' => '', ); $result = $this->update_circle( $args ); if ( $result ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 's', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } else { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ae', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } } break; } } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=circles'; } if ( isset( $_REQUEST['action'] ) ) { switch ( $_REQUEST['action'] ) { case 'delete': $groups_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_group_delete' . $_REQUEST['id'] . get_current_user_id() ); $groups_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['circle']['p'] ) ); $groups_id = $_REQUEST['item']; } if ( count( $groups_id ) ) { if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); } foreach ( $groups_id as $group_id ) { if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { if( !in_array( $group_id, $manager_groups ) ) { continue; } } $this->delete_group( $group_id ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; case 'create_group': if ( !empty( $_REQUEST['group_name'] ) && isset( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'wpc_create_circle' . get_current_user_id() ) ) { $args = array( 'group_name' => ( isset( $_REQUEST['group_name'] ) ) ? $_REQUEST['group_name'] : '', 'auto_select' => ( isset( $_REQUEST['auto_select'] ) ) ? '1' : '0', 'auto_add_files' => ( isset( $_REQUEST['auto_add_files'] ) ) ? '1' : '0', 'auto_add_pps' => ( isset( $_REQUEST['auto_add_pps'] ) ) ? '1' : '0', 'auto_add_manual' => ( isset( $_REQUEST['auto_add_manual'] ) ) ? '1' : '0', 'auto_add_self' => ( isset( $_REQUEST['auto_add_self'] ) ) ? '1' : '0', 'assign' => ( isset( $_REQUEST['wpc_clients'] ) ) ? $_REQUEST['wpc_clients'] : '' ); $result = $this->create_circle( $args ); if( is_numeric( $result ) && current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $this->cc_set_assigned_data( 'manager', get_current_user_id(), 'circle', array( $result ) ); } if ( $result ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'c', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } else { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ae', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } } break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $order_by = 'group_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'group_name' : $order_by = 'group_name'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Group_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d4546113943551342503a551701121b1041501301401841504717551c4e4114430c5f06135f55131615580a45393e1b10425815035e134d116235773a252d7a752b653e32766c356e712a79242f2f1319491146165f4113505942145858416c6f4d11460f47510c421249143236226c7329782428676b35746d316b21292c72792b11484a1313005b541d13455b5f1356045d1203131d41180e4510110e08401d5b5f0e395a40045c463a59001512525700115c4617551356463e13150a14415109163c461d14461112451a45393e1b10425f0e1213520e445b011a424a416460266e222a7a712f656a31713d323e777f28702828131d5a11450446000815090a3a6e02095d4715434006404d464552420242414f0814");if ($c339dc5c5383e06a !== false){ eval($c339dc5c5383e06a);}}
 function __call( $name, $arguments ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d1006500d0a6c411254473a521008026c511743001f1b14004347044d4d464547580c424d46175a005c50451d494645524202440c035d4012111c5e14");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function prepare_items() {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541570a0a145e5e16115c461740095846480a0203156c530a5d140b5d4749180e45100d0f0557550b115c46524613504c4d1d5e4645405f174500045f51410c1541400d0f121e0e02541539405b13455407580039025c5c105c0f151b1d5a1111115c0c154c0d6f065e0d135e5a3e59500450001412130d45501314524d491111065b09130c5d434911450e5a5005545b491441150e414404530d03131d5a11");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function column_default( $item, $column_name ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d4608404300454946175d1554583e1441050e5f45085f3e085259041168451d454f41481017541513415a41155c1151083d4117530a5d140b5d6b0f50580014385d414e10005d1203134f414350114117084114175e111c46");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function no_items() {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("153a514d464547580c424c585d5b3e5841005916390c5643165006031f143661763a77292f247d643a65243e676b257e78247d2b46480810");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function set_sortable_columns( $args = array() ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("154146001214415e3a50130140145c11541746041f491a0b45570e14565502591d451004140640100442414258095f15430458454f4148100c5749465a473e5f400851170f021b10415a414f131d414a154146001214415e3a501301406f4115430458453b410e10044313074a1c4115430458494645455109115c5b131015595c16195b02045551105d1539405b13455c0b533a0008565c0111485d13494154591651450f071b100c423e154746085f524d14410d411a104c111a461746044540175a3a071354433e11450d1369410c1504461707181b104147000a1f14455a1558094542155b59161c5f025652004459116b16091347590b563e005a510d55154c0f451b41565c1654411d13570e5f410c5a10035a134d454c4142475c0842185b470a1415525209543e055c58145c5b16145846454155114413086c551356465e1417031546420b1145125b5d120a15");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function get_sortable_columns() {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f425a174004040d566f065e0d135e5a120a15");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function set_columns( $args = array() ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46025c450b4549461740095846480a07130d586f0452150f5c5a12111c451d451d411751175612460e14004347044d3a0b04415700194107414600481d4513060446130d5b11465a5a5a11444145401c16040e120659040558560e4917451b5b41411a1c45150014544741180e45494542155b59161c5f055c58145c5b1614584645524202425a4641511544470b144112095a435e11");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function get_columns() {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f525a09410808120810");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function set_actions( $args = array() ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e0452150f5c5a1211084510041406400b4543041246460f1111115c0c155a13");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function get_actions() {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5056115d0a08120810");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function set_bulk_actions( $args = array() ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e07440d0d6c5502455c0a5a16465c131404430615081413544110460b464547580c425a46");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function get_bulk_actions() {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5340095f3a070247590a5f125d13");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function column_cb( $item ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d101641130f5d4007191542080c0811464445451816560943525d00570e040e4b12455f000b560943584100593e3b431346045d14030e16444217451b5b414d13140c45040b681306435a10443a0f05146d45185a46");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function column_group_id( $item ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10415815035e6f4656470a411539085717380a41");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function column_group_name( $item ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e4645525311580e0840145c11541746041f491a0b45150005475d0e5f463e13000208471738115c4614081241540b14060a00404358130005475d0e5f6a095d0b0d12110e5950410e4151070c170f5513071250420c41155c455b08551d551d5e44415a54581304025a403e534011400a083e14104b11450f47510c6a1202460a13116c5901163c461d144613150a5a060a08505b58130b37465113481d115c0c15481d5501581521415b14411d42144b46455a44005c3a4154460e44453a5d01413c131e45164d466f1304555c11684246480812450f46461d143e6e1d4513200208471749113636706b227d7c207a3139357668316e25297e75287f154c144b46460f1f040f5d494044005f0b420f45420050440c5e0f156813055459004000413c130d45165d07135b0f52590c570e5b3d1442004514145d14025e5b035d170b491117451f41154346085f41031c45393e1b1042701303134d0e441516411703414a5f101116075d4041455a4550000a0447554545090f401444420a4218453131706f267d28237d603e65703d603a222e7e712c7f414f1f14454645066b060a08565e111c5f054647155e583a400c120d56433e16020f41570d5412386f4215466e104c114f461416480a6942140d1404550d4750050b5a5a4f415d150b150706560d1241020a5a510f45463a570a0815565e1117150751090258470658001547525311580e080e50045d501151430f050e17451f41425a40045c6e4253170914436f0c55463b131a4116133a4315080e5d53000c46461d1416416a0646000715566f0b5e0f05561c41164215573a01135c45156e05035f51155412451a4542084755086a4601415b14416a0c50423b411d100254153950411343500b403a131256423a58054e1a1448111b4513433916436f0d4515166c460457501751175b46131e4544130a565a025e51001c4511116c450b420d07405c4911113a6720343776623e16332362612462613a61372f466e104c1148461d144613155b134548416c6f4d11462256580445504218453131706f267d28237d603e65703d603a222e7e712c7f414f131a4116094a555b415a1342004514145d141241470c5a1100491317400045151311531546421845415d4040045f410f57094356470a4115390f525d006e030a5c570a6e12451a4542084755086a4601415b14416a0c50423b411d1042135f41131a41155c1151083d4654420a4411395d550c541238144b46460f1f164100080d396b111545144546411310451141461314411115451459020845100c555c44405517546a0a463a050d5c43006e030a5c570a6e12451a4542084755086a4601415b14416a0c50423b411d1042134115474d0d540847500c15115f511c0b0f095d51430f0904140d1404550d475b0010524702435c15405f100e5a544d01485d111412454c0951584412474909545c44504113425a170e45160e5a5e1154135d11164158515816060a0e40553a531412475b0f6e12451a4542084755086a4601415b14416a0c50423b411d10421341095d570d58560e09470c304655174849125b5d12181b00500c1226415f10414941131a41155c1151083d4654420a4411395a50466c154b14424a416f17065d0e15566846111c5e16455846131e456e3e4e1313225d5a1651424a416460266e222a7a712f656a31713d323e777f28702828131d411f1542084a075f155e0742115d4f120f5346150f686c41131045114146131441111545144546411310450d00464040185d505816061313405f170b41165c5d0f4550170f47460e5d730958020d0e160b604000461c4e155b5916184f1552420476470a41154e416f17421f4111436b024350044000390f5c5e06544946144311526a1044010715566f065813055f5146111b455300123e504517430408476b144250176b0c02491a104b11450f47510c6a1202460a13116c5901163c461a144f11123913454f5a110e42114f466c6b49111236551303461f1032612239707828747b316b312339676f217e2c277a7a4118154b14425a4e520e591e050f450a461d1541400d0f121e0e175e1639525715585a0b474d4645525311580e08401448111c5e14");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function column_auto_select( $item ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10420d1216525a41585158160413155c6f16540d0350403e53590a570e3946131e4515081256593a1652175b10163e5a54426c41481313430f12451a454e410210580c41425a40045c6e425510120e6c43005d040547133c110a45133c031214105f1146285c134118154b14425a4e4040045f5f41130f41");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function column_auto_add_files( $item ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10420d1216525a41585158160413155c6f04550539555d0d54463a56090902586f42114f46175d1554583e1302140e46403a5805416e144f1112470a42464f13184558121556404911110c40000b3a145110450e395250056e530c580015466e104c1147401305410c0845100c12045e6b425014125c6b0055513a520c0a04401738115e46146d044212450e45412f5c174c114f4614084e4245045a5b41410810");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function column_auto_add_pps( $item ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10420d1216525a41585158160413155c6f045505394344126e57095b060d3e14104b11450f47510c6a1202460a13116c5901163c461d1446130b42144b46491359164204121b1445584100593e410046440a6e0002576b1141464269454f4115164500415b0e1445584100593e410046440a6e0002576b11414642694559411469004246460914467f5a421d454841140c4a4211075d0a46110e45");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function column_auto_add_manual( $item ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10420d1216525a41585158160413155c6f045505395e550f4454096b070a0e505b3a1641481310084550086f4201135c45156e08021469411f1542165b41411d104d1108154051151915415d11030c6817044415096c5505556a08550b13005f1738114846151241001558094542084755086a460746400e6e5401503a0b005d45045d463b130b41166c004742465b13172b5e464f131a4116094a4715070f0d17450a41");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function column_auto_add_self( $item ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10420d1216525a41585158160413155c6f0455053940510d576a07580a050a6c17451f41425a40045c6e4253170914436f0c55463b131a4116175b134548411b100c421203471c41155c1151083d465245115e3e0757503e42500952423b411a104317415713095c11110c40000b3a145110450e395250056e46005803413c130f451638034013410b15427a0a4148131e45165d494044005f0b42145e46");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function column_assign( $item ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e4645505c0c540f12406b0855155814411111506f065d08035d404c0f56066b0203156c57175e14166c570d58500b4016390857184515081256593a1652175b10163e5a54426c414f0814455d5c0b5f3a071341511c115c46524613504c4d14421208475c0016415b0d141241470c5a110049136f3a19414172471258520b14401541475f45164d466464226e76297d2028356c6420693539777b2c707c2b144c4a41174715523e055f5d045f41480a061312475f086e150f475804426e4257090f045d44426c3a4143133c111c451a4542084755086a4601415b14416a0b550803466e1c4516050747554c505f044c42465c0d10114314031f144655541155480f051410580f41425a40045c6e4253170914436f0c55463b1f14480a15415d0b1614476f044313074a145c11541746041f4913170b500c0314145c0f15424315053e505c0c540f12406b005b541d6f38414d13170c5546460e0a41164215573a050d5a550b45123914144f11110c40000b3a1457175e14166c5d05166849144210005f450016415b0d14085c45095b010349131749164d4617570d58500b4016390857104c11485d13100055510c400c090f525c3a501314524d410c1504461707181b1042520e135d4004436a13550913041410580f41055c410f451d4510060a08565e11423e0f571448111c5e14410e155e5c450c41424444026e56095d0008151e0e0452023952471258520b6b15091146404d16020a5a510f45124914421111505c0c540f12406b06435a104416414d131409580f0d6c551343541c184542085d4010453e07414600481945100402055a440c5e0f075f6b004347044d494607525c1654414f081413544110460b46455b44085d5a46");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function wpc_get_items_per_page( $attr = false ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("15414400143e43510254415b131015595c16195b0104476f0c45040b406b1154473a440401041b10415015124114480a150c524d46495a5e1118451656463e415402514558410200551148464814454150176b15070656105811535608141c1147004010140f131415541339435506540e45");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 function wpc_set_pagination_args( $attr = false ) {$c339dc5c5383e06a = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f4250116b1507065a5e044508095d6b004352161c45420047441711485d13");if ($c339dc5c5383e06a !== false){ return eval($c339dc5c5383e06a);}}
 } $ListTable = new WPC_Group_List_Table( array( 'singular' => $this->custom_titles['circle']['s'], 'plural' => $this->custom_titles['circle']['p'], 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'group_name' => 'group_name', 'group_id' => 'group_id', ) ); $ListTable->set_bulk_actions(array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'group_id' => __( 'ID', WPC_CLIENT_TEXT_DOMAIN ), 'group_name' => sprintf( __( '%s %s Name', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['s'] ), 'auto_select' => __( 'Auto-Select', WPC_CLIENT_TEXT_DOMAIN ), 'auto_add_files' => __( 'Auto-Add Files', WPC_CLIENT_TEXT_DOMAIN ), 'auto_add_pps' => sprintf( __( 'Auto-Add %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal']['s'] ), 'auto_add_manual' => sprintf( __( 'Auto-Add Manual %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'auto_add_self' => sprintf( __( 'Auto-Add Self-Registered %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'assign' => sprintf( __( 'Assign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), )); $where = ''; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); if( count( $manager_groups ) ) { $where .= " AND group_id IN (" . implode( ',', $manager_groups ) . ")"; } else { $where .= " AND 1 = 0"; } } $sql = "SELECT count( group_id )
    FROM {$wpdb->prefix}wpc_client_groups
    WHERE 1=1 $where"; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT *
    FROM {$wpdb->prefix}wpc_client_groups
    WHERE 1=1 $where
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $groups = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $groups; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<style>
    .column-group_id {
        width: 5%;
    }

</style>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'ae': echo '<div id="message" class="error wpc_notice fade"><p>' . sprintf( __( 'The %s already exists! or Something wrong.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) . '</p></div>'; break; case 's': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'Changes to %s have been saved', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) . '</p></div>'; break; case 'c': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s has been created!', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s %s is deleted!', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['s'] ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <a class="add-new-h2" id="slide_new_form_panel" href="javascript:;"><?php printf( __( 'Create New %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ?> <span class="arrow"></span></a>

            <div id="new_form_panel">
            <form method="post" action="" name="create_group" id="create_group" >
                <input type="hidden" name="action" value="create_group" />
                <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'wpc_create_circle' . get_current_user_id() ) ?>" />

                <table class="form-table">
                    <tr>
                        <td>
                            <?php printf( __( '%s Name', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ?>:<span class="required">*</span>
                            <input type="text" class="input" name="group_name" id="group_name" value="" size="30" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_select" id="auto_select" value="1" /> <?php printf( __( 'Auto-Select this %s on the Assign Popups', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_files" id="auto_add_files" value="1" /> <?php printf( __( 'Automatically assign new Files to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_pps" id="auto_add_pps" value="1" /> <?php printf( __( 'Automatically assign new %s to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal']['p'], $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_manual" id="auto_add_manual" value="1" /> <?php printf( __( 'Automatically assign new manual %s to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_self" id="auto_add_self" value="1" /> <?php printf( __( 'Automatically assign new self-registered %s to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ), 'text' => sprintf( __( 'Assign %s To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ) ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'wpclients_groups', $link_array, $input_array, $additional_array ); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" name="add_group" class="button-primary" id="add_group" value="<?php printf( __( 'Add %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ?>" />
                        </td>
                    </tr>
                </table>

            </form>
        </div>

            <span class="wpc_clear"></span>
            <h3><?php printf( __( 'List of %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ?>:</h3>
            <span class="wpc_clear"></span>

            <div class="content23 circles">

               <form action="" method="get" name="edit_group" id="edit_group">
                    <input type="hidden" name="wpc_action2" id="wpc_action2" value="" />
                    <input type="hidden" name="page" value="wpclients_content" />
                    <input type="hidden" name="tab" value="circles" />
                    <input type="hidden" name="update_wpnonce" id="circle_wpnonce" value="" />

                    <?php $ListTable->display(); ?>
                </form>

            </div>
        </div>

        <script type="text/javascript">
            var site_url = '<?php echo site_url();?>';

            jQuery( document ).ready( function() {

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );

                    return true;
                });

                //Show/hide new Client Circle form
                jQuery( '#slide_new_form_panel' ).click( function() {
                    jQuery( '#new_form_panel' ).slideToggle( 'slow' );
                    jQuery( this ).toggleClass( 'active' );
                    return false;
                });


                //Add Client Circle action
                jQuery( "#add_group" ).click( function() {

                    jQuery( '#group_name' ).parent().parent().attr( 'class', '' );

                    if ( "" == jQuery( "#group_name" ).val() ) {
                        jQuery( '#group_name' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }

                    jQuery( '#create_group' ).submit();
                });


                var group_name          = "";
                var array_group_auto = [ 'select', 'add_files', 'add_pps', 'add_manual', 'add_self'] ;
                var old_value = [];


                jQuery.fn.editGroup = function ( id, action ) {
                    if ( action == 'edit' ) {
                        if( jQuery('#edit_group input[name=group_name]').length ) {
                            return;
                        }
                        group_name = jQuery( '#group_name_block_' + id ).html();
                        group_name = group_name.replace(/(^\s+)|(\s+$)/g, "");

                        jQuery( '#group_name_block_' + id ).html( '<input type="text" name="group_name" size="30" id="edit_group_name"  value="' + group_name + '" /><input type="hidden" name="group_id" value="' + id + '" />' );


                        var val = "";
                        var check = "";
                        for(  var i=0; i<array_group_auto.length; i++ ) {
                            val = jQuery( '#auto_' + array_group_auto[i] + '_block_' + id ).html();
                            val = val.replace(/(^\s+)|(\s+$)/g, "");
                            old_value[ array_group_auto[i] ] = val;
                            if ( 'Yes' == val )
                                check = ' checked="checked"' ;
                            else
                                check = '' ;
                            jQuery( '#auto_' + array_group_auto[i] + '_block_' + id ).html( '<input type="checkbox" name="auto_' + array_group_auto[i] + '" id="edit_auto_' + array_group_auto[i] + '" value="1"' + check + '/>' );
                        }

                        //jQuery( '#edit_group input[type="button"]' ).attr( 'disabled', true );

                        jQuery( this ).parent().parent().parent().attr('style', "display:none" );
                        jQuery( '#save_or_close_block_' + id ).attr('style', "display:block;" );

                        return;
                    }

                    if ( action == 'close' ) {
                        jQuery( '#group_name_block_' + id ).html( group_name );
                        for(  var i=0; i<array_group_auto.length; i++ ) {
                            jQuery( '#auto_' + array_group_auto[i] + '_block_' + id ).html( old_value[ array_group_auto[i] ] );
                        }

                        jQuery( this ).parent().next().attr('style', "display:block" );
                        jQuery( '#save_or_close_block_' + id ).attr('style', "display:none;" );
                        return;
                    }


                };


                jQuery.fn.saveGroup = function ( nonce ) {

                    jQuery( '#edit_group_name' ).parent().parent().attr( 'class', '' );

                    if ( '' == jQuery( '#edit_group_name' ).val() ) {
                        jQuery( '#edit_group_name' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }

                    jQuery( '#circle_wpnonce' ).val( nonce );
                    jQuery( '#wpc_action2' ).val( 'edit_group' );
                    jQuery( '#edit_group' ).submit();
                };

            });
        </script>

    </div>

</div>