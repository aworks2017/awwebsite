{$user_info}
<div class="form_holder" id="client_profile">

    {if !empty( $message ) }
        <div id="message" class="updated fade {$message_class}" >{$message}</div>
    {/if}

    <form action="" method="post">
        <input type="hidden" name="wpc_action" value="client_profile" />
        <input type="hidden" name="contact_username" value="{$contact_username}" />
        <input type="hidden" name="ID" value="{$ID}" />

        <p class="business_name">
            <label class="title" for="business_name">{$label_business_name}</label>
            <input type="text" id="business_name" disabled="disabled" value="{$business_name}" />
            <span class="description">{$busname_cannot_changed}</span>
        </p>
        <p class="contact_name">
            <label class="title" for="contact_name">{$label_contact_name}</label>
            <input type="text" id="contact_name" name="contact_name" value="{$contact_name}" />
        </p>
        <p class="contact_email">
            <label class="title" for="contact_email">{$label_contact_email}</label>
            <input type="text" id="contact_email" name="contact_email" value="{$contact_email}" />
        </p>

        <p class="contact_phone">
            <label class="title" for="contact_phone">{$label_contact_phone}</label>
            <input type="text" id="contact_phone" name="contact_phone" value="{$contact_phone}" />
        </p>

        {foreach $custom_field as $field}
            {$field}
        {/foreach}

        {if !empty($custom_html)}
            {$custom_html}
        {/if}


        <p class="contact_username">
            <label class="title" for="contact_username">{$label_contact_username}</label>
            <input type="text" id="contact_username" disabled="disabled" value="{$contact_username}" />
            <span class="description">{$username_cannot_changed}</span>
        </p>

        {if $modify_profile }
            {if $reset_password }
                <p class="contact_password">
                    <label class="title" for="contact_password">{$label_contact_password}</label>
                    <input type="password" id="contact_password" name="contact_password" value="{$contact_password}" />
                </p>

                <p class="contact_password2">
                    <label class="title" for="contact_password2">{$label_contact_password2}</label>
                    <input type="password" id="contact_password2" name="contact_password2" value="{$contact_password2}" />
                </p>

                <div id="pass-strength-result">{$label_strength_indicator}</div>
                <div class="indicator-hint">{$label_indicator_hint}</div>
            {/if}


            <p class="btnAdd">
                <input type='submit' name='btnAdd' id="btnAdd" class='button-primary' value='{$text_submit}' />
                {$submit}
            </p>

        {/if}
    </form>
</div>
