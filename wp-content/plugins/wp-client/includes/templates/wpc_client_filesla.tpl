{if !$ajax_pagination}
<div class="wpc_client_files_list wpc_filesla_shortcode" data-form_id="{$files_form_id}">
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
            {if $show_sort && isset($files) && count($files)}
                <div class="wpc_sort_block">
                    <input type="button" class="wpc_add_sort wpc_button" value="{$sort_button}" data-hover_value="{$texts.change_sort}" />
                    <div class="wpc_sort_contect">
                        <label>{$texts.sort_by}&nbsp;
                            <select class="wpc_sorting wpc_selectbox">
                                <option value="orderid_asc" {if $sort == 'order_id' && $dir == 'asc'}selected="selected"{/if}>{$texts.order_id} {$texts.asc}</option>
                                <option value="orderid_desc" {if $sort == 'order_id' && $dir == 'desc'}selected="selected"{/if}>{$texts.order_id} {$texts.desc}</option>
                                <option value="filename_asc" {if $sort == 'name' && $dir == 'asc'}selected="selected"{/if}>{$texts.filename} {$texts.asc}</option>
                                <option value="filename_desc" {if $sort == 'name' && $dir == 'desc'}selected="selected"{/if}>{$texts.filename} {$texts.desc}</option>
                                <option value="date_asc" {if $sort == 'time' && $dir == 'asc'}selected="selected"{/if}>{$texts.added} {$texts.asc}</option>
                                <option value="date_desc" {if $sort == 'time' && $dir == 'desc'}selected="selected"{/if}>{$texts.added} {$texts.desc}</option>
                                <option value="downloaded_asc">{$texts.last_download} {$texts.asc}</option>
                                <option value="downloaded_desc">{$texts.last_download} {$texts.desc}</option>
                                <option value="size_asc">{$texts.size} {$texts.asc}</option>
                                <option value="size_desc">{$texts.size} {$texts.desc}</option>
                                <option value="author_asc">{$texts.author} {$texts.asc}</option>
                                <option value="author_desc">{$texts.author} {$texts.desc}</option>
                                <option value="category_asc">{$texts.category} {$texts.asc}</option>
                                <option value="category_desc">{$texts.category} {$texts.desc}</option>
                            </select>
                        </label>
                        <input type="button" value="{$texts.apply}" class="wpc_apply_sort wpc_button" />
                    </div>
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
    <div class="wpc_filelist">
{/if}
        {if isset($files)}
            {foreach $files as $file}
                {if isset( $file.category_name ) && !empty( $file.category_name )}
                    <div class="wpc_category_line">
                        <h4>{$file.category_name}</h4>
                    </div>
                {/if}
                <div class="file_item">
                    <div class="wpc_thumbnail_wrapper">
                        {if $show_thumbnails}
                            {if isset( $file.icon ) }
                                {$file.icon}
                            {/if}
                        {/if}
                    </div>
                    <div class="wpc_filedata_wrapper">
                        <div class="wpc_filename">
                            <a href="{if $file.new_page}{$file.view_url}{else}{$file.url}{/if}" {if $file.new_page}target="_blank"{/if} data-timestamp="{$file.timestamp}">{$file.title}</a>
                        </div>
                        <div class="wpc_file_details">
                            {if $show_description && isset( $file.description ) && !empty( $file.description )}
                                <span class="wpc_filedata">{$file.description}</span>
                            {/if}
                            {if $show_tags}
                                {if isset( $file.tags ) && count( $file.tags )}
                                    <span class="wpc_filedata">
                                        {foreach $file.tags as $tag}
                                            <span class="wpc_tag" data-term_id="{$tag.term_id}" title="{$texts.filter_by} {$texts.tag}: {$tag.name}">{$tag.name}</span>
                                        {/foreach}
                                    </span>
                                {/if}
                            {/if}
                            {if $show_size}
                                <span class="wpc_filedata"><strong>{$texts.size}:</strong> {$file.size}</span>
                            {/if}
                            {if $show_author && $file.author}
                                <span class="wpc_filedata">
                                    <strong>{$texts.author}:</strong>
                                    <span class="wpc_file_author_value" data-author_id="{$file.author_id}" title="{$texts.filter_by} {$texts.author}: {$file.author}">{$file.author}</span>
                                </span>
                            {/if}
                            {if $show_date}
                                <span class="wpc_filedata"><strong>{$texts.added}:</strong> {$file.date} {$file.time}</span>
                            {/if}
                            {if $show_last_download_date}
                                {if isset($file.last_download.date)}
                                    <span class="wpc_filedata"><strong>{$texts.last_download}:</strong> {$file.last_download.date} {$file.last_download.time}</span>
                                {/if}
                            {/if}
                        </div>
                        <div class="wpc_file_actions">
                            <a href="javascript:;" title="{$file.title} {$texts.details}" class="wpc_file_details_link" data-hide_text="{$texts.hide_details}">{$texts.details}</a>&nbsp;|&nbsp;
                            {if $file.new_page}
                                <a href="{$file.view_url}" title="{$texts.view} {$file.title}" target="_blank" class="wp_file_view_link">{$texts.view}</a>&nbsp;|&nbsp;
                            {/if}
                            <a href="{$file.url}" title="{$texts.download} {$file.title}" {if $file.new_page} target="_blank"{/if} class="wp_file_download_link">{$texts.download}</a>
                            {if isset( $file.delete_url ) && !empty( $file.delete_url )}
                                &nbsp;|&nbsp;<a onclick="return confirm( '{$texts.delete_confirm}' );" href="{$file.delete_url}" title="{$texts.delete} {$file.title}" class="wp_file_delete_link">{$texts.delete}</a>
                            {/if}
                        </div>
                    </div>
                </div>
            {/foreach}
        {elseif $no_text}
            <p>{$no_text}</p>
        {/if}
{if !$ajax_pagination}
    </div>
    {if isset($files)}
        <input type="button" class="files_pagination_block wpc_button" data-last_category_id="{$last_category_id}" data-page_number="1" {if !( $show_pagination && isset( $count_pages ) && $count_pages > 1 )}style="display: none;"{/if} value="{$texts.show_more}" />
    {/if}
    <div class="wpc_overlay" style="display: none;"></div>
</div>
{/if}