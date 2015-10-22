{if !$ajax_pagination}
<div class="wpc_client_files_table wpc_filesla_shortcode" data-form_id="{$files_form_id}">
    <form action="" method="post" name="wpc_client_files_table{$files_form_id}" class="wpc_client_files_form">
        <div class="wpc_table_nav_top">
            <div class="wpc_nav_wrapper">
                {if $show_filters && ( ( $show_categories_names && count( $categories ) > 1 ) || ( $show_author && count( $authors ) > 1 ) || ( $show_tags && count( $tags ) > 1 ) )}
                    <div class="wpc_files_filter_block">
                        <div class="wpc_filters_select_wrapper">
                            <input type="button" class="wpc_show_filters wpc_button" value="{$texts.add_filter}"/>

                            <div class="wpc_filters_contect">

                                <label>{$texts.filter_by}&nbsp;
                                    <select class="wpc_filter_by wpc_selectbox">
                                        {if $show_categories_names && count( $categories ) > 1}<option value="category">{$texts.category}</option>{/if}
                                        {if $show_author && count( $authors ) > 1}<option value="author">{$texts.author}</option>{/if}
                                        {if $show_tags && count( $tags ) > 1}<option value="tags">{$texts.tags}</option>{/if}
                                    </select>
                                </label>

                                <div class="wpc_ajax_content">

                                    <div class="wpc_loading_overflow">
                                        <div class="wpc_small_ajax_loading"></div>
                                    </div>

                                    <div class="wpc_overflow_content">
                                        <label>{$texts.filter}&nbsp;
                                            <select class="wpc_filter wpc_selectbox"></select>
                                        </label>
                                        <input type="button" value="{$texts.apply_filter}" class="wpc_add_filter wpc_button" />
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="wpc_filters_wrapper"></div>
                    </div>
                {/if}
                {if $show_search}
                    <div class="wpc_files_search_block">
                        <div class="wpc_files_search_input_block">
                            <input type="text" class="wpc_files_search wpc_text" value="" />
                            <span class="wpc_files_search_button" title="{$texts.search_files}">&nbsp;</span>
                            <span class="wpc_files_clear_search" title="{$texts.clear_search}">&nbsp;</span>
                        </div>
                    </div>
                {/if}
            </div>
            <div class="wpc_nav_wrapper">
                {if $show_bulk_actions && count( $bulk_actions_array ) > 0 && count( $files ) > 1}
                    <div class="wpc_files_bulk_actions_block">
                        <select class="wpc_files_bulk_action wpc_selectbox" name="wpc_files_bulk_action">
                            <option value="none">{$texts.bulk_actions}</option>
                            {foreach from=$bulk_actions_array key=k item=bulk_action}
                                <option value="{$k}">{$bulk_action}</option>
                            {/foreach}
                        </select>
                        <input type="button" value="{$texts.apply}" class="wpc_files_bulk_actions_apply_button wpc_button" />
                    </div>
                {/if}
                {if $show_pagination}
                    <div class="wpc_files_pagination wpc_files_uploaded">
                        <span class="wpc_files_counter">{$files_count}</span>
                        {if $count_pages > 1}
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_first" style="display:none;"><<</a>
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_previous" style="display:none;"><</a>
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_previous_pages" style="display:none;">...</a>
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_active_page">1</a>
                            {if $count_pages <= 3}
                                {for $page=2 to $count_pages}
                                    <a href="javascript:void(0);" class="wpc_pagination_links">{$page}</a>
                                {/for}
                            {elseif $count_pages > 3}
                                {for $page=2 to 3}
                                    <a href="javascript:void(0);" class="wpc_pagination_links">{$page}</a>
                                {/for}
                                {for $page=4 to $count_pages}
                                    <a href="javascript:void(0);" class="wpc_pagination_links" style="display:none;">{$page}</a>
                                {/for}
                                <a href="javascript:void(0);" class="wpc_pagination_links wpc_next_pages">...</a>
                            {/if}
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_next">></a>
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_last">>></a>
                        {/if}
                    </div>
                {/if}
            </div>
        </div>
        <div class="wpc_client_files_table_block">
            <table class="wpc_client_files">
                <thead>
                    <tr valign="top">
                        {if $show_bulk_actions && count( $bulk_actions_array ) > 0}
                            <th class="wpc_th_bulk_action">
                                <input type="checkbox" class="bulk_ids_all" name="bulk_ids_all" value="all">
                            </th>
                        {/if}
                        {if $show_sort}
                            <th class="wpc_sortable wpc_th_filename {if $sort_type == 'name'}wpc_sort_{$sort}{/if}">
                                <span class="wpc_cust_sort_name wpc_cust_file_sort">{$texts.filename}</span>
                            </th>
                        {else}
                            <th class="wpc_th_filename">
                                {$texts.filename}
                            </th>
                        {/if}
                        {if $show_size}
                            {if $show_sort}
                                <th class="wpc_sortable wpc_th_size">
                                    <span class="wpc_cust_sort_size wpc_cust_file_sort">{$texts.size}</span>
                                </th>
                            {else}
                                <th class="wpc_th_size">
                                    {$texts.size}
                                </th>
                            {/if}
                        {/if}
                        {if $show_author}
                            {if $show_sort}
                                <th class="wpc_sortable wpc_th_author">
                                    <span class="wpc_cust_sort_author wpc_cust_file_sort">{$texts.author}</span>
                                </th>
                            {else}
                                <th class="wpc_th_author">
                                    {$texts.author}
                                </th>
                            {/if}
                        {/if}
                        {if $show_date}
                            {if $show_sort}
                                <th class="wpc_sortable wpc_th_time_added {if $sort_type == 'date'}wpc_sort_{$sort}{/if}">
                                    <span class="wpc_cust_sort_time wpc_cust_file_sort">{$texts.added}</span>
                                </th>
                            {else}
                                <th class="wpc_th_time_added">
                                    {$texts.added}
                                </th>
                            {/if}
                        {/if}
                        {if $show_last_download_date}
                            {if $show_sort}
                                <th class="wpc_sortable wpc_th_last_download_time">
                                    <span class="wpc_cust_sort_download_time wpc_cust_file_sort">{$texts.last_download}</span>
                                </th>
                            {else}
                                <th class="wpc_th_last_download_time">
                                    {$texts.last_download}
                                </th>
                            {/if}
                        {/if}
                        {if $show_categories_names}
                            {if $show_sort}
                                <th class="wpc_sortable wpc_th_category_name">
                                    <span class="wpc_cust_sort_cat wpc_cust_file_sort">{$texts.category}</span>
                                </th>
                            {else}
                                <th class="wpc_th_category_name">
                                    {$texts.category}
                                </th>
                            {/if}
                        {/if}
                    </tr>
                </thead>
                <tfoot>
                    <tr valign="top">
                        {if $show_bulk_actions && count( $bulk_actions_array ) > 0}
                            <th class="wpc_th_bulk_action">
                                <input type="checkbox" class="bulk_ids_all" name="bulk_ids_all" value="all">
                            </th>
                        {/if}
                        {if $show_sort}
                            <th class="wpc_sortable wpc_th_filename {if $sort_type == 'name'}wpc_sort_{$sort}{/if}">
                                <span class="wpc_cust_sort_name wpc_cust_file_sort">{$texts.filename}</span>
                            </th>
                        {else}
                            <th class="wpc_th_filename">
                                {$texts.filename}
                            </th>
                        {/if}
                        {if $show_size}
                            {if $show_sort}
                                <th class="wpc_sortable wpc_th_size">
                                    <span class="wpc_cust_sort_size wpc_cust_file_sort">{$texts.size}</span>
                                </th>
                            {else}
                                <th class="wpc_th_size">
                                    {$texts.size}
                                </th>
                            {/if}
                        {/if}
                        {if $show_author}
                            {if $show_sort}
                                <th class="wpc_sortable wpc_th_author">
                                    <span class="wpc_cust_sort_author wpc_cust_file_sort">{$texts.author}</span>
                                </th>
                            {else}
                                <th class="wpc_th_author">
                                    {$texts.author}
                                </th>
                            {/if}
                        {/if}
                        {if $show_date}
                            {if $show_sort}
                                <th class="wpc_sortable wpc_th_time_added {if $sort_type == 'date'}wpc_sort_{$sort}{/if}">
                                    <span class="wpc_cust_sort_time wpc_cust_file_sort">{$texts.added}</span>
                                </th>
                            {else}
                                <th class="wpc_th_time_added">
                                    {$texts.added}
                                </th>
                            {/if}
                        {/if}
                        {if $show_last_download_date}
                            {if $show_sort}
                                <th class="wpc_sortable wpc_th_last_download_time">
                                    <span class="wpc_cust_sort_download_time wpc_cust_file_sort">{$texts.last_download}</span>
                                </th>
                            {else}
                                <th class="wpc_th_last_download_time">
                                    {$texts.last_download}
                                </th>
                            {/if}
                        {/if}
                        {if $show_categories_names}
                            {if $show_sort}
                                <th class="wpc_sortable wpc_th_category_name">
                                    <span class="wpc_cust_sort_cat wpc_cust_file_sort">{$texts.category}</span>
                                </th>
                            {else}
                                <th class="wpc_th_category_name">
                                    {$texts.category}
                                </th>
                            {/if}
                        {/if}
                    </tr>
                </tfoot>
                <tbody>
        {/if}
                {if isset( $files )}
                    {foreach $files as $file}
                        <tr valign="top" class="wpc_file_row">
                            {if $show_bulk_actions && count( $bulk_actions_array ) > 0}
                                <td class="wpc_file_bulk_action">
                                    <input type="checkbox" class="bulk_ids" name="bulk_ids[]" value="{$file.id}">
                                </td>
                            {/if}
                            <td class="wpc_td_filename">
                                {if $show_thumbnails}
                                    <div class="wpc_thumbnail_wrapper">
                                        {if isset( $file.icon ) }
                                            {$file.icon}
                                        {/if}
                                    </div>
                                {/if}
                                <div class="wpc_filedata_wrapper {if !$show_thumbnails}wpc_fullwidth{/if}">
                                    <span class="wpc_filedata wpc_file_name_value">
                                        {if $file.new_page}
                                            <a href="{$file.view_url}" title="{$texts.view} {$file.title}" target="_blank">{$file.title}</a>
                                        {else}
                                            <a href="{$file.url}" title="{$texts.download} {$file.title}">{$file.title}</a>
                                        {/if}
                                    </span>

                                    {if $show_description && $file.description}
                                        <span class="wpc_filedata wpc_file_description_value" title="{$file.description}">
                                            {$file.description}
                                        </span>
                                    {/if}

                                    {if $show_tags}
                                        {if isset( $file.tags ) && count( $file.tags )}
                                            <span class="wpc_filedata wpc_file_tags_value">
                                                {foreach $file.tags as $tag}
                                                    <span class="wpc_tag" data-term_id="{$tag.term_id}" title="{$texts.filter_by} {$texts.tag}: {$tag.name}">{$tag.name}</span>
                                                {/foreach}
                                            </span>
                                        {/if}
                                    {/if}

                                    <span class="wpc_file_actions">
                                        {if $file.new_page}
                                            <a href="{$file.view_url}" title="{$texts.view} {$file.title}" target="_blank" class="wp_file_view_link">{$texts.view}</a>&nbsp;|&nbsp;
                                        {/if}
                                        <a href="{$file.url}" title="{$texts.download} {$file.title}"{if $file.new_page} target="_blank"{/if} class="wp_file_download_link">{$texts.download}</a>
                                        {if isset( $file.delete_url ) && !empty( $file.delete_url )}
                                            &nbsp;|&nbsp;<a onclick="return confirm( '{$texts.delete_confirm}' );" href="{$file.delete_url}" title="{$texts.delete} {$file.title}" class="wp_file_delete_link">{$texts.delete}</a>
                                        {/if}
                                    </span>
                                </div>
                            </td>
                            {if $show_size}
                                <td class="wpc_td_size" data-size="{$file.size}">
                                    <span class="wpc_filedata wpc_file_size_value">
                                        {$file.size}
                                    </span>
                                </td>
                            {/if}
                            {if $show_author}
                                <td class="wpc_td_author">
                                    <span class="wpc_filedata wpc_file_author_value" data-author_id="{if $file.author_id}{$file.author_id}{/if}" title="{$texts.filter_by} {$texts.author}: {$file.author}">
                                        {$file.author}
                                    </span>
                                </td>
                            {/if}
                            {if $show_date}
                                <td class="wpc_td_time" data-timestamp="{$file.timestamp}">
                                    <span class="wpc_filedata wpc_file_added_value">
                                        {$file.date} {$file.time}
                                    </span>
                                </td>
                            {/if}
                            {if $show_last_download_date}
                                <td class="wpc_td_download_time" data-timestamp="{if isset($file.last_download.date)}{$file.last_download.timestamp}{/if}">
                                    <span class="wpc_filedata wpc_file_downloaded_value">
                                        {if isset($file.last_download.date)}
                                            {$file.last_download.date} {$file.last_download.time}
                                        {/if}
                                    </span>
                                </td>
                            {/if}
                            {if $show_categories_names}
                                <td class="wpc_td_category">
                                    {if $file.category_name}
                                        <span class="wpc_filedata wpc_file_category_value" data-category_id="{if $file.category_id}{$file.category_id}{/if}" title="{$texts.filter_by} {$texts.category}: {$file.category_name}">
                                            {$file.category_name}
                                        </span>
                                    {/if}
                                </td>
                            {/if}
                        </tr>
                    {/foreach}
                {elseif $no_text}
                    <tr><td colspan="{$no_files_colspan}" class="wpc_no_items">{$no_text}</td></tr>
                {/if}
        {if !$ajax_pagination}
                </tbody>
            </table>
            <div class="wpc_ajax_overflow_table"><div class="wpc_ajax_loading"></div></div>
        </div>
        <div class="wpc_table_nav_bottom">
            <div class="wpc_nav_wrapper">
                {if $show_pagination}
                    <div class="wpc_files_pagination wpc_files_uploaded" style="float:right;">
                        <span class="wpc_files_counter">{$files_count}</span>
                        {if $count_pages > 1}
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_first" style="display:none;"><<</a>
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_previous" style="display:none;"><</a>
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_previous_pages" style="display:none;">...</a>
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_active_page">1</a>
                            {if $count_pages <= 3}
                                {for $page=2 to $count_pages}
                                    <a href="javascript:void(0);" class="wpc_pagination_links">{$page}</a>
                                {/for}
                            {elseif $count_pages > 3}
                                {for $page=2 to 3}
                                    <a href="javascript:void(0);" class="wpc_pagination_links">{$page}</a>
                                {/for}
                                {for $page=4 to $count_pages}
                                    <a href="javascript:void(0);" class="wpc_pagination_links" style="display:none;">{$page}</a>
                                {/for}
                                <a href="javascript:void(0);" class="wpc_pagination_links wpc_next_pages">...</a>
                            {/if}
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_next">></a>
                            <a href="javascript:void(0);" class="wpc_pagination_links wpc_last">>></a>
                        {/if}
                    </div>
                {/if}
                {if $show_bulk_actions && count( $bulk_actions_array ) > 0 && count( $files ) > 1}
                    <div class="wpc_files_bulk_actions_block">
                        <select class="wpc_files_bulk_action wpc_selectbox" name="wpc_files_bulk_action">
                            <option value="none">{$texts.bulk_actions}</option>
                            {foreach from=$bulk_actions_array key=k item=bulk_action}
                                <option value="{$k}">{$bulk_action}</option>
                            {/foreach}
                        </select>
                        <input type="button" value="{$texts.apply}" class="wpc_files_bulk_actions_apply_button wpc_button" />
                    </div>
                {/if}
            </div>
        </div>
    </form>
</div>
{/if}