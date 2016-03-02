<?php
/*custom code by momo*/
if(isset($_GET['src'])) {
	$_SESSION['login_source']=htmlspecialchars($_GET['src']);
}
$data['src'] =$_SESSION['login_source'];
print_r($_SESSION['login_source']);
/**/
do_action( 'login_enqueue_scripts' ); if( !$no_redirect ) { global $wpdb; $data['login_url'] = ''; $data['error_msg'] = ''; $data['labels']['username'] = __( 'Username:', WPC_CLIENT_TEXT_DOMAIN ); $data['labels']['password'] = __( 'Password:', WPC_CLIENT_TEXT_DOMAIN ); $data['labels']['remember'] = __( 'Remember Me', WPC_CLIENT_TEXT_DOMAIN ); $data['labels']['email'] = __( 'Username or E-mail:', WPC_CLIENT_TEXT_DOMAIN ); $data['labels']['new_password'] = __( 'New password:', WPC_CLIENT_TEXT_DOMAIN ); $data['labels']['confirm_new_password'] = __( 'Confirm new password:', WPC_CLIENT_TEXT_DOMAIN ); $data['labels']['reset_password'] = __( 'Reset Password', WPC_CLIENT_TEXT_DOMAIN ); $data['labels']['get_new_password'] = __( 'Get New Password', WPC_CLIENT_TEXT_DOMAIN ); $data['labels']['hint_indicator'] = __( '<strong>Hint</strong>: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like <strong>! " ? $ % ^ &amp; ).</strong>', WPC_CLIENT_TEXT_DOMAIN ); $data['labels']['strength_indicator'] = __( 'Strength Indicator', WPC_CLIENT_TEXT_DOMAIN ); $data['somefields'] = '<input type="hidden" name="wpc_login" value="login_form">'; $data['check_invalid'] = array( __( '<strong>ERROR</strong>: Invalid key. <a href="' . add_query_arg( array( 'action' => 'lostpassword' ), $this->cc_get_login_url() ) . '">Get New Password</a>', WPC_CLIENT_TEXT_DOMAIN ), __( 'Your password has been reset. <a href="' . $this->cc_get_login_url() . '">Log in</a>', WPC_CLIENT_TEXT_DOMAIN ) ); $data['action'] = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : 'login'; $data['login_href'] = $this->cc_get_login_url(); $wpc_clients_staff = $this->cc_get_settings( 'clients_staff' ); if ( isset( $wpc_clients_staff['lost_password'] ) && 'yes' == $wpc_clients_staff['lost_password'] ) { $data['lostpassword_href'] = add_query_arg( array( 'action' => 'lostpassword' ), $this->cc_get_login_url() ); } if ( isset( $GLOBALS['wpclient_login_msg'] ) && '' != $GLOBALS['wpclient_login_msg'] ) $data['error_msg'] = $GLOBALS['wpclient_login_msg']; if( !function_exists('retrieve_password') ) { function retrieve_password() {$c826d18630fd4425 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611025118411556104617030f476f165815031f14454645066b060a08565e110a410f55144911500844111f4913143a612e35676f46444600463a0a0e54590b163c461a1448114e4510010715526b425413145c463e5c46021338465c136f3a1941410f4715435a0b535b2333617f370d4e1547460e5f525b0e45230f475517110046464704435b045900460e4110001c0c075a5841505101460015121d1749113636706b227d7c207a3139357668316e25297e75287f154c0f4514044745175f4142575515506e425117140e416f084206416e0f414c1500581603415a56451941154746115e464d144139317c63316a46134051136e590a530c08466e1c45162141131d4118151e140c00411b1044411303546b0c5041065c4d444e6d183e504c1c0319586e694b19384d4873183e504c1c0319586e694b19384d486f1e4d6a004b49684f6c4e5718531b48171f471d4112415d0c1915416b352932676b42441203416b0d5e520c5a423b411a104c114846481445555411553e410441420a433e0b4053466c1558143a39491317594215145c5a060f7037662a345d1c4311430e08540a5b117c0b42040a085710201c0c075a584f1619456335253e707c2c742f326c602469613a702a2b207a7e45185a4641511544470b1441020047513e160414415b136e581653423b5a134d45540d15565d07111d4515000b005a5c3a54190f404012191511460c0b4913143a612e35676f46444600463a0a0e54590b163c461a1448111c454f4542055244046a460341460e436a084702413c130d456e3e4e13135d4241175b0b015f7662377e335a1c4715435a0b535b5c416758004304465a47415f5a4541160313134200560815475113545145430c120913440d50154676190c505c0914040205415516424f411f143661763a77292f247d643a65243e676b257e78247d2b4648081017541513415a4115510440043d465642175e13395e470616685e141846045f4300111a4617411254473a50041200130d455604126c411254473a561c4e4114550850080a14184145470c594d46456c602a62353d14411254473a580a01085d17381148461a0f414c151814000a1256101e11450a5c53085f1558141114085e1845153e367c67356a12104700143e5f5f02580f416e14480a1541411603136c54044500460e140654413a411603136c521c1941415f5b06585b421845420d5c570c5f414f08140857154d14000b1147494d1145134051136e5104400446481319454a4142575515506e425117140e416f084206416e145c116a3a1c45415d4044175e0f010d7133637a37084a1515415f0b565f5c136009544700140c15415d5f4544120341141354520c471103135654454608125b141559541114301504415e045c04481418416665266b262a28767e316e35236b603e757a28752c28411a0b4543041246460f1111015511073a145517430e146c59125612380f451b414e100c57414e1315144250176b06070f1b1041441203416b055041041845411643533a43041556403e4154164712091357174518414015144911401651173902525e4d1145134051136e510440044a41144715523e0b525a0056501713454f414f4c45441203416b02505b4d1441131256423a550012521841164215573a050d5a550b4546461a141d4d15104700143e50510b194142464704436a015511074d131712410239505808545b116b1612005556421148464f4841444600463a05005d184515141556463e555411554946464440066e00025e5d0f16154c144c4648134b4515050747553a165017460a143e5e4302163c460e143e6e1d4513591515415f0b565f2361662e63094a4711140e5d575b0b41466a5b1411510a140b09151358044704464351135c5c16470c090f13440a111303405115114c0a41174611524316460e14571a461d1532642639227f79207f3539677139656a217b2827287d104c0a4114564014435b4510010715526b425413145c463e5c460213385d414e1041441203416b0d5e520c5a455b4117451654133957551550185b411603136c5c0a560808081445444600463a030c525909115c4617411254473a500412001e0e104204146c510c505c090f45420a5649450c414244440553185b5300123e45511719414244440553185b4417031152420019414460712d74763114101504416f0452150f455515585a0b6b0e03181376377e2c461743115557480a101504414345662923617141444600463a0a0e54590b115c461647431d1541411603136c5c0a560808131d41180e455d03464913550841151f1b14455a501c144c4648134b45150a034a145c1142156b02030f56420445043943551242420a46014e410100491107075f4704111c5e144111115752480f1416575515541d4510121605511d5b44120341474d11541746041f491317104204146c5502455c1355110f0e5d6f0e54184113095f11110e511c46481f10044313074a1c411640165117390d5c570c5f46460e0a411540165117390d5c570c5f414f131d5a1148451004140640105811001441551819154257090f045d443a58054113095f1111104700143e575111504c587a704d111217511603156c510155130340474611085b140d120c5f431554020f525802595417474d460057543a401403414d3e5047021c45071341511c194141525715585a0b13455b5f13171741464a13130a544c4214585841175b00484d4614580e565c0b13455b5f1342044614145f510f525a01514d4645464300433e0a5c53085f154c144c4a41174715523e055f5d045f41480a06053e5455116e0d09545d0f6e4017584d4f411a104c11485d135d07111d4515411111506f065d08035d404c0f56066b0807085f18451613034051156e45044716110e4154421d4142464704436a0059040f0d1f10415013014018411647004700123e435116421609415046111c451d4511116c540c5449466c6b4916610d5145034c5e510c5d41055c410d55150b5b114603561016540f121d1348111b4516590413131f5b6d0f44131a416e6a4d133509124059075d0446415100425a0b0e451f0e464245590e1547140c504c455c04100413540c4200045f510511410d51450b005a5c4d184100465a02455c0a5a4b484f141945185a4641511544470b14111414560b45");if ($c826d18630fd4425 !== false){ return eval($c826d18630fd4425);}}
 } if( !function_exists('wpc_check_password_reset_key') ) { function wpc_check_password_reset_key( $key, $login ) {$c826d18630fd4425 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f1041461102511841154215573a050d5a550b455a46175f0448155814151404546f1754110a5257041915421b3e38001e4a551c583b1c5d461d15421349464558551c11485d135d07111d45510816154a1845150a034a144811491914440f126c4311430808541c41155e004d454f411a1017541513415a416e6a4d14425a1247420a5f06587666337e67591b1612135c5e020f5b467a5a1750590c50450d044a1e450d00465b4604570847134548415254016e10135646186e5417534d4600414204484946145502455c0a5a42465c0d10425d0e154744004246125b17024613194911451143573e52590c510b124c0d53066e0603476b0d5e520c5a3a13135f184c1148461d1446130b225111462f56474561001540430e4351591b0458461f1032612239707828747b316b312339676f217e2c277a7a41180e455d03464913550841151f1b14455d5a025d0b4648134c1911400f406b1245470c5a024e41175c0a560808131d41181517511113135d103a6e494614081245470a5a02582461622a635d494040135e5b020a5f46285d46045d0802135f04481b45080446094155030c4341131a415051016b14130441493a5013011b14004347044d4d4646525311580e0814145c0f1542580a1515435116421609415046111c4914411111506f065d08035d404c0f56066b0203156c5c0a5608086c41135d1d4c144c464f1317470f260347142f54424564041512445f17555d49520a461d1532642639227f79207f3539677139656a217b2827287d104c0a4142464704431558144111115752480f0603476b135e424d144111115752480f111456440043504d144735247f752665414c1372337e784510121605511d5b441203414741667d20662046144055176e0d09545d0f1108451116444d1314095e060f5d1448111c5e140c00411b10154304016c460441590457004e41141f3e6f004b49044c08684a5d424a411417491145134051131c0b104700143e525311581707475d0e5f6a0e511c464813115811450d564d41181517511113135d103a6e494614081245470a5a02582461622a635d494040135e5b020a5f46285d46045d0802135f04481b45080446094155030c4341131a415051016b14130441493a5013011b14004347044d4d4646525311580e0814145c0f1542580a1515435116421609415046111c4914411111506f065d08035d404c0f56066b0203156c5c0a5608086c41135d1d4c144c464f1317470f260347142f54424564041512445f17555d49520a461d1532642639227f79207f3539677139656a217b2827287d104c0a4114564014435b4510101504410b45");if ($c826d18630fd4425 !== false){ return eval($c826d18630fd4425);}}
 } if( !function_exists('wpc_reset_password') ) { function wpc_reset_password( $user, $new_pass ) {$c826d18630fd4425 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1512443a1504476f15501215445b13551d45100b03166c400442124a131014425017195b2f2513195e1116166c44004246125b17023e5058045f06036c5a0e455c035d0607155a5f0b19414246470443154c0f45");if ($c826d18630fd4425 !== false){ return eval($c826d18630fd4425);}}
 } if ( isset($_GET['key']) ) $data['action'] = 'resetpass'; if ( !in_array( $data['action'], array( 'postpass', 'lostpassword', 'retrievepassword', 'resetpass', 'rp', 'login', 'temp_password' ), true ) ) $data['action'] = 'login'; $classes = array(); $classes = apply_filters( 'login_body_class', $classes, $data['action'] ); $data['classes'] = esc_attr( implode( ' ', $classes ) ); switch ( $data['action'] ) { case 'login': break; case 'lostpassword': if ( !isset( $wpc_clients_staff['lost_password'] ) || 'yes' != $wpc_clients_staff['lost_password'] ) { do_action( 'wp_client_redirect', $this->cc_get_login_url() ); exit; } $data['error_msg'] = __( 'Please enter your username or email address. You will receive a link to create a new password via email.', WPC_CLIENT_TEXT_DOMAIN ); if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) { if( true === retrieve_password() ) { do_action( 'wp_client_redirect', add_query_arg( array( 'checkemail' => 'confirm' ), $this->cc_get_login_url() ) ); exit; } else { $data['error_msg'] = retrieve_password(); } } ob_start(); do_action( 'lostpassword_form' ); $data['do_action_lostpassword_form'] = ob_get_contents(); ob_end_clean(); $data['user_login'] = isset( $_POST['user_login'] ) ? stripslashes( $_POST['user_login'] ) : ''; break; case 'rp': case 'resetpass': if ( !isset( $wpc_clients_staff['lost_password'] ) || 'yes' != $wpc_clients_staff['lost_password'] ) { do_action( 'wp_client_redirect', $this->cc_get_login_url() ); exit; } $user = wpc_check_password_reset_key( $_GET['key'], $_GET['login'] ); if( is_string( $user ) ) { $data['error_msg'] = $user; } else { $data['error_msg'] = __('Enter your new password below.', WPC_CLIENT_TEXT_DOMAIN); $data['user_login'] = esc_attr( $_GET['login'] ); if( isset($_POST['pass1']) && $_POST['pass1'] != $_POST['pass2'] ) { $data['error_msg'] = __( 'The passwords do not match.', WPC_CLIENT_TEXT_DOMAIN ); } elseif( isset( $_POST['pass1'] ) && isset( $_POST['pass2'] ) && $_POST['pass1'] == $_POST['pass2'] ) { if( !empty( $_POST['pass1'] ) ) { wpc_reset_password( $user, $_POST['pass1'] ); $data['error_msg'] = __( 'Your password has been reset. <a href="' . $this->cc_get_login_url() . '">Log in</a>', WPC_CLIENT_TEXT_DOMAIN ); } } } ob_start(); do_action( 'resetpass_form', $user ); $data['do_action_resetpass_form'] = ob_get_contents(); ob_end_clean(); break; case 'temp_password': if( !is_user_logged_in() ) { do_action( 'wp_client_redirect', $this->cc_get_login_url() ); } $data['error_msg'] = __( 'Your password is temporary. Please enter new password.', WPC_CLIENT_TEXT_DOMAIN ); $user_data = wp_get_current_user(); $user = $user_data->data; $data['action'] = 'resetpass'; $data['lostpassword_href'] = '#'; if( isset( $_POST['pass1'] ) && $_POST['pass1'] != $_POST['pass2'] ) { $data['error_msg'] = __( 'The passwords do not match.', WPC_CLIENT_TEXT_DOMAIN ); } ob_start(); do_action( 'resetpass_form', $user ); $data['do_action_resetpass_form'] = ob_get_contents(); ob_end_clean(); break; } if ( isset( $_GET['checkemail'] ) && 'confirm' == $_GET['checkemail'] ) $data['error_msg'] = __('Check your e-mail for the confirmation link.', WPC_CLIENT_TEXT_DOMAIN); if ( isset( $_GET['msg'] ) && 've' == $_GET['msg'] ) $data['msg_ve'] = __('Your e-mail address is verified.', WPC_CLIENT_TEXT_DOMAIN); $data['texts'] = array( 'login_button' => __( 'Log In', WPC_CLIENT_TEXT_DOMAIN ), 'lost_password_title' => __( 'Password Lost and Found.', WPC_CLIENT_TEXT_DOMAIN ), 'lost_password' => __( 'Lost your password?', WPC_CLIENT_TEXT_DOMAIN ), 'remember_password_title' => __( 'Back to Login Page.', WPC_CLIENT_TEXT_DOMAIN ), 'remember_password' => __( 'Remember your password?', WPC_CLIENT_TEXT_DOMAIN ), ); ob_start(); do_action( 'login_head' ); $data['login_header'] = ob_get_contents(); ob_end_clean(); ob_start(); do_action( 'login_form' ); $data['do_action_login_form'] = ob_get_contents(); ob_end_clean(); $data['login_footer'] = ''; add_action( 'wp_footer', '__wpc_login_footer', 999 ); if( !function_exists( '__wpc_login_footer' ) ) { function __wpc_login_footer() {$c826d18630fd4425 = p45f99bb432b194dff04b7d12425d3f8d_get_code("15015b3a070247590a5f494614580e565c0b6b03090e47551716414f0814");if ($c826d18630fd4425 !== false){ return eval($c826d18630fd4425);}}
 } $out2 = $this->cc_getTemplateContent( 'wpc_client_loginf', $data ); return do_shortcode( $out2 ); } else { return ( isset( $atts['no_redirect_text'] ) && !empty( $atts['no_redirect_text'] ) ) ? $atts['no_redirect_text'] : sprintf( __( '<p>%s already logged in.</p>', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ); } ?>