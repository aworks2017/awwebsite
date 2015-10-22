{$user_info}
<div class="form_holder" id="client_profile" class="profile_staff">

    {if !empty( $message ) }
        <div id="message" class="updated fade {$message_class}" >{$message}</div>
    {/if}

    <form action="" method="post">
        <input type="hidden" name="wpc_action" value="client_profile" />

         <p class="staff_login">
            <label class="title" for="staff_login">{$label_staff_login}</label>
            <input type="text" id="staff_login" disabled="disabled" value="{$staff_login}" />
            <span class="description">{$login_cannot_changed}</span>
        </p>

        <p class="staff_email">
            <label class="title" for="staff_email">{$label_staff_email}<font color="red" title="{$title_star}">*</font></label>
            <input type="text" id="staff_email" name="user_data[email]" class="required" value="{$staff_email}" />
        </p>

        <p class="first_name">
            <label class="title" for="first_name">{$label_first_name}</label>
            <input type="text" id="first_name" name="user_data[first_name]" value="{$first_name}" />
        </p>

        <p class="last_name">
            <label class="title" for="last_name">{$label_last_name}</label>
            <input type="text" id="last_name" name="user_data[last_name]" value="{$last_name}" />
        </p>

        {foreach $custom_field as $field}
            {$field}
        {/foreach}

        {if !empty($custom_html)}
            {$custom_html}
        {/if}

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
