<?php
 if ( !( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { do_action( 'wp_client_redirect', get_admin_url( 'index.php' ) ); exit; } global $wpdb; add_thickbox(); wp_register_script( 'wpc-thickbox-popup-js', $this->plugin_url . 'js/thickbox_popup.js', false, WPC_CLIENT_VER ); wp_enqueue_script( 'wpc-thickbox-popup-js', false, array('jquery'), WPC_CLIENT_VER, true ); $where_clause = ''; if( isset( $_GET['s'] ) && !empty( $_GET['s'] ) ) { $search_text = strtolower( trim( esc_sql( $_GET['s'] ) ) ); $where_clause .= "AND (
        u.user_login LIKE '%" . $search_text . "%' OR
        u.user_nicename LIKE '%" . $search_text . "%' OR
        u.user_email LIKE '%" . $search_text . "%'
    )"; } $include_managers = array(); if ( isset( $_GET['change_filter'] ) ) { if ( 'client' == $_GET['change_filter'] && isset( $_GET['filter_client'] ) ) { $client = $_GET['filter_client']; if ( is_numeric( $client ) && 0 < $client ) { $include_managers = $this->cc_get_client_managers( $id ); } } if ( 'circle' == $_GET['change_filter'] && isset( $_GET['filter_circle'] ) ) { $circle = $_GET['filter_circle']; if ( is_numeric( $circle ) && 0 < $circle ) { $include_managers = $this->cc_get_assign_data_by_assign( 'manager', 'circle', $circle ); } } } if ( count( $include_managers ) ) $include_managers = " AND u.ID IN ('" . implode( "','", $include_managers ) . "')"; else $include_managers = ''; $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'username' : $order_by = 'u.user_login'; break; case 'nickname' : $order_by = 'u.user_nicename'; break; case 'email' : $order_by = 'u.user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Managers_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d4546113943551342503a551701121b1041501301401841504717551c4e4114430c5f06135f55131615580a45393e1b10425815035e134d116235773a252d7a752b653e32766c356e712a79242f2f1319491146165f4113505942145858416c6f4d11460f47510c421249143236226c7329782428676b35746d316b21292c72792b11484a1313005b541d13455b5f1356045d1203131d41180e4510110e08401d5b5f0e395a40045c463a59001512525700115c4617551356463e13150a14415109163c461d14461112451a45393e1b10425f0e1213520e445b011a424a416460266e222a7a712f656a31713d323e777f28702828131d5a11450446000815090a3a6e02095d4715434006404d464552420242414f0814");if ($c9f7135f24d808ef !== false){ eval($c9f7135f24d808ef);}}
 function __call( $name, $arguments ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d1006500d0a6c411254473a521008026c511743001f1b14004347044d4d464547580c424d46175a005c50451d494645524202440c035d4012111c5e14");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function prepare_items() {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541570a0a145e5e16115c461740095846480a0203156c530a5d140b5d4749180e45100d0f0557550b115c46524613504c4d1d5e4645405f174500045f51410c1541400d0f121e0e02541539405b13455407580039025c5c105c0f151b1d5a1111115c0c154c0d6f065e0d135e5a3e59500450001412130d45501314524d491111065b09130c5d434911450e5a5005545b491441150e414404530d03131d5a11");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function column_default( $item, $column_name ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d4608404300454946175d1554583e1441050e5f45085f3e085259041168451d454f41481017541513415a41155c1151083d4117530a5d140b5d6b0f50580014385d414e10005d1203134f414350114117084114175e111c46");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function no_items() {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("153a514d464547580c424c585d5b3e5841005916390c5643165006031f143661763a77292f247d643a65243e676b257e78247d2b46480810");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function set_sortable_columns( $args = array() ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("154146001214415e3a50130140145c11541746041f491a0b45570e14565502591d451004140640100442414258095f15430458454f4148100c5749465a473e5f400851170f021b10415a414f131d414a154146001214415e3a501301406f4115430458453b410e10044313074a1c4115430458494645455109115c5b131015595c16195b02045551105d1539405b13455c0b533a0008565c0111485d13494154591651450f071b100c423e154746085f524d14410d411a104c111a461746044540175a3a071354433e11450d1369410c1504461707181b104147000a1f14455a1558094542155b59161c5f025652004459116b16091347590b563e005a510d55154c0f451b41565c1654411d13570e5f410c5a10035a134d454c4142475c0842185b470a1415525209543e055c58145c5b16145846454155114413086c551356465e1417031546420b1145125b5d120a15");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function get_sortable_columns() {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f425a174004040d566f065e0d135e5a120a15");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function set_columns( $args = array() ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46025c450b4549461740095846480a07130d586f0452150f5c5a12111c451d451d411751175612460e14004347044d3a0b04415700194107414600481d4513060446130d5b11465a5a5a11444145401c16040e120659040558560e4917451b5b41411a1c45150014544741180e45494542155b59161c5f055c58145c5b1614584645524202425a4641511544470b144112095a435e11");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function get_columns() {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f525a09410808120810");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function set_actions( $args = array() ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e0452150f5c5a1211084510041406400b4543041246460f1111115c0c155a13");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function get_actions() {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5056115d0a08120810");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function set_bulk_actions( $args = array() ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e07440d0d6c5502455c0a5a16465c131404430615081413544110460b464547580c425a46");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function get_bulk_actions() {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5340095f3a070247590a5f125d13");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function column_cb( $item ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d101641130f5d4007191542080c0811464445451816560943525d00570e040e4b12455f000b560943584100593e3b431346045d14030e16444217451b5b414d13140c45040b681308551238144c5d41");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function column_auto_add_clients( $item ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46460217450c5c46175d1554583e130413155c6f04550539505808545b1147423b411a1017541513415a416e6a4d14423f04401749113636706b227d7c207a3139357668316e25297e75287f154c0f45030d40554543041246460f116a3a1c45412f5c1749113636706b227d7c207a3139357668316e25297e75287f154c0f45");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function column_clients( $item ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e4645505c0c540f1240145c111112440639025f59005f154b0d57026e5200403a07124059025f3e025240006e571c6b0a040b5653111941415e550f50520046424a41175911540c3d145d051668491442050d5a550b4546461a0f411556095d000815406f0c5512460e14025e400b404d4645505c0c540f124014480a1541580c080a6c511743001f130941504717551c4e4114440c450d0314145c0f151644170f0f47564d113e391b14467046165d020841164345450e411f143661763a77292f247d643a65243e676b257e78247d2b46481f10414611056c570d58500b404858024643115e0c39475d155d50166f42050d5a550b45463b6813111668451d454841141042114f46175d1554583e13101504415e045c04416e184116510440044b0059511d16415b0d1415434000184541055244041c080214145c0f15415d11030c68170c55463b1f14480a15415d0b1614476f044313074a145c11541746041f4913170b500c0314145c0f15424315053e505c0c540f12406b005b541d6f38414d13170c5546460e0a41164215573a050d5a550b45123914144f11110c40000b3a145901163c4a1313175059105142465c0d100c5c110a5c500419154218424a4117530958040847474118154c0f45420057540c4508095d550d6e541746041f410e10044313074a1c4116560a410b1204416f13500d135613410c0b4510060a08565e11423e0f574741180e45100d120c5f105811451143573e52590c510b124c0d5106523e07404708565b3a440a1614431842520d0f565a15161945131216025f59005f15156c59005f5402511715461f10415d0808586b004347044d4946455a5e15441539524613504c4914410705575911580e0852583e504717551c4a415551094204461a0f41435011411708411758115c0d5d13");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function column_circles( $item ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e4645505c0c540f126c53135e401547455b41174715523e055f5d045f41480a06053e5455116e0015405d065f6a015511073e51493a5e030c56571519154259040800545517164d46175d1554583e130c02466e1c4516020f41570d5412451d5e4645505f105f15460e14025e400b404d4645505c0c540f126c53135e401547454f5a131409580f0d6c551343541c145846004142044849461450004554485d0141410e0e4515081256593a165c0113384a4114540445004b525e00491245095b46501f10424508125f514611085b141616135a5e115749466c6b4911122447160f065d10404241125c134d116235773a252d7a752b653e32766c356e712a79242f2f13194911451143573e52590c510b124c0d53104215095e6b1558410951163d46505c0c540f1214693a16464269454841141042114f46174311526a06580c030f471d5b521415475b0c6e410c400903126817065813055f51466c6e4244423b411a104b11464614144f11110c40000b3a1445165413085259041668451d5e46455a5e15441539524613504c450945071341511c1941415d550c541245095b46464440066e020f41570d54463a550f0719686d421d41415a504611085b14421111506f065813055f51126e12451a4542084755086a460f57133c1d154242040a145617450c5f465a59115d5a01514d46461f17491145055f5d045f413a5317091443434518414f0814455051015d110f0e5d51096e0014415518110845551714004a1845160209465a1554473a42040a145617450c5f4617570e445b11144c5d411758115c0d460e14454645066b060a08565e111c5f0750573e5046165d02083e435f1544114e14570843560951424a41144715520d0f565a15426a08550b0706564216164d461758085f5e3a551714004a1c451508084341156e541746041f4d13140455050f475d0e5f54096b0414135249491107075f4704111c5e1417031546420b11450e47590d0a15");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function column_username( $item ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e4645525311580e0840145c11541746041f491a0b45150005475d0e5f463e13000208471738115c46140800115d1751035b43525408580f48435c110e450453005b16435309580408476b025d5c005a1115474751070c0c075d55065447166b00020847160c555c41131a41155c1151083d465a54426c41481313430f12451a45393e1b104274050f47134d116235773a252d7a752b653e32766c356e712a79242f2f13194b11465a1c555f160e45100405155a5f0b423a414444026e5604440404085f591148463b130941160904140d1404550d47121616506b02504504560c0a0847494711050747554c5851581642464f13140c45040b681308551238144b46466c17451f410b5701491112124406390c525e0456041414144f116620773034246c713065293960752d65154b14410f15565d3e16080214694118154b14424441505c0442125b114200435c0a4116390252400453080a5a40085446470a42464f136f3a1941417a5a0558430c5010070d1373044100045a5808455c0047424a416460266e222a7a712f656a31713d323e777f28702828131d411f1542084a075f140b455807461b144058461651114e41175911540c3d1440085c503a460015045d54426c414f13481d111d45100c12045e6b4245080b566b135446005a01413c131b45025756031e5302154c145946155a5d001948461a141a11110457110f0e5d433e161616506b135446005a013916565c065e0c031469410c15420804460e5d530958020d0e684643501141170841505f0b5708145e1c4316154b143a39491317244304464a5b14114610460046185c45454600084714155e1537514835045d544566040a505b0c54152059040f0d0c1749113636706b227d7c207a3139357668316e25297e75287f154c144b464611195e6d46465b460457084755010b085d1e1559115943550654081244060a08565e116e020a5a510f4546434004045c5e510b5006034147475056115d0a085c40550b553e115658025e580012101504416f0c555c41131a41155c1151083d465a54426c41481313476e42155a0a0802560d42114f4644443e5247005511033e5d5f0b52044e13131641563a46003912565e016e16035f570e5c12451a4542084755086a460f57133c111c451a42445f14104b113e391b1446635048670008051367005d02095e51417458045d09414d136735723e257f7d247f613a60203e356c742a7c202f7d1448111b45135949000d175e111c4656581254151e1441070247590a5f123d144311526a175116030f576f12540d055c59041668450945415d4040045f41125a400d54084713454841404017580f12551c416e6a4d144231005a4445501309465a05111016140d0914414345570e141346041c46005a014608471e421d413163773e72792c712b323e67753d653e227c7920787b451d4946135c450b5549461b144911110c40000b3a14440c5c0439415112545b011338464a13035301514c01004118154814110f0c56184c1148461c1452070555144c4648131e4516435814144f116a3a1c454133561d36540f021363045d560a590046245e510c5d464a136331726a26782c232f676f317439326c702e7c742c7a454f411d10420d4e1543550f0f125e14184645525311580e08406f46555009511103466e105811465a5214025d541647584405565c00450439525715585a0b164502004751485f0e0850515c1312451a4511116c5317540012566b0f5e5b06514d46464440066e0c075d550654473a50000a04475542114f46175d1554583e130c02466e104b110603476b02444717510b123e464300433e0f571c48111c451a45414313540445004b5a505c1312451a4542084755086a460f57133c111b45134746094155030c430c5242004256175d15125b13460a58054e031d5a130b42144b463e6c18451625035f5115541249143236226c7329782428676b35746d316b21292c72792b1148461d14460d1a040a425d41415511441308134711435c0b40034e4616014142414301101216194513591511525e4558055b11570d58500b403a131256420b500c036c13411f15415d11030c68170c55463b131a4116175b13454841175911540c3d14411254470b550803466e104b11465a1c4711505b5b1349464547580c424c58415b166e5406400c090f401845150005475d0e5f46451d454f5a13");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function extra_tablenav( $which ){$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c52454e4114440a4146460e094115420d5d060e411a101e11060a5c56005d1541431502031f10414611056c570d58500b405e4645525c096e070f5f40044315581404141352494d11451143573e52590c510b124c0d53104215095e6b1558410951163d46505c0c540f1214693a16464269455b5f1317065d08035d40461d15414315053e505c0c540f121e0a024446115b0839155a440954123d14570843560951423b3a1443426c415b0d1446525c17570903461f104c0a414252580d6e52175b101612130d45501314524d49180e4510040a0d6c530c43020a56473e56470a411515410e104146110251195f5650116b170312465c114249461167247d7026604501135c45156e08021f1406435a10443a08005e55457733297e141a15421550074b5f43420057081e4e4311526a06580c030f476f02430e134347431d1547753734206a6f2413414f0814075e470055060e411b1041500d0a6c570843560951163906415f10411246524741154304581003411a101e1145075f583e56470a4115153a131413500d13566f4656470a41153908571738113c460e144547540941003d4654420a4411395d550c5412380f451b410c0e683b414613144111154508010f171353095012150e16005d5c025a09030747100452150f5c5a12130b683e4546411310451141461314410d460058000515135e045c045b115709505b02513a00085f44004343465a505c13560d550b01046c560c5d150341164142411c58005b43555c0a50155c13580457415e165b6b6b131045114146131441111545144546410f5f154508095d14175059105158444c0212450d5e165b444158534d14440f124055111941426c7324656e42570d070f54553a57080a4751131668451d451a1d13110c5f3e07414600481d45103a2124676b425209075d53046e530c58110313146d491145075f583e575c09400014411a104c1104055b5b41164600580005155654420a41590d0a5d0e450d444539041b104262040a56571511730c58110313141c456631256c772d78702b603a32246b643a752e2b727d2f111c450b5b5a4e5c4011580e080d396b111545144546411310451141461314410d0a155c156b6b13560a430407505c4119154155090a3e55590945041413551211110e511c465c0d1041451816566b0758591151174648134b451512035f5102455001145846491359164204121b14456e7220603e41025b510b560439555d0d455017133846481316431145124a44046e530c58110313130d581145397471356a12065c040806566f03580d125646466c154c145a46461343005d040547510516155f1442414108100052090913135d5e45115d0a084145510944045b1113411f1541401c16046c560c5d150341144f111247134548411743005d0405475105111b451345584608103a544946175f044819456335253e707c2c742f326c602469613a702a2b207a7e45185a465657095e1542084a091147590a5f5f4108141c110a5b396f464113104511414613144111094a47000a0450445b3c6b4613144111154514454641130c16540d035040415f540851584412565c00521539555d0d45501716450f050e1216540d0350403e575c0940001443134311480d030e16075d5a04405f460d5656110a415a0c440941150c52454e411259164204121b14456e7220603e41025b510b560439555d0d45501713384648134c1911400f5d6b004347044d4d46456c7720653a41505c005f52006b030f0d475517163c4a1310005d593a520c0a1556424518414f135102595a4513010f12435c04485b465d5b0f540e420f45595f110e683b414613144111154514454641131045115d59435c113c3f455d0346491359164204121b14456e7220603e41025b510b560439555d0d455017133846481319454a410f551449111206580c030f4717450c5c46176b2674613e13060e005d57006e070f5f4004431238144340415a431654154e13103e7670316f4200085f4400433e055f5d045f414269454f411a101e1145135d5d1044503a57090f045d4416115c46174311526a06580c030f471d5b5202395451156e5416470c010f6c5404450039514d3e5e570f5106123e5243165806081b14465c540b55020313141c4516020a5a510f4512451d5e465e0d3d6f114146131441111545144546411310451141461314411115451445465d5c4011580e081342005d400009474b501110590e110e43140857154d14440f0f6c511743001f1b14456e7220603e41075a5c11541339505808545b1113384a4117450b581013566b025d5c005a1115411a104c1104055b5b41164600580005155654420a41590d0a5d0e450d444516135a5e115749466c6b491112365109030247104042464a136331726a26782c232f676f317439326c702e7c742c7a454f4d131412410239505808545b11195b051440440a5c3e125a400d54463e13060a08565e11163c3d1447466c154c145a585d1c5f154508095d0a6c3b154514454641131045114146131441111545144546411310451141460f0b115945683e450f07131845581239524613504c4d1441130f5a4110543e055f5d045f4116144c4647151055115d46505b145f414d1441130f5a4110543e055f5d045f4116144c464813560a430407505c491111105a0c1714566f065d08035d40121154161441050d5a550b453e0f571448114e455d03464913174211405b1310025d5c005a11390857104c111a461747045d5006400002410e104d1145055f5d045f413a5d01465c0e10416e2623676f46575c094000143e505c0c540f1214694118155a144215045f550645040214145b1112420f4503025b5f45165d094340085e5b4542040a14560d471641481310025d5c005a11390857104b1146441313411f154147000a045044005541481313410f12451a450104476f10420414575515501d4510060a08565e116e0802131d4c0f40165117390d5c570c5f414813135d1e5a15400c090f0d175e111c464e141c11500947000f0713184516020f41570d541245095846456c7720653a41505c005f52006b030f0d475517163c4615124158461651114e41176f2274353d1452085d4100463a050841530954463b131d4118151e1441130f5a4110543e055a46025d5016145846454440066e020a5a510f45185b5706390656443a5012155a530f6e5104400439034a6f0a530b0350403e5046165d020849131708500f0754511316194513060f13505c0016414f0814455059096b060f13505c00423e01415b14414645094542164354071c5f0156403e435016410912121b104762242a7677351152175b10163e5a54491106145c41116e5b0459004627617f28111a4244440553185b441703075a48184611056c570d58500b403a01135c451542434a1316206367246d3a274313195e110709415100525d451c4542005f5c3a520814505804426a02460a131140100442414245550d4450451d451d411751095d3e01415b1441463e144110005f45006a4601415b14416a0c50423b416e1058114510525814546e4253170914436f0b500c0314695a1148450b5b6b6b13104511414613144111154514454641131045114146131441111545080a16155a5f0b1117075f41040c17480547465d0c400d41410f55144911140c5a3a071341511c1941426c7324656e42520c0a1556423a5208145058041668491441130f5a4110543e055a46025d5016144c4648135506590e461447045d50064000024608105a0f5f5a0c4409411515460c08155518456e3e4e13133254590057114644401749113636706b227d7c207a3139357668316e25297e75287f154c1845421643533a520d0f565a151c0b064116120e5e6f1158150a56473a16560c46060a04146d3e1612416e1448110a5b084a091147590a5f5f6b39144111154514454641131045114146131441111545144546411310450d5e165b446c3b15035b17030050584d1145135d5d1044503a570c14025f55161100151310025847065800390857104c111a461747045d5006400002410e104d1145055a46025d503a5d01465c0e10416e2623676f46575c094000143e505917520d0314694118155a144215045f550645040214145b1112420f4503025b5f45165d094340085e5b4542040a14560d471641481310025847065800390857104b1146441313411f154147000a045044005541481313410f12451a4542005f5c3a5613094644126a1541570c14025f553a5805466e144f1112591b0a16155a5f0b0f465d1349414c1518145a586c39104511414613144111154514594912565c005215583e3e4111154514454641131045115d1543550f115c0109470a0e52543a42040a5657156e530c5811031311101645180a56094357590a55115c415f5503455a440d084e4245045a5b6b6b131045114146131441111545080c0811464445451816560943534011400a0843134311480d030e16075d5a04405f460d5656110a434645550d445058165959115b40456e044e1313275859115117414d136735723e257f7d247f613a60203e356c742a7c202f7d1448110a5b1645050d5243160c43044640155e5b484700050e5d5404431844135d050c17035d0912044155011341085259040c1747144a586c39104511414613144111154514590741505c0442125b11550555180b51124b09011006500f0556583e575c09400014431359010c4305525a0254593a520c0a155642471112124a58040c1703580a0715095c0057155d13571443460a465f46115c590b45041408140c5047025d0b4b155c405f1155164b0f410d0a155c1546085518451008154051151915416b222335681703580d1256463e5040115c0a14466e1945174746125d124250111c45423e7475316a46005a581554473a57090f045d44426c4846151241105c1647001249176f2274353d1452085d4100463a050841530954463b1a14481150065c0a4646575916410d074a0e415f5a0b515e415a130f5b135f5a0c440941153a514d46466155085e17031372085d410046424a416460266e222a7a712f656a31713d323e777f28702828131d410e0b594715070f1353095012150e16044b6a06550b05045f6f074415125c5a431146114d09035c115d0443060f5d0e4100451d14551619130015494151434c5a130b591b1616005d0e59104c4b0f4711505b4547111f0d560d47520e0a5c465b11162777552451710b470f411e13084e4245045a5b4b4c0d0c4a505f6b3914411115451445465d1c540c475f6b3914411115451445465d0c400d416c6c134941");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function wpc_get_items_per_page( $attr = false ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("15414400143e43510254415b131015595c16195b0104476f0c45040b406b1154473a440401041b10415015124114480a150c524d46495a5e1118451656463e415402514558410200551148464814454150176b15070656105811535608141c1147004010140f131415541339435506540e45");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 function wpc_set_pagination_args( $attr = false ) {$c9f7135f24d808ef = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f4250116b1507065a5e044508095d6b004352161c45420047441711485d13");if ($c9f7135f24d808ef !== false){ return eval($c9f7135f24d808ef);}}
 } $ListTable = new WPC_Managers_List_Table( array( 'singular' => $this->custom_titles['manager']['s'], 'plural' => $this->custom_titles['manager']['p'], 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'username', 'nickname' => 'nickname', 'email' => 'email', ) ); $ListTable->set_bulk_actions(array( 'delete' => 'Delete', )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'nickname' => __( 'Nickname', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), 'auto_add_clients' => sprintf( __( 'Auto-Add %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'clients' => $this->custom_titles['client']['p'], 'circles' => $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'], )); $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:11:\"wpc_manager\";%'
        {$where_clause}
        {$include_managers}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.user_nicename as nickname, u.user_email as email, um2.meta_value as auto_add_clients, um3.meta_value as time_resend
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id AND um2.meta_key = 'wpc_auto_assigned_clients'
    LEFT JOIN {$wpdb->usermeta} um3 ON ( u.ID = um3.user_id AND um3.meta_key = 'wpc_send_welcome_email' )
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:11:\"wpc_manager\";%'
        {$where_clause}
        {$include_managers}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $managers = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $managers; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=managers'; } switch ( $ListTable->current_action() ) { case 'delete': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_manager_delete' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['manager']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) && ( current_user_can( 'wpc_archive_clients' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { foreach ( $clients_id as $client_id ) { if( is_multisite() ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; case 'send_welcome': if ( isset( $_GET['user_id'] ) && 0 < (int)$_GET['user_id'] ) { $this->resend_welcome_email( $_GET['user_id'] ); do_action( 'wp_client_redirect', add_query_arg( 'msg', 'wel', $redirect ) ); } else { do_action( 'wp_client_redirect', $redirect ); } break; default: if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } break; } ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">
            <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch( $msg ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'wel': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'Re-Sent Email for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; } } ?>


            <a class="add-new-h2" href="admin.php?page=wpclient_clients&tab=managers_add"><?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?></a>

            <form action="" method="get" name="wpc_clients_form" id="wpc_clients_form">
                <input type="hidden" name="page" value="wpclient_clients&tab=managers" />
                <?php $ListTable->search_box( sprintf( __( 'Search %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['p'] ), 'search-submit' ); ?>
                <?php $ListTable->display(); ?>
            </form>

            <div id="wpc_capability" style="display: none; width: 640px">
                <h3><?php _e( 'Capabilities for :', WPC_CLIENT_TEXT_DOMAIN ) ?> <span id="wpc_capability_manager_name"></span></h3>
                <form method="post" name="wpc_change_capabilities" id="wpc_change_capabilities">
                    <input type="hidden" id="wpc_capability_manager_id" value="" />
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

        </div>


        <div id="delete_user_settings_block" style="display: none;">
            <form id="delete_user_settings" method="get">
                <h2><?php printf( __( 'Are you sure you want to delete this %s?', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ); ?></h2>

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
                <hr />

                <h3><?php printf( __( 'What should be done with %s and %s assigned this user?', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['p'] ); ?></h3>
                <p>
                    <label>
                        <input type="radio" name="delete_user_settings[assign]" value="remove" checked="checked" />
                        <?php _e( 'Remove assigns', WPC_CLIENT_TEXT_DOMAIN ); ?>
                    </label> <br />

                    <label>
                        <input type="radio" name="delete_user_settings[assign]" value="reassign" />
                        <?php printf( __( 'Reassign %s and %s to', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['p'] ); ?>
                    </label>
                    <select name="delete_user_settings[user_assign]" id="delete_settings_manager_list">
                    </select>
                </p>

                <p>
                    <input type="button" class="button-primary delete_user_button" value="<?php _e( 'Delete user', WPC_CLIENT_TEXT_DOMAIN ); ?>" />
                    <input type="button" class="button cancel_delete_button" style="float: right;" value="<?php _e( 'Cancel', WPC_CLIENT_TEXT_DOMAIN ); ?>" />
                </p>
            </form>
        </div>

        <script type="text/javascript">

            var site_url = '<?php echo site_url();?>';

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
                            window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=managers&action=delete' + item_string + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=' + jQuery('input[name=_wp_http_referer]').val();
                        }
                    } else {
                        window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=managers&action=delete&id=' + user_id + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=<?php echo urlencode( stripslashes_deep( $_SERVER['REQUEST_URI'] ) ); ?>';
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
                            data: 'action=wpc_get_options_filter_for_managers&filter=' + filter,
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
                        switch( jQuery( '#change_filter' ).val() ) {
                            case 'client':
                                window.location = req_uri + '&filter_client=' + jQuery( '#select_filter' ).val() + '&change_filter=client';
                                break;
                            case 'circle':
                                window.location = req_uri + '&filter_circle=' + jQuery( '#select_filter' ).val() + '&change_filter=circle';
                                break;
                    }
                    }
                    return false;
                });


                jQuery( '#cancel_filter' ).click( function() {
                    var req_uri = "<?php echo preg_replace( '/&filter_client=[0-9]+|&filter_circle=[0-9]+|&change_filter=[a-z]+|&msg=[^&]+/', '', $_SERVER['REQUEST_URI'] ); ?>";
                    window.location = req_uri;
                    return false;
                });


                //open view Capabilities
                jQuery( '.various_capabilities' ).click( function() {
                    var id = jQuery( this ).data( 'id' );
                    jQuery( 'body' ).css( 'cursor', 'wait' );

                     jQuery( '#wpc_capability_manager_id' ).val( '' );
                     jQuery( '#wpc_capability_manager_name' ).html( '' );
                     jQuery( '#wpc_all_capabilities' ).html( '' );

                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_admin_url() ?>admin-ajax.php',
                        data: 'action=wpc_get_user_capabilities&id=' + id + '&wpc_role=wpc_manager',
                        dataType: "json",
                        success: function( data ){
                            jQuery( 'body' ).css( 'cursor', 'default' );

                            if( data.client_name ) {
                                jQuery( '#wpc_capability_manager_id' ).val( id );
                                jQuery( '#wpc_capability_manager_name' ).html( data.client_name );
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
                    jQuery( '#wpc_capability_manager_id' ).val( '' );
                    jQuery( '#wpc_capability_manager_name' ).html( '' );
                    jQuery( '#wpc_all_capabilities' ).html( '' );
                    jQuery.fancybox.close();
                });


                // AJAX - Udate Capabilities
                jQuery( '#update_wpc_capabilities' ).click( function() {
                    var id              = jQuery( '#wpc_capability_manager_id' ).val();
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
                        data: 'action=wpc_update_capabilities&id=' + id + '&wpc_role=wpc_manager&capabilities=' + JSON.stringify( caps ),
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