<div class="wpc_client_client_managers">
    {if isset($managers)}
        {foreach $managers as $manager}
            <h5>{$manager.nickname}</h5>
            <ul style="list-style:none; margin:0; padding:0;">
                <li>Nickname: {$manager.nickname}</li>
                {if isset($manager.first_name) && !empty( $manager.first_name )}<li>First Name: {$manager.first_name}</li>{/if}
                {if isset($manager.last_name) && !empty( $manager.last_name )}<li>Last Name: {$manager.last_name}</li>{/if}
                {if isset($manager.contact_phone) && !empty( $manager.contact_phone )}<li>Phone: {$manager.contact_phone}</li>{/if}
                {if isset($manager.address) && !empty( $manager.address )}<li>Address: {$manager.address}</li>{/if}
                <li>Name: {$manager.dispay_name}</li>
                <li>Email: {$manager.email}</li>
            </ul>
            <br/>
        {/foreach}
    {/if}
</div>