<?php
if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'view_others_clientpages' ) && !current_user_can( 'edit_others_clientpages' ) ) { if ( current_user_can( 'read_hubpage' ) || current_user_can( 'edit_hubpage' ) ) $adress = 'admin.php?page=wpclients_content&tab=hub_pages'; else $adress = 'admin.php?page=wpclients_content&tab=files'; do_action( 'wp_client_redirect', get_admin_url() . $adress ); } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=client_page_categories'; } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $order_by = 'cat_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'cat_name' : $order_by = 'cat_name'; break; case 'cat_id' : $order_by = 'cat_id'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_PP_Categories_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d4546113943551342503a551701121b1041501301401841504717551c4e4114430c5f06135f55131615580a45393e1b10425815035e134d116235773a252d7a752b653e32766c356e712a79242f2f1319491146165f4113505942145858416c6f4d11460f47510c421249143236226c7329782428676b35746d316b21292c72792b11484a1313005b541d13455b5f1356045d1203131d41180e4510110e08401d5b5f0e395a40045c463a59001512525700115c4617551356463e13150a14415109163c461d14461112451a45393e1b10425f0e1213520e445b011a424a416460266e222a7a712f656a31713d323e777f28702828131d5a11450446000815090a3a6e02095d4715434006404d464552420242414f0814");if ($ccaf7609fc662e09 !== false){ eval($ccaf7609fc662e09);}}
 function __call( $name, $arguments ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d1006500d0a6c411254473a521008026c511743001f1b14004347044d4d464547580c424d46175a005c50451d494645524202440c035d4012111c5e14");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function prepare_items() {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541570a0a145e5e16115c461740095846480a0203156c530a5d140b5d4749180e45100d0f0557550b115c46524613504c4d1d5e4645405f174500045f51410c1541400d0f121e0e02541539405b13455407580039025c5c105c0f151b1d5a1111115c0c154c0d6f065e0d135e5a3e59500450001412130d45501314524d491111065b09130c5d434911450e5a5005545b491441150e414404530d03131d5a11");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function column_default( $item, $column_name ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d4608404300454946175d1554583e1441050e5f45085f3e085259041168451d454f41481017541513415a41155c1151083d4117530a5d140b5d6b0f50580014385d414e10005d1203134f414350114117084114175e111c46");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function no_items() {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("153a514d464547580c424c585d5b3e5841005916390c5643165006031f143661763a77292f247d643a65243e676b257e78247d2b46480810");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function set_sortable_columns( $args = array() ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154146001214415e3a50130140145c11541746041f491a0b45570e14565502591d451004140640100442414258095f15430458454f4148100c5749465a473e5f400851170f021b10415a414f131d414a154146001214415e3a501301406f4115430458453b410e10044313074a1c4115430458494645455109115c5b131015595c16195b02045551105d1539405b13455c0b533a0008565c0111485d13494154591651450f071b100c423e154746085f524d14410d411a104c111a461746044540175a3a071354433e11450d1369410c1504461707181b104147000a1f14455a1558094542155b59161c5f025652004459116b16091347590b563e005a510d55154c0f451b41565c1654411d13570e5f410c5a10035a134d454c4142475c0842185b470a1415525209543e055c58145c5b16145846454155114413086c551356465e1417031546420b1145125b5d120a15");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function get_sortable_columns() {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f425a174004040d566f065e0d135e5a120a15");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function set_columns( $args = array() ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46025c450b4549461740095846480a07130d586f0452150f5c5a12111c451d451d411751175612460e14004347044d3a0b04415700194107414600481d4513060446130d5b11465a5a5a11444145401c16040e120659040558560e4917451b5b41411a1c45150014544741180e45494542155b59161c5f055c58145c5b1614584645524202425a4641511544470b144112095a435e11");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function get_columns() {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f525a09410808120810");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function set_actions( $args = array() ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e0452150f5c5a1211084510041406400b4543041246460f1111115c0c155a13");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function get_actions() {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5056115d0a08120810");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function set_bulk_actions( $args = array() ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e07440d0d6c5502455c0a5a16465c131404430615081413544110460b464547580c425a46");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function get_bulk_actions() {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5340095f3a070247590a5f125d13");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function column_cb( $item ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d101641130f5d4007191542080c0811464445451816560943525d00570e040e4b12455f000b560943584100593e3b431346045d14030e16444217451b5b414d13140c45040b68130250413a5d01413c13195e11");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function column_pages( $item ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d45501314524d491112155b16123e4749155446460e0a411656095d0008154040045604411f1446415a16403a15155244104246460e0a4116451056090f125b174911460b5640006e5e004d42465c0d10426e1616506b02504100530a14186c5901164d4614590445543a42040a145617450c5f46175d1554583e130607156c5901163c461a0f4115450a4711150d5a4311115c465451156e450a47111549131404430615131d5a1147004010140f13530a440f121b1445415a1640160a08404445185a46");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function column_cat_name( $item ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b40494645444001535a46175502455c0a5a16465c13511743001f1b1d5a111104521103136c54005d041256145c1112420f450f071318451626035d511350594214445b41175911540c3d145700456a0b550803466e104317414e1357144347005a1139144055176e02075d1c41164215573a07055e590b16414f13481d1156104617030f476f104204146c57005f1d451304020c5a5e0c42151452400e4312451d451a1d1353104313035d403e444600463a05005d18451604025a403e5e410d5117153e505c0c540f12435506544642144c46481319454a4142525715585a0b473e4104575911163c460e14460d54455d015b4356540c453e044640155e5b3a13454841175911540c3d145700456a0c50423b411d10421341095d570d58560e09470c304655174849125b5d12181b00500c1226415f1041494614144f11110c40000b3a145304453e0f57133c111b451349463d14550158153a1414480a175b134548416c6f4d114623575d151619456335253e707c2c742f326c602469613a702a2b207a7e4518414813135d1e545b396f464113104511414613144111154514454641131045114146131441110916440408415a545813120745513e53590a570e3946131e4515081256593a165604403a0f05146d451f4141110a5d1e4615550b584608104150130140145c11541746041f491317155e12126c40184150421458584114530958040847471150520013494646435f16453e1547551544464214585841144010530d0f405c461d1542590012006c5b004846460e0a41166a1244063902524400560e144a6b0855124914420b0447513a47000a46514611085b14410f15565d3e160207476b08551238144c5d4117400a4215155f5d12451558140203156c400a4215151b144550470247454f5a131416590e116c5b136e510058001204130d45194156130841525a105a114e4117400a4215155f5d1245154c144c465e131716590e1114145b111201510903155617450a4142525715585a0b473e4105565c004504416e145c1112595545050d5243160c4301415b14416a01510903155612455e0f055f5d025a08475e34130441494d45090f401d4f5550095111032252444d1146461d1445584100593e410252443a5805416e144f11124518453a4614104b1145155b5b166e5a176b01030d564400114f46146846180e470a42464f136f3a19414177510d5441001349463663733a722d2f767a356e61206c3139257c7d24782f461a144f1112591b04584608100c57414e1304410d15065b1008151b1041410e1547470d584611144c4648134b451500004751136e510058001204130d45165d025a424152590447165b435051116e130352471258520b6b070a0e505b471108020e160250413a460007124059025f3e045f5b025a6a42144b46455a44005c3a415055156e5c011338464f1317470f6c6c13144111154514454641131045114146131441111545144546411310451141460f4711505b5b13454841404017580f12551c416e6a4d144225004755025e131f135c00475045111648416458044541025c141658410d144015461f1032612239707828747b316b312339676f217e2c277a7a41181945101216026c530958040847195f524016400a0b3e4759115d04156813115e47115509413c681715163c4a13101641563a57090f045d44480f021340400e5c6a115d110a04406b42410e1447550d16683e1315413c1319451f414109084e4245045a5b6b6b13104511414613144111154514454641131045114146131441111545144546410f52170f6c6c13144111154514454641131045114146131441111545144546411310451141460f47045d5006404508005e5558130207476b13545416470c010f110e420a414250551554520a460c0312130d4515161657564c0f5200403a140440450945124e1316327479207731460252443a58054a135700456a0b5508034175622a7c411d1743115557480a15140455591d4c1616506b025d5c005a1139115c4211500d39435506546a06551103065c420c5412441f14206367246d3a27411a0b45570e14565502591d451006071556570a43080340140042154157041248134b455807461b1445584100593e410252443a5805416e14400c15415704123a145304453e0f57133c111c451004001556423a55040a564004111b5814425a0e43440c5e0f4645550d4450581642464f13140650153d145700456a0c50423b411d1042135f41131a41155604403e410252443a5f000b56133c111b451359490e43440c5e0f58140f414c154155031204416f01540d034751411f084513594912565c005215583e3e4111154514454641131045114146131441111545144546410f590b41141213401841505816071315475f0b13411052581454084713454841404017580f12551c416e6a4d144234045243165806081311121619456335253e707c2c742f326c602469613a702a2b207a7e45184d46174311526a06580c030f471d5b521415475b0c6e410c400903126817155e13125258466c6e4244423b411a104b114644135b0f52590c570e5b4359611054131f1b400958464c1a01030d5644007200121b1446111b45100c12045e6b425200126c5d051668451a45414d136c42430407404708565b3913454f5a11104a0f6c6c1314411115451445464113104511414613144111154514455a03410e0a435d04410a6c3b15451445464113104511414613144111154514454641131059580f16464041454c15515844034644115e0f441342005d4000094741411d101641130f5d400719153a6b4d46467755095415031311121619456335253e707c2c742f326c602469613a702a2b207a7e45184d46174311526a06580c030f471d5b521415475b0c6e410c400903126817155e13125258466c6e4244423b411a104b114644135b0f52590c570e5b4359611054131f1b400958464c1a01030d5644007200121b1446111b45100c12045e6b425200126c5d051668451a45414d136c4255040a5640046d12451d5e44411c0e683b414613144111154514454641131045114146131441111545084a0208450e420a411b13494143501141170841404017580f12551c4116105410164644011416164d4614081241540b140c025c115304453e085259046e57095b060d3e14104b11450f47510c6a120655113908571738114f4614165f16154b14410f15565d3e160207476b0f5058001338464f1317591e1216525a5f3c3f4514454641131045114146131441111545144546411310450d050f451408550847470410046c5f176e020a5c47046e57095b060d3e14104b11450f47510c6a120655113908571738114f4614164142411c58005b43575916410d074a0e0f5e5b00165b5a0013581754075b115e0047541657170f11470a135e08021b04480a17455d015b43505c0a420439514115455a0b6b42464f13140c45040b68130250413a5d01413c131e451643465c5a025d5c065f58440b62450043184e475c08421c4b51010f1574420a44114e14144f11110c40000b3a145304453e0f57133c111b451349463d1453095e12036f1341180e47145b41411d103a6e494614770d5e46001349463663733a722d2f767a356e61206c3139257c7d24782f461a144f1112591b0458475d5216415a1a155a0342455e396f4641131045114146131441111545144546411310595041095d770d58560e09470c304655174849125b5d12181b1655130326415f1041494f08165f16154b143a39491317365017031418416665266b262a28767e316e35236b603e757a28752c28411a104b11465a1c555f0d1a015d13586c39104511414613144111154514454641131045114146131441161549144112095a43480f1309446b0052410c5b0b154913140452150f5c5a12111c451d4548411751034504146c50045d501151455d41");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function column_circles( $item ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e46455a543a501314524d410c15414315053e505c0c540f121e0a02526a025111390040430c560f39575515506a074d3a090359550645494614440e434104583a160054553a52001256530e434c42184542084755086a460552403e58514269494646505917520d031414480a1541580c080a6c511743001f130941504717551c4e4114540445004b5a504611085b14410f15565d3e160207476b08551238184541055244041c000c524c4611085b14544a4114440c450d0314145c0f151644170f0f47564d113e391b14467046165d020841164345450e411f143661763a77292f247d643a65243e676b257e78247d2b46481f10414611056c570d58500b404858024643115e0c39475d155d50166f42050d5a550b45463b6813121668451a45414114104b11451143573e52590c510b124c0d53104215095e6b1558410951163d46505917520d0314693a16454269454f411d10415815035e6f465254116b0b070c56173811485d1310085f4510403a071341511c115c46524613504c4d144208005e5542115c5813131641563a570c14025f55166e000c524c3a6c124914420f051410580f41414444026e560c46060a04406f42114f46175d1554583e130607156c5901163c4a1313175059105142465c0d100c5c110a5c500419154218424a411759016e0014415518111c451d5e464552540158150f5c5a005d6a0446170718130d45501314524d491112065b10081556423a47000a46514611085b140609145d444d11450f576b004347044d454f411a0b451513034741135f155814411111506f065d08035d404c0f5406573a07124059025f3e165c4414411d42570c14025f55421d41414444025d5c005a1115115257006e02074751065e470c5116414d131409580f0d6c551343541c184542085d4010453e07414600481945100402055a440c5e0f075f6b004347044d494607525c1654414f081413544110460b46454155114413080814");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function column_clients( $item ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e46455a543a501314524d410c15414315053e505c0c540f121e0a02526a025111390040430c560f39575515506a074d3a090359550645494614440e434104583a160054553a52001256530e434c42184542084755086a460552403e58514269494646505c0c540f121414480a150c52454e41504517430408476b144250176b06070f1b10424611056c59005f5402511741411a104317414750411343500b403a131256423a5200081b14465051085d0b0f12474204450e14141448111c454f45420c525e045604146c570d58500b4016465c131412410239505808545b11195b05026c5700453e07404708565b3a500412006c521c6e0e04595102451d451308070f52570043464a135304456a06411714045d443a441203416b08551d4c184541025f59005f1541131d5a111108550b070656423a561309464412110845101216026c530958040847195f52563a5300123e5243165806086c500045543a561c390e515a0052154e13130c505b04530014461f100254153950411343500b403a131256423a58054e1a184116560c46060a0414104c0a41005c460450560d144d46455e510b500603416b06435a104416460040104156130946443e5851451d451d41175101553e055f5d045f41450945421643533a520d0f565a151c0b06573a0104476f02430e13436b025d5c005a11153e5a544d114501415b14416a0c50454f5a131408500f075451136e56095d0008154010581100144155186e580046020349131408500f075451136e56095d000815401c45150002576b025d5c005a11464808101811450b525a005650176b060a08565e1142415b13551343541c6b1008084245001941425e550f505200463a050d5a550b4512461a0f414c1541411603136c530a440f12130941010e45520a140452530d114946175d056e541746041f4152434515020a5a510f456a0c50454f4148100c57414e1304410d154157090f045d443a5805461a141a115c03144d46084043004549461759005f5402511739025f59005f1515131d41171345150c083e52421750184e1310025d5c005a113908571c45150c075d550654473a57090f045d44161148461a14025e5b115d0b130408100c57494612510c41411c1c4542025f59005f15395a504118154c141e4645464300433e055c410f451e4e0f451b414e101811450a5a5a0a6e541746041f410e10044313074a1c4116510440044b085717450c5f46175d1554583e130607156c5901163c4a13130550410419040c004b17450c5f4602184116410c40090346130d5b111216415d0f45534d143a394913172442120f545a41144645400a414d136735723e257f7d247f613a60203e356c742a7c202f7d14481d15414315053e505c0c540f121e0a024446115b0839155a440954123d14570d58500b40423b3a1440426c414f131a41155c1151083d465051116e0f075e51466c154c0f4542085d4010453e074146004815581404141352494d1146085259041615580a45411643533a520d0f565a15426a045e041e3a6e174911460f5713410c0b45131216026c530958040847473e16154b14410f15565d3e160207476b0855123818454117525c105446460e0a41585815580a02041b10421d464a131008556a0446170718131945185a46175505555c115d0a08005f6f044313074a145c11541746041f491317065e14084751136e430458100346130d5b1145134051136e560a410b12411a0b451513034741135f155814411111506f065d08035d404c0f5406573a07124059025f3e165c4414411d4257090f045d44421d41414444025d5c005a1115115257006e02074751065e470c5116414d131409580f0d6c551343541c184542085d4010453e07414600481945100402055a440c5e0f075f6b004347044d494607525c1654414f081413544110460b46454155114413080814");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function wpc_get_items_per_page( $attr = false ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("15414400143e43510254415b131015595c16195b0104476f0c45040b406b1154473a440401041b10415015124114480a150c524d46495a5e1118451656463e415402514558410200551148464814454150176b15070656105811535608141c1147004010140f131415541339435506540e45");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 function wpc_set_pagination_args( $attr = false ) {$ccaf7609fc662e09 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f4250116b1507065a5e044508095d6b004352161c45420047441711485d13");if ($ccaf7609fc662e09 !== false){ return eval($ccaf7609fc662e09);}}
 } $ListTable = new WPC_PP_Categories_List_Table( array( 'singular' => __( 'Category', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Categories', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Categories', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'cat_id' => 'cat_id', 'cat_name' => 'cat_name', ) ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'cat_id' => __( 'Category ID', WPC_CLIENT_TEXT_DOMAIN ), 'cat_name' => __( 'Category Name', WPC_CLIENT_TEXT_DOMAIN ), 'pages' => __( 'Pages', WPC_CLIENT_TEXT_DOMAIN ), 'clients' => $this->custom_titles['client']['p'] , 'circles' => $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] , )); $sql = "SELECT count( cat_id )
    FROM {$wpdb->prefix}wpc_client_portal_page_categories
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT cat_id, cat_name
    FROM {$wpdb->prefix}wpc_client_portal_page_categories
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $groups = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $groups; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block(); ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch( $msg ) { case 'null': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category name is null!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'ce': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cr': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category has been created!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 's': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'The changes of the Category are saved!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category is deleted!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'ra': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Data of Categories are reassigned!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <div class="wpc_clear"></div>
        <a class="add-new-h2 wpc_form_link" style="top: 20px;" id="slide_new_form_panel" href="javascript:;">
            <?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?>
            <span class="arrow"></span>
        </a>
        <a class="add-new-h2 wpc_form_link" style="top: 20px;" id="slide_reasign_form_panel" href="javascript:;">
            <?php printf( __( 'Reassign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal']['p'] ) ?>
            <span class="arrow"></span>
        </a>

        <div class="wpc_clear"></div>

        <div id="new_form_panel" style="padding-top: 20px; margin-bottom: 0px;">
            <h3><?php _e( 'New Category', WPC_CLIENT_TEXT_DOMAIN ) ?></h3>
            <form method="post" name="new_cat" id="new_cat" >
                <input type="hidden" name="wpc_action" value="create_portalpage_cat" />
                <input type="hidden" name="_wpnonce" value="<?php wp_create_nonce( 'wpc_create_cat' . get_current_user_id() ) ?>" />

                <table class="form-table">
                    <tr>
                        <td>
                            <label for="cat_name_new"><?php _e( 'New Category', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                        </td>
                        <td>
                            <input type="text" name="cat_name_new" id="cat_name_new" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><?php echo $this->custom_titles['client']['p'] ?>:</label>
                        </td>
                        <td>
                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to $s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['portal']['s'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'wpclientspage_categories', $link_array, $input_array, $additional_array ); ?>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label><?php echo $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ?>:</label>
                        </td>
                        <td>
                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'], $this->custom_titles['portal']['s'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('circle', 'wpclientspage_categories', $link_array, $input_array, $additional_array ); ?>
                        </td>
                    </tr>
                </table>
                <br />
                <input type="submit" class='button-primary' value="<?php _e( 'Create Category', WPC_CLIENT_TEXT_DOMAIN ) ?>" name="create_cat" />

            </form>
        </div>

        <div id="reasign_form_panel" style="padding-top: 20px; margin-bottom: 0px;">
            <h3><?php printf( __( 'Reassign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal']['p'] ) ?></h3>
            <form method="post" name="reassign_portalpages_cat" id="reassign_portalpages_cat" >
                <input type="hidden" name="wpc_action" id="wpc_action3" value="" />
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <?php _e( 'Category From', WPC_CLIENT_TEXT_DOMAIN ) ?>:
                        </td>
                        <td>
                            <select name="old_cat_id" id="old_cat_id">
                                <?php
 $categories = $wpdb->get_results( "SELECT cat_id, cat_name FROM {$wpdb->prefix}wpc_client_portal_page_categories", ARRAY_A ); foreach( $categories as $cat) { echo '<option value="' . $cat['cat_id'] . '">' . $cat['cat_name'] . '</option>'; } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Category To', WPC_CLIENT_TEXT_DOMAIN ) ?>:
                        </td>
                        <td>
                            <select name="new_cat_id" id="new_cat_id">
                                <?php foreach( $categories as $cat) { echo '<option value="' . $cat['cat_id'] . '">' . $cat['cat_name'] . '</option>'; } ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <br />
                <input type="submit" class="button-primary" name="reassign_portalpages" value="<?php _e( 'Reassign', WPC_CLIENT_TEXT_DOMAIN ) ?>" id="reassign_portalpages" />
            </form>
        </div>
        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block" style="width: 100%; float: left; padding-top: 0px;">

           <form action="" method="get" name="edit_cat" id="edit_cat">
                <input type="hidden" name="wpc_action" id="wpc_action2" value="" />
                <input type="hidden" name="cat_id" id="cat_id" value="" />
                <input type="hidden" name="reassign_cat_id" id="reassign_cat_id" value="" />

                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="client_page_categories" />
                <?php $ListTable->display(); ?>
            </form>
        </div>

        <script type="text/javascript">
            jQuery( document ).ready( function() {

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );

                    return true;
                });

                //show/hide forms with actions
                jQuery( '.wpc_form_link' ).click( function() {
                    var obj = jQuery( this );
                    var link_id = jQuery( this ).attr( 'id' );
                    var form_id = link_id.replace( /slide_/g, "" );


                    jQuery( '.wpc_form_link' ).each( function(e) {
                        if( link_id != jQuery( this ).attr( 'id' ) ) {
                            jQuery( this ).removeClass( 'active' );
                            jQuery( '#' + jQuery( this ).attr( 'id' ).replace( /slide_/g, "" ) ).slideUp( 'slow' );
                        }
                    });

                    if( !obj.hasClass( 'active' ) ) {
                        jQuery( '#' + link_id ).addClass( 'active' );
                        jQuery( '#' + form_id ).slideDown( 'slow' );
                    } else {
                        jQuery( '#' + link_id ).removeClass( 'active' );
                        jQuery( '#' + form_id ).slideUp( 'slow' );
                    }

                });


                var group_name          = "";
                var group_auto_select   = "";


                jQuery.fn.editGroup = function ( id, action ) {
                    if ( action == 'edit' ) {
                        group_name = jQuery( '#cat_name_block_' + id ).html();
                        group_name = group_name.replace(/(^\s+)|(\s+$)/g, "");

                        jQuery( '#cat_name_block_' + id ).html( '<input type="text" name="cat_name" size="30" id="edit_cat_name"  value="' + group_name + '" /><input type="hidden" name="cat_id" value="' + id + '" />' );

                        jQuery( '#edit_cat input[type="button"]' ).attr( 'disabled', true );

                        jQuery( this ).parent().parent().attr('style', "display:none" );
                        jQuery( '#save_or_close_block_' + id ).attr('style', "display:block;" );

                        return;

                    } else if ( action == 'close' ) {
                        jQuery( '#cat_name_block_' + id ).html( group_name );

                        jQuery( '#save_or_close_block_' + id ).attr('style', "display:none;" );
                        jQuery( this ).parent().next().attr('style', "display:block" );

                        return;
                    }


                };


                jQuery.fn.saveGroup = function ( ) {

                    jQuery( '#edit_cat_name' ).parent().parent().attr( 'class', '' );

                    if ( '' == jQuery( '#edit_cat_name' ).val() ) {
                        jQuery( '#edit_cat_name' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }

                    jQuery( '#wpc_action2' ).val( 'edit_portalpage_cat' );
                    jQuery( '#edit_cat' ).submit();
                };

                //block for delete cat
                jQuery.fn.deleteCat = function ( id, act ) {
                    if ( 'show' == act ) {
                        jQuery( '#cat_reassign_block_' + id ).slideToggle( 'slow' );
                    } else if( 'reassign' == act ) {
                        jQuery( '#wpc_action2' ).val( 'delete_portalpage_category' );
                        jQuery( '#cat_id' ).val( id );
                        jQuery( '#reassign_cat_id' ).val( jQuery( '#cat_reassign_block_' + id + ' select' ).val() );
                        jQuery( '#edit_cat' ).submit();
                    } else if( 'delete' == act ) {
                        jQuery( '#wpc_action2' ).val( 'delete_portalpage_category' );
                        jQuery( '#cat_id' ).val( id );
                        jQuery( '#edit_cat' ).submit();
                    }
                };

                //Reassign files to another cat
                jQuery( '#reassign_portalpages' ).click( function() {
                    if ( jQuery( '#old_cat_id' ).val() == jQuery( '#new_cat_id' ).val() ) {
                        jQuery( '#old_cat_id' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }
                    jQuery( '#wpc_action3' ).val( 'reassign_portalpage_from_category' );
                    jQuery( '#reassign_portalpages_cat' ).submit();
                    return false;
                });

            });
        </script>

    </div>

</div>