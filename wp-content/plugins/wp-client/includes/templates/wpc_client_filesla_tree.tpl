{if !$category_row && !$file_row}
    {if !$ajax_pagination}
    <div class="wpc_client_files_tree wpc_filesla_shortcode" data-form_id="{$files_form_id}">
        <div class="wpc_table_nav_top">
        <div class="wpc_nav_wrapper">
            {if $show_filters && ( ( $show_author && count( $authors ) > 1 ) || ( $show_tags && count( $tags ) > 1 ) )}
                <div class="wpc_files_filter_block">
                    <div class="wpc_filters_select_wrapper">
                        <input type="button" class="wpc_show_filters wpc_button" value="{$texts.add_filter}"/>

                        <div class="wpc_filters_contect">

                            <label>{$texts.filter_by}&nbsp;
                                <select class="wpc_filter_by wpc_selectbox">
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
    </div>
        <div class="wpc_client_files wpc_treecontent">
            <div class="wpc_files_tree_header">
                <table>
                    <thead>
                        <tr valign="top">
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
                                <th class="wpc_th_author">
                                    {$texts.author}
                                </th>
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
                            <th class="wpc_scroll_column">
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="wpc_files_tree_content">
                <table class="wpc_files_tree">
    {/if}
                    {if strlen($tree_content) > 0}
                        {$tree_content}
                    {elseif $no_text}
                        <tr><td colspan="{$no_files_colspan}" class="wpc_no_items">{$no_text}</td></tr>
                    {/if}
    {if !$ajax_pagination}
                </table>
                <div class="wpc_ajax_overflow_tree"><div class="wpc_ajax_loading"></div></div>
            </div>
        </div>
    </div>
    {/if}
{elseif $category_row}
    <tr data-tt-id="category%category_id%" %parent_value% valign="top">
        <td class="wpc_td_filename wpc_folder">

            <span class="wpc_folder_block">
                <span class="wpc_folder_img %subfolder_class%">

                    <img class="wpc_file_icon" width="20" height="20" src="%category_icon%" class="attachment-80x60" alt="folder" title="folder" />
                    <span class="wpc_foldername_block">%category_name%</span>
                </span>
            </span>
        </td>
        {if $show_size}
             <td class="wpc_td_size"><span class="wpc_folder_size">&lt;{$texts.folder}&gt;</span></td>
        {/if}
        {if $show_author}
            <td class="wpc_td_author">---</td>
        {/if}
        {if $show_date}
             <td class="wpc_td_time_added">---</td>
        {/if}
        {if $show_last_download_date}
            <td class="wpc_td_last_download_time">---</td>
        {/if}
    </tr>
{elseif $file_row}
    <tr data-tt-id="file%file_id%" %parent_value% class="wpc_treetable_file" valign="top">
        <td class="wpc_td_filename">
            <span class="wpc_file_block">
                <span class="wpc_thumbnail_wrapper">
                    {if $show_thumbnails}
                        %file_icon%
                    {/if}
                </span>
                <span class="wpc_filename_block">
                    <span class="wpc_filename">%file_title%</span>
                    {if $show_tags}
                        <span class="wpc_tags">
                            %file_tags%
                        </span>
                    {/if}
                    {if $show_description}
                        <span class="wpc_file_details closed">{$texts.description}: %file_description%</span>
                    {/if}
                    <span class="wpc_file_action_links">
                        <a href="%file_view_url%" title="{$texts.view} %file_title%" %view_link_visibility% target="_blank" class="wp_file_view_link">{$texts.view}</a>
                        %after_view_link%
                        <a href="%file_url%" title="{$texts.download} %file_title%" %download_target_blank% class="wp_file_download_link">{$texts.download}</a>
                        %before_delete_link%
                        <a onclick="return confirm( '{$texts.delete_confirm}' );" %delete_link_visibility%  href="%file_delete_url%" title="{$texts.delete} %file_title%" class="wp_file_delete_link">{$texts.delete}</a>
                        {if $show_description}
                            %before_details_link%<a href="javascript:;" %details_link_visibility% class="wpc_show_file_details">{$texts.show_details}</a>
                        {/if}
                    </span>
                </span>
            </span>
        </td>
        {if $show_size}
             <td class="size wpc_td_size" data-size="%file_size%">%file_size%</td>
        {/if}
        {if $show_author}
            <td class="wpc_td_author">
                <span class="wpc_file_author_value" data-author_id="%file_author_id%" title="{$texts.filter_by} {$texts.author}: %file_author%">%file_author%</span>
            </td>
        {/if}
        {if $show_date}
            <td class="wpc_td_time_added">%file_date% %file_time%</td>
        {/if}
        {if $show_last_download_date}
            <td class="wpc_td_last_download_time">
                %file_last_download_date% %file_last_download_time%
            </td>
        {/if}
    </tr>
{/if}