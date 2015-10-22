{if !$ajax_pagination}
<div class="wpc_client_client_pages_list" data-form_id="{$form_id}">

    {if !empty($message)}
        <span id="message" class="updated fade">{$message}</span><br />
    {/if}

    {if !empty($add_staff_url)}
        <strong><a href="{$add_staff_url}">{$add_staff_text}</a></strong><br />
    {/if}

    {if !empty($staff_directory_url)}
        <strong><a href="{$staff_directory_url}">{$staff_directory_text}</a></strong><br /><br /><br />
    {/if}


    <div class="wpc_table_nav_top">
        <div class="wpc_nav_wrapper">
            {if $show_sort && isset($pages) && count($pages)}
                <div class="wpc_sort_block">
                    <input type="button" class="wpc_add_sort wpc_button" value="{$sort_button}" data-hover_value="{$texts.change_sort}" />
                    <div class="wpc_sort_contect">
                        <label>{$texts.sort_by}&nbsp;
                            <select class="wpc_sorting wpc_selectbox">
                                <option value="orderid_asc" {if $sort == 'order_id' && $dir == 'asc'}selected="selected"{/if}>{$texts.order_id} {$texts.asc}</option>
                                <option value="orderid_desc" {if $sort == 'order_id' && $dir == 'desc'}selected="selected"{/if}>{$texts.order_id} {$texts.desc}</option>
                                <option value="title_asc" {if $sort == 'title' && $dir == 'asc'}selected="selected"{/if}>{$texts.title} {$texts.asc}</option>
                                <option value="title_desc" {if $sort == 'title' && $dir == 'desc'}selected="selected"{/if}>{$texts.title} {$texts.desc}</option>
                                <option value="date_asc" {if $sort == 'date' && $dir == 'asc'}selected="selected"{/if}>{$texts.added} {$texts.asc}</option>
                                <option value="date_desc" {if $sort == 'date' && $dir == 'desc'}selected="selected"{/if}>{$texts.added} {$texts.desc}</option>
                                <option value="category_asc" {if $sort == 'category_name' && $dir == 'asc'}selected="selected"{/if}>{$texts.category} {$texts.asc}</option>
                                <option value="category_desc" {if $sort == 'category_name' && $dir == 'desc'}selected="selected"{/if}>{$texts.category} {$texts.desc}</option>
                            </select>
                        </label>
                        <input type="button" value="{$texts.apply}" class="wpc_apply_sort wpc_button" />
                    </div>
                </div>
            {/if}
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
    <div class="wpc_pagelist">
{/if}
        {if !empty( $pages )}
            {foreach $pages as $page}
                {if isset( $page.category_name ) && !empty( $page.category_name )}
                    <div class="wpc_category_line">
                        <h4>{$page.category_name}</h4>
                    </div>
                {/if}

                <div class="wpc_page">
                    {if $show_featured_image && isset( $page.icon )}
                        <div class="wpc_featured_image_wrapper" style="float: left;width:15%;margin-right:5px;display:block;">
                            {$page.icon}
                        </div>
                    {/if}
                    <div class="wpc_pagedata_wrapper">
                        <div class="wpc_pagetitle">
                            <strong><a href="{$page.url}">{$page.title}</a></strong>
                            {if $show_date}
                                <span class="wpc_filedata">[{$page.date} {$page.time}]</span>
                            {/if}
                        </div>
                        {if !empty($page.edit_link)}
                            <div class="wpc_page_actions">
                                <a href="{$page.edit_link}" >{$texts.edit}</a>
                            </div>
                        {/if}
                    </div>
                </div>
            {/foreach}
        {elseif $no_text}
            <p>{$no_text}</p>
        {/if}
{if !$ajax_pagination}
    </div>
    {if isset( $pages ) && !empty( $pages )}
        <input type="button" class="pages_pagination_block wpc_button" data-last_category_id="{$last_category_id}" data-page_number="1" {if !( $show_pagination && isset( $count_pages ) && $count_pages > 1 )}style="display: none;"{/if} value="{$texts.show_more}" />
    {/if}
    <div class="wpc_overlay" style="display: none;"></div>
</div>
{/if}