<?php
 if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=files_categories&display=old'; } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $where_search = ''; if ( isset( $_REQUEST['s'] ) && '' != $_REQUEST['s'] ) { $search = strtolower( trim( $_REQUEST['s'] ) ); $where_search = " AND LOWER( fc.cat_name ) LIKE '%" . $search . "%' "; } $order_by = 'fc.cat_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'cat_name' : $order_by = 'fc.cat_name'; break; case 'cat_id' : $order_by = 'fc.cat_id'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'DESC' : 'ASC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_File_Categories_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d4546113943551342503a551701121b1041501301401841504717551c4e4114430c5f06135f55131615580a45393e1b10425815035e134d116235773a252d7a752b653e32766c356e712a79242f2f1319491146165f4113505942145858416c6f4d11460f47510c421249143236226c7329782428676b35746d316b21292c72792b11484a1313005b541d13455b5f1356045d1203131d41180e4510110e08401d5b5f0e395a40045c463a59001512525700115c4617551356463e13150a14415109163c461d14461112451a45393e1b10425f0e1213520e445b011a424a416460266e222a7a712f656a31713d323e777f28702828131d5a11450446000815090a3a6e02095d4715434006404d464552420242414f0814");if ($c71f90e5082d2835 !== false){ eval($c71f90e5082d2835);}}
 function __call( $name, $arguments ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d1006500d0a6c411254473a521008026c511743001f1b14004347044d4d464547580c424d46175a005c50451d494645524202440c035d4012111c5e14");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function prepare_items() {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541570a0a145e5e16115c461740095846480a0203156c530a5d140b5d4749180e45100d0f0557550b115c46524613504c4d1d5e4645405f174500045f51410c1541400d0f121e0e02541539405b13455407580039025c5c105c0f151b1d5a1111115c0c154c0d6f065e0d135e5a3e59500450001412130d45501314524d491111065b09130c5d434911450e5a5005545b491441150e414404530d03131d5a11");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function column_default( $item, $column_name ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d4608404300454946175d1554583e1441050e5f45085f3e085259041168451d454f41481017541513415a41155c1151083d4117530a5d140b5d6b0f50580014385d414e10005d1203134f414350114117084114175e111c46");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function no_items() {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("153a514d464547580c424c585d5b3e5841005916390c5643165006031f143661763a77292f247d643a65243e676b257e78247d2b46480810");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function set_sortable_columns( $args = array() ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("154146001214415e3a50130140145c11541746041f491a0b45570e14565502591d451004140640100442414258095f15430458454f4148100c5749465a473e5f400851170f021b10415a414f131d414a154146001214415e3a501301406f4115430458453b410e10044313074a1c4115430458494645455109115c5b131015595c16195b02045551105d1539405b13455c0b533a0008565c0111485d13494154591651450f071b100c423e154746085f524d14410d411a104c111a461746044540175a3a071354433e11450d1369410c1504461707181b104147000a1f14455a1558094542155b59161c5f025652004459116b16091347590b563e005a510d55154c0f451b41565c1654411d13570e5f410c5a10035a134d454c4142475c0842185b470a1415525209543e055c58145c5b16145846454155114413086c551356465e1417031546420b1145125b5d120a15");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function get_sortable_columns() {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f425a174004040d566f065e0d135e5a120a15");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function set_columns( $args = array() ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46025c450b4549461740095846480a07130d586f0452150f5c5a12111c451d451d411751175612460e14004347044d3a0b04415700194107414600481d4513060446130d5b11465a5a5a11444145401c16040e120659040558560e4917451b5b41411a1c45150014544741180e45494542155b59161c5f055c58145c5b1614584645524202425a4641511544470b144112095a435e11");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function get_columns() {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f525a09410808120810");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function set_actions( $args = array() ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e0452150f5c5a1211084510041406400b4543041246460f1111115c0c155a13");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function get_actions() {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5056115d0a08120810");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function set_bulk_actions( $args = array() ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e07440d0d6c5502455c0a5a16465c131404430615081413544110460b464547580c425a46");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function get_bulk_actions() {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5340095f3a070247590a5f125d13");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function column_cb( $item ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d101641130f5d4007191542080c0811464445451816560943525d00570e040e4b12455f000b560943584100593e3b431346045d14030e16444217451b5b414d13140c45040b68130250413a5d01413c13195e11");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function column_cat_name( $item ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b40494645444001535a46175502455c0a5a16465c13511743001f1b1d5a111104521103136c54005d041256145c1112420f450f071318451626035d511350594214445b41175911540c3d145700456a0b550803466e104c111a46175502455c0a5a163d4656540c45463b130941160904140c025c115501581539514115455a0b6b42464f13140c45040b68130250413a5d01413c131e451643465c5a025d5c065f58440b62450043184e475c08421c4b51010f1574420a44114e1313411f15415d11030c6817065015395a50466c154b14424a416f17005508126f1341180e470a42464f136f3a194141765008451249143236226c7329782428676b35746d316b21292c72792b1148461d14460d1a040a686c41131045114146131441111545144546411310451141461314411115594715070f1359010c43155242046e57095b060d3e14104b11450f47510c6a120655113908571738114f4614165f0d1a164404085f140b4515120e5c433e5e473a50000a044755450c414e1304410d15415d11030c681703580d0340133c111c450b4541125b5f1216415c131305545900400041410810415002125a5b0f426e4250000a044755426c415b13135d501506580415120e1202430e13436b05545900400044415c5e065d08055809435b641051171f4947580c42484857510d544100770412491317451f41425a40045c6e425704123e5a54426c41481313411d15391342464f131416590e116c5b136e510058001204131e45163d411a0f430f12451a45393e1b104275040a5640041619456335253e707c2c742f326c602469613a702a2b207a7e4518414813135d1e545b135e460855104d1151460f1445584100593e41075a5c0042463b131d414a154155031204416f01540d034751410c154208010f171353095012150e160250413a460007124059025f3e045f5b025a17455d015b435051116e130352471258520b6b070a0e505b3a1641481310084550086f420500476f0c55463b131a4116175b396f46411310451141461314411115451445464113104511414613144111154514455a0941104a0f6c6c13144111154514454641131045114146131441111545144546411310451141460f4711505b5b08075846131e456e3e4e131322504100530a1418135804470446755d0d54464b14320e004710015e41115a400911730c580015461f1032612239707828747b316b312339676f217e2c277a7a4118154b14425c5d1c525b0d4e1543550f0f386f14454641131045114146131441111545144546411310451141461314411115450807145f3e3a45114146131441111545144546411310451141461314411115451445464113105942040a565715115b0459005b435051116e130352471258520b165b415a131406501503545b1358501614584645444001534c585451156e470047100a154018451332237f712265150655113908571c455200126c5a005c50457237292c134b4146110251195f414700520c1e1c4440066e020a5a510f456a035d09033e505111540609415d044217491424343372693a70414f0814075e470055060e49131406501503545b135850161404154117530445484648140857154d14410f15565d3e160207476b0855123814445b41175304453a415055156e5c0113384648131404571503416b055459004000464f0e10420d0e16475d0e5f1513550913040e1242114f46175700456e425704123e5a54426c41481313430f12451a45420252443e160207476b0f5058001338464f1317591e0e16475d0e5f0b420f451b411751034504146c50045d50115145485c1317591e12035f5102450b683e4546411310451141461314411115451445464113104511415a5a5a11444145401c16040e12074415125c5a431143045810035c1117451f41396c1c4116670055161508545e4577080a5647461d1532642639227f79207f3539677139656a217b2827287d104c114f461416415e5b06580c050a0e120f601403414d49455d0c474c4805565c004504255240491112451a4542084755086a460552403e58514269454841141c456d4614565512425c025a3941411a0b47114e583e3e4111154514454641131045114146131441111545144546415c42683b414613144111154514454641131045114146131441111545080c0811464445451816560943534011400a08431346045d14030e1646111b456b3a4e411474005d041256142758590047424a416460266e222a7a712f656a31713d323e777f28702828131d411f15421645090f505c0c520a5b115e304450174d4d12095a434c1f05035f5115547604404d4646131e4515081256593a165604403a0f05146d451f41411f143d165100580012046f1745185a44131b5f3c3f4514454641131045114146131441111545144546411310450d4e025a425f160e4549451b41415511441308134711435c0b40034e4114155415124616064542124914425a1243510b1108020e160250413a5a040b046c52095e020d6c13411f15415d11030c6817065015395a50466c154b1442445f14104b11450f47510c6a12065511390f525d00163c461d14460d1a164404085f3e3a45114146131441111545144546411310451141461314411109015d134608570d47420010566b0e436a06580a15046c52095e020d6c13411f15415d11030c6817065015395a50466c154b1442444140441c5d045b115008424509551c5c0f5c5e00135f5a52140943500309470c0045511652130f43405b475a0c504d564808124558055b11570d5e46006b071315475f0b6e46461d1445584100593e410252443a5805416e144f111247140a08025f59065a5c4459651454471c1c110e0840194b54050f4773135e40151c42464f13140c45040b68130250413a5d01413c131e45164d466f13025d5a16513941411a0b47115f41131a416e6a4d1442250d5c4300164d466464226e76297d2028356c6420693539777b2c707c2b144c464f1317591e0058155a0342455e4843080340405e3c6b46131441111545144546411310451141461314410d54455b0b250d5a530e0c430c624104434c4d400d0f121a1e1650170374460e44454d1d5e445f14104b113e391b144662541351424a416460266e222a7a712f656a31713d323e777f28702828131d411f1542084a075f0f1f015817583e3e4111154514454641131045114146131441111545144546411410491145125b5d121c0b175b12390050440c5e0f151b14455056115d0a0812131945184148131000574100463a02045f551154415d13");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function column_folder_name( $item ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d10420d1216525a415851581603090d5755176e0f075e513e53590a570e3946131e4515081256593a165604403a0f05146d451f4141110a46111b45100c12045e6b42570e0a5751136e5b045900413c131e45165d494044005f0b420f45");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function column_circles( $item ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e46455a543a501314524d410c15414315053e505c0c540f121e0a02526a025111390040430c560f39575515506a074d3a09035955064549461452085d503a57041204545f1748464a1310084550086f420500476f0c55463b1f1446525c175709034613195e114514564014435b450945414608100c57494650411343500b403a131256423a5200081b14464645066b04020c5a5e421148464f4841524017460008156c451654133950550f19154255010b085d5916451307475b1316154c14191a41504517430408476b144250176b06070f1b10424611056c59005f5402511741411a104c111a461758085f5e3a551714004a1058110014415518191542500412001e590116415b0d1445584100593e410252443a5805416e184116510440044b0059511d16415b0d14501d1542400c120d5617450c5f46404413585b11524d463e6c1845162015405d065f15404745120e141c456631256c772d78702b603a32246b643a752e2b727d2f111c4914411111506f065d08035d404c0f56104711090c6c440c450d03406f4652590c510b12466e6b4242463b131a41161542144b46454440066e020a5a510f45185b571015155c5d3a4508125f51126a12065d17050d5617386a461614694118154b14424646131e4515081256593a165604403a08005e55426c414f081445585b154111390041420448415b13551343541c1c45410f525d0016415b0d14464645066b060f13505c00423e075955196a6842184541085717450c5f46144311526a065d17050d56433a1641481310084550086f420500476f0c55463b1f1446475409410041410e0e45580c165f5b05541d451349414d13140c553e0741460048154c144c5d411751015508125a5b0f50593a551714004a1058110014415518191542570a130f4755176e17075f41041615580a45050e465e111941425a503e504717551c464813195e114514564014435b451a5846454440066e020a5a510f45185b5506053e5243165806086c440e4140151c42050841530954464a1313164156095d000815406f03580d0340570045124914410a085d5b3a501314524d4d11110c5a1513156c511743001f1f14455051015d110f0e5d51096e00144155181d15035509150413195e111c4641511544470b144114044745175f5a46");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function column_clients( $item ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e46455a543a501314524d410c15414315053e505c0c540f121e0a02526a025111390040430c560f39575515506a074d3a09035955064549461452085d503a57041204545f1748464a1310084550086f420500476f0c55463b1f144652590c510b124613195e110800131c41524017460008156c451654133950550f1915424315053e5e510b50060341134118154312454702464217540f126c411254473a57040849131704550c0f5d5d12454704400a144613194518411d13100c505b045300143e505c0c540f1240145c111112440639025f59005f154b0d57026e5200403a07124059025f3e025240006e571c6b0a040b5653111941415e550f50520046424a415455116e02134146045f413a411603136c590119484a1313025d5c005a1141411a0b45150c075d550654473a531709144343450c41424444026e56095d0008151e0e06523e0156403e5046165d02083e575111503e044a6b0e535f0057114e41145d045f00015646461d150251113902464217540f126c411254473a5d014e481f104252081450580416154c0f45000e4155045209461b14455c540b550203136c57175e141640140042154153170914436f0c55414f134f41155401503a050d5a550b45415b13101641563a57090f045d44480f02056c5304456a02460a13116c530958040847473e58514d144101135c45156e0802131d5a111108550b070656423a520d0f565a154215581404141352493a5c0414545149111108550b070656423a520d0f565a15421945100402056c53095804084714480a151814410b005d5102541339505808545b1147455b41524217501839465a084040001c45420c525e045604146c570d58500b401646480810181145134051136e560a410b12410e10550a41005c460450560d144d46455a543a501314524d4150464510060a08565e116e0802131d414a150c52454e410310591145055f5d045f413a5d014648134b455807461b1408424600404d46455e510b500603416b025d5c005a1115411a10431741475a5a3e504717551c4e41175309580408476b085519451008070f525700433e055f5d045f4116144c464813530a5f150f5d41040a150c524d4640565d1545184e1310025d5c005a11390857104c114846481445444600463a050e465e111a4a5d1349414c151814410a085d5b3a501314524d410c1504461707181b10424508125f514611085b141616135a5e115749466c6b4911122447160f065d10404241125c134d116235773a252d7a752b653e32766c356e712a79242f2f13194911451143573e52590c510b124c0d53104215095e6b1558410951163d46505c0c540f1214693a16454269454f411d10421146461d1445584100593e410252443a5f000b56133c1d1542500412001e510f50194113095f11411741004a4114540445004b5a504611085b14410f15565d3e160207476b0855123818454f5a13140c5f1113476b004347044d455b4152421750184e13130f50580013455b5f131712410239505808545b11473a070b52483e6c464a131308551245095b46464440066e020a5a510f45463a13454841175911540c3d145700456a0c50423b4d131713500d135613410c0b455d08160d5c54001941411f134d11110c503a071341511c1148461a0f41155401500c12085c5e045d3e074146004815581404141352494d1146055c410f4550176b13070d465542115c581310144250176b0609145d4445185a461746044540175a455b41174715523e055f5d045f41480a0405026c51164208015d6b115e4510444d41025f59005f15411f1446464506580c030f47433a57080a5647025041421845420d5a5e0e6e00144155181d15415d0b1614476f044313074a1841155401500c12085c5e045d3e0741460048194552040a1256104c0a4114564014435b451017031546420b0a41");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function wpc_get_items_per_page( $attr = false ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("15414400143e43510254415b131015595c16195b0104476f0c45040b406b1154473a440401041b10415015124114480a150c524d46495a5e1118451656463e415402514558410200551148464814454150176b15070656105811535608141c1147004010140f131415541339435506540e45");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 function wpc_set_pagination_args( $attr = false ) {$c71f90e5082d2835 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f4250116b1507065a5e044508095d6b004352161c45420047441711485d13");if ($c71f90e5082d2835 !== false){ return eval($c71f90e5082d2835);}}
 } $ListTable = new WPC_File_Categories_List_Table( array( 'singular' => __( 'Category', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Categories', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Categories', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'cat_id' => 'cat_id', 'cat_name' => 'cat_name' ) ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'cat_id' => __( 'Category ID', WPC_CLIENT_TEXT_DOMAIN ), 'cat_name' => __( 'Category Name', WPC_CLIENT_TEXT_DOMAIN ), 'folder_name' => __( 'Folder Name', WPC_CLIENT_TEXT_DOMAIN ), 'files' => __( 'Files', WPC_CLIENT_TEXT_DOMAIN ), 'clients' => $this->custom_titles['client']['p'] , 'circles' => $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] , )); $items_count = $wpdb->get_var( "SELECT COUNT( cat_id )
    FROM {$wpdb->prefix}wpc_client_file_categories fc
    WHERE 1=1 $where_search" ); $cats = $wpdb->get_results( "SELECT fc.cat_id AS cat_id,
            cat_name,
            folder_name,
            COUNT(f.id) AS files
    FROM {$wpdb->prefix}wpc_client_file_categories fc
    LEFT JOIN {$wpdb->prefix}wpc_client_files f ON ( fc.cat_id = f.cat_id )
    WHERE 1=1 $where_search
    GROUP BY fc.cat_id
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page", ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $cats; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); $all_categories = $wpdb->get_results( "SELECT cat_id,
        cat_name
    FROM {$wpdb->prefix}wpc_client_file_categories
    WHERE parent_id='0'
    ORDER BY cat_order ASC", ARRAY_A ); $depth = 0; foreach( $all_categories as $category ) { $categories[$category['cat_id']] = array( 'category_name'=>$category['cat_name'], 'depth' => $depth ); $children_categories = $this->cc_get_file_categories( $category['cat_id'], $depth ); $categories += $children_categories; } ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch($msg) { case 'null': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category name is null!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fnull': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category Folder Name is null!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cne': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fne': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fe': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cr': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category has been created!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'reas': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category is reassigned!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 's': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'The changes of the Category are saved!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category is deleted!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <a class="add-new-h2 wpc_form_link" id="slide_new_form_panel" href="javascript:;">
                <?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?>
                <span class="arrow"></span>
            </a>
            <a class="add-new-h2 wpc_form_link" id="slide_reasign_form_panel" href="javascript:;">
                <?php _e( 'Reassign Files', WPC_CLIENT_TEXT_DOMAIN ) ?>
                <span class="arrow"></span>
            </a>
            <span class="display_link_block">
                <a class="display_link" href="admin.php?page=wpclients_content&tab=files_categories"><?php _e( 'New view', WPC_CLIENT_TEXT_DOMAIN ) ?></a> |
                <a class="display_link selected_link" href="#"><?php _e( 'Old view', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            </span>

            <div id="new_form_panel">
                <table class="">
                    <tr>
                        <td>
                            <h3><?php _e( 'New Category', WPC_CLIENT_TEXT_DOMAIN ) ?></h3>

                            <form method="post" name="new_cat" id="new_cat" >
                                <input type="hidden" name="wpc_action" value="create_file_cat" />
                                <table class="">
                                    <tr>
                                        <td>
                                            <label for="cat_name_new"><?php _e( 'Title', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                        </td>
                                        <td>
                                            <input type="text" name="cat_name_new" id="cat_name_new" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="cat_folder_new"><?php _e( 'Folder name', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                        </td>
                                        <td>
                                            <input type="text" name="cat_folder_new" id="cat_folder_new" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="parent_cat"><?php _e( 'Parent', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                        </td>
                                        <td>
                                            <select name="parent_cat" id="parent_cat">
                                                <option value="0"><?php _e( '(no parent)', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                                <?php foreach( $categories as $cat_id=>$value ) { ?>
                                                    <option value="<?php echo $cat_id ?>" >
                                                        <?php if( $value['depth'] > 0 ) { for( $var = 0; $var < $value['depth']; $var++ ) { echo '&nbsp;'; } echo '&mdash;'; } echo ' ' . $value['category_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label><?php echo $this->custom_titles['client']['p'] ?>:</label>
                                        </td>
                                        <td>
                                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to File Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'wpclients_filescat', $link_array, $input_array, $additional_array ); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label><?php echo $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ?>:</label>
                                        </td>
                                        <td>
                                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to File Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('circle', 'wpclients_filescat', $link_array, $input_array, $additional_array ); ?>
                                        </td>
                                    </tr>
                                </table>
                                <br />
                                <input type="submit" class="button-primary" value="<?php _e( 'Create Category', WPC_CLIENT_TEXT_DOMAIN ) ?>" name="create_cat" />
                            </form>
                        </td>
                    </tr>
                </table>
            </div>

            <div id="reasign_form_panel">
                <h3><?php _e( 'Reassign Files Category', WPC_CLIENT_TEXT_DOMAIN ) ?></h3>
                <form method="post" name="reassign_files_cat" id="reassign_files_cat" >
                    <input type="hidden" name="wpc_action" id="wpc_action3" value="" />
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <label for="old_cat_id"><?php _e( 'Category From', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="old_cat_id" id="old_cat_id">
                                    <?php foreach( $categories as $cat_id=>$value ) { ?>
                                        <option value="<?php echo $cat_id ?>">
                                            <?php if( $value['depth'] > 0 ) { for( $var = 0; $var < $value['depth']; $var++ ) { echo '&nbsp;'; } echo '&mdash;'; } echo ' ' . $value['category_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="new_cat_id"><?php _e( 'Category To', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="new_cat_id" id="new_cat_id">
                                    <?php foreach( $categories as $cat_id=>$value ) { ?>
                                        <option value="<?php echo $cat_id ?>">
                                            <?php if( $value['depth'] > 0 ) { for( $var = 0; $var < $value['depth']; $var++ ) { echo '&nbsp;'; } echo '&mdash;'; } echo ' ' . $value['category_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <br />
                    <input type="button" class="button-primary" name="" value="<?php _e( 'Reassign', WPC_CLIENT_TEXT_DOMAIN ) ?>" id="reassign_files" />
                </form>
            </div>
            <form action="" method="get" name="wpc_files_cstegory_search_form" id="wpc_files_cstegory_search_form">
                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="files_categories" />
                <input type="hidden" name="display" value="old" />
                <?php $ListTable->search_box( __( 'Search Files' , WPC_CLIENT_TEXT_DOMAIN ), 'search-submit' ); ?>
            </form>
            <form action="" method="get" name="edit_cat" id="edit_cat">
                <input type="hidden" name="wpc_action" id="wpc_action2" value="" />
                <input type="hidden" name="cat_id" id="cat_id" value="" />
                <input type="hidden" name="reassign_cat_id" id="reassign_cat_id" value="" />

                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="files_categories" />
                <?php $ListTable->display(); ?>
            </form>
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

                var folder_name          = "";

                jQuery.fn.editGroup = function ( id, action ) {
                    if ( action == 'edit' ) {
                        group_name = jQuery( '#cat_name_block_' + id ).html();
                        group_name = group_name.replace(/(^\s+)|(\s+$)/g, "");

                        folder_name = jQuery( '#folder_name_block_' + id ).html();
                        folder_name = folder_name.replace(/(^\s+)|(\s+$)/g, "");


                        jQuery( '#cat_name_block_' + id ).html( '<input type="text" name="cat_name" size="30" id="edit_cat_name"  value="' + group_name + '" /><input type="hidden" name="cat_id" value="' + id + '" />' );
                        jQuery( '#folder_name_block_' + id ).html( '<input type="text" name="folder_name" size="30" id="edit_folder_name"  value="' + folder_name + '" />' );

                        jQuery( '#edit_cat input[type="button"]' ).attr( 'disabled', true );

                        jQuery( this ).parent().parent().attr('style', "display:none" );
                        jQuery( '#save_or_close_block_' + id ).attr('style', "display:block;" );

                        return;

                    } else if ( action == 'close' ) {
                        jQuery( '#cat_name_block_' + id ).html( group_name );
                        jQuery( '#folder_name_block_' + id ).html( folder_name );

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

                    jQuery( '#wpc_action2' ).val( 'edit_file_cat' );
                    jQuery( '#edit_cat' ).submit();
                };

                //block for delete cat
                jQuery.fn.deleteCat = function ( id, act ) {
                    if ( 'show' == act ) {
                        jQuery( '#cat_reassign_block_' + id ).slideToggle( 'slow' );

                        if( jQuery(this).html() == '<?php _e( 'Cancel Delete', WPC_CLIENT_TEXT_DOMAIN ) ?>' ) {
                            jQuery(this).html( '<?php _e( 'Delete', WPC_CLIENT_TEXT_DOMAIN ) ?>' );
                        } else {
                            jQuery(this).html( '<?php _e( 'Cancel Delete', WPC_CLIENT_TEXT_DOMAIN ) ?>' );
                        }
                    } else if( 'reassign' == act ) {
                        if( confirm("<?php _e( 'Are you sure want to delete permanently this category and reassign all files and parent categories to another category? ', WPC_CLIENT_TEXT_DOMAIN ) ?>") ) {
                            jQuery( '#wpc_action2' ).val( 'delete_file_category' );
                            jQuery( '#cat_id' ).val( id );
                            jQuery( '#reassign_cat_id' ).val( jQuery( '#cat_reassign_block_' + id + ' select' ).val() );
                            jQuery( '#edit_cat' ).submit();
                        }
                    } else if( 'delete' == act ) {
                        if( confirm("<?php _e( 'Are you sure want to delete permanently this category with all files and parent categories? ', WPC_CLIENT_TEXT_DOMAIN ) ?>") ) {
                            jQuery( '#wpc_action2' ).val( 'delete_file_category' );
                            jQuery( '#cat_id' ).val( id );
                            jQuery( '#edit_cat' ).submit();
                        }
                    }
                };

                //Reassign files to another cat
                jQuery( '#reassign_files' ).click( function() {
                    if ( jQuery( '#old_cat_id' ).val() == jQuery( '#new_cat_id' ).val() ) {
                        jQuery( '#old_cat_id' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }
                    jQuery( '#wpc_action3' ).val( 'reassign_files_from_category' );
                    jQuery( '#reassign_files_cat' ).submit();
                    return false;
                });

                jQuery( 'input[name=create_cat]' ).click( function() {
                    if( jQuery( '#cat_name_new' ).val() != '' ) {
                        return true;
                    }
                    return false;
                });



                jQuery( '.wp-list-table').attr("id", "sortable");

                var fixHelper = function(e, ui) {
                    ui.children().each(function() {
                        jQuery(this).width(jQuery(this).width());
                    });
                    return ui;
                };

                jQuery( '#sortable tbody' ).sortable({
                    axis: 'y',
                    helper: fixHelper,
                    handle: '.order',
                    items: 'tr',
                });

                jQuery( '#sortable' ).bind( 'sortupdate', function(event, ui) {

                    new_order = new Array();
                    jQuery('#sortable tbody tr td.order div').each( function(){
                        new_order.push( jQuery(this).attr("id") );
                    });
                    jQuery( 'body' ).css( 'cursor', 'wait' );
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_admin_url() ?>admin-ajax.php',
                        data: 'action=change_cat_order&new_order=' + new_order,
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
            });
        </script>

    </div>

</div>