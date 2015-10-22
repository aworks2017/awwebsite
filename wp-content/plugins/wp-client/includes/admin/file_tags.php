<?php
global $wpdb; if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=files_tags'; } if( !empty( $_POST['wpc_action'] ) ) { switch( $_POST['wpc_action'] ) { case 'reassign_tag': $file_ids = $wpdb->get_col("SELECT DISTINCT object_id
                FROM {$wpdb->term_relationships}
                WHERE term_taxonomy_id = '" . $wpdb->_real_escape( $_POST['old_tag_id'] ) . "' AND object_id NOT IN (
                    SELECT DISTINCT object_id
                    FROM {$wpdb->term_relationships}
                    WHERE term_taxonomy_id = '" . $wpdb->_real_escape( $_POST['new_tag_id'] ) . "'
                )"); $wpdb->delete( $wpdb->term_relationships, array( 'term_taxonomy_id' => $_POST['old_tag_id'] ) ); foreach( $file_ids as $val ) { $wpdb->insert( $wpdb->term_relationships, array( 'term_taxonomy_id' => $_POST['new_tag_id'], 'object_id' => $val ) ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'rat', $redirect ) ); break; case 'create_file_tag': $term = $_POST['tag_name_new']; if ( !strlen( trim( $term ) ) ) do_action( 'wp_client_redirect', add_query_arg( 'msg', 'wt', $redirect ) ); if ( !$term_info = term_exists($term, 'wpc_file_tags') ) $term_info = wp_insert_term($term, 'wpc_file_tags'); else do_action( 'wp_client_redirect', add_query_arg( 'msg', 'aet', $redirect ) ); do_action( 'wp_client_redirect', add_query_arg( 'msg', 'st', $redirect ) ); break; } } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $ids = array(); if ( isset( $_GET['tag_id'] ) ) { check_admin_referer( 'wpc_file_tag_delete' . $_GET['tag_id'] . get_current_user_id() ); $ids = (array) $_GET['tag_id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __( 'Tags', WPC_INV_TEXT_DOMAIN ) ) ); $ids = $_REQUEST['item']; } if ( count( $ids ) && ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_delete_file_tags' ) ) ) { foreach ( $ids as $tag_id ) { wp_delete_term( $tag_id, 'wpc_file_tags' ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } $where_search = ''; $where_manager = ''; if ( isset( $_REQUEST['s'] ) && '' != $_REQUEST['s'] ) { $search = strtolower( trim( $_REQUEST['s'] ) ); $where_search = " AND
        LOWER( t.name ) LIKE '%" . $search . "%'
    "; } $order_by = 'tt.term_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'name' : $order_by = 't.name'; break; case 'count' : $order_by = 'count'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_clients = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'client' ); $manager_circles = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); $client_files = $this->cc_get_assign_data_by_assign( 'file', 'client', $manager_clients ); $circle_files = $this->cc_get_assign_data_by_assign( 'file', 'circle', $manager_circles ); $files = array_merge( $client_files, $circle_files ); $files = array_unique( $files ); if ( current_user_can( 'wpc_view_admin_managers_files' ) ) { $ids_files_manager = $wpdb->get_col( "SELECT id FROM {$wpdb->prefix}wpc_client_files WHERE page_id = 0 OR id IN('" . implode( "','", $files ) . "')" ) ; } else { $ids_files_manager = $wpdb->get_col( "SELECT id FROM {$wpdb->prefix}wpc_client_files WHERE user_id = " . get_current_user_id() . " OR id IN('" . implode( "','", $files ) . "')" ); } $where_manager = " AND tr.object_id IN('" . implode( "','", $ids_files_manager ) . "')" ; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_File_Tags_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $columns = array(); var $bulk_actions = array(); function __construct( $args = array() ){$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("154155170112130d4546113943551342503a551701121b1041501301401841504717551c4e4114430c5f06135f55131615580a45393e1b10425815035e134d116235773a252d7a752b653e32766c356e712a79242f2f1319491146165f4113505942145858416c6f4d11460f47510c421249143236226c7329782428676b35746d316b21292c72792b11484a1313005b541d13455b5f1356045d1203131d41180e4510110e08401d5b5f0e395a40045c463a59001512525700115c4617551356463e13150a14415109163c461d14461112451a45393e1b10425f0e1213520e445b011a424a416460266e222a7a712f656a31713d323e777f28702828131d5a11450446000815090a3a6e02095d4715434006404d464552420242414f0814");if ($ce221767bb78647b !== false){ eval($ce221767bb78647b);}}
 function __call( $name, $arguments ) {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d1006500d0a6c411254473a521008026c511743001f1b14004347044d4d464547580c424d46175a005c50451d494645524202440c035d4012111c5e14");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function prepare_items() {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541570a0a145e5e16115c461740095846480a0203156c530a5d140b5d4749180e45100d0f0557550b115c46524613504c4d1d5e4645405f174500045f51410c1541400d0f121e0e02541539405b13455407580039025c5c105c0f151b1d5a1111115c0c154c0d6f065e0d135e5a3e59500450001412130d45501314524d491111065b09130c5d434911450e5a5005545b491441150e414404530d03131d5a11");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function column_default( $item, $column_name ) {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d4608404300454946175d1554583e1441050e5f45085f3e085259041168451d454f41481017541513415a41155c1151083d4117530a5d140b5d6b0f50580014385d414e10005d1203134f414350114117084114175e111c46");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function no_items() {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("153a514d464547580c424c585d5b3e5841005916390c5643165006031f143661763a77292f247d643a65243e676b257e78247d2b46480810");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function set_sortable_columns( $args = array() ) {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("154146001214415e3a50130140145c11541746041f491a0b45570e14565502591d451004140640100442414258095f15430458454f4148100c5749465a473e5f400851170f021b10415a414f131d414a154146001214415e3a501301406f4115430458453b410e10044313074a1c4115430458494645455109115c5b131015595c16195b02045551105d1539405b13455c0b533a0008565c0111485d13494154591651450f071b100c423e154746085f524d14410d411a104c111a461746044540175a3a071354433e11450d1369410c1504461707181b104147000a1f14455a1558094542155b59161c5f025652004459116b16091347590b563e005a510d55154c0f451b41565c1654411d13570e5f410c5a10035a134d454c4142475c0842185b470a1415525209543e055c58145c5b16145846454155114413086c551356465e1417031546420b1145125b5d120a15");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function get_sortable_columns() {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f425a174004040d566f065e0d135e5a120a15");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function set_columns( $args = array() ) {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("150c524d46025c450b4549461740095846480a07130d586f0452150f5c5a12111c451d451d411751175612460e14004347044d3a0b04415700194107414600481d4513060446130d5b11465a5a5a11444145401c16040e120659040558560e4917451b5b41411a1c45150014544741180e45494542155b59161c5f055c58145c5b1614584645524202425a4641511544470b144112095a435e11");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function get_columns() {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f525a09410808120810");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function set_actions( $args = array() ) {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e0452150f5c5a1211084510041406400b4543041246460f1111115c0c155a13");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function get_actions() {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5056115d0a08120810");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function set_bulk_actions( $args = array() ) {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541400d0f121e0e07440d0d6c5502455c0a5a16465c131404430615081413544110460b464547580c425a46");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function get_bulk_actions() {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f5340095f3a070247590a5f125d13");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function column_cb( $item ) {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d101641130f5d4007191542080c0811464445451816560943525d00570e040e4b12455f000b560943584100593e3b431346045d14030e16445517451b5b414d13140c45040b681308551238144c5d41");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function column_name( $item ) {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1541550612085c5e16115c46524613504c4d1d5e460855184515081256593a16560a410b12466e105b1151461a141a11110457110f0e5d433e16170f5643466c155814425a001353095012150e161750470c5b1015431344044306034709436e5709550b0d4313581754075b1155055c5c0b1a150e110c400456045b4444025d5c005a11153e505f0b450408471215505758520c0a0440160659000854513e575c094000145c47510217070f5f4004436a1155025b46131e4515081256593a165c011338464f13174711150f4758040c1747145b41411d103a6e494614620854424218453131706f267d28237d603e65703d603a222e7e712c7f414f1d14460d1a040a425d414e100c57414e1357144347005a1139144055176e02075d1c41164215573a07055e590b16414f13481d1156104617030f476f104204146c57005f1d451304020c5a5e0c42151452400e4312451d451a1d1353104313035d403e444600463a05005d1845161616506b05545900400039075a5c006e1507544746111c451d451d411751064508095d473a16510058001204146d450c41410f55415e5b06580c050a0e6c4243041246460f11560a5a030f135e1847164148136b3e191542751703414a5f10111213415141485a101412070f4710115e4102565804455045400d0f1213560c5d04464755060e1249143236226c7329782428676b35746d316b21292c72792b1148461d1446131c5e684246094155030c43075759085f1b155c1559115257000c1616505808545b11473a050e5d44005f15404755030c530c5800153e4751024247075040085e5b5850000a044755434500016c5d050c12451a4542084755086a460f57133c111b4513433916435e0a5f02030e13411f1512443a0513565111543e085c5a02541d45131216026c560c5d04394755066e51005800120414104b11450f47510c6a120c50423b411d100254153950411343500b403a131256423a58054e1a1448111b4513433916436f0d4515166c460457501751175b46131e4544130a565a025e51001c451515415915420d07405c04426a015100164913143a6224346571336a12377134332460643a64332f14694118154c144b464611105b164148136b3e19154270000a044755456104145e550f545b11581c414d136735723e257f7d247f613a60203e356c742a7c202f7d1448111b45135949000d175e111c4641511544470b141616135a5e11574941160545421540064115461f10420d1216525a41585158161216026c560c5d04394755066e12451a4542084755086a460f57133c111b4513475846131e4515081256593a165b045900413c131e45165d494044005f0b42184542155b59161c5f145c433e5056115d0a08121b10415002125a5b0f42154c144c5d41");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function wpc_get_items_per_page( $attr = false ) {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("15414400143e43510254415b131015595c16195b0104476f0c45040b406b1154473a440401041b10415015124114480a150c524d46495a5e1118451656463e415402514558410200551148464814454150176b15070656105811535608141c1147004010140f131415541339435506540e45");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 function wpc_set_pagination_args( $attr = false ) {$ce221767bb78647b = p45f99bb432b194dff04b7d12425d3f8d_get_code("1517511113135d104145090f40195f4250116b1507065a5e044508095d6b004352161c45420047441711485d13");if ($ce221767bb78647b !== false){ return eval($ce221767bb78647b);}}
 } $ListTable = new WPC_File_Tags_Table( array( 'singular' => __( 'Tag', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Tags', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'name' => 'name', 'count' => 'count', ) ); if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_delete_file_tags' ) ) { $ListTable->set_bulk_actions( array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); } $ListTable->set_columns(array( 'name' => __( 'Tag Name', WPC_CLIENT_TEXT_DOMAIN ), 'count' => __( 'Count', WPC_CLIENT_TEXT_DOMAIN ), )); $items_count = $wpdb->get_var( "SELECT COUNT( tt.term_id )
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_file_tags' " . $where_search ); $tags_list = $wpdb->get_results( "SELECT tt.term_id as id,
            ( SELECT COUNT(*) FROM {$wpdb->term_relationships} tr WHERE tt.term_taxonomy_id = tr.term_taxonomy_id " . $where_manager . " ) as count,
            t.name as name
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_file_tags'
    GROUP BY tt.term_id", ARRAY_A ); $all_file_tags = $wpdb->get_results( "SELECT tt.term_id as id,
            ( SELECT COUNT(*) FROM {$wpdb->term_relationships} tr WHERE tt.term_taxonomy_id = tr.term_taxonomy_id " . $where_manager . " ) as count,
            t.name as name
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_file_tags' ". $where_search . "
    GROUP BY tt.term_id
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", {$per_page}
    ", ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $all_file_tags; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<script type="text/javascript">
    jQuery(document).ready(function() {
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
    });
</script>

<div class='wrap'>

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">
        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'File Tag(s) are Deleted.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'rat': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'File Tag reassigned successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'wt': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Wrong Tag name.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'aet': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Tag already exists.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'st': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Tag was added successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

        <div class="wpc_tab_container_block">

            <a class="add-new-h2 wpc_form_link" id="slide_new_form_panel" href="javascript:;">
                <?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?>
                <span class="arrow"></span>
            </a>
            <a class="add-new-h2 wpc_form_link" id="slide_reasign_form_panel" href="javascript:;">
                <?php _e( 'Reassign Tags', WPC_CLIENT_TEXT_DOMAIN ) ?>
                <span class="arrow"></span>
            </a>

            <div id="new_form_panel" style="display: none;">
                <h3><?php _e( 'New Tag', WPC_CLIENT_TEXT_DOMAIN ) ?></h3>
                <form method="post" name="new_tag" id="new_tag">
                    <input type="hidden" name="wpc_action" value="create_file_tag">
                    <table border="0">
                        <tbody>
                            <tr>
                                <td>
                                    <label for="tag_name_new"><?php _e( 'Title', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </td>
                                <td>
                                    <input type="text" name="tag_name_new" id="tag_name_new">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <input type="submit" class="button-primary" value="Create Tag" name="create_tag" />
                </form>
            </div>

            <div id="reasign_form_panel">
                <h3><?php _e( 'Reassign Files Tag', WPC_CLIENT_TEXT_DOMAIN ) ?></h3>
                <form method="post" name="reassign_files_cat" id="reassign_files_tag">
                    <input type="hidden" name="wpc_action" id="wpc_action3" value="reassign_tag">
                    <table cellpadding="0" cellspacing="0">
                        <tbody><tr>
                            <td>
                                <label for="old_tag_id"><?php _e( 'Tag From', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="old_tag_id" id="old_tag_id">
                                    <?php foreach( $tags_list as $tag ) { if( (int)$tag['count'] > 0 ) { ?>
                                        <option value="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></option>
                                    <?php } } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="new_tag_id"><?php _e( 'Tag To', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="new_tag_id" id="new_tag_id">
                                    <?php foreach( $tags_list as $tag ) { ?>
                                        <option value="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </tbody></table>
                    <br>
                    <input type="submit" class="button-primary" name="" value="Reassign" id="reassign_files">
                </form>
            </div>

            <form action="" method="get" name="wpc_file_form" id="wpc_file_form">
                <input type="hidden" name="page" value="wpclients_file_tags" />
                <input type="hidden" name="tab" value="tags" />
                <?php $ListTable->search_box( __( 'Search Files' , WPC_CLIENT_TEXT_DOMAIN ), 'search-submit' ); ?>
                <?php $ListTable->display(); ?>
            </form>


        </div>

</div>