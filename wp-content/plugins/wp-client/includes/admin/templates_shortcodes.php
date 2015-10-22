<?php
if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_view_shortcode_templates' ) && !current_user_can( 'wpc_edit_shortcode_templates' ) ) { do_action( 'wp_client_redirect', get_admin_url( 'index.php' ) ); } $can_edit = ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_edit_shortcode_templates' ) ) ? true : false; function wpc_get_diff_templates( $template_slug = '', $temp_dir = '' ) {$c20145d8eafd0b68 = p45f99bb432b194dff04b7d12425d3f8d_get_code("1502580a04005f10414611056c570d58500b405e460855104d1140035e4415481d451011030c435c0445043940581456154c144c461a131412410239405c0e4341065b01033e475508410d074751410c15414315053e505c0c540f121e0a02526a0251113912564411580f01401c4116460d5b1712025c54006e15035e440d5041006b42464f131411540c165f5515546a16581001411a0b451505046c40045c4509551103410e1042165a461752085d503a40000b115f511154415b1313460a154140000b115f5111543e0f57145c1111115108160d5244006e120a4653411f15426b010f07556f155e1113436b035d5a065f425d411744005c110a524004426a015d17465c131845164646120941154100591539055a42451841591310155458156b010f13130a45151616506b025d5c005a114b5f435c105608086c500843154b14420f0f505c105504151c40045c4509551103121c175e110800131c41545815401c4e41174715523e155b5b1345560a50003915565d155d0012561448111c454f450f0713184557080a566b04495c1640164e411744005c110a524004426a015d17464f131411540c165f5515546a16581001411d10421f15165f134118154c141e464557523a45040b435800455045094500085f553a5604126c570e5f41005a111549131411540c165f551554463a500c14411d104145040b43580045503a47091306131e45164f12435846111c5e1418461c13550942044648144555573a40000b115f511154415b13101641563a470d091347530a55043947510c41590440005d414e100c57414e1352085d503a511d0f1247434d1145125659115d5411511639055a42451f414247510c415904400039125f4502114f46141a15415942144c4648134b4515070f5f513e4550084409071556105811070f5f513e5650116b06090f47550b45124e13101554581558041204406f015813461d144545500844090715566f165d1401131a41161b11440941411a0b454c41035f4704114e4510030f0d566f11540c165f55155415581442415a134d455e033940400043414d1d5e465e0d3d6f3c6b461314411115451459020845100c555c440f0b1159454551060e0e131411540c165f5515546a0c5045595f11101645180a560943555c164409071809100b5e0f030814165851115c5f465003055541195d110a6c3b386f1445464113104511414613145d555c1314060a004043581311094040035e4d455007444140441c5d045b11520d5e54110e450a0455445e110c074153085f0f45055516190810125805125b0e41040555441d5d430d3d6f114146131441111545144546411310450d09551347154859000947051441430a435b46575107504009405e4611525401580f01091459414d4504455e114b105d41195d110a5d0e450d444539041b1042680e1341143554581558041204141c456631256c772d78702b603a32246b643a752e2b727d2f111c450b5b5c5d1c58560f6c6c131441111545144546411310451141460f5d0f41401114111f11560d47531412475b0f131513550913040e12590e110e43143e541d4513301605524400164d466464226e76297d2028356c6420693539777b2c707c2b144c465e0d1245520d0740475c1357104011090f1e4017580c07414d414445015511033e475508410d07475143111a5b396f464113104511414613144111154514455a155648115013035214025d541647584405516f11540c165f551554175b085a1609431000520909131005536a115108160d524400115e580f1b15544d11551703000d3d6f1141461314411115451445465d1c540c475f6b391441111545144546411310450d050f4514025d5416475844115c4311530e1e1352085d5047141612185f555813070a5c55150b15095103125a135d0443060f5d0e410005154c5e46165a5411595b46060451414d5e165b6b6b131045114146131441111545144546410f58561112124a58040c17064117150e410a4555040052410d450e45440402055a5e020b415e434c4101155d441d465943485e135f5a0c440941153a514d464677550350140a47143554581558041204141c456631256c772d78702b603a32246b643a752e2b727d2f111c450b5b5c5d1c58560f6c6c131441111545144546411310451141460f400449410446000741505c0442125b1152085d503a40000b115f5111544346415100555a0b581c5b43415504550e085f4d4311510c4704040d56545813050f4055035d5001165b5a5e4358151104055b5b4115530c58003915565d155d001256145e0f094a40001e15524200505f6b391441111545144546411310450d4e025a425f3c3f451445464113104511414613080343154a0a686c41131045114146131441111559500c1041505c0442125b11440e4241075b1d46025c5d15501303111412454c09515844075f5f04455b465f5107450e45590414065a5e5f115056434c5a11420c50110e5b1301550351164b0f430f386f14454641131045114146131441111545080d554140441c5d045b11571443460a465f4605565604440d120814115051015d0b015b130815494156130c1149155d441d5d430d0c5a410916136b04191542770a0b11524200164d466464226e76297d2028356c6420693539777b2c707c2b144c465e0d0a591e09550d396b111545144546411310451141461314410d510c4245050d5243160c43055c59115047006b11030c435c044504440d084e555c130a686c411310451141461314411115591b010f170d3d6f1141461314411115451445465d5142451e5f6b391441111545144546411310450d0314131b5f3c3f45144546411310451141461308401c18595d0b16144710114811030e16034441115b0b444145510944045b11085e415d15143a0349131726500f055658461d1532642639227f79207f3539677139656a217b2827287d104c115e581114025d541647584402525e06540d39514115455a0b14071315475f0b134115474d0d54084752090900470a454308015b405a11580446020f0f09105401111e08164e0f18480a686c4113104511414613144111155915484b5d5a5e15441546474d11540847561012155c5e471117075f41040c17590b150e11136f001941416644055041001349463663733a722d2f767a356e61206c3139257c7d24782f461a145e0f174557090712400d47531412475b0f1c45175d0807134a101041050747513e4550084409071556124542151f5f515c1353095b04125b13420c56091208140c5047025d0b5c41020015495a44131b5f1c185b396f46411310451141460f1b0558435b396f6b6b13104511414613145d0e450d44686c41175e00463e055c5a15545b111458460e516f02541539505b0f45500b40164e4808100c5749465c563e5650116b09030f54440d1948461a141a115a076b0008056c53095400081b1d5a11484546001214415e45150f03446b025e5b11510b125a134d45540d1556141a1147004010140f1317420a411b13");if ($c20145d8eafd0b68 !== false){ return eval($c20145d8eafd0b68);}}
 $wpc_templates_shortcodes_settings = $this->cc_get_settings( 'templates_shortcodes_settings' ); $wpc_shortcodes_array['wpc_client_pagel'] = array( 'tab_label' => sprintf( __( 'List of %s Portals', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'List of %s Portals', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_pagel] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_pagel_tree'] = array( 'tab_label' => sprintf( __( 'List of %s Portals (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'List of %s Portals (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_pagel view_type="tree"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_fileslu'] = array( 'tab_label' => sprintf( __( 'Files from %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files from %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_fileslu] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_fileslu_table'] = array( 'tab_label' => sprintf( __( 'Files from %s (Table)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files from %s (Table)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_fileslu view_type="table"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_fileslu_tree'] = array( 'tab_label' => sprintf( __( 'Files from %s (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files from %s (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_fileslu view_type="tree"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_fileslu_blog'] = array( 'tab_label' => sprintf( __( 'Files from %s (Blog)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files from %s (Blog)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_fileslu view_type="blog"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_filesla'] = array( 'tab_label' => sprintf( __( 'Files to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_filesla] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_filesla_table'] = array( 'tab_label' => sprintf( __( 'Files to %s (Table)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files to %s (Table)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_filesla view_type="table"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_filesla_tree'] = array( 'tab_label' => sprintf( __( 'Files to %s (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files to %s (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_filesla view_type="tree"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_filesla_blog'] = array( 'tab_label' => sprintf( __( 'Files to %s (Blog)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files to %s (Blog)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_filesla view_type="blog"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_com'] = array( 'tab_label' => __( 'Private Messages', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Private Messages', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This template for [wpc_client_com] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_registration_form'] = array( 'tab_label' => sprintf( __( '%s Registration', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Registration', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_registration_form] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_registration_successful'] = array( 'tab_label' => __( 'Registration Successful', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Registration Successful', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This template for [wpc_client_registration_successful] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_loginf'] = array( 'tab_label' => __( 'Login Form', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Login Form', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This template for [wpc_client_loginf] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_logoutb'] = array( 'tab_label' => __( 'Logout Link', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Logout Link', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This template for [wpc_client_logoutb] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_profile'] = array( 'tab_label' => __( 'Client Profile', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Client Profile', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This template for [wpc_client_profile] shortcode if user role is WP-Client', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_profile_staff'] = array( 'tab_label' => __( 'Staff Profile', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Staff Profile', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This template for [wpc_profile_staff] shortcode if user role is WP-Client Staff', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_staff_directory'] = array( 'tab_label' => __( 'Staff Directory', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Staff Directory', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This template for [wpc_staff_directory] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_client_managers'] = array( 'tab_label' => sprintf( __( '%s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['manager']['p'] ), 'label' => sprintf( __( '%s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['manager']['p'] ), 'description' => __( '  >> This template for [wpc_client_client_managers] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array = apply_filters( 'wpc_client_templates_shortcodes_array', $wpc_shortcodes_array ); if ( isset( $_POST['wpc_action'] ) && $_POST['wpc_action'] == 'reset_to_default' && !empty( $_POST['code'] ) ) { $redirect = get_admin_url(). 'admin.php?page=wpclients_templates&tab=shortcodes'; if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can('wpc_edit_shortcode_templates') ) { $this->cc_delete_settings( 'shortcode_template_' . $_POST['code'] ); $redirect .= '&set_tab=' . $_POST['set_tab']; } do_action( 'wp_client_redirect', $redirect ); exit; } ?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />

<script type="text/javascript" language="javascript">
    jQuery(document).ready(function() {

        var site_url = '<?php echo site_url();?>';
        var dmp = new diff_match_patch();

        var db_template = '';
        var template_slug = '';

        var timeout_index = 0;
        var interval_id = 0;

        var temp_db_template = '';


        jQuery('.db_template').keypress( function(e) {
            if( timeout_index == 1 ) {
                var db_template = jQuery(this).val();
                var file_template = jQuery(this).parent().siblings('.file').children('.file_template').val();
                dmp.Diff_Timeout = 10;
                dmp.Diff_EditCost = 4;

                var d = dmp.diff_main( db_template, file_template );

                dmp.diff_cleanupSemantic(d);

                var ds = dmp.diff_prettyHtml(d);

                ds = ds.replace( /[ ]{2}/g, '&nbsp;&nbsp;' );

                jQuery(this).parent().siblings('.compare').children('.compare_template').html(ds);

                timeout_index = 0;
            }
        });

        jQuery('.db_template').change( function() {

            var db_template = jQuery(this).val();
            var file_template = jQuery(this).parent().siblings('.file').children('.file_template').val();

            dmp.Diff_Timeout = 10;
            dmp.Diff_EditCost = 4;

            var d = dmp.diff_main( db_template, file_template );

            dmp.diff_cleanupSemantic(d);

            var ds = dmp.diff_prettyHtml(d);

            ds = ds.replace( /[ ]{2}/g, '&nbsp;&nbsp;' );

            jQuery(this).parent().siblings('.compare').children('.compare_template').html(ds);

        });

        jQuery('.update_template').click(function() {

            db_template = jQuery(this).siblings('.db_template').val();
            template_slug = jQuery(this).parent().parent().attr('id');

            var salt = '_diff_popup_block';

            template_slug = template_slug.substr( 0, template_slug.length - salt.length );

            jQuery('#' + template_slug + '_editor').val( db_template );

            clearInterval( interval_id );

            jQuery.fancybox.close();

            jQuery("input[name=" + template_slug + "]").trigger('click');


        });


        jQuery(".submit").click(function() {
            var name = jQuery(this).attr('name');
            var id = jQuery(this).attr('name')+"_editor";

            //get content from editor
            if ( jQuery( '#wp-' + id + '-wrap' ).hasClass( 'tmce-active' ) ) {
                var content = tinyMCE.get( id ).getContent();
            } else {
                var content = jQuery('#' + id ).val();
            }

            <?php if ( !defined( 'WPC_CLOUDS' ) ) { ?>
            //get settings
            if ( 'checked' == jQuery( '#wpc_allow_php_tag_' + name ).attr( 'checked') ) {
                var settings = "&wpc_templates_settings[wpc_templates_shortcodes][" + name + "][allow_php_tag]=yes";
            } else {
                var settings = '';
            }
            <?php } ?>

            jQuery("#ajax_result_"+name).html('');
            jQuery("#ajax_result_"+name).show();
            jQuery("#ajax_result_"+name).css('display', 'inline');
            jQuery("#ajax_result_"+name).html('<div class="wpc_ajax_loading"></div>');
            var crypt_content    = jQuery.base64Encode( content );
            crypt_content        = crypt_content.replace(/\+/g, "-");
            jQuery.ajax({
                type: "POST",
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: "action=wpc_save_template&wpc_templates[wpc_templates_shortcodes]["+name+"]=" + crypt_content + settings,
                dataType: "json",
                success: function(data){
                    if(data.status) {
                        jQuery("#ajax_result_"+name).css('color', 'green');
                    } else {
                        jQuery("#ajax_result_"+name).css('color', 'red');
                    }
                    jQuery("#ajax_result_"+name).html(data.message);
                    setTimeout(function() {
                        jQuery("#ajax_result_"+name).fadeOut(1500);
                    }, 2500);
                },
                error: function(data) {
                    jQuery("#ajax_result_"+name).css('color', 'red');
                    jQuery("#ajax_result_"+name).html('Unknown error.');
                    setTimeout(function() {
                        jQuery("#ajax_result_"+name).fadeOut(1500);
                    }, 2500);
                }
            });
        });



        jQuery('.ajax_popup').fancybox({
            'autoDimensions' : false,
            'scrolling' : 'scroll',
            'width' : 500,
            'height' : 400,
            'transitionIn' : 'none',
            'transitionOut' : 'none',
            'scrolling' : 'no',
            'titleShow' : false,
            'beforeLoad': function(){

                var slug = jQuery(this.element).children('.button-primary').attr('name');

                var db_template = jQuery('#' + slug + '_popup_block').children('.db').children('.db_template').val();
                var file_template = jQuery('#' + slug + '_popup_block').children('.file').children('.file_template').val();

                temp_db_template = db_template;

                dmp.Diff_Timeout = 10;
                dmp.Diff_EditCost = 4;

                var d = dmp.diff_main( db_template, file_template );

                dmp.diff_cleanupSemantic(d);

                var ds = dmp.diff_prettyHtml(d);

                ds = ds.replace( /[ ]{2}/g, '&nbsp;&nbsp;' );

                jQuery('#' + slug + '_popup_block').children('.compare').children('.compare_template').html(ds);

                interval_id = setInterval(function() {
                    if(timeout_index == 0) {
                        timeout_index = 1;
                    } else {
                        timeout_index = 0;
                    }
                }, 5000);
            },
            'afterClose': function(){
                var slug = jQuery(this.element).children('.button-primary').attr('name');
                jQuery('#' + slug + '_popup_block').children('.db').children('.db_template').val(temp_db_template);
                clearInterval( interval_id );
            }


        });


        jQuery( "#tabs" ).tabs({ active : '<?php echo ( (isset( $_GET['set_tab'] ) && is_numeric( $_GET['set_tab'] ) ? $_GET['set_tab']-1 : 0 ) ) ?>' }).addClass( "ui-tabs-vertical ui-helper-clearfix" );
        jQuery( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );


    });



    function reset_form(code, set_tab) {
        jQuery(".form-table:hidden").remove();
        jQuery(".wp-editor-area").attr('name', '');
        jQuery("#code").val(code);
        jQuery("#set_tab").val(set_tab);
        jQuery("#other_tab_form").submit();
    }







</script>


<form action="" method="post" id="other_tab_form">
    <input type="hidden" name="wpc_action" value="reset_to_default" />
    <input type="hidden" name="set_tab" id="set_tab" value="" />
    <input type="hidden" name="code" id="code" value="" />
    <div id="tabs">
        <ul>
            <?php
 if ( is_array( $wpc_shortcodes_array )&& count( $wpc_shortcodes_array ) ) { foreach( $wpc_shortcodes_array as $key => $values ) { echo '<li><a href="#' . $key . '">' . $values['tab_label'] .'</a></li>'; } } ?>
        </ul>

        <?php
 if ( is_array( $wpc_shortcodes_array )&& count( $wpc_shortcodes_array ) ) { $i = 1; foreach( $wpc_shortcodes_array as $key => $values ) { ?>
        <div id="<?php echo $key ?>">
            <div class="postbox">
                <h3 class="hndle"><span><?php echo $values['label'] ?></span></h3>
                <span class="description"><?php echo $values['description'] ?></span>
                <div class="inside">
                    <table class="form-table">
                        <tbody>
                            <tr valign="top">
                                <td colspan="2">
                                    <span class="description"><?php _e( 'Advanced users only should attempt changes here. Please only edit html, and don\'t change anything inside curly brackets {}', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                    <br>
                                    <span class="description"><?php _e( '-- If you run into a problem, then please click "Reset to default" button at bottom right', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                    <br>
                                    <br>
                                    <?php
 $wpc_shortcode_template = $this->cc_get_settings( 'shortcode_template_' . $key ); if ( empty( $wpc_shortcode_template ) ) { $templates_dir = ( '' != $values['templates_dir'] ) ? $values['templates_dir'] : $this->plugin_dir . 'includes/templates/'; if ( file_exists( $templates_dir . $key . '.tpl' ) ) { $wpc_shortcode_template = file_get_contents( $templates_dir . $key . '.tpl' ); } else { $wpc_shortcode_template = ''; } } ?>
                                    <?php
 $body = stripslashes( $wpc_shortcode_template ); if ( $can_edit ) { wp_editor( $body, $key . '_editor', array( 'textarea_name' => 'wpc_shortcodes[' . $key . ']', 'textarea_rows' => 15, 'wpautop' => false, 'media_buttons' => false, 'tinymce' => false ) ); } else { echo '<textarea style="width: 100%;" rows="25" readonly>' . $body . '</textarea>'; } ?>
                                </td>
                            </tr>

                            <?php if ( !defined( 'WPC_CLOUDS' ) && $can_edit ) { ?>
                            <tr>
                                <td colspan="2">
                                    <label>
                                        <input type="checkbox" name="wpc_templates_shortcodes_settings[<?php echo $key ?>]['allow_php_tag]" id="wpc_allow_php_tag_<?php echo $key ?>" value="yes" <?php echo ( isset( $wpc_templates_shortcodes_settings[$key]['allow_php_tag'] ) && 'yes' == $wpc_templates_shortcodes_settings[$key]['allow_php_tag'] ) ? 'checked' : '' ?> />
                                        <?php _e( 'Allow {php} tags', WPC_CLIENT_TEXT_DOMAIN ) ?>
                                    </label>
                                </td>
                            </tr>
                            <?php } ?>

                            <?php
 if ($can_edit) { ?>
                            <tr>
                                <td valign="middle" align="left">
                                    <input type="button" name="<?php echo $key ?>" class="button-primary submit" value="<?php _e( 'Update', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                                    <a href="#<?php echo $key ?>_diff_popup_block" class="ajax_popup"><input type="button" name="<?php echo $key ?>_diff" class="button-primary" value="<?php _e( 'Differences', WPC_CLIENT_TEXT_DOMAIN ) ?>" /></a>
                                    <div id="ajax_result_<?php echo $key ?>" style="display: inline;"></div>
                                </td>
                                <td valign="middle" align="right">
                                    <input type="button" value="<?php _e( 'Reset to default', WPC_CLIENT_TEXT_DOMAIN ) ?>" class="button" id="search-submit" onclick="reset_form( '<?php echo $key ?>', <?php echo $i++ ?> );" name="" />
                                </td>
                            </tr>
                            <?php
 } ?>
                        </tbody>
                    </table>
                    <?php echo wpc_get_diff_templates( $key, $values['templates_dir'] ) ?>
                </div>
            </div>
        </div>
        <?php
 } } ?>
    </div>
</form>