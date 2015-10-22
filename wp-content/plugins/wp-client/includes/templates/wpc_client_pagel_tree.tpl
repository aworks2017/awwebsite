{if !$category_row && !$page_row}
{if !$ajax_pagination}
    <div class="wpc_client_client_pages_tree" data-form_id="{$form_id}">
        <div class="wpc_table_nav_top">
            <div class="wpc_nav_wrapper">
                {if $show_search}
                    <div class="wpc_pages_search_block">
                        <div class="wpc_pages_search_input_block">
                            <input type="text" class="wpc_pages_search wpc_text" value="" />
                            <span class="wpc_pages_search_button" title="{$texts.search_page}">&nbsp;</span>
                            <span class="wpc_pages_clear_search" title="{$texts.clear_search}">&nbsp;</span>
                        </div>
                    </div>
                {/if}
            </div>
        </div>
        <div class="wpc_client_pages wpc_treecontent">
            <div class="wpc_pages_tree_header">
                <table class="wpc_client_pages_tree_header">
                    <thead>
                        <tr valign="top">
                            {if $show_sort}
                                <th class="wpc_sortable wpc_th_title {if $sort_type == 'title'}wpc_sort_{$sort}{/if}">
                                    <span class="wpc_cust_sort_title wpc_cust_page_sort">{$texts.title}</span>
                                </th>
                            {else}
                                <th class="wpc_th_title">
                                    {$texts.title}
                                </th>
                            {/if}
                            {if $show_date}
                                {if $show_sort}
                                    <th class="wpc_sortable wpc_th_datetime {if $sort_type == 'date'}wpc_sort_{$sort}{/if}">
                                        <span class="wpc_cust_sort_date wpc_cust_page_sort">{$texts.datetime}</span>
                                    </th>
                                {else}
                                    <th class="wpc_th_datetime">
                                        {$texts.datetime}
                                    </th>
                                {/if}
                            {/if}
                            <th class="wpc_scroll_column">
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="wpc_client_pages_tree_content">
                <table class="wpc_client_pages_tree">
{/if}
                    {if strlen($tree_content) > 0}
                        {$tree_content}
                    {elseif $no_text}
                        <tr><td colspan="{$no_pages_colspan}" class="wpc_no_items">{$no_text}</td></tr>
                    {/if}
{if !$ajax_pagination}
                </table>
                <div class="wpc_ajax_overflow_tree"><div class="wpc_ajax_loading"></div></div>
            </div>
        </div>
    </div>
{/if}
{elseif $category_row}
    <tr data-tt-id="category%category_id%" valign="top">
        <td class="wpc_td_title wpc_folder">
            <span class="wpc_folder_block">
                <img class="wpc_folder_img" src="%category_icon%" alt="folder" title="folder" />
                <span class="wpc_foldername_block">%category_name%</span>
            </span>
        </td>
        {if $show_date}
             <td class="wpc_td_datetime">---</td>
        {/if}
    </tr>
{elseif $page_row}
    <tr data-tt-id="file%page_id%" %parent_value% class="wpc_treetable_page" valign="top">
        <td class="wpc_td_title">
            <span class="wpc_page_block">
                {if $show_featured_image}
                    <span style="float: left;width:10%;margin-right: 5px;display:block;">
                        %featured_image%
                    </span>
                {/if}
                <span style="float: left;width:calc( 90% - 5px );margin:0;padding:0;display:block;">
                    <a href="%page_link%" class="wpc_page_link"><strong>%page_title%</strong></a>
                    <span class="wpc_portal_page_action_links" %show_edit_link%>%edit_link%</span>
                </span>
            </span>
        </td>
        {if $show_date}
            <td class="wpc_td_datetime">%page_date% %page_time%</td>
        {/if}
    </tr>
{/if}