{if !$ajax_pagination}
    {$javascript}
    <div class="wpc_client_message_block">
        <div class="wpc_message_textarea_block">
            <form action="" method="post" class="wpc_client_message_form">
                {$textarea}
                <div style="clear: both; height:10px;"></div>
                {if isset( $show_add_cc_email ) }
                    <a id="wpc_add_cc_email_user" href="javascript: void(0);">+{$add_cc_email}</a>
                    <div id="wpc_input_cc_email_user" style="display: none;">{$cc_email} <input type="text" name="cc_email" /></div>
                    <div style="clear: both; height:10px;"></div>
                {/if}
                {$submit_form}
            </form>
        </div>
        </br>

        <div class="wpc_message_history_block">
            <p>
                <span style="font-size: medium;">
                    {$messages_title}
                </span>
            </p>
            {if isset( $messages_filters ) && !empty( $messages_filters )}
                <div style="float:left;">
                    {$messages_filters}
                </div>
            {/if}
            <table class="wpc_client_messages"> 
                {if is_array( $messages ) && 0 < count( $messages ) }
                    {foreach $messages as $message}
                        <tr>
                            <td style="width: 20%;" align="left">
                                <span class="wpc_client_message_author">
                                    <strong>
                                        {$message.sent_from_name}
                                    </strong>
                                </span>:
                            </td>
                            <td style="width: 10px;" align="right"></td>
                            <td>
                                <span class="wpc_client_message_time">
                                    {$message.date}
                                </span>
                                >>
                                <span class="wpc_client_message">{$message.comment}</span>
                            </td>
                        </tr>
                    {/foreach}
                {else}
                    <tr>
                        <td colspan="3">{$no_messages}</td>
                    </tr>
                {/if}    
            </table>
            <input type="button" id="wpc_show_more_mess" value="{$more_messages}" {if $count_messages <= $message_n}style="display:none;"{/if} />
        </div>
    </div>
{else}
    {if is_array( $messages ) && 0 < count( $messages ) }
        {foreach $messages as $message}
            <tr>
                <td style="width: 20%;" align="left">
                    <span class="wpc_client_message_author">
                        <strong>
                            {$message.sent_from_name}
                        </strong>
                    </span>:
                </td>
                <td style="width: 10px;" align="right"></td>
                <td>
                    <span class="wpc_client_message_time">
                        {$message.date}
                    </span>
                    >>
                    <span class="wpc_client_message">{$message.comment}</span>
                </td>
            </tr>
        {/foreach}
    {/if}
{/if}