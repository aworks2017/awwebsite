<div class="staff_directory">
    {if !empty( $message )}
        <div id="message" class="updated wpc_notice fade"><p>{$message}</p></div>
    {/if}

    <div style="float:left;width:100%;margin-bottom:10px;">
        [wpc_client_get_page_link page="hub" text="HUB Page" /]
        {if !empty( $add_staff_link )}
            &nbsp;&nbsp;|&nbsp;&nbsp;<a href="{$add_staff_link}">{$texts.add_staff}</a>
        {/if}
    </div>
    <table class="widefat" style="float:left;width:100%;">
        <thead>
            <tr>
                <th>{$texts.staff_login}</th>
                <th>{$texts.first_name}</th>
                <th>{$texts.email}</th>
                <th>{$texts.status}</th>
            </tr>
        </thead>
        {foreach $staffs as $staff}
            <tr class="over">
                <td>
                    <strong>{$staff.user_login}</strong>
                    <span style="float:left;width:100%;display:block;">
                        <a href="{$staff.edit_link}">{$texts.edit}</a> |
                        <a onclick="return confirm('{$texts.delete_confirm}');" href="{$staff.delete_link}">{$texts.delete}</a>
                    </span>
                </td>
                <td>{$staff.first_name}</td>
                <td>{$staff.user_email}</td>
                <td>
                    {if $staff.to_approve == 1}
                        {$texts.wait_approve}
                    {else}
                        {$texts.approved}
                    {/if}
                </td>
            </tr>
        {/foreach}
    </table>
</div>